<?php
  $page_title = 'All Users';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
 page_require_level(0);
//pull out all user form database
 $all_users = find_all_user();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Users</span>
       </strong>
         <a href="add_user.php" class="btn btn-primary pull-right">Add New User</a><br><br>
	   <a href="add_user_csv.php" class="btn btn-primary pull-right">Add New User By Uploading A CSV File</a>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Name </th>
            <th>Username</th>
            <th class="text-center" style="width: 15%;">User Role</th>
            <th class="text-center" style="width: 10%;">Status</th>
		<th class="text-center" style="width: 10%;">Activate/Deactivate</th>
            <th style="width: 20%;">Last Login</th>
            <th class="text-center" style="width: 100px;">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_users as $a_user): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_user['name']))?></td>
           <td><?php echo remove_junk(ucwords($a_user['username']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name']))?></td>
           <td class="text-center">
           <?php if($a_user['status'] === '1'): ?>
            <span class="label label-success"><?php echo "Active"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Deactive"; ?></span>
          <?php endif;?>
           </td>
           <td class="text-center">
           <?php if($a_user['status'] === '1'): ?>
           <div class="btn-group">
                <a href="deactivate_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Deactivate User">Deactivate User
               </a>
		</div>
          <?php else: ?>
           <div class="btn-group">
                <a href="activate_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Activate User">Activate User
               </a>
		</div>
          <?php endif;?>
           </td>
           <td><?php echo read_date($a_user['last_login'])?></td>
           <td class="text-center">
             <div class="btn-group">
                <a href="edit_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
<a href="delete_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
                <?php if($a_user['reset_password'] === '0'): ?>
<a href="force_password_reset.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Force Password Reset On Next Login">
                  <i class="glyphicon glyphicon-lock"></i>
                </a>
          <?php else: ?>
          <?php endif;?>
                </div>
           </td>
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
