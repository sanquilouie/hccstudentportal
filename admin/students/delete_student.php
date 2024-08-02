<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Admin')) {
  header("Location: ../../index.php");
}
 /** STUDENT DELETE  */
  $result = mysqli_query($conn, "DELETE FROM students WHERE studentid='".$_POST['studentid']."'");
  $result = mysqli_query($conn, "DELETE FROM users WHERE userid='".$_POST['studentid']."'");

  if ($result) {
    echo '<script type="text/javascript">setTimeout(function () {
      swal("Student Succesfully Removed!","","success");}, 200);
      </script>';
    header("Refresh:1");
  } else {
    echo '<script type="text/javascript">setTimeout(function () {
      swal("Something went wrong, Please try again.","","error");}, 200);</script>';
      header("Refresh:1");
  }

?>