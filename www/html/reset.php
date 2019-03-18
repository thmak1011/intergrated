<?php include ('server.php') ?>
<?php if(isset($_COOKIE['login']) && isset($_COOKIE['type'])) {
		header('location: '.$_COOKIE['type'].'homepage.php');
}?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title>PolyUber</title>

    <!--=== Bootstrap CSS ===-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--=== Slicknav CSS ===-->
    <link href="assets/css/plugins/slicknav.min.css" rel="stylesheet">
    <!--=== Magnific Popup CSS ===-->
    <link href="assets/css/plugins/magnific-popup.css" rel="stylesheet">
    <!--=== Owl Carousel CSS ===-->
    <link href="assets/css/plugins/owl.carousel.min.css" rel="stylesheet">
    <!--=== Gijgo CSS ===-->
    <link href="assets/css/plugins/gijgo.css" rel="stylesheet">
    <!--=== FontAwesome CSS ===-->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!--=== Theme Reset CSS ===-->
    <link href="assets/css/reset.css" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="style.css" rel="stylesheet">
    <!--=== Responsive CSS ===-->
    <link href="assets/css/responsive.css" rel="stylesheet">


    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="loader-active">

    <!--== Preloader Area Start ==-->
    <div class="preloader">
        <div class="preloader-spinner">
            <div class="loader-content">
                <img src="assets/img/preloader.gif" alt="JSOFT">
            </div>
        </div>
    </div>
    <!--== Preloader Area End ==-->

    <!--== Header Area Start ==-->
    <header id="header-area" class="fixed-top">
        
        

        <!--== Header Bottom Start ==-->
        <div id="header-bottom">
            <div class="container">
                <div class="row">
                    <!--== Logo Start ==-->
                    <div class="col-lg-4">
                        <a href="index.php" class="logo">
                            <img src="assets/img/logo.png" alt="JSOFT">
                        </a>
                    </div>


                    <!--== Logo End ==-->

                    <!--== Main Menu Start ==-->
                    <div class="col-lg-8 d-none d-xl-block">
                        <nav class="mainmenu alignright">
                            <ul>
                                <li class="active"><a href="index.php">Home</a></li>

                                <li><button class="form-btn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">LOG IN</button></li>
                                <div id="id01" class="modal">

                                   <form method = "post" class="modal-content  animate" action="index.php">

                                        <div class="container">
                                            <label for="uname"><b  class="form-text">Username</b></label>
                                            <input type="text" placeholder="Enter Username" name="uname" required>

                                            <label for="psw"><b  class="form-text">Password</b></label>
                                            <input type="password" placeholder="Enter Password" name="psw" required>

                                            <button class="submit-btn" type="submit" name = "login_user" style="border-radius: 4px;">Log in</button>
                                            <label>
                                                <input type="checkbox" checked="checked" name="remember"> Remember me
                                            </label>
                                        </div>

                                        <div class="container" style="background-color:#393D44">
                                            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>


                                            <span class="psw">
                                                 <a  class="form-link" href="register.php" >Sign Up?</a>
                                                <a class="form-link" href="forget.php" >Forgot password?</a>
										 </span>
                                        </div>
                                    </form>
                                </div>
                            </ul>
                        </nav>

                    </div>
                    <!--== Main Menu End ==-->
                </div>
            </div>
        </div>
        <!--== Header Bottom End ==-->
    </header>
    <!--== Header Area End ==-->

    <!--== Page Title Area Start ==-->
    <section id="page-title-area" class="section-padding overlay">
        <div class="container">
            <div class="row">
                <!-- Page Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Reset password</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        
                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <!--== Login Page Content Start ==-->
    <section id="lgoin-page-wrap" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-8 m-auto">
                	<div class="login-page-content">
                		<div class="login-form">
                			<?php include('errors.php'); ?>
							<form method = "post" action="reset.php">
								<h3>For security reason, you must reset your password immediately.</h3> <br>
								We have sent you an email of authorization. Please enter the given code and your new password to continue.
								<div class="auth_code">
									<input type="text" name = "aucode" placeholder="Authorization Code">
                                </div>
								<div class="password">
									<input type="password" name = "psw" placeholder="New Password">
                                </div>
                                <div class="password">
									<input type="password" name = "psw2" placeholder="Confirm New Password">
                                </div>
                               
								<div class="log-btn">
									<button type="submit" name = "reset">Reset</button>
								</div>
							</form>
                		</div>                		
                	</div>
                </div>
        	</div>
        </div>
    </section>
    <!--== Login Page Content End ==-->

    

    <!--== Scroll Top Area Start ==-->
    <div class="scroll-top">
        <img src="assets/img/scroll-top.png" alt="JSOFT">
    </div>
    <!--== Scroll Top Area End ==-->

    <!--=======================Javascript============================-->
    <!--=== Jquery Min Js ===-->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <!--=== Jquery Migrate Min Js ===-->
    <script src="assets/js/jquery-migrate.min.js"></script>
    <!--=== Popper Min Js ===-->
    <script src="assets/js/popper.min.js"></script>
    <!--=== Bootstrap Min Js ===-->
    <script src="assets/js/bootstrap.min.js"></script>
    <!--=== Gijgo Min Js ===-->
    <script src="assets/js/plugins/gijgo.js"></script>
    <!--=== Vegas Min Js ===-->
    <script src="assets/js/plugins/vegas.min.js"></script>
    <!--=== Isotope Min Js ===-->
    <script src="assets/js/plugins/isotope.min.js"></script>
    <!--=== Owl Caousel Min Js ===-->
    <script src="assets/js/plugins/owl.carousel.min.js"></script>
    <!--=== Waypoint Min Js ===-->
    <script src="assets/js/plugins/waypoints.min.js"></script>
    <!--=== CounTotop Min Js ===-->
    <script src="assets/js/plugins/counterup.min.js"></script>
    <!--=== YtPlayer Min Js ===-->
    <script src="assets/js/plugins/mb.YTPlayer.js"></script>
    <!--=== Magnific Popup Min Js ===-->
    <script src="assets/js/plugins/magnific-popup.min.js"></script>
    <!--=== Slicknav Min Js ===-->
    <script src="assets/js/plugins/slicknav.min.js"></script>

    <!--=== Mian Js ===-->
    <script src="assets/js/main.js"></script>

</body>

</html>