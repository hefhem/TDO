<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    header('Location: index.php');
} 
?>

<!doctype html>
<html class="signin no-js" lang="">
<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="description" content="Flat, Clean, Responsive, application admin template built with bootstrap 3">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <!-- /meta -->

    <title>TDO Solution</title>
	<script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script> 
    <!-- page level plugin styles -->
    <!-- /page level plugin styles -->

    <!-- core styles -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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

<body class="bg-primary">

    <div class="cover" style="background-image: url(img/cover3.jpg)"></div>

    <div class="overlay bg-primary"></div>

    <div class="center-wrapper">
        <div class="center-content">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <section class="panel bg-white no-b">
                        <ul class="" style="list-style:none;">
                            <li class="active">
								<span class="title-tile">
									<h2> <img src="img/logo.png" alt="">TDO Solution</h2>
								</span>						
							</li>
                        </ul>
						
                        <div class="p15">  
                            <form role="form" action="includes/process_login.php" method="post" name="login_form">
							<?php
							if (isset($_GET['error'])) {
								echo '<p class="error">Error Logging In!</p>';
							}
							?> 
                                <input type="text" name="email" class="form-control input-lg mb25" placeholder="E-Mail or Username" autofocus >
                                <input type="password" id="password" class="form-control input-lg mb25" placeholder="Password">
                                <div class="show">
                                    <!--<div class="pull-right">
                                        <a href="forgot.html">Forgot password?</a>
                                    </div>-->
                                </div>
                                
                                <button class="btn btn-primary btn-lg btn-block" type="submit" onclick="formhash(this.form, this.form.password);" >Sign in</button>
                            </form>
                        </div>
                    </section>
                    <p class="text-center">
                        Copyright &copy;
                        <span id="year" class="mr5"></span>
                        <!--<span>Sublime LLC</span>-->
                    </p>
                </div>
            </div>
        
        </div>
    </div>
    <script type="text/javascript">
        var el = document.getElementById("year"),
            year = (new Date().getFullYear());
        el.innerHTML = year;
        (function(m,l,g,i,k,n,a){m.GoogleAnalyticsObject=k;m[k]=m[k]||function(){(m[k].q=m[k].q||[]).push(arguments)},m[k].l=1*new Date();n=l.createElement(g),a=l.getElementsByTagName(g)[0];n.async=1;n.src=i;a.parentNode.insertBefore(n,a)})(window,document,"script","../../www.google-analytics.com/analytics.js","ga");ga("create","UA-50530436-1","nyasha.html");ga("send","pageview");
    </script>
</body>

</html>
