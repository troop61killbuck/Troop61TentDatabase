<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(0);
?>
<?php
  $status = force_password_reset_by_id('users',(int)$_GET['id']);
  if($status){
      $session->msg("s","User password reset forced upon next login.");
      redirect('users.php');
  } else {
      $session->msg("d","Failed to require user password reset..");
      redirect('users.php');
  }
?>
