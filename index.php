<?php
session_start();
  include("connection.php");
  include("functions.php");

  $user_data = check_login($con);

 ?>



 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Partner Login Portal</title>
   </head>
   <body>
     <a href="logout.php">Logout</a>
     <h1>This is the index page</h1>
     <br>
     Hello, <?php echo $user_data['partner_email'] ?>.
   </body>
 </html>
