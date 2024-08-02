<?php

$server = "localhost";
$user = "u584085915_hccportal";
$pass = "Sishccportal01";
$database = "u584085915_hccportal";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
  die("<script>alert('Connection Failed.')</script>");
}

?>
