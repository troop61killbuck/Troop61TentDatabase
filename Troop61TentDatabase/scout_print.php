<?php
  $page_title = 'Print All Scouts';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
  $scouts = join_scout_table();

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
		<center><h3>Troop 61 Scout List</h3></center>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 33%;"> Scout Name </th>
                <th class="text-center" style="width: 33%;"> Patrol </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($scouts as $scout):?>
              <tr>
                
                <td class="text-center"><?php echo remove_junk($scout['first_name']); ?> <?php echo remove_junk($scout['last_name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($scout['patrol']); ?></td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>