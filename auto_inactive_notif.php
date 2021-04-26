
<?php

session_start();
include("connection.php");
include('smtp/PHPMailerAutoload.php');



//Auto Inactive deal where expiry passed for more than 2 days

  echo "Entering Auto inactive deals where expiry has passed more than two days";
  $cred_query = "SELECT * FROM deals WHERE expiry_date IS NOT NULL AND DATEDIFF(CURDATE(), expiry_date)=2 AND status<>'Inactive';";
  $cred_result = mysqli_query($con, $cred_query);
  $cred_rows = mysqli_num_rows($cred_result);



  $inactive_mail = new PHPMailer(true);
  $inactive_mail ->isSMTP();
  $inactive_mail ->Host="smtp.outlook.com";
  $inactive_mail ->Port=587;
  $inactive_mail ->SMTPSecure="tls";
  $inactive_mail ->SMTPAuth = true;
  $inactive_mail ->Username = "technical.executive.mea@galaxkey.com";
  $inactive_mail ->Password = "Apple_dummy_123";
  $inactive_mail ->SetFrom("technical.executive.mea@galaxkey.com");
  $inactive_mail ->IsHTML(true);
  $inactive_mail ->IsHTML(true);
  $inactive_mail ->Subject="Deal Inactivated!";
  $inactive_mail -> SMTPOptions = array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));



  if(!$cred_result || $cred_rows == 0)
  {
    echo "\nNo deals left to be approved.";
  }
  else {
    echo "in else";
    while($cred_array = mysqli_fetch_assoc($cred_result)){
      $partner_name2 = $cred_array["partner_name"];
      $deal_id2 = $cred_array["deal_id"];
      $partner_organization2 =$cred_array["partner_organization"];
      $partner_email2 = $cred_array["partner_email"];
      $name_customer2 = $cred_array["name_customer"];
      $deal_date2 = $cred_array["deal_date"];
      echo $partner_email2 . " " . $partner_organization2 . " " . $name_customer2 . " " . $deal_id2 . " " . $deal_date2 . "\n";
      $html="<p>Due to no further updates, deal status have been set to INACTIVE for the deals with the following details:</p><br><br><table><tr><td>User Name:</td><td>$partner_name2</td></tr><tr><td>Organization: </td><td>$partner_organization2</td></tr><tr><td>Deal ID:</td><td>$deal_id2</td><tr><td>Customer Name: </td><td>$name_customer2</td></tr><tr><td>Deal Status: </td><td>Set to Inactive.</td></tr></table>";
      $inactive_mail ->Body=$html;
      $inactive_mail ->addAddress("technical.executive.mea@galaxkey.com");
      $inactive_mail ->addAddress("business.executive.mea@galaxkey.com");
      $inactive_mail ->addAddress($partner_email2);
        if($inactive_mail->send()){
          echo "\nUpdate notification sent to Galaxkey\n";
        }else{
          echo "\nerror occured";
        }
    }
    $inactive_days_query = "UPDATE deals SET status = 'Inactive' WHERE expiry_date IS NOT NULL AND DATEDIFF(CURDATE(), expiry_date)=2 AND status<>'Inactive';";
    mysqli_query($con, $inactive_days_query);

  }
