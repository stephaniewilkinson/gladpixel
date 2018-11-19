<?php /* Smarty version 2.6.26, created on 2013-01-12 10:22:44
         compiled from _plugin.options.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'filter_xss', '_plugin.options.tpl', 106, false),array('modifier', 'escape', '_plugin.options.tpl', 116, false),array('modifier', 'count', '_plugin.options.tpl', 154, false),)), $this); ?>
<script type="text/javascript">
<?php if ($this->_tpl_vars['user_is_admin']): ?>
var option_elements = <?php echo $this->_tpl_vars['option_elements_json']; ?>
;
var option_not_required = <?php echo $this->_tpl_vars['option_not_required_json']; ?>
;
var option_required_message = <?php echo $this->_tpl_vars['option_required_message_json']; ?>
;
var plugin_id = '<?php echo $this->_tpl_vars['plugin_id']; ?>
';
var site_root = '<?php echo $this->_tpl_vars['site_root_path']; ?>
';
<?php endif; ?>
var is_admin = <?php if ($this->_tpl_vars['user_is_admin']): ?>true;<?php else: ?>false;<?php endif; ?>
<?php $this->assign('required_values_set', true); ?>
<?php $_from = $this->_tpl_vars['option_elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option_name'] => $this->_tpl_vars['option_obj']):
?>
    <?php if (! $this->_tpl_vars['option_not_required'][$this->_tpl_vars['option_name']] && ! $this->_tpl_vars['option_obj']['value'] && $this->_tpl_vars['required_values_set']): ?>
        <?php $this->assign('required_values_set', false); ?>
    <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
var required_values_set = <?php if ($this->_tpl_vars['required_values_set']): ?>true<?php else: ?>false<?php endif; ?>;

<?php echo '
var advanced_visible = false;
function show_advanced() {
    if(advanced_visible) {
        $(".advanced-option-label").hide();
        $(".advanced-option-input").hide();
        $(\'#adv-flip-prompt\').html(\'Show\');
        advanced_visible = false;
        $("#advanced-icon").removeClass(\'icon-chevron-up\').addClass(\'icon-chevron-down\');
    } else {
        $(".advanced-option-label").show();
        $(".advanced-option-input").show();
        $(\'#adv-flip-prompt\').html(\'Hide\');
        advanced_visible = true;
        $("#advanced-icon").removeClass(\'icon-chevron-down\').addClass(\'icon-chevron-up\');
    }
}
'; ?>

</script>

<form id="plugin_option_form" onsubmit="return false;">

<div class="alert alert-success"  id="plugin_options_success" style="display: none;">
     <p>
       <span class="icon-ok"></span>
       Saved!
     </p>
 </div> 


<div class="alert urgent" id="plugin_option_server_error" style="display: none;">
    <p>
        <span class="ui-icon ui-icon-alert" style="float: left; margin:.3em 0.3em 0 0;"></span>
        <span id="plugin_option_server_error_message"></span>
    </p>
</div>

<div id="plugin_option_error" 
    class="alert alert-error" style="margin: 20px 0px; padding: 0.5em 0.7em; display: none;">
    <p>
        <span class="icon-warning-sign"></span>
        Please complete all required fields
    </p>
</div>

<?php if ($this->_tpl_vars['user_is_admin']): ?>
<!-- plugin options form elements -->
<?php $_from = $this->_tpl_vars['option_elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option_name'] => $this->_tpl_vars['option_obj']):
?>
    <?php if ($this->_tpl_vars['option_obj']['advanced'] && ! isset ( $this->_tpl_vars['advanced_options'] )): ?>
        <p>
            <a href="#" onclick="show_advanced(); return false" class="btn btn-small">
            <i id="advanced-icon" class="icon-chevron-down"></i> <span id="adv-flip-prompt">Show</span>
            Advanced Options
            </a>
        </p>
        <?php $this->assign('advanced_options', 1); ?>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['option_headers'][$this->_tpl_vars['option_name']]): ?>
        <div id="plugin_options_<?php echo $this->_tpl_vars['option_obj']['name']; ?>
_header" style="font-weight: bold; margin: 10px 0px 0px 0px;">
            <?php echo $this->_tpl_vars['option_headers'][$this->_tpl_vars['option_name']]; ?>

        </div>
    <?php endif; ?>

<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; padding: 0.5em 0.7em; display: none;" 
    id="plugin_options_error_<?php echo $this->_tpl_vars['option_obj']['name']; ?>
">
    <p>
        <span class="ui-icon ui-icon-info" style="float: left; margin: 0.3em 0.3em 0pt 0pt;">&nbsp;</span>
        <span id="plugin_options_error_message_<?php echo $this->_tpl_vars['option_obj']['name']; ?>
">&nbsp;</span>
    </p>
</div>

<div style="float: left; margin-top: 10px; width: 200px;<?php if ($this->_tpl_vars['option_obj']['advanced']): ?>display: none;<?php endif; ?>" 
<?php if ($this->_tpl_vars['option_obj']['advanced']): ?>class="advanced-option-label"<?php endif; ?>>
    <label id="plugin_options_<?php echo $this->_tpl_vars['option_obj']['name']; ?>
_label">
    <?php if ($this->_tpl_vars['option_obj']['label']): ?>
        <?php echo $this->_tpl_vars['option_obj']['label']; ?>
:
    <?php else: ?>
        <?php echo $this->_tpl_vars['option_obj']['name']; ?>
:
    <?php endif; ?>
    <?php if ($this->_tpl_vars['option_not_required'][$this->_tpl_vars['option_name']]): ?><i>(optional)</i><?php endif; ?>
    </label>
</div>

<div style="float: left; margin: 10px 0px 0px 5px;<?php if ($this->_tpl_vars['option_obj']['advanced']): ?>display: none;<?php endif; ?>"
<?php if ($this->_tpl_vars['option_obj']['advanced']): ?>class="advanced-option-input"<?php endif; ?>>

    <?php if ($this->_tpl_vars['option_obj']['type'] == 'text_element'): ?>
        <input type="text" 
        value="<?php if (isset ( $this->_tpl_vars['option_obj']['value'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['option_obj']['value'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>
<?php endif; ?>"
            name="plugin_options_<?php echo $this->_tpl_vars['option_obj']['name']; ?>
" id="plugin_options_<?php echo $this->_tpl_vars['option_obj']['name']; ?>
"
            <?php if (isset ( $this->_tpl_vars['option_obj']['size'] )): ?>size="<?php echo $this->_tpl_vars['option_obj']['size']; ?>
" <?php endif; ?><?php if (! $this->_tpl_vars['user_is_admin']): ?> disabled="true"<?php endif; ?> />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['option_obj']['type'] == 'radio_element'): ?>
    
        <div id="plugin_options_<?php echo $this->_tpl_vars['option_obj']['name']; ?>
">
        
            <?php $_from = $this->_tpl_vars['option_obj']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['radio_name'] => $this->_tpl_vars['radio_value']):
?>
                <div style="float: left;">
                    <input type="radio" name="plugin_options_<?php echo $this->_tpl_vars['option_obj']['name']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['radio_value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" 
                        <?php if (! $this->_tpl_vars['user_is_admin']): ?> disabled="true"<?php endif; ?> 
                        <?php if (isset ( $this->_tpl_vars['option_obj']['value'] ) && $this->_tpl_vars['option_obj']['value'] == $this->_tpl_vars['radio_value']): ?> checked="true"<?php endif; ?> 
                        /> <?php echo ((is_array($_tmp=$this->_tpl_vars['radio_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
 &nbsp;
                </div>
            <?php endforeach; endif; unset($_from); ?>

            <div style="clear: both;"></div>

        </div>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['option_obj']['type'] == 'select_element'): ?>
        <div style="float: left;">
        <select name="plugin_options_<?php echo $this->_tpl_vars['option_obj']['name']; ?>
" id="plugin_options_<?php echo $this->_tpl_vars['option_obj']['name']; ?>
" 
        <?php if (! $this->_tpl_vars['user_is_admin']): ?> disabled="true"<?php endif; ?> >
        <?php $_from = $this->_tpl_vars['option_obj']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['select_name'] => $this->_tpl_vars['select_value']):
?>
                <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['select_value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"
                <?php if (isset ( $this->_tpl_vars['option_obj']['value'] ) && $this->_tpl_vars['option_obj']['value'] == $this->_tpl_vars['select_value']): ?>selected="true"<?php endif; ?>>
                <?php echo $this->_tpl_vars['select_name']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
        </select>
        </div>
        <div style="clear: both;"></div>
    <?php endif; ?>

</div>

<div style="clear: both;"></div>
<?php endforeach; endif; unset($_from); ?>

<?php endif; ?>

<p style="margin-top: 10px;" id="plugin_option_submit_p">
<?php if ($this->_tpl_vars['user_is_admin']): ?>
<input type="submit" value="Save Settings" class="btn btn-primary"/>
<?php endif; ?>
</p>

<!--<?php if (count($this->_tpl_vars['option_not_required']) > 0): ?>
<p>
    <i style="font-size: 12px;">* optional</i>
</p>
<?php endif; ?>-->

</form> 