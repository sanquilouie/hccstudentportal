<!-- SUBJECT UPDATE -->
<div class="modal fade" id="<?php echo 'enrolleeUpload'.$row["subjectid"] ?>" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Import Enrollees for <br/><?php echo $row["subject"] ?> </h5>
      </div>
      <div class="modal-body">
        <form action="" id="addUser" method="POST">
        
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="import" id="import" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>    
    </div>
  </div>
</div>
