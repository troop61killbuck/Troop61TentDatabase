<?php include_once('includes/load.php'); ?>
<?php
$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

if (empty($errors)) {

    $user = authenticate_v2($username, $password);

	if ($user) {
         if ($user['status'] === '1') {
                
			       	      if ($user['reset_password'] === '1') {
           				 //create session with id
            		        	$session->login($user['id']);
            		        	//Update Sign in time
           				 updateLastLogIn($user['id']);
					redirect('forced_password_reset_login.php',false);
			       	      }
			       	      
			       	      else {
                                      //create session with id
                                      $session->login($user['id']);
                                     //Update Sign in time
                                     updateLastLogIn($user['id']);
		                      // redirect user to group home page by user level
						if ($user['user_level'] === '0') {
                                         $session->msg("s", "Hello ".$user['username'].", Welcome to the Troop 61 Tent Database Testing Site.");
                                         redirect('admin.php',false); }
                                    elseif ($user['user_level'] === '1') {
                                         $session->msg("s", "Hello ".$user['username'].", Welcome to the Troop 61 Tent Database Testing Site.");
                                         redirect('quartermaster.php',false); }
                                    elseif ($user['user_level'] === '2') {
                                         $session->msg("s", "Hello ".$user['username'].", Welcome to the Troop 61 Tent Database Testing Site.");
                                         redirect('home.php',false); }
                                    else {
                                         $session->msg("s", "Hello ".$user['username'].", Welcome to the Troop 61 Tent Database Testing Site.");
                                         redirect('home.php',false); }
	                            }
	                            }
elseif ($user['status'] === '0') {
             $session->msg("d", "You cannot login at theis time, you have been deactivated. If you feel that this is an error, please contact the system administrator.");
             redirect('index.php',true);
           }
           }
        else {
          $session->msg("d", "Sorry Username/Password incorrect.");
          redirect('index.php',false);
        }

} else {

     $session->msg("d", $errors);
     redirect('index.php',false);
  }

?>
