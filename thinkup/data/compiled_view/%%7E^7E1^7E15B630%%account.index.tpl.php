<?php /* Smarty version 2.6.26, created on 2013-01-12 10:22:44
         compiled from account.index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'get_plugin_path', 'account.index.tpl', 37, false),array('modifier', 'filter_xss', 'account.index.tpl', 222, false),array('modifier', 'relative_datetime', 'account.index.tpl', 224, false),array('modifier', 'capitalize', 'account.index.tpl', 229, false),array('insert', 'help_link', 'account.index.tpl', 76, false),array('insert', 'csrf_token', 'account.index.tpl', 99, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_header.tpl", 'smarty_include_vars' => array('enable_tabs' => 'true','enable_bootstrap' => 'true')));
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
      <div id="tabs" class="embossed-block">
        <ul class="nav nav-tabs nav-stacked">
          <li><a href="#plugins">Plugins <i class="icon-chevron-right"></i></a></li>
          <?php if ($this->_tpl_vars['user_is_admin']): ?><li><a id="app-settings-tab" href="#app_settings">Application <i class="icon-chevron-right"></i></a></li><?php endif; ?>
          <li><a href="#instances">Account <i class="icon-chevron-right"></i></a></li>
          <?php if ($this->_tpl_vars['user_is_admin']): ?><li><a href="#ttusers">Users <i class="icon-chevron-right"></i></a></li><?php endif; ?>
        </ul>
      </div>
    </div><!--/span3-->
    <div class="span9">
        <div class="white-card">

        <div class="section" id="plugins">

            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_usermessage.tpl", 'smarty_include_vars' => array('field' => 'account')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
              <?php if ($this->_tpl_vars['installed_plugins']): ?>
                <?php $_from = $this->_tpl_vars['installed_plugins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ipindex'] => $this->_tpl_vars['ip']):
        $this->_foreach['foo']['iteration']++;
?>
                  <?php if (($this->_foreach['foo']['iteration'] <= 1)): ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <?php if ($this->_tpl_vars['user_is_admin']): ?><th>Setup</th><?php endif; ?>
                        </tr>
                      </thead>
                  <?php endif; ?>
                  <?php if ($this->_tpl_vars['user_is_admin'] || $this->_tpl_vars['ip']->is_active): ?>
                        <tr>
                          <td>
                            <div style="float:left";"><span id="spanpluginimage<?php echo $this->_tpl_vars['ip']->id; ?>
"><img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
plugins/<?php echo ((is_array($_tmp=$this->_tpl_vars['ip']->folder_name)) ? $this->_run_mod_handler('get_plugin_path', true, $_tmp) : smarty_modifier_get_plugin_path($_tmp)); ?>
/<?php echo $this->_tpl_vars['ip']->icon; ?>
" class="float-l" style="margin-right:10px"></span>
                            </div>
                            <a href="?p=<?php echo ((is_array($_tmp=$this->_tpl_vars['ip']->folder_name)) ? $this->_run_mod_handler('get_plugin_path', true, $_tmp) : smarty_modifier_get_plugin_path($_tmp)); ?>
"><span <?php if (! $this->_tpl_vars['ip']->is_active): ?>style="display:none;padding:5px; color : #00BDF2;"<?php endif; ?> id="spanpluginnamelink<?php echo $this->_tpl_vars['ip']->id; ?>
" style=" font-size : 1.4em;"><?php echo $this->_tpl_vars['ip']->name; ?>
</span></a><?php if ($this->_tpl_vars['ip']->is_active): ?><?php if (! $this->_tpl_vars['ip']->isConfigured()): ?><span class="icon-warning-sign"></span><?php endif; ?><?php endif; ?>
                            <span <?php if ($this->_tpl_vars['ip']->is_active): ?>style="display:none;padding:5px; color : #00BDF2;"<?php endif; ?> id="spanpluginnametext<?php echo $this->_tpl_vars['ip']->id; ?>
" style=" font-size : 1.4em;"><?php echo $this->_tpl_vars['ip']->name; ?>
</span><br />
                            
                            <span style="color:#666"><?php echo $this->_tpl_vars['ip']->description; ?>
</span><br>
                          </td>
                    <?php if ($this->_tpl_vars['user_is_admin']): ?>
                      <td>
                      <span id="spanpluginactivation<?php echo $this->_tpl_vars['ip']->id; ?>
">
                          <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
account/?p=<?php echo ((is_array($_tmp=$this->_tpl_vars['ip']->folder_name)) ? $this->_run_mod_handler('get_plugin_path', true, $_tmp) : smarty_modifier_get_plugin_path($_tmp)); ?>
" class="btn">Configure</a>
                      </span>
                      <span style="display: none;" class='linkbutton' id="messageactive<?php echo $this->_tpl_vars['ip']->id; ?>
"></span>
                      </td>
                    <?php endif; ?>
                      </tr>
                  <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                    </table>
              <?php else: ?>
                <a href="?m=manage" class="linkbutton">&laquo; Back to plugins</a>
              <?php endif; ?>
            <?php if ($this->_tpl_vars['body']): ?>
              <?php echo $this->_tpl_vars['body']; ?>

            <?php endif; ?>
        </div> <!-- end #plugins -->

        <?php if ($this->_tpl_vars['user_is_admin']): ?>
        <div class="section thinkup-canvas clearfix" id="app_settings">
          <div style="text-align: center" id="app_setting_loading_div">
            Loading application settings...<br /><br />
            <img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/img/loading.gif" width="50" height="50" />
          </div>
          <div id="app_settings_div" style="display: none;">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "account.appconfig.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </div>
          <script type="text/javascript"> var site_root_path = '<?php echo $this->_tpl_vars['site_root_path']; ?>
';</script>
          <script type="text/javascript" src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/js/appconfig.js"></script>
                
          <span class="pull-right"><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'help_link', 'id' => 'backup')), $this); ?>
</span>
          <h1>Back Up and Export Data</h1>
          <p>
            <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
install/backup.php" class="btn">Back up ThinkUp's entire database</a>
            Recommended before upgrading ThinkUp.
          </p>

          <p>
            <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
install/exportuserdata.php" class="btn">Export a single service user's data</a>
            For transfer into another existing ThinkUp database.
          </p>
                
        </div> <!-- end #app_setting -->
        <?php endif; ?>

        <div class="section" id="instances">
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_usermessage.tpl", 'smarty_include_vars' => array('field' => 'password')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          <span class="pull-right"><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'help_link', 'id' => 'account')), $this); ?>
</span>
          <h1>Password</h1>
          <form name="changepass" id="changepass" class="form-horizontal" method="post" action="index.php?m=manage#instances">
            <div class="control-group">
              <label for="oldpass" class="control-label">Current password</label>
              <div class="controls">
                <input name="oldpass" type="password" id="oldpass"><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'csrf_token')), $this); ?>
<!-- reset password -->
              </div>
            </div>
            <div class="control-group">
              <label for="pass1" class="control-label">New password</label>
              <div class="controls">
                <input name="pass1" type="password" id="pass1" onfocus="$('#password-meter').show();">
                <div class="password-meter" style="display:none;" id="password-meter">
                  <div class="password-meter-message"></div>
                    <div class="password-meter-bg">
                        <div class="password-meter-bar"></div>
                    </div>
                </div>
              </div>
            </div>
            <div class="control-group">
              <label for="pass2" class="control-label">Re-type new password</label>
              <div class="controls">
                <input name="pass2" type="password" id="pass2">
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <input type="submit" id="login-save" name="changepass" value="Change password" class="btn btn-primary">
              </div>
            </div>
          </form>
    <br><br>
    <span class="pull-right"><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'help_link', 'id' => 'rss')), $this); ?>
</span>
    <h1>Automate ThinkUp Data Capture</h1><br />
    
    <h3>RSS</h3>
    <p>ThinkUp can capture data automatically if you subscribe to this secret RSS feed URL in your favorite newsreader.</p>
    
    <p><a href="<?php echo $this->_tpl_vars['rss_crawl_url']; ?>
" class="btn">Secret RSS Feed to Update ThinkUp</a></p>
    
    <h3>Cron</h3>
    <p>Alternately, use the command below to set up a cron job that runs hourly to update your posts. (Be sure to change yourpassword to your real password!)</p>
    <p>
      <code style="font-family:Courier;" id="clippy_2988"><?php echo $this->_tpl_vars['cli_crawl_command']; ?>
</code>

      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
              width="100"
              height="14"
              class="clippy"
              id="clippy" >
      <param name="movie" value="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/flash/clippy.swf"/>
      <param name="allowScriptAccess" value="always" />
      <param name="quality" value="high" />
      <param name="scale" value="noscale" />
      <param NAME="FlashVars" value="id=clippy_2988&amp;copied=copied!&amp;copyto=copy to clipboard">
      <param name="bgcolor" value="#FFFFFF">
      <param name="wmode" value="opaque">
      <embed src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/flash/clippy.swf"
             width="100"
             height="14"
             name="clippy"
             quality="high"
             allowScriptAccess="always"
             type="application/x-shockwave-flash"
             pluginspage="http://www.macromedia.com/go/getflashplayer"
             FlashVars="id=clippy_2988&amp;copied=copied!&amp;copyto=copy to clipboard"
             bgcolor="#FFFFFF"
             wmode="opaque"
      />
      </object>
    </p>
    

              <h1>Your API Key</h1>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_usermessage.tpl", 'smarty_include_vars' => array('field' => 'api_key')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
              <strong>Your Current ThinkUp API Key:</strong>
              <span id="hidden_api_key" style="display: none;"><?php echo $this->_tpl_vars['owner']->api_key; ?>
</span>
              <span id="show_api_key">
              <a href="javascript:;" onclick="$('#show_api_key').hide(); $('#hidden_api_key').show();" class="linkbutton">
              Click to view</a>
              </span>
    
              <p>Accidentally share your secret RSS URL?</p>
    
              <form method="post" action="index.php?m=manage#instances" id="api-key-form">
                <input type="hidden" name="reset_api_key" value="Reset API Key" />
                <span id="apikey_conf" style="display: none;">
                Don't forget! If you reset your API key, you will need to update your ThinkUp crawler RSS feed subscription. This action cannot be undone.
                </span>
                <input type="button" value="Reset Your API Key" 
                class="btn"
                <?php echo '
                onclick="if(confirm($(\'#apikey_conf\').html().trim())) { $(\'#api-key-form\').submit();}">
                '; ?>

                <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'csrf_token')), $this); ?>
<!-- reset api_key -->
              </form>
        </div> <!-- end #instances -->

    <?php if ($this->_tpl_vars['user_is_admin']): ?>
      <div class="section" id="ttusers">

     <div class="thinkup-canvas clearfix">
         <div class="alpha omega grid_20 prefix_1 clearfix prepend_20 append_20">
        <h1>Invite New User</h1>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_usermessage.tpl", 'smarty_include_vars' => array('field' => 'invite')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          <form name="invite" method="post" action="index.php?m=manage#ttusers" class="prepend_20 append_20">
                <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'csrf_token')), $this); ?>
<input type="submit" id="login-save" name="invite" value="Create Invitation" 
                class="btn btn-primary">
          </form>
        </div>

      <h1>Registered Users</h1>

    <table class="table">
<?php $_from = $this->_tpl_vars['owners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['oloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['oloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['oid'] => $this->_tpl_vars['o']):
        $this->_foreach['oloop']['iteration']++;
?>
  <?php if (($this->_foreach['oloop']['iteration'] <= 1)): ?>
      <thead>
        <tr>
          <th>Name</th>
          <th>Activate</th>
          <th>Admin</th>
        </tr>
      </thead>
  <?php endif; ?>
  
      <tr>
        <td>
          <span<?php if ($this->_tpl_vars['o']->is_admin): ?> style="background-color:#FFFFCC"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['o']->full_name)) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>
</span><br>
          <small><?php echo ((is_array($_tmp=$this->_tpl_vars['o']->email)) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>
</small>
          <span style="color:#666"><br><small><?php if ($this->_tpl_vars['o']->last_login != '0000-00-00'): ?>logged in <?php echo ((is_array($_tmp=$this->_tpl_vars['o']->last_login)) ? $this->_run_mod_handler('relative_datetime', true, $_tmp) : smarty_modifier_relative_datetime($_tmp)); ?>
 ago<?php endif; ?></small></span>
           <?php if ($this->_tpl_vars['o']->instances != null): ?>
           <br><br>Service users:
           <span style="color:#666"><br><small>
            <?php $_from = $this->_tpl_vars['o']->instances; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['iid'] => $this->_tpl_vars['i']):
?>
                <?php echo ((is_array($_tmp=$this->_tpl_vars['i']->network_username)) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>
 | <?php echo ((is_array($_tmp=$this->_tpl_vars['i']->network)) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>

                <?php if (! $this->_tpl_vars['i']->is_active): ?> (paused)<?php endif; ?><br>
            <?php endforeach; endif; unset($_from); ?>
          <?php else: ?>
             &nbsp;
          <?php endif; ?>
          </small></span>
        </td>
        <td>
          <?php if ($this->_tpl_vars['o']->id != $this->_tpl_vars['owner']->id): ?>
          <span id="spanowneractivation<?php echo $this->_tpl_vars['o']->id; ?>
">
          <input type="submit" name="submit" class="btn <?php if ($this->_tpl_vars['o']->is_activated): ?>btn-danger<?php else: ?>btn-success<?php endif; ?> toggleOwnerActivationButton" id="user<?php echo $this->_tpl_vars['o']->id; ?>
" value="<?php if ($this->_tpl_vars['o']->is_activated): ?>Deactivate<?php else: ?>Activate<?php endif; ?>" />
          </span>
          <span style="display: none;" class="linkbutton" id="messageowneractive<?php echo $this->_tpl_vars['o']->id; ?>
"></span>
          <?php endif; ?>
        </td>
        <td>
          <?php if ($this->_tpl_vars['o']->id != $this->_tpl_vars['owner']->id && $this->_tpl_vars['o']->is_activated): ?>
          <span id="spanowneradmin<?php echo $this->_tpl_vars['o']->id; ?>
">
          <input type="submit" name="submit" class="btn <?php if ($this->_tpl_vars['o']->is_admin): ?>btn-danger<?php else: ?>btn-success<?php endif; ?> toggleOwnerAdminButton" id="userAdmin<?php echo $this->_tpl_vars['o']->id; ?>
" value="<?php if ($this->_tpl_vars['o']->is_admin): ?>Demote<?php else: ?>Promote<?php endif; ?>" />
          </span>
          <span style="display: none;" class="linkbutton" id="messageadmin<?php echo $this->_tpl_vars['o']->id; ?>
"></span>
          <?php endif; ?>
        </td>
      </tr>
<?php endforeach; endif; unset($_from); ?>
    </table>

      </div> <!-- end #ttusers -->

        </div>
    <?php endif; ?> <!-- end is_admin -->
    </div>
</div>

</div>

<script type="text/javascript">
  <?php echo '
$(function() {
    $(".btnPub").click(function() {
      var element = $(this);
      var u = element.attr("id");
      var dataString = \'u=\' + u + "&p=1&csrf_token=" + window.csrf_token; // toggle public on
      $.ajax({
        type: "GET",
        url: "'; ?>
<?php echo $this->_tpl_vars['site_root_path']; ?>
<?php echo 'account/toggle-public.php",
        data: dataString,
        success: function() {
          $(\'#div\' + u).html("<span class=\'linkbutton\' id=\'message" + u + "\'></span>");
          $(\'#message\' + u).html("Set to public!").hide().fadeIn(1500, function() {
            $(\'#message\' + u);
          });
        }
      });
      return false;
    });

    $(".btnPriv").click(function() {
      var element = $(this);
      var u = element.attr("id");
      var dataString = \'u=\' + u + "&p=0&csrf_token=" + window.csrf_token; // toggle public off
      $.ajax({
        type: "GET",
        url: "'; ?>
<?php echo $this->_tpl_vars['site_root_path']; ?>
<?php echo 'account/toggle-public.php",
        data: dataString,
        success: function() {
          $(\'#div\' + u).html("<span class=\'linkbutton\' id=\'message" + u + "\'></span>");
          $(\'#message\' + u).html("Set to private!").hide().fadeIn(1500, function() {
            $(\'#message\' + u);
          });
        }
      });
      return false;
    });
  });

  $(function() {
    $(".btnPlay").click(function() {
      var element = $(this);
      var u = element.attr("id");
      var dataString = \'u=\' + u + "&p=1&csrf_token=" + window.csrf_token; // toggle active on
      $.ajax({
        type: "GET",
        url: "'; ?>
<?php echo $this->_tpl_vars['site_root_path']; ?>
<?php echo 'account/toggle-active.php",
        data: dataString,
        success: function() {
          $(\'#divactivate\' + u).html("<span class=\'linkbutton\' id=\'message" + u + "\'></span>");
          $(\'#message\' + u).html("Started!").hide().fadeIn(1500, function() {
            $(\'#message\' + u);
          });
        }
      });
      return false;
    });

    $(".btnPause").click(function() {
      var element = $(this);
      var u = element.attr("id");
      var dataString = \'u=\' + u + "&p=0&csrf_token=" + window.csrf_token; // toggle active off
      $.ajax({
        type: "GET",
        url: "'; ?>
<?php echo $this->_tpl_vars['site_root_path']; ?>
<?php echo 'account/toggle-active.php",
        data: dataString,
        success: function() {
          $(\'#divactivate\' + u).html("<span class=\'linkbutton\' id=\'message" + u + "\'></span>");
          $(\'#message\' + u).html("Paused!").hide().fadeIn(1500, function() {
            $(\'#message\' + u);
          });
        }
      });
      return false;
    });
  });


    $(function() {
    var activateOwner = function(u) {
      //removing the "user" from id here to stop conflict with plugin    
      u = u.substr(4);
      var dataString = \'oid=\' + u + "&a=1&csrf_token=" + window.csrf_token; // toggle owner active on
      $.ajax({
        type: "GET",
        url: "'; ?>
<?php echo $this->_tpl_vars['site_root_path']; ?>
<?php echo 'account/toggle-owneractive.php",
        data: dataString,
        success: function() {
          $(\'#spanowneractivation\' + u).css(\'display\', \'none\');
          $(\'#messageowneractive\' + u).html("Activated!").hide().fadeIn(1500, function() {
            $(\'#messageowneractive\' + u);
          });
          $(\'#spanownernamelink\' + u).css(\'display\', \'inline\');
          $(\'#user\' + u).val(\'Deactivate\');
          $(\'#spanownernametext\' + u).css(\'display\', \'none\');
          $(\'#user\' + u).removeClass(\'btn-success\').addClass(\'btn-danger\');
          $(\'#userAdmin\' + u).show();
          setTimeout(function() {
              $(\'#messageowneractive\' + u).css(\'display\', \'none\');
              $(\'#spanowneractivation\' + u).hide().fadeIn(1500);
            },
            2000
          );
        }
      });
      return false;
    };

    var deactivateOwner = function(u) {
      //removing the "user" from id here to stop conflict with plugin
      u = u.substr(4);
      var dataString = \'oid=\' + u + "&a=0&csrf_token=" + window.csrf_token; // toggle owner active off
      $.ajax({
        type: "GET",
        url: "'; ?>
<?php echo $this->_tpl_vars['site_root_path']; ?>
<?php echo 'account/toggle-owneractive.php",
        data: dataString,
        success: function() {
          $(\'#spanowneractivation\' + u).css(\'display\', \'none\');
          $(\'#messageowneractive\' + u).html("Deactivated!").hide().fadeIn(150, function() {
            $(\'#messageowneractive\' + u);
          });
          $(\'#spanownernamelink\' + u).css(\'display\', \'none\');
          $(\'#spanownernametext\' + u).css(\'display\', \'inline\');
          $(\'#user\' + u).val(\'Activate\');
          $(\'#user\' + u).removeClass(\'btn-danger\').addClass(\'btn-success\');
          $(\'#userAdmin\' + u).hide();
          setTimeout(function() {
              $(\'#messageowneractive\' + u).css(\'display\', \'none\');
              $(\'#spanowneractivation\' + u).hide().fadeIn(1500);
            },
            2000
          );
        }
      });
      return false;
    };

    var promoteOwner = function(u) {
      //removing the "userAdmin" from id here to stop conflict with plugin    
      u = u.substr(9);
      var dataString = \'oid=\' + u + "&a=1&csrf_token=" + window.csrf_token; // toggle owner active on
      $.ajax({
        type: "GET",
        url: "'; ?>
<?php echo $this->_tpl_vars['site_root_path']; ?>
<?php echo 'account/toggle-owneradmin.php",
        data: dataString,
        success: function() {
          $(\'#spanowneradmin\' + u).css(\'display\', \'none\');
          $(\'#messageadmin\' + u).html("Promoted!").hide().fadeIn(1500, function() {
            $(\'#messageadmin\' + u);
          });
          $(\'#spanownernamelink\' + u).css(\'display\', \'inline\');
          $(\'#userAdmin\' + u).val(\'Demote\');
          $(\'#spanownernametext\' + u).css(\'display\', \'none\');
          $(\'#userAdmin\' + u).removeClass(\'btn-success\').addClass(\'btn-danger\');
          setTimeout(function() {
              $(\'#messageadmin\' + u).css(\'display\', \'none\');
              $(\'#spanowneradmin\' + u).hide().fadeIn(1500);
            },
            2000
          );
        }
      });
      return false;
    };

    var demoteOwner = function(u) {
      //removing the "userAdmin" from id here to stop conflict with plugin
      u = u.substr(9);
      var dataString = \'oid=\' + u + "&a=0&csrf_token=" + window.csrf_token; // toggle owner active off
      $.ajax({
        type: "GET",
        url: "'; ?>
<?php echo $this->_tpl_vars['site_root_path']; ?>
<?php echo 'account/toggle-owneradmin.php",
        data: dataString,
        success: function() {
          $(\'#spanowneradmin\' + u).css(\'display\', \'none\');
          $(\'#messageadmin\' + u).html("Demoted!").hide().fadeIn(1500, function() {
            $(\'#messageadmin\' + u);
          });
          $(\'#spanownernamelink\' + u).css(\'display\', \'none\');
          $(\'#spanownernametext\' + u).css(\'display\', \'inline\');
          $(\'#userAdmin\' + u).val(\'Promote\');
          $(\'#userAdmin\' + u).removeClass(\'btn-danger\').addClass(\'btn-success\');
          setTimeout(function() {
              $(\'#messageadmin\' + u).css(\'display\', \'none\');
              $(\'#spanowneradmin\' + u).hide().fadeIn(1500);
            },
            2000
          );
        }
      });
      return false;
    };

    $(".toggleOwnerActivationButton").click(function() {
      if($(this).val() == \'Activate\') {
        activateOwner($(this).attr("id"));
      } else {
        deactivateOwner($(this).attr("id"));
      }
    });

    $(".toggleOwnerAdminButton").click(function() {
      if($(this).val() == \'Promote\') {
        promoteOwner($(this).attr("id"));
      } else {
        demoteOwner($(this).attr("id"));
      }
    });

  });

  '; ?>

</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_footer.tpl", 'smarty_include_vars' => array('linkify' => 'false','enable_bootstrap' => 'true')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>