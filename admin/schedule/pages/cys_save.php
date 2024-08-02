
 <?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

if($_POST)
{
include('../dist/includes/dbcon.php');

	$course = $_POST['add_course'];
	$year = $_POST['add_year'];
	$section = $_POST['add_section'];			
					
	
			mysqli_query($con,"INSERT INTO cys(course,year,section) 
				VALUES('$course','$year','$section')")or die(mysqli_error());
				
				echo "<script type='text/javascript'>alert('Successfully added a Section!');</script>";	
				echo "<script>document.location='mainte_sched.php'</script>";
	
}					  
	
?>