<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password=$mobile=$email="";
$username_err = $password_err = $confirm_password_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

   
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
            echo  '<script>alert("Password did not match, please type correct password ")</script>';
        }
    }
    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
    $email=$_POST["email"];
    $mobile=$_POST["mobile"];


    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, mobile, email) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $mobile, $email);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $email=$_POST["email"];
            $mobile=$_POST["mobile"];
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo  '<script>alert("Something went wrong,please try again letter")</script>';
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register_style.css">

    <link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Anonymous Pro' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Register</title>
</head>
<body>
  <div class="header">
    <a href="index.html"><div class="logo-heading-box">
      <img src="img/spectrum.png" alt="Spectrum Logo" id="spectrum-logo">
      <h1>Spectrum</h1>
    </div>
    </a>

    <div class="registration_description_box">
      <p class="registration_description">SPECTRUM a place for all technical enthusiasts to learn, discover and innovate new things in the field of Technology and Design.</p>
    </div>

    <div >
      <img src="img/register_image.png" alt="" class="register_image" style="position: relative; width: 310px; height: 310px; left: 60px;">
    </div>

    <div>
      <p class="login_description"> Already Registered?  <a href="login.php"><button class="login_btn">Log In</button> </a></p>
    </div>
  </div>


  <div class="form" >
    <div class="title">Welcome</div>
    <div class="subtitle">Let's create your account!</div>
    <form action="" method="post">
      <div class="input-container ic1">
        <input id="username" class="input" type="text" name="username" placeholder=" " required >
        <div class="cut"></div>
        <label for="username" class="placeholder">User name</label>
      </div>
      <div class="input-container ic2">
        <input id="mobile" class="input" type="tel" name="mobile" pattern="[0-9]{10}" placeholder=" "  required >
        <div class="cut"></div>
        <label for="mobile" class="placeholder">Mobile</label>
      </div>
      <div class="input-container ic3">
        <input id="email" class="input" type="text" name="email" placeholder=" " required>
        <div class="cut cut-short"></div>
        <label for="email" class="placeholder">Email </label>
      </div>

      <div class="input-container ic4">
        <div class="input-container div1">
        
        
        <select name="branch" id="branch" class="input" placeholder=" " >
          <option value="0" id="branch_label">--Branch--</option>
          <option value="1">Biotechnology</option>
          <option value="2">Civil Engineering</option>
          <option value="3">Computer Science & Engineering</option>
          <option value="4">Chemistry</option>
          <option value="5">Electrical Engineering</option>
          <option value="6">Fashion & Apparel Technology</option>
          <option value="7">Instrumentation & Electronics</option>
          <option value="8">Mathematics & Humanities</option>
          <option value="9">Physics</option>
          <option value="10">Planning</option>
          <option value="11">Textile Engineering</option>
          

        </select>
      </div>
      <div class="input-container div2">
        
        <select name="year" id="year" class="input" placeholder=" ">
          <option value="0" id="year_label">--Year--</option>
          <option value="1">1st</option>
          <option value="2">2nd</option>
          <option value="3">3rd</option>
          <option value="4">4th</option>
          </select>
        </div>
      </div>

      <div class="input-container ic5">
        
        <select name="domain" id="domain" class="input" placeholder=" ">
          <option value="" id="domain_label">--Domain--</option>
          <option value="" >Hardware</option>
          <option value="">Software</option>
          <option value="">Design</option>
      
          </select>
      </div>

      <div class="input-container ic6">
        <input id="inputPassword4" class="input" type="password" name="password" placeholder=" "  required>
        <div class="cut"></div>
        <label for="inputPassword4" class="placeholder">Password</label>
      </div>

      <div class="input-container ic7">
        <input id="inputPassword" class="input" type="password" name="confirm_password" placeholder=" " required>
        <div class="cut"></div>
        <label for="inputPassword4" class="placeholder">Confirm Password</label>
      </div>

      <button type="submit" class="submit" name="submit">Sign Up</button>
    </div>
  </form>

    
  </div>

   
  </body>
</html>