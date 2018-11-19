<?php /* Smarty version 2.6.26, created on 2013-02-23 07:35:16
         compiled from session.forgot.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'help_link', 'session.forgot.tpl', 44, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_header.tpl", 'smarty_include_vars' => array('enable_bootstrap' => 'true')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_statusbar.tpl", 'smarty_include_vars' => array('enable_bootstrap' => 'true')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div class="container">

<div class="row">
    <div class="span3">
          <div class="embossed-block">
            <ul>
              <li>Reset Your Password</li>
            </ul>
          </div>
    </div><!--/span3-->
    <div class="span6">




    <?php if (isset ( $this->_tpl_vars['error_msgs'] )): ?>
        <div class="alert alert-error"><p><?php echo $this->_tpl_vars['error_msg']; ?>
</p></div>
    <?php endif; ?>
    <?php if (isset ( $this->_tpl_vars['success_msg'] )): ?>
        <div class="alert alert-success"><p><?php echo $this->_tpl_vars['success_msg']; ?>
</p></div>
    <?php endif; ?>

            <form name="forgot-form" method="post" action="" class="login form-horizontal">

                <fieldset style="background-color : white; padding-top : 30px;">
                    
                    <div class="control-group">
                        <label class="control-label" for="email">Email:</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" name="email" id="email">
                        </div>
                    </div>
                    
                    <div class="form-actions">
                            <input type="submit" id="login-save" name="Submit" class="btn btn-primary" value="Send Reset">
                            <span class="pull-right">
                                <div class="btn-group">
                                    <a href="login.php" class="btn btn-mini">Log In</a>
                                    <?php if ($this->_tpl_vars['is_registration_open']): ?><a href="register.php" class="btn btn-mini">Register</a><?php else: ?><span class="btn btn-mini disabled">Registration closed</span><?php endif; ?>
                                    <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'help_link', 'id' => 'forgot')), $this); ?>

                                </div>
                            </span>
                    </div>

                </fieldset>
            </form>

    </div><!-- end span9 -->

</div><!-- end row -->

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_footer.tpl", 'smarty_include_vars' => array('enable_bootstrap' => 'true')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>