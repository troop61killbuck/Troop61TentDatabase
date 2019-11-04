<?php
  $page_title = 'Add Issue';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $all_tents = report_tents();
?>

<?php
 if(isset($_POST['add_issue'])){
   $req_fields = array('tent-number', 'issue');
   validate_fields($req_fields);
   if(empty($errors)){
     $t_num  = remove_junk($db->escape($_POST['tent-number']));
     $issue  = remove_junk($db->escape($_POST['issue']));
     $date    = make_date();

     $query  = "INSERT INTO Tent_Issues (tent_number, issue, date_added)
VALUES ('{$t_num}', '{$issue}', '{$date}');";
     if($db->query($query)){
       $session->msg('s',"Issue Added");
       redirect('issues.php', false);
     } else {
       $session->msg('d',' Sorry failed to add!');
       redirect('issues.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_issue.php',false);
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
            <span>Add New Issue</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_issue.php" class="clearfix">
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
                    <input type="text" class="form-control" name="issue" placeholder="Please Describe The Issue With The Tent">
                  </div>
                  </div>
                  </div>
              <button type="submit" name="add_issue" class="btn btn-danger">Add Issue</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
