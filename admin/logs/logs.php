<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Admin')) {
  header("Location: ../../index.php");
} 


?>
<!DOCTYPE html>
<html>
<body>
  <?php
  include("../header.php");
  ?>
  <div class="container-fluid p-5">
    <form action="" id="addUser" method="POST">
      <div class="col-md">
        <table class="table table-striped table-primary table-hover p-2" id="table" style="table-layout:fixed;">
          <thead>
            <tr>
              <th style="width:50px;">Log ID</th>
              <th style="width:100px;">User</th>
              <th style="width:250px;">Action</th>
              <th style="width:100px;">Log Time</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM logs ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
              if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                  echo "<tr>";
                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['user']."</td>";
                  echo "<td>".$row['action']."</td>";
                  echo "<td>".$row['datetime']."</td>";
                  echo "</tr>";
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
        "ordering": false
    });
});
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>
