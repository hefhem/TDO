<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == false) {
    header('Location: signin.php');
}
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="description" content="Flat, Clean, Responsive, application admin template built with bootstrap 3">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <!-- /meta -->

    <title>TDO Solution</title>

    <!-- page level plugin styles -->
	 <link rel="stylesheet" href="plugins/chosen/chosen.min.css">
    <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.css">
    <!-- /page level plugin styles -->

    <!-- core styles -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="js/jquery.gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- /core styles -->

    <!-- template styles -->
    <link rel="stylesheet" href="css/skins/palette.css">
    <link rel="stylesheet" href="css/fonts/font.css">
    <link rel="stylesheet" href="css/main.css">
    <!-- template styles -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- load modernizer -->
    <script src="plugins/modernizr.js"></script>
</head>

<!-- body -->

<body>
    <div class="app">
        <!-- top header -->
        <header class="header header-fixed navbar">

            <div class="brand">
                <!-- toggle offscreen menu -->
                <a href="javascript:;" class="ti-menu off-left visible-xs" data-toggle="offscreen" data-move="ltr"></a>
                <!-- /toggle offscreen menu -->

                <!-- logo -->
                <a href="index-2.html" class="navbar-brand">
                    <img src="img/logo.png" alt="">
                    <span class="heading-font">
                        TDO Solution
                    </span>
                </a>
                <!-- /logo -->
            </div>

            <ul class="nav navbar-nav">
                <li class="hidden-xs">
                    <!-- toggle small menu -->
                    <a href="javascript:;" class="toggle-sidebar">
                        <i class="ti-menu"></i>
                    </a>
                    <!-- /toggle small menu -->
                </li>
                <li class="header-search">
                    <!-- toggle search -->
                    <a href="javascript:;" class="toggle-search">
                        <i class="ti-search"></i>
                    </a>
                    <!-- /toggle search -->
                    <div class="search-container">
                        <form role="search">
                            <input type="text" class="form-control search" placeholder="type and press enter">
                        </form>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown hidden-xs">
                    <a href="javascript:;" data-toggle="dropdown">
                        <i class="ti-more-alt"></i>
                    </a>
                    <ul class="dropdown-menu animated zoomIn">
                        <li class="dropdown-header">Quick Links</li>
                        <li>
                            <a href="javascript:;">Start New Campaign</a>
                        </li>
                        <li>
                            <a href="javascript:;">Review Campaigns</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:;">Settings</a>
                        </li>
                        <li>
                            <a href="javascript:;">Wish List</a>
                        </li>
                        <li>
                            <a href="javascript:;">Purchases History</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:;">Activity Log</a>
                        </li>
                        <li>
                            <a href="javascript:;">Settings</a>
                        </li>
                        <li>
                            <a href="javascript:;">System Reports</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:;">Help</a>
                        </li>
                        <li>
                            <a href="javascript:;">Report a Problem</a>
                        </li>
                    </ul>
                </li>

                <li class="notifications dropdown">
                    <a href="javascript:;" data-toggle="dropdown">
                        <i class="ti-bell"></i>
                        <div class="badge badge-top bg-danger animated flash">
                            <span>3</span>
                        </div>
                    </a>
                    <div class="dropdown-menu animated fadeInLeft">
                        <div class="panel panel-default no-m">
                            <div class="panel-heading small"><b>Notifications</b>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="javascript:;">
                                        <span class="pull-left mt5 mr15">
                                            <img src="img/face4.jpg" class="avatar avatar-sm img-circle" alt="">
                                        </span>
                                        <div class="m-body">
                                            <div class="">
                                                <small><b>CRYSTAL BROWN</b></small>
                                                <span class="label label-danger pull-right">ASSIGN AGENT</span>
                                            </div>
                                            <span>Opened a support query</span>
                                            <span class="time small">2 mins ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="javascript:;">
                                        <div class="pull-left mt5 mr15">
                                            <div class="circle-icon bg-danger">
                                                <i class="ti-download"></i>
                                            </div>
                                        </div>
                                        <div class="m-body">
                                            <span>Upload Progress</span>
                                            <div class="progress progress-xs mt5 mb5">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                </div>
                                            </div>
                                            <span class="time small">Submited 23 mins ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="javascript:;">
                                        <span class="pull-left mt5 mr15">
                                            <img src="img/face3.jpg" class="avatar avatar-sm img-circle" alt="">
                                        </span>
                                        <div class="m-body">
                                            <em>Status Update:</em>
                                            <span>All servers now online</span>
                                            <span class="time small">5 days ago</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>

                            <div class="panel-footer">
                                <a href="javascript:;">See all notifications</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="off-right">
                    <a href="javascript:;" data-toggle="dropdown">
                        <img src="img/avatar.jpg" class="header-avatar img-circle" alt="user" title="user">
                        <span class="hidden-xs ml10"><?php echo htmlentities(ucwords($_SESSION['username'])); ?></span>
                        <i class="ti-angle-down ti-caret hidden-xs"></i>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight">
                        <!-- <li>
                            <a href="javascript:;">
                                <div class="badge bg-danger pull-right">3</div>
                                <span>Notifications</span>
                            </a>
                        </li> -->
                        <li>
                            <a href="signup.php">Register</a>
                        </li>
                        <li>
                            <a href="includes/logout.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>
        <!-- /top header -->

        <section class="layout">
            <!-- sidebar menu -->
            <aside class="sidebar offscreen-left">
                <!-- main navigation -->
                <nav class="main-navigation" data-height="auto" data-size="6px" data-distance="0" data-rail-visible="true" data-wheel-step="10">
                    <p class="nav-title">MENU</p>
                    <ul class="nav">
                        <!-- dashboard -->
						
                        <li>
                            <a href="javascript:;" onclick="javascript: ld_fm2('dashboard.php');">
                                <i class="ti-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <!-- /dashboard -->

                        <!-- ui -->
                        <li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="ti-layout-media-overlay-alt-2"></i>
                                <span>Administration</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="javascript:;" onclick="javascript: ld_fm2('form.php');" >
                                        <span>Settings</span>
                                    </a>
                                </li>
								<li>
                                    <a href="javascript:;" onclick="javascript: ld_fm2('Setup.php');" >
                                        <span>Setup</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
						<li>
                            <a href="javascript:;">
                                <i class="toggle-accordion"></i>
                                <i class="ti-layout-media-overlay-alt-2"></i>
                                <span>Transactions</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="javascript:;" onclick="javascript: ld_fm2('tdoregister.php');" >
                                        <span>TDO Register</span>
                                    </a>
                                </li>
								<li>
                                    <a href="javascript:;" onclick="javascript: ld_fm2('tdodespatch.php');" >
                                        <span>TDO Despatch</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>                
                                           </ul>
                </nav>
            </aside>
            <!-- /sidebar menu -->

            <!-- main content -->
            <section class="main-content" style="margin-top:6px;">

                
                <!-- /content wrapper -->
                <a class="exit-offscreen"></a>
            </section>
            <!-- /main content -->
        </section>

    </div>

    <!-- core scripts -->
    <script src="plugins/jquery-1.11.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="plugins/jquery.slimscroll.min.js"></script>
    <script src="plugins/jquery.easing.min.js"></script>
    <script src="plugins/appear/jquery.appear.js"></script>
    <script src="plugins/jquery.placeholder.js"></script>
	<script src="js/jquery.ui/jquery-ui.js"></script>
	<script src="js/notify.js"></script>
	<script src="js/jquery.gritter/js/jquery.gritter.js"></script>
    <!-- /core scripts -->

    <!-- page level scripts -->
	<script src="plugins/chosen/chosen.jquery.min.js"></script>
	<script src="plugins/datatables/jquery.dataTables.js"></script>
    <!-- /page level scripts -->

    <!-- template scripts -->
	 <script src="plugins/parsley.min.js"></script>
    <script src="js/offscreen.js"></script>
    <script src="js/main.js"></script>
	
    <!-- /template scripts -->

    <!-- page script -->
	<script src="js/bootstrap-datatables.js"></script>
    <script src="js/datatables.js"></script>
					<script>
							//var db = $('.datatable').dateTable();
							loading = '<div align="center"><img src="img/loading.gif" width="20" height="20" /></div>';
							var IMG_LOAD = '<div><img src="img/loading.gif"/></div>';
							
							function ld_fm2 (url) {
								location.hash=url.match(/(^.*)\./)[1]
								return false
							}
							var originalTitle=document.title;
							function hashChange(){
								var page=location.hash.slice(1);
								if (page!=""){
								$('.main-content').html(loading);
								//console.log(page+".php");
								$('.main-content').load(page+".php", function(response, status, xhr) {
									if (status == "error") {
										var msg = "Sorry but there was an error: ";
										$('.main-content').html(msg + xhr.status + " " + xhr.statusText);
										
									}
									//alertMsg('Successfully processed!','success');
								document.title=originalTitle+' – '+page;
								})
							}
							}
							// part 3
							if ("onhashchange" in window){ // cool browser
								$(window).on('hashchange',hashChange).trigger('hashchange');
							}else{ // lame browser
							var lastHash='';
							setInterval(function(){
							if (lastHash!=location.hash)
								hashChange();
								lastHash=location.hash;
								},100)
							}
							
							function ld_fm(url, container){
								
								var link = url;
								var cnt = container;
								$("."+cnt).html(loading);
								$("."+cnt).load(url, function(response, status, xhr) {
									if (status == "error") {
										var msg = "Sorry but there was an error: ";
										$("."+cnt).html(msg + xhr.status + " " + xhr.statusText);
										
									}
									alertMsg('Successfully processed!','success');
								}
								);
								return false;
							}
							/*info, success, warning, danger, dark, primary, tumblr, github, youtube, pinterest, linkedin, dribble, twitter*/
							function alertMsgGritter(title,txt,cls){
								$.gritter.add({
									title: title,
									text: txt,
									class_name: cls
								  });
								  return false;
							}
							function alertMsg (txt, cls){
								$.notify(txt, cls);
							}
							
							
						</script>
    <!-- /page script -->

<script>(function(m,l,g,i,k,n,a){m.GoogleAnalyticsObject=k;m[k]=m[k]||function(){(m[k].q=m[k].q||[]).push(arguments)},m[k].l=1*new Date();n=l.createElement(g),a=l.getElementsByTagName(g)[0];n.async=1;n.src=i;a.parentNode.insertBefore(n,a)})(window,document,"script","http://www.google-analytics.com/analytics.js","ga");ga("create","UA-50530436-1","nyasha.html");ga("send","pageview");
    </script>

</body>
<!-- /body -->

</html>
