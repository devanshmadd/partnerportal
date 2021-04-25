<?php

include('smtp/PHPMailerAutoload.php');




function check_login($con)
{
    if(isset($_SESSION['partner_email']))
    {
      $partner_email = $_SESSION['partner_email'];
      $query = "SELECT * FROM user_creds WHERE partner_email = '$partner_email' limit 1";

      $result = mysqli_query($con, $query);
      if($result && mysqli_num_rows($result)>0)
      {
        $user_data = mysqli_fetch_assoc($result);
        echo $user_data;//means associative array
        echo "data is here";
        return $user_data;
      }
    }
}


function signup_galaxkey($partner_organization, $user_name, $partner_email, $partner_password){

  $mail = new PHPMailer(true);
  $mail ->isSMTP();
  $mail ->Host="smtp.outlook.com";
  $mail ->Port=587;
  $mail ->SMTPSecure="tls";
  $mail ->SMTPAuth = true;
  $mail ->Username = "technical.executive.mea@galaxkey.com";
  $mail ->Password = "Apple_dummy_123";
  $mail ->SetFrom("technical.executive.mea@galaxkey.com");
  $mail -> addAddress("business.executive.mea@galaxkey.com");
  $mail ->IsHTML(true);
  $mail ->IsHTML(true);
  $mail -> SMTPOptions = array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));
  $mail ->Subject="Partner Signed up";
  $html="<table><tr><td>Partner Organization:</td><td>$partner_organization</td></tr><tr><td>User Name:</td><td>$user_name</td><tr><td>Email:</td><td>$partner_email</td></tr><tr><td>Password:</td><td>$partner_password</td></tr></table>";
  $mail ->Body=$html;
  if($mail->send()){
    echo "Mail Sent";
  }else{
    echo "error occured";
  }

}


function signup_partner($partner_organization, $user_name, $partner_email, $partner_password){

  $mail = new PHPMailer(true);
  $mail ->isSMTP();
  $mail ->Host="smtp.outlook.com";
  $mail ->Port=587;
  $mail ->SMTPSecure="tls";
  $mail ->SMTPAuth = true;
  $mail ->Username = "technical.executive.mea@galaxkey.com";
  $mail ->Password = "Apple_dummy_123";
  $mail ->SetFrom("technical.executive.mea@galaxkey.com");
  $mail -> addAddress($partner_email);
  $mail ->IsHTML(true);
  $mail ->IsHTML(true);
  $mail -> SMTPOptions = array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));

  $mail ->Subject="Partner Signed up";
  $html="<table><tr><td>Partner Organization:</td><td>$partner_organization</td></tr><tr><td>User Name:</td><td>$user_name</td><tr><td>Email:</td><td>$partner_email</td></tr><tr><td>Password:</td><td>$partner_password</td></tr></table><br><p>Please upload your documents within 14 days by clicking <a href=\"http://localhost/from_Git/partnerportal/upload_docs.php\">this link</a></p>";
  $mail ->Body=$html;
  if($mail->send()){
    echo "Mail Sent";
  }else{
    echo "error occured";
  }
}


function new_deal_reg_galaxkey($partner_email, $partner_name,$deal_id, $partner_organization)
{
  $mail = new PHPMailer(true);
  $mail ->isSMTP();
  $mail ->Host="smtp.outlook.com";
  $mail ->Port=587;
  $mail ->SMTPSecure="tls";
  $mail ->SMTPAuth = true;
  $mail ->Username = "technical.executive.mea@galaxkey.com";
  $mail ->Password = "Apple_dummy_123";
  $mail ->SetFrom("technical.executive.mea@galaxkey.com");
  $mail ->addAddress("technical.executive.mea@galaxkey.com");
  $mail ->addAddress("business.executive.mea@galaxkey.com");
  $mail ->IsHTML(true);
  $mail ->IsHTML(true);
  $mail ->Subject="New Deal Registered, Pending Approval";
  $html="<table><tr><td>Email:</td><td>$partner_email</td></tr><tr><td>User Name:</td><td>$partner_name</td></tr><tr><td>Deal ID:</td><td>$deal_id</td><tr><td>Organization: </td><td>$partner_organization</td><tr><td>Deal Status:</td><td>Pending Approval</td></tr></table><p>Please add the expiry date by clicking on:<a href=\"http://localhost/from_Git/partnerportal/backend_approval.php\"> this link</a> </p>";
  $mail ->Body=$html;
  $mail -> SMTPOptions = array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));

  if($mail->send()){
    echo "Mail Sent";
  }else{
    echo "error occured";
  }
}

