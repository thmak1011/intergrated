

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
        
        <!--== Header Bottom Start ==-->
        <div id="header-bottom">
            <div class="container">
                <div class="row">
                    <!--== Logo Start ==-->
                    <div class="col-lg-4">
                        <a href="index.html" class="logo">
                            <img src="assets/img/logo.png" alt="JSOFT">
                        </a>
                    </div>
                    <!--== Logo End ==-->

                    
                    <!--== Main Menu Start ==-->
                    <div class="col-lg-8 d-none d-xl-block">
                        <nav class="mainmenu alignright">
                            <ul>
                                <li class="active"><a href="index.php">Home</a></li>


                                <li><a href="index.php">Pages</a>

                                </li>

                                <li><a href="contact.html">Contact Us</a></li>
                                <li><button class="form-btn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">LOG IN</button></li>
                                <div id="id01" class="modal">

                                    <form class="modal-content  animate" action="index.php">
									<?php include('errors.php'); ?>
                                        <div class="imgcontainer">
                                            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                                            <img src="" alt="Avatar" class="avatar">
                                        </div>

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
                
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <!--== About Us Area Start ==-->
    <section id="about-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Current Request</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        
                    </div>
                </div>
                <!-- Section Title End -->
                
                    <div class="container">
                        
                            <!-- Single Articles Start -->
                            <div class="col-lg-12">
                                <article class="single-article">
                                    <div class="row">
                                        <!-- Articles Thumbnail Start -->
                                        <div class="col-lg-5">
                                            <div class="article-thumb">
                                                
                                            </div>
                                        </div>
                                        <!-- Articles Thumbnail End -->
            
                                        <!-- Articles Content Start -->
                                        <div class="col-lg-7">
                                            <div class="display-table">
                                                <div class="display-table-cell">
                                                    <div class="article-body">
                                                        <h3><a href="article-details.html">Wliquam sit amet urna eullam</a></h3>
                                                        <div class="article-meta">
                                                            <a href="#" class="author">By :: <span>Admin</span></a>
                                                            <a href="#" class="commnet">Comments :: <span>10</span></a>
                                                        </div>
            
                                                        <div class="article-date">25 <span class="month">jan</span></div>
            
                                                        <p>Wlam aiber vestibulum fringilla oremedad ipsum dolor sit amet consectetur adipisicing elit sed doned eiusmod tempored incididunt ut labore et dolore magna aliquaa enimd ad minim veniad.</p>
            
                                                        <a href="article-details.html" class="readmore-btn">Read More <i class="fa fa-long-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Articles Content End -->
                                    </div>
                                </article>
                            </div>
                            <!-- Single Articles End -->
                        

                       
                    </div>
                
                <!--== Car List Area End ==-->            
        </div>
    </section>
    <!--== About Us Area End ==-->

    

    <!--== Services Area Start ==-->
    <section id="service-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Request history</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

           
			<!--== Car List Area Start ==-->
            
                <div class="container">
                    <div class="row">
                        <!-- Single Articles Start -->
                        <div class="col-lg-12">
                            <article class="single-article">
                                <div class="row">
                                    <!-- Articles Thumbnail Start -->
                                    <div class="col-lg-5">
                                        <div class="article-thumb">
                                            
                                        </div>
                                    </div>
                                    <!-- Articles Thumbnail End -->
        
                                    <!-- Articles Content Start -->
                                    <div class="col-lg-7">
                                        <div class="display-table">
                                            <div class="display-table-cell">
                                                <div class="article-body">
                                                    <h3><a href="article-details.html">Wliquam sit amet urna eullam</a></h3>
                                                    <div class="article-meta">
                                                        <a href="#" class="author">By :: <span>Admin</span></a>
                                                        <a href="#" class="commnet">Comments :: <span>10</span></a>
                                                    </div>
        
                                                    <div class="article-date">25 <span class="month">jan</span></div>
        
                                                    <p>Wlam aiber vestibulum fringilla oremedad ipsum dolor sit amet consectetur adipisicing elit sed doned eiusmod tempored incididunt ut labore et dolore magna aliquaa enimd ad minim veniad.</p>
        
                                                    <a href="article-details.html" class="readmore-btn">Read More <i class="fa fa-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Articles Content End -->
                                </div>
                            </article>
                        </div>
                        <!-- Single Articles End -->
        
                        <!-- Single Articles Start -->
                        <div class="col-lg-12">
                            <article class="single-article">
                                <div class="row">
                                    <!-- Articles Thumbnail Start -->
                                    <div class="col-lg-5">
                                        <div class="article-thumb">
                                            
                                        </div>
                                    </div>
                                    <!-- Articles Thumbnail End -->
        
                                    <!-- Articles Content Start -->
                                    <div class="col-lg-7">
                                        <div class="display-table">
                                            <div class="display-table-cell">
                                                <div class="article-body">
                                                    <h3><a href="article-details.html">Wliquam sit amet urna eullam</a></h3>
                                                    <div class="article-meta">
                                                        <a href="#" class="author">By :: <span>Admin</span></a>
                                                        <a href="#" class="commnet">Comments :: <span>10</span></a>
                                                    </div>
        
                                                    <div class="article-date">25 <span class="month">jan</span></div>
        
                                                    <p>Wlam aiber vestibulum fringilla oremedad ipsum dolor sit amet consectetur adipisicing elit sed doned eiusmod tempored incididunt ut labore et dolore magna aliquaa enimd ad minim veniad.</p>
        
                                                    <a href="article-details.html" class="readmore-btn">Read More <i class="fa fa-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Articles Content End -->
                                </div>
                            </article>
                        </div>
                        <!-- Single Articles End -->
        
                        
                    </div>
        
                    <div class="row">
                        <!-- Page Pagination Start -->
                        <div class="col-lg-12">
                            <div class="page-pagi">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- Page Pagination End -->
                    </div>
                </div>
            
            <!--== Car List Area End ==-->
        
            
                    
        
            <!--== Scroll Top Area Start ==-->
            <div class="scroll-top">
                <img src="assets/img/scroll-top.png" alt="JSOFT">
            </div>
            <!--== Scroll Top Area End ==-->
			<!-- Service Content End -->
        </div>
    </section>
    <!--== Services Area End ==-->

    
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