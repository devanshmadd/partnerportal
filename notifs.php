
<?php

session_start();
include("connection.php");
include('smtp/PHPMailerAutoload.php');

$days_num_query = "SELECT *,DATEDIFF(expiry_date, CURDATE()) AS days_active FROM deals WHERE DATEDIFF(expiry_date, CURDATE())=5;";
$result = mysqli_query($con, $days_num_query);
$row = mysqli_fetch_assoc($result);
$days_num = $row["days_active"];
$partner_name = $row["partner_name"];
$deal_id = $row["deal_id"];
$partner_organization =$row["partner_organization"];

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


$i=mysqli_num_rows($result);
if(!$result || $i == 0)
{
  echo "All deals updated";
}

else {
  while($i--){
      if($mail->send()){
        echo "mz";
      }else{
        echo "error occured";
      }
  }
}

 ?>
