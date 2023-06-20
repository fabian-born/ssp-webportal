<?php

include ("./config/config.php");


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
    echo "<th scope=row><small>". $vmcount ."</small></td>
    <td scope=col><small>". $row['hostname'] ."</small></td>
    <td scope=col><small>". $row['ipaddress'] ."</small></td>
    <td scope=col><small>". $row['state'] ."</small></td>
    <td scope=col><small>
        <small><a href='?". $_ENV['QUERY_STRING'] . "&vmid=" . $row['vmid'] . "vmaction=power'> <button type=\"button\" class=\"btn btn-secondary btn-sm\"> Power Toggle </button></a></small> &nbsp; 
        <button type=\"button\" class=\"btn btn-danger btn-sm delete-button\" data-toggle=\"modal\" data-target=\"#exampleModal" .$row['vmid']. "\" data-id=\"" . $row['vmid'] . "\">delete</button>
        </small></td>";
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
      <form action="/vms?delete" method="post"> 
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




<!-- alle vms -->
<?php 
if ($userdata["usergroup"] == 0){

  $sql = "SELECT vmid,hostname,ipaddress,state,owner FROM vms,users where vms.owner = users.uid and vms.state != 'deleting'";
  $result = mysqli_query($db,$sql);
  
    $count = mysqli_num_rows ( $result );
?>  
<h3>All User VMs</h3>
<table class="table table-condensed">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Hostname</th>
            <th scope="col">IP Address</th>
            <th scope="col">State</th>
            <th scope="col">Owner</th>
            <th scope="col">Action</th>
      
          </tr>
        </thead>
        <tbody>
<?php
  $vmcount=0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{    
    $vmcount++;
    echo "<tr>";
    echo "<th scope=row><small>". $vmcount ."</small></td>
    <td scope=col><small>". $row['hostname'] ."</small></td>
    <td scope=col><small>". $row['ipaddress'] ."</small></td>
    <td scope=col><small>". $row['state'] ."</small></td>
    <td scope=col><small>". $row['owner'] ."</small></td>
    <td scope=col><small></small>
    </td>";
    echo "</tr>";
}
?>
</tbody>
</table>

<?php
}
?>