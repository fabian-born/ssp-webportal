<?php

include ("./config/config.php");

?>

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


  <button type="submit" class="btn btn-primary">Request</button>
</form>
<?php

?>