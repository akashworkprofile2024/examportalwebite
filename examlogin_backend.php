<?php

$con=mysqli_connect("localhost","root","","examportal");
// echo 'connected';

session_start();

$username=$_POST['username'];
$password=$_POST['password'];





$sql="SELECT * FROM studentdetail WHERE username='$username'";
$store=$con->query($sql);
$row=mysqli_fetch_assoc($store);

$checkuid=$row['uid'];
$checkname=$row['name'];
$checkuser=$row['username'];
$checkpass=$row['pass'];
$checkdept=$row['dept'];
$checklname=$row['lname'];
$checkexamstatus=$row['examstatus'];


$_SESSION['uid']=$checkuid;
$_SESSION['dept']=$checkdept;
$_SESSION['username']=$checkuser;
$_SESSION['name']=$checkname;
$_SESSION['lname']=$checklname;


$resultsql="SELECT * FROM result";
$resultstore=$con->query($resultsql);
$result_table=mysqli_fetch_assoc($resultstore);

$resultstatus=$result_table['examstatus'];



if($username==$checkuser && $password==$checkpass){
    //  header('location:startexam.php'); 
     if($checkexamstatus=='given'){
        echo "<script>";
        echo "window.alert('Exam Already Given')";
        echo "</script>";
        
        echo "<script>";
        echo "window.location.href='examlogin.php'"; 
        echo"</script>";
     }else{
       header('location:startexam.php'); 
             
     }
}else{
    echo "<script>";
    echo "window.alert('user not found')";
    echo "</script>";

    echo "<script>";
    echo "window.location.href='examlogin.php'"; 
    echo"</script>";
}



?>