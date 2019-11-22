<?php
  $page_title = 'Add Scout';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(0);
  $scouts = join_scout_table();
?>
<?php
 if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Scout data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
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
          <span>Scouts</span>
       </strong><br><br>
       	<div class="pull-left">
			<a href="scout.php" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Return To Main Scouts Page</a>
		</div>
<div class="pull-right">
			<a href="docs/scout_upload.csv" class="btn btn-primary" download>Download CSV Template For Adding Scouts</a>
		</div>

               </div>
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
<div align="right">
		<?php include_once('upload_scout_csv.php'); ?>
	   </div>

	   </div>
      </div>
     <div class="panel-body">
      <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Scout Name </th>
                <th class="text-center" style="width: 10%;"> Patrol </th>
                <th class="text-center" style="width: 10%;"> Scout Added </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($scouts as $scout):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td><?php echo remove_junk($scout['first_name']); ?> <?php echo remove_junk($scout['last_name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($scout['patrol']); ?></td>
                <td class="text-center"> <?php echo read_date($scout['date']); ?></td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
     </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
