
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
    $deal_id = $result_row["deal_id"];
    $deal_expiry = $result_row["expiry_date"];
    echo $partner_email . " " . $partner_organization . " " . $name_customer . " " . $deal_id . " " . $deal_expiry . "\n";
    $html="<table><tr><td>Name:</td><td>$partner_name</td></tr><tr><td>Organization: </td><td>$partner_organization</td></tr><tr><td>Deal ID:</td><td>$deal_id</td><tr><td>Customer Name: </td><td>$name_customer</td><tr><td>Deal Status: </td><td>Pending Approval</td></tr></table>";
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


//upload docs in 2 weeks

$docs_query = "SELECT * FROM user_creds WHERE DATEDIFF(CURDATE(), signup_date)=14";
$docs_result = mysqli_query($con, $docs_query);


$docs_mail = new PHPMailer(true);
$docs_mail ->isSMTP();
$docs_mail ->Host="smtp.outlook.com";
$docs_mail ->Port=587;
$docs_mail ->SMTPSecure="tls";
$docs_mail ->SMTPAuth = true;
$docs_mail ->Username = "technical.executive.mea@galaxkey.com";
$docs_mail ->Password = "Apple_dummy_123";
$docs_mail ->SetFrom("technical.executive.mea@galaxkey.com");
$docs_mail ->IsHTML(true);
$docs_mail ->IsHTML(true);
$docs_mail ->Subject="Reminder: Upload documents!";
$docs_mail -> SMTPOptions = array('ssl'=>array(
  'verify_peer'=>false,
  'verify_peer_name'=>false,
  'allow_self_signed'=>false
));

if(!$docs_result || mysqli_num_rows($docs_result) == 0)
{
  echo "All deals updated";
  echo mysqli_num_rows($docs_result);
}
else {
  //echo $result_row;
  while($docs_result_row = mysqli_fetch_assoc($docs_result)){
    $partner_email3 = $docs_result_row["partner_email"];
    $partner_organization3 = $docs_result_row["partner_organization"];
    echo $partner_email3;
    $doc_check_query = "SELECT * FROM kyc_docs WHERE partner_organization = '$partner_organization3'";
    $doc_check_result = mysqli_query($con, $doc_check_query);
    if(!$doc_check_result || mysqli_num_rows($doc_check_result)==0)
    {
      echo "in mail loop";
      $html="Please upload the relevant documents at the Galaxkey Partner Portal! Your account will be deactivated in 4 days.";
      $docs_mail ->Body=$html;
      $docs_mail ->addAddress($partner_email3);
      $docs_mail ->addAddress("technical.executive.mea@galaxkey.com");
      echo "right before mail";
      if($docs_mail->send()){
       echo "Partner has been sent a mail to update the deal.\n";
      }else{
           echo "error occured";
     }
    }
    else{
      echo "cools";
    }

 }
}


 ?>
