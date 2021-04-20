<?php
session_start();
include('connection.php');
include('functions.php');

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  if(isset($_FILES['my_image']))
  {
    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];
    $partner_organization = $_SESSION['partner_organization'];

    if ($error === 0) {
      if ($img_size > 12500000) {
        echo "Sorry, your file is too large.";

      }else {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "jpeg", "png", "pdf");

        if (in_array($img_ex_lc, $allowed_exs)) {
          $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
          $img_upload_path = 'uploads/'. $new_img_name;
          move_uploaded_file($tmp_name, $img_upload_path);
          //echo $new_img_name;
          //echo $img_upload_path;
          echo $tmp_name . ",  " . $img_upload_path . ",  " . $new_img_name;

          //Insert into Database
          $query = "INSERT INTO kyc_docs (partner_organization, image_url, time_stamp) VALUES ('$partner_organization', '$img_upload_path', NOW())";
          mysqli_query($con, $query);
        }else {
          echo "You can't upload files of this type";
          //header("Location: index.php?error=$em");
        }
      }
    }else {
      echo "unknown error occurred!";
      //header("Location: index.php?error=$em");
    }
  }

  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload Your Documents</title>
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

  .second_container{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: auto;
    height: 15vh;
    background-repeat: repeat;
    overflow: hidden;
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
    transform: scaleY(0);
    transition: all 0.4s;
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

  .documents img{
    width: 25%;
    margin: auto;
  }

  .documents h2{
    margin: 20px;
    padding: 15px;
  }

  .documents{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 15px;

  }

  footer{
    min-height: 150%;
  }

  .for_bg{
    background-image: url("qbkls.png");
    min-height: 70vh;
  }

  .nav-toggle, .nav-toggle-label{
    display: none;
  }

  @media (max-width: 960px){

    .second_container{
      display: flex;
      flex-direction: column;
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
      <button onclick="location.href = 'register_deal.php';">Register a Deal</button>
      <button onclick="location.href = 'change_status.php';">Change deal Status</button>
      <button onclick="location.href = 'upload_docs.php';">Upload Documents</button>
      <button onclick="location.href = 'demo.html';">Demo</button>


      <div class="downloads">
        <button>Downloads</button>
        <ul>
          <li> <button onclick="location.href = 'https://manager.galaxkey.com/downloads';">Galaxkey Client</button></li>
          <li><button onclick="location.href = 'https://www.galaxkey.com/datasheets/';">Datasheets</button></li>
          <li><button onclick="location.href = 'https://www.galaxkey.com/case-studies/';">Case Studies</button></li>
          <li><button onclick="location.href = 'userguides.html';">User Guide</button></li>
        </ul>
      </div>
      <button onclick="location.href = 'logout.php';">Logout</button>
    </div>
  </nav>

  <div class="for_bg">
    <div class="second_container">
      <form method="post" enctype="multipart/form-data">

        <input type="file" name="my_image">

        <input type="submit"
        name="submit"
        value="Upload">

      </form>

    </div>


    <div class="documents">
      <?php

      $partner_organization_checker = $_SESSION['partner_organization'];
      $record_query = "SELECT image_url FROM kyc_docs
      WHERE partner_organization = '$partner_organization_checker' ";
      $result = mysqli_query($con, $record_query);
      if(!$result || mysqli_num_rows($result) == 0)
      {
        echo "No records found!";
      }
      else {
        echo "<h2>Uploaded Documents</h2>";

        while($row = mysqli_fetch_assoc($result)) {
          echo "<image src =" . $row['image_url'] . ">";
        }
      }


      ?>
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
