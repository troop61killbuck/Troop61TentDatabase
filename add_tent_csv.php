<?php
  $page_title = 'Add Tent';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(0);
  $tents = join_tent_table_all();
?>
<?php
 if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Tent data has been imported successfully.';
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
          <span>Tents</span>
       </strong><br><br>
       	<div class="pull-left">
			<a href="tent.php" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Return To Main Tents Page</a>
		</div>
<div class="pull-right">
			<a href="docs/tent_upload.csv" class="btn btn-primary" download>Download CSV Template For Adding Tents</a>
		</div>

               </div>
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
<div align="right">
		<?php include_once('upload_tent_csv.php'); ?>
	   </div>

	   </div>
      </div>
      <div class="panel-body">
        <table id="printTable" class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th> Tent Number </th>
              <th class="text-center" style="width: 15%;"> Assigned to Patrol </th>
              <th class="text-center" style="width: 15%;"> Tent Added </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tents as $tent):?>
            <tr>
              <td class="text-center"><?php echo count_id();?></td>
              <td> <?php echo remove_junk($tent['tent_number']); ?></td>
              <td class="text-center"> <?php echo remove_junk($tent['assigned_to_patrol']); ?></td>
              <td class="text-center"> <?php echo read_date($tent['date']); ?></td>
            </tr>
           <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
