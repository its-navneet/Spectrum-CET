<?php

// Initialize the session
session_start();

 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="welcome_style.css">


</head>
<body>
<div class="header">
    <a href="index.html"><div class="logo-heading-box">
      <img src="spectrum.png" alt="Spectrum Logo" id="spectrum-logo">
      <h1>Spectrum</h1>
    </div>
    </a>

    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to SPECTRUM.</h1>
    <p>
        <a href="index.html" class="btn btn-warning">HOME</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

    <div class="contentbox">
    
      <img src="https://i.ibb.co/yNGW4gg/avatar.png" id="avatar" alt="Avatar">
      <div class="content">
          <p>Username: <?php echo htmlspecialchars($_SESSION["username"]); ?></p>
          <p>Email: <?php  ?></p>
          <p>Mobile: <?php  ?></p>
          
      </div>

    </div>

</body>
</html>