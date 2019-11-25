<?php
  $page_title = 'Edit Report';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $tent_inv = find_by_id('Tent_Inventory',(int)$_GET['id']);
  $all_scouts = report_scouts();
  $all_tents = report_tents();
  $all_campouts = report_campouts();
  $reports = join_report_table();
  $all_patrols = view_all_patrols();
  if(!$tent_inv){
    $session->msg("d","Missing Tent Inventory ID");
    redirect('report.php');
  }
?>

<?php
if(isset($_POST['edit_rep'])){
  $req_fields = array('scout-name', 'tent-number', 'campout', 'patrol');
   validate_fields($req_fields);
     $s_name  = remove_junk($db->escape($_POST['scout-name']));
     $t_num  = remove_junk($db->escape($_POST['tent-number']));
     $camp  = remove_junk($db->escape($_POST['campout']));
     $patrol = remove_junk($db->escape($_POST['patrol']));
     $date_returned  = remove_junk($db->escape($_POST['date-returned']));
   if(empty($errors)){
        $sql = "UPDATE Tent_Inventory SET tent_number='{$t_num}', patrol='{$patrol}', date_returned='{$date_returned}', campout='{$camp}', name='{$s_name}'";
       $sql .= " WHERE id='{$tent_inv['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully Updated Campout");
       redirect('report.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('report.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('report.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editing Report</span>
        </strong>
       </div>
       <div class="panel-body">
         <div class="col-md-12">
         <form method="post" action="edit_report.php?id=<?php echo (int)$tent_inv['id'];?>">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="tent-number">
                      <option value="<?php echo remove_junk($tent_inv['tent_number']); ?>"><?php echo remove_junk($tent_inv['tent_number']); ?></option>
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
        <div class="input-group date" data-provide="datepicker">
              <input type="text" class="form-control" name="date-returned" value="<?php echo remove_junk($tent_inv['date_returned']); ?>">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
               </div>
        </div>
                  </div>
      </div>
                  </div>
              <div class="form-group">
                <div class="row">
      <div class="col-md-6">
                    <select class="form-control" name="campout">
                      <option value="<?php echo remove_junk($tent_inv['campout']); ?>"><?php echo remove_junk($tent_inv['campout']); ?></option>
                    <?php  foreach ($all_campouts as $campout): ?>                  
<option value="<?php echo $campout['dates']?>, <?php echo $campout['location']?>"><?php echo $campout['dates']?>, <?php echo $campout['location']?></option>

                    <?php endforeach; ?>
                    </select>
                  </div>
      </div>
                  </div>
              <div class="form-group">
                <div class="row">
      <div class="col-md-6">
                    <select class="form-control" name="scout-name">
                      <option value="<?php echo remove_junk($tent_inv['name']); ?>"><?php echo remove_junk($tent_inv['name']); ?></option>
                    <?php  foreach ($all_scouts as $scout): ?>
                      <option value="<?php echo $scout['name'] ?>">
                        <?php echo $scout['name']?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  </div>
                  </div>
                  <div class="form-group">
                <div class="row">
      <div class="col-md-6">
                    <select class="form-control" name="patrol">
                      <option value="<?php echo remove_junk($tent_inv['patrol']); ?>"><?php echo remove_junk($tent_inv['patrol']); ?></option>
                    <?php  foreach ($all_patrols as $patrol): ?>
                      <option value="<?php echo $patrol['names']?>">
                        <?php echo $patrol['names']?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  </div>
                  </div>
           <button type="submit" name="edit_rep" class="btn btn-primary">Update Report</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>

  <script>
$('.datepicker').datepicker({
    startDate: '-3d',
    autoclose: true,

});
  </script>