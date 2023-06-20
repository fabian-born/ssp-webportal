<?php
   include("../config/config.php");
   include("../content/precontent.php");
   session_start();

   
   if(($_SERVER["REQUEST_METHOD"] == "POST") && ($_REQUEST['submit_login'] == "Login")) {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = md5(mysqli_real_escape_string($db,$_POST['password'])); 
      
      $sql = "SELECT uid FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      // $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
	 // session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         # $update_sql = mysqli_query($db,"update users set lastlogin = now() where username = " . $_SESSION['login_user'] );
         header("location: /index");
      }else {
         $login_error = "Your Login Name or Password is invalid";
      }
   }

   include("../includes/login_inc_header.php");
   include("../includes/login_inc_nav.php");


   include("../content/login_overview.php");

    include("../content/login_footer.php");
?>  

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
