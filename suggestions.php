<?php

require "connect.php";
require "suggestion.class.php";

parse_str($_SERVER['QUERY_STRING']);

//test of absence in qvid in the database and display home page 
if (!$qvid) {
    header('Location: http://questionandvotetool.esi.adp.com/ ');
    die();
}

// access to DB and recuperation of details and qv session name 

$result=mysqli_query($mysqli, "select * from members where memberID='$qvid'")or die('Error In Session');
$row=mysqli_fetch_array($result);


// Converting the IP to a number. This is a more effective way
// to store it in the database:

$ip	= sprintf('%u',ip2long($_SERVER['REMOTE_ADDR']));

// The following query uses a left join to select
// all the suggestions and in the same time determine
// whether the user has voted on them.

$result = $mysqli->query("
	SELECT s.*, if (v.ip IS NULL,0,1) AS have_voted
	from members m
    inner join suggestions s on m.memberID  = s.qvid
    left  join suggestions_votes v on v.suggestion_id = s.id AND v.ip = $ip 
    where 
    qvid='$qvid'
	ORDER BY s.rating DESC, s.id DESC

");


$str = '';

if(!$mysqli->error)
{

	
	$str = '<ul class="suggestions">';
	
	// Using MySQLi's fetch_object method to create a new
	// object and populate it with the columns of the result query:
	
	while($suggestion = $result->fetch_object('Suggestion')){
		
		$str.= $suggestion;	// Using the __toString() magic method.
		
	}
	
	$str .='</ul>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Q and V tools </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<link rel="stylesheet" href="styles.css" media="all"/>

<link rel="stylesheet" type="text/css" href="styles.css" />
<script src="jquery/jquery.js"></script>

</head>

<body>
<div class="container">
		
				<div class="row row-centered">

<a href="http://questionandvotetool.esi.adp.com/" > <img src="img/logo3.jpg" class="img-responsive center-block" > </a>


<div id="container">

<div id="page">

    <div id="heading" class="rounded">

    	<h2>QV SESSION : <?php echo  utf8_decode( $row['username']); ?> </h3>
    	<h3>Details : <?php echo utf8_decode($row['details']); ?> </h4>
			  <i>  

		<?php
		if(empty(utf8_decode($row['username']))) {

 		 header('Location:http://questionandvotetool.esi.adp.com/error404.php');
  		// redirect if topic are deleted
 	 exit();
		}
		//print ("you can ask your questions for this subject!");
		//Print("it is $date at $heure. ");
		?> 
		 </i>
    </div>

  <i> Ask any questions and vote using green arrow. Feel Free: It's anonymous </i>
   	<div id="chat_box" class="dmcscroll">
   	
     <form id="suggest" action="" method="GET">
        <p>
          <textarea rows="5"  overflow="hidden"  name="content" id="suggestionText" class="rounded" maxlength="2000" class="form-control" >  </textarea> 
            <!--<input type="text" name="QVid" value="<?php //echo $id; ?>">-->
          <button  type="submit" value="Submit" id="submitSuggestion"  > </button>
        </p>
	</form>
	<br> <br>

    </div>


	<?php
		echo $str;
	?>
    
   <p class="createdBy"> Created By GETS<br> </p>
</div>
<!--<p class="createdBy"  class="center-block" > Created By GETS  </p>-->

</div>

</div>
</div></div>
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="script.js"></script>
</body>
</html>
