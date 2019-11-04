<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $tent_inv = find_by_id('Tent_Inventory',(int)$_GET['id']);
  if(!$tent_inv){
    $session->msg("d","Missing Tent Inventory Id");
    redirect('report.php');
  }
?>
<?php
  $delete_id = delete_by_id('Tent_Inventory',(int)$tent_inv['id']);
  if($delete_id){
      $session->msg("s","Report Deleted");
      redirect('report.php');
  } else {
      $session->msg("d","Report Deletion Failed");
      redirect('report.php');
  }
?>
