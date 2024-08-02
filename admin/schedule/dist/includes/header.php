<?php
if (!($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Scheduler' )) {
  header("Location: ../../index.php");
};
date_default_timezone_set("Asia/Manila"); 

if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Scheduler')
  include('../dist/includes/header_admin.php');
else
  include('../dist/includes/header_faculty.php');
?>


