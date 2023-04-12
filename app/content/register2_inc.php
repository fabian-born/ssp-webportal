<?php
      include("../functions.php");
     if(($_SERVER["REQUEST_METHOD"] == "POST") && ($_REQUEST['submit_reg'] == "Register")) {

            // precheck user
            $sqluser = "SELECT uid FROM users WHERE username = \"" . $_POST['email'] . "\"";

            $resultuser = mysqli_query($db,$sqluser);
            $rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);

            $count = mysqli_num_rows($resultuser);
      
            // If result matched $myusername and $mypassword, table row must be 1 row
      
            if($count == 1) {
                $error = "Email address already exists!";
            }
            if($count == 0) {
            
                //phpinfo();
                // $_POST['firstname']
                // $_POST['lastname']
                // $_POST['email']
                // $_POST['password']
                $usercode = generateRandomString(8);
                $wopassword = generateRandomString(17);
                $password =  md5($wopassword);
                $update_sql = mysqli_query($db,"INSERT INTO users (uid, username, surename,lastname,password,usercode,lastlogin) VALUES (NULL, \"" . $_POST['email'] . "\", \"" . $_POST['firstname'] . "\",\"" . $_POST['lastname'] . "\",\"" . $password . "\",\"" . $usercode . "\", now());");
                
                $aduser = strtolower(substr($_POST['firstname'],0,3) ."". substr($_POST['lastname'],0,3));

                # Starting Userprocess bg
                $sqluser = "SELECT uid FROM users WHERE surename = \"" . $_POST['firstname'] . "\" AND  username = \"" . $_POST['email'] . "\"";

                $resultuser = mysqli_query($db,$sqluser);
                $rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);

                $testbody = "
                Welcome new Service Portal User,<br>
                your registration at Service-Portal was successful.<p>
        
                Registered email: <b>" . $_POST['email'] .  "</b>
                Your password is: <b>" . $wopassword . "</b>
            
                If you have not done this registration yourself, you can ignore this email and do not need to do anything else. Your data will be deleted after 24 hours at the latest.
                ";
                
                sendemailto($_POST['email'],"Self-Service Portal || Registration", $testbody);

                $json_body = "
                runlevel: create
                aduser: " . $aduser ."
                userid: ". $rowuser["uid"] ."
                usercode: ". $usercode;

                send_apicall2awx("38", $json_body);
            }

     }

?>
            <form action="" method="post" id="fileForm" role="form">
            Create a free <b>Self-Service Portal</b> account here. With this account you can fully use the services. <p>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Firstname</span>
                <input type="text" class="form-control" name="firstname" placeholder="Name" aria-label="firstname" aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Lastname</span>
                <input type="text" class="form-control" name="lastname" placeholder="lastname" aria-label="lastname" aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" class="form-control" name="email" placeholder="email" aria-label="Username" aria-describedby="basic-addon1" required>
            </div>
            <div class=" mb-3 bg-warning" align="center">
            <?php echo $error; ?>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit_reg" value="Register">
            </div>



            </form>
            <script type="text/javascript">
  document.getElementById("field_terms").setCustomValidity("Please indicate that you accept the Terms and Conditions");
</script>
