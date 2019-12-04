<?php
  $page_title = 'Edit Tent';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
$tent = find_by_id('Tents',(int)$_GET['id']);
  $all_patrols = find_all('Patrols');


if(!$tent){
  $session->msg("d","Missing Tent id.");
  redirect('tent.php');
}
?>
<?php
 if(isset($_POST['tent'])){
    $req_fields = array('tent-name','tent-patrol',);
    validate_fields($req_fields);

   if(empty($errors)){
       $s_name  = remove_junk($db->escape($_POST['tent-name']));
       $s_patrol = $_POST['tent-patrol'];

       $query   = "UPDATE Tents 
SET tent_number = '{$s_name}', assigned_to_patrol = '{$s_patrol}'
WHERE id = {$tent['id']}";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Tent updated ");
                 redirect('tent.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_tent.php?id='.$tent['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_tent.php?id='.$tent['id'], false);
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
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Edit Tent</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_tent.php?id=<?php echo $tent['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="tent-name" value="<?php echo remove_junk($tent['tent_number']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
        <select class="form-control" name="tent-patrol">
          <option value="<?php echo $scout['assigned_to_patrol'] ?>"><?php echo remove_junk($tent['assigned_to_patrol']); ?></option>
        <?php  foreach ($all_patrols as $pat): ?>
        <option value="<?php echo $pat['names'] ?>"><?php echo $pat['names'] ?></option>
                    <?php endforeach; ?>
                    </select>
      </div>
              <button type="submit" name="tent" class="btn btn-danger">Update</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
