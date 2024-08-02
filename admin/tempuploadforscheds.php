<?php
if(isset($_POST['submit'])){
  $file = $_FILES['file']['tmp_name'];
  include '../vendor/autoload.php';
  $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
  $worksheet = $spreadsheet->getActiveSheet();
  $rows = $worksheet->toArray();

  include '../config.php';

  foreach($rows as $row){
    $studentid = $row[0];
    $course = $row[1];
    $year = $row[2];
    $section = $row[3];
    $sql = "SELECT 1 FROM students WHERE studentid='$studentid' LIMIT 1";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      $sql = "UPDATE students SET course='$course', year='$year', section='$section' WHERE studentid='$studentid' AND EXISTS (SELECT 1 FROM students WHERE studentid='$studentid' LIMIT 1)";
      $conn->query($sql);
      
      
    }
    
  }
  echo '<script language="javascript">';
    echo 'alert("Succesfully Updated.")';
    echo '</script>';
  $conn->close();
}
?>
<form method="post" enctype="multipart/form-data">
  <input type="file" name="file" id="file">
  <input type="submit" name="submit" value="Upload">
</form>
