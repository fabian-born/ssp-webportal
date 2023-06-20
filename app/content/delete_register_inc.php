<?php
      include("../functions.php");
     if($_SERVER["REQUEST_METHOD"] == "POSTsd") {
            phpinfo();
            // phpinfo();
            // $_POST['firstname']
            // $_POST['lastname']
            // $_POST['email']
            // $_POST['password']
            $usercode = generateRandomString(8);
            $password =  md5($_POST['password']);
            $update_sql = mysqli_query($db,"INSERT INTO users (uid, username, surename,lastname,password,usercode,lastlogin) VALUES (NULL, \"" . $_POST['email'] . "\", \"" . $_POST['firstname'] . "\",\"" . $_POST['lastname'] . "\",\"" . $password . "\",\"" . $usercode . "\", now());");
            
            $aduser = strtolower(substr($_POST['firstname'],0,3) ."". substr($_POST['lastname'],0,3));

            # Starting Userprocess bg
            $sqluser = "SELECT uid FROM users WHERE username = \"" . $_POST['email'] . "\"";

            $resultuser = mysqli_query($db,$sqluser);
            $rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);


            $json_body = "
            runlevel: create
            aduser: " . $aduser ."
            userid: ". $rowuser["uid"] ."
            usercode: ". $usercode;

            send_apicall2awx($config["aap_jid_createuser"], $json_body);

     }

?>
            <form action="" method="post" id="fileForm" role="form" name="register">


            <div class="form-group"> 	 

                    <input class="form-control" type="text" name="firstname" id = "txt" onkeyup = "Validate(this)" required placeholder="Surename" /> 
                        <div id="errFirst"></div>    
            </div>

            <div class="form-group">
                    <input class="form-control" type="text" name="lastname" id = "txt" onkeyup = "Validate(this)" placeholder="Lastname" required />  
                        <div id="errLast"></div>
            </div>

            <div class="form-group">
                    <input class="form-control" required type="text" name="email" id = "email"  onchange="email_validate(this.value);" placeholder="Email Address"/>   
                        <div class="status" id="status"></div>
            </div>

            <div class="form-group">
                <label for="password"><span class="req">* </span> Password: </label>
                    <input required name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16"  id="pass1" placeholder="Enter password"/> </p>

                    <input required name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16" placeholder="Enter again to validate"  id="pass2" onkeyup="checkPass(); return false;" />
                        <span id="confirmMessage" class="confirmMessage"></span>
            </div>

            <div class="form-group">
            
                <?php //$date_entered = date('m/d/Y H:i:s'); ?>
                <input type="hidden" value="<?php //echo $date_entered; ?>" name="dateregistered">
                <input type="hidden" value="0" name="activate" />
                <hr>

                <input type="checkbox" required name="terms" onchange="this.setCustomValidity(validity.valueMissing ? 'Please indicate that you accept the Terms and Conditions' : '');" id="field_terms">   <label for="terms">I agree with the <a href="terms.php" title="You may read our terms and conditions by clicking on this link">terms and conditions</a> for Registration.</label><span class="req">* </span>
            </div>

            <div class="form-group">
                <input class="btn btn-success" type="submit" name="submit_reg" value="Register">
            </div>
                      <h5>You will receive an email to complete the registration and validation process. </h5>
                      <h5>Be sure to check your spam folders. </h5>
 
            </form>
            <script type="text/javascript">
  document.getElementById("field_terms").setCustomValidity("Please indicate that you accept the Terms and Conditions");
</script>