function new_deal_reg_partner($partner_email, $partner_name, $deal_id, $partner_organization)
{
  $mail = new PHPMailer(true);
  $mail ->isSMTP();
  $mail ->Host="smtp.outlook.com";
  $mail ->Port=587;
  $mail ->SMTPSecure="tls";
  $mail ->SMTPAuth = true;
  $mail ->Username = "technical.executive.mea@galaxkey.com";
  $mail ->Password = "Apple_dummy_123";
  $mail ->SetFrom("technical.executive.mea@galaxkey.com");
  $mail ->addAddress("technical.executive.mea@galaxkey.com");
  $mail ->addAddress($partner_email);
  $mail ->IsHTML(true);
  $mail ->IsHTML(true);
  $mail ->Subject="New Deal Registered, Pending Approval";
  $html="<table><tr><td>Name:</td><td>$partner_name</td></tr><tr><td>Deal ID:</td><td>$deal_id</td><tr><td>Organization: </td><td>$partner_organization</td><tr><td>Deal Status:</td><td>Pending Approval</td></tr></table><p>You will be notified upon deal approval</p>";
  $mail ->Body=$html;
  $mail -> SMTPOptions = array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));

  if($mail->send()){
    echo "Mail Sent";
  }else{
    echo "error occured";
  }
}


function approval_req_galaxkey($partner_email, $deal_id, $partner_organization,$deal_status){

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
  $mail -> SMTPOptions = array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));
  $mail ->addAddress("business.executive.mea@galaxkey.com");
  //$mail ->addAddress("technical.executive.mea@galaxkey.com");
  $mail ->Subject="Deal Approval Requested";
  $html = "$partner_organization has requested for Deal Approval for: <br> <table><tr><td>Deal ID:</td><td>$deal_id</td><tr><td>Organization: </td><td>$partner_organization</td><tr><td>Change Deal Status to: </td><td>$deal_status</td></tr></table><br><p>Please add the expiry date by clicking on:<a href=\"http://localhost/from_Git/partnerportal/backend_approval.php\"> this link</a> </p>";
  $mail ->Body=$html;
  if($mail->send()){
    echo "Mail Sent";
  }else{
    echo "error occured";
  }

}

function approval_req_partner($partner_email, $deal_id){
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
  $mail -> SMTPOptions = array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));
  $mail ->addAddress($partner_email);
  $mail ->Subject="Deal Approval Requested";
  $html="Your deal with deal ID: $deal_id has been sent for approval.<br> You will be notified upon its approval. <br> Thank you so much.";
  $mail ->Body=$html;
  if($mail->send()){
    echo "Mail Sent";
  }else{
    echo "error occured";
  }
}

function deal_status_changed_galaxkey($partner_name, $deal_id, $partner_organization,$deal_status){
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
  $mail -> SMTPOptions = array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));
  $mail ->addAddress("business.executive.mea@galaxkey.com");
  $mail ->Subject="Deal Status Changed, Update Expiry";
  $html = "$partner_name has changed the deal status for the following deal: <table><tr><td>User Name:</td><td>$partner_name</td></tr><tr><td>Deal ID:</td><td>$deal_id</td><tr><td>Organization: </td><td>$partner_organization</td><tr><td>Deal Status changed to: </td><td>$deal_status</td></tr></table><br><p>Please change expiry date on:<a href=\"http://localhost/from_Git/partnerportal/backend_approval.php\"> this link</a> </p>";
  $mail ->Body=$html;
  if($mail->send()){
    echo "Mail Sent";
  }else{
    echo "error occured";
  }
}

function deal_status_changed_partner($partner_name, $deal_id, $partner_organization,$deal_status){
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
  $mail -> SMTPOptions = array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));
  $mail ->addAddress("hassankhan825@gmail.com");
  $mail ->Subject="Deal Status Changed Successfully";
  $html = "<table><tr><td>User Name:</td><td>$partner_name</td></tr><tr><td>Deal ID:</td><td>$deal_id</td><tr><td>Organization: </td><td>$partner_organization</td><tr><td>Deal Status: </td><td>$deal_status</td></tr></table>";
  $mail ->Body=$html;
  if($mail->send()){
    echo "Mail Sent";
  }else{
    echo "error occured";
  }
}

function deal_inactivated($partner_email, $deal_id, $partner_organization,$deal_status){
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
  $mail -> SMTPOptions = array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));
  $mail ->addAddress($partner_email);
  $mail ->addAddress("business.executive.mea@galaxkey.com");
  $mail ->Subject="Deal Inactivated";
  $html = "<table><tr><td>User Name:</td><td>$partner_email</td></tr><tr><td>Deal ID:</td><td>$deal_id</td><tr><td>Organization: </td><td>$partner_organization</td><tr><td>Deal Status: </td><td>$deal_status</td></tr></table>";
  $mail ->Body=$html;
  if($mail->send()){
    echo "Mail Sent";
  }else{
    echo "error occured";
  }
}



function random_num($length)
{
  $text = "";
  if($length < 5)
  {
    $length = 5;
  }
  //$len .= $length;
  for ($i=0; $i< $length; $i++) {
    $text .= rand(0, 9);
    // code...
  }
  return $text;
}
