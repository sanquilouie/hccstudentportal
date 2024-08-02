<!-- FACULTY DELETE -->
<div class="modal fade" id="<?php echo 'facultyDelete'.$row["facultyid"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Remove Faculty Member</h5>
        </div>
        <div class="modal-body">
        <form action="" method="POST" >
            <h4 class="text-center p-3">Are you sure you want to delete <br/><b><?php echo $row["firstname"].' '.$row["lastname"]?></b> from faculty?</h4>
                  <input type="text" name="facultyid"  value="<?php echo $row["facultyid"]?>" hidden/>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="facultyDelete" class="btn btn-danger">Delete</button>
            </div>
            </form>
        </div>    
        </div>
    </div>
</div>

