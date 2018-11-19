<?php /* Smarty version 2.6.26, created on 2013-02-23 07:50:40
         compiled from /home/gladpixe/public_html/thinkup/plugins/twitter/view/tweets.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '/home/gladpixe/public_html/thinkup/plugins/twitter/view/tweets.tpl', 1, false),)), $this); ?>
<?php if (count($this->_tpl_vars['all_tweets']) > 1): ?>
<div class="section">
    <h2>Your Tweets</h2>
    <?php $_from = $this->_tpl_vars['all_tweets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['t']):
        $this->_foreach['foo']['iteration']++;
?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.counts_no_author.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['t'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endforeach; endif; unset($_from); ?>
    <div class="view-all"><a href="?v=tweets-all&u=<?php echo $this->_tpl_vars['instance']->network_username; ?>
&n=twitter">More...</a></div>
</div>
<?php else: ?>
<div class="alert helpful">
    No posts to display. <?php if ($this->_tpl_vars['logged_in_user']): ?>Update your data and try again.<?php endif; ?>
</div>
<?php endif; ?>

<?php if (count($this->_tpl_vars['messages_to_you']) > 1): ?>
<div class="section">

    <h2>Tweets to You</h2>
    <?php $_from = $this->_tpl_vars['messages_to_you']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['t']):
        $this->_foreach['foo']['iteration']++;
?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.author_no_counts.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['t'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endforeach; endif; unset($_from); ?>
    <div class="view-all"><a href="?v=tweets-messages&u=<?php echo $this->_tpl_vars['instance']->network_username; ?>
&n=twitter">More...</a></div>
</div>
<?php endif; ?>

<?php if (count($this->_tpl_vars['most_replied_to_tweets']) > 1): ?>
<div class="section">
    <h2>Most Replied-To All Time</h2>
    <?php $_from = $this->_tpl_vars['most_replied_to_tweets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['t']):
        $this->_foreach['foo']['iteration']++;
?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.counts_no_author.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['t'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endforeach; endif; unset($_from); ?>
    <div class="view-all"><a href="?v=tweets-mostreplies&u=<?php echo $this->_tpl_vars['instance']->network_username; ?>
&n=twitter">More...</a></div>
</div>
<?php endif; ?>

<?php if (count($this->_tpl_vars['author_replies']) > 1): ?>
<div class="section">
    <h2>Exchanges</h2>
      <?php $_from = $this->_tpl_vars['author_replies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tahrt'] => $this->_tpl_vars['r']):
        $this->_foreach['foo']['iteration']++;
?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.qa.tpl", 'smarty_include_vars' => array('t' => $this->_tpl_vars['t'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>

<?php if (count($this->_tpl_vars['most_retweeted']) > 1): ?>
<div class="section">
    <h2>Most Retweeted All Time</h2>
    <?php $_from = $this->_tpl_vars['most_retweeted']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['t']):
        $this->_foreach['foo']['iteration']++;
?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.counts_no_author.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['t'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endforeach; endif; unset($_from); ?>
    <div class="view-all"><a href="?v=tweets-mostretweeted&u=<?php echo $this->_tpl_vars['instance']->network_username; ?>
&n=twitter">More...</a></div>
</div>
<?php endif; ?>

<?php if (count($this->_tpl_vars['favorites']) > 1): ?>
<div class="section">
    <h2>Favorites</h2>
    <?php $_from = $this->_tpl_vars['favorites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['t']):
        $this->_foreach['foo']['iteration']++;
?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.author_no_counts.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['t'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endforeach; endif; unset($_from); ?>
    <div class="view-all"><a href="?v=ftweets-all&u=<?php echo $this->_tpl_vars['instance']->network_username; ?>
&n=twitter">More...</a></div>
</div>
<?php endif; ?>

<?php if (count($this->_tpl_vars['inquiries']) > 1): ?>
<div class="section">
    <h2>Inquiries</h2>
    <?php $_from = $this->_tpl_vars['inquiries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['t']):
        $this->_foreach['foo']['iteration']++;
?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.counts_no_author.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['t'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endforeach; endif; unset($_from); ?>
    <div class="view-all"><a href="?v=tweets-questions&u=<?php echo $this->_tpl_vars['instance']->network_username; ?>
&n=twitter">More...</a></div>
</div>
<?php endif; ?>