<?php  
 $connect = mysqli_connect("localhost", "root", "", "formt");  
 if(isset($_POST["id"]))  
 {  
      foreach($_POST["id"] as $id)  
      {  
           $sql = "DELETE FROM suggestions WHERE id = '".$id."'";  
           mysqli_query($connect, $sql);  
      }  
 }  
 ?>  