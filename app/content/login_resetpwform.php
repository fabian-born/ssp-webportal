<?php


if(($_SERVER["REQUEST_METHOD"] == "POST") && ($_REQUEST['resetpw'] == "Reset Password")) {
    $myusername = mysqli_real_escape_string($db,$_POST['email']);
    $sql = "SELECT uid FROM users WHERE username = '$myusername'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    
    $count = mysqli_num_rows($result);
    
    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 0){
        $rpw_error = "Email address does not exists!";
    }else{
        $new_password = generateRandomString(17);
        $md5_password = md5($new_password);
        $update_sql = mysqli_query($db,"update users set password = '$md5_password' where username = '$myusername' ");
        $testbody = "
        Welcome new Service Portal User,<br>
        your password reset at Service-Portal was successful.<p>
  
        Registered email: <b>" . $_POST['email'] .  "</b><br>
        Your password is: <b>" . $wopassword . "</b><p>
    
        ------------------------------------------------ <br>
        Url:  <a href=\"https://portal-dev.epicshit.io\"> Self-Service Portal</a>   
        ";
        
        sendemailto($_POST['email'],"Self-Service Portal || Registration", $testbody);   
    }
// /login/reset_password.php
}
?>
<!-- new -->

<form action="" method="post" id="fileForm" role="form">
            You have forgotten your password again!<p>
            Please enter your email Address!
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" name="email" class="form-control" placeholder="username" aria-label="username" aria-describedby="basic-addon1" required>
            </div>
            <div class=" mb-3 bg-warning" align="center">
            <?php echo $rpw_error; ?>
            </div>   
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="resetpw" value="Reset Password">
            </div>
</form>