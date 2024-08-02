<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Registrar')) {
  header("Location: ../../index.php");
}

if ($_SESSION['loggedin'] == '1') {
  echo '<script type="text/javascript">setTimeout(function () {
    swal("Welcome Registrar","","success");}, 200);</script>';
  unset($_SESSION["loggedin"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <?php
  include("../header.php");
  include("showModal.php");
  ?>
  <div class="col">
    <button type="button" class="p-3 position-absolute top-25 start-0 btn btn-lg btn btn-secondary rounded-circle ms-2" data-bs-toggle="modal" data-bs-target="#showModal" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;"><i class="fa-solid fa-bullhorn fa-2x"></i></button>
  </div>
  <div class="container p-5 mt-5 ">
    <div class="row text-center">
      <div class="col">
        <a href="../enroll/enroll.php" class="btn btn-sq-lg btn-light mx-3 shadow mb-5" id="btn-sq-lg">
        <i class="fa-solid fa-file-circle-check fa-6x"></i><br/>
          <b><h5>Enroll Subjects</h5></b>
        </a>
        <!-- <a href="../subjects/subjects.php" class="btn btn-sq-lg btn-light mx-3 shadow mb-5" id="btn-sq-lg">
        <i class="fa-solid fa-book-open-reader fa-6x"></i><br/>
          <b><h5>Subjects View</h5></b>
        </a> -->
      </div>
    </div>
  </div>
    <nav class="navbar navbar-expand-lg fixed-bottom">
      <div class="container d-flex justify-content-between">
        <div class="collapse navbar-collapse justify-content-end" id="navbarScroll">
          <a href="../logout.php" class="btn btn-primary btn-lg shadow mb-3">
            <i class="fa-solid fa-angles-left"></i>
            <b>Logout</b>
          </a>
        </div>
      </div>
    </nav>
</body>
</html>
<script>
  $(document).ready(function () {
  $('#showModal').find('.carousel-item').first().addClass('active');
});
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
