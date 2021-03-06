<?php
  $page_title = 'Print Tents';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $tents = join_tent_table_report_2();

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
		<button onclick="printDiv()" class="btn btn-primary">PRINT THIS PAGE</button>
        </div>
	  </div>
        <div id="printTable" class="panel-body">
          <table class="table table-bordered" style="width:100%">
            <thead>
              <tr>
                <th class="text-center" style="width: 10%;">Tent Number</th>
                <th class="text-center" style="width: 10%;">Assigned to Patrol</th>
                <th class="text-center" style="width: 35%;">Scouts In Tent<br><small><font size="2">(Circle Person Taking Home)</font></small></th>
                <th class="text-center" style="width: 35%;">Issues With Tent</th>
		<th class="text-center" style="width: 10%;">Date Returned</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tents as $tent):?>
              <tr>
                <td class="text-center"><?php echo remove_junk($tent['tent_number']); ?></td>
                <td class="text-center"> <?php echo remove_junk($tent['assigned_to_patrol']); ?></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center">___/___/___</td>
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
   newWin = window.open("tent_print_list.php", "", "width=800,height=900");
    setTimeout(function (){
    newWin.print();
    newWin.close();
    window.location.reload();}, 1000);
}
</script>