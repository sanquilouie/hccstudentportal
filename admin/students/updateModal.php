<!-- FACULTY UPDATE -->
<div class="modal fade" id="<?php echo 'studentUpdate'.$row["studentid"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Student Member</h5>
      </div>
      <div class="modal-body">
        <form action="" id="addUser" method="POST">
        <div class="row pb-3 pt-3">
          <div class="col-md">
            <label class="fw-bold">Student ID: </label>
            <input type="number" name="txtstudentid" class="form-control" placeholder="User ID" value="<?php echo $row["studentid"] ?>" onkeydown="return event.keyCode !== 69" readOnly/>
          </div>
          <div class="col-md">
            <label class="fw-bold">First Name: </label>
            <input onkeydown="return /[a-z, ]/i.test(event.key)" type="text" name="txtstudentfname" class="form-control" placeholder="First Name" value="<?php echo $row["firstname"] ?>" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">Last Name:</label>
            <input onkeydown="return /[a-z, ]/i.test(event.key)" type="text" name="txtstudentlname" class="form-control" placeholder="Last Name" value="<?php echo $row["lastname"] ?>" required/>
          </div>
        </div>
        <div class="col-md pb-3">
          <label class="fw-bold">Address: </label>
          <input type="text" name="txtaddress" class="form-control" placeholder="Address" value="<?php echo $row["address"] ?>" onkeydown="return event.keyCode !== 69" required/>
        </div>
        <div class="row pb-3">
          <div class="col-md">
              <label class="fw-bold">Email: </label>
              <input type="email" name="txtstudentemail" class="form-control" placeholder="Email" value="<?php echo $row["email"] ?>" required/>
          </div>
          <div class="col-md">
              <label class="fw-bold">Contact Number: </label>
              <input type="number" name="txtstudentcontact" class="form-control" placeholder="Contact Number" value="<?php echo $row["contact"] ?>" onkeydown="return event.keyCode !== 69" required/>
          </div>
          <div class="col-md">
              <label class="fw-bold">Birthdate: </label>
              <input type="date" name="txtbirthdate" class="form-control" placeholder="Birthdate" value="<?php echo $row["birthday"] ?>" onkeydown="return event.keyCode !== 69" required/>
          </div>
        </div>
        <div class="row pb-3">
          <div class="col-md">
            <label class="fw-bold">Course: </label>
              <select id="addDept" name="txtcourse" class="form-control" required>
              <option selected value="<?php echo $row["course"] ?>"><?php echo $row["course"] ?></option>
                <option value="BSCS">BSCS</option>
                <option value="BSED">BSED</option>
                <option value="BSCRIM">BSCRIM</option>
              </select>
          </div>
          <div class="col-md">
              <label class="fw-bold">Year: </label>
              <input type="text" name="txtyear" class="form-control" placeholder="Year" value="<?php echo $row["year"] ?>" required/>
            </div>
            <div class="col-md">
              <label class="fw-bold">Section:</label>
              <input type="text" name="txtsection" class="form-control" placeholder="Section" value="<?php echo $row["section"] ?>" required/>
            </div>
        </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="studentUpdate" class="btn btn-primary">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
