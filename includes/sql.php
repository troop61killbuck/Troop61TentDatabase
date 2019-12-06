<?php
  require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}

/*--------------------------------------------------------------*/
/* Function for perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}

/*--------------------------------------------------------------*/
/*  Function for find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*--------------------------------------------------------------*/
/*  Function for find data from table by tent number
/*--------------------------------------------------------------*/
function find_by_tent_number($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE tent_number='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*--------------------------------------------------------------*/
/*  Function for find data from table by patrol
/*--------------------------------------------------------------*/
function find_by_patrol($table,$patrol)
{
  global $db;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE assigned_to_patrol='{$db->escape($patrol)}'");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*--------------------------------------------------------------*/
/* Function for delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

/*--------------------------------------------------------------*/
/* Function for edit active
/*--------------------------------------------------------------*/
function edit_status_by_id($table,$id,$status)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE ".$db->escape($table);
    $sql .= " SET status =". $db->escape($status);
    $sql .= "  WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

/*--------------------------------------------------------------*/
/* Function for marking an issue as fixed
/*--------------------------------------------------------------*/
function mark_completed($table,$id,$status)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE {$table}";
    $sql .= " SET date_fixed='{$status}'";
    $sql .= "  WHERE id={$id}";
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

/*------------------------------------------------------------------------------*/
/* Function for forcing a user to reset their password upon their next login
/*------------------------------------------------------------------------------*/
function force_password_reset_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE ".$db->escape($table);
    $sql .= " SET reset_password = 1";
    $sql .= "  WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

/*--------------------------------------------------------------*/
/* Function for count id  by table name
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

/*--------------------------------------------------------------*/
/* Function for count open issues by table name (issues table)
/*     -Needed to make admin and quartermaster homepages work
/*--------------------------------------------------------------*/

function count_open_issues($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM $table WHERE date_fixed='0'";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }

  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
   function authenticate_v2($username='', $password='') {
     global $db;
     $username = $db->escape($username);
     $password = $db->escape($password);
     $sql  = sprintf("SELECT id,username,password,user_level,status,reset_password FROM users WHERE username ='%s' LIMIT 1", $username);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $user = $db->fetch_assoc($result);
       $password_request = sha1($password);
       if($password_request === $user['password'] ){
         return $user;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /* Find current log in user by session id
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('users',$user_id);
        endif;
      }
    return $current_user;
  }

  /*--------------------------------------------------------------*/
  /* Find all user by joining users table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,u.reset_password,";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
	{
		global $db;
    $date = make_date();
    $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}

  /*--------------------------------------------------------------*/
  /* Find all group names
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Find all active
  /*--------------------------------------------------------------*/
  function find_by_active($val)
  {
    global $db;
    $sql = "SELECT status FROM users WHERE id = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Find group level
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Function for checking which user level has access to page
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['user_level']);
     //if user not login
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Please login...');
            redirect('index.php', false);
      //if Group status Deactive
     elseif($login_level['group_status'] === '0'):
           $session->msg('d','This level user has been band!');
           redirect('home2.php',false);
      //cheackin log in User level and Require level is Less than or equal to
     elseif($current_user['user_level'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "Sorry! you dont have permission to view the page.");
            redirect('home.php', false);
        endif;

     }

/*--------------------------------------------------------------*/
/* Function for the tent table (tent.php)
/*--------------------------------------------------------------*/
function join_tent_table_all(){
     	global $db;
     	$sql  =" SELECT id, tent_number, assigned_to_patrol, date";
    	$sql  .=" from Tents";
    	$sql  .=" ORDER BY FIELD(assigned_to_patrol, 'Dragon', 'Falcon', 'Phoenix', 'Not Assigned To A Patrol'), tent_number ASC";
    	return find_by_sql($sql);
   }

/*--------------------------------------------------------------*/
/* Function for loading issues with the tents (issues.php)
/*--------------------------------------------------------------*/
function tent_issues(){
     	global $db;
     	$sql  =" SELECT *";
    	$sql  .=" from Tent_Issues";
    	$sql  .=" ORDER BY date_fixed, date_added ASC";
    	return find_by_sql($sql);
   }

/*--------------------------------------------------------------*/
/* Function for loading all patrols
/*--------------------------------------------------------------*/   
function view_all_patrols(){
     	global $db;
     	$sql  ="SELECT id, names FROM Patrols ORDER BY FIELD(names, 'Dragon', 'Falcon', 'Phoenix', 'Not Assigned To A Patrol')";
    	return find_by_sql($sql);
   }

/*------------------------------------------------------------------------*/
/* Function for joining a different tent table, not ordered specific way
/*------------------------------------------------------------------------*/   
function join_tent_table($patrol){
     	global $db;
     	$sql  =" SELECT id, tent_number, assigned_to_patrol, date
		FROM Tents
		WHERE assigned_to_patrol='{$db->escape($patrol)}'
		ORDER BY assigned_to_patrol, tent_number ASC";
    	return find_by_sql($sql);
   }

/*------------------------------------------------------------------------*/
/* Function for joining a different tent table, this time for report page
/*------------------------------------------------------------------------*/  
function join_tent_table_report_2(){
     	global $db;
     	$sql  =" SELECT id, tent_number, assigned_to_patrol, date
	from Tents WHERE assigned_to_patrol <> 'Not Assigned To A Patrol'
	ORDER BY assigned_to_patrol, tent_number ASC";
    	return find_by_sql($sql);
   }

/*------------------------------------------------------------------------*/
/* Function for showing all scouts
/*------------------------------------------------------------------------*/  
function report_scouts(){
     	global $db;
     	$sql  =" SELECT id, first_name, last_name, patrol";
    	$sql  .=" FROM Scouts";
    	$sql  .=" ORDER BY last_name, first_name ASC";
    	return find_by_sql($sql);
   }

/*------------------------------------------------------------------------*/
/* Function for showing all tents
/*------------------------------------------------------------------------*/
function report_tents(){
     global $db;
     	$sql  =" SELECT id, tent_number, assigned_to_patrol";
   	$sql  .=" FROM Tents";
    	$sql  .=" ORDER BY Tents.tent_number ASC";
    	return find_by_sql($sql);

   }

/*------------------------------------------------------------------------*/
/* Function for showing all campouts
/*------------------------------------------------------------------------*/
    function report_campouts(){
     global $db;
     $sql  =" SELECT id, dates, location";
    $sql  .=" FROM Campouts";
    return find_by_sql($sql);
   }

/*------------------------------------------------------------------------*/
/* Function for showing all reports
/*------------------------------------------------------------------------*/
function join_report_table(){
     global $db;
     $sql  =" SELECT id, tent_number, date_returned, campout, name, patrol, date
	FROM Tent_Inventory
	ORDER BY date_returned, campout, patrol, tent_number ASC";
   	return find_by_sql($sql);
   }

/*------------------------------------------------------------------------*/
/* Function for showing all campout reports
/*------------------------------------------------------------------------*/ 
function join_campout_report(){
     global $db;
     $sql  =" SELECT id, dates, location
	FROM Campouts
	ORDER BY dates ASC";
    return find_by_sql($sql);
}

/*------------------------------------------------------------------------*/
/* Function for finding by dates
/*------------------------------------------------------------------------*/
function find_by_dates($table,$id){
  	global $db;
  	$id = (int)$id;
    	if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*------------------------------------------------------------------------*/
/* Function for showing all reports by a specific scout
/*------------------------------------------------------------------------*/
function join_campout_report_scout($first, $last){
     global $db;
     $sql  =" SELECT *
		FROM Tent_Inventory
		WHERE name='$first $last'
		ORDER BY date_returned, campout, patrol, tent_number ASC";
    return find_by_sql($sql);

   }

/*------------------------------------------------------------------------*/
/* Function for showing all reports by a specific campout
/*------------------------------------------------------------------------*/
function join_campout_report_campout($dates, $location){
     global $db;
     $sql  =" SELECT *
		FROM Tent_Inventory
		WHERE campout='{$db->escape($dates)}, {$db->escape($location)}'
		ORDER BY date_returned, campout, patrol, tent_number ASC";
    return find_by_sql($sql);

   }

/*------------------------------------------------------------------------*/
/* Function for showing all scouts by patrol
/*------------------------------------------------------------------------*/
function join_scout_table(){
    	global $db;
   	$sql  =" SELECT id, first_name, last_name, patrol, date FROM Scouts 
	ORDER BY FIELD(patrol, 'Dragon', 'Falcon', 'Phoenix', 'Not Assigned To A Patrol'), last_name, first_name";
    	return find_by_sql($sql);
   }

/*------------------------------------------------------------------------*/
/* Function for showing all scouts by a specific patrol
/*------------------------------------------------------------------------*/   
function join_scout_table_new($patrol){
    	global $db;
   	$sql  =" SELECT id, first_name, last_name, patrol, date FROM Scouts WHERE patrol='{$db->escape($patrol)}'
	ORDER BY last_name, first_name";
    	return find_by_sql($sql);
   } 

?>
