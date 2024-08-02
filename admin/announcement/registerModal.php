<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Announcement: </h5>
      </div>
      <div class="modal-body">
        <form action="" method="POST" >
        <div class="col">
              <label class="fs-5 fw-bold">Title:</label>
              <div class="input-group input-group-lg">
              <input type="text" name="txttitle" class="form-control fw-bold" placeholder="Title" value="" required/>
            </div>            
            </div>
            <div class="col-5 pt-2">
              <label class="fs-5 fw-bold">Expiration Date:</label>
              <input type="date" name="txtduration" class="form-control" placeholder="Expiration Date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date('Y-m-d');?>" required/>
            </div>    
            <div class="col pt-2">
              <div class="form-floating">
                <textarea class="form-control" placeholder="Content" name="txtcontent" id="txtcontent" style="height: 220px"value="" required></textarea>
                <label for="txtcontent" class="fw-bold">Content</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="addAnnouncement" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>    
    </div>
  </div>
</div>  



