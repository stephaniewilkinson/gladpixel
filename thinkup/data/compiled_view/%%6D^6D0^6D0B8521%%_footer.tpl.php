<?php /* Smarty version 2.6.26, created on 2013-01-12 18:01:56
         compiled from _footer.tpl */ ?>
  <?php if ($this->_tpl_vars['linkify'] != 'false'): ?>
  <script type="text/javascript" src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/js/linkify.js"></script>
  <?php endif; ?>

<?php if ($this->_tpl_vars['enable_bootstrap']): ?>

    </div><!-- end container -->

    <div id="sticky-footer-fix-clear"></div>
</div><!-- #sticky-footer-fix-wrapper -->

      <footer>
        <div class="container footer">
          <p class="pull-right"><a href="#">Back to top <i class="icon-chevron-up"></i></a></p>
          <p><a href="http://thinkup.com">ThinkUp<?php if ($this->_tpl_vars['thinkup_version']): ?> <?php echo $this->_tpl_vars['thinkup_version']; ?>
<?php endif; ?></a> &#8226; 
          <a href="http://thinkupapp.com/docs/">Documentation</a>  &#8226; 
          <a href="https://groups.google.com/forum/?fromgroups#!forum/thinkupapp">Mailing List</a> &#8226;
          <a href="<?php echo $this->_tpl_vars['site_root_path']; ?>
dashboard.php">Old-School Dashboard</a></p>  
          <p>
          <a href="http://twitter.com/thinkup"><img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/img/favicon_twitter.png"></a>
          <a href="http://facebook.com/thinkupapp"><img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/img/favicon_facebook.png"></a>
          <a href="http://gplus.to/thinkup"><img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/img/favicon_googleplus.png"></a>
          &copy; ThinkUp LLC 2012. It is nice to be nice.
          </p>
        </div>
      </footer>

<?php else: ?>

  <div class="small center" id="footer">
    <div id="ft" role="contentinfo">
    <div id="">
      <p>
       <a href="http://thinkupapp.com">ThinkUp<?php if ($this->_tpl_vars['thinkup_version']): ?> <?php echo $this->_tpl_vars['thinkup_version']; ?>
<?php endif; ?></a> &#8226; 
       <a href="http://thinkupapp.com/docs/">Documentation</a> 
       &#8226; <a href="http://groups.google.com/group/thinkupapp">Mailing List</a> 
       &#8226; <a href="http://webchat.freenode.net/?channels=thinkup">IRC Channel</a><br>
        It is nice to be nice.
        <br /> <br /><a href="http://twitter.com/thinkup"><img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/img/favicon_twitter.png"></a>
        <a href="http://facebook.com/thinkupapp"><img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/img/favicon_facebook.png"></a>
        <a href="http://gplus.to/thinkup"><img src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/img/favicon_googleplus.png"></a>
      </p>
    </div>
    </div> <!-- #ft -->

  </div> <!-- .content -->

<div id="screen"></div>

<?php endif; ?> <!-- end bootstrap loop -->

</body>

</html>