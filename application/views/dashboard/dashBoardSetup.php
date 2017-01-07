<link href='<?php echo base_url(); ?>resources/assets/jquery-te/css/jquery-te-1.4.0.css' rel='stylesheet' type='text/css'>
<style>
    .text_right{text-align: right;}
    .padding_right_10{padding-right: 10px;}
    .jqte{margin: 5px 0 !important;}
    #dashNoticeValid{width: 120px;}
</style>
<div id="edit_dashboard_date">
    <div class=" row" >
        <?php echo form_open('', array('class' => 'margin-none', 'id' => 'voucherEntryForm')); ?>
        <div class=" col-sm-12 col-md-4">
            <div class="widget widget-body">
                <div class=" widget-head" >
                    <h4 class=" heading glyphicons forward"><i></i>Basic Information</h4>
                </div>
                <div class="widget-body padding-none">
                    <div id="showDahsData" class="widget-body innerAll">
                        <?php // foreach($dashInfo as $row){//echo '<pre>';print_r($dashInfo);exit;?>
                        <label>Notification For <span class="requiredLevel">*</span></label>
                        <select required="required" class=" form-control" name="cmbDashboard" id="cmbDashboard">
                            <option value="">Select</option>
                            <option value="1">Heqep admin</option>    
                            <option value="2">Accounts</option> 
                            <option value="3">M & E</option> 
                            <option value="4">Sub project</option> 
                        </select>
                        <div class=" separator bottom"></div>
                        <label>Dashboard Note</label>
                        <textarea name="dashNote" id="dashNote" class="jqte_editor form-control"></textarea>
                        <div class=" separator bottom"></div>
                        <label>Dashboard Notice</label>
                        <textarea name="dashNotice" id="dashNotice" class="jqte_editor form-control" ></textarea>
                        <div class=" separator bottom"></div>
                        <label>Notice Valid till </label>
                        <input type="text" name="dashNoticeValid" placeholder="dd/mm/yyyy" id="dashNoticeValid" class="form-control" />
                        <div class=" separator bottom"></div>
                        <label>Dashboard Alert</label>
                        <input type="text" name="dashAlert" id="dashAlert" class="form-control"/>
                        <div class=" separator bottom"></div>

                        <?php //} ?>
                    </div>
                </div>
            </div>
        </div>

        <div class=" col-lg-8 col-md-8 col-sm-12">
            <div class="widget">
                <div class=" widget-head">
                    <h4 class="heading">Details</h4>
                </div>
                <div id="showDahsData" class="widget-body innerAll">

                    <table id="detailsBody" class=" table table-bordered table-condensed table-primary js-table-sortable table-vertical-center table-striped">
                        <thead>
                            <tr>
                                <th style="width: 1%;" class="center">Drag</th>
                                <th>Dahsboard Description</th>
                                <th>Dahsboard Value</th>
                                <th class="center"><a id="addMore"class="btn btn-sm btn-success" href="javascript:void();" ><i class="fa fa-plus"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="selectable">
                                <td class="center js-sortable-handle"><span class="fa fa-arrows move"></span></td>
                                <td><?php echo form_input(array('name' => 'dashDescrip[]', 'id' => 'dashDescrip_1', 'class' => 'form-control')); ?></td>
                                <td><?php echo form_input(array('name' => 'dashValue[]', 'id' => 'dashValue_1', 'class' => 'form-control')); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <button id="" class="btn btn-success" type="submit"><i class="fa fa-check-circle"></i> Save</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="row">
    <div class="widget widget-body">
        <div class="col-md-12">
            <table class=" table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Dahsboard For</th>
                        <th>Dashboard Note</th>
                        <th>Dashboard Notice</th>
                        <th>Dashboard Alert</th>
                        <th>Valid Till</th>
                        <th width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dash_info as $row) { ?>
                        <tr class="dashRow_<?php echo $row->DASH_NO; ?>">
                            <td><?php echo $row->DASHFOR; ?></td>
                            <td><?php echo $row->DASH_NOTE; ?></td>
                            <td><?php echo $row->DASH_NOTICE; ?></td>
                            <td><?php echo $row->DASH_ALERT; ?></td>
                            <td><?php echo date('d M, Y', strtotime($row->VALID_TILL)); ?></td>
                            <td class="center">
                                <span id="<?php echo $row->DASH_NO; ?>" title="Edit" class="btn btn-xs btn-info editDashboard" ><i class="fa fa-edit"></i></span>
                                <span id="<?php echo $row->DASH_NO; ?>" title="Delete" class="btn btn-xs btn-danger deleteDashboard" ><i class="fa fa-trash-o"></i></span>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>resources/assets/jquery-te/js/jquery-te-1.4.0.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/inputmask/assets/lib/jquery.inputmask.bundle.min.js"></script>

<script>
    var i = 2;
    $(document).on('click','#addMore',function(){
       
        $('#detailsBody tbody').append('<tr class="selectable"><td class="center js-sortable-handle"><span class="fa fa-arrows move"></span></td><td><input type="text" class="form-control" id="dashDescrip_' + i + '" value="" name="dashDescrip[]"></td><td><input type="text" class="form-control required_field   reAmount" id="dashValue_' + i + '" value="" name="dashValue[]"></td><td class="center"><a href="javascript:void(0);" class="btn btn-xs btn-danger remove_row"><i class="fa fa-times"></i></a></td></tr>');
          
        i++;   
    });

    $(document).on('click','.remove_row',function(){
        $(this).closest('tr').remove();
    });
    if (typeof $.fn.bdatepicker == 'undefined')
        $.fn.bdatepicker = $.fn.datepicker.noConflict();
    $(function ()
    {
        $("#startDate").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            onSelect:function(){
                $("#endDate").datepicker("option", "minDate", $(this).val());
            }
        });
    });
    $(document).on('click','.editDashboard',function(){
        var id=$(this).attr('id');
        //alert(id);
        $.ajax({
            type:'POST',         
            url:'<?php echo site_url('monitor/monitor/edit_dashborad'); ?>',
            data:{id : id},         
            success:function(data){
                $('#edit_dashboard_date').html(data);
                // alert(data);
            }
        });
    });
    
    $(document).on('click','.deleteDashboard', function(){
        if (confirm('Are You Sure?')) {
            var dash_no = $(this).attr('id');
            $.ajax({ 
                type: "POST",
                url: "<?php echo site_url('monitor/monitor/delete_dash_data'); ?>",
                data: {dash_no:dash_no},
                success: function(result) {
                    $('.dashRow_'+dash_no).hide();
                }                
            });
            
        } else {
            return false;
        }
    });
    
    
    $(document).on('click','.deleteDataRow', function(){
        if (confirm('Are You Sure?')) {
            var dash_chd_no = $(this).attr('dash_chd_no');
            $.ajax({ 
                type: "POST",
                url: "<?php echo site_url('monitor/monitor/delete_dash_chd_data'); ?>",
                data: {dash_chd_no:dash_chd_no},
                success: function(result) {
                    $('.dashChdRow_'+dash_chd_no).hide();
                }                
            });
            
        } else {
            return false;
        }
    });
    //*
    $(document).ready(function () {
        
        $("#dashNoticeValid").inputmask("d/m/y", {autoUnmask: true});
        
        var warning = true;
        $('.jqte_editor').jqte({
            change: function () {
                window.onbeforeunload = function () {
                    if (warning) {
                        return 1;
                    }
                }
            }
        });
    });
//*/
</script>
