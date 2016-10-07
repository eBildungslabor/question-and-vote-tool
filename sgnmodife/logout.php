<?php require('config.php');
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

//logout
$user->logout(); 

//logged in return to index page
header('Location: index.php');
exit;
?>

