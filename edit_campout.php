<?php
  $page_title = 'Edit Campout';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $campout = find_by_id('Campouts',(int)$_GET['id']);
  if(!$campout){
    $session->msg("d","Missing Campout ID");
    redirect('campout.php');
  }
?>

<?php
if(isset($_POST['edit_camp'])){
  $req_field = array('campout-dates');
  $req_field = array('campout-location');
  validate_fields($req_field);
  $camp_dates = remove_junk($db->escape($_POST['campout-dates']));
  $camp_loc = remove_junk($db->escape($_POST['campout-location']));
  if(empty($errors)){
        $sql = "UPDATE Campouts SET dates='{$camp_dates}', location='{$camp_loc}'";
       $sql .= " WHERE id='{$campout['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully Updated Campout");
       redirect('campout.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
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
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editing <?php echo remove_junk(ucfirst($campout['names']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_campout.php?id=<?php echo (int)$campout['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="campout-dates" value="<?php echo remove_junk(ucfirst($campout['dates']));?>">
           </div>
           <div class="form-group">
               <input type="text" class="form-control" name="campout-location" value="<?php echo remove_junk(ucfirst($campout['location']));?>">
           </div>
           <button type="submit" name="edit_camp" class="btn btn-primary">Update Campout</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>