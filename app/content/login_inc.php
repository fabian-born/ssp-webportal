<!-- new -->
<form action="" method="post" id="fileForm" role="form">
You already have an account at <b>Self-Service Portal</b>? Then you can quickly log in here with your credentials.<p> 
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                <input type="text" name="username" class="form-control" placeholder="username" aria-label="username" aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                <input type="password" name="password" class="form-control" placeholder="password" aria-label="password" aria-describedby="basic-addon1" required>
            </div>
            <div class=" mb-3 bg-warning" align="center">
            <?php echo $error; ?>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit_login" value="Login">
            </div>
</form>