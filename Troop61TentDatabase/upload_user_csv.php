<?php
// Load the database configuration file
include_once 'includes/dbConfig.php';
?>

<div class="row">
    <!-- Import link -->
    </div>
    <div class="col-md-12">
        <form action="importData_user.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" name="file" class="btn btn-default btn-file"/>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
    </div>
    </div>