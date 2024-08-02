<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Admin')) {
  header("Location: ../../index.php");
}

// retrieve data from database
$query = "SELECT CONCAT(course, year, section) AS id_text FROM cys";
$result1 = mysqli_query($conn, $query);

// format data as array for Select2
$data = array();
while ($row1 = mysqli_fetch_assoc($result1)) {
    $data[] = array(
        'id' => $row1['id_text'],
        'text' => $row1['id_text']
    );
}

// encode data as JSON for Select2
$json_data = json_encode($data);

if (isset($_GET['studentid'])) {
  $sql = "SELECT * FROM students where studentid = ".$_GET['studentid'];
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);

  }
}

/** STUDENT UPDATE */
if(isset($_POST['studentUpdate'])) {
  $components = explode('-', $_POST['txtcourse']);

  $txtstudentid = $_POST['txtstudentid'];
  $txtstudentfname = $_POST['txtstudentfname'];
  $txtstudentlname = $_POST['txtstudentlname'];
  $txtaddress = $_POST['txtaddress'];
  $txtstudentcontact = $_POST['txtstudentcontact'];
  $txtbirthdate = $_POST['txtbirthdate'];
  $txtstudentemail = $_POST['txtstudentemail'];
  $txtcourse = $components[0];
  $txtyear = $components[1];
  $txtsection = $components[2];;

    $sql = "UPDATE students SET
    firstname = '$txtstudentfname',
    lastname  = '$txtstudentlname',
    address   = '$txtaddress',
    contact   = '$txtstudentcontact',
    birthday  = '$txtbirthdate',
    email     = '$txtstudentemail',
    course    = '$txtcourse',
    year      = '$txtyear',
    section   = '$txtsection' WHERE studentid = '$txtstudentid'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
      echo '<script type="text/javascript">setTimeout(function () {
        swal("Student Information Succesfully Updated","","success");}, 200);
        </script>';
      header("Refresh:1");
    } else {
      echo '<script type="text/javascript">setTimeout(function () {
        swal("Something went wrong, Please try again.","","error");}, 200);</script>';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <?php
    include("../header.php");
  ?>
  <div class="container p-5">
<form action="" method="POST">
<div class="row pb-3 pt-3">
  <div class="col-md">
    <label class="fw-bold">Student ID: </label>
    <input type="number" name="txtstudentid" class="form-control" placeholder="User ID" value="<?php echo $row["studentid"] ?>" onkeydown="return event.keyCode !== 69" readOnly/>
  </div>
  <div class="col-md">
    <label class="fw-bold">First Name: </label>
    <input onkeydown="return /[a-z, ]/i.test(event.key)" type="text" name="txtstudentfname" class="form-control" placeholder="First Name" value="<?php echo $row["firstname"] ?>" required/>
  </div>
  <div class="col-md">
    <label class="fw-bold">Last Name:</label>
    <input onkeydown="return /[a-z, ]/i.test(event.key)" type="text" name="txtstudentlname" class="form-control" placeholder="Last Name" value="<?php echo $row["lastname"] ?>" required/>
  </div>
</div>
<div class="col-md pb-3">
  <label class="fw-bold">Address: </label>
  <input type="text" name="txtaddress" class="form-control" placeholder="Address" value="<?php echo $row["address"] ?>" onkeydown="return event.keyCode !== 69" required/>
</div>
<div class="row pb-3">
  <div class="col-md">
      <label class="fw-bold">Email: </label>
      <input type="email" name="txtstudentemail" class="form-control" placeholder="Email" value="<?php echo $row["email"] ?>" required/>
  </div>
  <div class="col-md">
      <label class="fw-bold">Contact Number: </label>
      <input type="number" name="txtstudentcontact" class="form-control" placeholder="Contact Number" value="<?php echo $row["contact"] ?>" onkeydown="return event.keyCode !== 69" required/>
  </div>
  <div class="col-md">
      <label class="fw-bold">Birthdate: </label>
      <input type="date" name="txtbirthdate" class="form-control" placeholder="Birthdate" value="<?php echo $row["birthday"] ?>" onkeydown="return event.keyCode !== 69" required/>
  </div>
</div>
<div class="row pb-3">
  <div class="col-md">
    <label class="fw-bold">Section: </label>
      <select id="addDept" name="txtcourse" class="form-control js-select2" required>
      <option selected value="<?php echo $row["course"].'-'.$row["year"].'-'.$row["section"] ?>"><?php echo $row["course"].$row["year"].$row["section"] ?></option>
      </select>
  </div>
</div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="window.location.href='students.php'">Cancel</button>
      <button type="submit" name="studentUpdate" class="btn btn-primary">Update</button>
    </div>
</form>
</form>
</div>
<script>
        $(document).ready(function() {
            // initialize Select2
            $('.js-select2').select2({
                data: <?php echo $json_data; ?>
            });
        });
    </script>

