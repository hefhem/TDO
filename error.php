
<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';

sec_session_start();
 
if (login_check($mysqli) == false) {
    header('Location: signin.php');
} 
?>
<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
 
if (! $error) {
    $error = 'Oops! An unknown error happened.';
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

    <title>Secure Login: Error</title>

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
                        
                        <div class="p15">  
                           <h1>There was a problem</h1>
							<p class="error"><?php echo $error; ?></p>  
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
