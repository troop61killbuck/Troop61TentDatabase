<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $tent = find_by_id('Tents',(int)$_GET['id']);
  if(!$tent){
    $session->msg("d","Missing Tent id.");
    redirect('tent.php');
  }
?>
<?php
  $delete_id = delete_by_id('Tents',(int)$tent['id']);
  if($delete_id){
      $session->msg("s","Tent deleted.");
      redirect('tent.php');
  } else {
      $session->msg("d","Tent deletion failed.");
      redirect('tent.php');
  }
?>
