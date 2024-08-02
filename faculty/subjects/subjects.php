<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Faculty' || $_SESSION['role'] == 'Scheduler')) {
  header("Location: ../../index.php");
}

if ($_SESSION['loggedin'] == '1') {
  echo '<script type="text/javascript">setTimeout(function () {
    swal("Welcome Admin","","success");}, 200);</script>';
    unset($_SESSION["loggedin"]);
  }
  $facultyID = $_SESSION['theid'];
  $sql = "SELECT * FROM subjects WHERE facultyid = '$facultyID'";
  $result = mysqli_query($conn, $sql);
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <body>
  <?php
  include("../header.php");
  ?>
  <div class="container p-5 mt-5">
    <div class="row">
      <div class="col">
        <?php
          if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
              echo '
              <a href="../students/students.php?subjectcode=' . $row['code'] . '" class="btn btn-sq-lg btn-light mx-3 shadow mb-5" id="btn-sq-lg">
              <b><h4 class="mt-5 fw-bold">'.$row['subject'].'</h4></b><br>
            </a>';
            }
          }
        ?>
      </div>
    </div>
  </div>
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
