<?php  
 $connect = mysqli_connect("localhost", "root", "", "formt");
 $id = $_POST["id"];  
 $text = $_POST["text"];  

 $column_name = $_POST["column_name"];  
 $sql = "UPDATE members SET ".$column_name."='".$text."' WHERE memberID='".$id."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Updated';  
 }  
 ?>  