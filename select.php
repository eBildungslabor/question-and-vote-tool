<?php  
 parse_str($_SERVER['QUERY_STRING']);
 
 $connect = mysqli_connect("localhost", "root", "", "formt");  

 $output = '';  

 //$sql = "SELECT * FROM members WHERE memberID = '".$_POST["Qvid"]."' ";  

 $sql = "SELECT * FROM members WHERE memberID = '".$_POST["Qvid"]."'";  
 $result = mysqli_query($connect, $sql);  
 $output .= '  

      <div class="table-responsive">  
           <table class="table table-bordered " border-radius="5px">  
                <tr bgcolor=" #c4da5a" >  
                     <th width="40%">Qv Session Name</th>  
                     <th width="40%">Qv session Details</th>  
                     <th width="15%">Delete Qv session </th>  
                </tr>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
           

                <tr> 
                    
                         <td   width="400" class="username" data-id1="'.$row["memberID"].'"  class="editable">
                            <div contentEditable style="width: 1%; height: 1%;">
                            '  .$row["username"].'
                            </div>
                        </td>


                         <td width="400" class="details" data-id2="'.$row["memberID"].'"  class="editable">
                            <div contentEditable style="width: 1%; height: 1%;">
                            '  .$row["details"].'
                            </div>
                        </td>
 

                     <td><button type="button" name="delete_btn" data-id3="'.$row["memberID"].'" class="btn btn-sm btn-danger btn_delete">delete</button> 
                      
                     </td>  

                </tr>  
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