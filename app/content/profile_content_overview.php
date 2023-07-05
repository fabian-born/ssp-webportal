<?php
    $pageTitle = "User Info";

    $sql = "SELECT * FROM users WHERE username = '$login_session'";
    $result = mysqli_query($db,$sql);
    $userdata= mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($_REQUEST['subaction'] == "resetpw"){
        $password =  md5($_POST['password']);
        $update_sql="update users set password = '$password' where username = '$login_session'";
        if (mysqli_query($db, $update_sql)) {
            $message = "Password changed!";
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }
    }
    if ($_REQUEST['subaction'] == "disableAD"){
        $update_sql="update userdata set adenabled = false where uid =" .$_POST["uid"];
        mysqli_query($db, $update_sql);
    }
    if ($_REQUEST['subaction'] == "enableAD"){
        $update_sql="update userdata set adenabled = true where uid = ". $_POST["uid"];
        mysqli_query($db, $update_sql);
    }    
?>

<div class="container-fluid">
      <h2><img src="/images/userprofile.png" width="50"><?php echo $pageTitle; ?></h2>
      <hr>
      <div class="row">
        <div class="form-group col-md-12">
          <p></p>
            <table class="table noborder">

                <tbody class="noborder">
                    <tr class="noborder">
                    <th scope="row"></th>
                    <th class="noborder">Fullname</th>
                    <td><?php echo $userdata["surename"] . " " . $userdata["lastname"]; ?></td>
                    <td>
<?php   
            $sql2 = "SELECT * FROM users,userdata where userdata.uid = users.uid and users.username = '$login_session'";
            $result2 = mysqli_query($db,$sql2);

            $count = mysqli_num_rows ( $result2 );
            $userdata2= mysqli_fetch_array($result2, MYSQLI_ASSOC);
            if( $count == 0) {
?>
                    <button type="button" class="btn btn-info btn-sm">Generate Userdata</button>
<?php
            } 
?>
                    </td>
                    </tr>
                    <tr>
                    <th scope="row"></th>
                        <th>Username:</th>
                        <td><?php echo $userdata["username"]; ?></td>
                        <td>&nbsp;</td>
                    </tr>
                    <th scope="row"></th>
                        <th>Password:</th>
                        <td>top secret<p><?php echo $message;?></td>
                        <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModalResetPW" data-id="PW01">Change Password</button></td>
                    </tr>
                    <th scope="row"></th>
                        <th>API token:</th>
                        <td>
                        <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control small" data-toggle="password" disabled value="<?php echo $userdata2["apikeys"]; ?>">
                            <div class="input-group-append">
                            </div>
                         </input>
                        </div>
                        
                        </td>
                        <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModalAPI" data-id="API">Genereate API token</button></td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <th>Usercode:</th>
                        <td><?php echo $userdata["usercode"]; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <th>Active Directory / Unix-User:</th>
                        <td><?php echo $userdata2["adusername"]; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <th>Active Directory enabled?</th>
                        <td></td>
                        <td>
                            <?php 
                            if ($userdata2["adenabled"] != 1){
                                ?>
                                <form action="/index.php?action=userinfo" method="post">
                                    <input type="hidden" id="resetpw" name="subaction" value="enableAD">
                                    <input type="hidden" id="uid" name="uid" value="<?php echo $userdata2["uid"]; ?>">
                                    <button type="submit" class="btn btn-info btn-sm">Enable</button></td>
                                </form>
                            <?php
                            }else {
                            ?>
                               <form action="/index.php?action=userinfo" method="post">
                                    <input type="hidden" id="resetpw" name="subaction" value="disableAD">
                                    <input type="hidden" id="uid" name="uid" value="<?php echo $userdata2["uid"]; ?>">
                                    <button type="submit" class="btn btn-info btn-sm">Disable</button></td>
                                </form>
                            <?php
                                }
                            ?>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <th>SSH Key:</th>
                        <td>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">ssh private key</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="13" readonly style="font-size: 10px;"><?php echo base64_decode($userdata2["ssh_priv_key_1"]); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">ssh public key </label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" readonly style="font-size: 10px;"><?php echo $userdata2["ssh_pub_key_1"]; ?></textarea>
                            </div>
                        </td>
                        <td>
                            <form action="generatessh.php" method="post"> <button type="button" type="submit" class="btn btn-info btn-sm" disabled>Refresh local keys</button></form></td>
                    </tr>
                </tbody>

            </table>
        </div>
</div>
 </div>




<!-- Reset Password-->
<!-- Modal -->
<form action="/index.php?action=userinfo" method="post"> 
<div class="modal fade" id="exampleModalResetPW" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
                <label for="password"><span class="req">* </span> Password: </label>
                    <input required name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16"  id="pass1" placeholder="Enter password"/> </p>
                     <span id="confirmMessage" class="confirmMessage"></span>
      </div>
      <div class="modal-footer">
      
        <input type="hidden" id="resetpw" name="subaction" value="resetpw">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button data-id="" type="submit" class="btn btn-danger btn-sm">Reset Password</button>

  
      </div>
    </div>
  </div>
</div>
</form>


<!-- Reset Password-->
<!-- Modal -->
<form action="" method="post"> 
<div class="modal" tabindex="-1" id="exampleModalAPI"  aria-hidden="true"> 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</form>



<?php
echo $_POST['password'];
?>