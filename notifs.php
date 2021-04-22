
<?php

session_start();
include("connection.php");
include('smtp/PHPMailerAutoload.php');

//Notifying 5 days before expiry

echo "\nEntering 5 day before expiry update requests:";
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
    $client_organization = $result_row["client_name"];
    $deal_id = $result_row["deal_id"];
    $deal_expiry = $result_row["expiry_date"];
    echo $partner_email . " " . $partner_organization . " " . $client_organization . " " . $deal_id . " " . $deal_expiry . "\n";
    $html="<table><tr><td>Name:</td><td>$partner_name</td></tr><tr><td>Deal ID:</td><td>$deal_id</td><tr><td>Organization: </td><td>$partner_organization</td><tr><td>Deal Status: </td><td>Pending Approval</td></tr></table>";
    $mail ->Body=$html;
    $mail ->addAddress($partner_email);
    $mail ->addAddress("devansh.madd99@gmail.com");
    if($mail->send()){
     echo "Partner has been sent a mail to update the deal.\n";
    }else{
         echo "error occured";
   }
 }
}


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
    $client_organization1 = $result_row1["client_name"];
    $deal_date1 = $result_row1["deal_date"];
    echo $partner_email1 . " " . $partner_organization1 . " " . $client_organization1 . " " . $deal_id1 . " " . $deal_date1 . "\n";
    $html="<p>Please update deal pending request with the following details:</p><br><br><table><tr><td>User Name:</td><td>$partner_name1</td></tr><tr><td>Deal ID:</td><td>$deal_id1</td><tr><td>Organization: </td><td>$partner_organization1</td><tr><td>Deal Status: </td><td>Pending Approval</td></tr></table>";
    $req_pending_mail ->Body=$html;
    $req_pending_mail ->addAddress("devansh.madd99@gmail.com");
    $req_pending_mail ->addAddress("business.executive.mea@galaxkey.com");
      if($req_pending_mail->send()){
        echo "\nUpdate notification sent to Galaxkey\n";
      }else{
        echo "\nerror occured";
      }
  }
}

//Auto Inactive deal where expiry passed for more than 2 days

  echo "Entering Auto inactive deals where expiry has passed more than two days";
  $inactive_days_query = "UPDATE deals SET status = 'Inactive' WHERE expiry_date IS NOT NULL AND DATEDIFF(CURDATE(), expiry_date)=2 AND status<>'Inactive';";
  $result2 = mysqli_query($con, $inactive_days_query);
  $i=mysqli_num_rows($result2);
  echo $i;

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
  $inactive_mail ->Subject="Reminder: Deal status changed due to inactivity.";
  $html="<table><tr><td>User Name:</td><td>$partner_name</td></tr><tr><td>Deal ID:</td><td>$deal_id</td><tr><td>Organization: </td><td>$partner_organization</td><tr><td>Deal Status: </td><td>Pending Approval</td></tr></table>";
  $inactive_mail ->Body=$html;
  $inactive_mail -> SMTPOptions = array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));


  $cred_query = "SELECT * FROM deals WHERE expiry_date IS NOT NULL AND DATEDIFF(CURDATE(), expiry_date)=2 AND status<>'Inactive';";
  $result_row2 = mysqli_query($con,$cred_query);


  if(!$cred_query || $row1 == 0)
  {
    echo "\nAll deals are up to date";
  }
  else {
    while($result_row2 = mysqli_fetch_assoc($cred_query)){
      $partner_name2 = $result_row2["partner_name"];
      $deal_id2 = $result_row2["deal_id"];
      $partner_organization2 =$result_row2["partner_organization"];
      $partner_email2 = $result_row2["partner_email"];
      $client_organization2 = $result_row2["client_name"];
      $deal_expiry2 = $result_row2["deal_expiry"];
      echo $partner_email2 . " " . $partner_organization2 . " " . $client_organization2 . " " . $deal_id2 . " " . $deal_expiry2 . "\n";
      $html="<p>Due to no further updates, deal status have been set to INACTIVE for the deals with the following details:</p><br><br><table><tr><td>User Name:</td><td>$partner_name2</td></tr><tr><td>Deal ID:</td><td>$deal_id2</td><tr><td>Organization: </td><td>$partner_organization2</td><tr><td>Deal Status: </td><td>Set to Inactive.</td></tr></table>";
      $req_pending_mail ->Body=$html;
      $inactive_mail ->addAddress($partner_email2);
      $inactive_mail ->addAddress("devansh.madd99@gmail.com");
        if($inactive_mail->send()){
          echo "\nPartner has been sent a mail regarding the inactive status of the deal.\n";
        }else{
          echo "\nerror occured";
        }
    }
  }
 ?>
