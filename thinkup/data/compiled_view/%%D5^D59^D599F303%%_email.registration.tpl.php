<?php /* Smarty version 2.6.26, created on 2013-01-12 18:12:37
         compiled from _email.registration.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'filter_xss', '_email.registration.tpl', 1, false),)), $this); ?>
Click on the link below to activate your new account on <?php echo ((is_array($_tmp=$this->_tpl_vars['app_title'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>
:

<?php echo $this->_tpl_vars['application_url']; ?>
session/activate.php?usr=<?php echo $this->_tpl_vars['email']; ?>
&code=<?php echo $this->_tpl_vars['activ_code']; ?>


Thanks for registering!