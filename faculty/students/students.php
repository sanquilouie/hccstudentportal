<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Faculty' || $_SESSION['role'] == 'Scheduler')) {
  header("Location: ../../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<body>
  <?php
    include("../header.php");
  ?>
  <div class="container-fluid w-100">
    <div class="row mt-5">
        <form method="POST">
          <div class="row gx-3 mb-3 p-3">
          <table class="table table-striped table-primary table-hover p-2" id="table" style="table-layout:fixed;">
          <thead>
            <tr>
            <th scope="col" style="width: 50px;">Student ID</th>
            <th scope="col" style="width: 200px;">Student Name</th>
            <th scope="col" style="width: 300px;">Subject</th>
            <th scope="col" style="width: 30px;">Units</th>
            <th scope="col" style="width: 30px;">Prelim</th>
            <th scope="col" style="width: 30px;">Midterm</th>
            <th scope="col" style="width: 30px;">Finals</th>
            <th scope="col" style="width: 30px;">Final Grade</th>
            <th scope="col" style="width: 30px;">Average</th>
            <th scope="col" style="width: 50px;">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $faculty = $_SESSION['username'];
            $facultyid = $_SESSION['theid'];
            $subjectcode = $_GET['subjectcode'];
            if (isset($_GET['subjectcode'])) {
             $sql = "SELECT * FROM grades where facultyid = '$facultyid' AND code = '$subjectcode'";
             //echo $sql;
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0) {
              echo '<script type="text/javascript">setTimeout(function () {
                swal("Nothing found in Database.","","error");}, 200);</script>';
              }
            if ($result->num_rows > 0) {
              while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['studentid']."</td>";
                echo "<td>".$row['studentname']."</td>";
                echo "<td>".$row['subject']."</td>";
                echo "<td>".$row['units']."</td>";
                echo "<td>".$row['prelim']."</td>";
                echo "<td>".$row['midterm']."</td>";
                echo "<td>".$row['finals']."</td>";
                echo "<td>".$row['finalgrades']."</td>";
                echo "<td>".$row['average']."</td>";
                echo "<td>".$row['status']."</td>";
                echo "</tr>";
              }
            }
            } else {
            $sql = "SELECT * FROM grades where facultyid = '$facultyid'";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0) {
              echo '<script type="text/javascript">setTimeout(function () {
                swal("Nothing found in Database.","","error");}, 200);</script>';
              }
            if ($result->num_rows > 0) {
              while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['studentid']."</td>";
                echo "<td>".$row['studentname']."</td>";
                echo "<td>".$row['subject']."</td>";
                echo "<td>".$row['units']."</td>";
                echo "<td>".$row['prelim']."</td>";
                echo "<td>".$row['midterm']."</td>";
                echo "<td>".$row['finals']."</td>";
                echo "<td>".$row['finalgrades']."</td>";
                echo "<td>".$row['average']."</td>";
                echo "<td>".$row['status']."</td>";
                echo "</tr>";
              }
            }
            }

            ?>
          </tbody>
        </table>
          </div>
        </form>
    </div>
  </div>
<?php
include '../footer.php'
?>
</body>
</html>
<script>

$(document).ready(function () {

  $('#table').DataTable({
      lengthMenu: [
          [5, 10, 20, -1],
          [5, 10, 20, 'All'],
      ],
  });
});
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}


</script>
