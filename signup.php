
<?php
include_once 'includes/register.inc.php';
include_once 'includes/db_connect_functions.php';

sec_session_start();
 
if (login_check($mysqli) == false) {
    header('Location: signin.php');
} 
?>

<!doctype html>
<html class="signup no-js" lang="">


<!-- Mirrored from sublime.nyasha.me/admin/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 26 Aug 2014 15:26:35 GMT -->
<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="description" content="Flat, Clean, Responsive, application admin template built with bootstrap 3">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <!-- /meta -->

    <title>Sign Up</title>
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

<body class="bg-info"> 
    <div class="center-wrapper">
        <div class="center-content">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <section class="panel bg-white no-b">
                        <ul class="switcher-dash-action">
                            
                            <li class="active"><a href="#" class="">New account</a></li>
                        </ul>
						<?php
						if (!empty($error_msg)) {
							echo $error_msg;
						}
						?>
                        <div class="p15">  
                            <form role="form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" 
                name="registration_form">
                                <input type="text" class="form-control input-lg mb25" placeholder="Choose a username" autofocus name="username" id="username">
                                <input type="text" class="form-control input-lg mb25" placeholder="Email address" name="email" id="email">
                                <input type="password" class="form-control input-lg mb25" placeholder="Password" name="password" id="password">
                                <input type="password" class="form-control input-lg mb25" placeholder="Confirm password" name="confirmpwd" id="confirmpwd">                               
                                
                                <button class="btn btn-primary btn-lg btn-block" type="submit" onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);">Register</button>
                            </form>
                        </div>
                    </section>
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
