<?php
   include("../config/config.php");
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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Selfservice Portal</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/css/style.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-white">
            <div class="container px-5">
                <img src="/images/digitaltwin_logo.png" width="250px"></img>
                <a class="navbar-brand text-dark" href="#!">Selfservice Portal</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active text-secondary" aria-current="page" href="/">Home</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#!">About</a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link" href="#!">Services</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>
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
                    <div class="shadow-sm card h-100">
                        <div class="card-body">
                            <p class="card-text">
                                <?php include("../content/login_inc.php"); ?>
                                
                            </p>
                        </div>
                        <div class="card-footer"><i class="fa fa-right-to-bracket"></i> &nbsp; &nbsp; &nbsp; Login </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            
                            <p class="card-text">
                                <?php include("../content/register2_inc.php"); ?>
                            </p>
                        </div>
                        <div class="card-footer"><i class="fa fa-user-plus"></i> &nbsp; &nbsp; &nbsp; Register Account </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card h-100 shadow-sm">
                    <div class="card-body">
                            <p class="card-text">
                                <?php include("../content/resetpw_inc.php"); ?>
                            </p>
                    </div>
                    <div class="card-footer"><i class="fa fa-unlock"></i> &nbsp; &nbsp; &nbsp; forgot password </div>
                </div>
            </div>
        </div>
        <!-- Footer-->

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
