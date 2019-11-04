<?php
  $page_title = 'Edit Scout';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $all_patrols = find_all('Patrols');
?>
<?php
$scout = find_by_id('Scouts',(int)$_GET['id']);

if(!$scout){
  $session->msg("d","Missing Scout id.");
  redirect('scout.php');
}
?>
<?php
 if(isset($_POST['scout'])){
    $req_fields = array('scout-firstname', 'scout-lastname', 'scout-patrol', );
    validate_fields($req_fields);

   if(empty($errors)){
     $f_name  = remove_junk($db->escape($_POST['scout-firstname']));
     $l_name  = remove_junk($db->escape($_POST['scout-lastname']));
     $s_pat   = remove_junk($db->escape($_POST['scout-patrol']));
       $query   = "UPDATE Scouts 
SET first_name = '{$f_name}', last_name='{$l_name}', patrol = '{$s_pat}'
WHERE id = {$scout['id']}";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Scout updated ");
                 redirect('scout.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_scout.php?id='.$scout['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_scout.php?id='.$scout['id'], false);
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
            <span>Edit Scout</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_scout.php?id=<?php echo $scout['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="scout-firstname" value="<?php echo remove_junk($scout['first_name']);?>">
			<input type="text" maxlength="1" class="form-control" name="scout-lastname" value="<?php echo remove_junk($scout['last_name']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
			  <select class="form-control" name="scout-patrol">
			    <option value="<?php echo $scout['patrol'] ?>"><?php echo remove_junk($scout['patrol']); ?></option>
				<?php  foreach ($all_patrols as $pat): ?>
				<option value="<?php echo $pat['names'] ?>"><?php echo $pat['names'] ?></option>
                    <?php endforeach; ?>
                    </select>
			</div>
              <button type="submit" name="scout" class="btn btn-danger">Update</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
