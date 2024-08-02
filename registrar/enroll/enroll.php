<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Registrar')) {
  header("Location: ../../index.php");
}

if (isset($_POST['subjectPop'])) {
  
}
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <?php
  include("../header.php");
  ?>
  
  <div class="container w-50 p-5">
    <form method="post" id="import_excel_enrollees" enctype="multipart/form-data">
        <div class="col pb-3">
          <span id="message"></span>
            <h3><label>Upload Students to Enroll: </label></h3>
            <input class="form-control" type="file" name="import_excel">   
        </div>
        <button type="submit" name="import" id="import" class="btn btn-primary">Import</button>
    </form>
  </div>

  <?php
  include("../footer.php");
  ?>
</body>
</html>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
$(document).ready(function () {
    $('#table').DataTable({
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'All'],
        ],
    });
});

</script>
