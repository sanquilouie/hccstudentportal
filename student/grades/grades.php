<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Student')) {
  header("Location: ../../index.php");
}

$id = $_SESSION['theid'];
$username = $_SESSION['username'];
if(isset($_POST['submit'])) {
  $schoolyear = $_POST['schoolyear'];
  $semester = $_POST['semester'];
  $sql = "SELECT * FROM grades WHERE studentid='$id' AND schoolyear='$schoolyear' AND semester='$semester'";
  $result = mysqli_query($conn, $sql);
  //echo $sql;
}
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="refresh" content="5000;url=../logout.php" />
<body>
  <?php
    include("../header.php");
  ?>
    <div class="container p-5">
          <form method="POST">
            <div class="row mb-3">
            <div class="col-md-2">
              <select name="schoolyear" class="form-select" required>
                <option value="" selected  style="color:red">School Year</option>
                <option >2019/2020</option>
                <option>2020/2021</option>
                <option>2021/2022</option>
                <option>2022/2023</option>
              </select>
            </div>
            <div class="col-md-2">
              <select name="semester" class="form-select" required>
                <option value="" selected  style="color:green">Semester</option>
                <option>First</option>
                <option>Second</option>
              </select>
            </div>
            <div class="col-md-2">
              <button name="submit" type="submit" class="btn btn-primary">Search</button>
            </div>
            </div>
          
            <table class="table table-striped table-primary">
              <thead>
                <tr>
                  <th scope="col">Subject</th>
                  <th scope="col">Faculty Name</th>
                  <th scope="col">Units</th>
                  <th scope="col">Prelim</th>
                  <th scope="col">Midterm</th>
                  <th scope="col">Finals</th>
                  <th scope="col">Final Grade</th>
                  <th scope="col">Average</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                      echo "<tr>";
                      echo "<td>".$row['subject']."</td>";
                      echo "<td>".$row['faculty']."</td>";
                      echo "<td>".$row['units']."</td>";
                      echo "<td>".$row['prelim']."</td>";
                      echo "<td>".$row['midterm']."</td>";
                      echo "<td>".$row['finals']."</td>";
                      echo "<td>".$row['finalgrades']."</td>";
                      echo "<td>".$row['average']."</td>";
                      echo "<td>".$row['status']."</td>";
                      echo "</tr>";
                  }
                  } else {
                      echo "<tr>";
                      echo "<td colspan='9'>";
                      echo "<center>No Data Found.</center>";
                      echo "</td>";
                      echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
          </form>
    <?php
    include '../footer.php'
    ?>
  
  <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
  </script>
</body>
</html>
