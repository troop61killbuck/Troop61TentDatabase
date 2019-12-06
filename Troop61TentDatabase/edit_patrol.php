<?php
  $page_title = 'Edit Patrol';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $patrol = find_by_id('Patrols',(int)$_GET['id']);
  if(!$patrol){
    $session->msg("d","Missing patrol id.");
    redirect('patrol.php');
  }
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('patrol-name');
  validate_fields($req_field);
  $cat_name = remove_junk($db->escape($_POST['patrol-name']));
  if(empty($errors)){
        $sql = "UPDATE Patrols SET names='{$cat_name}'";
       $sql .= " WHERE id='{$patrol['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully Updated Patrol");
       redirect('patrol.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('patrol.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('patrol.php',false);
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
           <span>Editing <?php echo remove_junk(ucfirst($patrol['names']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_patrol.php?id=<?php echo (int)$patrol['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="patrol-name" value="<?php echo remove_junk(ucfirst($patrol['names']));?>">
           </div>
           <button type="submit" name="edit_cat" class="btn btn-primary">Update Patrol</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
