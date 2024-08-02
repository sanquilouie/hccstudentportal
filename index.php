<?php
include 'config.php';

session_start();


error_reporting(0);
if (isset($_POST['btnlogin'])) {
  $userPass = md5($_POST['userPass']);
  $userID = $_SESSION['theid'];
  if ($_SESSION['role'] == 'Faculty' || $_SESSION['role'] == 'Cashier' || $_SESSION['role'] == 'Registrar' || $_SESSION['role'] == 'Scheduler'){
    $sql = "SELECT * FROM users u INNER JOIN faculty f on f.facultyid=u.userid WHERE userid='$userID' and password='$userPass'";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) == 1){
      $getUsername = mysqli_fetch_assoc($result);
      $_SESSION['username'] = $getUsername['lastname']. ', ' .$getUsername['firstname'];
      $_SESSION['loggedin'] = "1";
      $userLog = $_SESSION['role'];
      $actionLog = "User with ID ". $_SESSION['theid'] . " Logged in Successfully";
      $logPop = mysqli_query($conn, "INSERT INTO logs (user, action) 
        VALUES ('$userLog', '$actionLog')");
      if($_SESSION['role'] == 'Faculty'){
        $query=mysqli_query($conn,"select * from settings where status='active'")or die(mysqli_error());
		$row=mysqli_fetch_array($query);		
	
		$_SESSION['settings']=$row['settings_id'];

        header("Location: faculty/dashboard/dashboard.php");
      }elseif($_SESSION['role'] == 'Cashier'){
        header("Location: cashier/dashboard/dashboard.php");
      }elseif($_SESSION['role'] == 'Registrar'){
        header("Location: registrar/dashboard/dashboard.php");
      }elseif($_SESSION['role'] == 'Scheduler'){
        $_SESSION['id'] = "Scheduler";

        $query=mysqli_query($conn,"select * from settings where status='active'")or die(mysqli_error());
		$row=mysqli_fetch_array($query);		
	
		$_SESSION['settings']=$row['settings_id'];
		$_SESSION['term']=$row['term'];		
	  	$_SESSION['type']='admin';	
        header("Location: faculty/dashboard/dashboard.php");
      }
    }else{
      $userLog = $_SESSION['role'];
      $actionLog = "User with ID ". $_SESSION['theid'] . " Attempted to Login but Failed";
      $logPop = mysqli_query($conn, "INSERT INTO logs (user, action) 
        VALUES ('$userLog', '$actionLog')");
      echo '<script type="text/javascript">setTimeout(function () {
        swal("Invalid Password, Please Try Again!","","error");}, 200);</script>';
      }
  }elseif($_SESSION['role'] == 'Student'){
    $userLog = $_SESSION['role'];
      $actionLog = "User with ID ". $_SESSION['theid'] . " Logged in Successfully";
      $logPop = mysqli_query($conn, "INSERT INTO logs (user, action) 
        VALUES ('$userLog', '$actionLog')");
    $_SESSION['loggedin'] = "1";
    $query=mysqli_query($conn,"select * from settings where status='active'")or die(mysqli_error());
		$row=mysqli_fetch_array($query);		
	
		$_SESSION['settings']=$row['settings_id'];
    header("Location: student/dashboard/dashboard.php");
  }elseif($_SESSION['role'] == 'Admin'){
    $userLog = $_SESSION['role'];
      $actionLog = "Admin Logged in Successfully";
      $logPop = mysqli_query($conn, "INSERT INTO logs (user, action) 
        VALUES ('$userLog', '$actionLog')");

    $sql = "SELECT * FROM users WHERE userid='$userID' and password='$userPass'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1){
      $_SESSION['loggedin'] = "1";
      $_SESSION['username'] = "Administrator";
      $_SESSION['id'] = "Administrator";

      $query=mysqli_query($conn,"select * from settings where status='active'")or die(mysqli_error());
		$row=mysqli_fetch_array($query);		
	
		$_SESSION['settings']=$row['settings_id'];
		$_SESSION['term']=$row['term'];		
	  	$_SESSION['type']='admin';	

      header("Location: admin/dashboard/dashboard.php");
    }else{
      $userLog = $_SESSION['role'];
      $actionLog = "Admin Attempted to Login but Failed";
      $logPop = mysqli_query($conn, "INSERT INTO logs (user, action) 
        VALUES ('$userLog', '$actionLog')");
      echo '<script type="text/javascript">setTimeout(function () {
        swal("Invalid Password, Please Try Again!","","error");}, 200);</script>';
      } 
  }

}
if (isset($_POST['login'])) {
  $userID = $_POST['studentID'];
  $sql = "SELECT * FROM users WHERE userid='$userID'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) == 1){
    $loggedinuser = mysqli_fetch_assoc($result);
    if($loggedinuser['role'] == 'Admin' || $loggedinuser['role'] == 'Faculty' 
    || $loggedinuser['role'] == 'Cashier' || $loggedinuser['role'] == 'Registrar'
    || $loggedinuser['role'] == 'Scheduler'){
      $_SESSION['theid'] = $loggedinuser['userid'];
      $_SESSION['role'] = $loggedinuser['role'];
      include 'verificationModal.php';
    }elseif($loggedinuser['role'] == 'Student'){
    $sql = "SELECT * FROM users u INNER JOIN students s on s.studentid=u.userid WHERE userid='$userID'";
    echo "'<script>console.log(\"$sql\")</script>'";
    $result = mysqli_query($conn, $sql);
    $getUsername = mysqli_fetch_assoc($result);
      $_SESSION['username'] = $getUsername['lastname']. ', ' .$getUsername['firstname'];
      $_SESSION['theid'] = $loggedinuser['userid'];
      $_SESSION['role'] = $loggedinuser['role'];
      include 'verificationModal.php';
    }
  }else{
    echo '<script type="text/javascript">setTimeout(function () {
      swal("User Does not Exist!","","error");}, 200);</script>';

    }
  }
    ?>
