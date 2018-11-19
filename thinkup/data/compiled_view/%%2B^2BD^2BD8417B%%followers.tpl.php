<?php /* Smarty version 2.6.26, created on 2013-02-23 07:50:43
         compiled from /home/gladpixe/public_html/thinkup/plugins/twitter/view/followers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '/home/gladpixe/public_html/thinkup/plugins/twitter/view/followers.tpl', 1, false),array('modifier', 'number_format', '/home/gladpixe/public_html/thinkup/plugins/twitter/view/followers.tpl', 7, false),)), $this); ?>
<?php if (count($this->_tpl_vars['leastlikelythisweek']) > 1): ?>
<div class="section">
    <h2>This Week's Most Discerning Followers</h2>
    <div class="article" style="padding-left : 0px; padding-top : 0px;">
    <?php $_from = $this->_tpl_vars['leastlikelythisweek']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['u']):
        $this->_foreach['foo']['iteration']++;
?>
      <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=<?php echo $this->_tpl_vars['u']['user_id']; ?>
"  title="<?php echo $this->_tpl_vars['u']['user_name']; ?>
 has <?php echo ((is_array($_tmp=$this->_tpl_vars['u']['follower_count'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 followers and <?php echo ((is_array($_tmp=$this->_tpl_vars['u']['friend_count'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 friends"><img src="<?php echo $this->_tpl_vars['u']['avatar']; ?>
" class="avatar2"/><img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
plugins/<?php echo $this->_tpl_vars['u']['network']; ?>
/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
    <?php endforeach; endif; unset($_from); ?>
        <br /><br /><br />
    </div>
    <div class="view-all"><a href="?v=followers-leastlikely&u=<?php echo $this->_tpl_vars['instance']->network_username; ?>
&n=twitter">More...</a></div>
</div>
<?php endif; ?>

<?php if (count($this->_tpl_vars['leastlikely']) > 1): ?>
<div class="section">
    <h2>All-Time Most Discerning Followers</h2>
    <div class="article" style="padding-left : 0px; padding-top : 0px;">
    <?php $_from = $this->_tpl_vars['leastlikely']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['u']):
        $this->_foreach['foo']['iteration']++;
?>
      <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=<?php echo $this->_tpl_vars['u']['user_id']; ?>
" title="<?php echo $this->_tpl_vars['u']['user_name']; ?>
 has <?php echo ((is_array($_tmp=$this->_tpl_vars['u']['follower_count'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 followers and <?php echo ((is_array($_tmp=$this->_tpl_vars['u']['friend_count'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 friends"><img src="<?php echo $this->_tpl_vars['u']['avatar']; ?>
" class="avatar2"/><img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
plugins/<?php echo $this->_tpl_vars['u']['network']; ?>
/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
    <?php endforeach; endif; unset($_from); ?>
    <br /><br /><br />
    </div>
    <div class="view-all"><a href="?v=followers-leastlikely&u=<?php echo $this->_tpl_vars['instance']->network_username; ?>
&n=twitter">More...</a></div>
</div>
<?php endif; ?>

<?php if (count($this->_tpl_vars['popular']) > 1): ?>
<div class="section">
    <h2>Most Popular Followers</h2>
    <div class="article" style="padding-left : 0px; padding-top : 0px;">
    <?php $_from = $this->_tpl_vars['popular']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['u']):
        $this->_foreach['foo']['iteration']++;
?>
      <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=<?php echo $this->_tpl_vars['u']['user_id']; ?>
" title="<?php echo $this->_tpl_vars['u']['user_name']; ?>
 has <?php echo ((is_array($_tmp=$this->_tpl_vars['u']['follower_count'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 followers and <?php echo ((is_array($_tmp=$this->_tpl_vars['u']['friend_count'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 friends"><img src="<?php echo $this->_tpl_vars['u']['avatar']; ?>
" class="avatar2"/><img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
plugins/<?php echo $this->_tpl_vars['u']['network']; ?>
/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
    <?php endforeach; endif; unset($_from); ?>
    <br /><br /><br />
</div>
<div class="view-all"><a href="?v=followers-mostfollowed&u=<?php echo $this->_tpl_vars['instance']->network_username; ?>
&n=twitter">More...</a></div>
</div>
<?php endif; ?>


<div class="section">
    <h2>Follower Count By Day <?php if ($this->_tpl_vars['follower_count_history_by_day']['trend']): ?>(<?php if ($this->_tpl_vars['follower_count_history_by_day']['trend'] > 0): ?><span style="color:green">+<?php else: ?><span style="color:red"><?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['follower_count_history_by_day']['trend'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>/day)<?php endif; ?></h2>
    <?php if (! $this->_tpl_vars['follower_count_history_by_day']['history'] || count($this->_tpl_vars['follower_count_history_by_day']['history']) < 2): ?>
    <div class="alert urgent">Not enough data to display chart</div>
    <?php else: ?>
    <div class="article">
        <div id="follower_count_history_by_day"></div>
    </div>
    <?php if ($this->_tpl_vars['follower_count_history_by_day']['milestone'] && $this->_tpl_vars['follower_count_history_by_day']['milestone']['will_take'] > 0): ?>
    <div class="stream-pagination"><small style="color:gray">NEXT MILESTONE: <span style="background-color:#FFFF80;color:black"><?php echo $this->_tpl_vars['follower_count_history_by_day']['milestone']['will_take']; ?>
 day<?php if ($this->_tpl_vars['follower_count_history_by_day']['milestone']['will_take'] > 1): ?>s<?php endif; ?></span> till you reach <span style="background-color:#FFFF80;color:black"><?php echo ((is_array($_tmp=$this->_tpl_vars['follower_count_history_by_day']['milestone']['next_milestone'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 followers</span> at this rate.</small>
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>

<div class="section">
    <h2>Follower Count By Week <?php if ($this->_tpl_vars['follower_count_history_by_week']['trend'] != 0): ?>(<?php if ($this->_tpl_vars['follower_count_history_by_week']['trend'] > 0): ?><span style="color:green">+<?php else: ?><span style="color:red"><?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['follower_count_history_by_week']['trend'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>/week)<?php endif; ?></h2>
    <?php if (! $this->_tpl_vars['follower_count_history_by_week']['history'] || count($this->_tpl_vars['follower_count_history_by_week']['history']) < 2): ?><div class="alert urgent">Not enough data to display chart</div>
    <?php else: ?>
    <div class="article">
        <div id="follower_count_history_by_week"></div>
    </div>
    <?php if ($this->_tpl_vars['follower_count_history_by_week']['milestone'] && $this->_tpl_vars['follower_count_history_by_week']['milestone']['will_take'] > 0): ?>
    <div class="stream-pagination">
    <small style="color:gray">NEXT MILESTONE: <span style="background-color:#FFFF80;color:black"><?php echo $this->_tpl_vars['follower_count_history_by_week']['milestone']['will_take']; ?>
 week<?php if ($this->_tpl_vars['follower_count_history_by_week']['milestone']['will_take'] > 1): ?>s<?php endif; ?></span> till you reach <span style="background-color:#FFFF80;color:black"><?php echo ((is_array($_tmp=$this->_tpl_vars['follower_count_history_by_week']['milestone']['next_milestone'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 followers</span> at this rate.</small> 
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>

<div class="section">
    <h2>Follower Count By Month <?php if ($this->_tpl_vars['follower_count_history_by_month']['trend'] != 0): ?>(<?php if ($this->_tpl_vars['follower_count_history_by_month']['trend'] > 0): ?><span style="color:green">+<?php else: ?><span style="color:red"><?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['follower_count_history_by_month']['trend'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>/month)<?php endif; ?></h2>
    <?php if (! $this->_tpl_vars['follower_count_history_by_month']['history'] || count($this->_tpl_vars['follower_count_history_by_month']['history']) < 2): ?><div class="alert urgent">Not enough data to display chart</div>
    <?php else: ?>
    <div class="article">
        <div id="follower_count_history_by_month"></div>
    </div>

    <?php if ($this->_tpl_vars['follower_count_history_by_month']['milestone'] && $this->_tpl_vars['follower_count_history_by_month']['milestone']['will_take'] > 0): ?>
    <div class="stream-pagination">
    <small style="color:gray">NEXT MILESTONE: <span style="background-color:#FFFF80;color:black"><?php echo $this->_tpl_vars['follower_count_history_by_month']['milestone']['will_take']; ?>
 month<?php if ($this->_tpl_vars['follower_count_history_by_month']['milestone']['will_take'] > 1): ?>s<?php endif; ?></span> till you reach <span style="background-color:#FFFF80;color:black"><?php echo ((is_array($_tmp=$this->_tpl_vars['follower_count_history_by_month']['milestone']['next_milestone'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 followers</span> at this rate.</small>
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>

<div class="section">
    <h2>List Membership Count By Day <?php if ($this->_tpl_vars['list_membership_count_history_by_day']['trend']): ?>(<?php if ($this->_tpl_vars['list_membership_count_history_by_day']['trend'] > 0): ?><span style="color:green">+<?php else: ?><span style="color:red"><?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['list_membership_count_history_by_day']['trend'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>/day)<?php endif; ?></h2>
    <?php if (! $this->_tpl_vars['list_membership_count_history_by_day']['history'] || count($this->_tpl_vars['list_membership_count_history_by_day']['history']) < 2): ?>
    <div class="alert urgent">Not enough data to display chart</div>
    <?php else: ?>
    <div class="article">

    <div id="list_membership_count_history_by_day"></div>

    <?php if ($this->_tpl_vars['list_membership_count_history_by_day']['milestone'] && $this->_tpl_vars['list_membership_count_history_by_day']['milestone']['will_take'] > 0): ?>
    <div class="stream-pagination"><small style="color:gray">NEXT MILESTONE: <span style="background-color:#FFFF80;color:black"><?php echo $this->_tpl_vars['list_membership_count_history_by_day']['milestone']['will_take']; ?>
 day<?php if ($this->_tpl_vars['list_membership_count_history_by_day']['milestone']['will_take'] > 1): ?>s<?php endif; ?></span> till you reach <span style="background-color:#FFFF80;color:black"><?php echo ((is_array($_tmp=$this->_tpl_vars['list_membership_count_history_by_day']['milestone']['next_milestone'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 groups</span> at this rate.</small></div>
    <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<div class="section">
    <h2>List Membership Count By Week <?php if ($this->_tpl_vars['list_membership_count_history_by_week']['trend'] != 0): ?>(<?php if ($this->_tpl_vars['list_membership_count_history_by_week']['trend'] > 0): ?><span style="color:green">+<?php else: ?><span style="color:red"><?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['list_membership_count_history_by_week']['trend'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>/week)<?php endif; ?></h2>
    <?php if (! $this->_tpl_vars['list_membership_count_history_by_week']['history'] || count($this->_tpl_vars['list_membership_count_history_by_week']['history']) < 2): ?><div class="alert urgent">Not enough data to display chart</div>
    <?php else: ?>
    <div class="article">

    <div id="list_membership_count_history_by_week"></div>

    <?php if ($this->_tpl_vars['list_membership_count_history_by_week']['milestone'] && $this->_tpl_vars['list_membership_count_history_by_week']['milestone']['will_take'] > 0): ?>
    <div class="stream-pagination"><small style="color:gray">NEXT MILESTONE: <span style="background-color:#FFFF80;color:black"><?php echo $this->_tpl_vars['list_membership_count_history_by_week']['milestone']['will_take']; ?>
 week<?php if ($this->_tpl_vars['list_membership_count_history_by_week']['milestone']['will_take'] > 1): ?>s<?php endif; ?></span> till you reach <span style="background-color:#FFFF80;color:black"><?php echo ((is_array($_tmp=$this->_tpl_vars['list_membership_count_history_by_week']['milestone']['next_milestone'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 groups</span> at this rate.</small></div>
    <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<div class="section">
    <h2>List Membership Count By Month <?php if ($this->_tpl_vars['list_membership_count_history_by_month']['trend'] != 0): ?>(<?php if ($this->_tpl_vars['list_membership_count_history_by_month']['trend'] > 0): ?><span style="color:green">+<?php else: ?><span style="color:red"><?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['list_membership_count_history_by_month']['trend'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>/month)<?php endif; ?></h2>
    <?php if (! $this->_tpl_vars['list_membership_count_history_by_month']['history'] || count($this->_tpl_vars['list_membership_count_history_by_month']['history']) < 2): ?><div class="alert urgent">Not enough data to display chart</div>
    <?php else: ?>
    <div class="article">

    <div id="list_membership_count_history_by_month"></div>
    
    <?php if ($this->_tpl_vars['list_membership_count_history_by_month']['milestone'] && $this->_tpl_vars['list_membership_count_history_by_month']['milestone']['will_take'] > 0): ?>
    <div class="stream-pagination"><small style="color:gray">NEXT MILESTONE: <span style="background-color:#FFFF80;color:black"><?php echo $this->_tpl_vars['list_membership_count_history_by_month']['milestone']['will_take']; ?>
 month<?php if ($this->_tpl_vars['list_membership_count_history_by_month']['milestone']['will_take'] > 1): ?>s<?php endif; ?></span> till you reach <span style="background-color:#FFFF80;color:black"><?php echo ((is_array($_tmp=$this->_tpl_vars['list_membership_count_history_by_month']['milestone']['next_milestone'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 groups</span> at this rate.</small></div>
    <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<script type="text/javascript">
// Load the Visualization API and the standard charts
google.load('visualization', '1');
// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawCharts);

<?php echo '
function drawCharts() {
'; ?>

    var follower_count_history_by_day_data = new google.visualization.DataTable(
        <?php echo $this->_tpl_vars['follower_count_history_by_day']['vis_data']; ?>
);
    var follower_count_history_by_week_data = new google.visualization.DataTable(
        <?php echo $this->_tpl_vars['follower_count_history_by_week']['vis_data']; ?>
);
    var follower_count_history_by_month_data = new google.visualization.DataTable(
        <?php echo $this->_tpl_vars['follower_count_history_by_month']['vis_data']; ?>
);
    var list_membership_count_history_by_day_data = new google.visualization.DataTable(
        <?php echo $this->_tpl_vars['list_membership_count_history_by_day']['vis_data']; ?>
);
    var list_membership_count_history_by_week_data = new google.visualization.DataTable(
        <?php echo $this->_tpl_vars['list_membership_count_history_by_week']['vis_data']; ?>
);
    var list_membership_count_history_by_month_data = new google.visualization.DataTable(
        <?php echo $this->_tpl_vars['list_membership_count_history_by_month']['vis_data']; ?>
);
<?php echo '
    var formatter = new google.visualization.NumberFormat({fractionDigits: 0});
    var formatter_date = new google.visualization.DateFormat({formatType: \'medium\'});

    var chart_options = {
            colors: [\'#3c8ecc\'],
            width: \'100%\',
            height: 250,
            legend: "none",
            interpolateNulls: true,
            pointSize: 2,
            hAxis: {
                baselineColor: \'#eee\',
                format: \'MMM d\',
                textStyle: { color: \'#999\' },
                gridlines: { color: \'#eee\' }
            },
            vAxis: {
                baselineColor: \'#eee\',
                textStyle: { color: \'#999\' },
                gridlines: { color: \'#eee\' }
            },    
    };
    
    formatter.format(follower_count_history_by_day_data, 1);
    formatter_date.format(follower_count_history_by_day_data, 0);
    var follower_count_history_by_day_chart = new google.visualization.ChartWrapper({
        containerId: \'follower_count_history_by_day\',
        chartType: \'LineChart\',
        dataTable: follower_count_history_by_day_data,
        options: chart_options
    });
    follower_count_history_by_day_chart.draw();

    formatter.format(follower_count_history_by_week_data, 1);
    formatter_date.format(follower_count_history_by_week_data, 0);
    var follower_count_history_by_week_chart = new google.visualization.ChartWrapper({
        containerId: \'follower_count_history_by_week\',
        chartType: \'LineChart\',
        dataTable: follower_count_history_by_week_data,
        options: chart_options
    });
    follower_count_history_by_week_chart.draw();

    formatter.format(follower_count_history_by_month_data, 1);
    formatter_date.format(follower_count_history_by_month_data, 0);
    var follower_count_history_by_month_chart = new google.visualization.ChartWrapper({
        containerId: \'follower_count_history_by_month\',
        chartType: \'LineChart\',
        dataTable: follower_count_history_by_month_data,
        options: {
            colors: [\'#3c8ecc\'],
            width: \'100%\',
            height: 250,
            legend: "none",
            interpolateNulls: true,
            pointSize: 2,
            hAxis: {
                baselineColor: \'#eee\',
                format: \'MMM yyyy\',
                textStyle: { color: \'#999\' },
                gridlines: { color: \'#eee\' }
            },
            vAxis: {
                baselineColor: \'#eee\',
                textStyle: { color: \'#999\' },
                gridlines: { color: \'#eee\' }
            },
        },
    });
    follower_count_history_by_month_chart.draw();

    formatter.format(list_membership_count_history_by_day_data, 1);
    formatter_date.format(list_membership_count_history_by_day_data, 0);
    var list_membership_count_history_by_day_chart = new google.visualization.ChartWrapper({
        containerId: \'list_membership_count_history_by_day\',
        chartType: \'LineChart\',
        dataTable: list_membership_count_history_by_day_data,
        options: chart_options
    });
    list_membership_count_history_by_day_chart.draw();

    formatter.format(list_membership_count_history_by_week_data, 1);
    formatter_date.format(list_membership_count_history_by_week_data, 0);
    var list_membership_count_history_by_week_chart = new google.visualization.ChartWrapper({
        containerId: \'list_membership_count_history_by_week\',
        chartType: \'LineChart\',
        dataTable: list_membership_count_history_by_week_data,
        options: chart_options
    });
    list_membership_count_history_by_week_chart.draw();
    
    formatter.format(list_membership_count_history_by_month_data, 1);
    formatter_date.format(list_membership_count_history_by_month_data, 0);
    var list_membership_count_history_by_month_chart = new google.visualization.ChartWrapper({
        containerId: \'list_membership_count_history_by_month\',
        chartType: \'LineChart\',
        dataTable: list_membership_count_history_by_month_data,
        options: {
            colors: [\'#3c8ecc\'],
            width: \'100%\',
            height: 250,
            legend: "none",
            interpolateNulls: true,
            pointSize: 2,
            hAxis: {
                baselineColor: \'#eee\',
                format: \'MMM yyyy\',
                textStyle: { color: \'#999\' },
                gridlines: { color: \'#eee\' }
            },
            vAxis: {
                baselineColor: \'#eee\',
                textStyle: { color: \'#999\' },
                gridlines: { color: \'#eee\' }
            },
        },
    });
    list_membership_count_history_by_month_chart.draw();

}

'; ?>

</script>