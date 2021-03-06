<?php
  $page_title = 'Select Reports By Campout';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  $campouts = join_campout_report();
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
		<a href="view_report.php" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Return To All Reports</a></div>
	</div>
		<div class="panel-body">
                    <table id="printTable" class="table table-bordered">

            <tbody>
<?php foreach ($campouts as $campout):?>
<tr><td class="text-center"><a href=view_report_campout.php?id=<?php echo ($campout['id']) . "\n"; ?>> <?php echo $campout['dates']?>, <?php echo $campout['location']?> </a></td></tr>
		<?php endforeach;?>
		</tbody>
	  </table>
	</div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
