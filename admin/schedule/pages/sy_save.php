<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

if($_POST)
{
    include('../dist/includes/dbcon.php');
    $sy = $_POST['sy'];			
    mysqli_query($con,"INSERT INTO sy(sy) VALUES('$sy')")or die(mysqli_error());	
    echo "<script type='text/javascript'>alert('Successfully added a school year!');</script>";	
	echo "<script>document.location='mainte_sy.php'</script>"; 
}   
					  
	
?>