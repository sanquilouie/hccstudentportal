<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Student')) {
  header("Location: ../../index.php");
}

$id = $_SESSION['theid'];
$sql = "SELECT * FROM students WHERE studentid='$id'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
  $row = mysqli_fetch_assoc($result);
  $_SESSION['username'] = $row['lastname'] . ', ' . $row['firstname'];
  $showimage = "../../assets/images/" . $row['picture'];
}

if (isset($_POST['imageValue'])) {
  echo '<script>console.log("Your stuff here")</script>';
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];
  $folder = "../assets/images/" . $filename;

  if (empty($filename)) {
    $tempname = $_POST["imageValue"];
    $filename = str_replace('../assets/images/', '', $tempname);
  }

  $username = $_POST['username'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $birthdate = $_POST['birthdate'];
  $tel = $_POST['tel'];
  $address = $_POST['address'];
  $course = $_POST['course'];
  $year = $_POST['year'];
  $section = $_POST['section'];


  $sql = "UPDATE users SET picture = '$filename', username = '$username', lastname = '$lastname', email = '$email',
  birthdate = '$birthdate', tel = '$tel', address = '$address', course = '$course', year = '$year', section = '$section'
  WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
  move_uploaded_file($tempname, $folder);
  if ($result) {
    echo '<script type="text/javascript">setTimeout(function () {
      swal("Profile Picture Updated Succesfully!","","success");}, 200);</script>';
    header("Refresh:1");
  } else {
    echo '<script type="text/javascript">setTimeout(function () {
        swal("Something went wrong!","","error");}, 200);</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="refresh" content="5000;url=../logout.php" />
<body>
  <?php
  include("../header.php");
  ?>
  <div class="container w-75 p-5">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row mb-2 fs-5">
              <div class="col">
                <label class="small mb-1 fw-bold">First name</label>
                <input name="username" class="form-control fs-5" type="text" value="<?php echo $row['firstname']; ?>" readOnly>
              </div>
              <div class="col">
                <label class="small mb-1 fw-bold">Last name</label>
                <input name="lastname" class="form-control fs-5" type="text" value="<?php echo $row['lastname']; ?>" readOnly>
              </div>
            </div>
            <div class="col mb-2 fs-5">
              <label class="small mb-1 fw-bold" for="inputAddress">Address</label>
              <input name="address" class="form-control fs-5" type="address" value="<?php echo $row['address']; ?>" readOnly>
            </div>

            <div class="row mb-2 fs-5">
              <div class="col">
                <label class="small mb-1 fw-bold" for="inputPhone">Phone number</label>
                <input name="tel" class="form-control fs-5" type="tel" value="<?php echo $row['contact']; ?>" readOnly>
              </div>
              <div class="col">
                <label class="small mb-1 fw-bold" for="inputBirthday">Birthday</label>
                <input class="form-control fs-5" type="text" name="birthdate" value="<?php echo $row['birthday']; ?>" readOnly>
              </div>
            </div>
            <div class="row mb-2 fs-5">
            <div class="col">
                <label class="small mb-1 fw-bold" for="inputEmail">Email Address</label>
                <input name="email" class="form-control fs-5" type="email" value="<?php echo $row['email']; ?>" readOnly>
              </div>
              <div class="col">
                <label class="form-label fw-bold">Course, Year & Section</label>
                <input name="course" type="text" class="form-control fs-5" value="<?php echo $row['course']; ?>" readOnly>
              </div>
            </div>
        </form>
  </div>
 <?php
    include '../footer.php'
 ?>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

</html>
