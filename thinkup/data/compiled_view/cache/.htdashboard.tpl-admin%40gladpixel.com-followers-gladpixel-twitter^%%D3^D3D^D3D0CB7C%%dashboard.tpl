316
a:4:{s:8:"template";a:6:{s:13:"dashboard.tpl";b:1;s:11:"_header.tpl";b:1;s:14:"_statusbar.tpl";b:1;s:16:"_usermessage.tpl";b:1;s:69:"/home/gladpixe/public_html/thinkup/plugins/twitter/view/followers.tpl";b:1;s:11:"_footer.tpl";b:1;}s:9:"timestamp";i:1361634643;s:7:"expires";i:1361635243;s:13:"cache_serials";a:0:{}}<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/Article">
<head>
    <meta charset="utf-8">
    <title>gladpixel on Twitter | ThinkUp</title>
    <link rel="shortcut icon" type="image/x-icon" href="/thinkup/assets/img/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/thinkup/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/thinkup/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/thinkup/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/thinkup/assets/ico/apple-touch-icon-57-precomposed.png">


 <!-- not bootstrap -->
  
    <link type="text/css" rel="stylesheet" href="/thinkup/assets/css/base.css">
    <link type="text/css" rel="stylesheet" href="/thinkup/assets/css/style.css">
        <!-- jquery -->
    <link type="text/css" rel="stylesheet" href="/thinkup/assets/css/jquery-ui-1.8.13.css">

    <script type="text/javascript" src="/thinkup/assets/js/jquery.min-1.4.js"></script>
    <script type="text/javascript" src="/thinkup/assets/js/jquery-ui.min-1.8.js"></script>
  
    
      <script type="text/javascript">
      $(document).ready(function() {
          $(".post").hover(
            function() { $(this).children(".small").children(".metaroll").show(); },
            function() { $(this).children(".small").children(".metaroll").hide(); }
          );
          $(".metaroll").hide();
        });
      </script>
    

    <!-- custom css -->
    
    <style>
        .line { background:url('/thinkup/assets/img/border-line-470.gif') no-repeat center bottom;
            margin: 8px auto;
            height: 1px;
        }
        
    </style>
    
  


  <!-- google chart tools -->
  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="/thinkup/plugins/twitter/assets/js/widgets.js"></script>
  <script type="text/javascript">var site_root_path = '/thinkup/';</script>
  

</head>
<body>



  <script type="text/javascript">
    $(document).ready(function() {
      function changeMe() {
        var _mu = $("select#instance-select").val();
        if (_mu != "null") {
          document.location.href = _mu;
        }
      }
    });
  </script>


<div id="status-bar" class="clearfix"> 

  <div class="status-bar-left">
          <!-- the user has selected a particular one of their instances -->
      
        <script type="text/javascript">
          function changeMe() {
            var _mu = $("select#instance-select").val();
            if (_mu != "null") {
              document.location.href = _mu;
            }
          }
        </script>
      
      
                 <a href="/thinkup/crawler/updatenow.php" class="linkbutton">Capture Data</a>  </div> <!-- .status-bar-left -->
  
  <div class="status-bar-right text-right">
    <ul> 
        <li><a href="/thinkup/" class="linkbutton" style="background: #31C22D;color:white;">Insights (New!)</a></li>
              <li>Logged in as admin: admin@gladpixel.com <script src="/thinkup/install/checkversion.php"></script><a href="/thinkup/account/?m=manage" class="linkbutton">Settings</a> <a href="/thinkup/session/logout.php" class="linkbutton">Log Out</a></li>
          </ul>
  </div> <!-- .status-bar-right -->

  
</div> <!-- #status-bar -->

<div id="page-bkgd">

<div class="container clearfix">
  
  <div id="app-title"><a href="/thinkup/">
    <h1><span id="headerthink">Think</span><span id="headerup">Up</span></h1>
  </a></div> <!-- end #app-title -->
  
</div> <!-- end .container -->


