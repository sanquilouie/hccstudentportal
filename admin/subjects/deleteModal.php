<!-- SUBJECT DELETE -->
<div class="modal fade" id="<?php echo 'subjectDelete'.$row["subjectid"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Subject</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST" >
                    <h4 class="text-center p-3">Are you sure you want to delete <b><?php echo $row["subject"]?></b>?</h4>
                        <input type="text" name="subjectid"  value="<?php echo $row["subjectid"]?>" hidden/>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="subjectDelete" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>