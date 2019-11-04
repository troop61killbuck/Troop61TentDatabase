<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(0);
?>
<?php
  $status = force_password_reset_by_id('users',(int)$_GET['id']);
  if($status){
      $session->msg("s","User Password Reset Forced Upon Next Login.");
      redirect('users.php');
  } else {
      $session->msg("d","User activation failed Or Missing Prm.");
      redirect('users.php');
  }
?>
