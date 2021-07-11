<?php
session_start();
$con = $_SESSION['id'];
$connect = mysqli_connect("localhost", "root", "", "rtemployee");
$query = "DELETE FROM `emp` WHERE `contact` = '$con'";
$result = mysqli_query($connect, $query); 
mysqli_close($connect);
header('location:delete.php');
?>