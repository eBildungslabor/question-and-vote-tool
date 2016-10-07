<?php
require "connect.php";
require "suggestion.class.php";

if ($_GET['trace']=="ON") {$trace=1;}

if ($trace==1) {echo("traces<BR/>");}


// Converting the IP to a number. This is a more effective way
// to store it in the database:

$ip	= sprintf('%u',ip2long($_SERVER['REMOTE_ADDR']));

if ($trace==1) {echo("action=".$_GET['action'])."<br/>";}
if($_GET['action'] == 'vote'){

	$v = (int)$_GET['vote'];
	$id = (int)$_GET['id'];

	if($v != -1 && $v != 1){
		exit;
	}

	if ($trace==1) {echo($v." ".$id);} 
	// Checking to see whether such a suggest item id exists:	
	if(!$mysqli->query("SELECT 1 FROM suggestions WHERE id = $id")->num_rows){
		exit;
	}
	
	// The id, ip and day fields are set as a primary key.
	// The query will fail if we try to insert a duplicate key,
	// which means that a visitor can vote only once per day.
	
	$mysqli->query("
		INSERT INTO suggestions_votes (suggestion_id,ip,vote)
		VALUES (
			$id,
			$ip,
			$v
		)
	");

	if($mysqli->affected_rows == 1)
	{
		$mysqli->query("
			UPDATE suggestions SET 
				".($v == 1 ? 'votes_up = votes_up + 1' : 'votes_down = votes_down + 1').",
				rating = rating + $v
			WHERE id = $id
		");
	}
}
else if($_GET['action'] == 'submit'){

	if(get_magic_quotes_gpc()){
		array_walk_recursive($_GET,create_function('&$v,$k','$v = stripslashes($v);'));
	}

	// Stripping the content	
	$_GET['content'] = htmlspecialchars(strip_tags($_GET['content']));
	parse_str($_SERVER['QUERY_STRING']);
 	echo $id;

	
	if((mb_strlen($_GET['content'],'utf-8')<3)) {
		exit;
	}

	$myquery="INSERT INTO suggestions SET  suggestion = '".$mysqli->real_escape_string($_GET['content'])."',  qvid='".$_GET['qvid']."' "; 

		if ($trace==1) {echo($myquery."<BR/> ");} 

	$mysqli->query($myquery);
	
	// Outputting the HTML of the newly created suggestion in a JSON format.
	// We are using (string) to trigger the magic __toString() method of the object.
	
	echo json_encode(array(
		'html'	=> (string)(new Suggestion(array(
			'id'			=> $mysqli->insert_id,
			'suggestion'	=> $_GET['content']
		)))
	));
}

?>

