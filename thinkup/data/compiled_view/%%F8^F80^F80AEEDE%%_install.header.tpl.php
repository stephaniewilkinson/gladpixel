<?php /* Smarty version 2.6.26, created on 2013-01-12 18:02:05
         compiled from _install.header.tpl */ ?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/Article">
<head>
  <meta charset="utf-8">
  <title><?php if ($this->_tpl_vars['controller_title']): ?><?php echo $this->_tpl_vars['controller_title']; ?>
 | <?php endif; ?><?php echo $this->_tpl_vars['app_title']; ?>
</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/img/favicon.png">
  <link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/css/base.css">
  <link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/css/style.css">
  <link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/css/installer.css">
  
  <!-- jquery -->
  <link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/css/jquery-ui-1.8.13.css">
  <link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/css/validate_password.css">
  <script type="text/javascript" src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/js/jquery.min-1.4.js"></script>
  <script type="text/javascript" src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/js/jquery-ui.min-1.8.js"></script>
  <script type="text/javascript" src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/js/jquery.validate.password.js"></script>
  <script type="text/javascript" src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/js/validate_password.js"></script>  

  <?php echo '
  <script type="text/javascript">
    $(document).ready(function() {
      $(\'.toggle-advanced-options\').click(function(e) {
        var advanceOptions = $(this).next(\'#database-advance-options\');
        var icon = $(\'.ui-icon\', this);
        
        advanceOptions.slideToggle(500, function() {
          if ( $(\'#database-advance-options\').is(\':hidden\') ) {
            icon.removeClass(\'ui-icon-circle-triangle-s\')
            icon.addClass(\'ui-icon-circle-triangle-e\');
          } else {
            icon.removeClass(\'ui-icon-circle-triangle-e\');
            icon.addClass(\'ui-icon-circle-triangle-s\');
          }  
        });
        
        e.preventDefault();
        return false;
      });
      
      $(\'.toggle-help-msg\').click(function(e) {
        var helpMessage = $(this).next(\'#help-no-email-message\');
        helpMessage.slideToggle(500);
        e.preventDefault();
        return false;
      });

      
    });
  </script>
  '; ?>



  <!-- custom css -->
</head>
<body>


<div id="status-bar" class="clearfix"> 

  <div class="status-bar-left">

  </div> <!-- .status-bar-left -->
  
  <div class="status-bar-right text-right">
    <ul> 
      <?php if ($this->_tpl_vars['logged_in_user']): ?>
        <li>Logged in as<?php if ($this->_tpl_vars['user_is_admin']): ?> admin<?php endif; ?>: <?php echo $this->_tpl_vars['logged_in_user']; ?>
 <?php if ($this->_tpl_vars['user_is_admin']): ?><script src="<?php echo $this->_tpl_vars['site_root_path']; ?>
install/checkversion.php"></script><?php endif; ?><a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
account/?m=manage" class="linkbutton">Settings</a> <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
session/logout.php" class="linkbutton">Log Out</a></li>
      <?php else: ?>
      
        <li><a href="http://thinkupapp.com/" class="linkbutton">Get ThinkUp</a> <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
session/login.php" class="linkbutton"    >Log In</a></li>
      <?php endif; ?>
    </ul>
  </div> <!-- .status-bar-right -->

  
</div> <!-- #status-bar -->

<div id="page-bkgd">

<div class="container clearfix">
  
  <div id="app-title"><a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
">
    <h1><span id="headerthink">Think</span><span id="headerup">Up</span></h1>
  </a></div> <!-- end #app-title -->
  
</div> <!-- end .container -->