<div class="container_24">
  <div class="clearfix">
    <!-- begin left nav -->
    <div class="grid_4 alpha omega">
              <div id="nav">
        <ul id="top-level-sidenav">
                              <li>
                <a href="/thinkup/dashboard.php?u=gladpixel&n=twitter">Dashboard</a>
              </li>
                                                    <li>
                                                <a href="/thinkup/dashboard.php?v=tweets&u=gladpixel&n=twitter">Tweets</a></li>
                                                   <li class="selected">
                                                <a href="/thinkup/dashboard.php?v=followers&u=gladpixel&n=twitter">Followers</a></li>
                                                   <li>
                                                <a href="/thinkup/dashboard.php?v=you-follow&u=gladpixel&n=twitter">Who You Follow</a></li>
                                                   <li>
                                                <a href="/thinkup/dashboard.php?v=links&u=gladpixel&n=twitter">Links</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                     
                        </ul>
      </div>
            </div>

    <div class="thinkup-canvas round-all grid_20 alpha omega prepend_20 append_20" style="min-height:340px">
      <div class="prefix_1 suffix_1">

        

                    
                                        <div class="grid_18 alpha omega">
              <div class="clearfix alert stats round-all" id="">
                <div class="grid_2 alpha">
                  <div class="avatar-container">
                    <img src="http://a0.twimg.com/profile_images/3065555810/00a903f2b94d3edbf57c0728feaed0c6_normal.png" class="avatar2" width="48" height="48"/>
                    <img src="/thinkup/plugins/twitter/assets/img/favicon.png" class="service-icon2"/>
                  </div>
                </div>
                <div class="grid_15 omega">
                  <span class="tweet">gladpixel <span style="color:#ccc">Twitter</span></span><br />
                  <div class="small">
                    Updated 5 mins  ago                  </div>
                </div>
              </div>
            </div>

                      <div class="section">
    <h2>This Week's Most Discerning Followers</h2>
    <div class="article" style="padding-left : 0px; padding-top : 0px;">
          <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=335321724"  title="AshleyTiaX has 79,450 followers and 28,249 friends"><img src="http://a0.twimg.com/profile_images/3296670307/e3b11653c655555372c76cd1a3277cf3_normal.jpeg" class="avatar2"/><img src="/thinkup/plugins/twitter/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
          <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=311539323"  title="DesignSoak has 63,762 followers and 56,691 friends"><img src="http://a0.twimg.com/profile_images/1387374814/soak_gravatar_normal.png" class="avatar2"/><img src="/thinkup/plugins/twitter/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
          <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=16465359"  title="MagicSauceMedia has 104,226 followers and 100,198 friends"><img src="http://a0.twimg.com/profile_images/3177767648/e3bf3f50996fdb411a5fefe3e842a9b8_normal.jpeg" class="avatar2"/><img src="/thinkup/plugins/twitter/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
            <br /><br /><br />
    </div>
    <div class="view-all"><a href="?v=followers-leastlikely&u=gladpixel&n=twitter">More...</a></div>
</div>

<div class="section">
    <h2>All-Time Most Discerning Followers</h2>
    <div class="article" style="padding-left : 0px; padding-top : 0px;">
          <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=335321724" title="AshleyTiaX has 79,450 followers and 28,249 friends"><img src="http://a0.twimg.com/profile_images/3296670307/e3b11653c655555372c76cd1a3277cf3_normal.jpeg" class="avatar2"/><img src="/thinkup/plugins/twitter/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
          <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=311539323" title="DesignSoak has 63,762 followers and 56,691 friends"><img src="http://a0.twimg.com/profile_images/1387374814/soak_gravatar_normal.png" class="avatar2"/><img src="/thinkup/plugins/twitter/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
          <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=16465359" title="MagicSauceMedia has 104,226 followers and 100,198 friends"><img src="http://a0.twimg.com/profile_images/3177767648/e3bf3f50996fdb411a5fefe3e842a9b8_normal.jpeg" class="avatar2"/><img src="/thinkup/plugins/twitter/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
        <br /><br /><br />
    </div>
    <div class="view-all"><a href="?v=followers-leastlikely&u=gladpixel&n=twitter">More...</a></div>
</div>

<div class="section">
    <h2>Most Popular Followers</h2>
    <div class="article" style="padding-left : 0px; padding-top : 0px;">
          <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=16465359" title="MagicSauceMedia has 104,226 followers and 100,198 friends"><img src="http://a0.twimg.com/profile_images/3177767648/e3bf3f50996fdb411a5fefe3e842a9b8_normal.jpeg" class="avatar2"/><img src="/thinkup/plugins/twitter/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
          <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=335321724" title="AshleyTiaX has 79,450 followers and 28,249 friends"><img src="http://a0.twimg.com/profile_images/3296670307/e3b11653c655555372c76cd1a3277cf3_normal.jpeg" class="avatar2"/><img src="/thinkup/plugins/twitter/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
          <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=311539323" title="DesignSoak has 63,762 followers and 56,691 friends"><img src="http://a0.twimg.com/profile_images/1387374814/soak_gravatar_normal.png" class="avatar2"/><img src="/thinkup/plugins/twitter/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
          <div class="avatar-container" style="float:left;margin:7px;">
        <a href="https://twitter.com/intent/user?user_id=1042538174" title="dxthemes has 362 followers and 477 friends"><img src="http://a0.twimg.com/profile_images/3141821032/9eed0117e3dc3fae4c69918af20d9691_normal.png" class="avatar2"/><img src="/thinkup/plugins/twitter/assets/img/favicon.png" class="service-icon2"/></a>
      </div>
        <br /><br /><br />
