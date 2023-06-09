<?php

include ("./config/config.php");

?>
<?php

if (isset($errormsg)) { echo $errormsg; }
$vmcount = 0;

$sql = "SELECT kid,clustername,state,kubeconfig FROM k8s,users where k8s.owner = users.uid and users.username = '$login_session' ";
$result = mysqli_query($db,$sql);

  $count = mysqli_num_rows ( $result );
  if( $count == 0) {
?>
      <div class="alert alert-primary">

      <strong>Info!</strong> No Kubernetes Cluster found!
    </div>
<?php
    } else { 
      ?>

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Cluster Name</th>
            <th scope="col">State</th>
            <th scope="col">Configuration File</th>
            <th scope="col">Action</th>
      
          </tr>
        </thead>
        <tbody>
      <?php

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{    
    $vmcount++;
    echo "<tr>";
    echo "<th scope=row>". $vmcount ."</small></td>
    <td scope=col><small>". $row['clustername'] ."</small></td>
    <td scope=col><small>". $row['state'] . "</small></td>
    <td scope=col><small>". $row['kubeconfig'] ."</small></td>
    <td scope=col><small>
        <small><a href='?". $_ENV['QUERY_STRING'] . "&vmid=" . $row['kid‚'] . "vmaction=power'> <button type=\"button\" class=\"btn btn-secondary btn-sm\"> Power Toggle </button></a></small> &nbsp; 
        <button type=\"button\" class=\"btn btn-danger btn-sm delete-button\" data-toggle=\"modal\" data-target=\"#exampleModal" .$row['kid']. "\" data-id=\"" . $row['kid'] . "\">delete</button>
        </small></td>";
    echo "</tr>";
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $row['kid'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete a VM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You want to delete your Kubernetes Cluster: <strong> <?php echo $row['clustername'] ?></strong><p>
        
        Please approve!
      </div>
      <div class="modal-footer">
      <form action="/kubernetes?delete" method="post"> 
        <input type="hidden" id="kid" name="kid" value="<?php echo $row['kid'] ?>">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button data-id="" type="submit" class="btn btn-danger btn-sm">Delete Cluster</button>

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

  $sql = "SELECT kid,clustername,state,owner,u.username FROM k8s join users as u where owner = u.uid";
  $result = mysqli_query($db,$sql);
  
    $count = mysqli_num_rows ( $result );
?>  
<h3>All User VMs</h3>
<table class="table table-condensed">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Clustername</th>
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
    <td scope=col><small>". $row['clustername'] ."</small></td>
    <td scope=col><small>". $row['state'] ."</small></td>
    <td scope=col><small>". $row['username'] ."</small></td>
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