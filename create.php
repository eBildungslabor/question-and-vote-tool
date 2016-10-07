<?php error_reporting(E_ERROR | E_PARSE); ?>

<?php require('includes/config.php');
require 'phpmailer\PHPMailerAutoload.php';

//if logged in redirect to members page
//if( $user->is_logged_in() ){ header('Location: memberpage.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

	//very basic validation
	if(strlen($_POST['username']) < 3){
		$error[] = 'Qv session name is too short.';
	} else {
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'Sessioname provided is already in use.';
		}

	}

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);


	}


	//if no errors have been created carry on
	if(!isset($error)){

		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);


		try {

			//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO members (username,password,email,details) VALUES (:username, :password, :email, :details)');
			$stmt->execute(array(
				':username' => $_POST['username'],
				':details' => $_POST['details'],
				':password' => $hashedpassword,
				':email' =>$_POST['email'],

			));

			$id = $db->lastInsertId('memberID');

			// start send mail

			//send email
			$to = $_POST['email'];

			$sessionName = $_POST['username'];
			$CodeSession = $_POST['password'];
			$details = $_POST['details'];

			$mail = new mail();



			$mail->AddEmbeddedImage('img\logo3.jpeg', "img","logo3.jpeg" );
			$mail->isHTML(true);
			$subject = "Create session confirmation : $sessionName";
			$headers  = 'MIME-Version: 1.0' . "\n";
        	$headers .='Content-Type: text/html; charset="UTF-8"'."\n";

			
			
			$body = " <br>
			<img src='http://questionandvotetool.esi.adp.com/img/logo3.jpg'/>
			 
			 <h3> <br> Your QV Session has been successfully created. </h3>


			<p>To invite participants to your QV Sessions, you should send them this link : <a href='questionandvotetool.esi.adp.com/suggestions.php?qvid=$id&name=$sessionName'>questionandvotetool.esi.adp.com/suggestions.php?qvid=$id&name=$sessionName</a></p>
				  
			<p> To edit/delete your QV session details, follow this link : <a href='questionandvotetool.esi.adp.com/editdelete.php?Qvid=$id'>questionandvotetool.esi.adp.com/editdelete.php?Qvid=$id</a></p>
			<p> If you want to ask/comment it, please go to this community page in digital Workplace</a></p>

			<p> keep this mail carefully </p> 
			
			<p>Regards Site Admin</p>";

			
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();
			// end send mail
			// get id
			 $query = 'SELECT * FROM members';
		    if ($_GET['id']) 
		    $query .= ' WHERE id = '.$_GET['id'];
		   
			header('Location:suggestions.php?qvid='.$id.'&name='.$sessionName.'');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}
	}
}

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

		
				<h2  class ="center-block"> Please Sign Up</h2>
				<p>Have a session code Already ? <a href='login'>Acess topic</a> Back to <a href='./'>home page</a> </p>
		
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
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Topic name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>
				<div class="form-group">

				   <textarea  rows="5"  overflow="hidden" type="text" name="details" id="details" class="form-control input-lg" placeholder="Details" value="<?php if(isset($error)){ echo $_POST['details']; } ?>" tabindex="1"></textarea> 
				</div>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="ADP Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2">
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Qv session code (optional)" tabindex="3">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm code (optional)" tabindex="4">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Create Topic" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
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
