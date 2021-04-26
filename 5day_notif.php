<?php

session_start();
include("connection.php");
include('smtp/PHPMailerAutoload.php');

//Notifying 5 days before expiry


$days_num_query = "SELECT * FROM deals WHERE expiry_date IS NOT NULL AND DATEDIFF(expiry_date, CURDATE())=5 AND status <> 'Inactive';";
$result = mysqli_query($con, $days_num_query);


$mail = new PHPMailer(true);
$mail ->isSMTP();
$mail ->Host="smtp.outlook.com";
$mail ->Port=587;
$mail ->SMTPSecure="tls";
$mail ->SMTPAuth = true;
$mail ->Username = "technical.executive.mea@galaxkey.com";
$mail ->Password = "Apple_dummy_123";
$mail ->SetFrom("technical.executive.mea@galaxkey.com");
$mail ->IsHTML(true);
$mail ->IsHTML(true);
$mail ->Subject="Reminder: Update deal before expiry!";
$mail -> SMTPOptions = array('ssl'=>array(
  'verify_peer'=>false,
  'verify_peer_name'=>false,
  'allow_self_signed'=>false
));

if(!$result || mysqli_num_rows($result) == 0)
{
  echo "All deals updated";
}
else {
  //echo $result_row;
  while($result_row = mysqli_fetch_assoc($result)){
    $partner_name = $result_row["partner_name"];
    $partner_email = $result_row["partner_email"];
    $partner_organization = $result_row["partner_organization"];
    $name_customer = $result_row["name_customer"];
    $deal_status = $result_row["status"];
    $deal_id = $result_row["deal_id"];
    $deal_expiry = $result_row["expiry_date"];
    echo $partner_email . " " . $partner_organization . " " . $name_customer . " " . $deal_id . " " . $deal_expiry . "\n";
    $html="<table><tr><td>Name:</td><td>$partner_name</td></tr><tr><td>Organization: </td><td>$partner_organization</td></tr><tr><td>Deal ID:</td><td>$deal_id</td><tr><td>Customer Name: </td><td>$name_customer</td><tr><td>Current Deal Status: </td><td>$deal_status</td></tr></table>";
    $mail ->Body=$html;
    $mail ->addAddress($partner_email);
    $mail ->addAddress("technical.executive.mea@galaxkey.com");
    if($mail->send()){
     echo "Partner has been sent a mail to update the deal.\n";
    }else{
         echo "error occured";
   }
 }
}
