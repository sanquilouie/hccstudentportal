<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Admin')) {
  header("Location: ../../index.php");
}

$id = $_SESSION['theid'];
$username = $_SESSION['username'];

  if (isset($_POST['facultyReg'])) {
    $txtfacultyid = $_POST['txtfacultyid'];
    $txtstaff = $_POST['txtstaff'];
    $txtfname = $_POST['txtfname'];
    $txtlname = $_POST['txtlname'];
    $txtemail = $_POST['txtemail'];
    $txtcontact = $_POST['txtcontact'];
    $txtpassword = md5("pass");

    $result = mysqli_query($conn, "SELECT * FROM users WHERE userid='$txtfacultyid'");

    if (!$result->num_rows > 0) {
      $result = mysqli_query($conn, "INSERT INTO users (userid, password, role) 
        VALUES ('$txtfacultyid', '$txtpassword', '$txtstaff')");
      $result = mysqli_query($conn, "INSERT INTO faculty (facultyid, firstname, lastname, email, contact, role) 
        VALUES ('$txtfacultyid', '$txtfname', '$txtlname', '$txtemail', '$txtcontact', '$txtstaff')");
      if ($result) {
        $userLog = $_SESSION['role'];
      	$actionLog = "Succesfully Registered a Faculty Member with ID #: ".$txtfacultyid;
      	$logPop = mysqli_query($conn, "INSERT INTO logs (user, action) 
        VALUES ('$userLog', '$actionLog')");
        echo '<script type="text/javascript">setTimeout(function () {
          swal("Staff Member Succesfully Registered!","","success");}, 200);</script>';
      } else {
          echo '<script type="text/javascript">setTimeout(function () {
            swal("Something went wrong, Please try again.","","error");}, 200);</script>';
       }
    } else {
          echo '<script type="text/javascript">setTimeout(function () {
            swal("Staff ID Already Exist. Please Try Again.","","error");}, 200);</script>';
   }
  }

  if (isset($_POST['studentReg'])) {
    $txtstudentid = $_POST['txtstudentid'];
    $txtstudentfname = $_POST['txtstudentfname'];
    $txtstudentlname = $_POST['txtstudentlname'];
    $txtaddress = $_POST['txtaddress'];
    $txtstudentcontact = $_POST['txtstudentcontact'];
    $txtbirthdate = $_POST['txtbirthdate'];
    $txtstudentemail = $_POST['txtstudentemail'];
    $txtcourse = $_POST['txtcourse'];
    //$txtyear = $_POST['txtyear'];
    //$txtsection = $_POST['txtsection'];
    $txtpassword = md5("pass");

    $result = mysqli_query($conn, "SELECT * FROM users WHERE userid='$txtstudentid'");

    if (!$result->num_rows > 0) {
      $result = mysqli_query($conn, "INSERT INTO users (userid, password, role) 
        VALUES ('$txtstudentid', '$txtpassword', 'Student')");
      $result = mysqli_query($conn, "INSERT INTO students (studentid, firstname, lastname, address, contact, birthday, email, course) 
        VALUES ('$txtstudentid', '$txtstudentfname', '$txtstudentlname', '$txtaddress', '$txtstudentcontact', '$txtbirthdate', '$txtstudentemail', '$txtcourse')");
      if ($result) {
        $userLog = $_SESSION['role'];
      	$actionLog = "Succesfully Registered a Student Member with ID #: ".$txtstudentid;
      	$logPop = mysqli_query($conn, "INSERT INTO logs (user, action) 
        VALUES ('$userLog', '$actionLog')");
        echo '<script type="text/javascript">setTimeout(function () {
          swal("Student Succesfully Registered!","","success");}, 200);</script>';
      } else {
          echo '<script type="text/javascript">setTimeout(function () {
            swal("Something went wrong, Please try again.","","error");}, 200);</script>';
       }
    } else {
          echo '<script type="text/javascript">setTimeout(function () {
            swal("Student ID Already Exist. Please Try Again.","","error");}, 200);</script>';
   }
  }
