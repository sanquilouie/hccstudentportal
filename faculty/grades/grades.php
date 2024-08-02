<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Faculty' || $_SESSION['role'] == 'Scheduler')) {
  header("Location: ../../index.php");
} 
echo "'<script>console.log(\"$value\")</script>'";
if(isset($_POST['studentidsearch'])) {
  if(!empty($_SESSION['subject'])) {
    $_SESSION['studentID'] = $_POST['studentID'];
    $sql = "SELECT * FROM students WHERE studentid= " . $_SESSION['studentID'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $_SESSION['course'] = $row['course'];
    $_SESSION['section'] = $row['section'];
    $_SESSION['studentName'] = $row['lastname']. ', ' .$row['firstname'];

    $sql = "SELECT * FROM grades WHERE studentid='".$_SESSION['studentID']."' AND subject='".$_SESSION['subject']."'
    AND schoolyear='".$_SESSION['year']."' AND semester='".$_SESSION['semester']."'";
    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
      $sql = "INSERT INTO grades (studentid, studentname, schoolyear, semester,code, subject, units, faculty, facultyid)
      VALUES ('".$_SESSION['studentID']."', '".$_SESSION['studentName']."', '".$_SESSION['year']."', '".$_SESSION['semester']."',
        '".$_SESSION['code']."','".$_SESSION['subject']."', '".$_SESSION['unit']."', '".$_SESSION['username']."', '".$_SESSION['theid']."')";
        $result = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM grades WHERE studentid='".$_SESSION['studentID']."' AND subject='".$_SESSION['subject']."'
        AND schoolyear='".$_SESSION['year']."' AND semester='".$_SESSION['semester']."'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        $_SESSION['prelim'] = $row['prelim'];
        $_SESSION['midterm'] = $row['midterm'];
        $_SESSION['finals'] = $row['finals'];
        $_SESSION['entryid'] = $row['entryid'];
      }else {
        $sql = "SELECT * FROM grades WHERE studentid='".$_SESSION['studentID']."' AND subject='".$_SESSION['subject']."'
        AND schoolyear='".$_SESSION['year']."' AND semester='".$_SESSION['semester']."'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        $_SESSION['prelim'] = $row['prelim'];
        $_SESSION['midterm'] = $row['midterm'];
        $_SESSION['finals'] = $row['finals'];
        $_SESSION['entryid'] = $row['entryid'];
      }
    }else{
      echo '<script type="text/javascript">setTimeout(function () {
        swal("Please Select a Subject First!","","warning");}, 200);</script>';
    }
  }


  if(isset($_POST['update'])) {
    $subject = $_POST['subject'];

    $sql = "SELECT * FROM subjects WHERE code='$subject'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $fsubject = $row['subject'];

    $_SESSION['unit'] = $row['unit'];
    $_SESSION['subject'] = $fsubject;
    $_SESSION['year'] = $_POST['year'];
    $_SESSION['semester'] = $_POST['semester'];
    $_SESSION['code'] = $_POST['subject'];

    unset($_SESSION["studentID"]);
    unset($_SESSION["studentName"]);
    unset($_SESSION["course"]);
    unset($_SESSION["section"]);
    unset($_SESSION["entryid"]);

    unset($_SESSION["prelim"]);
    unset($_SESSION["midterm"]);
    unset($_SESSION["finals"]);
  }
  function grading($sum){
    switch($sum){
      case $sum >= 98 AND $sum <= 100:
        return 1.0;
        break;
      case $sum >= 95 AND $sum <= 97:
        return 1.25;
        break;
      case $sum >= 92 AND $sum <= 94:
        return 1.50;
        break;
      case $sum >= 89 AND $sum <= 91:
        return 1.75;
        break;
      case $sum >= 86 AND $sum <= 88:
        return 2.0;
        break;
      case $sum >= 83 AND $sum <= 85:
        return 2.25;
        break;
      case $sum >= 80 AND $sum <= 82:
        return 2.50;
        break;
      case $sum >= 76 AND $sum <= 79:
        return 2.75;
        break;
      case $sum == 75:
        return 3.0;
        break;
      case $sum <= 74:
        return 5.0;
        break;
      default:
      echo $sum;

    }
  }

  if(isset($_POST['save'])) {
    if(!empty($_SESSION['studentID']) && !empty($_SESSION['subject'])) {
      $_SESSION['prelim'] = $_POST['prelim'];
      $_SESSION['midterm'] = $_POST['midterm'];
      $_SESSION['finals'] = $_POST['finals'];

      if(!empty($_SESSION['prelim']) && is_numeric($_SESSION['prelim'])
      && !empty($_SESSION['midterm']) && is_numeric($_SESSION['midterm'])
      && !empty($_SESSION['finals']) && is_numeric($_SESSION['finals'])){

        $sum = ($_SESSION['prelim'] + $_SESSION['midterm'] + $_SESSION['finals']) /3;
        $average = grading(intval($sum));
        $rOfsum = intval($sum);
        switch($average){
          case $average >= 1 AND $average <= 3:
          $status = "PASSED";
          break;
          default:
          $status = "FAILED";
        }
      }else{
        $average = "NG";
        $status = "NG";
        $rOfsum = "NG";
      }

      $sql = "UPDATE grades SET studentid = '".$_SESSION["studentID"]."', studentname = '".$_SESSION["studentName"]."',
       prelim = '".$_SESSION['prelim']."', midterm = '".$_SESSION['midterm']."',
       finals = '".$_SESSION['finals']."', finalgrades = '$rOfsum', average = '$average', status = '$status'
      WHERE entryid='".$_SESSION['entryid']."'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        echo '<script type="text/javascript">setTimeout(function () {
          swal("Student Grades Succesfully Encoded!","","success");}, 200);</script>';
        unset($_SESSION["studentID"]);
        unset($_SESSION["studentName"]);
        unset($_SESSION["course"]);
        unset($_SESSION["section"]);
        unset($_SESSION["entryid"]);

        unset($_SESSION["prelim"]);
        unset($_SESSION["midterm"]);
        unset($_SESSION["finals"]);
      } else {
        echo '<script type="text/javascript">setTimeout(function () {
          swal("Something went Wrong. Please Try Again.","","error");}, 200);</script>';
      }
    } else {
      echo '<script type="text/javascript">setTimeout(function () {
        swal("Something went Wrong. Please Try Again.","","error");}, 200);</script>';
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <body>
    <?php
    include("../header.php");
    ?>
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">Set Subject, Year and Semester</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <div class="col-lg-12">
              <form method="POST">
                <div class="row gx-3 mb-3">
                  <div class="col-md-6">
                    <label class="small mb-1">Year</label>
                    <select name="year" class="form-select" required>
                      <option>2019/2020</option>
                      <option selected>2020/2021</option>
                      <option selected>2021/2022</option>
                      <option selected>2022/2023</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="small mb-1">Semester</label>
                    <select name="semester" class="form-select" required>
                      <option>First</option>
                      <option selected>Second</option>
                    </select>
                  </div>
                </div>
                <div class="row gx-3 mb-3">
                  <div class="col-md-12">
                    <label class="small mb-1">Subject</label>
                    <select name="subject" class="form-select" required>
                      <?php
                      $facultyID = $_SESSION['theid'];
                      $sql = mysqli_query($conn, "SELECT * FROM subjects WHERE facultyid='$facultyID'");
                      while ($row = $sql->fetch_assoc()){
                        echo "<option value='".$row['code']."'>".$row['subject']."</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                  <button name="update" type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container w-50" style="margin-top:75px;">
      <div class="row" id="box">
        <div id="icon">
          <div class="col-md-2">
          <button name="update" id="updatebutton" type="submit" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">Subject</button>
        </div>
        </div>
        <div class="col-lg-12">
          <form method="POST">
            <div class="row gx-3 mb-3"  style="margin-top:28px;margin-left:400px;">
              <div class="col-md-8">
                <input name="studentID" class="form-control" type="number" placeholder="Student ID" value="" required>
              </div>
              <div class="col-md-2">
                <button name="studentidsearch" type="submit" class="btn btn-primary">Search</button>
              </div>
            </div>
          </form>
          <form method="POST">
            <div class="row gx-3 mb-3">
              <div class="col-md-2">
                <label class="small mb-1">Student ID</label>
                <div class="form-outline">
                  <input type="text" name="studentIDdisp" class="form-control" placeholder="ID #" value="<?php echo $_SESSION['studentID']; ?>" disabled required/>
                </div>
              </div>
              <div class="col-md-6">
                <label class="small mb-1">Student Name</label>
                <div class="form-outline">
                  <input type="text" name="studentname" class="form-control" placeholder="Student Name" value="<?php echo $_SESSION['studentName'] ?>" disabled/>
                </div>
              </div>
              <div class="col-md-2">
                <label class="small mb-1">Course</label>
                <div class="form-outline">
                  <input type="text" name="course" class="form-control" placeholder="Course" value="<?php echo $_SESSION['course']; ?>" disabled/>
                </div>
              </div>
              <div class="col-md-2">
                <label class="small mb-1">Section</label>
                <div class="form-outline">
                  <input type="text" name="section" class="form-control" placeholder="Section" value="<?php echo $_SESSION['section']; ?>" disabled/>
                </div>
              </div>
            </div>
            <div class="row gx-3 mb-3">
              <div class="col-md-3">
                <label class="small mb-1">Code</label>
                <div class="form-outline">
                  <input type="text" name="subjectView" class="form-control" placeholder="Subject" value="<?php echo $_SESSION['code'] ?>" disabled required/>
                </div>
              </div>
              <div class="col-md-9">
                <label class="small mb-1">Subject</label>
                <div class="form-outline">
                  <input type="text" name="subjectView" class="form-control" placeholder="Subject" value="<?php echo $_SESSION['subject'] ?>" disabled required/>
                </div>
              </div>
            </div>
            <div class="row gx-3 mb-3">
              <div class="col-md-6">
                <label class="small mb-1">Year</label>
                <div class="form-outline">
                  <input type="text" name="yearView" class="form-control" placeholder="Year" value="<?php echo $_SESSION['year']; ?>" disabled/>
                </div>
              </div>
              <div class="col-md-6">
                <label class="small mb-1">Semester</label>
                <div class="form-outline">
                  <input type="text" name="semesterView" class="form-control" placeholder="Semester" value="<?php echo $_SESSION['semester']; ?>" disabled/>
                </div>
              </div>
            </div>
            <div class="row gx-3 mb-3">
              <div class="col-md-4">
                <label class="small mb-1">Prelim</label>
                <div class="form-outline">
                  <input type="number" name="prelim" class="form-control" placeholder="Prelim" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "3"  value="<?php echo $_SESSION['prelim']; ?>"/>
                </div>
              </div>
              <div class="col-md-4">
                <label class="small mb-1">Midterm</label>
                <div class="form-outline">
                  <input type="number" name="midterm" class="form-control" placeholder="Midterm" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "3"  value="<?php echo $_SESSION['midterm']; ?>"/>
                </div>
              </div>
              <div class="col-md-4">
                <label class="small mb-1">Finals</label>
                <div class="form-outline">
                  <input type="number" name="finals" class="form-control" placeholder="Finals" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "3" value="<?php echo $_SESSION['finals']; ?>"/>
                </div>
              </div>

                <button name="save" type="submit" class="btn btn-primary" style="margin-top:15px;">Save</button>

            </div>
          </form>
        </div>
      </div>
    </div>
    <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
    </script>
    <?php
include '../footer.php'
?>
  </body>
  </html>
