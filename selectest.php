<?php

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
    $posts = array();
    $posts[0] = $_POST['id'];
    $posts[1] = $_POST['username'];
    $posts[2] = $_POST['details'];
    
    return $posts;
}

// Search
parse_str($_SERVER['QUERY_STRING']);
if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM members WHERE memberID = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $id = $row['memberID'];
                $username = $row['username'];
                $details = $row['details'];
                
            }
        }else{
            echo 'No Data For This Id';
        }
    }else{
        echo 'Result Error';
    }
}


// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    $insert_Query = "INSERT INTO `members`(`username`, `details`) VALUES ( '$data[1]','$data[2]' )";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Inserted';
            }else{
                echo 'Data Not Inserted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert '.$ex->getMessage();
    }
}

// Delete
if(isset($_POST['delete']))
{
    $data = getPosts();
    $delete_Query = "DELETE FROM `members` WHERE `memberID` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Deleted';
            }else{
                echo 'Data Not Deleted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))
{
    $data = getPosts();
    $update_Query = "UPDATE `members` SET `username`='$data[1]',`details`='$data[2]' WHERE `memberID` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Updated';
            }else{
                echo 'Data Not Updated';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}



?>


<?php  
 parse_str($_SERVER['QUERY_STRING']);
 
 $connect = mysqli_connect("localhost", "root", "", "formt");  

 $output = '';  

 //$sql = "SELECT * FROM members WHERE memberID = '".$_POST["Qvid"]."' ";  

 $sql = "SELECT * FROM members WHERE memberID = '".$_POST["Qvid"]."'";  
 $result = mysqli_query($connect, $sql);  
 $output .= '  
                ';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  


          <div class="form-group">
          <input type="text" name="username" id="username" data-id1="'.$row["memberID"].'"  class="form-control input-lg" class="username"  placeholder="Topic name" value=" '.$row["username"].'" tabindex="1">
          </div>

          <div class="form-group">
          <input type="text" name="details" id="details" data-id2="'.$row["memberID"].'"  class="form-control input-lg" class="username"  placeholder="Topic name" value=" '.$row["details"].'" tabindex="1">
          </div>
          <button type="button" name="delete_btn" data-id3="'.$row["memberID"].'" class="btn btn-sm btn-danger btn_delete">delete</button> 
                      
            </div>
           


            <!-- Input For Edit Values -->

           <div class="col-xs-6 col-md-6"><input type="submit" name="update" value="Update" class="btn btn-primary btn-block btn-success" tabindex="5">
          </div>
          <!-- Input For Clear Values -->
            <div class="col-xs-6 col-md-6"><input type="submit" name="delete" value="Delete" class="btn btn-primary btn-block btn-danger" tabindex="5">
          </div>
    
            
            </div>

  
           ';  
      }  
    /* $output .= '  
           <tr> <td></td> 
             

                <td id="username" contenteditable>   </td>  
                <td id="details" contenteditable>  </td>
                 <td>  <button type="button" name="btn_add" id="btn_add" class="btn btn-sm btn-success">Add</button></td>
  
           </tr>  
      '; */
 }  
 else  
 {  
      $output .=  '<tr>  

                          <td colspan="4" class="text-center">    


    <div class="alert alert-success fade in">

        <strong>Note</strong> Your Qv session has been deleted !.

    </div>

                          </td>  



                     </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>  