<?php
  $page_title = 'View All Scouts';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  $scouts = join_scout_table();

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
	     <a href="view_scout_select_patrol.php" class="btn btn-primary">View By Patrol</a>
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
                <th> Scout Name </th>
                <th class="text-center" style="width: 10%;"> Patrol </th>
                <th class="text-center" style="width: 10%;"> Scout Added </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($scouts as $scout):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td><?php echo remove_junk($scout['first_name']); ?> <?php echo remove_junk($scout['last_name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($scout['patrol']); ?></td>
                <td class="text-center"> <?php echo read_date($scout['date']); ?></td>
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
    newWin = window.open("scout_print.php");
    setTimeout(function (){
    newWin.print();
    newWin.close();
    window.location.reload();}, 250);
}
</script>
