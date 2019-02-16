<?php include ('server.php') ?>
<?php if(!isset($_COOKIE['login']) || !isset($_COOKIE['type'])) {
        header('location: index.php');
}?>

<?php if(isset($_COOKIE['login']) && isset($_COOKIE['type'])) {
		$db = mysqli_connect('localhost', 'root', '', 'eie3117');
        $username = $_COOKIE['login'];
        $query = "SELECT * FROM request WHERE Acceptance = 0 AND Completance = 0"; 
		$avalible = mysqli_query($db, $query);
		if (!$avalible) {
			echo "Error: %s\n". mysqli_error($db);
			exit();
		}
		$query = "SELECT * FROM request WHERE DriverName = '$username' AND Completance = 0"; 
		$current = mysqli_query($db, $query);
		if (!$current) {
			echo "Error: %s\n". mysqli_error($db);
			exit();
		}
		$query = "SELECT * FROM request WHERE DriverName = '$username' AND Completance = 1"; 
		$history = mysqli_query($db, $query);
		if (!$history) {
			echo "Error: %s\n". mysqli_error($db);
			exit();
		}
	  }
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">
<style>
table, th, td {
  border: 3px solid black;
}
</style>
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
                        <a href="index.php" class="logo">
                            <img src="assets/img/logo.png" alt="JSOFT">
                        </a>
                    </div>
                    <!--== Logo End ==-->
                    
                    <!--== Main Menu Start ==-->
                    <div class="col-lg-8 d-none d-xl-block">
                        <nav class="mainmenu alignright">
                            <ul>

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
                
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->
    <section id="about-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Avalible Request</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        
                    </div>
                </div>
                <!-- Section Title End -->
                
                    <div class="container">
                        
                            <!-- Single Articles Start -->
                            <div class="col-lg-12">
                                <article class="single-article">
									<form method = "post" action="index.php" enctype="multipart/form-data">
									<div id="table">	
                                        <table>
										<tr>
										   <th> Request Time </th>
										   <th> Start Location </th>
										   <th> Destination </th>
										   <th> Suggested Fee </th>
										   <th> Requester </th>
										   <th> Accept </th>
									    </tr>
										<?php 
											while($row = mysqli_fetch_array($avalible))
											{
												echo "<tr>";
												echo "<td>".$row['Request_time']."&nbsp;</td>";
												echo "<td>".$row['Start_location']."&nbsp;</td>";
												echo "<td>".$row['Destination']."&nbsp;</td>";
												echo "<td>".$row['Suggested_Fee']."&nbsp;</td>";
												echo "<td>".$row['PassagerName']."&nbsp;</td>";
												$rid = $row['Request_ID'];
												echo "<td><button type = \"submit\" name = \"accept_request\" value = '$rid'> Accept </button></td>";
											    echo "</tr>";
											}
										?>
										</table>
                                    </div>
									</form>
                                </article>
                            </div>
                    </div>
        </div>
    </section>

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
									<form method = "post" action="index.php" enctype="multipart/form-data">
									<div id="table">	
                                        <table>
										<tr>
										   <th> Request Time </th>
										   <th> Start Location </th>
										   <th> Destination </th>
										   <th> Suggested Fee </th>
										   <th> Passager Name </th>
										   <th> Complete </th>
									    </tr>
										<?php 
											while($row = mysqli_fetch_array($current))
											{
												echo "<tr>";
												echo "<td>".$row['Request_time']."&nbsp;</td>";
												echo "<td>".$row['Start_location']."&nbsp;</td>";
												echo "<td>".$row['Destination']."&nbsp;</td>";
												echo "<td>".$row['Suggested_Fee']."&nbsp;</td>";
												echo "<td>".$row['PassagerName']."&nbsp;</td>";
                                                $rid = $row['Request_ID'];
                                                echo "<td><button onclick=\"document.getElementById('id01').style.display='block'\"> Complete </button></td>";
                                                    echo "<div id=\"id01\" class=\"modal\">";
                                                    echo "<form method = \"post\" class=\"modal-content  animate\" action=\"index.php\">";
                                                        include('errors.php');
                                                        echo "<div class=\"container\" >";
                                                            echo "<label for=\"final_fee\"><b  class=\"form-text\">Final Fee</b></label>";
                                                            echo "<input type=\"text\" placeholder=\"Enter Final Fee\" name=\"fee\" required>";
                                                            echo "<label for=\"tips\"><b  class=\"form-text\">Tips</b></label>";
                                                            echo "<input type=\"text\" placeholder=\"Enter Tips\" name=\"tips\" required>";
                                                            echo "<button class=\"submit-btn\" type=\"submit\" name = \"complete_request\" value = '$rid' style=\"border-radius: 4px;\">Complete</button>";
                                                            echo "</div>";
                                                        echo "<div class=\"container\" style=\"background-color:#393D44\">";
                                                            echo "<button type=\"button\" onclick=\"document.getElementById('id01').style.display='none'\" class=\"cancelbtn\">Cancel</button>";
                                                        echo "</div>";
                                                    echo "</form>";
                                                echo "</div>";
                                                echo "</tr>";
											}
										?>
										</table>
                                    </div>
									</form>
                                </article>
                            </div>
                    </div>
        </div>
    </section>

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
                        <div class="col-lg-12">
                                <article class="single-article">
                                                   <div id="table">	
													   <table>
														<tr>
														   <th> Request Time </th>
														   <th> Start Location </th>
														   <th> Destination </th>
														   <th> Suggested Fee </th>
														   <th> Passager Name </th>
														   <th> Pickup Time </th>
														   <th> Complete Time </th>
														   <th> Final Fee </th>
														   <th> Tips </th>
														</tr>
														<?php 
															while($row = mysqli_fetch_array($history))
															{
																echo "<tr>";
																echo "<td>".$row['Request_time']."&nbsp;</td>";
																echo "<td>".$row['Start_location']."&nbsp;</td>";
																echo "<td>".$row['Destination']."&nbsp;</td>";
																echo "<td>".$row['Suggested_Fee']."&nbsp;</td>";
																echo "<td>".$row['PassagerName']."&nbsp;</td>";
																echo "<td>".$row['Pickup_time']."&nbsp;</td>";
																echo "<td>".$row['Complete_time']."&nbsp;</td>";
																echo "<td>".$row['Final_Fee']."&nbsp;</td>";
																echo "<td>".$row['Tips']."&nbsp;</td>";
																echo "</tr>";
															}
														?>
														</table>
                                                </div>
                                            </div>
                    
        
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