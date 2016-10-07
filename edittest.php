 <!DOCTYPE html> 

 <html>  
      <head>  
           <title>Edit Qv Session data</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>                             
      </head>  
      <body>  
      <a href="http://questionandvotetool.esi.adp.com/" > <img src="img/logo3.jpg" class="img-responsive center-block" > </a>
      
      <?php parse_str($_SERVER['QUERY_STRING']);?>


             <div class="container">  
                <br />  

                <br />  
                <br />  

                <div class="table-responsive">  
                     <h3 align="center">Delete Session </h3><br />  
                     <div id="live_data"></div>                 
                </div>  
           </div>  
      </body>  
 </html> 



 <script >

  
 $("#edit").click(function() {
    //in here we can do the ajax after validating the field isn't empty.
    if($("#name").val()) {
        $.ajax({
            url: "selectest.php",
            type: "POST",
            async: true, 
            data: { username:$("#username").val(), details:$("#details").val()}, //your form data to post goes here as a json object
            dataType: "text",
            success: function(data) {
                $('#output').html(data); 
                drawVisualization();   
            },  
        });
    } else {
        //notify the user they need to enter data
    }
});
      //
 </script> 
 <script>  


// get qvid like url param 
  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
// getUrlParameter parse url and get Qvid to post 

 $(document).ready(function(){  
      function fetch_data()  
      {  
           $.ajax({  
                url:"selectest.php",  
                method:"POST",  
                data :{Qvid:getUrlParameter('Qvid') },   
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
      }  
      fetch_data();  
      $(document).on('click', '#btn_edit', function(){  
           var username = $('#username').text();  
           var details = $('#details').text();  
           if(username== '')  
           {  
                alert("Enter Qvsession name");  
                return false;  
           }  
           if(details == '')  
           {  
                alert("Enter detail");  
                return false;  
           }  
           $.ajax({  
                url:"edit.php",  
                method:"POST",  
                data:{username:username, details:details},  
                dataType:"text",  


                success:function(data)  
                {  
                     alert(data);  
                     fetch_data();  
                }  
           })  
      });




       
      /*$(document).on('blur', '.username', function(){  
           var id = $(this).data("id1");  
           var username = $(this).text();  
           edit_data(id, username, "username");  
      });  
      $(document).on('blur', '.details', function(){  
           var id = $(this).data("id2");  
           var details = $(this).text();  
           edit_data(id,details, "details");  
      }); */
 

      $(document).on('click', '.btn_delete', function(){  
           var id=$(this).data("id3");  
           if(confirm("Are you sure you want to delete this Qv session"))  
           {  
                $.ajax({  
                     url:"delete1.php",  
                     method:"POST",  
                     data:{id:id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_data();  
                     }  
                });  
           }  
      });  
 });  



 </script>  
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="jquery/jquery.js"></script>
