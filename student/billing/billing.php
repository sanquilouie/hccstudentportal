<?php
include '../../config.php';
session_start();
error_reporting(0);

if (!($_SESSION['role'] == 'Student')) {
  header("Location: ../../index.php");
}


?>
    <!DOCTYPE html>
    <html lang="en">
    <meta http-equiv="refresh" content="5000;url=../logout.php" />
    <body>
      <?php
      include("../header.php");
      ?>

      <div class="container" method="POST" action="">
        <?php
        $studentID = $_SESSION["theid"];
        $sql = "SELECT * FROM students WHERE studentid= '$studentID'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class ="row mb-5">
          <div class="col">
          <label class="fw-bold fs-6">Student Name: </label>
          <input name="username" class="form-control fw-bold fs-5" type="text" value="<?php echo $row['lastname'].', '.$row['firstname']; ?>" readOnly>
          </div>
          <div class="col">
          <label class="fw-bold fs-6">Year Level: </label>
          <input name="username" class="form-control fw-bold fs-5" type="text" value="<?php echo $row['year']; ?>" readOnly>
          </div>
          <div class="col">
          <label class="fw-bold fs-6">Section: </label>
          <input name="username" class="form-control fw-bold fs-5" type="text" value="<?php echo $row['section']; ?>" readOnly>
          </div>
        </div>
          <div class="row" style="background: rgba(170, 209, 163, 0.5)">
            <?php
              $id = $_SESSION['theid'];
              $sql = "select * from billing where studentid = '$id' and datecreated = (SELECT MAX(datecreated) FROM billing) ORDER BY billingid DESC LIMIT 1";
              $result = mysqli_query($conn, $sql);
              if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
              } 
            ?>
                  <div class="col-md-6" >
                    <br />
                    <table class="table table-sm">
                      <tbody>
                        <tr><th scope="row">TUITION FEE</th>                 <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['tuitionfee']; ?></td></tr>
                        <tr><th scope="row">LEARNING AND INSTRUCTIONAL</th>  <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['learnandins']; ?></td></tr>
                        <tr><th scope="row">REGISTRATION FEE</th>            <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['regfee']; ?></td></tr>
                        <tr><th scope="row">COMPUTER PROCESSING FEE</th>     <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['compprossfee']; ?></td></tr>
                        <tr><th scope="row">GUIDANCE AND COUNSELING</th>     <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['guidandcouns']; ?></td></tr>
                        <tr><th scope="row">SCHOOLD ID FEE</th>              <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['schoolidfee']; ?></td></tr>
                        <tr><th scope="row">STUDENT HANDBOOK</th>            <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['studenthand']; ?></td></tr>
                        <tr><th scope="row">SCHOOL PUBLICATION</th>          <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['schoolfab']; ?></td></tr>
                        <tr><th scope="row">INSURANCE</th>                   <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['insurance']; ?></td></tr>

                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <br />
                    <table class="table table-sm">
                      <tbody>
                        <tr><th scope="row">TOTAL ASSESSMENT</th>                    <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['totalass']; ?></td></tr>
                        <tr><th scope="row">(Less) Discount/Scholar</th>             <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['discount']; ?></td></tr>
                        <tr><th scope="row">NET ASSESSED</th>                        <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['netass']; ?></td></tr>
                        <tr><th scope="row">(Less) Cash/Cheque Payment</th>          <td class="fw-bold fs-5" style="text-align:right;padding-right:50px;"><?php echo $row['cashcheckpay']; ?></td></tr>
                        <tr><th scope="row">OUTSTANDING BALANCE</th>                 <td class="fw-bold fs-2" style="text-align:right;padding-right:50px;"><?php echo $row['balance']; ?></td></tr>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
<?php
include '../footer.php';
?>
      <script>
      if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
      }
      </script>
    </body>
    </html>
