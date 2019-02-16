<?php session_start();?>

<script>
  function popup(int i)
  {
  if (i == 1)
  {alert("Confirmation email sent! Please check for full registration.");}
  else {alert("Ops! Your email seems to be not existed, please revise the email.");}
  }
</script>

<?php
// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$auth_code = array("AU82SAER", "2HS7YA92", "28JSNUDA", "8H28SJUB", "1HSHYAGY", "12GYMCNSZ", "27HSABCIAQ", "DH7G2JVC", "9J9JVNAUB", "S74R78UR5TS7RE4M");
$secret_word = 'Dirty Deeds Done Dirt Cheap';

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'eie3117');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['uname']);
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $fullname = $fname . " " . $lname;
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $type = $_POST['type'];
  $password_1 = mysqli_real_escape_string($db, $_POST['psw']);
  $password_2 = mysqli_real_escape_string($db, $_POST['psw2']);
  $home = mysqli_real_escape_string($db, $_POST['home']);
  $work = mysqli_real_escape_string($db, $_POST['work']);
  $cclass = $_POST['cclass'];
  $cmodel = mysqli_real_escape_string($db, $_POST['cmodel']);
  $cplate = mysqli_real_escape_string($db, $_POST['cplate']);
  $image = $_FILES['fileToUpload']['tmp_name'];


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($fullname)) { array_push($errors, "Fullname is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($phone)) { array_push($errors, "Phone number is required"); }
  if (strlen($phone) != 8) { array_push($errors, "Phone number is invalid"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  if ($type == "passager"){
    if (empty($home)) { array_push($errors, "Home location is required"); }
    if (empty($work)) { array_push($errors, "Work location is required"); }
  }else{
    if (empty($cmodel)) { array_push($errors, "Car model is required"); }
    if (empty($cplate)) { array_push($errors, "Car plate number is required"); }
    if (empty($image)) { array_push($errors, "Self image is required"); }
  }
    

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE Username='$username' OR Email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) { 	
    
    require("../phpMailer/class.phpmailer.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; // turn on SMTP authentication
    
    $mail->Username = "eie3117t5a@gmail.com";
    $mail->Password = "EIE3117T5A";
    $mail->FromName = "PolyUber";
    $webmaster_email = "eie3117t5a@gmail.com"; 
    $mail->From = $webmaster_email;
    $mail->AddAddress($email,$username);
    $mail->AddReplyTo($webmaster_email,"PolyUber");
    $mail->WordWrap = 50;
    $mail->IsHTML(true); // send as HTML
    $mail->Subject = "[PolyUber] Thank you for your registration"; 
    $mail->Body = "To complete the registration, please click <a href = localhost/testweb/emailactivated.html >here</a> to continue.";
    
    if( $mail->Send() ) {
            echo "<script>popup(1)</script>";
   
            if($type == "passager") { 
                $query = "INSERT INTO user (Username, Fullname, Phone_No, Email, Password, Type) 
  			                  VALUES('$username', '$fullname', '$phone', '$email', '$password_1', '$type');";
                mysqli_query($db, $query); 
                $query = "INSERT INTO passager (Username, Home_Location, Work_Location) 
  			                  VALUES('$username', '$home', '$work');";
                 mysqli_query($db, $query); 
                 
                    setcookie('login', $username);
                    setcookie('type', $type);
            
                header('location: '.$type.'homepage.php');}
    
            if($type == "driver") {
                $query = "INSERT INTO user (Username, Fullname, Phone_No, Email, Password, Type) 
  			                  VALUES('$username', '$fullname', '$phone', '$email', '$password_1', '$type');";
                mysqli_query($db, $query); 
                $query = "INSERT INTO driver (Username, Car_class, Car_model, Car_plate_No, Image) 
  			                  VALUES('$username', '$cclass', '$cmodel', '$cplate', '$image');";
              	mysqli_query($db, $query);
	  
                    setcookie('login', $username);
                    setcookie('type', $type);
            
                header('location: '.$type.'homepage.php');}
         }else {
            array_push($errors, "Confirm email cannot be sent!".$mail->ErrorInfo);
         } 	
   }
}


if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['uname']);
  $password = mysqli_real_escape_string($db, $_POST['psw']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$query = "SELECT * FROM user WHERE Username ='$username' AND Password = '$password'";
  	$results = mysqli_query($db, $query);   
  	if (mysqli_num_rows($results) == 1) {
    $pdtype = $results->fetch_object()->Type;
		  if($_POST["remember"]=='1' || $_POST["remember_me"]=='on')
      {
                    $hour = time() + 3600 * 24 * 30;
                    setcookie('login', $username, $hour);
                    setcookie('type', $pdtype, $hour);
                    
                    header('location: '.$pdtype.'homepage.php');
       }else{
                    setcookie('login', $username);
                    setcookie('type', $pdtype);
                    
                    header('location: '.$pdtype.'homepage.php');
       }        
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

if (isset($_POST['change_pw'])) {
    $old_password = mysqli_real_escape_string($db, $_POST['opsw']);
    $password_1 = mysqli_real_escape_string($db, $_POST['psw']);
    $password_2 = mysqli_real_escape_string($db, $_POST['psw2']);
    if (empty($old_password)) { array_push($errors, "Original password is required"); }
    if (empty($password_1)) { array_push($errors, "New password is required"); }
    if ($password_1 != $password_2) {
	  array_push($errors, "The new passwords do not match");
    }
    if ($old_password == $password_1) {
	  array_push($errors, "The new password should not equals to the original password.");
    }
    if (count($errors) == 0) {
      $username = $_COOKIE['login'];
      $query = "SELECT * FROM user WHERE Username = '$username' AND Password = '$old_password'";
      $results = mysqli_query($db, $query);   
  	  if (mysqli_num_rows($results) == 1) {
          $query = "UPDATE user SET Password = '$password_1' WHERE Username ='$username' AND Password = '$old_password'";
          $results = mysqli_query($db, $query); 
          if ($results) {            
            array_push($errors, "Password updated successfully"); 
          }else{ 
            array_push($errors, "Error updating record: " . $db->error);
          };
      }
    }
}

if (isset($_POST['forget'])) {
   $username = mysqli_real_escape_string($db, $_POST['uname']);
   if (empty($username)) { array_push($errors, "Username is required"); }
   if (count($errors) == 0) {
      $query = "SELECT * FROM user WHERE Username = '$username'";
      $results = mysqli_query($db, $query);
      if (mysqli_num_rows($results) == 1) {
         $email = $results->fetch_object()->Email;
   
         require("../phpMailer/class.phpmailer.php");
         $mail = new PHPMailer();
         $mail->IsSMTP();
         $mail->SMTPAuth = true; // turn on SMTP authentication
    
         $mail->Username = "eie3117t5a@gmail.com";
         $mail->Password = "EIE3117T5A";
         $mail->FromName = "PolyUber";
         $webmaster_email = "eie3117t5a@gmail.com"; 
      
         $mail->From = $webmaster_email;
         $mail->AddAddress($email,$username);
         $mail->AddReplyTo($webmaster_email,"PolyUber");
         $mail->WordWrap = 50;
         $mail->IsHTML(true); // send as HTML
         $mail->Subject = "[PolyUber] Authorization code"; 
         $mail->Body = "Your authorization code is ".$auth_code[rand(0,9)].". Please enter this code to reset your password.";
      
         if( $mail->Send() ) {
            $_SESSION['username'] = $username;
            header('location: reset.php');
         }else{
            array_push($errors, "Authorization code cannot be sent!".$mail->ErrorInfo);
         }
      }
   }
}

if (isset($_POST['reset'])) {
   $aucode = $_POST['aucode'];
   $password_1 = mysqli_real_escape_string($db, $_POST['psw']);
   $password_2 = mysqli_real_escape_string($db, $_POST['psw2']);
   $authorize = false;
   
   $username = $_SESSION['username'];
   $query = "SELECT * FROM user WHERE Username = '$username'";
   $results = mysqli_query($db, $query);
   $old_password = $results->fetch_object()->Password;
            
   if (empty($aucode)) { array_push($errors, "Authorization code is required"); }
   if (empty($password_1)) { array_push($errors, "New password is required"); }
   if ($password_1 != $password_2) { array_push($errors, "The new passwords do not match"); }
   if ($old_password == $password_1) { array_push($errors, "The new password should not equals to the original password."); }
   for ($cnt = 0; $cnt <= 9; $cnt++){
         if($aucode == $auth_code[$cnt]){ $authorize = true; }     
   }
   if (!authorize) { array_push($errors, "Your authorization code is invalid"); }
   
   if (count($errors) == 0){    
      $query = "UPDATE user SET Password = '$password_1' WHERE Username ='$username'";
      $results = mysqli_query($db, $query);
      if ($results) {            
            array_push($errors, "Password updated successfully");
            $query = "SELECT * FROM user WHERE Username = '$username'";
            $results = mysqli_query($db, $query);
            $type = $results->fetch_object()->Type;
            setcookie('login',$username);
            setcookie('type',$type);
            header('location: '.$type.'homepage.php');
          }else{ 
            array_push($errors, "Error updating record: " . $db->error);
          };
   }
}

if (isset($_POST['delete_request'])) {
  $RID = $_POST['delete_request'];
  $query = "DELETE FROM request WHERE Request_ID = '$RID'"; 
	$results = mysqli_query($db, $query);
	if (!$results) {
			echo "Error: %s\n". mysqli_error($db);
			exit();
	}else{header('location: reset.php');}
}

if (isset($_POST['accept_request'])) {
  $RID = $_POST['accept_request'];
  $username = $_COOKIE['login'];
  $query = "UPDATE request SET DriverName = '$username', Acceptance = 1 WHERE Request_ID = '$RID'"; 
	$results = mysqli_query($db, $query);
	if (!$results) {
			echo "Error: %s\n". mysqli_error($db);
			exit();
  }else{header('location: reset.php');}
}

if (isset($_POST['complete_request'])) {
  $RID = $_POST['complete_request'];
  $fee = $_POST['fee'];
  $tips = $_POST['tips'];
  $time = $date = date('Y-m-d h:i:s');
  $query = "UPDATE request SET Complete_time = '$time', Final_Fee = '$fee', Tips = '$tips', Completance = 1 WHERE Request_ID = '$RID'"; 
	$results = mysqli_query($db, $query);
	if (!$results) {
			echo "Error: %s\n". mysqli_error($db);
			exit();
  }else{header('location: reset.php');}
}

if (isset($_POST['request'])){
  $origin = $_COOKIE['origin'];
  $destination = $_COOKIE['destination'];
  $duration = $_COOKIE['duration'];
  $distance = $_COOKIE['distance'];
  $time = date('Y-m-d h:i:s');
  $pickup = $_POST['meeting-time'];
  $username = $_COOKIE['login'];
  if ($duration < 2){
    $suggested_fee = 20.0;
  }else{
    $suggested_fee = 20.0 + (ceil($duration) - 2) * 3;
  };
  $query = "INSERT INTO request(Request_time, Pickup_time, PassagerName, Start_location, Destination, Suggested_Fee) 
  VALUE('$time', '$pickup', '$username', '$origin', '$destination', '$suggested_fee')"; 
	$results = mysqli_query($db, $query);
  if(!$results){
      echo "Error: %s\n". mysqli_error($db);
			exit();
  }else{
      header('location: index.php');
  }
}
?>