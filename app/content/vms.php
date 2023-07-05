<?php
$pageTitle = "Virtual Maschine";

if($_SERVER["REQUEST_METHOD"] == "POST"  && ($_ENV['REQUEST_URI'] == "/vms?new")) {
//    echo $_POST['vmname'];
//    echo $_POST['ostemplate'];
//    echo $_POST['description'];

    //update_sql = mysqli_query($db,"insert users set lastlogin = now() where username = '$myusername' ");
    $sql = "SELECT * FROM users WHERE username = '$login_session' limit 1";
    
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $update_sql = mysqli_query($db,"INSERT INTO vms (vmid, hostname, ostype,state, ipaddress,templateid,owner) VALUES (NULL,\"" . $_POST['vmname'] . "\", 0 ,\"deploying\", 0,\"" . $_POST['ostemplate'] . "\", " . $row['uid'] . ");");
    
    $sqlostemplate = "SELECT * FROM ostemplate WHERE ostid = " . $_POST['ostemplate'] . " LIMIT 1";
    
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

    send_apicall2awx($config["aap_jid_createvm"] , $json_body);
    $_SERVER['REQUEST_URI'] = "/vms?overview";
 }


 if(($_SERVER["REQUEST_METHOD"] == "POST" && ($_ENV['REQUEST_URI'] == "/vms?delete"))) {

    $sql = "SELECT vmid,hostname,ipaddress,state FROM vms WHERE vmid = " . $_POST['vmid'] ;
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $sqluserinfo = "SELECT * FROM users WHERE username = '$login_session'";
    $resultuserinfo = mysqli_query($db,$sqluserinfo);
    $userdatainfo= mysqli_fetch_array($resultuserinfo, MYSQLI_ASSOC);
  
    $delete_sql = mysqli_query($db,"DELETE FROM vms where vmid = " . $_POST['vmid'] );
    $json_body = "
    folder: user-systems/". $userdatainfo["usercode"] ."
    servers: ". $row['hostname'];
    
    send_apicall2awx($config["aap_jid_deletevm"], $json_body);
    $_SERVER['REQUEST_URI'] = "/vms?overview";
 }

if ($_SERVER['REQUEST_URI'] == "/vms") {  $overview_active = "active"; $requested_content = "overview";  }
if ($_SERVER['REQUEST_URI'] == "/vms?new") {  $new_active = "active"; $requested_content = "new";  }
if ($_SERVER['REQUEST_URI'] == "/vms?overview")  {  $overview_active = "active"; $requested_content = "overview"; }
if (substr( $_SERVER['REQUEST_URI'], 0, 11 ) == '/vms?action') { $requested_content = "overview"; include("vms_content_action.php"); }


?>

<div class="container-fluid">
      <h2><img src="/images/vm.jpg" width="50"><?php echo $pageTitle; ?></h2>
      <hr>
      <div class="row">
        <div class="form-group col-md-12">
          <p></p>
        </div>
<!--         <div class="form-group col-md-12">
        <ul class="nav nav-tabs">
       <li class="nav-item">
            <a class="nav-link <?php echo $overview_active; ?>" href="/vms?overview">Overview VM</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $new_active; ?>" href="/vms?new">Request new VM</a>
        </li>
        </ul>
         </div>
-->
         <div class="form-group col-md-12">
         <?php if(isset($requested_content)) { include("content/vms_content_". $requested_content . ".php"); } ?>
        </div>

 </div>