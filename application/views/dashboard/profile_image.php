<style type="text/css">
    #change_image{
        display:none;
    }
</style>
<div class=" widget-body">
    <div class="row">
        <div class=" col-md-4">
            <?php if (!$row->PROFILE_PIC_NAME == '') { ?>
                <a data-toggle='tooltip' data-title='<?php //echo $row->USERNAME;        ?>' title="Click to view full image" data-placement='right' href="<?php echo base_url(); ?>resources/images/<?php echo $row->PROFILE_PIC_NAME; ?>" target="_blank">
                    <img width="60%" height="60%" src="<?php echo base_url(); ?>resources/images/<?php echo $row->PROFILE_PIC_NAME; ?>">
                </a>
                <?php
            } else {
                if ($row->GENDER == "M") {
                    ?>
                    <img width="50%" height="50%" src="<?php echo base_url(); ?>resources/images/default_mail.png" >
                <?php } else { ?>
                    <img width="50%" height="50%" src="<?php echo base_url(); ?>resources/images/default_femail.jpg">
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div><br/><br/><br/>
<h3><button class=" btn btn-sm btn-success" id="changeImage">Change Image</button></h3>
<br/>
<div id = "change_image"> 
    <div class=" widget-body">
        <?php echo form_open_multipart('dashboard/dashboard/profile_image_insert') ?>
        <table class=" table-bordered">
            <tr>
                <td>
                    <input type="hidden" name="textUserId" id="textUserId" value="<?php echo $row->USER_ID; ?>"/>
                    Upload Image
                    <input type='file' name='userfile' size='20' required='required' />
                    <br/><br/>
                    <button class="btn btn-info" type="submit"><i class="fa fa-check-circle"></i>Save Image</button>
                </td>
            </tr>
        </table>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    $(document).on('click', '#changeImage', function () {
        $('#change_image').toggle();
    });
</script>