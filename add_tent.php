<?php
  $page_title = 'Add Tent';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
    $patrols = view_all_patrols();
?>

<?php
 if(isset($_POST['add_tent'])){
   $req_fields = array('tent-number','tent-patrol', );
   validate_fields($req_fields);
   if(empty($errors)){
     $t_num  = remove_junk($db->escape($_POST['tent-number']));
     $t_pat   = remove_junk($db->escape($_POST['tent-patrol']));
     $date    = make_date();

     $query  = "INSERT INTO Tents (tent_number, assigned_to_patrol, date) 
VALUES ('{$t_num}', '{$t_pat}', '{$date}');";
     if($db->query($query)){
       $session->msg('s',"Tent added ");
       redirect('tent.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('tent.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_tent.php',false);
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
            <span>Add New Tent</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_tent.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="tent-number" placeholder="Tent Number">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="tent-patrol">
                      <option value="">Select Tent's Patrol</option>
                       <?php foreach ($patrols as $patrol):?>
			    <option value="<?php echo ($patrol['names']); ?>"><?php echo ($patrol['names']); ?></option>
			    <?php endforeach; ?>
                    </select>
                  </div>
              <button type="submit" name="add_tent" class="btn btn-danger">Add Tent</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
