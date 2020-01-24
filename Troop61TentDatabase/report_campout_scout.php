<?php
  $page_title = 'Reports for Selected Scout';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $print = $_GET['id'];

?>
<?php
  $scouts_id = find_by_id('Scouts', $_GET['id']);
  $campouts = join_campout_report_scout($scouts_id['first_name'], $scouts_id['last_name']);

if(!$scouts_id){
  $session->msg("d","Missing Tent id.");
  redirect('report_select_scout.php');
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
           <a href="add_report.php" class="btn btn-primary">Add New</a>
         </div>
   <div class="pull-left">
		<a href="report_select_scout.php" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Return To Selection</a><br><br>
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
                <th class="text-center" style="width: 100px;"> Actions </th>
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
                <td class="text-center">
                  <div class="btn-group">
 <a href="edit_report.php?id=<?php echo (int)$report['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
 <a href="delete_report.php?id=<?php echo (int)$report['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

<script>
function printDiv() {
    newWin = window.open("report_print_scout.php?id=<?php echo $print;?>", "", "width=800,height=900");
    setTimeout(function (){
    newWin.print();
    newWin.close();
    window.location.reload();}, 1000);
}
</script>
