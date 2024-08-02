<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
if($_POST)
{
include('../dist/includes/dbcon.php');
$id=$_REQUEST['hiddenID'];
$course=$_REQUEST['update_course'];
$year=$_REQUEST['update_year'];
$section=$_REQUEST['update_section'];
	
	mysqli_query($con,"update cys set course='$course',year='$year',section='$section' where id='$id'")or die(mysqli_error());
	echo "<script type='text/javascript'>alert('Successfully updated a section!');</script>";	
	echo "<script>document.location='mainte_sched.php'</script>";  
}	
	
?>
