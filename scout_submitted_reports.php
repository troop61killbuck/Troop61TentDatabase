<?php
  $page_title = 'Scout Submitted Tent Reports (from JotForm)';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);

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
           <a href="https://www.jotform.com/table/93186829128064" target="_blank" class="btn btn-primary">View Table In New Tab</a><br><br>
           <a href="https://www.jotform.com/" target="_blank" class="btn btn-primary">Sign In To Jotform</a>
         </div>
        </div>
        <div class="panel-body">
          <iframe src="https://www.jotform.com/grid/93194501825054" frameborder="0" style="width: 100%; height: 100%; min-height: 500px; border:none;" scrolling="auto"></iframe>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>