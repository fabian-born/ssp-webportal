<?php

include ("./config/config.php");

?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {

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
  
      echo $json_body;
      send_apicall2awx("12", $json_body);
  ?>
  <div class="alert alert-warning">

  <strong>Info!</strong> VM ( <?php echo $row['hostname'] ?> ) will be deleted now!
</div>
<?php
}

$vmcount = 0;

$sql = "SELECT vmid,hostname,ipaddress,state FROM vms,users where vms.owner = users.uid and users.username = '$login_session' and vms.state != 'deleting'";
$result = mysqli_query($db,$sql);

  $count = mysqli_num_rows ( $result );
  if( $count == 0) {
?>
      <div class="alert alert-primary">

      <strong>Info!</strong> No VMs found!
    </div>
<?php
    } else { 
      ?>

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Hostname</th>
            <th scope="col">IP Address</th>
            <th scope="col">State</th>
            <th scope="col">Action</th>
      
          </tr>
        </thead>
        <tbody>
      <?php

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{    
    $vmcount++;
    echo "<tr>";
    echo "<th scope=row>". $vmcount ."</td>
    <td scope=col>". $row['hostname'] ."</td>
    <td scope=col>". $row['ipaddress'] ."</td>
    <td scope=col>". $row['state'] ."</td>
    <td scope=col>
        <a href='?". $_ENV['QUERY_STRING'] . "&vmid=" . $row['vmid'] . "vmaction=power'><i class=\"fa fa-power-off\"></i></a> &nbsp; 
        <button type=\"button\" class=\"btn btn-outline-danger btn-sm delete-button\" data-toggle=\"modal\" data-target=\"#exampleModal" .$row['vmid']. "\" data-id=\"" . $row['vmid'] . "\">delete</button>
    </td>";
    echo "</tr>";
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $row['vmid'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete a VM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You want to delete your VM: <strong> <?php echo $row['hostname'] ?></strong><p>
        
        Please approve!
      </div>
      <div class="modal-footer">
      <form action="" method="post"> 
        <input type="hidden" id="vmid" name="vmid" value="<?php echo $row['vmid'] ?>">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button data-id="" type="submit" class="btn btn-danger btn-sm">Delete VM</button>

      </form>
      </div>
    </div>
  </div>
</div>
<?php
}
}
?>
  </tbody>
</table>
