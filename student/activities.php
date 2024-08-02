<?php
include '../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Student')) {
  header("Location: ../index.php");
}

$id = $_SESSION['theid'];
$username = $_SESSION['username'];

$sql = "SELECT * FROM activities ORDER BY eventid DESC LIMIT 4";
$result = mysqli_query($conn, $sql);



?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>HCC PORTAL</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../assets/style.css">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css"/>
<script src="../assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
</head>
<body>
  <?php
    include("header.php");
  ?>
<div class="container w-75">
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="image/mainbg.jpg" height="450" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Holy Cross Events</h5>
          <p class="mb-0">The Holy Cross College, Sta. Rosa in her sixty years of existence has been a legacy of the late Rt. Rev. Fr. Fernando C. Lansangan. Msgr. Lansangan was parish priest of St. Rose of Lima Parish and great and vulnerable founder of this prestigious learning institution</p>
        </div>
      </div>
      <?php
      if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
          $showimage = "../image/".$row['image'];
      echo "<div class='carousel-item'>";
      echo "<img src='$showimage' height='450' class='d-block w-100' alt='...'>";
      echo "<div class='carousel-caption d-none d-md-block'>";
      echo "<h5>".$row['title']."</h5>";
      echo "<p class='mb-0'>".$row['caption']."</p>";
      echo "</div>";
      echo "</div>";
    }
    }else{
      echo "Some error";
    }
      ?>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
</body>
</html>
