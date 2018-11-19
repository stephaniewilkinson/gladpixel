<?php /* Smarty version 2.6.26, created on 2013-01-12 10:22:33
         compiled from insights.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'relative_day', 'insights.tpl', 33, false),array('modifier', 'relative_datetime', 'insights.tpl', 34, false),array('modifier', 'ucfirst', 'insights.tpl', 34, false),array('modifier', 'cat', 'insights.tpl', 52, false),array('modifier', 'urlencode', 'insights.tpl', 68, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_header.tpl", 'smarty_include_vars' => array('enable_bootstrap' => $this->_tpl_vars['enable_bootstrap'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_statusbar.tpl", 'smarty_include_vars' => array('enable_bootstrap' => $this->_tpl_vars['enable_bootstrap'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <div id="main" class="container">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_usermessage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<?php if ($this->_tpl_vars['message_header']): ?>

<div class="row">
    <div class="span3">&nbsp;</div>
    <div class="span9">
        <div class="page-header">
          <h1><?php echo $this->_tpl_vars['message_header']; ?>
</h1>
          <h2><small><?php echo $this->_tpl_vars['message_body']; ?>
</small></h2>
        </div>
    </div>
</div>

<?php endif; ?>


<?php $this->assign('cur_date', ''); ?>
<?php $_from = $this->_tpl_vars['insights']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['i']):
        $this->_foreach['foo']['iteration']++;
?>
<div class="row">
    <?php if ($this->_tpl_vars['i']->text != ''): ?>
        <?php if ($this->_tpl_vars['cur_date'] != $this->_tpl_vars['i']->date): ?>
    <div class="span3">
      <div class="embossed-block">
        <ul>
          <li>
            <?php if (((is_array($_tmp=$this->_tpl_vars['i']->date)) ? $this->_run_mod_handler('relative_day', true, $_tmp) : smarty_modifier_relative_day($_tmp)) == 'today'): ?>
                <?php if ($this->_tpl_vars['i']->instance->crawler_last_run == 'realtime'): ?>Updated in realtime<?php else: ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']->instance->crawler_last_run)) ? $this->_run_mod_handler('relative_datetime', true, $_tmp) : smarty_modifier_relative_datetime($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 ago<?php endif; ?>
            <?php else: ?>
                <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']->date)) ? $this->_run_mod_handler('relative_day', true, $_tmp) : smarty_modifier_relative_day($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>

            <?php endif; ?>
          </li>
        </ul>
      </div>
    </div><!--/span3-->

            <?php $this->assign('cur_date', $this->_tpl_vars['i']->date); ?>

        <?php else: ?>

    <div class="span3">&nbsp;</div>
        <?php endif; ?>

    <div class="span9">
        <?php if ($this->_tpl_vars['i']->filename != ''): ?>
            <?php $this->assign('tpl_filename', ((is_array($_tmp=$this->_tpl_vars['i']->filename)) ? $this->_run_mod_handler('cat', true, $_tmp, '.tpl') : smarty_modifier_cat($_tmp, '.tpl'))); ?>
            <!-- including <?php echo $this->_tpl_vars['tpl_path']; ?>
<?php echo $this->_tpl_vars['tpl_filename']; ?>
 -->
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['tpl_path'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['tpl_filename']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['tpl_filename'])), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>
    </div><!--/span9-->
   <?php endif; ?>
</div><!--/row-->
<?php endforeach; endif; unset($_from); ?>

<div class="row">
    <div class="span3">&nbsp;</div>
    <div class="span9">

        <ul class="pager">
        <?php if ($this->_tpl_vars['next_page']): ?>
          <li class="previous">
            <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
insights.php?<?php if ($_GET['v']): ?>v=<?php echo $_GET['v']; ?>
&<?php endif; ?><?php if ($_GET['u']): ?>u=<?php echo $_GET['u']; ?>
&<?php endif; ?><?php if ($_GET['n']): ?>n=<?php echo ((is_array($_tmp=$_GET['n'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&<?php endif; ?>page=<?php echo $this->_tpl_vars['next_page']; ?>
" id="next_page" class="pull-left btn btn-small"><i class="icon-arrow-left"></i> Older</a>
          </li>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['last_page']): ?>
          <li class="next">
            <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
insights.php?<?php if ($_GET['v']): ?>v=<?php echo $_GET['v']; ?>
&<?php endif; ?><?php if ($_GET['u']): ?>u=<?php echo $_GET['u']; ?>
&<?php endif; ?><?php if ($_GET['n']): ?>n=<?php echo ((is_array($_tmp=$_GET['n'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&<?php endif; ?>page=<?php echo $this->_tpl_vars['last_page']; ?>
" id="last_page" class="pull-right btn btn-small">Newer <i class="icon-arrow-right"></i></a>
          </li>
        <?php endif; ?>
        </ul>

    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>