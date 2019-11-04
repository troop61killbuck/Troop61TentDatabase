<?php
  $page_title = 'Add Scout';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $all_patrols = find_all('Patrols');

?>

<?php
 if(isset($_POST['add_scout'])){
   $req_fields = array('scout-firstname', 'scout-lastname', 'scout-patrol', );
   validate_fields($req_fields);
   if(empty($errors)){
     $f_name  = remove_junk($db->escape($_POST['scout-firstname']));
     $l_name  = remove_junk($db->escape($_POST['scout-lastname']));
     $s_pat   = remove_junk($db->escape($_POST['scout-patrol']));
     $date    = make_date();

     $query  = "INSERT INTO Scouts (first_name, last_name, patrol, date) 
VALUES ('{$f_name}', '{$l_name}', '{$s_pat}', '{$date}');";
     if($db->query($query)){
       $session->msg('s',"Scout added ");
       redirect('scout.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('scout.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_scout.php',false);
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
            <span>Add New Scout</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_scout.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="scout-firstname" placeholder="Scout's First Name">
			<input type="text" maxlength="1" class="form-control" name="scout-lastname" placeholder="Scout's Last Initial">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="scout-patrol">
                      <option value="">Select Scout's Patrol</option>
                    <?php  foreach ($all_patrols as $pat): ?>
                      <option value="<?php echo $pat['names'] ?>">
                        <?php echo $pat['names'] ?></option>
                    <?php endforeach; ?>
			  </select>
                  </div>
              <button type="submit" name="add_scout" class="btn btn-danger">Add Scout</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
