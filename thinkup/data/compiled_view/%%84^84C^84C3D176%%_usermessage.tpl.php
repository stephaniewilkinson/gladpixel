<?php /* Smarty version 2.6.26, created on 2013-01-12 18:01:56
         compiled from _usermessage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'filter_xss', '_usermessage.tpl', 10, false),)), $this); ?>
<?php if ($this->_tpl_vars['enable_bootstrap']): ?>
    <?php if ($this->_tpl_vars['inline']): ?>
        <?php if ($this->_tpl_vars['field']): ?>
            <?php if ($this->_tpl_vars['success_msgs'][$this->_tpl_vars['field']]): ?>
             <span class="label label-success">
 
                   <?php if ($this->_tpl_vars['success_msg_no_xss_filter']): ?>
                       <?php echo $this->_tpl_vars['success_msgs'][$this->_tpl_vars['field']]; ?>

                   <?php else: ?>
                       <?php echo ((is_array($_tmp=$this->_tpl_vars['success_msgs'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                   <?php endif; ?>

             </span>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['error_msgs'][$this->_tpl_vars['field']]): ?>
             <span class="label label-error">
 
                   <?php if ($this->_tpl_vars['error_msg_no_xss_filter']): ?>
                       <?php echo $this->_tpl_vars['error_msgs'][$this->_tpl_vars['field']]; ?>

                   <?php else: ?>
                       <?php echo ((is_array($_tmp=$this->_tpl_vars['error_msgs'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                   <?php endif; ?>

            </span>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['info_msgs'][$this->_tpl_vars['field']]): ?>
            <?php if ($this->_tpl_vars['success_msgs'][$this->_tpl_vars['field']] || $this->_tpl_vars['error_msgs'][$this->_tpl_vars['field']]): ?><br /><?php endif; ?>
            <span class="label label-info"> 

                     <?php if ($this->_tpl_vars['info_msg_no_xss_filter']): ?>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['info_msgs'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                     <?php else: ?>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['info_msgs'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                     <?php endif; ?>
                </p>
            </span>
            <?php endif; ?>
        <?php else: ?>
            <?php if ($this->_tpl_vars['success_msg']): ?>
             <span class="label label-info" style="">
 
                   <?php if ($this->_tpl_vars['success_msg_no_xss_filter']): ?>
                       <?php echo $this->_tpl_vars['success_msg']; ?>

                   <?php else: ?>
                       <?php echo ((is_array($_tmp=$this->_tpl_vars['success_msg'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                   <?php endif; ?>

             </span>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['error_msg']): ?>
             <span class="label label-error" style="">
 
                   <?php if ($this->_tpl_vars['error_msg_no_xss_filter']): ?>
                       <?php echo $this->_tpl_vars['error_msg']; ?>

                   <?php else: ?>
                       <?php echo ((is_array($_tmp=$this->_tpl_vars['error_msg'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                   <?php endif; ?>

            </span>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['info_msg']): ?>
                <?php if ($this->_tpl_vars['success_msg'] || $this->_tpl_vars['error_msg']): ?><br /><?php endif; ?>
            <span class="label label-success"> 

                     <?php if ($this->_tpl_vars['info_msg_no_xss_filter']): ?>
                        <?php echo $this->_tpl_vars['info_msg']; ?>

                     <?php else: ?>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['info_msg'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                     <?php endif; ?>
                </p>
            </span>
            <?php endif; ?>
        <?php endif; ?>

    <?php else: ?>

        <?php if ($this->_tpl_vars['field']): ?>
            <?php if ($this->_tpl_vars['success_msgs'][$this->_tpl_vars['field']]): ?>
             <div class="alert alert-success">
                 <p>
                   <?php if ($this->_tpl_vars['success_msg_no_xss_filter']): ?>
                       <?php echo $this->_tpl_vars['success_msgs'][$this->_tpl_vars['field']]; ?>

                   <?php else: ?>
                       <?php echo ((is_array($_tmp=$this->_tpl_vars['success_msgs'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                   <?php endif; ?>
                 </p>
             </div>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['error_msgs'][$this->_tpl_vars['field']]): ?>
             <div class="alert alert-error">
                 <p>
                   <?php if ($this->_tpl_vars['error_msg_no_xss_filter']): ?>
                       <?php echo $this->_tpl_vars['error_msgs'][$this->_tpl_vars['field']]; ?>

                   <?php else: ?>
                       <?php echo ((is_array($_tmp=$this->_tpl_vars['error_msgs'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                   <?php endif; ?>
                 </p>
            </div>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['info_msgs'][$this->_tpl_vars['field']]): ?>
            <?php if ($this->_tpl_vars['success_msgs'][$this->_tpl_vars['field']] || $this->_tpl_vars['error_msgs'][$this->_tpl_vars['field']]): ?><br /><?php endif; ?>
            <div class="alert alert-info"> 
                <p>
                     
                     <?php if ($this->_tpl_vars['info_msg_no_xss_filter']): ?>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['info_msgs'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                     <?php else: ?>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['info_msgs'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                     <?php endif; ?>
                </p>
            </div>
            <?php endif; ?>
        <?php else: ?>
            <?php if ($this->_tpl_vars['success_msg']): ?>
             <div class="alert alert-info" style="">
                 <p>
                   <?php if ($this->_tpl_vars['success_msg_no_xss_filter']): ?>
                       <?php echo $this->_tpl_vars['success_msg']; ?>

                   <?php else: ?>
                       <?php echo ((is_array($_tmp=$this->_tpl_vars['success_msg'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                   <?php endif; ?>
                 </p>
             </div>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['error_msg']): ?>
             <div class="alert alert-error" style="">
                 <p>
                   <?php if ($this->_tpl_vars['error_msg_no_xss_filter']): ?>
                       <?php echo $this->_tpl_vars['error_msg']; ?>

                   <?php else: ?>
                       <?php echo ((is_array($_tmp=$this->_tpl_vars['error_msg'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                   <?php endif; ?>
                 </p>
            </div>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['info_msg']): ?>
                <?php if ($this->_tpl_vars['success_msg'] || $this->_tpl_vars['error_msg']): ?><br /><?php endif; ?>
            <div class="alert alert-success"> 
                <p>
                     
                     <?php if ($this->_tpl_vars['info_msg_no_xss_filter']): ?>
                        <?php echo $this->_tpl_vars['info_msg']; ?>

                     <?php else: ?>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['info_msg'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

                     <?php endif; ?>
                </p>
            </div>
            <?php endif; ?>

        <?php endif; ?>

    <?php endif; ?>

<?php else: ?>


<?php if ($this->_tpl_vars['field']): ?>
    <?php if ($this->_tpl_vars['success_msgs'][$this->_tpl_vars['field']]): ?>
     <div class="alert alert-success">
         <p>
           <span class="icon-ok"></span>
           <?php if ($this->_tpl_vars['success_msg_no_xss_filter']): ?>
               <?php echo $this->_tpl_vars['success_msgs'][$this->_tpl_vars['field']]; ?>

           <?php else: ?>
               <?php echo ((is_array($_tmp=$this->_tpl_vars['success_msgs'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

           <?php endif; ?>
         </p>
     </div>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['error_msgs'][$this->_tpl_vars['field']]): ?>
     <div class="alert alert-danger">
         <p>
           <span class="icon-warning-sign"></span>
           <?php if ($this->_tpl_vars['error_msg_no_xss_filter']): ?>
               <?php echo $this->_tpl_vars['error_msgs'][$this->_tpl_vars['field']]; ?>

           <?php else: ?>
               <?php echo ((is_array($_tmp=$this->_tpl_vars['error_msgs'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

           <?php endif; ?>
         </p>
    </div>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['info_msgs'][$this->_tpl_vars['field']]): ?>
    <?php if ($this->_tpl_vars['success_msgs'][$this->_tpl_vars['field']] || $this->_tpl_vars['error_msgs'][$this->_tpl_vars['field']]): ?><br /><?php endif; ?>
    <div class="alert stats" style="margin-top: 10px; padding: 0.5em 0.7em;"> 
        <p>
             <span class="icon-info-sign"></span>
             <?php if ($this->_tpl_vars['info_msg_no_xss_filter']): ?>
                <?php echo ((is_array($_tmp=$this->_tpl_vars['info_msgs'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

             <?php else: ?>
                <?php echo ((is_array($_tmp=$this->_tpl_vars['info_msgs'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

             <?php endif; ?>
        </p>
    </div>
    <?php endif; ?>
<?php else: ?>
    <?php if ($this->_tpl_vars['success_msg']): ?>
     <div class="alert helpful" style="">
         <p>
           <span class="icon-ok"></span>
           <?php if ($this->_tpl_vars['success_msg_no_xss_filter']): ?>
               <?php echo $this->_tpl_vars['success_msg']; ?>

           <?php else: ?>
               <?php echo ((is_array($_tmp=$this->_tpl_vars['success_msg'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

           <?php endif; ?>
         </p>
     </div>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['error_msg']): ?>
     <div class="alert urgent" style="">
         <p>
           <span class="icon-warning-sign"></span>
           <?php if ($this->_tpl_vars['error_msg_no_xss_filter']): ?>
               <?php echo $this->_tpl_vars['error_msg']; ?>

           <?php else: ?>
               <?php echo ((is_array($_tmp=$this->_tpl_vars['error_msg'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

           <?php endif; ?>
         </p>
    </div>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['info_msg']): ?>
    <?php if ($this->_tpl_vars['success_msg'] || $this->_tpl_vars['error_msg']): ?><br /><?php endif; ?>
    <div class="alert helpful" style="margin-top: 10px; padding: 0.5em 0.7em;"> 
        <p>
             <span class="icon-info-sign"></span>
             <?php if ($this->_tpl_vars['info_msg_no_xss_filter']): ?>
                <?php echo $this->_tpl_vars['info_msg']; ?>

             <?php else: ?>
                <?php echo ((is_array($_tmp=$this->_tpl_vars['info_msg'])) ? $this->_run_mod_handler('filter_xss', true, $_tmp) : smarty_modifier_filter_xss($_tmp)); ?>

             <?php endif; ?>
        </p>
    </div>
    <?php endif; ?>
<?php endif; ?>
<?php endif; ?>