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

    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
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
        <!--== Header Top Start ==-->

            
        </div>
        <!--== Header Top End ==-->

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
									<?php include('errors.php'); ?>

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
                                                 <a class="form-link" href="register.php" >Sign Up?</a>
												 <a class="form-link" href="" >Forgot password?</a>
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
	<?php include('errors.php'); ?>
    <!--== Header Area End ==-->

    <!--== Slider Area Start ==-->
    <section id="slider-area">
        <!--== slide Item One ==-->
        <div class="single-slide-item overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="book-a-car">
                            <form action="index.php">
                                <!--== Pick Up Location ==-->
                                <div class="pickup-location book-item">
                                    <h4>PICK-UP LOCATION:</h4>
                                    <select class="custom-select">
                                      <option selected>Select</option>
                                      <option value="1">Dhaka</option>
                                      <option value="2">Comilla</option>
                                      <option value="3">Barishal</option>
                                      <option value="3">Rangpur</option>
                                    </select>
                                </div>
                                <!--== Pick Up Location ==-->

                                <!--== Pick Up Date ==-->
                                <div class="pick-up-date book-item">
                                    <h4>PICK-UP DATE:</h4>
                                    <input id="startDate" placeholder="Pick Up Date" />

                                    <div class="return-car">
                                        <h4>Return DATE:</h4>
                                        <input id="endDate" placeholder="Return Date" />
                                    </div>
                                </div>
                                <!--== Pick Up Location ==-->

                                <!--== Car Choose ==-->
                                <div class="choose-car-type book-item">
                                    <h4>CHOOSE CAR TYPE:</h4>
                                    <select class="custom-select">
                                      <option selected>Select</option>
                                      <option value="1">BMW</option>
                                      <option value="2">Audi</option>
                                      <option value="3">Lexus</option>
                                    </select>
                                </div>
                                <!--== Car Choose ==-->

                                <div class="book-button text-center">
                                    <button class="book-now-btn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Book Now</button>
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
                                                <a class="form-link" href="" >Forgot password?</a>
										 </span>
                                        </div>
                                    </form>
									</div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-7 text-right">
                        <div class="display-table">
                            <div class="display-table-cell">
                                <div class="slider-right-text">
                                    <h1>BOOK A CAR TODAY!</h1>
                                    <p>FOR AS LOW AS $10 A DAY PLUS 15% DISCOUNT <br> FOR OUR RETURNING CUSTOMERS</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== slide Item One ==-->
    </section>
    <!--== Slider Area End ==-->

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