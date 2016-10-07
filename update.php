<?php


parse_str($_SERVER['QUERY_STRING']);
$host = "localhost";
$user = "root";
$password ="";
$database = "formt";

$id = "";
$username = "";
$details = "";


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    echo 'Error';
}

// get values from the form
function getPosts()
{
  parse_str($_SERVER['QUERY_STRING']);
    $posts = array();
    $posts[0] = $Qvid;
    $posts[1] = $_POST['username'];
    $posts[2] = $_POST['details'];
    
    return $posts;
}

require('editdelete.php')


    $data = getPosts();
    $update_Query = "UPDATE `members` SET `username`='$data[1]',`details`='$data[2]' WHERE `memberID` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo ' ';//data Updated
            }else{
                echo ' ';//Data Not Updated
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }

?>