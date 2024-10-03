<?php
$host='localhost';
$user='root';
$password='';
$db='examportal';

$conn = new mysqli($host,$user,$password,$db);

if($conn->connection_error){
    die("Connection-Failed".$conn->connection_error);
}else{
    echo "connected";
}

?>