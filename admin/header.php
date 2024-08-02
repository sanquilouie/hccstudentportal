<head>
<meta charset="UTF-8">
  <title>HCC Portal</title>
  <!-- Styles -->
  <link rel="stylesheet" href="../../assets/plugins/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <link rel="stylesheet" href="../../assets/css/style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <script src="../../assets/plugins/jquery.min.js"></script>
  <script src="../../assets/plugins/select2.min.js"></script>
  <script src="../../assets/plugins/bootstrap.bundle.min.js"></script>
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
