<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(0);
?>
<?php
  $status = mark_reported('tent_reports',(int)$_GET['id'],'yes');
  if($status){
      $session->msg("s","Marked As Reported.");
      redirect('tent_report.php');
  } else {
      $session->msg("d","Mark As Reported Failed.");
      redirect('tent_report.php');
  }
?>
