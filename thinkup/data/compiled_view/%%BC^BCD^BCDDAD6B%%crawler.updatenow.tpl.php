<?php /* Smarty version 2.6.26, created on 2013-02-23 07:44:18
         compiled from crawler.updatenow.tpl */ ?>
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
          <li>
             Update ThinkUp Data
          </li>
        </ul>
    </div>
    </div><!--/span3-->
    <div class="span9">
        <iframe width="100%" height="500px" src="run.php<?php if ($this->_tpl_vars['log'] == 'full'): ?>?log=full<?php endif; ?>" style="border:solid black 1px"></iframe>
    </div>
</div>


<div class="row">
    <div class="span3">&nbsp;</div>
    <div class="span9">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_usermessage.tpl", 'smarty_include_vars' => array('enable_bootstrap' => 'true')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>


</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_footer.tpl", 'smarty_include_vars' => array('enable_bootstrap' => 'true')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>