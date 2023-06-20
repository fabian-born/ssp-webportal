<?php
$pageTitle = "Kubernetes Cluster";

if($_SERVER["REQUEST_METHOD"] == "POST" && ($_ENV['REQUEST_URI'] == "/kubernetes?new")) {
    //update_sql = mysqli_query($db,"insert users set lastlogin = now() where username = '$myusername' ");
    $sql = "SELECT uid FROM users WHERE username = '$login_session'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $update_sql = mysqli_query($db,"INSERT INTO k8s (kid,owner,clustername,state,kubeconfig) VALUES (NULL, " . $row['uid'] . ", \"" . $_POST['clustername'] . "\" ,\"deploying\", NULL);");
    // echo $json_body;
    // echo "INSERT INTO k8s (kid,owner,clustername,state,kubeconfig) VALUES (NULL, " . $row['uid'] . ", \"" . $_POST['clustername'] . "\" ,\"deploying\", NULL);";
    # send_apicall2awx($config["aap_jid_createvm"] , $json_body);
    $_SERVER['REQUEST_URI'] = "/kubernetes?overview";
}

if(($_SERVER["REQUEST_METHOD"] == "POST" && ($_ENV['REQUEST_URI'] == "/kubernetes?delete"))) {
    $sql = "SELECT kid,clustername,state FROM k8s WHERE kid = " . $_POST['kid'] ;
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $sqluserinfo = "SELECT * FROM users WHERE username = '$login_session'";
    $resultuserinfo = mysqli_query($db,$sqluserinfo);
    $userdatainfo= mysqli_fetch_array($resultuserinfo, MYSQLI_ASSOC);
  
    $delete_sql = mysqli_query($db,"DELETE FROM k8s where kid = " . $_POST['kid'] );
    $json_body = "
    folder: user-systems/". $userdatainfo["usercode"] ."
    servers: ". $row['clustername'];
    
        // echo $json_body;
        //send_apicall2awx($config["aap_jid_deletek8s"], $json_body);
    $errormsg = "
    <div class=\"alert alert-warning\">
  
    <strong>Info!</strong> Kubernetes cluster ( ".  $row['clustername'] . ") will be deleted now!
  </div>";

    $_SERVER['REQUEST_URI'] = "/kubernetes?overview";
  }

if ($_SERVER['REQUEST_URI'] == "/kubernetes") {  $overview_active = "active"; $requested_content = "overview";  }
if ($_SERVER['REQUEST_URI'] == "/kubernetes?new") {  $new_active = "active"; $requested_content = "new";  }
if ($_SERVER['REQUEST_URI'] == "/kubernetes?overview")  {  $overview_active = "active"; $requested_content = "overview"; }


?>

<div class="container-fluid">
      <h2><img src="/images/k8s.png" width="50"><?php echo $pageTitle; ?></h2>
      <hr>
      <div class="row">
        <div class="form-group col-md-12">
          <p></p>
        </div>
        <div class="form-group col-md-12">
        <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?php echo $overview_active; ?>" href="kubernetes?overview">Overview Kubernetes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $new_active; ?>" href="kubernetes?new">Request new K8s Cluster</a>
        </li>
        </ul>
         </div>
         <div class="form-group col-md-12">
         <?php include("content/kubernetes_content_". $requested_content . ".php"); ?>
        </div>

 </div>