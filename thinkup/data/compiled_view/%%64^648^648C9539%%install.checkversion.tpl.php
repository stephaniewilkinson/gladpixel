<?php /* Smarty version 2.6.26, created on 2013-01-12 10:22:33
         compiled from install.checkversion.tpl */ ?>
<?php echo 'ThinkUpAppVersion = new function()  {
  var CONTENT_URL = \''; ?>
<?php echo $this->_tpl_vars['checker_url']; ?>
<?php echo '\';
  var ROOT = \'thinkup_version\';

  function requestContent( local ) {
    var script = document.createElement(\'script\');
    // How you\'d pass the current URL into the request
    // script.src = CONTENT_URL + \'&url=\' + escape(local || location.href);
    script.src = CONTENT_URL;
    // IE7 doesn\'t like this: document.body.appendChild(script);
    // Instead use:
    document.getElementsByTagName(\'head\')[0].appendChild(script);
  }

  this.serverResponse = function( data ) {
    if (!data[0].version) return;
    var div = document.getElementById(ROOT);
    var txt = \'\';
//    console.debug(data);
//    console.debug(\'version \' + data[0].version);
    txt += \' <a  class="linkbutton" style="background: #31C22D;color:white;" href="'; ?>
<?php echo $this->_tpl_vars['site_root_path']; ?>
<?php echo 'install/upgrade-application.php" title="\'+data[0].version+\'">Upgrade ThinkUp</a>\';
    div.innerHTML =  txt;  // assign new HTML into #ROOT
    div.style.display = \'inline\'; // make element visible
  }

  document.write("<span id=\'" + ROOT + "\' style=\'display: none\'></span>");
  requestContent();
}'; ?>
