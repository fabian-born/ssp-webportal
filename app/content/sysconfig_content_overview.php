<?php

?>

<div class="container-fluid">
      <h2><?php echo $pageTitle; ?></h2>
      <hr>
      <div class="row">
        <div class="form-group col-md-12">
          <p></p>
            <table class="table noborder">

                <tbody class="noborder">
                    <tr>
                    <th scope="row"></th>
                        <th>Upload SSH private Key</th>
                        <td>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            </form>

                            <script>
                            // Add the following code if you want the name of the file appear on select
                            $(".custom-file-input").on("change", function() {
                            var fileName = $(this).val().split("\\").pop();
                            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                            });
                            </script> 
                            </td>
                            <td> <input name="privkey" type="submit" class="btn btn-info" value="Upload" disabled></td>
                    </tr>
                    <tr>
                    <th scope="row"></th>
                        <th>Upload SSH public Key</th>
                        <td>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            </form>

                            <script>
                            // Add the following code if you want the name of the file appear on select
                            $(".custom-file-input").on("change", function() {
                            var fileName = $(this).val().split("\\").pop();
                            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                            });
                            </script> 
                            </td>
                            <td> <input name="pubkey" type="submit" class="btn btn-info" value="Upload" disabled></td>
                    </tr>
            <?php
                foreach($config as $c => $val) {
                    if (($c == "awx_auth_token") or ($c == "smtp_password") or ($c == "mysql_password")){ $typevalue = "password"; $val = "password still exists!"; }
                    echo "
                    <tr>
                    <th scope=\"row\"></th>
                        <td><small>". $c . "</small></td>
                        <td><small><input class=\"form-control small\" id=\"disabledInput\" type=\"password\" placeholder=\"". $val . "\" disabled></small></td>
                        <td><small>&nbsp;</small></td>
                    </tr>";
                }

            ?>
                </tbody>

            </table>
        </div>
</div>
 </div>