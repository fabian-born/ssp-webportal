<?php
$pageTitle = "Kubernetes Cluster";
if (!isset($_REQUEST["sub"])){
     $_REQUEST["sub"] = "overview";
     $overview_active = "active";
}
if ($_REQUEST["sub"] == "new"){  $new_active = "active"; }
if ($_REQUEST["sub"] == "overview"){  $overview_active = "active"; }


?>

<div class="container-fluid">
      <h2><img src="/images/k8s.png"><?php echo $pageTitle; ?></h2>
      <hr>
      <div class="row">
        <div class="form-group col-md-12">
          <p></p>
        </div>
        <div class="form-group col-md-12">
        <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?php echo $overview_active; ?>" href="?action=k8s&sub=overview">Overview Kubernetes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $new_active; ?>" href="?action=k8s&sub=new">Request new K8s Cluster</a>
        </li>
        </ul>
         </div>
         <div class="form-group col-md-12">
         <?php include("content/". $_REQUEST['action']."_". $_REQUEST["sub"] .".php"); ?>
        </div>

 </div>