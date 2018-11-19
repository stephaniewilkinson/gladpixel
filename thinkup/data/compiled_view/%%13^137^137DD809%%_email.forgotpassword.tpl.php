<?php /* Smarty version 2.6.26, created on 2013-02-23 07:35:22
         compiled from _email.forgotpassword.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'filter_xss', '_email.forgotpassword.tpl', 3, false),)), $this); ?>
Hi there!

Looks like you forgot your <?php echo ((is_array($_tmp=$this->_tpl_vars['apptitle'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>
 password. Go to this URL to reset it:
<?php echo $this->_tpl_vars['application_url']; ?>
<?php echo $this->_tpl_vars['recovery_url']; ?>


Or, if you remembered it, you can log in here and disregard this email:
<?php echo $this->_tpl_vars['application_url']; ?>
session/login.php