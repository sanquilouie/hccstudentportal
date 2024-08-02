<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Cashier')) {
  header("Location: ../../index.php");
}
 /** STUDENT DELETE  */
if(isset($_POST['studentDelete'])) {

  $result = mysqli_query($conn, "DELETE FROM billing WHERE billingid='".$_POST['billingid']."'");

  if ($result) {
    echo '<script type="text/javascript">setTimeout(function () {
      swal("Billing Info Succesfully Removed!","","success");}, 200);
      </script>';
    header("Refresh:1");
  } else {
    echo '<script type="text/javascript">setTimeout(function () {
      swal("Something went wrong, Please try again.","","error");}, 200);</script>';
      header("Refresh:1");
  }
}

/** STUDENT UPDATE */
if(isset($_POST['studentUpdate'])) {
  $txthiddenid = $_POST['hiddenid'];
  $txttuitionfee = $_POST['txttuitionfee'];
  $txtlearn = $_POST['txtlearn'];
  $txtregis = $_POST['txtregis'];
  $txtcomppros = $_POST['txtcomppros'];
  $txtguidance = $_POST['txtguidance'];
  $txtschoolid = $_POST['txtschoolid'];
  $txthandbook = $_POST['txthandbook'];
  $txtpublication = $_POST['txtpublication'];
  $txtinsurance = $_POST['txtinsurance'];
  $txttotalass = $_POST['txttotalass'];
  $txtdiscount = $_POST['txtdiscount'];
  $txtnetass = $_POST['txtnetass'];
  $txtcash = $_POST['txtcash'];
  $txtbalance = $_POST['txtbalance'];

    $sql = "UPDATE billing SET 
    tuitionfee = '$txttuitionfee',
    learnandins = '$txtlearn', 
    regfee = '$txtregis',
    compprossfee = '$txtcomppros',
    guidandcouns = '$txtguidance',
    schoolidfee = '$txtschoolid',
    studenthand = '$txthandbook',
    schoolfab = '$txtpublication',
    insurance = '$txtinsurance',
    totalass = '$txttotalass',
    discount = '$txtdiscount',
    netass = '$txtnetass',
    cashcheckpay = '$txtcash',
    balance   = '$txtbalance' WHERE billingid = '$txthiddenid'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
      echo '<script type="text/javascript">setTimeout(function () {
        swal("Billing Information Succesfully Updated","","success");}, 200);
        </script>';
    } else {
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
  <div class="container p-5">
  <form action="" method="POST">
      <div class="col-md pt-2">
        <table class="table table-striped table-primary table-hover p-2" id="table">
          <thead>
            <tr>
              <th scope="col">Billing ID</th>
              <th scope="col">Student ID</th>
              <th scope="col">Balance</th>
              <th scope="col">Import Date</th>
              <th scope="col">Option</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM billing order by datecreated DESC";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0) {
              echo '<script type="text/javascript">setTimeout(function () {
                swal("Nothing found in Database.","","error");}, 200);</script>';
              }
            if ($result->num_rows > 0) {
              while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['billingid']."</td>";
                echo "<td>".$row['studentid']."</td>";
                echo "<td>".$row['balance']."</td>";
                echo "<td>".$row['datecreated']."</td>";
                echo '<td>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#billingUpdate'.$row['billingid'].'"> Update</button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#billingDelete'.$row['billingid'].'"> Delete</button>
                </td>';
                echo "</tr>";
                
                include 'deleteModal.php';
                include 'updateModal.php';
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
</body>
</html>
