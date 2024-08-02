<?php
include '../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Admin')) {
  header("Location: ../index.php");
}

$id = $_SESSION['theid'];
$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<body>
<?php
include("header.php");
?>
<div class="container p-5">
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="justify-content: center;">
      <button class="nav-link active fs-4" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Faculty</button>
      <button class="nav-link fs-4" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Students</button>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
    <form action="" method="POST">
      <div class="col-md pt-2">
        <table class="table table-striped table-dark table-hover p-2" id="table2">
          <thead>
            <tr>
              <th scope="col">Faculty ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Department</th>
              <th scope="col">Email</th>
              <th scope="col">Contact</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM faculty";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0) {
              echo '<script type="text/javascript">setTimeout(function () {
                swal("Nothing found in Database.","","error");}, 200);</script>';
              }
            if ($result->num_rows > 0) {
              while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['facultyid']."</td>";
                echo "<td>".$row['firstname']."</td>";
                echo "<td>".$row['lastname']."</td>";
                echo "<td>".$row['department']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['contact']."</td>";
                echo '<td>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal'.$row['subjectid'].'"> Update</button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal'.$row['subjectid'].'"> Delete</button>
                </td>';
                
                echo "</tr>";
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </form>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
    <form action="" method="POST">
      <div class="col-md pt-2">
        <table class="table table-striped table-dark table-hover p-2" id="table">
          <thead>
            <tr>
              <th scope="col">Student ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Course</th>
              <th scope="col">Year</th>
              <th scope="col">Section</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM students";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0) {
              echo '<script type="text/javascript">setTimeout(function () {
                swal("Nothing found in Database.","","error");}, 200);</script>';
              }
            if ($result->num_rows > 0) {
              while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['studentid']."</td>";
                echo "<td>".$row['firstname']."</td>";
                echo "<td>".$row['lastname']."</td>";
                echo "<td>".$row['course']."</td>";
                echo "<td>".$row['year']."</td>";
                echo "<td>".$row['section']."</td>";
                echo "</tr>";
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
  include("footer.php");
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
$(document).ready(function () {
    $('#table2').DataTable({
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
