<?php
  $page_title = 'View Tents Assigned To Selected Patrol';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
  $tents = join_tent_table($_GET['patrol']);
  $print = $_GET['patrol'];

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
<a href="view_tent_select_patrol.php" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Return To Selection</a><br><br>
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
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

<script>
function printDiv() {
    newWin = window.open("tent_print_patrol.php?patrol=<?php echo $print;?>", "", "width=800,height=900");
    setTimeout(function (){
    newWin.print();
    newWin.close();
    window.location.reload();}, 1000);
}
</script>

