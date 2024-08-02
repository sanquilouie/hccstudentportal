<?php
session_start();
error_reporting(0);
if (!($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Scheduler')) {
  header("Location: ../../../index.php");
}

include '../../../config.php';

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<style>
        body {
            background: url(../dist/img/temp.jpg) center/cover no-repeat;
            margin: 0;
            justify-content: center;
            font-family: Verdana, sans-serif;
            overflow-x: hidden;
            overflow-y: hidden;
            animation: fadeInAnimation ease 1s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }
		.btn-sq-lg {
			width: 220px;
			height: 200px;
			border-radius: 25px;
			position: relative;
			overflow: hidden;
		}
		#btn-schedule{
			border-radius: 25px;
			color: #2596be;
		}
		.fa-6x {
			padding-top: 35px;
			position: absolute;
			top: 0;
			left: 50%;
			transform: translateX(-50%);
			color: #2596be;
			opacity: 0.8;
			transition: all 0.2s ease-in-out;
		}
		.btn-sq-lg:hover .fa-6x {
			transform: translate(-50%, -10%) scale(1.2);
			opacity: 1;
		}
		.btn-label {
			position: absolute;
			bottom: 0;
			left: 50%;
			transform: translateX(-50%);
			font-size: 20px;
			font-weight: bold;
			color: #2596be;
			opacity: 0.8;
			transition: all 0.2s ease-in-out;
		}
		.btn-sq-lg:hover .btn-label {
			transform: translate(-50%, 10%);
			opacity: 1;
		}
		body, html {
			height: 100%;
			margin: 0;
			padding: 0;
		}
		.container {
			display: flex;
			align-items: center;
			justify-content: center;
			height: calc(100% - 50px);
		}
		.navbar {
			margin-bottom: 0;
		}
		#clock {
            font: small-caps lighter 30px/150% "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
			color: black;
			font-weight: bold;
			position: absolute;
			top: 0;
			right: 0;
			padding: 10px;
		}
        #user {
            color: #2596be;
			font-size: 25px;
			font-weight: bold;
			position: absolute;
			top: 15px;
			left: 30px;;
			padding: 10px;
		}
		.navbar {
			background-color: transparent !important;
			border: none;
		}
		.back-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
  }
	</style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
                <a class="navbar-brand fw-bold" id="user" href=""> <?php echo  $_SESSION['username']; ?> </a>
			</div>
			<a class="nav-link link-light" style="bottom:5%;" >
                <span class="fw-bold fs-4" id="clock"></span>
            </a>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-xs-3">
				<a href="mainte_sy.php">
					<button id="btn-schedule" class="btn btn-sq-lg mx-auto">
                        <i class="fas fa-calendar-alt fa-6x"></i>
						<div class="btn-label">School Year</div>
					</button>
				</a>
			</div>
			<div class="col-xs-3">
                <a href="mainte_time.php">
				    <button id="btn-maintenance" class="btn btn-sq-lg mx-auto">
                        <i class="fas fa-clock fa-6x"></i>
					    <div class="btn-label">Time</div>
				    </button>
                </a>
			</div>
			<div class="col-xs-3">
				<a href="mainte_room.php">
					<button id="btn-schedule2" class="btn btn-sq-lg mx-auto">
                        <i class="fas fa-map-marker-alt fa-6x"></i>
						<div class="btn-label">Room</div>
					</button>
				</a>	
			</div>
			<div class="col-xs-3">
				<a href="mainte_setting.php">
					<button id="btn-schedule2" class="btn btn-sq-lg mx-auto">
                        <i class="fas fa-calendar-check fa-6x"></i>
						<div class="btn-label">Set SY</div>
					</button>
				</a>	
			</div>
		</div>
	</div>
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<div class="back-button">
  <a href="../index.php">
    <button class="btn btn-primary btn-lg">Back</button>
  </a>
</div>

</body>
</html>

<script>
var clockElement = document.getElementById('clock');
  function clock() {
    var date = new Date();
      clockElement.textContent = date.toLocaleString();;
    }
    setInterval(clock, 100);
</script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Schedule a meeting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add your modal form here -->
        <form>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter your name">
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email">
          </div>
          <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Schedule</button>
      </div>
    </div>
  </div>
</div