</div>
<div class="view-all"><a href="?v=followers-mostfollowed&u=gladpixel&n=twitter">More...</a></div>
</div>


<div class="section">
    <h2>Follower Count By Day </h2>
        <div class="alert urgent">Not enough data to display chart</div>
    </div>

<div class="section">
    <h2>Follower Count By Week </h2>
    <div class="alert urgent">Not enough data to display chart</div>
    </div>

<div class="section">
    <h2>Follower Count By Month </h2>
    <div class="alert urgent">Not enough data to display chart</div>
    </div>

<div class="section">
    <h2>List Membership Count By Day </h2>
        <div class="alert urgent">Not enough data to display chart</div>
    </div>

<div class="section">
    <h2>List Membership Count By Week </h2>
    <div class="alert urgent">Not enough data to display chart</div>
    </div>

<div class="section">
    <h2>List Membership Count By Month </h2>
    <div class="alert urgent">Not enough data to display chart</div>
    </div>

<script type="text/javascript">
// Load the Visualization API and the standard charts
google.load('visualization', '1');
// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawCharts);


function drawCharts() {

    var follower_count_history_by_day_data = new google.visualization.DataTable(
        {"rows":[{"c":[{"v":new Date(2013,1,23),"f":"02\/23\/2013"},{"v":4}]}],"cols":[{"type":"date","label":"Date"},{"type":"number","label":"Followers"}]});
    var follower_count_history_by_week_data = new google.visualization.DataTable(
        {"rows":[{"c":[{"v":new Date(2013,1,23),"f":"02\/23"},{"v":4}]}],"cols":[{"type":"date","label":"Date"},{"type":"number","label":"Followers"}]});
    var follower_count_history_by_month_data = new google.visualization.DataTable(
        {"rows":[{"c":[{"v":new Date(2013,1,23),"f":"02\/01\/2013"},{"v":4}]}],"cols":[{"type":"date","label":"Date"},{"type":"number","label":"Followers"}]});
    var list_membership_count_history_by_day_data = new google.visualization.DataTable(
        {"rows":[{"c":[{"v":new Date(2013,1,23),"f":"02\/23\/2013"},{"v":0}]}],"cols":[{"type":"date","label":"Date"},{"type":"number","label":"Lists"}]});
    var list_membership_count_history_by_week_data = new google.visualization.DataTable(
        {"rows":[{"c":[{"v":new Date(2013,1,23),"f":"02\/23"},{"v":0}]}],"cols":[{"type":"date","label":"Date"},{"type":"number","label":"Lists"}]});
    var list_membership_count_history_by_month_data = new google.visualization.DataTable(
        {"rows":[{"c":[{"v":new Date(2013,1,23),"f":"02\/01\/2013"},{"v":0}]}],"cols":[{"type":"date","label":"Date"},{"type":"number","label":"Lists"}]});

    var formatter = new google.visualization.NumberFormat({fractionDigits: 0});
    var formatter_date = new google.visualization.DateFormat({formatType: 'medium'});

    var chart_options = {
            colors: ['#3c8ecc'],
            width: '100%',
            height: 250,
            legend: "none",
            interpolateNulls: true,
            pointSize: 2,
            hAxis: {
                baselineColor: '#eee',
                format: 'MMM d',
                textStyle: { color: '#999' },
                gridlines: { color: '#eee' }
            },
            vAxis: {
                baselineColor: '#eee',
                textStyle: { color: '#999' },
                gridlines: { color: '#eee' }
            },    
    };
    
    formatter.format(follower_count_history_by_day_data, 1);
    formatter_date.format(follower_count_history_by_day_data, 0);
    var follower_count_history_by_day_chart = new google.visualization.ChartWrapper({
        containerId: 'follower_count_history_by_day',
        chartType: 'LineChart',
        dataTable: follower_count_history_by_day_data,
        options: chart_options
    });
    follower_count_history_by_day_chart.draw();

    formatter.format(follower_count_history_by_week_data, 1);
    formatter_date.format(follower_count_history_by_week_data, 0);
    var follower_count_history_by_week_chart = new google.visualization.ChartWrapper({
        containerId: 'follower_count_history_by_week',
        chartType: 'LineChart',
        dataTable: follower_count_history_by_week_data,
        options: chart_options
    });
    follower_count_history_by_week_chart.draw();

    formatter.format(follower_count_history_by_month_data, 1);
    formatter_date.format(follower_count_history_by_month_data, 0);
    var follower_count_history_by_month_chart = new google.visualization.ChartWrapper({
        containerId: 'follower_count_history_by_month',
        chartType: 'LineChart',
        dataTable: follower_count_history_by_month_data,
        options: {
            colors: ['#3c8ecc'],
            width: '100%',
            height: 250,
            legend: "none",
            interpolateNulls: true,
            pointSize: 2,
            hAxis: {
                baselineColor: '#eee',
                format: 'MMM yyyy',
                textStyle: { color: '#999' },
                gridlines: { color: '#eee' }
            },
            vAxis: {
                baselineColor: '#eee',
                textStyle: { color: '#999' },
                gridlines: { color: '#eee' }
            },
        },
    });
    follower_count_history_by_month_chart.draw();

    formatter.format(list_membership_count_history_by_day_data, 1);
    formatter_date.format(list_membership_count_history_by_day_data, 0);
    var list_membership_count_history_by_day_chart = new google.visualization.ChartWrapper({
        containerId: 'list_membership_count_history_by_day',
        chartType: 'LineChart',
        dataTable: list_membership_count_history_by_day_data,
        options: chart_options
    });
    list_membership_count_history_by_day_chart.draw();

    formatter.format(list_membership_count_history_by_week_data, 1);
    formatter_date.format(list_membership_count_history_by_week_data, 0);
    var list_membership_count_history_by_week_chart = new google.visualization.ChartWrapper({
        containerId: 'list_membership_count_history_by_week',
        chartType: 'LineChart',
        dataTable: list_membership_count_history_by_week_data,
        options: chart_options
    });
    list_membership_count_history_by_week_chart.draw();
    
    formatter.format(list_membership_count_history_by_month_data, 1);
    formatter_date.format(list_membership_count_history_by_month_data, 0);
    var list_membership_count_history_by_month_chart = new google.visualization.ChartWrapper({
        containerId: 'list_membership_count_history_by_month',
        chartType: 'LineChart',
        dataTable: list_membership_count_history_by_month_data,
        options: {
            colors: ['#3c8ecc'],
            width: '100%',
            height: 250,
            legend: "none",
            interpolateNulls: true,
            pointSize: 2,
            hAxis: {
                baselineColor: '#eee',
                format: 'MMM yyyy',
                textStyle: { color: '#999' },
                gridlines: { color: '#eee' }
            },
            vAxis: {
                baselineColor: '#eee',
                textStyle: { color: '#999' },
                gridlines: { color: '#eee' }
            },
        },
    });
    list_membership_count_history_by_month_chart.draw();

}


