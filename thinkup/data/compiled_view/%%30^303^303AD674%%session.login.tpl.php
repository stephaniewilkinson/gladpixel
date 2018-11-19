<?php /* Smarty version 2.6.26, created on 2013-01-12 10:22:25
         compiled from session.login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'filter_xss', 'session.login.tpl', 25, false),array('insert', 'help_link', 'session.login.tpl', 42, false),)), $this); ?>
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
              <li>Log In</li>
            </ul>
          </div>
    </div><!--/span3-->
    <div class="span6">

        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_usermessage.tpl", 'smarty_include_vars' => array('enable_bootstrap' => 'true')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

            <form name="login-form" method="post" action="<?php echo $this->_tpl_vars['site_root_path']; ?>
session/login.php" class="login form-horizontal">

                <fieldset style="background-color : white; padding-top : 30px;">

                    <div class="control-group">
                        <label class="control-label" for="email">Email</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" name="email" id="email"<?php if (isset ( $this->_tpl_vars['email'] )): ?> value="<?php echo ((is_array($_tmp=$this->_tpl_vars['email'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>
"<?php endif; ?> autofocus="autofocus">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="pwd">Password</label>
                        <div class="controls">
                            <input class="input-xlarge" type="password" name="pwd" id="pwd">
                        </div>
                    </div>

                    <div class="form-actions">
                            <input type="submit" id="login-save" name="Submit" class="btn btn-primary" value="Log In">
                            <span class="pull-right">
                                <div class="btn-group">
                                    <?php if ($this->_tpl_vars['is_registration_open']): ?><a href="register.php" class="btn btn-mini">Register</a><?php else: ?><span class="btn btn-mini disabled">Registration closed</span><?php endif; ?>
                                    <a href="forgot.php" class="btn btn-mini">Forgot password</a>
                                    <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'help_link', 'id' => 'login')), $this); ?>

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