<?php session_start();?>
<?php require_once("api.php") ?>

<?php
// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$auth_code = array("AU82SAER", "2HS7YA92", "28JSNUDA", "8H28SJUB", "1HSHYAGY", "12GYMCNSZ", "27HSABCIAQ", "DH7G2JVC", "9J9JVNAUB", "S74R78UR5T");
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
  $image = $_FILES['fileToUpload']['name'];


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
    $mail->Body = "Your validation code is ".$auth_code[rand(0,9)].". Please enter this code to continue.";
    
    if( $mail->Send() ) {
   
            if($type == "passager") { 
                $hashpsw = md5($password_1.$secret_word.$username);
                $query = "INSERT INTO user (Username, Fullname, Phone_No, Email, Password, Type) 
  			                  VALUES('$username', '$fullname', '$phone', '$email', '$hashpsw', '$type');";
                mysqli_query($db, $query); 
                $query = "INSERT INTO passager (Username, Home_Location, Work_Location) 
  			                  VALUES('$username', '$home', '$work');";
                 mysqli_query($db, $query); 
                 
                    setcookie('login', $username);
                    setcookie('type', $type);
            
                header('location: emailact.php');}
    
            if($type == "driver") {
                $hashpsw = md5($password_1.$secret_word.$username);
                $query = "INSERT INTO user (Username, Fullname, Phone_No, Email, Password, Type) 
  			                  VALUES('$username', '$fullname', '$phone', '$email', '$hashpsw', '$type');";
                mysqli_query($db, $query); 
                //$imagetmp = addslashes(file_get_contents($_FILES['fileToUpload']['tmp_name']));
                $folder="/xampp/htdocs/images/";
                move_uploaded_file($image = $_FILES['fileToUpload']['tmp_name'], "$folder".$image = $_FILES['fileToUpload']['name']);
                $query = "INSERT INTO driver (Username, Car_class, Car_model, Car_plate_No, ImagePath, Image) 
  			                  VALUES('$username', '$cclass', '$cmodel', '$cplate', '$folder', '$image');";
              	mysqli_query($db, $query);
	  
                    setcookie('login', $username);
                    setcookie('type', $type);
            
                header('location: emailact.php');}
         }else {
            array_push($errors, "Confirm email cannot be sent!".$mail->ErrorInfo);
         } 	
   }
}

if (isset($_POST['validate'])){
  $aucode = mysqli_real_escape_string($db, $_POST['aucode']);
  $authorize = false;
  if (empty($aucode)) { array_push($errors, "Validation code is required"); }
  for ($cnt = 0; $cnt <= 9; $cnt++){
    if($aucode == $auth_code[$cnt]){ $authorize = true; }     
  }
  if (!$authorize) { array_push($errors, "Your validation code is incorrect"); }

  if (count($errors) == 0){    
      header('location: index.php');
  } 
}

// if submitted check response

