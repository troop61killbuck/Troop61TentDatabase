<?php
  $page_title = 'Campout Management';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_campouts = find_all('Campouts')
?>
<?php
 if(isset($_POST['add_camp'])){
   $req_field = array('campout-start-date');
   $req_field = array('campout-end-date');
   $req_field = array('campout-location');
   validate_fields($req_field);
   $camp_start_date = remove_junk($db->escape($_POST['campout-start-date']));
   $camp_end_date = remove_junk($db->escape($_POST['campout-end-date']));
   $camp_loc = remove_junk($db->escape($_POST['campout-location']));
   if(empty($errors)){
      $sql  = "INSERT INTO Campouts (dates, location)";
      $sql .= " VALUES ('{$camp_start_date} - {$camp_end_date}', '{$camp_loc}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added Campout");
        redirect('campout.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('campout.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('campout.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Campout</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="campout.php">
            <div class="form-group">
      <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control" name="campout-start-date" placeholder="Campout Start Date">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </div>
      </div>
    </div>
            <div class="form-group">
      <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control" name="campout-end-date" placeholder="Campout End Date">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </div>
      </div>
    </div>
            <div class="form-group">
        <input type="text" class="form-control" name="campout-location" placeholder="Campout Location">
            </div>
            <button type="submit" name="add_camp" class="btn btn-primary">Add Campout</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Campouts</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th class="text-center">Campout Dates</th>
        <th class="text-center">Campout Location</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_campouts as $camp):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($camp['dates'])); ?></td>
        <td class="text-center"><?php echo remove_junk(ucfirst($camp['location'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_campout.php?id=<?php echo (int)$camp['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_campout.php?id=<?php echo (int)$camp['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
