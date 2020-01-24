<?php
  $page_title = 'GitHub Version vs. Installed Version';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(0);
?>
<?php
$github = file_get_contents('https://api.github.com/repos/jackveney/Troop61TentDatabase/releases/latest');
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <a href="https://github.com/jackveney/Troop61TentDatabase" target="_blank"><img src="logo/GitHub-Mark-32px.png" alt="GitHub Logo"></a>
          <span><a href="https://github.com/jackveney/Troop61TentDatabase" target="_blank">Github Version</a> vs. Installed Version</span>
       </strong>
      </div>
     <div class="panel-body">
		Github Latest Release Version: <?php $version = json_decode($github);
		echo $version->tag_name; ?>
		<br>
		<br>
		Installed Version: <?php echo $installed_version; ?>
	<br><br>
<?php if($version->tag_name === $installed_version): ?>
            <font size="4"><span class="label label-success"><?php echo "Database is up to date"; ?></span></font>
          <?php else: ?>
            <font size="4" color="white"><span class="label label-danger"><a href="https://github.com/jackveney/Troop61TentDatabase/releases/latest" target="_blank"><font color="white"><?php echo "Database needs updated"; ?></font></a></span></font>
          <?php endif;?>


     </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
