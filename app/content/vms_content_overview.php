<?php

include ("./config/config.php");


$vmcount = 0;

# $sql = "SELECT vmid,hostname,ipaddress,state FROM vms,users where vms.owner = users.uid and users.username = '$login_session' and vms.state != 'deleting'";
$sql = "SELECT vms.vmid,users.username,vms.hostname,vms.state,vms.ipaddress,ostemplate.ram,ostemplate.vcpu,ostemplate.disk,ostemplate.vmimage FROM vms,ostemplate,users where vms.owner = users.uid AND vms.templateid = ostemplate.ostid and users.username = '$login_session' and vms.state != 'deleting'";
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
<!-- neuer vm view -->

<div class="row">
				<div class="col-md-10">
					<div class="card bg-default">
						<h5 class="card-header" style="background-color: #778899; color: #FFFFFF;">
            <i class="fa-solid fa-signal"></i> Your VM Overview 
						</h5>
                   
                    <p>
                    <div class="panel-body">
                        <table class="table table-condensed table-striped table-borderless ">


<?php


while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{    
    $vmcount++;

    echo "<tbody>
                            <tr data-toggle=\"collapse\" data-target=\"#vm". $vmcount ."\" class=\"accordion-toggle\">
                                <td colspan=\"3\" style=\"background-color: #FFFAFA;\"><i class=\"fa fa-server\" > </i>
                                <a class=\"text-decoration-none link-dark card-link collapsed text-end\" data-toggle=\"collapse\"> .: <b>". $row['hostname'] ." </b> :.</a></td>
                                <td colspan=\"2\" style=\"background-color: #FFFAFA;\"></td>
                                <td class=\"text-end\" style=\"background-color: #FFFAFA;\">";

                                if ($row['state'] == "deploying") { echo "<i class=\"fa-solid fa-person-walking-luggage\"></i>";}
                                if ($row['state'] == "poweredon") { echo "<i class=\"fa fa-person-walking\"></i>"; }
                                if ($row['state'] == "poweredoff") { echo "<i class=\"fa-solid fa-hand\"></i>"; }
echo "                                </td>
                            </tr>
                            <tr>
                                <td colspan=\"6\" class=\"hiddenRow\"><div id=\"vm". $vmcount ."\" class=\"accordian-body collapse\">
                                
                                <table class=\"table table-default table-borderless\">
                                <tr>
                                  <th scope=row class=\"text-center\"><small> VM ID</small></td>
                                  <td scope=row class=\"text-start\"><small>". $vmcount ."</small></td>
                                  <td scope=row><small>&nbsp;</small></td>
                                  <th scope=row class=\"text-end\"><small>Hostname: </small></td>
                                  <td scope=row><small>". $row['hostname'] ."</small></td>
                                </tr>
                                <tr>
                                  <th scope=col class=\"text-center\"><small>IP Address:</small></td>
                                  <td scope=col><small>". $row['ipaddress'] ."</small></td>
                                  <td scope=row><small>&nbsp;</small></td>
                                  <th scope=row class=\"text-end\"><small>Power state:</small></td>
                                  <td scope=col><small>". $row['state'] ."</small></td>
                                </tr>
                                <tr>
                                  <td colspan=5 class=\"text-center\"></td>
                                </tr>
                                <tr>
                                  <th scope=col class=\"text-center\"><small>CPU: </small></td>
                                  <td scope=col><small>". $row['vcpu'] ."</small></td>
                                  <td scope=row><small>&nbsp;</small></td>
                                  <th scope=row class=\"text-end\"><small>RAM:</small></td>
                                  <td scope=col><small>". $row['ram'] ."</small></td>
                                </tr>
                                <tr>
                                  <th scope=col class=\"text-center\"><small>Disk: </small></td>
                                  <td scope=col><small>". $row['disk'] ."</small></td>
                                  <td scope=row><small>&nbsp;</small></td>
                                  <th scope=row class=\"text-end\"><small>Operating System:</small></td>
                                  <td scope=col><small>". $row['vmimage'] ."</small></td>
                                </tr>
                                <tr>
                                  <td scope=col colspan=5 class=\"text-end\"><small>
                                      <small><a href='/vms?action&vmid=" . $row['vmid'] . "vmaction=power'> <button type=\"button\" class=\"btn btn-secondary btn-sm\"> Power Toggle </button></a></small> &nbsp; 
                                      <button type=\"button\" class=\"btn btn-danger btn-sm delete-button\" data-toggle=\"modal\" data-target=\"#exampleModal" .$row['vmid']. "\" data-id=\"" . $row['vmid'] . "\">delete</button>
                                      </small></td>
                                </tr>
                                </table>
                            </tr>

                        </tbody>";


?>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal<?php echo $row['vmid'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete a VM</h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
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

            </table>
          </div>
				</div>
        <br>
        <?php echo "<button type=\"button\" class=\"text-end btn btn-dark btn-sm delete-button\" data-toggle=\"modal\" data-target=\"#exampleModalNewVM\" data-id=\"" . $row['vmid'] . "\">Request New VM</button>"; ?>
</div>
</div>


<br>
<br>

<!-- alle vms -->
<?php 
if ($userdata["usergroup"] == 0){

  $sql = "SELECT vmid,hostname,ipaddress,state,owner,u.username FROM vms join users as u where owner = u.uid and vms.state != 'deleting'";
  #       "SELECT kid,clustername,state,owner,u.username FROM k8s join users as u where owner = u.uid"
  $result = mysqli_query($db,$sql);
  
    $count = mysqli_num_rows ( $result );
?>  
<h3>All User VMs</h3>
<table class="table table-condensed table-hover">
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
    <td scope=col><small>". $row['username'] ."</small></td>
    <td scope=col><small><i class=\"fa-solid fa-power-off\"></i>&nbsp;<i class=\"fa-solid fa-arrows-spin\"></i>&nbsp;<i class=\"fa-solid fa-trash\"></i></small></td>";
    echo "</tr>";
}
?>
</tbody>
</table>

<?php
}
?>


<!-- MODAL -->
          <!-- Modal -->
          <div class="modal fade" id="exampleModalNewVM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create New VM</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                <form action="/vms?new" method = "post">
                    <div class="row mb-3">
                      <label for="vmname" class="col-sm-2 col-form-label">VM Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="vmname" name="vmname" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputDescription3" class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputDescription3" name="description">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputOSTemplate" class="col-sm-2 col-form-label">OS Template</label>
                      <div class="col-sm-10">
                          <select id="inputState" class="form-control" name="ostemplate" required>
                          <option selected>Choose...</option>
                          <?php
                          $sql = "SELECT ostid,name,ram,vcpu,disk FROM ostemplate";
                          $result = mysqli_query($db,$sql);
                          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                          {    
                              echo "<option value='". $row['ostid'] . "'>". $row['name'] ." (" . $row['vcpu'] ."/". $row['ram'] . "/" . $row['disk'] . ")</option>";
                          }            
                          ?>
                          </select>
                      </div>
                    </div>


                    

                </div>
                <div class="modal-footer">
            
                  <input type="hidden" id="vmid" name="vmid" value="<?php echo $row['vmid'] ?>">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Request</button>

                </form>
                </div>
              </div>
            </div>
          </div>