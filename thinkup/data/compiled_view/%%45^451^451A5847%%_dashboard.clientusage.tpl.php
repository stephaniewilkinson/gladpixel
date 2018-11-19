<?php /* Smarty version 2.6.26, created on 2013-02-23 07:50:27
         compiled from _dashboard.clientusage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'round', '_dashboard.clientusage.tpl', 8, false),)), $this); ?>
<?php if ($this->_tpl_vars['all_time_clients_usage']): ?>
<div class="omega">
     <h2>Client Usage <span class="detail">(all posts)</span></h2>
     <div class="article">
     <div id="client_usage"></div>
     </div>
     <div class="stream-pagination">
     <small style="color:#666;padding:5px;">Recently posting about <?php echo ((is_array($_tmp=$this->_tpl_vars['instance']->posts_per_day)) ? $this->_run_mod_handler('round', true, $_tmp) : round($_tmp)); ?>
 times a day<?php if ($this->_tpl_vars['latest_clients_usage']): ?>, mostly using <?php $_from = $this->_tpl_vars['latest_clients_usage']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['num_posts']):
        $this->_foreach['foo']['iteration']++;
?><?php echo $this->_tpl_vars['name']; ?>
<?php if (! ($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?> and <?php endif; ?><?php endforeach; endif; unset($_from); ?><?php endif; ?></small>
     </div>
</div>

<script type="text/javascript">
    // Load the Visualization API and the standard charts
    google.load('visualization', '1');
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawClientUsageChart);

    <?php echo '
    function drawClientUsageChart() {
    '; ?>

      var client_usage_data = new google.visualization.DataTable(<?php echo $this->_tpl_vars['all_time_clients_usage']; ?>
);
      <?php echo '
      var formatter = new google.visualization.NumberFormat({fractionDigits: 0});
      var formatter_date = new google.visualization.DateFormat({formatType: \'medium\'});
      formatter.format(client_usage_data, 1);
      var client_usage_chart = new google.visualization.ChartWrapper({
          containerId: \'client_usage\',
          // chartType: \'ColumnChart\',
          chartType: \'PieChart\',
          dataTable: client_usage_data,
          options: {
              titleTextStyle: {color: \'#848884\', fontSize: 19},
              width: 300,
              height: 300,
              sliceVisibilityThreshold: 1/100,
              chartArea: { width: \'100%\' },
              pieSliceText: \'label\',
          }
      });
      client_usage_chart.draw();
    }
    '; ?>

</script>
<?php endif; ?>