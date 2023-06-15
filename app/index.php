<?php
  include('login/session.php');
  include('config/config.php');
  include('functions.php');

  if (!isset($_REQUEST["action"])){
    $_REQUEST["action"] = "index";
  }

?>
<html">
   
   <head>
      <title>Selfservice Portal <?php echo $userdata; ?></title>
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/selfservice.css">
<!------ Include the above in your HEAD tag ---------->


<style>


</style>
   
    <script language="javascript" src="scripts/vms.js"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
 

</head>

<body>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="/"><img src="images/digitaltwin_logo.png" width="225"></a>
        <div id="close-sidebar">
          <i class="fa fa-house"></i>
        </div>
      </div>
      <div class="sidebar-header">

        <div class="user-info">
          <span class="user-name">
<?php
  $sql = "SELECT * FROM users WHERE username = '$login_session'";
  $result = mysqli_query($db,$sql);
  $userdata= mysqli_fetch_array($result, MYSQLI_ASSOC);
  
?>
            <strong><?php echo $userdata["lastname"] .", ". $userdata["surename"]; ?></strong>
          </span>
          <span class="user-role"> (<?php echo $userdata["usercode"]; ?>)</span>
          <span class="user-role">last login (UTC): <?php echo $login_last_session; ?></span>
          <span class="user-role">version: 2023.06.14-dev</span>
        </div>
      </div>
      <!-- sidebar-header  -->

      <!-- sidebar-search  -->
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>
          <li>
            <a href="?action=vms">
              <i class="fa fa-server"></i>
              <span>Virtual Maschine</span>
            </a>
          </li>
          <li>
            <a href="?action=k8s">
              <i class="fa fa-server"></i>
              <span>Kubernetes</span>
            </a>
          </li>       
        </ul>
      </div>
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>Admin Area</span>
          </li>
          <li>
            <a href="?action=userinfo ">
              <i class="fa fa-user"></i>
              <span><?php echo $userdata["surename"] . " " . $userdata["lastname"]; ?></span>
            </a>
          </li>
<?php
  if($userdata["usergroup"] == "0") {
?>
          <li>
            <a href="?action=sysconfig">
              <i class="fa fa-user"></i>
              <span>System Config</span>
            </a>
          </li>
  <?php
  }
  ?>
          <li>
            <a href="http://digitaltwin-ssp-dev-kuma.ntap-wdf.local/status/digitaltwin-ssp">
              <i class="fa fa-signal"></i>
              <span>System Status</span>
            </a>
          </li>

          
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <a href="logout.php">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  <main class="page-content">
      <?php include("content/". $_REQUEST['action']."_inc.php"); echo $config["awxhost"];?> 
      <footer class="text-center">
        <div class="mb-2">
          <small>
            
            © 2023 made with <i class="fa fa-heart" style="color:red"></i> by - <a target="_blank" rel="noopener noreferrer" href="">
              Fabian Born
            </a>
          </small>
        </div>
        <div>
          <a href="https://github.com/fabian-born" target="_blank">
            <img alt="GitHub followers" src="https://img.shields.io/github/followers/fabian-born?label=github&style=social" />
          </a>
          <a href="https://twitter.com/fabianborn" target="_blank">
            <img alt="Twitter Follow" src="https://img.shields.io/twitter/follow/fabianborn?label=twitter&style=social" />
          </a>
        </div>
      </footer>
    </div>
  </main>
  <!-- page-content" -->
</div>
<!-- page-wrapper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    
</body>

</html>
