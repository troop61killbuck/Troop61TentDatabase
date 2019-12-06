<?php
  $page_title = 'View All Reports';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  $reports = join_report_table();

?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
         	     <a href="view_report_select_campout.php" class="btn btn-primary">View By Campout</a>
         </div>
   <div class="pull-left">
		<button onclick="printDiv()" class="btn btn-primary">PRINT THIS PAGE</button>
        </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center"> Tent Number </th>
                <th class="text-center"> Date Returned </th>
		    <th class="text-center"> Campout </th>
                <th class="text-center" style="width: 10%;"> Scout Taking Home </th>
                <th class="text-center" style="width: 10%;"> Patrol </th>
                <th class="text-center" style="width: 10%;"> Report Added </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($reports as $report):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($report['tent_number']); ?></td>
                <td class="text-center"> <?php echo remove_junk($report['date_returned']); ?></td>
                <td class="text-center"> <?php echo remove_junk($report['campout']); ?></td>
                <td class="text-center"> <?php echo remove_junk($report['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($report['patrol']); ?></td>
                <td class="text-center"> <?php echo read_date($report['date']); ?></td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

<script>
function printDiv() {
    newWin = window.open("report_print.php");
    setTimeout(function (){
    newWin.print();
    newWin.close();
    window.location.reload();}, 250);
}
</script>