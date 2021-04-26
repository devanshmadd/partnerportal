<?php

session_start();
include("connection.php");
include('smtp/PHPMailerAutoload.php');

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
