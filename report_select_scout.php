<?php
  $page_title = 'Select Reports By Scout';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $all_scouts = report_scouts();
?>

<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
   <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<div class="pull-left">
		<a href="report.php" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Return To All Reports</a></div>
	</div>
		<div class="panel-body">
                    <table id="printTable" class="table table-bordered">

            <tbody>
<?php foreach ($all_scouts as $scout):?>
<tr><td class="text-center"><a href=report_campout_scout.php?id=<?php echo ($scout['id']) . "\n"; ?>> <?php echo $scout['first_name']?> <?php echo $scout['last_name'] ?> </a></td></tr>
		<?php endforeach;?>
		</tbody>
	  </table>
	</div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
