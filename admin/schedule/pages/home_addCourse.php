<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
error_reporting(0);

include('../dist/includes/dbcon.php');

$abbrev = $_POST['abbrev'];
$degree = $_POST['degree'];

mysqli_query($con,"INSERT INTO courses(abbrev,course) 
				VALUES('$abbrev','$degree')")or die(mysqli_error());
				echo "<script type='text/javascript'>alert('Successfully added a Course!');</script>";	
?>
