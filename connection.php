<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'password';
$dbname = 'test_db';

$con = mysqli_connect('localhost', 'root', 'password', 'test_db');
if(!$con)
{
  die("Failed to connect! Please try later");
}


/*if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

$query = "INSERT INTO user_creds (user_id, user_name, password) VALUES (1234, 'hasan', '5643')";
echo "<pre>Debug: $query</pre>\m";
$result = mysqli_query($con, $query);
if ( false===$result ) {
  printf("error: %s\n", mysqli_error($con));
}
else {
  echo 'done.';
}
*/
 ?>
