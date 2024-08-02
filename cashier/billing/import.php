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
			$row[1] = str_replace(',', '.', $row[1]);
			$row[2] = str_replace(',', '.', $row[2]);
			$row[3] = str_replace(',', '.', $row[3]);
			$row[4] = str_replace(',', '.', $row[4]);
			$row[5] = str_replace(',', '.', $row[5]);
			$row[6] = str_replace(',', '.', $row[6]);
			$row[7] = str_replace(',', '.', $row[7]);
			$row[8] = str_replace(',', '.', $row[8]);
			$row[9] = str_replace(',', '.', $row[9]);
			$row[10] = str_replace(',', '.', $row[10]);
			$row[11] = str_replace(',', '.', $row[11]);
			$row[12] = str_replace(',', '.', $row[12]);
			$row[13] = str_replace(',', '.', $row[13]);
			$row[14] = str_replace(',', '.', $row[14]);

				$sql = "INSERT INTO billing (studentid, tuitionfee, learnandins, regfee, compprossfee, guidandcouns, schoolidfee, studenthand, schoolfab,
			insurance, totalass, discount, netass, cashcheckpay, balance)
      			VALUES ('$row[0]' , '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]', '$row[8]', '$row[9]', '$row[10]', '$row[11]', '$row[12]', '$row[13]', '$row[14]')";
      		$result = mysqli_query($conn, $sql);
		}
		$message = '<script type="text/javascript">setTimeout(function () {
	    swal("Succesfully Uploaded!","","success");}, 200);</script>';
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