if (isset($_POST['login_user'])) {
  sleep(2); 
  $username = mysqli_real_escape_string($db, $_POST['uname']);
  $password = mysqli_real_escape_string($db, $_POST['psw']);
  $response = null;

  /*if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
  }
  if (!($response != null && $response->success)) {
    array_push($errors, "ReCAPTCHA identification fails");
  }*/
  
  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $hashpsw = md5($password.$secret_word.$username);
  	$query = "SELECT * FROM user WHERE Username ='$username' AND Password = '$hashpsw'";
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
      $hasholdpsw = md5($old_password.$secret_word.$username);
      $query = "SELECT * FROM user WHERE Username = '$username' AND Password = '$hasholdpsw'";
      $results = mysqli_query($db, $query);   
  	  if (mysqli_num_rows($results) == 1) {
          $hashpsw = md5($password_1.$secret_word.$username);
          $query = "UPDATE user SET Password = '$hashpsw' WHERE Username ='$username' AND Password = '$hasholdpsw'";
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
   $aucode = mysqli_real_escape_string($db, $_POST['aucode']);
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
   if (!$authorize) { array_push($errors, "Your authorization code is invalid"); }
   
   if (count($errors) == 0){    
      $hashpsw = md5($password_1.$secret_word.$username);
      $query = "UPDATE user SET Password = '$hashpsw' WHERE Username ='$username'";
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
  $query = "SELECT * FROM request WHERE Request_ID = $RID";
  $results = mysqli_query($db, $query);
  if (!$results) {
    echo "Error: %s\n". mysqli_error($db);
    exit();
  }else{
        $req_time = $results->fetch_object()->Request_time;
        $results = mysqli_query($db, $query);
        $start = $results->fetch_object()->Start_location;
        $results = mysqli_query($db, $query);
        $des = $results->fetch_object()->Destination;
        $results = mysqli_query($db, $query);
        $fee = $results->fetch_object()->Suggested_Fee;
        $results = mysqli_query($db, $query);
        $pickup = $results->fetch_object()->Pickup_time;
        $results = mysqli_query($db, $query);
        $accepted = $results->fetch_object()->Acceptance;
        $results = mysqli_query($db, $query);
        $passager = $results->fetch_object()->PassagerName;
        
        $canceller = $_COOKIE['login'];

        $query = "SELECT * FROM user WHERE Username = '$passager'";
        $results = mysqli_query($db, $query);
        $pemail = $results->fetch_object()->Email;

        require("../phpMailer/class.phpmailer.php");
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; // turn on SMTP authentication
    
        $mail->Username = "eie3117t5a@gmail.com";
        $mail->Password = "EIE3117T5A";
        $mail->FromName = "PolyUber";
        $webmaster_email = "eie3117t5a@gmail.com"; 
        $mail->From = $webmaster_email;
        $mail->AddAddress($pemail,$passager);

        $mail->AddReplyTo($webmaster_email,"PolyUber");
        $mail->WordWrap = 50;
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = "[PolyUber] Your request has been cancelled";        

        if($accepted){
          //extra_charge();
          $query = "SELECT * FROM request WHERE Request_ID = $RID";
          $results = mysqli_query($db, $query);
          $driver = $results->fetch_object()->DriverName;
          $query = "SELECT * FROM user WHERE Username = '$driver'";
          $results = mysqli_query($db, $query);
          $demail = $results->fetch_object()->Email;
          $mail->AddAddress($demail,$driver);

          $mail->Body = 
          "The following request is cancelled due to '$canceller' cancellation: 
          <br> 
          <div id=\"table\" boarder=\"1\">	
													   <table>
														<tr>
														   <th> Request Time </th>
														   <th> Start Location </th>
														   <th> Destination </th>
                               <th> Estimated Fare </th>
                               <th> Requester </th>
														   <th> Accepter </th>
														   <th> Pickup Time </th>
                            </tr>
                            <tr>
														   <td> '$req_time' </td>
														   <td> '$start' </td>
														   <td> '$des' </td>
                               <td> '$fee' </td>
                               <td> '$passager' </td>
														   <td> '$driver' </td>
														   <td> '$pickup' </td>
                            </tr>
                            </table>
          ";
          if(!$mail->Send()){
            echo "Error: %s\n". $mail->ErrorInfo;
            exit();
          }

          $query = "UPDATE request SET Completance = 1 WHERE Request_ID = '$RID'"; 
          $results = mysqli_query($db, $query);
          if (!$results) {
              echo "Error: %s\n". mysqli_error($db);
              exit();
          }else{
            header('location: index.php');
          }
        }else{
          $mail->Body = 
          "The following request is cancelled due to your cancellation: 
          <br> 
          <div id=\"table\" boarder=\"1\">	
													   <table>
														<tr>
														   <th> Request Time </th>
														   <th> Start Location </th>
														   <th> Destination </th>
                               <th> Estimated Fare </th>
                               <th> Requester </th>
														   <th> Pickup Time </th>
                            </tr>
                            <tr>
														   <td> '$req_time' </td>
														   <td> '$start' </td>
														   <td> '$des' </td>
                               <td> '$fee' </td>
                               <td> '$passager' </td>
														   <td> '$pickup' </td>
                            </tr>
                            </table>     
          ";
          if(!$mail->Send()){
            echo "Error: %s\n". $mail->ErrorInfo;
            exit();
          }

          $query = "UPDATE request SET Completance = 1 WHERE Request_ID = '$RID'"; 
	        $results = mysqli_query($db, $query);
	        if (!$results) {
		        	echo "Error: %s\n". mysqli_error($db);
			        exit();
	        }else{
            header('location: index.php');
          }
        }       
  }
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

if (isset($_POST['completing'])) {
  $RID = $_POST['completing'];
  $_SESSION['RID'] = $RID;
  header('location: completeR.php');
}

if (isset($_POST['complete_request'])) {
  $RID = $_POST['complete_request'];
  $fee = $_POST['fee'];

  if (empty($fee)) { array_push($errors, "Total charge is required"); }

  if (count($errors) == 0){ 
  $time = $date = date('Y-m-d h:i:s');
  $query = "UPDATE request SET Complete_time = '$time', Final_Fee = '$fee', Completance = 1 WHERE Request_ID = '$RID'"; 
	$results = mysqli_query($db, $query);
	
  header('location: index.php');}
}

if (isset($_POST['request'])){
  $origin = $_COOKIE['origin'];
  $destination = $_COOKIE['destination'];
  $duration = $_COOKIE['duration'];
  $time = date('Y-m-d h:i:s');
  $pickup = $_POST['meeting-time'];
  $total = $_COOKIE['distance'];
  $username = $_COOKIE['login'];
  if($total<=2){
    $suggested_fee=30;
  }
  else
  {$suggested_fee=30+($total-2)*5.5;}
  $suggested_fee = round($suggested_fee,2);
  $query = "INSERT INTO request(Request_time, Pickup_time, PassagerName, Start_location, Destination, Suggested_Fee) 
  VALUE('$time', '$pickup', '$username', '$origin', '$destination', '$suggested_fee')"; 
	$results = mysqli_query($db, $query);
  if(!$results){
      echo "Error: %s\n". mysqli_error($db);
			exit();
  }else{
      unset($_COOKIE['origin']);
      unset($_COOKIE['destination']);
      unset($_COOKIE['duration']);
      unset($_COOKIE['distance']);
      unset($_COOKIE['meeting-time']);
      setcookie('origin',null,-1);
      setcookie('destination',null,-1);
      setcookie('duration',null,-1);
      setcookie('distance',null,-1);
      setcookie('meeting-time',null,-1);
      header('location: index.php');
  }
}

if (isset($_POST['disputing'])){
  $RID = $_POST['disputing'];
  $_SESSION['RID'] = $RID;
  header('location: dispute.php');
}

if (isset($_POST['dispute'])){
  $RID = $_POST['dispute'];
  $reason = $_POST['reason'];
  $revert = $_POST['revert'];
  $query = "SELECT * FROM request WHERE Request_ID = $RID";
  $results = mysqli_query($db, $query);
  if (!$results) {
    echo "Error: %s\n". mysqli_error($db);
    exit();
  }else{
        $req_time = $results->fetch_object()->Request_time;
        $results = mysqli_query($db, $query);
        $com_time = $results->fetch_object()->Complete_time;
        $results = mysqli_query($db, $query);
        $start = $results->fetch_object()->Start_location;
        $results = mysqli_query($db, $query);
        $des = $results->fetch_object()->Destination;
        $results = mysqli_query($db, $query);
        $fee = $results->fetch_object()->Suggested_Fee;
        $results = mysqli_query($db, $query);
        $actual_fee = $results->fetch_object()->Final_Fee;
        $results = mysqli_query($db, $query);
        $tips = $results->fetch_object()->Tips;
        $results = mysqli_query($db, $query);
        $pickup = $results->fetch_object()->Pickup_time;
        $results = mysqli_query($db, $query);
        $passager = $results->fetch_object()->PassagerName;
        $results = mysqli_query($db, $query);
        $driver = $results->fetch_object()->DriverName;

        require("../phpMailer/class.phpmailer.php");

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; // turn on SMTP authentication
    
        $mail->Username = "eie3117t5a@gmail.com";
        $mail->Password = "EIE3117T5A";
        $mail->FromName = "PolyUber";
        $webmaster_email = "eie3117t5a@gmail.com"; 
        $mail->From = $webmaster_email;
        
        $query = "SELECT * FROM user WHERE Username = '$driver'";
          $results = mysqli_query($db, $query);
          $demail = $results->fetch_object()->Email;
          $mail->AddAddress($demail,$driver);

        $mail->AddReplyTo($webmaster_email,"PolyUber");
        $mail->WordWrap = 50;
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = "[PolyUber] A past request is put to dispute";        
          
          $mail->Body = 
          "The following request is put to dispute due to '$passager' objection: 
          <br> 
          <div id=\"table\" boarder=\"1\">	
													   <table>
														<tr>
                               <th> Request Time </th>
                               <th> Complete Time </th>
														   <th> Start Location </th>
														   <th> Destination </th>
                               <th> Estimated Fare </th>
                               <th> Actual Fare </th>
                               <th> Tips </th>
                               <th> Requester </th>
														   <th> Accepter </th>
                            </tr>
                            <tr>
                               <td> '$req_time' </td>
                               <td> '$com_time' </td>
														   <td> '$start' </td>
														   <td> '$des' </td>
                               <td> '$fee' </td>
                               <td> '$actual_fee' </th>
                               <td> '$tips' </th>
                               <td> '$passager' </td>
														   <td> '$driver' </td>
                            </tr>
                            </table>
          <br>
          The reason of dispute is the following:
          <br>
          '$reason'
          <br>
          <br>
          '$passager' would like to have $'$revert' been reverted. If you accept the dispute amount, please go to the homepage and click the \"Accept Dispute Amount\" button to continue;
          Else if you do not accept the dispute and wish to escalate to arbitration, you can again go to the homepage and click the \"Reject Dispute Amount & Escalate To Arbitration\" button.
          ";
          if(!$mail->Send()){
            echo "Error: %s\n". $mail->ErrorInfo;
            exit();
          }
          $query = "UPDATE request SET Dispute = 1, Dispute_value = '$revert' WHERE Request_ID = '$RID'"; 
          $results = mysqli_query($db, $query);
            header('location: index.php');
          
        }       
  }

  if (isset($_POST['accept_dispute'])){
    $RID = $_POST['accept_dispute'];
    $query = "SELECT * FROM request WHERE Request_ID = '$RID'"; 
        $results = mysqli_query($db, $query);
        if (!$results) {
			echo "Error: %s\n". mysqli_error($db);
			exit();
        }
    $dispute = $results->fetch_object()->Dispute_value;
    $_SESSION['RID'] = $RID;
    $_SESSION['dispute'] = $dispute;
    header('location: paydispute.php');
  }

  if (isset($_POST['pay_dispute'])){
    $key = $_POST['key'];
    $dispute = $_SESSION['dispute'];
    $username = $_COOKIE['login'];
  $query = "SELECT * FROM user WHERE Username = '$username'"; 
  $results = mysqli_query($db, $query);
  if (!$results) {
    echo "Error: %s\n". mysqli_error($db);
  exit();}
  $driver_addr = $results->fetch_object()->Wallet_addr;
  if (is_null($driver_addr)){
    header('location: passageracc.php');
  }
  $query = "SELECT * FROM request WHERE Request_ID = $RID";
  $results = mysqli_query($db, $query);
  if (!$results) {
    echo "Error: %s\n". mysqli_error($db);
  exit();}
  $passager = $results->fetch_object()->PassagerName;
  $query = "SELECT * FROM user WHERE Username = '$passager'"; 
  $results = mysqli_query($db, $query);
  if (!$results) {
    echo "Error: %s\n". mysqli_error($db);
  exit();}
  $passager_addr = $results->fetch_object()->Wallet_addr;
  //$passager_wallet = new MyWallet($passager_addr);
  $driver_wallet = new MyWallet($driver_addr);
  $driver_wallet->sendPayment($passager_addr, $key, $dispute*3,212);
  $query = "UPDATE request SET Dispute = 0 WHERE Request_ID = '$RID'";
    $results = mysqli_query($db, $query);
    if (!$results) {
      echo "Error: %s\n". mysqli_error($db);
      exit();
    }
  //...update wallet address

    $query = "SELECT * FROM request WHERE Request_ID = $RID";
  $results = mysqli_query($db, $query);
  if (!$results) {
    echo "Error: %s\n". mysqli_error($db);
    exit();
  }else{
        $req_time = $results->fetch_object()->Request_time;
        $results = mysqli_query($db, $query);
        $com_time = $results->fetch_object()->Complete_time;
        $results = mysqli_query($db, $query);
        $start = $results->fetch_object()->Start_location;
        $results = mysqli_query($db, $query);
        $des = $results->fetch_object()->Destination;
        $results = mysqli_query($db, $query);
        $fee = $results->fetch_object()->Suggested_Fee;
        $results = mysqli_query($db, $query);
        $actual_fee = $results->fetch_object()->Final_Fee;
        $results = mysqli_query($db, $query);
        $tips = $results->fetch_object()->Tips;
        $results = mysqli_query($db, $query);
        $pickup = $results->fetch_object()->Pickup_time;
        $results = mysqli_query($db, $query);
        $passager = $results->fetch_object()->PassagerName;
        $results = mysqli_query($db, $query);
        $driver = $results->fetch_object()->DriverName;
        $results = mysqli_query($db, $query);
        $dispute_value = $results->fetch_object()->Dispute_value;

        require("../phpMailer/class.phpmailer.php");

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; // turn on SMTP authentication
    
        $mail->Username = "eie3117t5a@gmail.com";
        $mail->Password = "EIE3117T5A";
        $mail->FromName = "PolyUber";
        $webmaster_email = "eie3117t5a@gmail.com"; 
        $mail->From = $webmaster_email;
        
        $query = "SELECT * FROM user WHERE Username = '$passager'";
          $results = mysqli_query($db, $query);
          $pemail = $results->fetch_object()->Email;
          $mail->AddAddress($pemail,$passager);

        $mail->AddReplyTo($webmaster_email,"PolyUber");
        $mail->WordWrap = 50;
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = "[PolyUber] Your dispute amount is accepted";        
          
          $mail->Body = 
          "This email is to inform you that your dispute of the following request has been accepted by '$driver': 
          <br> 
          <div id=\"table\" boarder=\"1\">	
													   <table>
														<tr>
                               <th> Request Time </th>
                               <th> Complete Time </th>
														   <th> Start Location </th>
														   <th> Destination </th>
                               <th> Estimated Fare </th>
                               <th> Actual Fare </th>
                               <th> Tips </th>
                               <th> Requester </th>
														   <th> Accepter </th>
                            </tr>
                            <tr>
                               <td> '$req_time' </td>
                               <td> '$com_time' </td>
														   <td> '$start' </td>
														   <td> '$des' </td>
                               <td> '$fee' </td>
                               <td> '$actual_fee' </th>
                               <td> '$tips' </th>
                               <td> '$passager' </td>
														   <td> '$driver' </td>
                            </tr>
                            </table>
          <br>
          The dispute amount $'$dispute_value' has been transferred into your BitCoin wallet.
          ";
          if(!$mail->Send()){
            echo "Error: %s\n". $mail->ErrorInfo;
            exit();
          }

          $query = "UPDATE request SET Final_Fee = (Final_Fee - Dispute_value), Dispute = 0 WHERE Request_ID = '$RID'";
    $results = mysqli_query($db, $query);
    if (!$results) {
      echo "Error: %s\n". mysqli_error($db);
      exit();
    }
    header('location: index.php');
  }

  if (isset($_POST['reject_dispute'])){
    $RID = $_POST['reject_dispute'];
    $query = "SELECT * FROM request WHERE Request_ID = $RID";
  $results = mysqli_query($db, $query);
  if (!$results) {
    echo "Error: %s\n". mysqli_error($db);
    exit();
  }else{
        $req_time = $results->fetch_object()->Request_time;
        $results = mysqli_query($db, $query);
        $com_time = $results->fetch_object()->Complete_time;
        $results = mysqli_query($db, $query);
        $start = $results->fetch_object()->Start_location;
        $results = mysqli_query($db, $query);
        $des = $results->fetch_object()->Destination;
        $results = mysqli_query($db, $query);
        $fee = $results->fetch_object()->Suggested_Fee;
        $results = mysqli_query($db, $query);
        $actual_fee = $results->fetch_object()->Final_Fee;
        $results = mysqli_query($db, $query);
        $tips = $results->fetch_object()->Tips;
        $results = mysqli_query($db, $query);
        $pickup = $results->fetch_object()->Pickup_time;
        $results = mysqli_query($db, $query);
        $passager = $results->fetch_object()->PassagerName;
        $results = mysqli_query($db, $query);
        $driver = $results->fetch_object()->DriverName;
        $results = mysqli_query($db, $query);
        $dispute_value = $results->fetch_object()->Dispute_value;

        require("../phpMailer/class.phpmailer.php");

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; // turn on SMTP authentication
    
        $mail->Username = "eie3117t5a@gmail.com";
        $mail->Password = "EIE3117T5A";
        $mail->FromName = "PolyUber";
        $webmaster_email = "eie3117t5a@gmail.com"; 
        $mail->From = $webmaster_email;
        
        $query = "SELECT * FROM user WHERE Username = '$passager'";
          $results = mysqli_query($db, $query);
          $pemail = $results->fetch_object()->Email;
          $mail->AddAddress($pemail,$passager);

          $query = "SELECT * FROM user WHERE Username = '$driver'";
          $results = mysqli_query($db, $query);
          $demail = $results->fetch_object()->Email;
          $mail->AddAddress($demail,$driver);

        $mail->AddReplyTo($webmaster_email,"PolyUber");
        $mail->WordWrap = 50;
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = "[PolyUber] Your dispute is escalated to arbitration level";        
          
          $mail->Body = 
          "This email is to inform you that your dispute of the following request has been escalated to arbitration by '$driver': 
          <br> 
          <div id=\"table\" boarder=\"1\">	
													   <table>
														<tr>
                               <th> Request Time </th>
                               <th> Complete Time </th>
														   <th> Start Location </th>
														   <th> Destination </th>
                               <th> Estimated Fare </th>
                               <th> Actual Fare </th>
                               <th> Tips </th>
                               <th> Requester </th>
														   <th> Accepter </th>
                            </tr>
                            <tr>
                               <td> '$req_time' </td>
                               <td> '$com_time' </td>
														   <td> '$start' </td>
														   <td> '$des' </td>
                               <td> '$fee' </td>
                               <td> '$actual_fee' </th>
                               <td> '$tips' </th>
                               <td> '$passager' </td>
														   <td> '$driver' </td>
                            </tr>
                            </table>
          <br>
          A third party will handle your dispute in upcoming days. Meanwhile please wait patiently for further notification.
          ";
          if(!$mail->Send()){
            echo "Error: %s\n". $mail->ErrorInfo;
            exit();
          }
    $query = "UPDATE request SET Dispute = 0 WHERE Request_ID = '$RID'";
    $results = mysqli_query($db, $query);
    if (!$results) {
      echo "Error: %s\n". mysqli_error($db);
      exit();
    }
    header('location: index.php');
  }
  }
}

if(isset($_POST['set_wallet'])){
  $addr = $_POST['address'];
  $username = $_COOKIE['login'];
  $query = "UPDATE user SET Wallet_addr = '$addr' WHERE Username = '$username'";
  $results = mysqli_query($db, $query);
  if(!$results) {
    echo "Error: %s\n". mysqli_error($db);
    exit();
  }
  echo $addr;
  echo $username;
  header('location: '.$_COOKIE['type'].'acc.php');
}

if(isset($_POST['paying'])){
  $RID = $_POST['paying'];
  $query = "SELECT * FROM request WHERE Request_ID = '$RID'"; 
        $results = mysqli_query($db, $query);
        if (!$results) {
			echo "Error: %s\n". mysqli_error($db);
			exit();
        }
  $fee = $results->fetch_object()->Final_Fee;
  $_SESSION['RID'] = $RID;
  $_SESSION['fee'] = $fee;
  header('location: payment.php');
}

if(isset($_POST['payment'])){
  $RID = $_POST['payment'];
  $key = $_POST['key'];
  $fee = $_SESSION['fee'];
  $tips = $_POST['tips'];
  $username = $_COOKIE['login'];
  $query = "SELECT * FROM user WHERE Username = '$username'"; 
  $results = mysqli_query($db, $query);
  if (!$results) {
    echo "Error: %s\n". mysqli_error($db);
  exit();}
  $passager_addr = $results->fetch_object()->Wallet_addr;
  if (is_null($passager_addr)){
    header('location: passageracc.php');
  }
  $query = "SELECT * FROM request WHERE Request_ID = $RID";
  $results = mysqli_query($db, $query);
  if (!$results) {
    echo "Error: %s\n". mysqli_error($db);
  exit();}
  $driver = $results->fetch_object()->DriverName;
  $query = "SELECT * FROM user WHERE Username = '$driver'"; 
  $results = mysqli_query($db, $query);
  if (!$results) {
    echo "Error: %s\n". mysqli_error($db);
  exit();}
  $driver_addr = $results->fetch_object()->Wallet_addr;
  $passager_wallet = new MyWallet($passager_addr);
  //$driver_wallet = new MyWallet($driver_addr);
  $total = ($fee + $tips)*3213;
  $record = $passager_wallet->sendPayment($driver_addr, $key, $total);
  $query = "UPDATE request SET Paid = 1, Tips = '$tips' WHERE Request_ID = '$RID'";
    $results = mysqli_query($db, $query);
    if (!$results) {
      echo "Error: %s\n". mysqli_error($db);
      exit();
    }
  //...update wallet address
  $query = "SELECT * FROM request WHERE Request_ID = $RID";
  $results = mysqli_query($db, $query);
  if (!$results) {
    echo "Error: %s\n". mysqli_error($db);
  exit();
   }else{
      $req_time = $results->fetch_object()->Request_time;
      $results = mysqli_query($db, $query);
      $start = $results->fetch_object()->Start_location;
      $results = mysqli_query($db, $query);
      $des = $results->fetch_object()->Destination;
      $results = mysqli_query($db, $query);
      $fee = $results->fetch_object()->Suggested_Fee;
      $results = mysqli_query($db, $query);
      $pickup = $results->fetch_object()->Pickup_time;
      $results = mysqli_query($db, $query);
      $completetime = $results->fetch_object()->Complete_time;
      $results = mysqli_query($db, $query);
      $charge = $results->fetch_object()->Final_Fee;
      $results = mysqli_query($db, $query);
      $tips = $results->fetch_object()->Tips;
      $results = mysqli_query($db, $query);
      $passager = $results->fetch_object()->PassagerName;
      
      $canceller = $_COOKIE['login'];

      $query = "SELECT * FROM user WHERE Username = '$passager'";
      $results = mysqli_query($db, $query);
      $pemail = $results->fetch_object()->Email;

      require("../phpMailer/class.phpmailer.php");
      $mail = new PHPMailer();
      $mail->IsSMTP();
      $mail->SMTPAuth = true; // turn on SMTP authentication
  
      $mail->Username = "eie3117t5a@gmail.com";
      $mail->Password = "EIE3117T5A";
      $mail->FromName = "PolyUber";
      $webmaster_email = "eie3117t5a@gmail.com"; 
      $mail->From = $webmaster_email;
      $mail->AddAddress($pemail,$passager);

      $mail->AddReplyTo($webmaster_email,"PolyUber");
      $mail->WordWrap = 50;
      $mail->IsHTML(true); // send as HTML
      $mail->Subject = "[PolyUber] Request has been completed";        

        //extra_charge();
        $query = "SELECT * FROM request WHERE Request_ID = $RID";
        $results = mysqli_query($db, $query);
        $driver = $results->fetch_object()->DriverName;
        $query = "SELECT * FROM user WHERE Username = '$driver'";
        $results = mysqli_query($db, $query);
        $demail = $results->fetch_object()->Email;
        $mail->AddAddress($demail,$driver);

        $mail->Body = 
        "The request has been completed, thank you for choosing PolyUber. 
        <br> 
        <div id=\"table\" boarder=\"1\">	
                           <table>
                          <tr>
                             <th> Request Time </th>
                             <th> Start Location </th>
                             <th> Destination </th>
                             <th> Estimated Fare </th>
                             <th> Requester </th>
                             <th> Accepter </th>
                             <th> Pickup Time </th>
                             <th> Complete Time </th>
                             <th> Total Charge </th>
                             <th> Tips </th>
                          </tr>
                          <tr>
                             <td> '$req_time' </td>
                             <td> '$start' </td>
                             <td> '$des' </td>
                             <td> '$fee' </td>
                             <td> '$passager' </td>
                             <td> '$driver' </td>
                             <td> '$pickup' </td>
                             <td> '$completetime' </td>
                             <td> '$charge' </td>
                             <td> '$tips' </td>
                          </tr>
                          </table>
        ";
        if(!$mail->Send()){
          echo "Error: %s\n". $mail->ErrorInfo;
          exit();
        }
      }    
  header("location: index.php");
}
?>