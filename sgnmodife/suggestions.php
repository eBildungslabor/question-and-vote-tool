<?php

require "connect.php";
require "suggestion.class.php";
include('session.php'); 

// recuperation of Id session
$result=mysqli_query($mysqli, "select * from members where memberID='$session_id'")or die('Error In Session');
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
    left outer join suggestions_votes v on v.suggestion_id = s.id AND v.ip = $ip 
    WHERE 
    m.memberID = $session_id
	ORDER BY s.rating DESC, s.id DESC

");

$str = '';

if(!$mysqli->error)
{
	// Generating the UL
	
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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Q and V tools </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="jquery/jquery.js"></script>  
	

	<link rel="stylesheet" href="styles.css" media="all"/>

<link rel="stylesheet" type="text/css" href="styles.css" />
<script src="jquery.js"></script>

</head>

<body>
<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 ">
	
<div id="container">
   <a href="http://questionandvotetool.esi.adp.com/" > <img src="img/logo3.jpg" class="img-responsive center-block" > </a>
<div id="page">

    <div id="heading" class="rounded">

    	<h2>QV SESSION : <?php echo $row['username']; ?> </h2>
    	<h3>Details : <?php echo $row['details']; ?> </h3>
			  <i>  
		<?php
		$date = date("d-m-Y");
		$heure = date("H:i");
		//print ("you can ask your questions for this subject!");
		//Print("it is $date at $heure. ");
		?>  </i>
    </div>
  <i > Ask any questions and vote using green arrow. Feel Free: It's anonymous </i>

     <form id="suggest" action="" method="GET">
        <p>
          <textarea rows="3"  overflow="hidden"  name="content" id="suggestionText" class="rounded" maxlength="2000" class="form-control" >  </textarea> 
            <!--<input type="text" name="QVid" value="<?php //echo $id; ?>">-->
          <button  type="submit" value="Submit" id="submitSuggestion"  > </button>
        </p>
	</form>
	<br> <br>

 


	<?php
		echo $str;
	?>
    

<p class="createdBy"> Created By GETS<br> </p>
</div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="script.js"></script>
</body>
</html>
