
<?php
include '../../config.php';
//import.php

include '../../vendor/autoload.php';


// Get the uploaded file
$file = $_FILES['file']['tmp_name'];

// Load the Excel file into a PHP spreadsheet object
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file);
$spreadsheet = $reader->load($file);

// Get the first worksheet in the Excel file
$worksheet = $spreadsheet->getActiveSheet();


// Loop through each row in the worksheet and insert its data into the database
for ($row = 2; $row <= $worksheet->getHighestRow(); $row++) {
  $studentid = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
  $firstname = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
  $lastname = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
  $birthday = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
  $contact = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
  $course = $worksheet->getCellByColumnAndRow(10, $row)->getValue();

  // Check if the student already exists in the database
  $query = "SELECT * FROM students WHERE studentid = '$studentid'";
  $result = $conn->query($query);

  if ($result->num_rows == 0) {
    // Insert the student's data into the database
    $query = "INSERT INTO students (studentid, firstname, lastname, birthday, contact, course) VALUES ('$studentid', '$firstname', '$lastname', '$birthday', '$contact', '$course')";
    $conn->query($query);
  }
}

// Close the database connection
$conn->close();

echo "<script>
          swal({
            title: 'Success',
            text: 'Data uploaded successfully!',
            icon: 'success',
          }).then(function() {
            window.history.back();
          });
        </script>";

?>
