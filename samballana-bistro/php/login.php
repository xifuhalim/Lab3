<?php
session_start();
include_once("dbconnect.php");
if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim(sha1($_POST['passworda']));
    $sqllogin = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password'";

    $select_stmt = $conn->prepare($sqllogin);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    if ($select_stmt->rowCount() > 0) {
        $_SESSION["session_id"] = session_id();
        $_SESSION["email"] = $email;
        $_SESSION["name"] = $row['name'];
        $_SESSION["phone"] = $row['phone'];
        $_SESSION["datereg"] = $row['date_reg'];
        $_SESSION["pass"] = $row['password'];
        echo "<script> alert('Login successful')</script>";
        echo "<script> window.location.replace('../php/mainpage.php')</script>";
    } else {
        session_unset();
        session_destroy();
        echo "<script> alert('Login fail')</script>";
        echo "<script> window.location.replace('../php/login.php')</script>";
    }
}
if (isset($_GET["status"])) {
    if (($_GET["status"] == "logout")) {
        session_unset();
        session_destroy();
        echo "<script> alert('Session Cleared')</script>";
    }
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Samballana Bistro Login</title>
    <link rel="stylesheet" href="../css/newproduct.css">
    <link rel="stylesheet" href="../css/index.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="validator.js"></script>

     
   </head>
<body>
  <div id="header">
         <div id="logo">
            <h3><span>Samballana Bistro</span></h3>
         </div>
      </div>
  <div class="container">
    <div class="title">Login</div>
    <div class="content">
    <form name="loginForm" action="../php/login.php" onsubmit="return validateLoginForm()" method="post">
        <div class="user-details">
        <div class="input-box">
            <span class="details">Email</span>
            <input type="text" class="form-control" id="idemail" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-box">
            <span class="details">Password</span>
            <input type="password" class="form-control" id="idpass" name="passworda" placeholder="Enter your password" required>
          </div>

          <div class="col-75">
            <span class="details">Remember Me </span>
            <br><input type="checkbox" id="idremember" name="rememberme">
</div>
</div>
                   
        <div class="button">
        
          <input type="submit" name="submit" value="Login">
          
         
          
        </div>
      </form>
    
 

  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="fab-container">
		<div class="fab fab-icon-holder">
			<i class="fa fa-plus"></i>
		</div>

		<ul class="fab-options">
    <li>
				<span class="fab-label">Home </span>
				<div class="fab-icon-holder">
					<i onclick="window.location.href='../index.php';" class="fa fa-home"></i>
					</div>
               <li>
			<li>
  <span class="fab-label">Register </span>
				<div class="fab-icon-holder">
					<i onclick="window.location.href='register.php';" class="fa fa-user-plus"></i>
				</div>
</body>
</html>
