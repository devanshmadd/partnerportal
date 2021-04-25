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
  $user_name = $_POST['user_name'];
  $hashed_pass = password_hash($partner_password, PASSWORD_BCRYPT);
  $mail = new PHPMailer(true);
  $mail ->isSMTP();
  $mail ->Host="smtp.outlook.com";
  $mail ->Port=587;
  $mail ->SMTPSecure="tls";
  $mail ->SMTPAuth = true;
  $mail ->Username = "technical.executive.mea@galaxkey.com";
  $mail ->Password = "Apple_dummy_123";
  $mail ->SetFrom("technical.executive.mea@galaxkey.com");
  $mail ->addAddress("technical.executive.mea@galaxkey.com");
  $mail -> addAddress("business.executive.mea@galaxkey.com");
  //$mail ->addAddress("hassankhan825@gmail.com");
  $mail -> addAddress($partner_email);
  $mail ->IsHTML(true);
  $mail ->IsHTML(true);
  $mail -> SMTPOptions = array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));

  $query = "SELECT * FROM user_creds WHERE partner_email = '$partner_email'";
  $result = mysqli_query($con, $query);
  if($result && mysqli_num_rows($result)>0)
  {
    echo "User already exists!";
  }
  else {

    if(!empty($user_name) && !empty($partner_email) && !empty($partner_password) && !empty($partner_priv) && !empty($partner_organization))
    {
      //saving to database
      //$deal_id = random_num(6);
      $query = "INSERT INTO user_creds (user_name, partner_organization, partner_email, partner_password, partner_priv,signup_date) VALUES ('$user_name','$partner_organization', '$partner_email', '$hashed_pass', '$partner_priv',CURDATE())";
      mysqli_query($con, $query);
      $check_query = "SELECT * FROM user_creds WHERE partner_email = '$partner_email'";
      $result_check_query = mysqli_query($con, $check_query);
      if($result_check_query && mysqli_num_rows($result_check_query)>0)
      {
        $mail ->Subject="Partner Signed up";
        $html="<table><tr><td>Partner Organization:</td><td>$partner_organization</td></tr><tr><td>Partner Email:</td><td>$partner_email</td></tr><tr><td>Password:</td><td>$partner_password</td></tr></table>";
        $mail ->Body=$html;
        if($mail->send()){
          echo "Mail Sent";
        }else{
          echo "error occured";
        }
      header("Location: login.php");
      }
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
  <title>Sign up partner</title>
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

  h1, p, #output{width:100%;text-align:center;}

#output{min-height:50px;}

input, button{padding:4px 12px;border-radius:6px;outline:none;border:1px solid #888;text-align:center;margin:4px}


  </style>

  <div class="nav-bar">
    <nav>
      <div class="nav-logo">
        <img src="logo_galaxkey" alt="">
      </div>
      <ul class = "list-items">
        <li><button style = "background: white; font-size: 20px;" onclick="location.href = 'adminportal.html';">Home</button></li>
        <li><button style = "background: white; font-size: 20px;" onclick="location.href = 'backend_approval.php';">Deal Management</button></li>
      </ul>
    </nav>
  </div>

  <div class="main-box">

    <div class="welcome">
      <img src="logo_galaxkey" alt="">
      <h1>Sign up the partner.</h1>
    </div>
    <div id="box">
      <form  method="post">
        <div class= 'form-heading'>Sign up the Partner!</div>
        <input id="text" type="text" name="user_name" value="" placeholder="Name"><br><br>
        <input id="text" type="text" name="partner_organization" value="" placeholder="organization"><br><br>
        <input id="text" type="text" name="partner_email" value="" placeholder="username"><br><br>
        <input id="text" type="password" name="partner_password" value="" placeholder="password"><br><br>
        <input id="text" type="text" name="partner_priv" value="" placeholder="privilege"><br><br>
        <input id="button" onclick=myfunction() type="submit" name="" value="Sign up"><br><br>
        <script>
        function myFunction() {
          alert("User has been signed up. They have been notified as well with their credentials.\nClick OK. ");
        }
        </script>
      </form>
    </div>


  </div>
  <div class="footer">
    <div class="copyright">
      Copyright © Galaxkey Limited 2021
    </div>

  </div>
</body>
</html>
