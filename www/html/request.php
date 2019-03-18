<?php include ('server.php') ?>
<?php if(!isset($_COOKIE['login']) || !isset($_COOKIE['type'])) {
    header('location: index.php');
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
    <!--=== Map CSS ===-->
    <link href="assets/css/map_api.css" rel="stylesheet">



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

                            <li><a href="changepw.php">Change Password</a></li>

<li><a href="logout.php">LOG OUT</a></li>

                            
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
          <!--   Page Title Start-->
            <div class="col-lg-12">
                <div class="section-title  text-center">

                    <span class="title-line"><i class="fa fa-car"></i></span>

                </div>
            </div>
             <!--Page Title End-->
        </div>
    </div>
</section>
<!--== Page Title Area End ==-->


<div style="display: none">
    <input id="origin-input" class="controls" type="text"
           placeholder="Enter an origin location">

    <input id="destination-input" class="controls" type="text"
           placeholder="Enter a destination location">

    <div id="toll_selector" class="controls">

        <label class="switch"  >
            <input type="checkbox" id="toll-selector" checked>
            <span class="slider round"></span>
            <p id="toll_selector_p">Avoid Toll</p>
        </label>
    </div>

    <div id="quotation_box" class="box_controls">

        <span onclick="document.getElementById('quotation_box').style.display='none'" class="close">&times;</span>
        <div id="request_container">
        <form method = "post" action="request.php">
            <h5>Starting location:</h5>
            <p id = "Origin"></p>

            <!--<a id ="Origin_Lat" herf="test.html"></a>-->
            <!--<a id ="Origin_Lng" herf="test.html"></a>-->
            <br>
            <h5> Destination:</h5>
            <p id ="Destination"></p>

            <!--<a id ="Destination_Lat" herf="test.html"></a>-->
            <!--<a id ="Destination_Lng" herf="test.html"></a>-->
            <br>
                <h5> Duration:</h5>
            <p id ="Duration"></p>
            <br>
            <h5> Fare:</h5>
            <p id ="Fare"></p>
            <br>
                        <h5> <label for="meeting-time">Pickup time:</label></h5>
            
            <input type="datetime-local" id="meeting-time"
                 name="meeting-time" value="2019-02-18T19:30"
                 min="2019-02-18T00:00" max="2019-12-31T00:00">

            <button id="submit_btn" name="request">Request Now</button>
        </form>
        </div>



    </div>
</div>





<div id="map"></div>




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
<script src="assets/js/map_api.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2ogL6ztfXZ4uEFB15ykUl04J6CG3fd94&libraries=places&callback=getLocation"
        async ></script>

<!--=== Mian Js ===-->
<script src="assets/js/main.js"></script>

</body>

</html>
