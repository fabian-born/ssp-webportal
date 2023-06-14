<?php
   # include('/app/config/config.php');
   include('./config/config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username,lastlogin from users where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $login_last_session = $row['lastlogin'];
  

   if(!isset($_SESSION['login_user'])){
      header("location:/login/login.php");
      die();
   }
?>
