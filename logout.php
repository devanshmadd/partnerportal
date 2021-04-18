<?php
  session_start();
  if(isset($_SESSION['partner_email']))
  {
    unset($_SESSION['partner_email']);
  }

  header("Location: login.php")

 ?>
