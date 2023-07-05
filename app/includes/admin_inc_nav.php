<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="/"><img src="images/digitaltwin_logo.png" width="225"></a>
        <div id="close-sidebar">
          
        </div>
      </div>
      <div class="sidebar-header">

        <div class="user-info">
          <span class="user-name">
<?php
  $sql = "SELECT * FROM users WHERE username = '$login_session'";
  $result = mysqli_query($db,$sql);
  $userdata= mysqli_fetch_array($result, MYSQLI_ASSOC);
  
?>
            <strong><?php echo $userdata["lastname"] .", ". $userdata["surename"]; ?></strong>
          </span>
          <span class="user-role"> (<?php echo $userdata["usercode"]; ?>)</span>
          <span class="user-role">last login (UTC): <?php echo $login_last_session; ?></span>
          <span class="user-role">version: <?php echo file_get_contents('./RELEASE'); ?></span>
        </div>
      </div>
      <!-- sidebar-header  -->

      <!-- sidebar-search  -->
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>
          <li>
            <a href="/vms">
              <i class="fa fa-server"></i>
              <span>Virtual Maschine</span>
            </a>
          </li>
          <li>
            <a href="/kubernetes">
            <i class="fa fa-server"></i>
              
              <span>Kubernetes</span>
            </a>
          </li>       
        </ul>
      </div>
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>Admin Area</span>
          </li>
          <li>
            <a href="/profile">
              <i class="fa fa-id-card"></i>
              <span><?php echo $userdata["surename"] . " " . $userdata["lastname"]; ?></span>
            </a>
          </li>
<?php
  if($userdata["usergroup"] == "0") {
?>
          <li>
            <a href="/sysconfig">
              <i class="fa fa-cog"></i>
              <span>System Config</span>
            </a>
          </li>
  <?php
  }
  ?>
          <li>
            <a href="http://digitaltwin-ssp-dev-kuma.ntap-wdf.local/status/digitaltwin-ssp">
              <i class="fa fa-signal"></i>
              <span>System Status</span>
            </a>
          </li>

          
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <a href="logout.php">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </nav>