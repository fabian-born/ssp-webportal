<?php
      include("functions.php");
      include("./config/config.php");
      $json_body = "
      runlevel: create
      aduser: fabian
      userid: 100
      usercode: xxxx ";

      $testbody = "
      Welcome new Service Portal User,<br>
      your password reset at Service-Portal was successful.<p>

      Registered email: <b>" . $_POST['email'] .  "</b><br>
      Your password is: <b>" . $wopassword . "</b><p>
  
      ------------------------------------------------ <br>
      Url: ". <a href="https://portal-dev.epicshit.io"> Self-Service Portal</a> . "
      
      ";
      
      sendemailto("fabian@fborn.de","Self-Service Portal || Registration", $testbody);
?>


