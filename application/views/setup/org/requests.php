
    

<style>
    .noOfBranch{color:#0039F2; cursor: pointer;}
    .textCenter{text-align: center;}
    .sendMail{font-size: 16px; cursor: pointer;}
</style>
<div class="widget fluid">
    <div class="whead"><h6>New Request For Care Provider Template</h6><div class="clear"></div></div>
    <div id="dyn2" class="shownpars">
        <a class="tOptions act" title="Options"><img src="<?php echo site_url(); ?>media/admin/images/icons/options.png" alt="" /></a>
        <table cellpadding="0" cellspacing="0" border="0" width="100%" id="dataTable" class="dTable dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Logo</th>
                    <th>Organization Name</th>
                    <th>Care Provider Template Name</th>
                    <th>Care Provider Type</th>
                    <th>No of Branch</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($requests as $request) {
                    ?>
                    <tr>
                        <td><?php echo $i . '.'; ?></td>
                        <td><img style="width: 80px;" src="<?php echo base_url(); ?>media/uploads/org_img/<?php echo $request->LOGO; ?>" alt="<?php echo $request->ORG_NAME; ?>" title="<?php echo $request->ORG_NAME; ?>" /></td>
                        <td><?php echo $request->ORG_NAME; ?></td>
                        <td><?php echo $request->HC_NAME; ?></td>
                        <td><?php echo $request->LOOKUP_DATA_NAME; ?></td>
                        <td class="textCenter"><span title="Click here for Details" class="noOfBranch" orgId="<?php echo $request->ORG_ID; ?>"><?php echo $request->NOOFBRANCH; ?></span></td>
                        <td class="textCenter"><i title="Send Mail" class="sendMail fa fa-envelope" orgId="<?php echo $request->ORG_ID; ?>"></i></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table> 
    </div>
    <div class="clear"></div> 

</div>
<div class="dialog"></div>

<script src="<?php echo base_url(); ?>media/doctor/js/jquery.dataTables.js" type="text/javascript" language="javascript"></script>

<script type="text/javascript">
    <?php if(isset($_GET['success'])){
        if($_GET['success'] == 'ok'){
        ?>
        alert('Successfully Sent the message');
    <?php } else if($_GET['success'] == 'sorry'){ ?>
        alert('Sorry the message has not been sent! The file you selected is not a valid file. you can only upload jpg, png, gif, zip, rar, pdf, xls, ppt, txt, xlsx, word, doc and docx formated file.');
        <?php } } ?>
    //$(document).ready(function(){
        $( ".dialog" ).dialog({
            autoOpen: false,
            minHeight: 500,
            minWidth: 800,
            modal: true,
            buttons: {
                Close: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        
        $( ".noOfBranch" ).on('click', function() {
            $( ".dialog" ).dialog( "open" );
            var orgId = $(this).attr('orgId');
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('admin/careProviders/get_all_branch_by_org'); ?>",
                data: {org : orgId},
                
                beforeSend: function(result) {
                    $('.loader').html(result);
                },
                success: function(result) {
                    $('.dialog').html(result);
                }
            });
        });
        
        
        $( ".sendMail" ).on('click', function() {
            $( ".dialog" ).dialog( "open" );
            var orgId = $(this).attr('orgId');
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('admin/careProviders/send_mail_to_requested_org'); ?>",
                data: {org : orgId},
                
                beforeSend: function(result) {
                    $('.loader').html(result);
                },
                success: function(result) {
                    $('.dialog').html(result);
                }
            });
        });
        
    //});
    
    (function($) {
        
        $(document).on("click",".addModule",function(){
            
        });
    })(jQuery_1_10_2);

</script>