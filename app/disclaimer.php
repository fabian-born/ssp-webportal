<?php
   include("config/config.php");
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
         header("location: /index.php");
      }else {
         $login_error = "Your Login Name or Password is invalid";
      }
   }
   include("./includes/login_inc_header.php");
   include("./includes/login_inc_nav.php");
?>

        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <!-- Heading Row-->
             <!-- 
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="https://dummyimage.com/900x400/dee2e6/6c757d.jpg" alt="..." /></div>
                <div class="col-lg-5">
                    <h1 class="font-weight-light">Business Name or Tagline</h1>
                    <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
                    <a class="btn btn-primary" href="#!">Call to Action!</a>
                </div>
            </div> -->
            <!-- Call to Action-->
<?php
    if (isset($warningmessage)){
?>

            <div class="card text-white bg-warning my-5 py-4 text-center">
                
                <div class="card-body"><p class="text-white m-0">This call to action card is a great place to showcase some important information or display a clever tagline!</p></div>
            </div>
<?php
}else{
?>
            <div class=" text-white my-2 py-0 text-center">
                
                <div class="card-body"><p class="text-white m-0">This call to action card is a great place to showcase some important information or display a clever tagline!</p></div>
            </div>
<?php
}

?>
            <!-- Content Row-->
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-5">
                <h1>Disclaimer</h1>
            </div>
        </div>
        <!-- Footer-->
<?php
    include("./content/login_footer.php");
?>  

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
