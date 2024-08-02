<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Admin')) {
  header("Location: ../../index.php");
}

/** ADD ANNOUNCEMENT */
if(isset($_POST['addAnnouncement'])) {
  $txtduration = $_POST['txtduration'];
  $txttitle = $_POST['txttitle'];
  $txtcontent = $_POST['txtcontent'];
  $txtcontent = $_POST['txtcontent'];

  $sql = "INSERT INTO activities (title,duration,caption,statusis) 
  VALUES ('$txttitle', '$txtduration', '$txtcontent', 'Active')";
  $result = mysqli_query($conn, $sql);
      if ($result) {
        echo '<script type="text/javascript">setTimeout(function () {
          swal("Announcement Succesfully Registered!","","success");}, 200);</script>';
      } else {
          echo '<script type="text/javascript">setTimeout(function () {
            swal("Something went wrong, Please try again.","","error");}, 200);</script>';
       }
}

/** UPDATE ANNOUNCEMENT */
if(isset($_POST['announcementUpdate'])) {
  $txteventid = $_POST['eventid'];
  $txtduration = $_POST['updateduration'];
  $txttitle = $_POST['updatetitle'];
  $txtcontent = $_POST['updatecontent'];
  $txtstatus = $_POST['updatestatus'];

    $sql = "UPDATE activities SET 
    duration = '$txtduration', 
    title = '$txttitle', 
    caption = '$txtcontent',
    statusis = '$txtstatus' WHERE eventid = '$txteventid'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      echo '<script type="text/javascript">setTimeout(function () {
        swal("Announcement Succesfully Updated","","success");}, 200);
        </script>';
      header("Refresh:1");
    } else {
      echo("Error description: " . $conn -> error);
      echo '<script type="text/javascript">setTimeout(function () {
        swal("Something went wrong, Please try again.","","error");}, 200);</script>';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <?php
    include("../header.php");
  ?>
  <div class="container-fluid p-5">
    <div class="col pb-3">
      <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#registerModal"> Add Announcement</button>
    </div>
    <div class="col">
      <form action="" method="POST">
        <table class="table table-striped table-primary table-hover p-2" id="table" style="table-layout:fixed;">
          <thead>
            <tr>
              <th style="width:50px;">Event ID</th>
              <th style="width:500px;">Title</th>
              <th scope="col">Exp. Date</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM activities ORDER BY FIELD(statusis, 'Active') DESC";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0) {
              echo '<script type="text/javascript">setTimeout(function () {
                swal("Nothing found in Database.","","error");}, 200);</script>';
              }
            if ($result->num_rows > 0) {
              while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['eventid']."</td>";
                echo "<td>".$row['title']."</td>";
                echo "<td>".$row['duration']."</td>";
                if($row['statusis'] == 'Active'){
                  $status = "<span style='color:#0A6EBD;font-weight:1000;'>Active</span>";
                } elseif($row['statusis'] == 'Inactive'){
                  $status = "<span style='color:#E23E3E;font-weight:1000;'>Inactive</span>";
                }
                echo "<td>".$status."</td>";             
                echo '<td>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#announcementUpdate'.$row['eventid'].'"> Update</button>
                </td>';
                echo "</tr>";
                
                include 'updateModal.php';
                include 'registerModal.php';
              }
            }
            ?>
          </tbody>
        </table>
        <?php 
          include 'showModal.php';
        ?>
      </form>
    </div>
  </div>
  <?php
  include("../footer.php");
  ?>
</body>
</html>
<script>
$(document).ready(function () {
  $('#showModal').find('.carousel-item').first().addClass('active');
});

$(document).ready(function () {
  $('#table').DataTable({
    "ordering": false,
    lengthMenu: [
      [5, 10, 20, -1],
      [5, 10, 20, 'All'],
    ],
  });
});

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
  </script>
