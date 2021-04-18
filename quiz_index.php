<!DOCTYPE>
<html>
<?php require 'quiz_dbconfig.php';
    session_start(); ?>
    <head>
    <title>Galaxkey quiz</title>
    <style>

                  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

            body {
                  font-family: 'Poppins', sans-serif;
            }
            /* button */
            .button {
              display: inline-block;
              border-radius: 4px;
              background-color: #f4511e;
              border: none;
              color: white;
              text-align: center;
              font-size: 28px;
              padding: 20px;
              width: 500px;
              transition: all 0.5s;
              cursor: pointer;
              margin: 5px;
            }

            .button span {
              cursor: pointer;
              display: inline-block;
              position: relative;
              transition: 0.5s;
            }

            .button span:after {
              content: '\00bb';
              position: absolute;
              opacity: 0;
              top: 0;
              right: -20px;
              transition: 0.5s;
            }

            .button:hover span {
              padding-right: 25px;
            }

            .button:hover span:after {
              opacity: 1;
              right: 0;
            }
            .title{
            	background-color: #EE0000;
            	font-size: 30px;
              padding: 20px;
                color: white;

            }
            .button3 {
                border: none;
                color: white;
                padding: 10px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                -webkit-transition-duration: 0.4s; /* Safari */
                transition-duration: 0.4s;
                cursor: pointer;
            }
            .button3 {
                background-color: white;
                color: black;
                border: 2px solid #f4e542;
            }

            .button3:hover {
                background-color: #f4e542;
                color: Black;
            }

            *{
              margin: 0;
              padding: 0;
              box-sizing: border-box;
            }

            .nav-bar{
              background: white;
              display: flex;
              width: 100%;
              margin: auto;
              height: 10vh;
              justify-content: space-around;
              align-items: center;

            }

            .nav-logo img{
              width: 25%;
              height: auto;
              margin-left: 10%;
              display: flex;


            }

            nav{
              display: flex;
              width: 100%;
              justify-content: space-around;
            }

            .list-items{
              list-style: none;
              width: 100%;
              display: flex;
              justify-content: space-around;
              align-items: center;
            }

            .list-items li a{
              text-decoration: none;
              color: black;
            }


            .list-items li a:hover{
              background-color: black;
              padding: 5px 7px;
              border-radius: 5px;
              color: white;
}


.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: white;
margin:auto;
}

.dropdown:hover .dropdown-content {
  display: block;
background-color: white;
color: white;

}

.dropdown .dropbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: black;
background-color: white;
  font-family: inherit;
  margin: 0;
}

.dropbtn:hover {
color: white;
background-color: black;
padding: 5px 7px;
border-radius: 5px;

}
</style>
</head>
<body>


      <div class="nav-bar">
          <nav>
            <div class="nav-logo">
              <img src="logo_galaxkey" alt="">
            </div>
                <ul class = "list-items">
                <li><a href="register_deal.php">Register a deal</a></li>
                <li><a href="change_status.php">Change Deal Status</a></li>
                <li><a href="#">Take the Quiz!</a></li>
<li class = "dropdown" >    <button class="dropbtn">Downloads
                    <i class="fa fa-caret-down"></i>
                  </button>
                  <div class="dropdown-content">
                    <a href="https://manager.galaxkey.com/downloads" target="_blank">Download Galaxkey Client</a>
                    <a href="https://www.galaxkey.com/datasheets/" target="_blank">Datasheets</a>
                    <a href="https://www.galaxkey.com/case-studies/" target="_blank">Case Studies</a>
                <li><a href="demo.html">Demo</a></li>
                <li><a href="https://www.galaxkey.com/aboutgalaxkey/" target="_blank">About</a></li>
                <li><a href="https://www.galaxkey.com/contact/contact/" target="_blank">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
          </nav>
      </div>


<center>
<div class="title">Galaxkey features quiz</div>
<?php
																if (isset($_POST['click']) || isset($_GET['start'])) {
																@$_SESSION['clicks'] += 1 ;
																$c = $_SESSION['clicks'];
																if(isset($_POST['userans'])) { $userselected = $_POST['userans'];

																$fetchqry2 = "UPDATE `quiz` SET `userans`='$userselected' WHERE `id`=$c-1";
																$result2 = mysqli_query($con,$fetchqry2);
																}


 																} else {
																	$_SESSION['clicks'] = 0;
																}

																//echo($_SESSION['clicks']);
																?>


<div class="bump"><br><form><?php if($_SESSION['clicks']==0){ ?> <button class="button" name="start" float="left"><span>START QUIZ</span></button> <?php } ?></form></div>
<form action="" method="post">
<table><?php if(isset($c)) {   $fetchqry = "SELECT * FROM `quiz` where id='$c'";
				$result=mysqli_query($con,$fetchqry);
				$num=mysqli_num_rows($result);
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC); }
		  ?>
<tr><td><h3><br><?php echo @$row['que'];?></h3></td></tr> <?php if($_SESSION['clicks'] > 0 && $_SESSION['clicks'] < 6){ ?>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option 1'];?>">&nbsp;<?php echo $row['option 1']; ?><br>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option 2'];?>">&nbsp;<?php echo $row['option 2'];?></td></tr>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option 3'];?>">&nbsp;<?php echo $row['option 3']; ?></td></tr>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option 4'];?>">&nbsp;<?php echo $row['option 4']; ?><br><br><br></td></tr>
  <tr><td><button class="button3" name="click" >Next</button></td></tr> <?php }
																	?>
  <form>
 <?php if($_SESSION['clicks']>5){
	$qry3 = "SELECT `ans`, `userans` FROM `quiz`;";
	$result3 = mysqli_query($con,$qry3);
	$storeArray = Array();
	while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
     if($row3['ans']==$row3['userans']){
		 @$_SESSION['score'] += 1 ;
	 }
}

 ?>


 <h2>Result</h2>
 <span>No. of Correct Answer:&nbsp;<?php echo $no = @$_SESSION['score'];
 session_unset(); ?></span><br>
 <span>Your Score:&nbsp<?php echo $no*2; ?></span>
<?php } ?>
 <!-- <script type="text/javascript">
    function radioValidation(){
		/* var useransj = document.getElementById('rd').value;
        //document.cookie = "username = " + userans;
		alert(useransj); */
		var uans = document.getElementsByName('userans');
		var tok;
		for(var i = 0; i < uans.length; i++){
			if(uans[i].checked){
				tok = uans[i].value;
				alert(tok);
			}
		}
    }
</script> -->
</center>
</body>
</html>
