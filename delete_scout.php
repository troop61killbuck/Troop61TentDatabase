<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $scout = find_by_id('Scouts',(int)$_GET['id']);
  if(!$scout){
    $session->msg("d","Missing Scout id.");
    redirect('scout.php');
  }
?>
<?php
  $delete_id = delete_by_id('Scouts',(int)$scout['id']);
  if($delete_id){
      $session->msg("s","Scout deleted.");
      redirect('scout.php');
  } else {
      $session->msg("d","Scout deletion failed.");
      redirect('scout.php');
  }
?>
