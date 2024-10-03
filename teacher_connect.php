<?php

$host= "localhost" ;
$user = "root";
$pass = "";
$db = "examportal";

$con = mysqli_connect($host, $user, $pass, $db);

 if(!$con)
 {
     die("error detected".mysqli_error($con));
 }else{
    header("Location: return_tologin.html");
}


$name = $_POST['name'];
$lname = $_POST['lname'];
$age = $_POST['age'];
$phone = $_POST['phone'];
$dept = $_POST['dept'];
$address = $_POST['address'];
$state = $_POST['state'];
$city = $_POST['city'];
$email = $_POST['email'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$image = $_FILES['image']['tmp_name'];
$imgdata = addslashes(file_get_contents($image)); 

$sql = mysqli_query($con, "INSERT INTO teacherdetail(name, lname, age, phone, dept, address, state, city, email, username, pass, image)VALUES('$name','$lname','$age','$phone', '$dept', '$address', '$state', '$city', '$email', '$username', '$pass', '$imgdata')");

?>



