<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Admin')) {
  header("Location: ../../index.php");
}
 /** STUDENT DELETE  */
if(isset($_POST['studentDelete'])) {

  $result = mysqli_query($conn, "DELETE FROM students WHERE studentid='".$_POST['studentid']."'");
  $result = mysqli_query($conn, "DELETE FROM users WHERE userid='".$_POST['studentid']."'");

  if ($result) {
    echo '<script type="text/javascript">setTimeout(function () {
      swal("Student Succesfully Removed!","","success");}, 200);
      </script>';
    header("Refresh:1");
  } else {
    echo '<script type="text/javascript">setTimeout(function () {
      swal("Something went wrong, Please try again.","","error");}, 200);</script>';
      header("Refresh:1");
  }
}



?>
<!DOCTYPE html>
<html lang="en">
<?php
    include("../header.php");
  ?>
<body class="loading">

  <div id="loading-screen">
    <div class="loader"></div>
  </div>
  <div class="container p-5" id="page-content">
  <form action="" method="POST">
      <div class="col-md pt-2">
        <table class="table table-striped table-primary table-hover p-2" id="table">
          <thead>
            <tr>
              <th scope="col">Student ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Section</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM students";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0) {
              echo '<script type="text/javascript">setTimeout(function () {
                swal("Nothing found in Database.","","error");}, 200);</script>';
              }
              if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                  $studentid = $row['studentid'];
                  echo "<tr>";
                  echo "<td>".$row['studentid']."</td>";
                  echo "<td>".$row['firstname']."</td>";
                  echo "<td>".$row['lastname']."</td>";
                  echo "<td>".$row['course'].''.$row['year'].''.$row['section']."</td>";
                  echo "<td>
                          <button type='button' class='btn btn-primary btn-sm' onclick=\"window.location.href='updateForm.php?studentid=".urlencode($studentid)."'\">
                            Update
                          </button>
                          <button type='button' class='btn btn-danger btn-sm' onclick='deleteStudent(\"".$row['studentid']."\")'>
                            Delete
                          </button>
                        </td>";
                  echo "</tr>";
                }
              }

            ?>
          </tbody>
        </table>
      </div>
    </form>
  </div>
  <?php
    include '../footer.php';
  ?>
  <script>
  window.addEventListener("load", function() {
    var loadingScreen = document.getElementById("loading-screen");
    loadingScreen.style.display = "none";
    document.body.classList.remove("loading");
  });


$(document).ready(function () {
    $('#table').DataTable({
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'All'],
        ],
    });
});

function deleteStudent(studentid) {
  if(confirm("Are you sure you want to delete this student?")) {
    // Send AJAX request to delete row
    $.ajax({
      type: "POST",
      url: "delete_student.php",
      data: { studentid: studentid },
      success: function(response) {
        // Show success message and refresh page after deletion
        swal({
          title: "Success",
          text: "Student has been successfully deleted.",
          icon: "success",
        }).then(function() {
          location.reload();
        });
      }
    });
  }
}

    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
    
  </script>
</body>
</html>
