<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<header>
        <nav class="navbar-default">
          <div class="container-fluid">
          <a class="navbar-brand" id="username" style="position:absolute; left:20px;margin-top:15px; font-size:25px;font-weight:bold;color:black;" href=""> <?php echo  $_SESSION['username']; ?> </a>
          <a class="navbar-brand" style="right:20px;position:absolute;margin-top:15px; font-size:25px;font-weight:bold;color:black;" >
            <span id="clock"></span>
          </a>  
          <div class="navbar-header" style="margin-left:20px">
			  
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>
              <div class="navbar-custom-menu" >
                <ul class="nav navbar-nav" style="text-align:center;margin-left:350px;margin-top:15px;">
                 <li class="">
                   <a href="home.php" class="" style="font-size:14px"><i class="glyphicon glyphicon-star-empty"></i> Class Schedule</a>
                  </li>
				          <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-wrench"></i> Maintenance
                      
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <ul class="menu">
						          <li>
                            <a href="sy.php">
                              <i class="glyphicon glyphicon-user text-green"></i> School Year
                            </a>
                          </li>
						  
						          <li>
                            <a href="time.php">
                              <i class="glyphicon glyphicon-calendar text-green"></i> Time
                            </a>
                          </li><!-- end notification -->
						
                          <li><!-- start notification -->
                            <a href="room.php">
                              <i class="glyphicon glyphicon-scale text-green"></i> Room
                            </a>
                          </li><!-- end notification -->
                          <li hidden><!-- start notification -->
                            <a href="cys.php">
                              <i class="glyphicon glyphicon-scale text-green"></i> Section
                            </a>
                          </li><!-- end notification -->
						

                        </ul>
                      </li>
                     
                    </ul>
                  </li>
                  <!-- Tasks Menu -->
					       <li class="">
                    <!-- Menu Toggle Button -->
                   <a href="settings.php" class="dropdown-toggle">
                      <i class="glyphicon glyphicon-cog text-red"></i>Settings
                      				
                    </a>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
        <nav class="navbar navbar-fixed-bottom">
	<div class="container-fluid">

<!-- Brand/logo -->
<?php
if($_SESSION['role'] == 'Scheduler'){
echo '
<div class="navbar-header navbar-right" style="margin-right:100px;margin-bottom:20px;">
		<a href="../../../faculty/dashboard/dashboard.php" class="btn btn-primary btn-lg shadow mb-3">
        <i class="fa-solid fa-angles-left"></i>
        <b>Back</b>
      </a>
</div>
';
}else{
  echo '
  <div class="navbar-header navbar-right" style="margin-right:100px;margin-bottom:20px;">
		<a href="../../dashboard/dashboard.php" class="btn btn-primary btn-lg shadow mb-3">
        <i class="fa-solid fa-angles-left"></i>
        <b>Back</b>
      </a>
</div>
  ';
}
?>
		

</div>
</nav>
      </header>


      <script>
var clockElement = document.getElementById('clock');
  function clock() {
    var date = new Date();
      clockElement.textContent = date.toLocaleString();;
    }
    setInterval(clock, 100);

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>