<?php

session_start();

include("connection.php");
include("functions.php");
include('smtp/PHPMailerAutoload.php');

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted

    $deal_id = $_POST['deal_id'];
    $partner_organization = $_POST['partner_organization'];
    $partner_email = $_POST['partner_email'];
    $deal_status_init = $_POST['deal_status'];
    $deal_status = $_POST['subcategory'];
    $days_active = $_POST['days_active'];
    // $deal_date = $_POST['deal_date'];
    $query = "SELECT * FROM deals WHERE deal_id = '$deal_id'";
    $result = mysqli_query($con, $query);

    $mail = new PHPMailer(true);
    $mail ->isSMTP();
    $mail ->Host="smtp.outlook.com";
    $mail ->Port=587;
    $mail ->SMTPSecure="tls";
    $mail ->SMTPAuth = true;
    $mail ->Username = "technical.executive.mea@galaxkey.com";
    $mail ->Password = "Apple_dummy_123";
    $mail ->SetFrom("technical.executive.mea@galaxkey.com");
    $mail ->addAddress("devansh.madd99@gmail.com");
    $mail ->addAddress("hassankhan825@gmail.com");
    $mail ->IsHTML(true);
    $mail ->IsHTML(true);
    $mail -> SMTPOptions = array('ssl'=>array(
      'verify_peer'=>false,
      'verify_peer_name'=>false,
      'allow_self_signed'=>false
    ));

    if($result && mysqli_num_rows($result)>0)
    {
      $row = mysqli_fetch_assoc($result);
      if ($row["status"] == $deal_status) {
          echo "Deal has the same status. Please change according to request!";
      }
      else {
        if(!empty($deal_id) && !empty($partner_organization) && !empty($partner_email) && !empty($deal_status_init) && !empty($days_active))
        {
          //saving to database
          //$deal_id = random_num(6);

            if($deal_status_init == 'ACTIVE' && !empty($deal_status)){
              $update_query = "UPDATE deals SET status = '$deal_status', days_active = '$days_active', deal_date = CURDATE() WHERE deal_id = '$deal_id';";
              mysqli_query($con, $update_query);
              echo "Hogaya bey";
              $mail ->Subject="Deal Approved";
              $html="<table><tr><td>Deal ID:</td><td>$deal_id</td></tr><tr><td>Partner Organization:</td><td>$partner_organization</td></tr><tr><td>Partner Email:</td><td>$partner_email</td></tr><tr><td>Status:</td><td>$deal_status</td></tr></table>";
              $mail ->Body=$html;
              if($mail->send()){
                echo "Mail Sent";
              }else{
                echo "error occured";
              }
            }
            elseif ($deal_status_init == "INACTIVE") {
              $update_query = "UPDATE deals SET status = '$deal_status_init' WHERE deal_id = '$deal_id';";
              mysqli_query($con, $update_query);
              echo "Hogaya bey";
              $mail ->Subject="Deal Inactivated";
              $html="<table><tr><td>Deal ID:</td><td>$deal_id</td></tr><tr><td>Partner Organization:</td><td>$partner_organization</td></tr><tr><td>Partner Email:</td><td>$partner_email</td></tr><tr><td>Status :</td><td>$deal_status_init</td></tr></table>";
              $mail ->Body=$html;
              if($mail->send()){
                echo "Mail Sent";
              }else{
                echo "error occured";
              }
            }

        }
        else {
          echo 'Please enter all the information!';
        }
      }

    }
    else {
      echo 'No such record!';

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
     <title>Deal Request approval</title>
     <script language="javascript" type="text/javascript">
     function dynamicdropdown(listindex)
     {
     document.getElementById("subcategory").length = 0;
     switch (listindex)
     {
     case "ACTIVE" :
     document.getElementById("subcategory").style.display= "flex";
     document.getElementById("")
     document.getElementById("subcategory").options[0]=new Option("Please select the detailed status","");
     document.getElementById("subcategory").options[1]=new Option("Approved","Approved");
     document.getElementById("subcategory").options[2]=new Option("Lead Generated","Lead Generated");
     document.getElementById("subcategory").options[3]=new Option("Product Demonstration Completed","Product Demonstration Completed");
     document.getElementById("subcategory").options[4]=new Option("Proof of Value","Proof of Value");
     document.getElementById("subcategory").options[5]=new Option("Quotes Shared","Quotes Shared");
     document.getElementById("subcategory").options[6]=new Option("Technical Win","Technical Win");
     document.getElementById("subcategory").options[7]=new Option("Business Win","Business Win");
     document.getElementById("subcategory").options[8]=new Option("Won","Won");
     document.getElementById("subcategory").options[9]=new Option("Differed","Differed");
     document.getElementById("subcategory").options[10]=new Option("Lost","Lost");
     break;
     case "INACTIVE" :
     document.getElementById("subcategory").style.display= "none";
     break;
     }
     return true;
     }
     </script>
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

     <!-- <div class="nav-bar">
         <nav>
           <div class="nav-logo">
             <img src="logo_galaxkey" alt="">
           </div>
               <ul class = "list-items">
               <li><a href="https://www.galaxkey.com/aboutgalaxkey/" target="_blank">About</a></li>
               <li><a href="https://www.galaxkey.com/contact/contact/" target="_blank">Contact</a></li>
             </ul>
         </nav>
     </div> -->

     <div class="welcome">
       <img src="logo_galaxkey" alt="">
       <h1>Deal Approval Portal</h1>
     </div>

      <div class="main-box">
           <div id="box">
             <form  method="post">
               <div class= 'form-heading'>Deal details<br>(Please copy the details from the email sent to you)</div>
               <input id="text" type="text" name="deal_id" value="" placeholder="Enter Deal ID"><br><br>
               <input id="text" type="text" name="partner_organization" value="" placeholder="organization"><br><br>
               <input id="text" type="text" name="partner_email" value="" placeholder="username"><br><br>
               <!-- <input id="text" type="text" name="deal_date" value="" placeholder="deal date"><br><br> -->


               <label for="start">Expiry date:</label>
                <input type="date" id="start" name="trip-start"
                value=""
                min="2009-12-31" max="2021-12-31">

                <script>
                n =  new Date();
                y = n.getFullYear();
                m = n.getMonth() + 1;
                d = n.getDate();
                document.getElementById("start").innerHTML = y + "/" + m + "/" + d;
                </script>


               <h3>Select deal status:</h3>
               <br>
               <div class="options">
                 <select name="deal_status" onchange="javascript: dynamicdropdown(this.options[this.selectedIndex].value);">
                                  <option value="Select Deal Status">Select Deal Status</option>
                   <option value="ACTIVE">ACTIVE</option>
                   <option value="INACTIVE">INACTIVE</option>
                 </select><br>


                                  <div class="sub_category_div" id="sub_category_div" >
                                 <br>
                                  <script type="text/javascript" language="JavaScript">
                                  document.write('<select name="subcategory" id="subcategory"><option value="">Please select the detailed status as well</option></select>')
                                  </script>
                                  <noscript>
                                  <br>
                                  <select name="subcategory" id="subcategory" style= "width: 100%;">
                                  <option value="">Please select the detailed status as well</option>
                                  </select>
                                  </noscript>
                                  </div>

             </div>
             <br>
             <br>
               <input id="button" type="submit" name="" value="Update deal"><br><br>
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
