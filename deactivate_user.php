<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(0);
?>
<?php
  $status = edit_status_by_id('users',(int)$_GET['id'],'0');
  if($status){
      $session->msg("d","User Deactivated.");
      redirect('users.php');
  } else {
      $session->msg("d","User deactivation failed Or Missing Prm.");
      redirect('users.php');
  }
?>
