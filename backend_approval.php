<?php

session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted

    $deal_id = $_POST['deal_id'];
    $partner_organization = $_POST['partner_organization'];
    $partner_email = $_POST['partner_email'];
    $deal_status_init = $_POST['deal_status'];
    $deal_status = $_POST['subcategory'];
    $expiry_date = $_POST['expiry_date'];
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
    $mail ->addAddress("business.executive.mea@galaxkey.com");
    $mail ->addAddress($partner_email);
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
        if(!empty($deal_id) && !empty($partner_organization) && !empty($partner_email) && !empty($deal_status_init) && !empty($expiry_date))
        {

            if($deal_status_init == 'ACTIVE' && !empty($deal_status)){
              $update_query = "UPDATE deals SET status = '$deal_status', deal_date = CURDATE(), expiry_date = '$expiry_date' WHERE deal_id = '$deal_id';";
              mysqli_query($con, $update_query);
              $check_query = "SELECT * FROM deals WHERE deal_id = '$deal_id' AND partner_email = '$partner_email' AND status = '$deal_status';";
              $result_check_query = mysqli_query($con, $check_query);
              $row = mysqli_num_rows($result_check_query);
              if($row == 1){
                    $mail ->Subject="Deal Approved";
                    $html="<p>Your deal with the following details has been approved.</p><br><br><table><tr><td>Deal ID:</td><td>$deal_id</td></tr><tr><td>Partner Organization:</td><td>$partner_organization</td></tr><tr><td>Partner Email:</td><td>$partner_email</td></tr><tr><td>Status:</td><td>$deal_status</td></tr></table>";
                    $mail ->Body=$html;
                    if($mail->send()){
                      echo "Mail Sent";
                    }else{
                      echo "error occured";
                    }
              }
              else {
                echo "Error has occured!";
              }
            }

            elseif ($deal_status_init == "INACTIVE") {
              $update_query = "UPDATE deals SET status = '$deal_status_init' WHERE deal_id = '$deal_id';";
              mysqli_query($con, $update_query);
              $check_query = "SELECT * FROM deals WHERE deal_id = '$deal_id' AND partner_email = '$partner_email' AND status = '$deal_status_init';";
              $result_check_query = mysqli_query($con, $check_query);
              $row = mysqli_num_rows($result_check_query);
              if($row == 1){
                    $mail ->Subject="Deal Inactivated";
                    $html="<p>Your deal with the following details has been inactivated.</p><br><br><table><tr><td>Deal ID:</td><td>$deal_id</td></tr><tr><td>Partner Organization:</td><td>$partner_organization</td></tr><tr><td>Partner Email:</td><td>$partner_email</td></tr><tr><td>Status :</td><td>$deal_status_init</td></tr></table>";
                    $mail ->Body=$html;
                    if($mail->send()){
                      echo "Mail Sent";
                    }else{
                      echo "error occured";
                    }
            }
            else{
              echo "Error has occured";
            }

        }
        else {
          echo 'Please enter all the information!';
        }
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

     <!-- <link href = "w3.css" rel = "stylesheet"/> -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
          height: auto;
          padding: 40px;
          background: linear-gradient(180deg, #DBDBDB, #EAEAEA);
          background-image: url("qbkls.png");
          background-repeat: repeat;

          align-items: center;
          justify-content: space-between;
          background-color:rgba(0, 0, 0, 0.5);"
          /*background-color: #ef473a;*/
        }


        #records{
          border-radius: 15px;
          display: flex;
          flex-direction: column;
          align-items: center;
          max-width: 70%;
          background: #fff;
          padding: 10px 17px;
          -webkit-box-shadow: 2px 2px 3px -1px rgba(0,0,0,0.35);
          height: 50vh;
          margin: auto;
          overflow: auto;
        }

        #records h2{
          margin: 15px;
          padding: 15px;
        }

        .keywords{
          margin: 0 auto;
          font-size: 1.2em;
          margin-bottom: 15px;
        }

        .keywords thead{
          cursor: pointer;
          background: #c9dff0;
        }

        .keywords thead tr th {
          font-weight: bold;
          padding: 12px 30px;
          padding-left: 42px;
        }

        .keywords thead tr th span {
          /*padding-right: 20px;*/
          background-repeat: no-repeat;
          background-position: 100% 100%;
        }


        .keywords tbody tr {
          color: #555;
        }

        .keywords tbody tr td {
          text-align: center;
          padding: 15px 10px;
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

        @media (max-width: 1200px){

          .main-box{
            display: flex;
            flex-direction: column;
          }
          #box{
            margin-block: 15px;
            min-width: 90%;
            min-height: 100%;
          }

          #box form{
            max-width: 100%;
          }


          #records{
            min-width: 90%;
          }
          .keywords{
            font-size: 1.25rem;
          }
          .keywords thead{
            font-size: 1rem;
          }




        }


        h1, p, #output{width:100%;text-align:center;}

