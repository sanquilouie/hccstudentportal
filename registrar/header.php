<head>
<meta charset="UTF-8">
  <title>HCC Portal</title>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  
  <script src="../../assets/plugins/bootstrap.bundle.min.js"></script>
  <script src="../../assets/plugins/jquery.min.js"></script>
  <script src="../../assets/plugins/sweetalert.min.js"></script>
  <script src="../../assets/js/scripts.js"></script>
</head>
<nav class="navbar">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold fs-4" id="username" style="position:relative; left:20px;bottom:5%;" href=""> <?php echo  $_SESSION['username']; ?> </a>
    <a class="nav-link link-light" style="bottom:5%;" >
      <span class="fw-bold fs-4" id="clock"></span>
    </a>
  </div>
</nav>
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
