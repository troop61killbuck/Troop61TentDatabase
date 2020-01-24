<?php
  $page_title = 'Scouts By Patrol Selection';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
  $scouts = view_all_patrols();


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
    <a href="view_scout.php" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Return To All Scouts</a></div>
  </div>
    <div class="panel-body">
                    <table id="printTable" class="table table-bordered">

            <tbody>
<?php foreach ($scouts as $scout):?>

<tr>
<td class="text-center"><a href=scout_patrol.php?patrol=<?php echo remove_junk(urlencode($scout['names'])); ?>><?php echo remove_junk($scout['names']); ?></a></td> 
</tr>
<?php endforeach; ?>
      </tbody>

    </table>    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

