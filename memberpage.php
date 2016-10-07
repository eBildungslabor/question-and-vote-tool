<?php require('includes/config.php'); 


//if not logged in redirect to login page
//if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Members Page';

//include header template
require('layout/header.php'); 
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">	
	    	   <img src="img/logo3.jpg" class="img-responsive center-block" > 
				<h2>Member page only  - Welcome  </h2>
				 <h2 class='bg-success'> Topic created successfully, please check your email to recover your login and session code</h2>
				
				<p> You have created your topic, your login information are sent by email .
				 For communicating , send the name of your session and your access code 
				<b> ( transmitted by email ) </b> to users concerned to allow the user to partcipate in your session. 
				here the <a href='questionandvotetool.esi.adp.com/login.php'>link</a> to participate of this topic. </p>
<!--  send mail -->

<!--  end send mail -->


<a href='logout.php'>Logout</a></p>
				<hr>

		</div>
	</div>


</div>



<?php 
//include header template
require('layout/footer.php'); 
?>



