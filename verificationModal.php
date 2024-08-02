<!DOCTYPE html>
<html lang="en">
<head>
  <title>HCC Portal</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css" >
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="assets/plugins/sweetalert.min.js"></script>
</head>
<body>
  <div id="addModal" class="modal fade">
    <form action="" method="POST">
      <div class="modal-dialog modal-notify modal-info" role="document">
        <div class="modal-content text-center">

          <?php
          if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Faculty' 
          || $_SESSION['role'] == 'Cashier' || $_SESSION['role'] == 'Registrar'
          || $_SESSION['role'] == 'Scheduler'){
            echo '<div class="modal-header d-flex justify-content-center">
            <h5 class="heading">Please Enter Password</h5>
            </div>

            <div class="modal-body">
            <div class="form-floating">
            <input type="password" name="userPass" class="form-control" placeholder="Password">
            <label id="textOP">Password</label>
            </div>
            </div>';
          }elseif($_SESSION['role'] == 'Student'){
            echo '<div class="modal-header">
            <h5 class="modal-title">Hi, '.$_SESSION['username'].'</h5>
            </div>

            <div class="modal-body" >
            <p>Are you sure this is you?
            Unauthorized use of other Accounts is <b>STRICTLY PROHIBITED.</b> <br/>Note that all login attempts will be recorded.</p>
            Press <b>"Log In"</b> to proceed.</p>
            </div>';
          }
          ?>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary waves-effect" name="btnlogin">Log In</button>
          </div>
        </div>
      </div>
    </form>
  </div>

</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
  $('#addModal').modal('show');
});
</script>
