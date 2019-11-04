<?php
  $page_title = 'Add Report';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $all_scouts = report_scouts();
  $all_tents = report_tents();
  $all_campouts = report_campouts();
?>

<?php
 if(isset($_POST['add_report'])){
   $req_fields = array('scout-name', 'tent-number', 'campout');
   validate_fields($req_fields);
   if(empty($errors)){
     $s_name  = remove_junk($db->escape($_POST['scout-name']));
     $t_num  = remove_junk($db->escape($_POST['tent-number']));
     $camp  = remove_junk($db->escape($_POST['campout']));
     $date    = make_date();

     $query  = "INSERT INTO Tent_Inventory (tent_number, campout, name, patrol, date)
VALUES ('{$t_num}', '{$camp}', '{$s_name}', 'Dragon', '{$date}');";
     if($db->query($query)){
       $session->msg('s',"Report added ");
       redirect('report.php', false);
     } else {
       $session->msg('d',' Sorry failed to add!');
       redirect('report.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_report.php',false);
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
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Report</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_report.php" class="clearfix">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="tent-number">
                      <option value="">Select Tent Number</option>
                    <?php  foreach ($all_tents as $tent): ?>
                      <option value="<?php echo $tent['tent_number'] ?>">
                        <?php echo $tent['tent_number'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  </div>
                  </div>
              <div class="form-group">
                <div class="row">
			<div class="col-md-6">
                    <select class="form-control" name="campout">
                      <option value="">Select Campout Dates</option>
                    <?php  foreach ($all_campouts as $campout): ?>
                      <option value="<?php echo $campout['dates']?>, <?php echo $campout['location']?>">
                        <?php echo $campout['dates']?>, <?php echo $campout['location']?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  </div>
                  </div>
              <div class="form-group">
                <div class="row">
			<div class="col-md-6">
                    <select class="form-control" name="scout-name">
                      <option value="">Select Scout Name</option>
                    <?php  foreach ($all_scouts as $scout): ?>
                      <option value="<?php echo $scout['first_name'] ?> <?php echo $scout['last_name'] ?>">
                        <?php echo $scout['first_name']?> <?php echo $scout['last_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  </div>
                  </div>
              <button type="submit" name="add_report" class="btn btn-danger">Add Report</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
