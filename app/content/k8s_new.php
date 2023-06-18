<?php

include ("./config/config.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
//    echo $_POST['vmname'];
//    echo $_POST['ostemplate'];
//    echo $_POST['description'];
    //update_sql = mysqli_query($db,"insert users set lastlogin = now() where username = '$myusername' ");
    $sql = "SELECT uid FROM users WHERE username = '$login_session'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $update_sql = mysqli_query($db,"INSERT INTO vms (kid, hostname, ostype,state, ipaddress,templateid,owner) VALUES (NULL,\"" . $_POST['vmname'] . "\", 0 ,\"deploying\", 0,\"" . $_POST['ostemplate'] . "\", " . $row['uid'] . ");");

    $sqlostemplate = "SELECT * FROM ostemplate WHERE ostid = " . $_POST['ostemplate'];
    $rowostemplate = mysqli_query($db,$sqlostemplate);
    $resultostemplate = mysqli_fetch_array($rowostemplate,MYSQLI_ASSOC);

    $sqluserinfo = "SELECT * FROM users WHERE username = '$login_session'";
    $resultuserinfo = mysqli_query($db,$sqluserinfo);
    $userdatainfo= mysqli_fetch_array($resultuserinfo, MYSQLI_ASSOC);
    $aduser = strtolower(substr($userdatainfo['surename'],0,3) ."". substr($userdatainfo['lastname'],0,3));
    // ubuntu-focal-cloudimg
    $json_body = "
vmtemplate: ". $resultostemplate["vmimage"] ."
servers: ". $_POST['vmname'] ."
ram: ". $resultostemplate["ram"] ."
cpu: ". $resultostemplate["vcpu"] ."
username: " . $aduser ."
folder: user-systems/". $userdatainfo["usercode"] ."
disksize: ". $resultostemplate["disk"] ;

    // echo $json_body;
    send_apicall2awx($config["aap_jid_createvm"] , $json_body);
?>

    <div class="container-fluid">

    
     </div>
<?php
}

?>

<form action="" method = "post">
  <div class="row mb-3">
    <label for="vmname" class="col-sm-2 col-form-label">VM Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="vmname" name="vmname" required>
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