</script>                            
        
      </div> <!-- /.prefix_1 -->
    </div> <!-- /.thinkup-canvas -->

  </div> <!-- /.clearfix -->
</div> <!-- /.container_24 -->


        <script type="text/javascript" src="/thinkup/assets/js/linkify.js"></script>
  

  <div class="small center" id="footer">
    <div id="ft" role="contentinfo">
    <div id="">
      <p>
       <a href="http://thinkupapp.com">ThinkUp 2.0-beta.1</a> &#8226; 
       <a href="http://thinkupapp.com/docs/">Documentation</a> 
       &#8226; <a href="http://groups.google.com/group/thinkupapp">Mailing List</a> 
       &#8226; <a href="http://webchat.freenode.net/?channels=thinkup">IRC Channel</a><br>
        It is nice to be nice.
        <br /> <br /><a href="http://twitter.com/thinkup"><img src="/thinkup/assets/img/favicon_twitter.png"></a>
        <a href="http://facebook.com/thinkupapp"><img src="/thinkup/assets/img/favicon_facebook.png"></a>
        <a href="http://gplus.to/thinkup"><img src="/thinkup/assets/img/favicon_googleplus.png"></a>
      </p>
    </div>
    </div> <!-- #ft -->

  </div> <!-- .content -->

<div id="screen"></div>

 <!-- end bootstrap loop -->

</body>

</html>