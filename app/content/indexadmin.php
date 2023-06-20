<?php
$pageTitle = "Welcome to Selfservice Portal";

if (($_SERVER['REQUEST_URI'] == "/") or ($_SERVER['REQUEST_URI'] == "/index")){  $arch_active = "active"; $requested_content = "arch";  }
if ($_SERVER['REQUEST_URI'] == "/?userflow") {  $userflow_active = "active"; $requested_content = "userflow";  }
if ($_SERVER['REQUEST_URI'] == "/?arch")  {  $arch_active = "active"; $requested_content = "arch"; }


?>

<div class="container-fluid">
      <h2><i class="fa fa-info" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $pageTitle; ?></h2>
      <hr>
      <div class="row">
        <div class="form-group col-md-12">
          <p></p>
        </div>
        <div class="form-group col-md-12">
        <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?php echo $userflow_active; ?>" href="/?userflow">Userflow</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $arch_active; ?>" href="/?arch">Architecture</a>
        </li>
        </ul>
         </div>
         <div class="form-group col-md-12">
         <?php if(isset($requested_content)) { include("content/indexadmin_content_". $requested_content . ".php"); } ?>
        </div>

 </div>