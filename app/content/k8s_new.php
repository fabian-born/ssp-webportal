<?php

include ("./config/config.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
        phpinfo();
//    echo $_POST['vmname'];
//    echo $_POST['ostemplate'];
//    echo $_POST['description'];
    //update_sql = mysqli_query($db,"insert users set lastlogin = now() where username = '$myusername' ");
    $sql = "SELECT uid FROM users WHERE username = '$login_session'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    echo "INSERT INTO k8s (kid, clustername, owner,state,kubeconfig) VALUES (NULL,\"" . $_POST['clustername'] . "\", " . $row['uid'] . " ,\"deploying\", NULL);";
    $update_sql = mysqli_query($db,"INSERT INTO k8s (kid, clustername, owner,state,kubeconfig) VALUES (NULL,\"" . $_POST['clustername'] . "\", " . $row['uid'] . " ,\"deploying\", NULL);");

    // echo $json_body;
    # send_apicall2awx($config["aap_jid_createvm"] , $json_body);
?>

    <div class="container-fluid">

    
     </div>
<?php
}

?>

<form action="" method = "post">
  <div class="row mb-3">
    <label for="clustername" class="col-sm-2 col-form-label">Kubernetes Clustername</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="clustername" name="clustername" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputDescription3" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputDescription3" name="description">
    </div>
  </div>
  <div class="row mb-3">

  </div>


  <button type="submit" class="btn btn-primary">Request</button>
</form>
<?php

?>