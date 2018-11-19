<?php /* Smarty version 2.6.26, created on 2013-01-12 10:23:05
         compiled from dashboard.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urlencode', 'dashboard.tpl', 14, false),array('modifier', 'get_plugin_path', 'dashboard.tpl', 51, false),array('modifier', 'capitalize', 'dashboard.tpl', 55, false),array('modifier', 'relative_datetime', 'dashboard.tpl', 57, false),array('modifier', 'count_characters', 'dashboard.tpl', 68, false),array('modifier', 'number_format', 'dashboard.tpl', 116, false),array('modifier', 'count', 'dashboard.tpl', 195, false),array('modifier', 'ucwords', 'dashboard.tpl', 219, false),)), $this); ?>
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

<div class="container_24">
  <div class="clearfix">
    <!-- begin left nav -->
    <div class="grid_4 alpha omega">
        <?php if ($this->_tpl_vars['instance']): ?>
      <div id="nav">
        <ul id="top-level-sidenav">
        <?php endif; ?>
        <?php if ($this->_tpl_vars['instance']): ?>
              <li<?php if ($_GET['v'] == ''): ?> class="selected"<?php endif; ?>>
                <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
dashboard.php?u=<?php echo ((is_array($_tmp=$this->_tpl_vars['instance']->network_username)) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&n=<?php echo ((is_array($_tmp=$this->_tpl_vars['instance']->network)) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
">Dashboard</a>
              </li>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['sidebar_menu']): ?>
          <?php $_from = $this->_tpl_vars['sidebar_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['smenuloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['smenuloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['smkey'] => $this->_tpl_vars['sidebar_menu_item']):
        $this->_foreach['smenuloop']['iteration']++;
?>
          <?php if (! $this->_tpl_vars['sidebar_menu_item']->parent): ?>
                <li<?php if ($_GET['v'] == $this->_tpl_vars['smkey'] || $this->_tpl_vars['parent'] == $this->_tpl_vars['smkey']): ?> class="selected"<?php endif; ?>>
                                <?php if ($this->_tpl_vars['parent'] == $this->_tpl_vars['smkey']): ?><?php $this->assign('parent_name', $this->_tpl_vars['sidebar_menu_item']->name); ?><?php endif; ?>
                <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
dashboard.php?v=<?php echo $this->_tpl_vars['smkey']; ?>
&u=<?php echo ((is_array($_tmp=$this->_tpl_vars['instance']->network_username)) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&n=<?php echo ((is_array($_tmp=$this->_tpl_vars['instance']->network)) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
"><?php echo $this->_tpl_vars['sidebar_menu_item']->name; ?>
</a></li>
             <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>

        <?php endif; ?>
        <?php if ($this->_tpl_vars['instance']): ?>
        </ul>
      </div>
        <?php endif; ?>
    </div>

    <div class="thinkup-canvas round-all grid_20 alpha omega prepend_20 append_20" style="min-height:340px">
      <div class="prefix_1 suffix_1">

        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_usermessage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php if ($this->_tpl_vars['show_update_now_button'] == true): ?>
        <br>
        <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
crawler/updatenow.php<?php if ($this->_tpl_vars['developer_log']): ?>?log=full<?php endif; ?>" class="linkbutton emphasized">Capture Data Now</a>
        <?php endif; ?>

        <?php if ($this->_tpl_vars['instance']): ?>
                    <?php if ($this->_tpl_vars['user_details']): ?>
            <div class="grid_18 alpha omega">
              <div class="clearfix alert stats round-all" id="">
                <div class="grid_2 alpha">
                  <div class="avatar-container">
                    <img src="<?php echo $this->_tpl_vars['user_details']->avatar; ?>
" class="avatar2" width="48" height="48"/>
                    <img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
plugins/<?php echo ((is_array($_tmp=$this->_tpl_vars['user_details']->network)) ? $this->_run_mod_handler('get_plugin_path', true, $_tmp) : smarty_modifier_get_plugin_path($_tmp)); ?>
/assets/img/favicon.png" class="service-icon2"/>
                  </div>
                </div>
                <div class="grid_15 omega">
                  <span class="tweet"><?php echo $this->_tpl_vars['user_details']->username; ?>
 <span style="color:#ccc"><?php echo ((is_array($_tmp=$this->_tpl_vars['user_details']->network)) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</span></span><br />
                  <div class="small">
                    <?php if ($this->_tpl_vars['instance']->crawler_last_run == 'realtime'): ?><span style="color:green;">&#9679;</span> Updated in realtime<?php else: ?>Updated <?php echo ((is_array($_tmp=$this->_tpl_vars['instance']->crawler_last_run)) ? $this->_run_mod_handler('relative_datetime', true, $_tmp) : smarty_modifier_relative_datetime($_tmp)); ?>
 ago<?php endif; ?><?php if (! $this->_tpl_vars['instance']->is_active): ?> (paused)<?php endif; ?>
                  </div>
                </div>
              </div>
            </div>

          <?php if ($this->_tpl_vars['data_template']): ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['data_template'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          <?php else: ?> 
              <?php if ($this->_tpl_vars['instance']->network == 'foursquare'): ?>
               <?php if (((is_array($_tmp=$this->_tpl_vars['checkins_map'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) != 0): ?>
                   <div class="section">
                       <h2>This Week's Checkins Map</h2>
                       <div class="clearfix article">
                       <center><img src="<?php echo $this->_tpl_vars['checkins_map']; ?>
"></center>
                       </div>
                   </div>
               <?php endif; ?>

               <?php if (((is_array($_tmp=$this->_tpl_vars['checkins_per_hour'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) != 0): ?>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_dashboard.checkinsperhour.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
               <?php endif; ?>

               <?php if (((is_array($_tmp=$this->_tpl_vars['checkins_by_type_last_week'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) != 0 && ((is_array($_tmp=$this->_tpl_vars['checkins_by_type'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) != 0): ?>
                   <div class="section" style="float : left; clear : none; width : 345px;">
                       <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_dashboard.checkinplacetypeslastweek.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                   </div>
                   <div class="section" style="float : left; clear : none;margin-left : 16px; width : 345px;">
                       <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_dashboard.checkinplacetypesalltime.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                   </div>
               <?php endif; ?>
             <?php endif; ?>

            <?php if ($this->_tpl_vars['hot_posts_data'] && $this->_tpl_vars['instance']->network != 'foursquare'): ?>
                <div class="section">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_dashboard.responserates.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['yearly_popular'] && $this->_tpl_vars['instance']->network == 'twitter'): ?>
                <div class="section">
                <h2>Your Most Popular Tweets of <?php echo $this->_tpl_vars['yearly_popular_year']; ?>
</h2>
                <?php $_from = $this->_tpl_vars['yearly_popular']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['t']):
        $this->_foreach['foo']['iteration']++;
?>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.counts_no_author.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['t'],'headings' => 'NONE')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php endforeach; endif; unset($_from); ?>
                <div class="clearfix view-all">
                    <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
dashboard.php?v=years_most_popular&u=<?php echo $this->_tpl_vars['instance']->network_username; ?>
&n=<?php echo $this->_tpl_vars['instance']->network; ?>
&y=<?php echo $this->_tpl_vars['yearly_popular_year']; ?>
">More...</a>
                </div>
                </div>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['least_likely_followers']): ?>
              <div class="clearfix section">
                <h2>This Week's Most Discerning Followers</h2>
                <div class="clearfix article" style="padding-top : 0px;">
                <?php $_from = $this->_tpl_vars['least_likely_followers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['uid'] => $this->_tpl_vars['u']):
        $this->_foreach['foo']['iteration']++;
?>
                  <?php if (! ($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>
                  <div class="avatar-container" style="float:left;margin:7px;">
                    <a href="https://twitter.com/intent/user?user_id=<?php echo $this->_tpl_vars['u']['user_id']; ?>
" title="<?php echo $this->_tpl_vars['u']['user_name']; ?>
 has <?php echo ((is_array($_tmp=$this->_tpl_vars['u']['follower_count'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 followers and <?php echo ((is_array($_tmp=$this->_tpl_vars['u']['friend_count'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 friends"><img src="<?php echo $this->_tpl_vars['u']['avatar']; ?>
" class="avatar2" width="48" height="48"/><img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
plugins/<?php echo $this->_tpl_vars['u']['network']; ?>
/assets/img/favicon.png" class="service-icon2"/></a>
                  </div>
                  <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <br /><br /><br />
                </div>
                <div class="clearfix view-all">
                    <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
dashboard.php?v=followers-leastlikely&u=<?php echo $this->_tpl_vars['instance']->network_username; ?>
&n=<?php echo $this->_tpl_vars['instance']->network; ?>
">More...</a>
                </div>
                </div>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['click_stats_data']): ?>
                <div class="section">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_dashboard.clickthroughrates.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['instance']->network == 'foursquare'): ?>
               <style type="text/css">
                <?php echo '
                .map-image-container { width: 130px; height: 130px; padding-bottom : 30px; }
                img.map-image2 {float:left;margin:6px 0 0 0;width:150px;height:150px;}
                img.place-icon2 {position: relative;width: 32px;height: 32px;top: -146px;left: 5px;}
                '; ?>

                </style>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['most_replied_to_1wk'] && $this->_tpl_vars['instance']->network != 'foursquare'): ?>
              <div class="section">
                <h2>This Week's Most <?php if ($this->_tpl_vars['instance']->network == 'google+'): ?>Discussed<?php else: ?>Replied-To<?php endif; ?> Posts</h2>
                <?php $_from = $this->_tpl_vars['most_replied_to_1wk']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['t']):
        $this->_foreach['foo']['iteration']++;
?>
                    <?php if ($this->_tpl_vars['instance']->network == 'twitter'): ?>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.counts_no_author.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['t'],'headings' => 'NONE')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    <?php elseif ($this->_tpl_vars['instance']->network == 'foursquare'): ?>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.checkin.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['t'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    <?php else: ?>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.counts_no_author.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['t'],'headings' => 'NONE','show_favorites_instead_of_retweets' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
              </div>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['most_faved_1wk']): ?>
              <div class="section">
                <h2>This Week's Most <?php if ($this->_tpl_vars['instance']->network == 'google+'): ?>+1ed<?php else: ?>Liked<?php endif; ?> Posts</h2>
                <?php $_from = $this->_tpl_vars['most_faved_1wk']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['t']):
        $this->_foreach['foo']['iteration']++;
?>
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.counts_no_author.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['t'],'headings' => 'NONE','show_favorites_instead_of_retweets' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php endforeach; endif; unset($_from); ?>
              </div>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['follower_count_history_by_day']['history'] && $this->_tpl_vars['follower_count_history_by_week']['history']): ?>
                <div class="section" style="float : left; clear : none; width : 345px;">
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_dashboard.followercountbyday.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
                <div class="section" style="float : left; clear : none;margin-left : 16px; width : 345px;">
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_dashboard.followercountbyweek.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['most_retweeted_1wk']): ?>
              <div class="clearfix section">
                <h2>This Week's Most <?php if ($this->_tpl_vars['instance']->network == 'google+'): ?>Reshared<?php else: ?>Retweeted<?php endif; ?> Posts</h2>
                <?php $_from = $this->_tpl_vars['most_retweeted_1wk']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['t']):
        $this->_foreach['foo']['iteration']++;
?>
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.counts_no_author.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['t'],'show_favorites_instead_of_retweets' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php endforeach; endif; unset($_from); ?>
              </div>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['instance']->network == 'twitter'): ?>
                <div class="section" style="float : left; clear : none; width : 345px;">
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_dashboard.posttypes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
                <div class="section" style="float : left; clear : none;margin-left : 10px; width : 345px;">
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_dashboard.clientusage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
            <?php endif; ?>

            <?php if (count($this->_tpl_vars['posts_flashback']) > 0): ?>
            <div class="section">
                <h2>Time Machine: On This Day In Years Past</h2>
                <?php if ($this->_tpl_vars['instance']->network == 'foursquare'): ?>
                    <?php $_from = $this->_tpl_vars['posts_flashback']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['post']):
        $this->_foreach['foo']['iteration']++;
?>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.checkin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                    <?php $_from = $this->_tpl_vars['posts_flashback']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tid'] => $this->_tpl_vars['post']):
        $this->_foreach['foo']['iteration']++;
?>
                      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_post.counts_no_author.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['post'],'show_favorites_instead_of_retweets' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
            </div>
           <?php endif; ?> 

          <?php endif; ?>          <?php endif; ?>
        <?php endif; ?>

        <?php if (! $this->_tpl_vars['instance']): ?>
          <div style="width:60%;text-align:center;">
          <?php if ($this->_tpl_vars['add_user_buttons']): ?>
          <br ><br>
            <?php $_from = $this->_tpl_vars['add_user_buttons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['smenuloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['smenuloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['smkey'] => $this->_tpl_vars['button']):
        $this->_foreach['smenuloop']['iteration']++;
?>
                <div style="float:right;padding:5px;"><a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
account/?p=<?php echo $this->_tpl_vars['button']; ?>
" class="linkbutton emphasized">Add a <?php if ($this->_tpl_vars['button'] == 'googleplus'): ?>Google+<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['button'])) ? $this->_run_mod_handler('ucwords', true, $_tmp) : ucwords($_tmp)); ?>
<?php endif; ?> Account &rarr;</a></div>
                <div style="clear:both;">&nbsp;</div>
             <?php endforeach; endif; unset($_from); ?>
          <?php endif; ?>
          <?php if ($this->_tpl_vars['logged_in_user']): ?>
          <div style="float:right;padding:5px;"><a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
account/" class="linkbutton emphasized">Adjust Your Settings</a></div>
          <?php else: ?>
          <div style="float:right;padding:5px;"><a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
session/login.php" class="linkbutton emphasized">Log In</a></div>
          <?php endif; ?>
          </div>
        <?php endif; ?>

      </div> <!-- /.prefix_1 -->
    </div> <!-- /.thinkup-canvas -->

  </div> <!-- /.clearfix -->
</div> <!-- /.container_24 -->


<?php if ($_GET['v'] == 'insights'): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_footer.tpl", 'smarty_include_vars' => array('enable_bootstrap' => 'true')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>