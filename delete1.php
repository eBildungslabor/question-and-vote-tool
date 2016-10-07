<?php  

 $connect = mysqli_connect("localhost", "root", "", "formt"); 
 $sql ="DELETE FROM members WHERE memberID = '".$_POST["id"]."'   "; 

 
 $urlid = $_POST["id"];
 // requete to delete all data
 //DELETE s.*, m.*, v.* from members m inner join suggestions s on m.memberID = s.idmemberfk left join suggestions_votes v on v.suggestion_id = s.id where memberID = '25' 

 /*$sql = "DELETE s.*, m.*, v.* 
 from members m
 inner join suggestions s on m.memberID = s.qvid
 left join suggestions_votes v on v.suggestion_id = s.id WHERE memberID = '$urlid' "; */
 
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>  