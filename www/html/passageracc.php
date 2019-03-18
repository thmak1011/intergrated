<?php include ('server.php') ?>
<?php include ('api.php') ?>

<?php if(!isset($_COOKIE['login']) || !isset($_COOKIE['type'])) {
        header('location: index.php');
}
?>


<?php if(isset($_COOKIE['login']) && isset($_COOKIE['type'])) {
  $db = mysqli_connect('localhost', 'root', '123', 'eie3117');
      $username = $_COOKIE['login'];

      $query = "SELECT * FROM user WHERE Username = '$username'"; 
      $result = mysqli_query($db, $query);
      if (!$result) {
    echo "Error: %s\n". mysqli_error($db);
    exit();
      }
      $fullname = $result->fetch_object()->Fullname;
      $result = mysqli_query($db, $query);
      $email = $result->fetch_object()->Email;
      $result = mysqli_query($db, $query);
      $phone = $result->fetch_object()->Phone_No;
      $result = mysqli_query($db, $query);
      $username = $result->fetch_object()->Username;
      $result = mysqli_query($db, $query);
      $wallet_addr = $result->fetch_object()->Wallet_addr;

      $query2 = "SELECT Home_Location, Work_Location FROM user, passager WHERE user.Username = passager.Username";
      $passager = mysqli_query($db, $query2);
      if (!$passager) {
        echo "Error: %s\n". mysqli_error($db);
        exit();
      }
      $home = $passager->fetch_object()->Home_Location;
      $passager = mysqli_query($db, $query2);
      $work = $passager->fetch_object()->Work_Location;
      


  }
?>
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
                        <h2>Persoanl Page</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        
                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <!--== About Page Content Start ==-->
    <section id="about-area" class="section-padding">
        <div class="container">
           

            <table class="box">
                <tr>
                  <td>
                    <div class="content">
                      <div class="txt">
                        Full Name:
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="content">
                      <div class="txt">
                        <?php echo $fullname?>
                      </div>
                    </div>
                  </td>
                  <tr>
                  <td>
                    <div class="content">
                      <div class="txt">
                        Email:
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="content">
                      <div class="txt">
                        <?php echo $email?>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="content">
                      <div class="txt">
                        Phone Number:
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="content">
                      <div class="txt">
                        <?php echo $phone?>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="content">
                      <div class="txt">
                        Username:
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="content">
                      <div class="txt">
                        <?php echo $username?>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="content">
                      <div class="txt">
                        Home Location
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="content">
                      <div class="txt">
                        <?php echo $home?>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="content">
                      <div class="txt">
                        Work Location:
                      </div>
                    </div>
                  </td>
                    <td>
                    <div class="content">
                      <div class="txt">
                        <?php echo $work?>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="content">
                      <div class="txt">
                        Bitcoin wallet:
                      </div>
                    </div>
                  </td>
                    <td>
                    <div class="content">
                      <div class="txt">
                      <?php if(is_null($wallet_addr)){
                        echo "<form method=\"post\" enctype=\"multipart/form-data\">";
                        echo "<input type= \"text\" name = \"address\" placeholder=\"Wallet address\" required>";
                        echo "<button type = \"submit\" name = \"set_wallet\"> Set your BitCoin wallet </button>";
                        echo "</form>";
                      }else{
                        $wallet = new MyWallet();
                        $wallet->setMasterAddr($wallet_addr);
                        echo $wallet->getMasterAddrBalance();
                      }?>
                      </div>
                    </div>
                  </td>
                </tr>
                
              </table>

            
        </div>
    </section>
    <!--== About Page Content End ==-->
    
    

    

    

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