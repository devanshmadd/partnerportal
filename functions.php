<?php

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

    //redirect to Login
    //header("Location: login.php");
    //die;
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
