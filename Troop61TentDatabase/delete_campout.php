<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $patrol = find_by_id('Campouts',(int)$_GET['id']);
  if(!$patrol){
    $session->msg("d","Missing Campout Id");
    redirect('campout.php');
  }
?>
<?php
  $delete_id = delete_by_id('Campouts',(int)$patrol['id']);
  if($delete_id){
      $session->msg("s","Campout Deleted");
      redirect('campout.php');
  } else {
      $session->msg("d","Campout Deletion Failed");
      redirect('campout.php');
  }
?>
