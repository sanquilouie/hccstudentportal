<!-- FACULTY UPDATE -->
<div class="modal fade" id="<?php echo 'billingUpdate'.$row["billingid"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Billing</h5>
      </div>
      <div class="modal-body">
        <form action="" id="addUser" method="POST">
        <input type="hidden" name="hiddenid" class="form-control" value="<?php echo $row["billingid"] ?>"/>
          <div class="col-md pb-2">
            <label class="fw-bold">Student ID: </label>
            <input type="number" name="txtstudentid" class="form-control" placeholder="User ID" value="<?php echo $row["studentid"] ?>" onkeydown="return event.keyCode !== 69" readOnly/>
          </div>
        <div class="row pb-1">
          <div class="col-md">
              <label class="fw-bold">Tuition Fee: </label>
              <input type="number" name="txttuitionfee" class="form-control" value="<?php echo $row["tuitionfee"] ?>" onkeydown="return event.keyCode !== 69" required/>
            </div>
            <div class="col-md">
              <label class="fw-bold">Learning & Instructional: </label>
              <input type="number" name="txtlearn" class="form-control" value="<?php echo $row["learnandins"] ?>" onkeydown="return event.keyCode !== 69" required/>
            </div>
            <div class="col-md">
              <label class="fw-bold">Registration Fee: </label>
              <input type="number" name="txtregis" class="form-control" value="<?php echo $row["regfee"] ?>" onkeydown="return event.keyCode !== 69" required/>
            </div>
        </div>
        <div class="row pb-1">
          <div class="col-md">
            <label class="fw-bold">Computer Processing Fee: </label>
            <input type="number" name="txtcomppros" class="form-control" value="<?php echo $row["compprossfee"] ?>" onkeydown="return event.keyCode !== 69" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">Guidance & Counseling: </label>
            <input type="number" name="txtguidance" class="form-control" value="<?php echo $row["guidandcouns"] ?>" onkeydown="return event.keyCode !== 69" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">School ID Fee: </label>
            <input type="number" name="txtschoolid" class="form-control" value="<?php echo $row["schoolidfee"] ?>" onkeydown="return event.keyCode !== 69" required/>
          </div>
        </div>
        <div class="row pb-1">
          <div class="col-md">
            <label class="fw-bold">Student Handbook: </label>
            <input type="number" name="txthandbook" class="form-control" value="<?php echo $row["studenthand"] ?>" onkeydown="return event.keyCode !== 69" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">School Publication: </label>
            <input type="number" name="txtpublication" class="form-control" value="<?php echo $row["schoolfab"] ?>" onkeydown="return event.keyCode !== 69" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">Insurance: </label>
            <input type="number" name="txtinsurance" class="form-control" value="<?php echo $row["insurance"] ?>" onkeydown="return event.keyCode !== 69" required/>
          </div>
        </div>
        <hr>
        <div class="row pb-1">
          <div class="col-md">
            <label class="fw-bold">Total Assessment: </label>
            <input type="number" name="txttotalass" class="form-control" value="<?php echo $row["totalass"] ?>" onkeydown="return event.keyCode !== 69" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">Discount: </label>
            <input type="number" name="txtdiscount" class="form-control" value="<?php echo $row["discount"] ?>" onkeydown="return event.keyCode !== 69" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">Net Assessed: </label>
            <input type="number" name="txtnetass" class="form-control" value="<?php echo $row["netass"] ?>" onkeydown="return event.keyCode !== 69" required/>
          </div>
        </div>
        <div class="row pb-1">
          <div class="col-md">
            <label class="fw-bold">Cash/Cheque Payment: </label>
            <input type="number" name="txtcash" class="form-control" value="<?php echo $row["cashcheckpay"] ?>" onkeydown="return event.keyCode !== 69" required/>
          </div>
          <div class="col-md">
            <label class="fw-bold">Outstanding Balance: </label>
            <input type="number" name="txtbalance" class="form-control" value="<?php echo $row["balance"] ?>" onkeydown="return event.keyCode !== 69" required/>
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