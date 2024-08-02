<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
if($_POST)
{
include('../dist/includes/dbcon.php');
$id=$_REQUEST['id'];
$sy=$_REQUEST['sy'];
	
	mysqli_query($con,"update sy set sy='$sy' where sy_id='$id'")or die(mysqli_error());
	echo "<script type='text/javascript'>alert('Successfully updated a room!');</script>";	
	echo "<script>document.location='mainte_sy.php'</script>";  
}	
	
?>
