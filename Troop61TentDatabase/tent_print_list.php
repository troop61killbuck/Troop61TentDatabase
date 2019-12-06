<?php
  $page_title = 'Print Tent List';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $tents = join_tent_table_report_2();

?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
</head>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
	  <div class="panel-heading clearfix">
		<center><h3>Troop 61 Patrol Tent Report</h3><br>Beginning Of Campout List<br><br>Campout:_________________________________</center>
	  </div>
        <div id="printTable" class="panel-body">
          <table class="table table-bordered" style="width:100%">
            <thead>
              <tr>
                <th class="text-center" style="width: 10%;">Tent Number</th>
                <th class="text-center" style="width: 10%;">Assigned to Patrol</th>
                <th class="text-center" style="width: 40%;">Scouts In Tent</th>
                <th class="text-center" style="width: 40%;">Issues With Tent</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tents as $tent):?>
              <tr>
                <td class="text-center"><?php echo remove_junk($tent['tent_number']); ?></td>
                <td class="text-center"> <?php echo remove_junk($tent['assigned_to_patrol']); ?></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
<p style="page-break-before: always">
 <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
	  <div class="panel-heading clearfix">
		<center><h3>Troop 61 Patrol Tent Report</h3><br>After Campout List<br><br>Campout:_________________________________</center>
	  </div>
        <div id="printTable" class="panel-body">
          <table class="table table-bordered" style="width:100%">
            <thead>
              <tr>
                <th class="text-center" style="width: 25%;">Tent Number</th>
                <th class="text-center" style="width: 25%;">Assigned to Patrol</th>
                <th class="text-center" style="width: 25%;">Taken Home By</th>
                <th class="text-center" style="width: 25%;">Date Returned</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tents as $tent):?>
              <tr>
                <td class="text-center"><?php echo remove_junk($tent['tent_number']); ?></td>
                <td class="text-center"> <?php echo remove_junk($tent['assigned_to_patrol']); ?></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>