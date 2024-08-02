<?php
include '../config.php';
session_start();
error_reporting(0);

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $role=$_GET['user'];
}

$sql = "DELETE FROM users WHERE id='$id'";
 $result = mysqli_query($conn, $sql);
 if($result && $role == "student"){
     header('location:studentmembers.php?m=1');
 }else if($result && $role == "faculty"){
    header('location:facultymembers.php?m=1');
 }
?>
