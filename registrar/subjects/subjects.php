<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Registrar')) {
  header("Location: ../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <?php
  include("../header.php");
  ?>
  
  <?php
  include("../footer.php");
  ?>
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
