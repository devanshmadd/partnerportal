<?php

session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted


    $partner_email = $_POST['partner_email'];
    $partner_password = $_POST['partner_password'];


    if(!empty($partner_email) && !empty($partner_password))
    {
      //saving to database
      //$deal_id = random_num(6);

      $query = "SELECT * FROM user_creds WHERE partner_email = '$partner_email' ";
      $result = mysqli_query($con, $query);
      if($result)
      {

        if($result && mysqli_num_rows($result)>0)
        {

          $user_data = mysqli_fetch_assoc($result);
          if(password_verify($partner_password, $user_data['partner_password']))
          {
            $_SESSION['partner_email'] = $user_data['partner_email'];
            $_SESSION['partner_organization'] = $user_data['partner_organization'];
            $_SESSION['partner_priv'] = $user_data['partner_priv'];
            echo "success";
            //$_SESSION['partner_name'] = $user_data[]
            header("Location: register_deal.php");
          }
        }

      }

        echo "Wrong username or password!";

      //header("Location: login.php");
      //die;
    }
    else {
      echo 'Please enter all the information!';
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
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
     <link rel="stylesheet" href="assets/css/style.css">
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
         overflow: auto;
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

       .footer-dark {
         padding:50px 0;
         color:#f0f9ff;
         background-color:#2d3436;
       }

       .footer-dark h3 {
         margin-top:0;
         margin-bottom:12px;
         font-weight:bold;
         font-size:16px;
       }

       .footer-dark ul {
         padding:0;
         list-style:none;
         line-height:1.6;
         font-size:14px;
         margin-bottom:0;
       }

       .footer-dark ul a {
         color:inherit;
         text-decoration:none;
         opacity:0.6;
       }

       .footer-dark ul a:hover {
         opacity:0.8;
       }

       @media (max-width:767px) {
         .footer-dark .item:not(.social) {
           text-align:center;
           padding-bottom:20px;
         }
       }

       .footer-dark .item.text {
         margin-bottom:36px;
       }

       @media (max-width:767px) {
         .footer-dark .item.text {
           margin-bottom:0;
         }
       }

       .footer-dark .item.text p {
         opacity:0.6;
         margin-bottom:0;
       }

       .footer-dark .item.social {
         text-align:center;
       }

       @media (max-width:991px) {
         .footer-dark .item.social {
           text-align:center;
           margin-top:20px;
         }
       }

       .footer-dark .item.social > a {
         font-size:20px;
         width:36px;
         height:36px;
         line-height:36px;
         display:inline-block;
         text-align:center;
         border-radius:50%;
         box-shadow:0 0 0 1px rgba(255,255,255,0.4);
         margin:0 8px;
         color:#fff;
         opacity:0.75;
       }

       .footer-dark .item.social > a:hover {
         opacity:0.9;
       }

       .footer-dark .copyright {
         text-align:center;
         padding-top:24px;
         opacity:0.3;
         font-size:13px;
         margin-bottom:0;
       }

       https://epicbootstrap.com/snippets/footer-dark

       button{
         font-family: "Poppins", sans-serif;
     }


     .dropdown{
       height: 7vh;
       display: flex;
       justify-content: space-around;
       align-items: center;
       width: 100%;
       background-color: #d63031;
     }
     .downloads{
       position: relative;
       height: 100%;
       display: flex;
       flex-direction: column;
       justify-content: center;
       align-items: center;
     }

     .downloads ul{
       background-color: rgba(214, 48, 49,1.0);
       position: absolute;
       margin-top: 10px;
       margin-bottom: 0px;
       width: 200px;
       height: 200px;
       display: flex;
       justify-content: space-around;
       align-items: center;
       flex-direction: column;
       list-style: none;
       border-radius: 5px;
       opacity:0;
       pointer-events: none;
       transform: translateY(-10px);
       transition: all 0.4s ease;
     }

     .downloads a {
       color: white;
       text-decoration: none;
     }

     .downloads li{

       width: 100%;
       height: 100%;
       display: flex;
       justify-content: center;
       align-items: center;
       font-weight: bolder;
     }

     .downloads li:hover{
       background-color: rgba(255, 118, 117,1.0);
     }

     .dropdown button, .home{
       background: none;
       border: none;
       color: white;
       text-decoration: none;
       font-size: 18px;
       font-weight: bolder;
       cursor: pointer;
       width: 100%;
     }

     .downloads{
       width: 100%;
     }

     .dropdown button:hover, .home:hover{
       background-color: rgba(255, 118, 117,1.0);
       height: 100%;

     }

     .downloads button:hover{
       background-color: rgba(255, 118, 117,1.0);
       height: 100%;
     }

     .downloads button:focus +ul{
       opacity: 1;
       pointer-events: all;
       transform: translateY(110px);

     }

     .logo img{
         width: 20%;
         height: auto;

     }

     .logo{
       display: flex;
       align-items: center;
       justify-content: center;
       background-color: #2d3436;

     }

     .logo h2{
       color: white;
     }


     .nav-toggle, .nav-toggle-label{
             display: none;
           }



   @media (max-width: 960px){

       .main-box{
         display: flex;
         flex-direction: column;
         overflow-y: auto;
       }
       #box{
         margin-block: 15px;
         min-width: 90%;
         min-height: auto;
       }

       #box form{
         max-width: 100%;
       }

       .register{
         font-size: 1.75rem;
       }
       .dropdown{
         position: absolute;
         height: 50%;
         display: flex;
         flex-direction: column;
         justify-content: space-around;
       }
       .logo{
         min-height: 10vh;
       }
       .logo img{
         min-width: 35%;
       }
       .keywords{
         font-size: 1.25rem;
       }
       .keywords thead{
         font-size: 1rem;
       }

       .dropdown{
         display: none;
       }

       .nav-toggle{
         display: none;
       }

       .dropdown{
         display: none;
       }

       .nav-toggle:checked ~ .dropdown{
         display: flex;
       }

       .nav-toggle-label{
         position: absolute;
         background-color: white;
         width: 35px;
         height: 5px;
         color: #FFF;
         top: 50px;
         left: 20px;
         display: block;
       }

       .nav-toggle-label span::before,
       .nav-toggle-label span::after{
         background-color: white;
         width: 35px;
         height: 5px;
       }

       .nav-toggle-label span::before,
       .nav-toggle-label span::after{
         content: '';
         position: absolute;
       }

       .nav-toggle-label span::before{
         bottom: 10px;
       }

       .nav-toggle-label span::after{
         top:10px;

       }


       .dropdown button, .home{
         background: none;
         border: none;
         color: white;
         text-decoration: none;
         font-size: 18px;
         font-weight: bolder;
         cursor: pointer;
         width: 100%;
         height: 100%;
       }



     }



     </style>

     <nav>
       <div class="logo">
         <img src="logocolorwhite.png" alt="">
         <h2>Partner Portal</h2>
       </div>

       <input type="checkbox" id='nav-toggle' class="nav-toggle">
       <label for="nav-toggle" class="nav-toggle-label"><span></span></label>

     <div class="dropdown">
       <!-- <button onclick="location.href = 'register_deal.php';"><a href="register_deal.php" class = "home">Register a Deal</a></button>
       <button onclick="location.href = 'change_status.php';"><a href="change_status.php" class = "home">Change deal Status</a></button>
       <button onclick="location.href = 'upload_docs.php';"><a href="upload_docs.php" class = "home">Upload Documents</a></button> -->
       <!-- <button onclick="location.href = 'demo.html';"><a href="demo.html" class = "home">Demo</a></button> -->

       <div class="downloads">
         <button>Datasheets and Case Studies</button>
         <ul>
           <!-- <li><a href="https://manager.galaxkey.com/downloads">Galaxkey Client</a></li> -->
           <li><button onclick="location.href = 'https://www.galaxkey.com/datasheets/';">Datasheets</button></li>
           <li><button onclick="location.href = 'https://www.galaxkey.com/case-studies/';">Case Studies</button></li>
           <!-- <li><a href="#">User Guide</a></li> -->
         </ul>
       <!-- </div>
       <button><a href="logout.php" class = "home">Logout</a></button>
     </div> -->
     </div>
     </nav>

      <div class="main-box">
           <div id="box">
             <form  method="post">
               <div class= 'form-heading'>Login</div>
               <input id="text" type="text" name="partner_email" value="" placeholder="username"><br><br>
               <input id="text" type="password" name="partner_password" value="" placeholder="password"><br><br>
               <input id="button" type="submit" name="" value="Login"><br><br>
               <!--<div class="sign-up-aref">
                  <a href="signup.php">Sign up</a><br>
              </div>-->
             </form>
           </div>
        <div class="welcome">
          <img src="logo_galaxkey" alt="">
          <h1>Welcome to the Partner Portal.</h1>
        </div>

      </div>

      <div class="footer-dark">
      <footer>
          <div class="container">
              <div class="row">
                  <div class="col-sm-6 col-md-3 item">
                      <h3>Connect</h3>
                      <ul>
                          <li><a href="https://www.galaxkey.com/contact/contact/">Contact Us</a></li>
                          <li><a href="https://www.galaxkey.com/contact/contact/">Book a demo</a></li>
                          <li><a href="https://www.galaxkey.com/contact/contact/">Try before you buy</a></li>
                      </ul>
                  </div>
                  <div class="col-sm-6 col-md-3 item">
                      <h3>About</h3>
                      <ul>
                          <li><a href="https://www.galaxkey.com/aboutgalaxkey/">Company</a></li>
                          <li><a href="https://www.galaxkey.com/aboutgalaxkey/our-executive-team/">Executive Team</a></li>
                          <li><a href="https://www.galaxkey.com/aboutgalaxkey/our-investment-team/">Investment Team</a></li>
                      </ul>
                  </div>
                  <div class="col-md-6 item text">
                      <h3>Galaxkey</h3>
                      <p>Your business deserves the best encryption. Protection for Emails, Documents and Secure file sharing</p>
                  </div>
                  <div class="col item social"><a href="https://en-gb.facebook.com/galaxkey/"><i class="icon ion-social-facebook"></i></a><a href="https://twitter.com/galaxkey"><i class="icon ion-social-twitter"></i></a><a href="https://www.linkedin.com/company/galaxkey-limited/"><i class="icon ion-social-linkedin"></i></a></div>
              </div>
              <p class="copyright">Galaxkey Limited © All rights reserved.</p>
          </div>
      </footer>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>


   </body>
 </html>
