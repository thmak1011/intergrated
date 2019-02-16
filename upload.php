<?php
//$target_dir = "uploads/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$host = 'localhost';
$user = 'root';
$pass = ' ';

mysql_connect($host, $user, $pass);

mysql_select_db('eie3117');

<<<<<<< HEAD
$upload_image=$_FILES[" myimage "][ "name" ];
=======
<<<<<<< HEAD
$upload_image=$_FILES[" myimage "][ "name" ];
=======
<<<<<<< HEAD
$upload_image=$_FILES[" myimage "][ "name" ];
=======
$upload_image=$_FILES["fileToUpload"][ "name" ];
>>>>>>> a92df7332af9c0c8975030dc70e17dc4a95c7cbf
>>>>>>> f69402e33e410a2f3ccf1b18b9029ca3d205c686
>>>>>>> 5c64ccd8cd26d084f03b7e25638ee58e99da728b

$folder="/xampp/htdocs/images/";

$insert_path="INSERT INTO image_table VALUES('$folder','$upload_image')";

$var=mysql_query($inser_path);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
<<<<<<< HEAD
    if (move_uploaded_file($_FILES[" myimage "][" tmp_name "], "$folder".$_FILES[" myimage "][" name "])) {
        echo "The file ". basename( $_FILES[" myimage "]["name"]). " has been uploaded.";
=======
<<<<<<< HEAD
    if (move_uploaded_file($_FILES[" myimage "][" tmp_name "], "$folder".$_FILES[" myimage "][" name "])) {
        echo "The file ". basename( $_FILES[" myimage "]["name"]). " has been uploaded.";
=======
<<<<<<< HEAD
    if (move_uploaded_file($_FILES[" myimage "][" tmp_name "], "$folder".$_FILES[" myimage "][" name "])) {
        echo "The file ". basename( $_FILES[" myimage "]["name"]). " has been uploaded.";
=======
    if (move_uploaded_file($_FILES["fileToUpload"][" tmp_name "], "$folder".$_FILES["fileToUpload"][" name "])) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
>>>>>>> a92df7332af9c0c8975030dc70e17dc4a95c7cbf
>>>>>>> f69402e33e410a2f3ccf1b18b9029ca3d205c686
>>>>>>> 5c64ccd8cd26d084f03b7e25638ee58e99da728b
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>