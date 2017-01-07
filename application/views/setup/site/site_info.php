<link href="<?php echo base_url(); ?>resources/vendors/summernote/summernote.css" rel="stylesheet">
<div class="card col-md-6">
    <div class="card-header">
        <h2>Create New Site Information</h2>
    </div>
    <div class="card-body card-padding">
        <?php echo form_open(); ?>
        <div class="form-group fg-line">
            <label for="txtInfoTitle">Title</label>
            <input type="text" placeholder="Enter Information Title" id="txtInfoTitle" name="txtInfoTitle" class="form-control input-sm" required="required" />
        </div>
        <div class="form-group fg-line">
            <label for="txtInfoDesc">Description</label>
            <textarea class="input-block-level" id="summernote" name="txtInfoDesc" rows="18"></textarea>

        </div>
        <button class="btn btn-primary btn-sm m-t-10 waves-effect waves-button waves-float" type="submit">Submit</button>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="card col-md-6">
    <div class="card-header">
        <h2>Basic Table <small>Basic example without any additional modification classes</small></h2>
    </div>

    <div class="card-body table-responsive" style="overflow: hidden;" tabindex="0">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($site_info)) {
                    $i = 1;
                    foreach ($site_info as $info) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $info->S_INFO_TITLE; ?></td>
                            <td>
                                <a class="btn btn-primary btn-xs editInfo" data-toggle="modal" href="#modal_window" data-info_id="<?php echo $info->S_INFO_ID; ?>">edit</a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4">No Data Found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="<?php echo base_url(); ?>resources/vendors/summernote/summernote.min.js"></script>
<script>
    $(document).ready(function(){
        $('#summernote').summernote({
            height: 150,
            onChange: function(contents, $editable) {
                $('.note-codable').text(contents);
            }
        });
        $(document).on('click', '.editInfo', function() {
            var info_id = $(this).attr("data-info_id");
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('setup/updateSiteInfoModal'); ?>",
                data:{info_id:info_id},
				success: function(result) {                    
                    $('#modal_window .modal-body').html(result);
                    $('.summernote1').summernote({
                        height: 150,
                        onChange: function(contents, $editable) {
                            $('.note-codable').text(contents);
                        }
                    });
                }
            });
        });
        $(document).on('click', '#btnUpdateInfo', function() {
            if(confirm("Are You Sure?")){
                //var frmInfo = $("#frmUpdateInfo").serialize();
				var site_id = $("#txtInfoId").val();
				var site_title = $("#txtInfoTitle").val();
				var desc = $(".summernote1").code();
                $.ajax({
                    type: "POST",
                    url:"<?php echo site_url('Setup/updateSiteInfo'); ?>",
                    data:{site_id:site_id,site_title:site_title,desc:desc},
                    success: function(result) {                    
                        $("#frmMsg").html(result);
                    }
                });
            }else{
                return false;
            }
        });
    });
</script>