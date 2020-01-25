<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $tent_inv = find_by_id('Tent_Issues',(int)$_GET['id']);
  if(!$tent_inv){
    $session->msg("d","Missing Tent Issue Id");
    redirect('issues.php');
  }
?>
<?php
  $delete_id = delete_by_id('Tent_Issues',(int)$tent_inv['id']);
  if($delete_id){
      $session->msg("s","Issue Deleted");
      redirect('issues.php');
  } else {
      $session->msg("d","Issue Deletion Failed");
      redirect('issues.php');
  }
?>
