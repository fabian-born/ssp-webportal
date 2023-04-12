<?php
$pageTitle = "Virtual Maschine";
if (!isset($_REQUEST["sub"])){
     $_REQUEST["sub"] = "overview";
     $overview_active = "active";
}
if ($_REQUEST["sub"] == "new"){  $new_active = "active"; }
if ($_REQUEST["sub"] == "overview"){  $overview_active = "active"; }


?>

<div class="container-fluid">
      <h2><?php echo $pageTitle; ?></h2>
      <hr>
      <div class="row">
        <div class="form-group col-md-12">
          <p></p>
        </div>
        <div class="form-group col-md-12">
        <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?php echo $overview_active; ?>" href="?action=vms&sub=overview">Overview VM</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $new_active; ?>" href="?action=vms&sub=new">Request new VM</a>
        </li>
        </ul>
         </div>
         <div class="form-group col-md-12">
         <?php include("content/". $_REQUEST['action']."_". $_REQUEST["sub"] .".php"); ?>
        </div>

 </div>