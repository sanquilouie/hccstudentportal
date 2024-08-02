<!DOCTYPE html>
<html>
<body>
  <?php

  session_start();
  error_reporting(0);
  if (!($_SESSION['role'] == 'Admin')) {
    header("Location: ../../index.php");
  }

  include '../../config.php';
  //import.php

  include '../../vendor/autoload.php';

include("../header.php");

  if (isset($_POST['import'])) {
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
    $address = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
    $contact = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
    $birthday = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
    $email = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
    $course = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
    $year = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
    $section = $worksheet->getCellByColumnAndRow(12, $row)->getValue();

    $birthday = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($birthday)->format('Y-m-d');

    // Check if the student already exists in the database
    $query = "SELECT * FROM students WHERE studentid = '$studentid'";
    $result = $conn->query($query);

    if ($result->num_rows == 0) {
      // Insert the student's data into the database
      $query = "INSERT INTO students (studentid, firstname, lastname, address, contact, birthday, email, course, year, section)
      VALUES ('$studentid', '$firstname', '$lastname', '$address', '$contact', '$birthday', '$email', '$course', '$year', '$section')";
      $conn->query($query);

      $query = "INSERT INTO users (userid,role) VALUES ('$studentid', 'Student')";
      $conn->query($query);
    }
  }

  // Close the database connection
  $conn->close();

  echo '<script type="text/javascript">setTimeout(function () {
    swal("Data Succesfully Uploaded!","","success");}, 200);</script>';
        }

  ?>
  <div class="container">
    <div class="h-100 d-flex align-items-center justify-content-center">
      <span id="message"></span>
      <form action="" method="post" enctype="multipart/form-data" class="row g-3">
        <div class="col-12 text-center">
          <h2><label class="form-label">Upload Users</label></h2>
          <input class="form-control" type="file" name="file" id="file">
          <br>
        <a href="../../assets/testfiles/egstudents.xlsx" class="btn btn-primary btn-sm"><i aria-hidden="true" download></i> Download Template</a></td>

        </div>
        <div class="d-grid gap-2">
          <input type="submit" name="import" id="import" class="btn btn-primary" value="Upload" />
        </div>
      </form>
    </div>
  </div>

  <?php
  include("../footer.php");
  ?>
</body>
</html>
