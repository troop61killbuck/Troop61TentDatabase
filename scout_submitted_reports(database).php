<?php
  $page_title = 'All Reports';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $reports = join_tent_report_table();

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
           <a href="add_report.php" class="btn btn-primary">Add New</a> <br> <br>
         	     <a href="report_select_campout.php" class="btn btn-primary">View By Campout</a> <br> <br>
         	     <a href="report_select_scout.php" class="btn btn-primary">View By Scout</a>
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
                <th class="text-center">Name </th>
                <th class="text-center">Tent Number </th>
                <th class="text-center">Patrol </th>
                <th class="text-center">Campout </th>
                <th class="text-center">Number of Stakes </th>
                <th class="text-center">Number of Top Poles </th>
                <th class="text-center">Number of Leg Poles </th>
                <th class="text-center">Number of Rainfly Poles </th>
                <th class="text-center">Number of Plastic Pole Connectors </th>
                <th class="text-center">Number on Tent </th>
                <th class="text-center">Number on Rainfly </th>
                <th class="text-center">Number on Tent Bag </th>
                <th class="text-center">Number on Pole Bag </th>
                <th class="text-center">Number on Stake Bag </th>
                <th class="text-center">Other Issues </th>
                <th class="text-center">Date </th>
                <th class="text-center">Report </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($reports as $report):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"><?php echo remove_junk($report['name']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['tent_number']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['patrol']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['campout']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['stakes']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['top_pole']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['leg_poles']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['rainfly_pole']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['plastic_connectors']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['tent']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['rainfly']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['tent_bag']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['pole_bag']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['stake_bag']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['other_issues']); ?></td>
                <td class="text-center"><?php echo remove_junk($report['date']); ?></td>
                <td class="text-center"><div class="btn-group">
                <a href="mark_reported.php?id=<?php echo (int)$report['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Mark Reported">Mark As Reported</a>
		</div></td>
                <td class="text-center"><div class="btn-group">
 <a href="edit_report.php?id=<?php echo (int)$report['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
 <a href="delete_report.php?id=<?php echo (int)$report['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div></td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
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