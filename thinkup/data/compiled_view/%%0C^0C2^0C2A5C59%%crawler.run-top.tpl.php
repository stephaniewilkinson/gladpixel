<?php /* Smarty version 2.6.26, created on 2013-02-23 07:44:19
         compiled from crawler.run-top.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_header.tpl", 'smarty_include_vars' => array('enable_bootstrap' => 'true')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <style type="text/css">
  <?php echo '
  body { background-color:white!important;}
  html {background:white!important;}


.control-group.warning {
  color: #c09853;
}
.control-group.error {
  color: #b94a48;
}
.control-group.success {
  color: #468847;
}
.table td.crawl-log-component {
    text-align : right;
    font-weight : bold;
}

  '; ?>

  </style>

<table class="table table-condensed table-striped">
    <thead><th>Time</th><th class="crawl-log-component">Component</th><th>Details</th></thead>
    <tbody>