<?php /* Smarty version 2.6.26, created on 2013-01-12 10:22:44
         compiled from account.appconfig.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'help_link', 'account.appconfig.tpl', 2, false),array('modifier', 'capitalize', 'account.appconfig.tpl', 27, false),)), $this); ?>

  <span class="pull-right"><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'help_link', 'id' => 'application_settings')), $this); ?>
</span>
  <h1>Application Settings</h1>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_usermessage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

 <div class="alert alert-error" id="settings_error_message_error" style="display: none;">
  <span class="ui-icon ui-icon-alert" style="float: left; margin:.3em 0.3em 0 0;"></span>
  <span id="settings_error_message"></span>
</div>


 <div class="alert alert-success"  id="settings_success" style="display: none;">
  <span class="ui-icon ui-icon-check" style="float: left; margin:.3em 0.3em 0 0;"></span>
  Settings saved!
 </div>

<form id="app-settings-form" name="app_settings" method="post" action="<?php echo $this->_tpl_vars['site_root_path']; ?>
session/app_settings.php"
  onsubmit="return false">


      <label for="default_instance">
        Default service user
      </label>
      <select name="default_instance" id="default_instance">
        <option value="0">Last updated</option>
        <?php $_from = $this->_tpl_vars['public_instances']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pi']):
?>
          <option value="<?php echo $this->_tpl_vars['pi']->id; ?>
"><?php echo $this->_tpl_vars['pi']->network_username; ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['pi']->network)) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
      </select>
      <span class="help-block">Set the service user to display by default. <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'help_link', 'id' => 'default_service_user')), $this); ?>
</span>

      <label class="checkbox">
        <input type="checkbox" name="is_registration_open" id="is_registration_open" value="true"> Open registration to new ThinkUp users
      </label>
      <span class="help-block">Set whether or not your site's registration page is available and accepts new user registrations.</span>

      <label class="checkbox">
        <input type="checkbox" name="is_log_verbose" id="is_log_verbose" value="true"> Enable developer log
      </label>
      <span class="help-block">See the verbose, unformatted developer log on the Capture Data screen.</span>

      <label class="checkbox">
        <input type="checkbox" name="recaptcha_enable" id="recaptcha_enable" value="true"> Enable reCAPTCHA
      </label>
      <span class="help-block">Add reCAPTCHA to ThinkUp's registration form. <a href="https://www.google.com/recaptcha">Get your reCAPTCHA keys here</a>.</span>

      <div id="recaptcha_enable_deps" style="display: none; width: 470px; margin: 0 0 20px 0;">
        <label for="recaptcha_public_key">reCAPTCHA Public Key</label>
        <input type="text" name="recaptcha_public_key" id="recaptcha_public_key" value="">
        <label for="recaptcha_private_key">reCAPTCHA Private Key</label>
        <input type="text" name="recaptcha_private_key" id="recaptcha_private_key" value="">
      </div>

      <label class="checkbox">
        <input type="checkbox" name="is_subscribed_to_beta" id="is_subscribed_to_beta" value="true"> Enable beta upgrades
      </label>
      <span class="help-block">Test bleeding edge, beta upgrades. May require command line server access. Proceed at your own risk.</span>

      <label class="checkbox">
        <input type="checkbox" name="is_api_disabled" id="is_api_disabled" value="true"> Disable the JSON API
      </label>
      <span class="help-block">Set whether or not your site's data is available via ThinkUp's JSON API. <a href="http://thinkupapp.com/docs/userguide/api/posts/index.html">Learn more...</a></span>

      <label class="checkbox">
        <input type="checkbox" name="is_embed_disabled" id="is_embed_disabled" value="true"> Disable thread embeds
      </label>
      <span class="help-block">Set whether or not a user can embed a ThinkUp thread onto another web site.</span>

      <label class="checkbox">
        <input type="checkbox" name="is_opted_out_usage_stats" id="is_opted_out_usage_stats" value="true"> Disable usage reporting
      </label>
      <span class="help-block">Usage reporting helps us improve ThinkUp. <a href="http://thinkupapp.com/docs/userguide/settings/application.html#disable-usage-reporting">Learn more...</a></span>

    <div style="text-align: center" id="save_setting_image">
        <img  id="save_setting_image" src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/img/loading.gif" width="50" height="50"  
        style="display: none; margin: 10px;"/>
    </div>
        
    <div class="clearfix">
      <div class="grid_10 prefix_9 left">
        <input type="submit" id="app-settings-save" name="Submit" 
        class="btn btn-primary" value="Save Settings">
      </div>
    </div>

</form>