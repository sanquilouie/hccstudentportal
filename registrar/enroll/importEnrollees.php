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
			$sql = "INSERT INTO enrollees (code, subject, units, enrolleeid, section)
      			VALUES ('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]')";
      		$result = mysqli_query($conn, $sql);		
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
