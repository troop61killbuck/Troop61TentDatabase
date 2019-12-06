<?php
  $page_title = 'Edit Issue';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $tent_inv = find_by_id('Tent_Issues',(int)$_GET['id']);
  $all_tents = report_tents();
  if(!$tent_inv){
    $session->msg("d","Missing Tent Inventory ID");
    redirect('issues.php');
  }
?>

<?php
if(isset($_POST['edit_issues'])){
  $req_fields = array('tent-number', 'issue');
   validate_fields($req_fields);
   if(empty($errors)){
     $t_num  = remove_junk($db->escape($_POST['tent-number']));
     $issue  = remove_junk($db->escape($_POST['issue']));
     $date    = make_date();

     $query  = "UPDATE Tent_Issues SET tent_number='{$t_num}', issue='{$issue}' WHERE id='{$tent_inv['id']}';";
     if($db->query($query)){
       $session->msg('s',"Issue Edited");
       redirect('issues.php', false);
     } else {
       $session->msg('d',' Sorry failed to add!');
       redirect('issues.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('edit_issue.php',false);
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
            <span>Edit Issue</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="edit_issue.php?id=<?php echo $tent_inv['id'] ?>" class="clearfix">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="tent-number">
                      <option value="<?php echo $tent_inv['tent_number'] ?>"><?php echo remove_junk($tent_inv['tent_number']); ?></option>
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
                    <input type="text" class="form-control" name="issue" value="<?php echo remove_junk(ucwords($tent_inv['issue'])); ?>">
                  </div>
                  </div>
                  </div>
              <button type="submit" name="edit_issues" class="btn btn-danger">Edit Issue</button>
          </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
