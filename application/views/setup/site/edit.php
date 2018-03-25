<div class="card">
    <div class="card-body card-padding">
        <?php echo form_open("", array("id" => "frmUpdateInfo")); ?>
        <input type="hidden" value="<?php echo $site_info->S_INFO_ID; ?>" name="txtInfoId" id="txtInfoId" />
        <div class="form-group fg-line">
            <label for="txtInfoTitle">Title</label>
            <input type="text" placeholder="Enter Information Title" id="txtInfoTitle" name="txtInfoTitle" class="form-control input-sm" required="required" value="<?php echo $site_info->S_INFO_TITLE; ?>" />
        </div>
        <div class="form-group fg-line">
            <label for="txtInfoDesc">Description</label>
            <textarea class="input-block-level summernote1" name="txtInfoDesc" rows="18"><?php echo $site_info->S_INFO_DESC; ?></textarea>
        </div>
        <button class="btn btn-primary btn-sm" id="btnUpdateInfo" type="button">Update</button>
        <button data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
        <span id="frmMsg"></span>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    $(document).ready(function(){
        
    });
</script>