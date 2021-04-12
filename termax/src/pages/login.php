<?php
include "functions.php";


if (isset($_POST['login_btn'])) {
    login();
}

/*
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}*/

?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>AWESOME-GAME ///</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/login.css">
</head>

	<div class="login-page">

	  <div class="form">
	   	<h3>Termax DOO</h3>
	    <form class="login-form" action="login.php" method="POST">
	      <input type="text" name="name" placeholder="username"/>
	      <input type="password" name="pass" placeholder="password"/>
	      <button  name="login_btn" type="submit">login</button>
	     
	    </form>
	  </div>
	</div>
<!--

    <div style="position:fixed; top:0; z-index:10000; background:gray; width:100%; height: 100vh; overflow: auto;">
        <div class="container center_div ">
            <form style="background:green" action="login.php" method="POST">
                Username:<br>
                <input type="text" name="name">
                <br>
                Password:<br>
                <input type="text" name="pass">
                <br><br>
                <input class="btn btn-default" style="background:white;" name="login_btn" type="submit" value="Submit">
            </form>
        </div>
    </div>

 
-->

<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>

</html>