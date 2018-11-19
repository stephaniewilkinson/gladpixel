<?php /* Smarty version 2.6.26, created on 2013-02-23 07:50:27
         compiled from _dashboard.posttypes.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'round', '_dashboard.posttypes.tpl', 7, false),)), $this); ?>
  <div class="alpha">
      <h2>Post Types</span></h2>
      <div class="small prepend article">
        <div id="post_types"></div>
       </div>
       <div class="stream-pagination"><small style="color:#666;padding:5px;">
          <?php echo ((is_array($_tmp=$this->_tpl_vars['instance']->percentage_replies)) ? $this->_run_mod_handler('round', true, $_tmp) : round($_tmp)); ?>
% posts are replies<br>
          <?php echo ((is_array($_tmp=$this->_tpl_vars['instance']->percentage_links)) ? $this->_run_mod_handler('round', true, $_tmp) : round($_tmp)); ?>
% posts contain links
          </small>
       </div>
</div>

<script type="text/javascript">
    // Load the Visualization API and the standard charts
    google.load('visualization', '1');
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawPostTypesChart);

    <?php echo '
    function drawPostTypesChart() {
      var replies = '; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['instance']->percentage_replies)) ? $this->_run_mod_handler('round', true, $_tmp) : round($_tmp)); ?>
;
      var links = <?php echo ((is_array($_tmp=$this->_tpl_vars['instance']->percentage_links)) ? $this->_run_mod_handler('round', true, $_tmp) : round($_tmp)); ?>
;
      <?php echo '
      if (typeof(replies) != \'undefined\') {
        var post_types = new google.visualization.DataTable();
        post_types.addColumn(\'string\', \'Type\');
        post_types.addColumn(\'number\', \'Percentage\');
        post_types.addRows([
            [\'Conversationalist\', {v: replies/100, f: replies + \'%\'}], 
            [\'Broadcaster\', {v: links/100, f: links + \'%\'}]
        ]);

        var post_type_chart = new google.visualization.ChartWrapper({
            containerId: \'post_types\',
            chartType: \'ColumnChart\',
            dataTable: post_types,
            options: {
                colors: [\'#3c8ecc\'],
                width: 300,
                height: 200,
                legend: \'none\',
                hAxis: {
                    minValue: 0,
                    maxValue: 1,
                    textStyle: { color: \'#000\' },
                },
                vAxis: {
                    textStyle: { color: \'#666\' },
                    gridlines: { color: \'#ccc\' },
                    format:\'#,###%\',
                    baselineColor: \'#ccc\',
                },
            }
        });
        post_type_chart.draw();
      }
   }
   '; ?>

</script>

