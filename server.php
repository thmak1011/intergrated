<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'eie3117');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['uname']);
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $fullname = $fname . $lname;
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $password_1 = mysqli_real_escape_string($db, $_POST['psw']);
  $password_2 = mysqli_real_escape_string($db, $_POST['psw2']);
  $home = mysqli_real_escape_string($db, $_POST['home']);
  $work = mysqli_real_escape_string($db, $_POST['work']);
  $cclass = $_POST['cclass'];
  $cmodel = mysqli_real_escape_string($db, $_POST['cmodel']);
  $cplate = mysqli_real_escape_string($db, $_POST['cplate']);
  $image = $_POST['fileToUpload'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($fullname)) { array_push($errors, "Fullname is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($phone)) { array_push($errors, "Phone number is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
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

  	$password = md5($password_1);//encrypt the password before saving in the database

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
}

if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM user WHERE Username ='$username' AND Password = '$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
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
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>