#output{min-height:50px;}

input, button{padding:4px 12px;border-radius:6px;outline:none;border:1px solid #888;text-align:center;margin:4px}


        #dt {
  text-indent: -500px;
  height: 25px;
  width: 200px;
}

        </style>

        <div class="nav-bar">
          <nav>
            <div class="nav-logo">
              <img src="logo_galaxkey" alt="">
            </div>
            <ul class = "list-items">
              <li><button style = "background: white; font-size: 20px;" onclick="location.href = 'adminportal.html';">Home</button></li>
              <li><button style = "background: white; font-size: 20px;" onclick="location.href = 'signup.php';">Sign up a partner</button></li>

            </ul>
          </nav>
        </div>



      <div class="main-box">

        <!-- <div class="welcome">
          <img src="logo_galaxkey" alt="">
          <h1>Deal Approval Portal</h1>
        </div> -->

           <br><div id="box">
             <form  method="post">
               <div class= 'form-heading'>Deal approval form.<br>(Fill the details based on the details in the mail received.)</div>
               <input id="text" type="text" name="deal_id" value="" placeholder="Enter Deal ID"><br><br>
               <input id="text" type="text" name="partner_organization" value="" placeholder="organization"><br><br>
               <input id="text" type="text" name="partner_email" value="" placeholder="username"><br><br>
               <!-- <input id="text" type="text" name="deal_date" value="" placeholder="deal date"><br><br> -->


               <label for="expiry_date">Deal Expiry Date:</label>
              <input type="date" id="expiry_date" name="expiry_date">



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
               <input id="button" onclick = myFunction() type="submit" name="" value="Update deal"><br><br>
               <script>
               function myFunction() {
                 alert("Deal status have been updated. \nClick OK. ");
               }
               </script>
             </form>
           </div>


           <div id="records">
             <h2>Your current deal records are:</h2>
             <table id="mytable" class='keywords'>
               <!-- 'keywords' 'w3-table-all' -->
               <thead>
                 <tr>
                   <th>Deal ID</th>
                   <th>Partner organisation</th>
                   <th>Partner Name</th>
                   <th>Partner Email</th>
                   <th><span>Customer Name</span></th>
                   <th><span>Implementation Preference</span></th>
                   <th><span>Number of end users</span></th>
                   <th><span>Expected Closure</span></th>
                   <th><span>Require Budgeted</span></th>
                   <th><span>Decision Maker</span></th>
                   <th><span>Designation</span></th>
                   <th><span>Email</span></th>
                   <th><span>Phone number</span></th>
                   <th><span>Deal Status</span></th>
                   <th><span>Deal Date</span></th>
                   <th><span>Deal Expiry</span></th>
                 </tr>

               </thead>
               <tbody>



                 <?php

                   $record_query = "SELECT * FROM deals";
                   $result = mysqli_query($con, $record_query);
                   if(!$result || mysqli_num_rows($result) == 0)
                   {
                     echo "<div>No records found!</div>";
                   }
                   else {
                     while($row = mysqli_fetch_assoc($result)) {
                       // echo "<tr><td>".$row["deal_id"]."</td><td>".$row["partner_organization"]."</td><td>".$row["partner_name"]."</td><td>".$row["partner_email"]."</td></tr>";

                        echo "<tr><td>".$row["deal_id"]."</td><td>".$row["partner_organization"]."</td><td>".$row["partner_name"]."</td><td>".$row["partner_email"]."</td><td>".$row["name_customer"]."</td><td>".$row["number_end_users"]."</td><td>".$row["expected_closure"]."</td><td>".$row["req_bud"]."</td><td>".$row["name_decision_maker"]."</td><td>".$row["designation_decision_maker"]."</td><td>".$row["designation_decision_maker"]."</td><td>".$row["email_decision_maker"]."</td><td>".$row["phone_decision_maker"]."</td><td>".$row['status']."</td><td>".$row["deal_date"]."</td><td>".$row["expiry_date"]."</td></tr>";
                     }
                   }
                 echo "</tbody> </table>";

                 ?>
               </div>
      </div>


      <div class="footer">
        <div class="copyright">
          Copyright © Galaxkey Limited 2021
        </div>

      </div>

      <script src = "ddtf.js"></script>
      <script>
        $('#mytable').ddTableFilter();
      </script>


   </body>
 </html>
