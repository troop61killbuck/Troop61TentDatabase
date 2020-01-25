<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $patrol = find_by_id('Patrols',(int)$_GET['id']);
  if(!$patrol){
    $session->msg("d","Missing Patrol Id");
    redirect('patrol.php');
  }
?>
<?php
  $delete_id = delete_by_id('Patrols',(int)$patrol['id']);
  if($delete_id){
      $session->msg("s","Patrol Deleted");
      redirect('patrol.php');
  } else {
      $session->msg("d","Patrol Deletion Failed");
      redirect('patrol.php');
  }
?>
