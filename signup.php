<?php

session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted


    $partner_email = $_POST['partner_email'];
    $partner_password = $_POST['partner_password'];
    $partner_priv = $_POST['partner_priv'];
    $partner_organization = $_POST['partner_organization'];
    $hashed_pass = password_hash($partner_password, PASSWORD_BCRYPT);
    $query = "SELECT * FROM user_creds WHERE partner_email = '$partner_email'";
    $result = mysqli_query($con, $query);
    if($result && mysqli_num_rows($result)>0)
    {
      echo "User already exists!";
    }
    else {

          if(!empty($partner_email) && !empty($partner_password) && !empty($partner_priv) && !empty($partner_organization))
          {
            //saving to database
            //$deal_id = random_num(6);
            $query = "INSERT INTO user_creds (partner_organization, partner_email, partner_password, partner_priv) VALUES ('$partner_organization', '$partner_email', '$hashed_pass', '$partner_priv')";
            mysqli_query($con, $query);
            header("Location: login.php");

          }
          else {
              echo 'Please enter all the information!';
          }
    }

}

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);




 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Login</title>
   </head>
   <body>
     <style media="screen">

      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

      *{
        margin: 0;
        border: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body{
            font-family: 'Poppins', sans-serif;
      }

       #text{
         height: 45px;
         border-radius: 20px;
         padding: 15px;
         border: solid thin #aaa;
         width: 100%;
       }

       #button{
         width: 100%;
         background: linear-gradient(120deg, #e52d27,#b31217);
         border-radius: 25px;
         height: 50px;
         color: white;
         display: flex;
         justify-content: center;
         align-items:center;
         border: none;
         font-size: 20px;
         -webkit-box-shadow: 2px 2px 3px -1px rgba(0,0,0,0.35);

       }

       .main-box{
         display: flex;
         margin: auto;
         height: 80vh;
         background: linear-gradient(180deg, #DBDBDB, #EAEAEA);
         background-image: url("qbkls.png");
         background-repeat: repeat;
         /*background-color: #bdc3c7;*/
         align-items: center;
         justify-content: space-between;
         background-color:rgba(0, 0, 0, 0.5);"
         /*background-color: #ef473a;*/
       }



       #box{
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
         padding: 20px;
         padding-top: 30px;
         background: #fff;
         width: 25%;
         margin: auto;
         border-radius: 20px;
         -webkit-box-shadow: 2px 2px 3px -1px rgba(0,0,0,0.35);
       }

       .form-heading{
         /*margin-left: 10px;*/
         font-size: 30px;
         margin-bottom: 20px;
         align-items: center;
         display: flex;
         justify-content: center;
         /*background-color: yellow;*/
       }

       .sign-up-aref{
         display: flex;
       }

       .nav-bar{
         background: white;
         display: flex;
         width: 100%;
         margin: auto;
         height: 10vh;
         justify-content: space-around;
         align-items: center;

       }

       .nav-logo img{
         width: 25%;
         height: auto;
         margin-left: 10%;
         display: flex;


       }

       nav{
         display: flex;
         width: 100%;
         justify-content: space-around;
       }

       .list-items{
         list-style: none;
         width: 50%;
         display: flex;
         justify-content: space-around;
         align-items: center;
       }

       .list-items li a{
         text-decoration: none;
         color: black;
       }


       .list-items li a:hover{
         background-color: black;
         padding: 5px 7px;
         border-radius: 5px;
         color: white;
       }

       .welcome{
         width: 50%;
         margin: auto;
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
         /*background-color: yellow;*/
       }
       .welcome h1{
         margin-left: 20px;
       }
       .welcome img{
         width: 75%;
         height: auto;
       }

       .footer{
         display: flex;
         height: 10vh;
         justify-content: center;
         align-items: center;
       }

     </style>

     <div class="nav-bar">
         <nav>
           <div class="nav-logo">
             <img src="logo_galaxkey" alt="">
           </div>
               <ul class = "list-items">
               <li><a href="https://www.galaxkey.com/aboutgalaxkey/" target="_blank">About</a></li>
               <li><a href="https://www.galaxkey.com/contact/contact/" target="_blank">Contact</a></li>
             </ul>
         </nav>
     </div>

      <div class="main-box">
           <div id="box">
             <form  method="post">
               <div class= 'form-heading'>Sign up!</div>
               <input id="text" type="text" name="partner_organization" value="" placeholder="organization"><br><br>
               <input id="text" type="text" name="partner_email" value="" placeholder="username"><br><br>
               <input id="text" type="password" name="partner_password" value="" placeholder="password"><br><br>
               <input id="text" type="text" name="partner_priv" value="" placeholder="privilege"><br><br>
               <input id="button" type="submit" name="" value="Sign up"><br><br>
             </form>
           </div>
        <div class="welcome">
          <img src="logo_galaxkey" alt="">
          <h1>Welcome to the Partner Portal.</h1>
        </div>

      </div>
      <div class="footer">
        <div class="copyright">
          Copyright © Galaxkey Limited 2021
        </div>

      </div>
   </body>
 </html>
