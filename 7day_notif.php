<?php

session_start();
include("connection.php");
include('smtp/PHPMailerAutoload.php');



//7 days approval pending from Galaxkey end

echo "\nEntering 7 day approval pending requests:";
$req_days_query = "SELECT * FROM deals WHERE DATEDIFF(CURDATE(), deal_date)=7 AND expiry_date IS NULL AND status = 'Requested';";
$req_days_result = mysqli_query($con, $req_days_query);
$row1 = mysqli_num_rows($req_days_result);
echo $row1;

$req_pending_mail = new PHPMailer(true);
$req_pending_mail ->isSMTP();
$req_pending_mail ->Host="smtp.outlook.com";
$req_pending_mail ->Port=587;
$req_pending_mail ->SMTPSecure="tls";
$req_pending_mail ->SMTPAuth = true;
$req_pending_mail ->Username = "technical.executive.mea@galaxkey.com";
$req_pending_mail ->Password = "Apple_dummy_123";
$req_pending_mail ->SetFrom("technical.executive.mea@galaxkey.com");
$req_pending_mail ->IsHTML(true);
$req_pending_mail ->IsHTML(true);
$req_pending_mail ->Subject="Reminder: Deal Approval Pending from Galaxkey end!";
$req_pending_mail -> SMTPOptions = array('ssl'=>array(
  'verify_peer'=>false,
  'verify_peer_name'=>false,
  'allow_self_signed'=>false
));

if(!$req_days_result || $row1 == 0)
{
  echo "\nNo deals left to be approved.";
}
else {
  while($result_row1 = mysqli_fetch_assoc($req_days_result)){
    $partner_name1 = $result_row1["partner_name"];
    $deal_id1 = $result_row1["deal_id"];
    $partner_organization1 =$result_row1["partner_organization"];
    $partner_email1 = $result_row1["partner_email"];
    $name_customer1 = $result_row1["name_customer"];
    $deal_date1 = $result_row1["deal_date"];
    echo $partner_email1 . " " . $partner_organization1 . " " . $name_customer1 . " " . $deal_id1 . " " . $deal_date1 . "\n";
    $html="<p>Please update deal pending request with the following details:</p><br><br><table><tr><td>User Name:</td><td>$partner_name1</td></tr><tr><td>Organization: </td><td>$partner_organization1</td></tr><tr><td>Deal ID:</td><td>$deal_id1</td></tr><tr><td>Customer Name: </td><td>$name_customer1</td></tr><tr><td>Deal Status: </td><td>Pending Approval</td></tr></table>";
    $req_pending_mail ->Body=$html;
    $req_pending_mail ->addAddress("technical.executive.mea@galaxkey.com");
    $req_pending_mail ->addAddress("business.executive.mea@galaxkey.com");
      if($req_pending_mail->send()){
        echo "\nUpdate notification sent to Galaxkey\n";
      }else{
        echo "\nerror occured";
      }
  }
}
