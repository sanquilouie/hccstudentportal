<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Admin')) {
  header("Location: ../../index.php");
}

$id = $_SESSION['theid'];
$username = $_SESSION['username'];

/** DELETE CONDITION */
if(isset($_POST['subjectDelete'])) {

  $sql = "DELETE FROM subjects WHERE subjectid='".$_POST['subjectid']."'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
        $userLog = $_SESSION['role'];
      	$actionLog = "Succesfully Deleted a Subject with ID #: ".$_POST['subjectid'];
      	$logPop = mysqli_query($conn, "INSERT INTO logs (user, action)
        VALUES ('$userLog', '$actionLog')");
    echo '<script type="text/javascript">setTimeout(function () {
      swal("Subject Succesfully Deleted!","","success");}, 200);
      </script>';
  } else {
    echo '<script type="text/javascript">setTimeout(function () {
      swal("Something went wrong, Please try again.","","error");}, 200);</script>';
  }
}

  if(isset($_POST['updateSubject'])) {
    $subjectid = $_POST['subjectid'];
    $txtsubject = $_POST['txtsubject'];
    $txtyear = $_POST['txtyear'];
  	$txtsem = $_POST['txtsem'];
    $txtfaculty = $_POST['txtfaculty'];
    $txtcode = $_POST['txtcode'];
    $txtunit = $_POST['txtunit'];
    $txtcourse = $_POST['txtcourse'];
    $txtcolor = $_POST['txtcolor'];


    $sql = "UPDATE subjects AS Subj,
    (SELECT * FROM faculty WHERE facultyid = '$txtfaculty') AS facuID SET
    subject = '$txtsubject',
    year = '$txtyear',
    sem = '$txtsem',
    code = '$txtcode',
    unit = '$txtunit',
    course = '$txtcourse',
    subjcolor = '$txtcolor',
    Subj.facultyid = facuID.facultyid,
    Subj.faculty = CONCAT(facuID.firstname,' ',facuID.lastname) WHERE
    Subj.subjectid = '$subjectid'";


  		$result = mysqli_query($conn, $sql);
  		if ($result) {
        $userLog = $_SESSION['role'];
      	$actionLog = "Succesfully Updated a Subject with Subject Code: ".$txtcode ;
      	$logPop = mysqli_query($conn, "INSERT INTO logs (user, action)
        VALUES ('$userLog', '$actionLog')");
        echo '<script type="text/javascript">setTimeout(function () {
          swal("Subject Succesfully Updated","","success");}, 200);
          </script>';
  		} else {
  			echo '<script type="text/javascript">setTimeout(function () {
          swal("Something went wrong, Please try again.","","error");}, 200);</script>';
  		}
    }

  if (isset($_POST['register'])) {
    $subject = $_POST['subject'];
    $year = $_POST['year'];
    $sem = $_POST['sem'];
    $code = $_POST['code'];
    $unit = $_POST['unit'];
  	$course = $_POST['course'];
    $faculty = $_POST['faculty'];
    $color = $_POST['color'];

    $sql = "SELECT * FROM faculty where facultyid = '$faculty'";
    $result = mysqli_query($conn, $sql);
    $getFacname = mysqli_fetch_assoc($result);
    $fullFacname = $getFacname['lastname'].', '.$getFacname['firstname'];

  			$sql = "INSERT INTO subjects (facultyid,faculty, course, code, subject, year, sem, unit, subjcolor)
  					VALUES ('$faculty','$fullFacname', '$course', '$code', '$subject', '$year', '$sem', '$unit', '$color')";
  			$result1 = mysqli_query($conn, $sql);
  			if ($result1) {
          $userLog = $_SESSION['role'];
      	$actionLog = "Succesfully Registered a Subject Code: ".$code;
      	$logPop = mysqli_query($conn, "INSERT INTO logs (user, action)
        VALUES ('$userLog', '$actionLog')");
          echo '<script type="text/javascript">setTimeout(function () {
          swal("Subject Succesfully Registered","","success");}, 200);
          </script>';

  			} else {
          echo '<script type="text/javascript">setTimeout(function () {
            swal("Something went wrong, Please try again.","","error");}, 200);</script>';
  			}
  }
?>
<!DOCTYPE html>
<html>
<body>
  <?php
  include("../header.php");
  include 'registerModal.php';
  ?>
  <div class="container-fluid p-5">
    <form action="" id="addUser" method="POST">
      <div class="form-group ml-5 pb-2">
        <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#registerModal"> Add Subject</button>
      </div>
      <div class="col-md">
        <table class="table table-striped table-primary table-hover p-2" id="table" style="table-layout:fixed;">
          <thead>
            <tr>
              <th style="width:50px;">Code</th>
              <th style="width:250px;">Subject Name</th>
              <th style="width:100px;">Year</th>
              <th style="width:100px;">Semester</th>
              <th style="width:200x;">Faculty</th>
              <th style="width:50px;">Course</th>
              <th style="width:50px;">Unit</th>
              <th style="width:120px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM subjects";
            $result = mysqli_query($conn, $sql);
              if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                  echo "<tr>";
                  echo "<td>".$row['code']."</td>";
                  echo "<td>".$row['subject']."</td>";
                  echo "<td>".$row['year']."</td>";
                  echo "<td>".$row['sem']."</td>";
                  echo "<td>".$row['faculty']."</td>";
                  echo "<td>".$row['course']."</td>";
                  echo "<td>".$row['unit']."</td>";
                  echo '<td>
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#subjectUpdate'.$row['subjectid'].'"> Update</button>
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#subjectDelete'.$row['subjectid'].'"> Delete</button>
                  </td>';
                  echo "</tr>";

                  include 'updateModal.php';
                  include 'deleteModal.php';

                }
              }else{
                echo '<script type="text/javascript">setTimeout(function () {
                  swal("Nothing found in Database.","","error");}, 200);</script>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </form>
  </div>
  <?php
  include("../footer.php");
  ?>
</body>
</html>
<script>
$(document).ready(function () {

    $('#table').DataTable({
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'All'],
        ],
    });
});
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>