<!DOCTYPE html>
<html lang="en">
<title>HCC Portal</title>
<head> 
  <script src="https://code.jquery.com/jquery-3.6.1.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="assets/plugins/sweetalert.min.js"></script>
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  
</head>
<?php
include("showModal.php");
?>
<div class="col">
    <button type="button" class="p-3 position-absolute bottom-0 start-0 btn btn-lg btn btn-secondary rounded-circle ms-2" data-bs-toggle="modal" data-bs-target="#showModal" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;"><i class="fa-solid fa-bullhorn fa-2x"></i></button>
</div>
<body onLoad="initClock()">
  <div class="container-fluid pt-5" >
    <div class="col text-center pt-5 font-monospace" style="letter-spacing: 0px;">
      <h1>STUDENT INFORMATION SYSTEM</h1>
    </div><br/><br/>
    <div class="row d-flex justify-content-center pt-5">
      <div class="col-6">
        <div id="timedate">
          <div class="col ps-5" style="font-size:100px;">
            <div class="row g-2">
              <div class="col-1"></div>
              <div class="col-3" id="h">12</div>
              <div class="col-1">:</div>
              <div class="col-3" id="m">00</div>
              <div class="col-1">:</div>
              <div class="col-3" id="s">00</div>
            </div>     
          </div>
          <div class="col fs-1">
            <a id="mon">January</a>
            <a id="d">1</a>,
            <a id="y">0</a><br />
          </div> 
        </div>
      </div>
      <div class="col-4 text-center">
        <form action="" method="POST">
          <img class="mb-4" src="assets/images/logo.png" alt="" width="150" height="150">
          <div class="form-floating fw-bold">
            <input type="text" name="studentID" class="form-control rounded-pill" placeholder="Student ID" style="text-align:center;" autocomplete="off" required>
            <label id="textOP">ID Number</label>
          </div>
          <br/>
          <button type="submit" name="login" class="w-100 btn btn-lg btn-primary rounded-pill">Sign in</button>
        </form>
      </div>
      <div class="col-2"></div>
    </div>
  </div>
  <script src="assets/js/indexScript.js"></script>
</body>
</html>

    <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }

    $(document).ready(function () {
  $('#showModal').find('.carousel-item').first().addClass('active');
});
  </script>