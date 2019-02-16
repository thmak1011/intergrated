<script>
  function popup(int i)
  {
  if (i == 1)
  {alert("Confirmation email sent! Please check for full registration.");}
  else {alert("Ops! Your email seems to be not existed, please revise the registration with a valid email.");}
  }
</script>
<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$secret_word = 'Dirty Deeds Done Dirt Cheap';

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'eie3117');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['uname']);
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
<<<<<<< HEAD
  $fullname = $fname . " " . $lname;
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $type = $_POST['type'];
=======
<<<<<<< HEAD
  $fullname = $fname . " " . $lname;
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $type = $_POST['type'];
=======
<<<<<<< HEAD
  $fullname = $fname . " " . $lname;
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $type = $_POST['type'];
=======
  $fullname = $fname . $lname;
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
>>>>>>> a92df7332af9c0c8975030dc70e17dc4a95c7cbf
>>>>>>> f69402e33e410a2f3ccf1b18b9029ca3d205c686
>>>>>>> 5c64ccd8cd26d084f03b7e25638ee58e99da728b
  $password_1 = mysqli_real_escape_string($db, $_POST['psw']);
  $password_2 = mysqli_real_escape_string($db, $_POST['psw2']);
  $home = mysqli_real_escape_string($db, $_POST['home']);
  $work = mysqli_real_escape_string($db, $_POST['work']);
  $cclass = $_POST['cclass'];
  $cmodel = mysqli_real_escape_string($db, $_POST['cmodel']);
  $cplate = mysqli_real_escape_string($db, $_POST['cplate']);
<<<<<<< HEAD
  $image = $_FILES['fileToUpload']['tmp_name'];

=======
<<<<<<< HEAD
  $image = $_FILES['fileToUpload']['tmp_name'];

=======
<<<<<<< HEAD
  $image = $_FILES['fileToUpload']['tmp_name'];

=======
  $image = $_POST['fileToUpload'];
>>>>>>> a92df7332af9c0c8975030dc70e17dc4a95c7cbf
>>>>>>> f69402e33e410a2f3ccf1b18b9029ca3d205c686
>>>>>>> 5c64ccd8cd26d084f03b7e25638ee58e99da728b

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($fullname)) { array_push($errors, "Fullname is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($phone)) { array_push($errors, "Phone number is required"); }
<<<<<<< HEAD
  if (strlen($phone) != 8) { array_push($errors, "Phone number is invalid"); }
=======
<<<<<<< HEAD
  if (strlen($phone) != 8) { array_push($errors, "Phone number is invalid"); }
=======
<<<<<<< HEAD
  if (strlen($phone) != 8) { array_push($errors, "Phone number is invalid"); }
=======
>>>>>>> a92df7332af9c0c8975030dc70e17dc4a95c7cbf
>>>>>>> f69402e33e410a2f3ccf1b18b9029ca3d205c686
>>>>>>> 5c64ccd8cd26d084f03b7e25638ee58e99da728b
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
    $mail->Subject = "Thank you for your registration of PolyUber"; 
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
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
}

<<<<<<< HEAD

=======
  	$query = "INSERT INTO user (Username, Fullname, Phone_No, Email, Password) 
  			  VALUES('$username', '$fullname', '$phone', '$email', '$password');";
          mysqli_query($db, $query);
    
    if(!empty($home) && !empty($work)) { 
    $query = "INSERT INTO passager (Username, Home_Location, Work_Location) 
  			  VALUES('$username', '$home', '$work');";
          mysqli_query($db, $query);}
          
    
    if(!empty($cclass) && !empty($cmodel) && !empty($cplate)){  
    $query = "INSERT INTO driver (Username, Car_class, Car_model, Car_plate_No, Image) 
  			  VALUES('$username', '$cclass', '$cmodel', '$cplate', '$image');";
  	mysqli_query($db, $query);}
	  
                    setcookie('username', $username);
                    setcookie('password', $password);
    
  	header('location: index.php');
  }
>>>>>>> f69402e33e410a2f3ccf1b18b9029ca3d205c686
>>>>>>> 5c64ccd8cd26d084f03b7e25638ee58e99da728b
}
>>>>>>> a92df7332af9c0c8975030dc70e17dc4a95c7cbf



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
<<<<<<< HEAD
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
=======
<<<<<<< HEAD
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
=======
<<<<<<< HEAD
=======
  	$password = md5($password);
>>>>>>> a92df7332af9c0c8975030dc70e17dc4a95c7cbf
  	$query = "SELECT * FROM user WHERE Username ='$username' AND Password = '$password'";
  	$results = mysqli_query($db, $query);
    $pdtype = $results->fetch_object()->Type;
  	if (mysqli_num_rows($results) == 1) {
<<<<<<< HEAD
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
=======
		if($_POST["remember"]=='1' || $_POST["remember_me"]=='on')
    {
                    $hour = time() + 3600 * 24 * 30;
                    setcookie('username', $username, $hour);
                    setcookie('password', $password, $hour);
    }else{
                    setcookie('username', $username);
                    setcookie('password', $password);
    }
  	  header('location: index.php');
>>>>>>> a92df7332af9c0c8975030dc70e17dc4a95c7cbf
>>>>>>> f69402e33e410a2f3ccf1b18b9029ca3d205c686
>>>>>>> 5c64ccd8cd26d084f03b7e25638ee58e99da728b
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

if (isset($_POST['changee_pw'])) {
    $old_password = mysqli_real_escape_string($db, $_POST['opsw']);
    $password_1 = mysqli_real_escape_string($db, $_POST['psw']);
    $password_2 = mysqli_real_escape_string($db, $_POST['psw2']);
    if (empty($old_password)) { array_push($errors, "Original password is required"); }
    if (empty($password_1)) { array_push($errors, "New password is required"); }
    if ($password_1 != $password_2) {
	  array_push($errors, "The new passwords do not match");
    }
    if ($old_password = $password_1) {
	  array_push($errors, "The new password should not equals to the roiginal password.");
    }
<<<<<<< HEAD
    if (count($errors) == 0) {
      $query = "SELECT * FROM user WHERE Username = ".$_COOKIE['login']." AND Password = ".$old_password;
      $results = mysqli_query($db, $query);   
  	  if (mysqli_num_rows($results) == 1) {
          $query = "UPDATE user SET Password = '$password_1' WHERE Username =".$_COOKIE['login']." AND Password = '$old_password'";
          $results = mysqli_query($db, $query); 
          if ($result) { 
            array_push($errors, "Password updated successfully"); 
          }else{ 
            array_push($errors, "Error updating record: " . $db->error);
          };
      }
    }
=======
>>>>>>> 5c64ccd8cd26d084f03b7e25638ee58e99da728b
}
?>