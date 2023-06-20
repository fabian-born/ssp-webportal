<?php

include ("./config/config.php");

?>

<form action="/kubernetes?new" method = "post">
  <div class="row mb-3">
    <label for="clustername" class="col-sm-2 col-form-label">Kubernetes Clustername</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="clustername" name="clustername" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputDescription3" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputDescription3" name="description">
    </div>
  </div>
  <div class="row mb-3">

  </div>


  <button type="submit" class="btn btn-primary">Request</button>
</form>
<?php

?>