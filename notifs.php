<?php

session_start();
include("connection.php");

echo "sup";

$days_num_query = "SELECT * FROM deals WHERE DATEDIFF()
$result = mysqli_query($con, $days_num_query);

$days_num = $row['days_active'];
include('smtp/PHPMailerAutoload.php');
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
$mail ->addAddress("business.executive.mea@galaxkey.com");
$mail ->addAddress("hassankhan825@gmail.com");
$mail ->IsHTML(true);
$mail ->IsHTML(true);
$mail ->Subject="Reminder: Update deal!";
$html="<table><tr><td>User Name:</td><td>$partner_name</td></tr><tr><td>Deal ID:</td><td>$deal_id</td><tr><td>Organization: </td><td>$partner_organization</td><tr><td>Deal Status: </td><td>Pending Approval</td></tr></table>";
$mail ->Body=$html;
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
  while($row = mysqli_fetch_assoc($result)){
      //if($mail->send()){
        echo "Mail Sent";
  }
}







 ?>
