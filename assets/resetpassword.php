<?php
include '../config.php';
session_start();
error_reporting(0);

if(isset($_POST['btncancel'])) {
  include('logout.php');
}
if(isset($_POST['btnconfirm'])) {
  $userID = $_SESSION['theid'];
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);
  if($password == $cpassword){
    $sql = "UPDATE users SET password = '$password' WHERE id='$userID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        unset($_SESSION["theid"]);
        header("Refresh:0; url=../index.php");
    } else {
      echo '<script type="text/javascript">setTimeout(function () {
        swal("Something went Wrong. Please Try Again.","","error");}, 200);</script>';
    }
  } else {
    echo '<script type="text/javascript">setTimeout(function () {
      swal("Password does not match","","error");}, 200);</script>';
  }
}

?>
<link rel="stylesheet" href="../assets/bootstrap.min.css" type="text/css"/>
<script src="../assets/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="../assets/sweetalert.min.js"></script>
<script src="../assets/jquery.min.js"></script>
<script>
    $(document).ready(function(){
    $("#myModal").modal('show');
});
  </script>

    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Please change your password.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <main class="form-signin">
              <form action="" method="POST">
                <div class="modal-body">
                <div class="form-floating">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                  <label id="textOP">Password</label>
                </div>
                <div class="form-floating">
                  <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password">
                  <label id="textOP">Confirm Password</label>
                </div>
            </div>
            <div class="modal-footer">
                <button name="btncancel" type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button name="btnconfirm" type="submit" class="btn btn-primary">Confirm</button>
            </div>
          </form>
        </main>
            </div>
        </div>
    </div>
