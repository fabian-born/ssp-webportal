<?php
   include("../config/config.php");
   session_start();

   if (!isset($_REQUEST["action"])){
        $_REQUEST["action"] = "login";
        $overview_active = "active";

   }
   if ($_REQUEST["action"] == "login"){  $new_active = "active"; }
   if ($_REQUEST["action"] == "register"){  $overview_active = "active"; }

   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = md5(mysqli_real_escape_string($db,$_POST['password'])); 
      
      $sql = "SELECT uid FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
	 // session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         $update_sql = mysqli_query($db,"update users set lastlogin = now() where username = '$myusername' ");
         header("location: /index.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
         .login-container{
    margin-top: 5%;
    margin-bottom: 5%;
}
.login-form-1{
    padding: 5%;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-1 h3{
    text-align: center;
    color: #333;
}
.login-form-2{
    padding: 5%;
    background: #0062cc;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-2 h3{
    text-align: center;
    color: #fff;
}
.login-container form{
    padding: 10%;
}
.btnSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    border: none;
    cursor: pointer;
}
.login-form-1 .btnSubmit{
    font-weight: 600;
    color: #fff;
    background-color: #0062cc;
}
.login-form-2 .btnSubmit{
    font-weight: 600;
    color: #0062cc;
    background-color: #fff;
}
.login-form-2 .ForgetPwd{
    color: #fff;
    font-weight: 600;
    text-decoration: none;
}
.login-form-1 .ForgetPwd{
    color: #0062cc;
    font-weight: 600;
    text-decoration: none;
}
fieldset {
    border: thin solid #ccc; 
    border-radius: 4px;
    padding: 20px;
    padding-left: 40px;
    background: #fbfbfb;
}
legend {
   color: #678;
}
.form-control {
    width: 95%;
}
label small {
    color: #678 !important;
}
span.req {
    color:maroon;
    font-size: 112%;
}
      </style>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script language="javascript" src="scripts/registration.js"></script>
<!------ Include the above in your HEAD tag ---------->      
   </head>
   
   <body bgcolor = "#FFFFFF">


   <div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>.: Selfservice Portal:. </h3>

                </div>
                <div class="col-md-6 login-form-2">
                <div class="form-group col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $overview_active; ?>" href="/login/login.php?action=login">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $new_active; ?>" href="/login/login.php?action=register">Sign Up</a>
                    </li>
                </ul>
                </div>
                <div class="form-group col-md-12">
                    <?php include("../content/". $_REQUEST['action']."_inc.php"); ?>
                </div>
                </div>
            </div>
        </div>
   </body>
</html>
