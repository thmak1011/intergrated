<?php include ('server.php') ?>
<?php if(!isset($_COOKIE['login']) || !isset($_COOKIE['type'])) {
        header('location: index.php');
}?>

<?php if(isset($_COOKIE['login']) && isset($_COOKIE['type'])) {
		$db = mysqli_connect('localhost', 'root', '', 'eie3117');
        $username = $_COOKIE['login'];
        $query = "SELECT * FROM user WHERE Username = '$username'"; 
        $fname = mysqli_query($db, $query);
        if (!$fname) {
			echo "Error: %s\n". mysqli_error($db);
			exit();
        }
        $fullname = $fname->fetch_object()->Fullname;
		$query = "SELECT * FROM request WHERE PassagerName = '$username' AND Completance = 0"; 
		$current = mysqli_query($db, $query);
		if (!$current) {
			echo "Error: %s\n". mysqli_error($db);
			exit();
		}
		$query = "SELECT * FROM request WHERE PassagerName = '$username'  AND Completance = 1"; 
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
                                <li class="active"><a href="request.php">Start a Request</a></li>

                                <li><a href="passageracc.php">Account Setting</a></li>

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
                <!-- Page Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Welcome, <?php echo $fullname?>!</h2>
                    </div>
                </div>
                <!-- Page Title End -->
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
									<form method = "post" enctype="multipart/form-data">
									<div id="table">	
                                        <table>
										<tr>
										   <th> Request Time </th>
										   <th> Start Location </th>
										   <th> Destination </th>
										   <th> Estimated Fare </th>
										   <th> Accepter </th>
                                           <th> Phone </th>
										   <th> Pickup Time </th>
										   <th> Acceptance </th>
										   <th> Cancel </th>
									    </tr>
										<?php 
											while($row = mysqli_fetch_array($current))
											{
												echo "<tr>";
												echo "<td>".$row['Request_time']."&nbsp;</td>";
												echo "<td>".$row['Start_location']."&nbsp;</td>";
												echo "<td>".$row['Destination']."&nbsp;</td>";
												echo "<td>".$row['Suggested_Fee']."&nbsp;</td>";
                                                echo "<td>".$row['DriverName']."&nbsp;</td>";
                                                $username = $row['DriverName'];
                                                if (!empty($username)){
                                                    $query = "SELECT * FROM user WHERE Username = '$username'"; 
		                                            $results = mysqli_query($db, $query);
	                                            if (!$results) {
	                                            	echo "Error: %s\n". mysqli_error($db);
		                                        	exit();
                                                    };
                                                    $results = mysqli_query($db, $query);
                                                    $phone = $results->fetch_object()->Phone_No;
                                                }else{$phone = "";};
                                                echo "<td>".$phone."&nbsp;</td>";
												echo "<td>".$row['Pickup_time']."&nbsp;</td>";
												echo "<td>".$row['Acceptance']."&nbsp;</td>";
												$rid = $row['Request_ID'];
												echo "<td><button type = \"submit\" name = \"delete_request\" value = '$rid'> Cancel </button></td>";
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
                                    <form method = "post" enctype="multipart/form-data">
                                                   <div id="table">	
													   <table>
														<tr>
														   <th> Request Time </th>
														   <th> Start Location </th>
														   <th> Destination </th>
														   <th> Estimated Fare </th>
														   <th> Accepter </th>
														   <th> Pickup Time </th>
														   <th> Complete Time </th>
														   <th> Total Charge </th>
														   <th> Tips </th>
                                                           <th> Dispute </th>
														</tr>
														<?php 
															while($row = mysqli_fetch_array($history))
															{
																echo "<tr>";
																echo "<td>".$row['Request_time']."&nbsp;</td>";
																echo "<td>".$row['Start_location']."&nbsp;</td>";
																echo "<td>".$row['Destination']."&nbsp;</td>";
																echo "<td>".$row['Suggested_Fee']."&nbsp;</td>";
																echo "<td>".$row['DriverName']."&nbsp;</td>";
																echo "<td>".$row['Pickup_time']."&nbsp;</td>";
																echo "<td>".$row['Complete_time']."&nbsp;</td>";
																echo "<td>".$row['Final_Fee']."&nbsp;</td>";
                                                                echo "<td>".$row['Tips']."&nbsp;</td>";
                                                                $rid = $row['Request_ID'];
                                                                echo "<td><button type = \"submit\" name = \"disputing\" value = '$rid'> Dispute </button></td>";
																echo "</tr>";
															}
														?>
														</table>
                                                </div>
                                                </form>
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