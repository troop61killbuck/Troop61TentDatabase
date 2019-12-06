<?php
  $page_title = 'All Tents';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $tents = join_tent_table_all();

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
           <a href="add_tent.php" class="btn btn-primary pull-right">Add New</a><br><br>
           <a href="add_tent_csv.php" class="btn btn-primary pull-right">Add Tents By Uploading A CSV File</a><br><br>
	     <a href="tent_select_patrol.php" class="btn btn-primary pull-right">View By Patrol</a>
         </div>
         <div class="pull-left">
		<button onclick="printDiv()" class="btn btn-primary">PRINT THIS PAGE</button>
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
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tents as $tent):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td> <?php echo remove_junk($tent['tent_number']); ?></td>
                <td class="text-center"> <?php echo remove_junk($tent['assigned_to_patrol']); ?></td>
                <td class="text-center"> <?php echo read_date($tent['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
 <a href="edit_tent.php?id=<?php echo (int)$tent['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
 <a href="delete_tent.php?id=<?php echo (int)$tent['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
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
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

<script>
function printDiv() {
    newWin = window.open("tent_print.php");
    setTimeout(function (){
    newWin.print();
    newWin.close();
    window.location.reload();}, 250);
}
</script>
