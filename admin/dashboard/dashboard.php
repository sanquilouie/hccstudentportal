<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Admin')) {
  header("Location: ../../index.php");
}

if ($_SESSION['loggedin'] == '1') {
  echo '<script type="text/javascript">setTimeout(function () {
    swal("Welcome Super Admin","","success");}, 200);</script>';
  unset($_SESSION["loggedin"]);
}

$id = $_SESSION['theid'];
$username = $_SESSION['username'];
  $sql = "SELECT * FROM users";
  $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <?php
  include '../header.php'
  ?>
<div class="container p-4 mt-4">
    <div class="row text-center" >
      <div class="col">
        <a href="../announcement/announcement.php" class="btn btn-sq-lg btn-light mx-3 shadow mb-5 inbtn" id="btn-sq-lg">
          <i class="fa-solid fa-bullhorn fa-6x"></i><br/>
          <b><h5>Announcement</h5></b><br>
        </a>
        <a href="../faculty/faculty.php" class="btn btn-sq-lg btn-light mx-3 shadow mb-5" id="btn-sq-lg">
          <i class="fa-solid fa-user-tie fa-6x"></i><br/>
          <b><h5>Faculty</h5></b>
        </a>
        <a href="../students/students.php" class="btn btn-sq-lg btn-light mx-3 shadow mb-5" id="btn-sq-lg">
          <i class="fa-solid fa-user-graduate fa-6x"></i><br/>
          <b><h5>Student</h5></b>
        </a>
        <a href="../cashier/cashier.php" class="btn btn-sq-lg btn-light mx-3 shadow mb-5" id="btn-sq-lg">
        <i class="fa-solid fa-user-check fa-6x"></i><br/>
          <b><h5>Non-Teaching Staff</h5></b>
        </a>
        <a href="../registration/registration.php" class="btn btn-sq-lg btn-light mx-3 shadow mb-5" id="btn-sq-lg">
          <i class="fa-solid fa-file-pen fa-6x"></i><br/>
          <b><h5>Registration</h5></b>
        </a>
        <a href="../subjects/subjects.php" class="btn btn-sq-lg btn-light mx-3 shadow mb-5" id="btn-sq-lg">
          <i class="fa-solid fa-book fa-6x"></i><br/>
          <b><h5>Subjects</h5></b>
        </a>
        <a href="../upload/upload.php" class="btn btn-sq-lg btn-light mx-3 shadow mb-5" id="btn-sq-lg">
          <i class="fa-solid fa-upload fa-6x"></i><br/>
          <b><h5>Upload</h5></b>
        </a>
        <a href="../logs/logs.php" class="btn btn-sq-lg btn-light mx-3 shadow mb-5" id="btn-sq-lg">
        <i class="fa-solid fa-clock-rotate-left fa-6x"></i><br/>
          <b><h5>Logs</h5></b>
        </a>
        <a href="../schedule/index.php" class="btn btn-sq-lg btn-light mx-3 shadow mb-5" id="btn-sq-lg">
        <i class="fa-solid fa-calendar-days fa-6x"></i><br/>
          <b><h5>Schedule Generator</h5></b>
        </a>
      </div>
    </div>
</div>
  <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
  </script>
<nav class="navbar navbar-expand-lg fixed-bottom">
  <div class="container d-flex justify-content-between">
    <div class="collapse navbar-collapse justify-content-end" id="navbarScroll">
      <a href="logout.php" class="btn btn-primary btn-lg shadow mb-3">
        <i class="fa-solid fa-angles-left"></i>
        <b>Logout</b>
      </a>
    </div>
  </div>
</nav>
</body>
</html>
