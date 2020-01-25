<?php
  $page_title = 'Quartermaster Home Page';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
 $c_scout         = count_by_id('Scouts');
 $c_tent         = count_by_id('Tents');
 $c_patrol       = count_by_id('Patrols');
 $c_report       = count_by_id('Tent_Inventory');
 $c_issues       = count_by_id('Tent_Issues');
 $c_open_issues        = count_open_issues('Tent_Issues');
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
  <div class="row">

    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_patrol['total']; ?> </h2>
          <p class="text-muted">Patrols</p>
        </div>
       </div>
    </div>
<div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_scout['total']; ?> </h2>
          <p class="text-muted">Scouts</p>
        </div>
       </div>
    </div>
<div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-yellow">
          <i class="glyphicon glyphicon-tent"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_tent['total']; ?></h2>
          <p class="text-muted">Tents</p>
        </div>
       </div>
    </div>
<div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-pencil"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_report['total']; ?></h2>
          <p class="text-muted">Reports</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-pencil"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_issues['total']; ?> </h2>
          <p class="text-muted">Reported Issues</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-exclamation-sign"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_open_issues['total']; ?> </h2>
          <p class="text-muted">Open Issues</p>
        </div>
       </div>
    </div>

  <div class="row">

  </div>



<?php include_once('layouts/footer.php'); ?>
