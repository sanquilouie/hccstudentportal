<!-- STUDENT DELETE -->
<div class="modal fade" id="<?php echo 'billingDelete'.$row["billingid"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Remove Billing Info</h5>
        </div>
        <div class="modal-body">
        <form action="" method="POST" >
            <h4 class="text-center p-3">Are you sure you want to delete this entry?</h4>
                  <input type="text" name="billingid"  value="<?php echo $row["billingid"]?>" hidden/>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="studentDelete" class="btn btn-danger">Delete</button>
            </div>
            </form>
        </div>    
        </div>
    </div>
</div>

