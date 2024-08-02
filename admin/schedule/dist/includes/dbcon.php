<?php

$server = "localhost";
$user = "u584085915_hccportal";
$pass = "Sishccportal01";
$database = "u584085915_hccportal";

$con = mysqli_connect($server, $user, $pass, $database);

if (!$con) {
  die("<script>alert('Connection Failed.')</script>");
}

?>
