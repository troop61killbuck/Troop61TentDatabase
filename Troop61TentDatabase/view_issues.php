<?php
  $page_title = 'View All Issues';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  $issues = tent_issues();

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
                <th class="text-center"> Issue With Tent </th>
		    <th class="text-center"> Date Issue Marked As Fixed </th>
                <th class="text-center"> Date Issue Added </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($issues as $issue):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($issue['tent_number']); ?></td>
                <td class="text-center"> <?php echo remove_junk($issue['issue']); ?></td>
                <td class="text-center"> <?php echo read_date($issue['date_fixed']); ?></td>
                <td class="text-center"> <?php echo read_date($issue['date_added']); ?></td>
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
    newWin = window.open("issue_print.php");
    setTimeout(function (){
    newWin.print();
    newWin.close();
    window.location.reload();}, 250);
}
</script>