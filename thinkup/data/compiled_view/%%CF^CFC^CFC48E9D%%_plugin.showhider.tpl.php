<?php /* Smarty version 2.6.26, created on 2013-01-12 10:22:44
         compiled from _plugin.showhider.tpl */ ?>
<script type="text/javascript">
<?php echo '
var settings_visible = '; ?>
<?php if ($this->_tpl_vars['is_configured']): ?>true<?php else: ?>false<?php endif; ?><?php echo ';
function show_settings() {
    if (settings_visible) {
        $(".plugin-settings").hide();
        $(\'#settings-flip-prompt\').html(\'Show\');
        settings_visible = false;
        $("#settings-icon").removeClass(\'icon-chevron-up\').addClass(\'icon-chevron-down\');
    } else {
        $(".plugin-settings").show();
        $(\'#settings-flip-prompt\').html(\'Hide\');
        settings_visible = true;
        $("#settings-icon").removeClass(\'icon-chevron-down\').addClass(\'icon-chevron-up\');
    }
}
  $(document).ready(function() {
      show_settings();
    });
'; ?>

</script>

<?php if ($this->_tpl_vars['is_configured']): ?>
<p>
    <a href="#" onclick="show_settings(); return false" class="btn btn-small"><i id="settings-icon" class="icon-chevron-down"></i> <span id="settings-flip-prompt">Show</span> Settings</a>
</p>
<?php endif; ?>
<div class="plugin-settings">
<h2 class="subhead">Settings</h2>