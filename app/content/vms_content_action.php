<?php

include ("./config/config.php");

$sqluserinfo = "SELECT * FROM users WHERE username = '$login_session'";
$resultuserinfo = mysqli_query($db,$sqluserinfo);
$userdatainfo= mysqli_fetch_array($resultuserinfo, MYSQLI_ASSOC);

$json_body = "
    servers: ". $_POST['vmname'] ."
    folder: user-systems/". $userdatainfo["usercode"] ."
    action: reboot";

$vmactionmessage = "" . $_GET["vmid"];
echo $vmactionmessage;
?>