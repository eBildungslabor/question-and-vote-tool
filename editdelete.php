<?php error_reporting(E_ERROR | E_PARSE); ?>
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


// Search
parse_str($_SERVER['QUERY_STRING']);

//if(isset($_POST['search']))
//{
    //$data = getPosts();
    
    $search_Query = "SELECT * FROM members WHERE memberID = $Qvid";
    
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
            //echo 'No Data For This Id';//No Data For This Id
          header('Location:error404.php');

        }
    }else{
        echo ' ';
    }
//}



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
                echo '';//data deleted
            }else{
                echo ' ';//data not deleted
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
                echo ' ';//data Updated
            }else{
                echo ' ';//Data Not Updated
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}


?>

<!DOCTYPE >
<html>
    <head>

       <meta charset="utf-8">
    <title><?php if(isset($title)){ echo $title; }?></title>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Bootstrap -->
   
  
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    </head>
    <body>
    <hr>

    <div class="container">

  <div class="row">

      <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
     <a href="http://questionandvotetool.esi.adp.com/" > <img src="img/logo3.jpg" class="img-responsive center-block" > </a>
      <h3 class ="center-block"> Delete or edit your Qvsession name and detail </h3>
       <br><br>
        <form action="#" method="post">

             <hr>

         <!-- <div class="form-group">
          <input type="number" name="id" id="id" class="form-control input-lg" placeholder="id" value="<?php //echo $Qvid;?>" tabindex="1">
          </div>-->

      
          <div class="form-group">
           <label class="btn btn-success" for="username">Qv session name</label>
          <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Topic name" value="<?php echo $username;?>" tabindex="1">
          </div>


<br>

         <div class="form-group">
            <label class="btn btn-success" for="details">Qv session detail </label>
          <input type="text"  name="details" id="details" class="form-control input-lg" placeholder="Topic name" value="<?php echo $details;?>" tabindex="1">
          </div>

             <hr>
        <!--   <div class="form-group">
             <!-- Input For Find Values With The given ID -->
         <!--  <div class="col-xs-6 col-md-6"><input type="submit" name="search" id = "mySearch" value="Find" class="btn btn-primary btn-block btn-lg" tabindex="5">
          </div>
            </div>-->
            <!-- Input For Edit Values -->

            <div>
            <!-- Input For Clear Values -->
            <div class="col-xs-6 col-md-6">
            <input type="submit" name="delete" value="Delete" class="btn btn-primary btn-block btn-lg btn-danger" onclick="return confirm('Are you sure you want to delete?')" tabindex="5" >
            </div>

           <div class="col-xs-6 col-md-6">

          
           <button  type="submit" name="update" value="Update" class="btn btn-primary btn-block btn-lg"   > Update </button>



     <!-- <button type="button" name="update" value="Update" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Update</button>


          <!-- Modal edit -->
            <div class="modal fade " id="myModal" role="dialog" >
              <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Qv session Name/ Detail Updated</h4>
                  </div>
                  <div class="modal-body">
                    <p> Data updated</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
                
              </div>
            </div>     
          <!--end modal-->

          </div>
  
            </div>
        </form>
            </div>
                </div>
                </div>


    </body>
</html>

<?php if(isset($_POST['update'])){ 
header('Location:editdelete.php?Qvid='.$Qvid.''); 
}
 

if(isset($_POST['delete'])){
header('Location:successdelete.php');
}
?>
