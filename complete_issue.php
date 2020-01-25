<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(0);
?>
<?php
     $date = make_date();
  $status = mark_completed('Tent_Issues',(int)$_GET['id'],$date);
  if($status){
      $session->msg("s","Issue Marked As Complete");
      redirect('issues.php');
  } else {
      $session->msg("d","Issue Completion failed Or Missing Prm.");
      redirect('issues.php');
  }
?>