?>
<!DOCTYPE html>
<html lang="en">
<body>
<?php
  include '../header.php'
  ?>
<div class="container w-75 p-5">
  <nav>
    <div class="nav nav-tabs fs-4" id="nav-tab" role="tablist" style="justify-content: center;">
    <button class="nav-link active" id="nav-faculty-tab" data-bs-toggle="tab" data-bs-target="#nav-faculty" type="button" role="tab" aria-controls="nav-faculty" aria-selected="true">Staff</button>
      <button class="nav-link" id="nav-student-tab" data-bs-toggle="tab" data-bs-target="#nav-student" type="button" role="tab" aria-controls="nav-student" aria-selected="false">Students</button>
    </div>
  </nav>
  <div class="tab-content">
    <div class="tab-pane fade show active" id="nav-faculty" role="tabpanel" aria-labelledby="nav-faculty-tab" tabindex="0">
      <form action="" method="POST">
        <div class="row  pb-3 pt-3">
          <div class="col-md">
            <label class="fw-bold">Employee ID: </label>
            <input type="number" name="txtfacultyid" class="form-control" placeholder="User ID" value="" onkeydown="return event.keyCode !== 69" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">Staff: </label>
              <select name="txtstaff" class="form-select" required>
                <option value="">-- Select a Staff --</option>
                <option value="Faculty">Faculty</option>
                <option value="Cashier">Cashier</option>
                <option value="Registrar">Registrar</option>
                <option value="Scheduler">Scheduler</option>
              </select>
          </div>
        </div>
        
        <div class="row pb-3">
          <div class="col-md">
            <label class="fw-bold">First Name: </label>
            <input onkeydown="return /[a-z, ]/i.test(event.key)" type="text" name="txtfname" class="form-control" placeholder="First Name" value="" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">Last Name:</label>
            <input onkeydown="return /[a-z, ]/i.test(event.key)" type="text" name="txtlname" class="form-control" placeholder="Last Name" value="" required/>
          </div>
        </div>
        <div class="row pb-3">
          <div class="col-md">
              <label class="fw-bold">Email: </label>
              <input type="email" name="txtemail" class="form-control" placeholder="Email" value="" required/>
          </div>
          <div class="col-md">
              <label class="fw-bold">Contact Number: </label>
              <input type="number" name="txtcontact" class="form-control" placeholder="Contact Number" value="" onkeydown="return event.keyCode !== 69" required/>
          </div>
        </div>
        
        <div class="col-md text-center pt-3"> 
            <button class="btn btn-primary btn-lg" type="submit" name="facultyReg" id="register">Register</button>
        </div>
      </form>
    </div>
    <div class="tab-pane fade" id="nav-student" role="tabpanel" aria-labelledby="nav-student-tab" tabindex="0">
      <form action="" method="POST">
        <div class="row pb-3 pt-3">
          <div class="col-md">
            <label class="fw-bold">Student ID: </label>
            <input type="number" name="txtstudentid" class="form-control" placeholder="User ID" value="" onkeydown="return event.keyCode !== 69" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">First Name: </label>
            <input onkeydown="return /[a-z, ]/i.test(event.key)" type="text" name="txtstudentfname" class="form-control" placeholder="First Name" value="" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">Last Name:</label>
            <input onkeydown="return /[a-z, ]/i.test(event.key)" type="text" name="txtstudentlname" class="form-control" placeholder="Last Name" value="" required/>
          </div>
        </div>
        <div class="col-md pb-3">
          <label class="fw-bold">Address: </label>
          <input type="text" name="txtaddress" class="form-control" placeholder="Address" value="" onkeydown="return event.keyCode !== 69" required/>
        </div>
        <div class="row pb-3">
          <div class="col-md">
              <label class="fw-bold">Email: </label>
              <input type="email" name="txtstudentemail" class="form-control" placeholder="Email" value="" required/>
          </div>
          <div class="col-md">
              <label class="fw-bold">Contact Number: </label>
              <input type="number" name="txtstudentcontact" class="form-control" placeholder="Contact Number" value="" onkeydown="return event.keyCode !== 69" required/>
          </div>
          <div class="col-md">
              <label class="fw-bold">Birthdate: </label>
              <input type="date" name="txtbirthdate" class="form-control" placeholder="Birthdate" value="" onkeydown="return event.keyCode !== 69" required/>
          </div>
        </div>
        <div class="row pb-3">
          <div class="col-md">
            <label class="fw-bold">Course, Year & Section</label>
              <select id="addDept" name="txtcourse" class="form-control" required>
              <option value="">-- Course, Year & Section -- </option>
                    <?php
                      $sql = "SELECT * FROM cys";
                      
                      $result1 = mysqli_query($conn, $sql);
                        if ($result1->num_rows > 0) {
                          while ($row1 = mysqli_fetch_array($result1)) {
                            echo '<option value="'.$row1["course"].''.$row1["year"].''.$row1["section"].'">'.$row1["course"].''.$row1["year"].''.$row1["section"].'</option>';
                           }
                        }
                  ?>  
              </select>
          </div>
          <!--<div class="col-md">
              <label class="fw-bold">Year: </label>
              <select name="txtyear" class="form-select" required>
                <option value="">-- Select a Year --</option>
                <option value="First Year">First Year</option>
                <option value="Second Year">Second Year</option>
                <option value="Third Year">Third Year</option>
                <option value="Fourth Year">Fourth Year</option>
              </select>
            </div>
            <div class="col-md">
              <label class="fw-bold">Section:</label>
              <input type="text" name="txtsection" class="form-control" placeholder="Section" value="" required/>
            </div>-->
        </div>
        <div class="col-md text-center pt-3"> 
            <button class="btn btn-primary btn-lg" type="submit" name="studentReg" id="register">Register</button>
        </div>
      </form>
    </div> 
    <div class="tab-pane fade" id="nav-cashier" role="tabpanel" aria-labelledby="nav-cahier-tab" tabindex="0">
      <form action="" method="POST">
        <div class="col-md pb-3 pt-3">
          <label class="fw-bold">Faculty ID: </label>
          <input type="number" name="txtfacultyid" class="form-control" placeholder="User ID" value="" onkeydown="return event.keyCode !== 69" required/>
        </div>
        <div class="row pb-3">
          <div class="col-md">
            <label class="fw-bold">First Name: </label>
            <input type="text" name="txtfname" class="form-control" placeholder="First Name" value="" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">Last Name:</label>
            <input type="text" name="txtlname" class="form-control" placeholder="Last Name" value="" required/>
          </div>
        </div>
        <div class="row pb-3">
          <div class="col-md">
              <label class="fw-bold">Email: </label>
              <input type="email" name="txtemail" class="form-control" placeholder="Email" value="" required/>
          </div>
          <div class="col-md">
              <label class="fw-bold">Contact Number: </label>
              <input type="number" name="txtcontact" class="form-control" placeholder="Contact Number" value="" onkeydown="return event.keyCode !== 69" required/>
          </div>
        </div>
        <div class="col-md pb-3">
          <label class="fw-bold">Department: </label>
            <select id="addDept" name="txtdept" class="form-control" required>
              <option value="">-- Select a Department -- </option>
              <option value="BSCS">BSCS</option>
              <option value="BSED">BSED</option>
              <option value="BSCRIM">BSCRIM</option>
            </select>
        </div>
        <div class="col-md text-center pt-3"> 
            <button class="btn btn-primary btn-lg" type="submit" name="facultyReg" id="register">Register</button>
        </div>
      </form>
    </div>
  </div>
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
</script>
