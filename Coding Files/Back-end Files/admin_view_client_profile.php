
<?php
  
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 

   $use = $_SESSION['user_name'];

   if($use == true)
  {
      
  }

   else
  {
      header("location:http://localhost/bazar/v_login.php");
  } 


?>



<!DOCTYPE html>
<html lang="en">

<head>

 <title>MY POSTS HISTORY</title>
 
  
  <style>

   #client_profile
  {
   font-family: "Trebuchet MS", Arial, Helvetica, sans-serif ;
   border-collapse: collapse ;
   width: 96%;

   margin-left:auto ;
   margin-right:auto;

 }

 #client_profile  td, #client_profile  th 
 {
   border: 2px solid #ddd ;
   padding: 10px;
   font-size : 16px;
   text-align: center;
}

#client_profile  tr:nth-child(even){background-color: #f2f2f2;}

#client_profile  tr:hover {background-color: #ddd;}

#client_profile  th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  font-size : 18px;
  background: linear-gradient(to bottom, #ff0066 0%, #ff33cc 100%);
  color: white;
}

  </style>


</head>

<body>

<!----------------  Start Header  ---------------->

  <?php

   $menu = file_get_contents("menu_bazar.php") ;
   $base = basename($_SERVER['PHP_SELF']) ;

   $menu = preg_replace("|<li><a href=\"".$base."\">(.*)</a></li>|U", "<li id=\"current\">$1</li>", $menu) ;

   include 'menu_bazar.php' ;

  ?>



      <hr/>
       <br />
        
      <table id="client_profile">
    
        <tr>

          <th>SIGN UP ID</th>
          <th>First Name <hr style="height:2px;border-width:0;color:black;background-color:#ddd">Last Name
          </th>

          <th>User Name</th>
          <th>Phone Number <hr style="height:2px;border-width:0;color:black;background-color:#ddd">E-mail
          </th>
          <th>Registration Date <hr style="height:2px;border-width:0;color:black;background-color:#ddd">Address
          </th>

          <th>Password Code</th>
          
        </tr> 


    <?php

      ini_set( "display_errors", 0);

      include 'connection.php';

      $use = $_SESSION['user_name'];

      $conn = mysqli_connect("localhost","root","","bazar");
          
      $sql = "SELECT * FROM client_signup "; 
    
      

      if ($result = mysqli_query($conn, $sql)) 
      {
           while ($row = mysqli_fetch_assoc($result)) 
          {
             if(isset($_SESSION['user_name']))
            {

                echo "
                 <tr>
                  <td>".$row['signup_id']."</td>
                  
                  <td> ".$row['firstname']." <hr style='height:2px;border-width:0;color:black;background-color:black'> 
                         ".$row['lastname']." 
                  </td>

                  <td>".$row['username']."</td>

                  <td> ".$row['phone']." <hr style='height:2px;border-width:0;color:black;background-color:black'> 
                  ".$row['email']." 
                  </td>

                  <td> ".$row['reg_time']." <hr style='height:2px;border-width:0;color:black;background-color:black'> 
                  ".$row['address']." 
                  </td>
                  

                
              
                  <td> ".$row['pass_re_code']." <hr style='height:2px;border-width:0;color:black;background-color:black'> 
                   
                  <form method='post' action='admin_view_client_profile.php'>
                          <input type='text' placeholder='Sing Up ID' name='sign_id'> <br />
                          <input type='text' placeholder='New Code' name='new_code'> <br />

                          <button class='btn btn-success pull-right' type='submit' name='done' >SET</button>

                  </form>
                  </td>

                  
                 
                </tr> " ;
       
        }
      }
    }

        else "ERROR OCCURED" ;

    
     
  ?>

    </table>



    <?php
   
  
      include 'connection.php';

      $conn = mysqli_connect("localhost","root","","bazar");
      
    
       
      if (isset($_POST['done'])) 
     {
      
      $s_id = $_POST ['sign_id'] ;
      $new_c = $_POST ['new_code'] ;
         
      
       $sql = "UPDATE client_signup SET pass_re_code = '$new_c' WHERE signup_id='$s_id' ";

      if (mysqli_query($conn, $sql))
    {   
      echo "<script>alert('Password Code Update successfully'); 
      window.location='admin_profile.php'</script>";
       mysqli_close($conn);
     
      exit;
 } 
  
  else 
{
  echo "<script>alert('Error occured updating code'); 
  window.location='admin_view_client_profile.php'</script>";

}
   }

?>


        <br />
      <br />
    <hr/>


   <?php include 'footer_bazar.php'?>      


 </body>






 
      
  