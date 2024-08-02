<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Faculty' || $_SESSION['role'] == 'Scheduler')) {
  header("Location: ../../index.php");
}

$id = $_SESSION['theid'];
$sql = "SELECT * FROM faculty WHERE facultyid='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
    ?>

<!DOCTYPE html>
<html lang="en">
<body>
  <?php
  include("../header.php");
  ?>
  <div class="container w-25 mt-5">
  <form action="" method="POST">
          <div class="col-md pb-3 pt-3">
            <label class="fw-bold">Faculty ID: </label>
            <input type="number" name="txtfacultyid" class="form-control" placeholder="User ID" value="<?php echo $row['facultyid']?>" onkeydown="return event.keyCode !== 69" readOnly/>
          </div>

        
          <div class="col-md pb-3">
            <label class="fw-bold">First Name: </label>
            <input type="text" name="txtfname" class="form-control" placeholder="First Name" value="<?php echo $row['firstname']?>" readOnly/>
          </div>
          <div class="col-md pb-3">
            <label class="fw-bold">Last Name:</label>
            <input type="text" name="txtlname" class="form-control" placeholder="Last Name" value="<?php echo $row['lastname']?>" readOnly/>
          </div>
          <div class="col-md pb-3">
              <label class="fw-bold">Email: </label>
              <input type="email" name="txtemail" class="form-control" placeholder="Email" value="<?php echo $row['email']?>" readOnly/>
          </div>
          <div class="col-md">
              <label class="fw-bold">Contact Number: </label>
              <input type="number" name="txtcontact" class="form-control" placeholder="Contact Number" value="<?php echo $row['contact']?>" onkeydown="return event.keyCode !== 69" readOnly/>
          </div>
        </div>
      
      </form>
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
