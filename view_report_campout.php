<?php
  $page_title = 'Reports for Selected Campout';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  $print = $_GET['id'];

?>
<?php
  $campouts_id = find_by_id('Campouts', $_GET['id']);
  $campouts = join_campout_report_campout($campouts_id['dates'], $campouts_id['location']);

if(!$campouts_id){
  $session->msg("d","Missing Tent id.");
  redirect('tent.php');
}
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
		<button onclick="printDiv()" class="btn btn-primary">PRINT THIS PAGE</button>
         </div>
   <div class="pull-left">
		<a href="view_report_select_campout.php" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Return To Selection</a><br><br>
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
              <?php foreach ($campouts as $report):?>
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
          </table>
        </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

<script>
function printDiv() {
    newWin = window.open("report_print_campout.php?id=<?php echo $print;?>");
    setTimeout(function (){
    newWin.print();
    newWin.close();
    window.location.reload();}, 250);
}
</script>
