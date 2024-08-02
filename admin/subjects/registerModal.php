
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Subject: </h5>
      </div>
      <div class="modal-body">
        <form action="" id="addUser" method="POST" >
          <div class="container">
              <div class="col-md pb-3">
                <label>Subject Description: </label>
                <input type="text" name="subject" id="addSubject" class="form-control" placeholder="Subject Description" value="" required/>
              </div>
              <div class="col-md pb-3">
                <label>Faculty Assigned: </label>
                <select name="faculty" id="facultySelect" class="form-select" required>
                  <option value="">-- Faculty Assigned -- </option>
                    <?php
                      $sql = "SELECT * FROM users u INNER JOIN faculty f on f.facultyid=u.userid where f.role='Faculty'";
                      
                      $result1 = mysqli_query($conn, $sql);
                        if ($result1->num_rows > 0) {
                          while ($row1 = mysqli_fetch_array($result1)) {
                            echo '<option value="'.$row1["facultyid"].'">'.$row1["firstname"].' '.$row1["lastname"].'</option>';
                           }
                        }
                  ?>       
                </select>
              </div>
            <div class="row pb-3">
              <div class="col-md-6">
                <label for="inputYear">Select a Year: </label>
                <select id="addYear" name="year" class="form-select" required>
                  <option value="">-- Select a Year -- </option>
                  <option value="First Year">First Year</option>
                  <option value="Second Year">Second Year</option>
                  <option value="Third Year">Third Year</option>
                  <option value="Fourth Year">Fourth Year</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="inputSem">Select a Semester: </label>
                <select id="addSem" name="sem" class="form-select" required>
                  <option value="">-- Select a Semester -- </option>
                  <option value="First Semester">First Semester</option>
                  <option value="Second Semester">Second Semester</option>
                  <option value="Third Semester">Third Semester</option>
                  <option value="Fourth Semester">Fourth Semester</option>
                </select>
              </div>
            </div>
            <div class="row pb-3">
              <div class="col-md-6">
                  <label>Subject Code: </label>
                  <input type="text" name="code" id="addCode" class="form-control" placeholder="Subject Code" value="" required/>
              </div>
              <div class="col-md-6">
                  <label>Units: </label>
                  <input type="text" name="unit" id="addUnit" class="form-control" placeholder="Units" value="" required/>
              </div>
            </div>
              <div class="col-md pb-3">
                <label>Course: </label>
                <select name="course" id="addCourse" class="form-select" required>
                  <option value="">-- Select a Course -- </option>
                    <?php
                      $sql = "SELECT DISTINCT course FROM cys";

                      $result1 = mysqli_query($conn, $sql);
                        if ($result1->num_rows > 0) {
                          while ($row1 = mysqli_fetch_array($result1)) {
                            echo '<option value="'.$row1["course"].'"> '.$row1["course"].'</option>';
                           }
                        }
                  ?>
                </select>
              </div>
              <div class="col-md pb-3">
            <label>Subject Color</label>
            <input type="color" class="form-control form-control-color" name="color" value="" title="Choose your color" required>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="register" class="btn btn-primary">Add Subject</button>
            </div>
          </div>
        </form>
      </div>    
    </div>
  </div>
</div>  
<script>
  /** $(document).ready(function() {
$('#facultySelect').select2({
  theme: 'bootstrap-5',
  dropdownParent: $('#registerModal')
 });
});*/
  
  </script>


