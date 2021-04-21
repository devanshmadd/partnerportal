
<?php

session_start();
include("connection.php");
include('smtp/PHPMailerAutoload.php');

$days_num_query = "SELECT partner_name,deal_id,partner_organization,DATEDIFF(expiry_date, CURDATE()) AS days_active FROM deals WHERE DATEDIFF(expiry_date, CURDATE())=5 AND status <> 'Inactive';";
$result = mysqli_query($con, $days_num_query);
$result_row = mysqli_fetch_assoc($result);
$partner_name = $result_row["partner_name"];
$deal_id = $result_row["deal_id"];
$partner_organization =$result_row["partner_organization"];

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
        echo "Send update notif to partner\n";
      }else{
        echo "error occured";
      }
  }
}





$req_pending_mail = new PHPMailer(true);
$req_pending_mail ->isSMTP();
$req_pending_mail ->Host="smtp.outlook.com";
$req_pending_mail ->Port=587;
$req_pending_mail ->SMTPSecure="tls";
$req_pending_mail ->SMTPAuth = true;
$req_pending_mail ->Username = "technical.executive.mea@galaxkey.com";
$req_pending_mail ->Password = "Apple_dummy_123";
$req_pending_mail ->SetFrom("technical.executive.mea@galaxkey.com");
$req_pending_mail ->addAddress("devansh.madd99@gmail.com");
$req_pending_mail ->addAddress("business.executive.mea@galaxkey.com");
$req_pending_mail ->addAddress("hassankhan825@gmail.com");
$req_pending_mail ->IsHTML(true);
$req_pending_mail ->IsHTML(true);


$req_days_query = "SELECT *,DATEDIFF(CURDATE(),deal_date) AS days_requested FROM deals WHERE DATEDIFF(CURDATE(), deal_date)=7 AND expiry_date IS NULL AND status = 'Requested';";
$req_days_result = mysqli_query($con, $req_days_query);
$row1 = mysqli_num_rows($req_days_result);
$result_row1 = mysqli_fetch_assoc($req_days_result);
$partner_name1 = $result_row1["partner_name"];
$deal_id1 = $result_row1["deal_id"];
$partner_organization1 =$result_row1["partner_organization"];
echo $row1;


$req_pending_mail ->Subject="Reminder: Approval Pending!";
$html="<p>Please update deal pending request with the following details:</p><br><br><table><tr><td>User Name:</td><td>$partner_name</td></tr><tr><td>Deal ID:</td><td>$deal_id</td><tr><td>Organization: </td><td>$partner_organization</td><tr><td>Deal Status: </td><td>Pending Approval</td></tr></table>";
$req_pending_mail ->Body=$html;
$req_pending_mail -> SMTPOptions = array('ssl'=>array(
  'verify_peer'=>false,
  'verify_peer_name'=>false,
  'allow_self_signed'=>false
));

if(!$req_days_result || $row1 == 0)
{
  echo "No deals in request";
}

else {
  while($row1--){
      if($req_pending_mail->send()){
        echo "Send update notif to Galaxkey\n";
      }else{
        echo "error occured";
      }
  }
}


 ?>
