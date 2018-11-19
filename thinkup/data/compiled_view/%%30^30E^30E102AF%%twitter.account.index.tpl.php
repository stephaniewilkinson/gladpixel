<?php /* Smarty version 2.6.26, created on 2013-01-12 10:22:44
         compiled from /home/gladpixe/public_html/thinkup/plugins/twitter/view/twitter.account.index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'help_link', '/home/gladpixe/public_html/thinkup/plugins/twitter/view/twitter.account.index.tpl', 5, false),array('insert', 'csrf_token', '/home/gladpixe/public_html/thinkup/plugins/twitter/view/twitter.account.index.tpl', 39, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_usermessage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="plugin-info">

    <span class="pull-right"><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'help_link', 'id' => 'twitter')), $this); ?>
</span>
    <h1>
        <img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
plugins/twitter/assets/img/twitter_icon.png" class="plugin-image">
        Twitter Plugin
    </h1>

    <p>The Twitter plugin captures and displays tweets, replies, mentions, retweets, friends, followers, favorites, links, and photos.</p>

</div>

<div class="append_20">

<?php if ($this->_tpl_vars['oauthorize_link']): ?>
<a href="<?php echo $this->_tpl_vars['oauthorize_link']; ?>
" class="btn btn-success add-account"><i class="icon-plus icon-white"></i> Add a Twitter account</a>
<?php endif; ?>

<?php if (count ( $this->_tpl_vars['owner_instances'] ) > 0): ?>
<br>
<h2 class="subhead">Twitter Accounts</h2>
    <?php $_from = $this->_tpl_vars['owner_instances']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['iid'] => $this->_tpl_vars['i']):
        $this->_foreach['foo']['iteration']++;
?>
    <div class="row-fluid">
        <div class="span3">
            <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
?u=<?php echo $this->_tpl_vars['i']->network_username; ?>
"><?php echo $this->_tpl_vars['i']->network_username; ?>
</a>
        </div>
        <div class="span3">
            <span id="div<?php echo $this->_tpl_vars['i']->id; ?>
"><input type="submit" name="submit" class="btn
            <?php if ($this->_tpl_vars['i']->is_public): ?>btnPriv<?php else: ?>btnPub<?php endif; ?>" id="<?php echo $this->_tpl_vars['i']->id; ?>
" value="<?php if ($this->_tpl_vars['i']->is_public): ?>set private<?php else: ?>set public<?php endif; ?>" /></span>
        </div>
        <div class="span3">
            <span id="divactivate<?php echo $this->_tpl_vars['i']->id; ?>
"><input type="submit" name="submit" class="btn <?php if ($this->_tpl_vars['i']->is_active): ?>btnPause<?php else: ?>btnPlay<?php endif; ?>" id="<?php echo $this->_tpl_vars['i']->id; ?>
" value="<?php if ($this->_tpl_vars['i']->is_active): ?>pause crawling<?php else: ?>start crawling<?php endif; ?>" /></span>
        </div>
        <div class="span3">
            <span id="delete<?php echo $this->_tpl_vars['i']->id; ?>
"><form method="post" action="<?php echo $this->_tpl_vars['site_root_path']; ?>
account/?p=twitter">
            <input type="hidden" name="instance_id" value="<?php echo $this->_tpl_vars['i']->id; ?>
">
            <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'csrf_token')), $this); ?>
<input
            onClick="return confirm('Do you really want to delete this Twitter account?');"
            type="submit" name="action" class="btn btn-danger" 
            value="delete" /></form></span>
        </div>
    </div>
    <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
</div>

<div id="contact-admin-div" style="display: none;">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_plugin.admin-request.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<?php if ($this->_tpl_vars['enable_twitter_search']): ?>
<p>Alternately, add a public Twitter username for ThinkUp capture data about:</p>
<form method="get" action="index.php"><input type="hidden" name="p" value="twitter"><input name="twitter_username" /> <input  class="btn emphasized" type="submit" value="Add this Public User to ThinkUp"></form>
<?php endif; ?>

<?php if ($this->_tpl_vars['user_is_admin']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_plugin.showhider.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_usermessage.tpl", 'smarty_include_vars' => array('field' => 'setup')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<p style="padding:5px">To set up the Twitter plugin:</p>
<ol style="margin-left:40px"><li><a href="https://dev.twitter.com/apps/new" target="_blank" style="text-decoration: underline;">Create a new application on Twitter for ThinkUp</a>.</li>
<li>
    Fill in the following settings.<br />
    Name: <span style="font-family:Courier;"><?php echo $this->_tpl_vars['twitter_app_name']; ?>
</span><br />
    Description: <span style="font-family:Courier;">My ThinkUp installation</span><br />
    Website: 
    <small>
      <code style="font-family:Courier;" id="clippy_2987"><?php echo $this->_tpl_vars['thinkup_site_url']; ?>
</code>
    </small>
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
      <param NAME="FlashVars" value="id=clippy_2987&amp;copied=copied!&amp;copyto=copy to clipboard">
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
             FlashVars="id=clippy_2987&amp;copied=copied!&amp;copyto=copy to clipboard"
             bgcolor="#FFFFFF"
             wmode="opaque"
      />
    </object>
    <br />
    Callback URL:
    <small>
      <code style="font-family:Courier;" id="clippy_2988"><?php echo $this->_tpl_vars['thinkup_site_url']; ?>
plugins/twitter/auth.php</code>
    </small>
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
</li>
<li>Set the application Default Access type to "Read-only".</li>
<li>Enter the Twitter-provided consumer key and secret here.</li></ol>
<?php endif; ?>

<?php if ($this->_tpl_vars['options_markup']): ?>
<p>
<?php echo $this->_tpl_vars['options_markup']; ?>

</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['user_is_admin']): ?></div><?php endif; ?>

<?php echo '
<script type="text/javascript">
if( required_values_set ) {
    $(\'#add-account-div\').show();
} else {
    if(! is_admin) {
        $(\'#contact-admin-div\').show();
    }
}
'; ?>

</script>