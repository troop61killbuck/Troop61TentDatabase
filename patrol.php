<?php
  $page_title = 'Patrol Management';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_patrols = find_all('Patrols')
?>
<?php
 if(isset($_POST['add_pat'])){
   $req_field = array('patrol-name');
   validate_fields($req_field);
   $pat_name = remove_junk($db->escape($_POST['patrol-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO Patrols (names)";
      $sql .= " VALUES ('{$pat_name}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added Patrol");
        redirect('patrol.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
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
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Patrol</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="patrol.php">
            <div class="form-group">
                <input type="text" class="form-control" name="patrol-name" placeholder="Patrol Name">
            </div>
            <button type="submit" name="add_pat" class="btn btn-primary">Add patrol</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Patrols</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Patrols</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_patrols as $pat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($pat['names'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_patrol.php?id=<?php echo (int)$pat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_patrol.php?id=<?php echo (int)$pat['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
