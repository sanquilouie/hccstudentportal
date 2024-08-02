<?php
include '../../config.php';
//import.php

include '../../vendor/autoload.php';


if($_FILES["import_excel"]["name"] != '')
{
	$allowed_extension = array('xls', 'csv', 'xlsx');
	$file_array = explode(".", $_FILES["import_excel"]["name"]);
	$file_extension = end($file_array);
	if(in_array($file_extension, $allowed_extension))
	{
		$file_name = time() . '.' . $file_extension;
		move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
		$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

		$spreadsheet = $reader->load($file_name);

		unlink($file_name);

		$data = $spreadsheet->getActiveSheet()->toArray();
		foreach(array_slice($data,1) as $row)
		{
			$sql = "Select * from grades WHERE studentid = '$row[0]' AND code = '$row[4]'";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) == 1){
				$sql = "UPDATE grades SET
				studentid = '$row[0]',
				studentname = '$row[1]',
				schoolyear = '$row[2]',
				semester = '$row[3]',
				code = '$row[4]',
				subject = '$row[5]',
				faculty = '$row[6]',
				units = '$row[7]',
       	prelim = '$row[8]',
				midterm = '$row[9]',
       			finals = '$row[10]',
				finalgrades = '$row[11]',
				average = '$row[12]',
				status = '$row[13]'
				WHERE studentid = '$row[0]' AND code = '$row[4]'";
      			$result = mysqli_query($conn, $sql);
			}else{
				$sql = "INSERT INTO grades (studentid, studentname, schoolyear, semester, code, subject, faculty, units, prelim, midterm, finals, finalgrades, average, status)
      			VALUES ('$row[0]' , '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]', '$row[8]', '$row[9]', '$row[10]', '$row[11]', '$row[12]', '$row[13]')";
      		$result = mysqli_query($conn, $sql);
			  echo '<script>console.log("Insert")</script>';
			}
		}
		$message = '<script type="text/javascript">setTimeout(function () {
			swal("Succesfully Uploaded!","","success");});</script>';
	}
	else
	{
		$message = '<script type="text/javascript">setTimeout(function () {
      swal("Only .xls .csv or .xlsx file allowed","","error");}, 200);</script>';
	}
}
else
{
	$message = '<script type="text/javascript">setTimeout(function () {
		swal("Please Select a File First!","","error");}, 200);</script>';
}

echo $message;

?>
