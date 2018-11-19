146
a:4:{s:8:"template";a:1:{s:24:"install.checkversion.tpl";b:1;}s:9:"timestamp";i:1361634140;s:7:"expires";i:1361634740;s:13:"cache_serials";a:0:{}}ThinkUpAppVersion = new function()  {
  var CONTENT_URL = 'http://thinkupapp.com/version.php?v=2.0-beta.1';
  var ROOT = 'thinkup_version';

  function requestContent( local ) {
    var script = document.createElement('script');
    // How you'd pass the current URL into the request
    // script.src = CONTENT_URL + '&url=' + escape(local || location.href);
    script.src = CONTENT_URL;
    // IE7 doesn't like this: document.body.appendChild(script);
    // Instead use:
    document.getElementsByTagName('head')[0].appendChild(script);
  }

  this.serverResponse = function( data ) {
    if (!data[0].version) return;
    var div = document.getElementById(ROOT);
    var txt = '';
//    console.debug(data);
//    console.debug('version ' + data[0].version);
    txt += ' <a  class="linkbutton" style="background: #31C22D;color:white;" href="/thinkup/install/upgrade-application.php" title="'+data[0].version+'">Upgrade ThinkUp</a>';
    div.innerHTML =  txt;  // assign new HTML into #ROOT
    div.style.display = 'inline'; // make element visible
  }

  document.write("<span id='" + ROOT + "' style='display: none'></span>");
  requestContent();
}