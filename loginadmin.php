

<?php
//include config
require_once('includes/config.php');

//check if already logged in move to home page
//if( $user->is_logged_in() ){ header('Location: index.php'); } 

//process login form if submitted
if(isset($_POST['submit'])){

	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$sessionName = $_POST['username'];
	$CodeSession = $_POST['password'];

	if($user->login($username,$password)  ){ 
		//$_SESSION['username'] = $user;
		//$_SESSION['password'] = $pass;

		header('Location:editsession.php?name='.$sessionName.'');
		exit;
	
	} else {
		$error[] = 'Acces code or session name not valid ';
	}

}//end if submit

//define page title
$title = 'QuestionAndVote';

//include header template
require('layout/header.php'); 
?>

			<hr>
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
	   <a href="http://questionandvotetool.esi.adp.com/" > <img src="img/logo3.jpg" class="img-responsive center-block" > </a>
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Please put the session name and access code</h2>
				<p><a href='./'>Back to home page</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
	
				?>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Qv Session name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Access code" tabindex="3">
				</div>
				
				
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Access Session" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		</div>
	</div>
		


</div>
	<hr>

<?php 
//include header template
require('layout/footer.php'); 
?>
