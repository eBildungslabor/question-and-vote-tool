<?php  
 $connect = mysqli_connect("localhost", "root", "", "formt");  
 $sql = "INSERT INTO members(username, details) VALUES('".$_POST["username"]."', '".$_POST["details"]."')";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Inserted';  
 }  
 ?>  