<?php
  $page_title = 'Print Reports';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);

?>
<?php
  $scouts_id = find_by_id('Scouts', $_GET['id']);
  $campouts = join_campout_report_scout($scouts_id['first_name'], $scouts_id['last_name']);
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
		<center><h3>Troop 61 Report List</h3><br><h4><?php echo $scouts_id['first_name']; ?> <?php echo $scouts_id['last_name']; ?></h4></center>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 25%;"> Tent Number </th>
                <th class="text-center" style="width: 25%;"> Date Returned </th>
		    <th class="text-center" style="width: 25%;"> Campout </th>
                <th class="text-center" style="width: 25%;"> Patrol </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($campouts as $report):?>
              <tr>
                <td class="text-center"> <?php echo remove_junk($report['tent_number']); ?></td>
                <td class="text-center"> <?php echo remove_junk($report['date_returned']); ?></td>
                <td class="text-center"> <?php echo remove_junk($report['campout']); ?></td>
                <td class="text-center"> <?php echo remove_junk($report['patrol']); ?></td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
  </div>
