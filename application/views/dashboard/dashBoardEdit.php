<div class=" row" >
    <form method="post" action="<?php echo site_url('monitor/monitor/edit_dashboardData'); ?>">

        <div class=" col-sm-12 col-md-4">
            <div class="widget widget-body">
                <div class=" widget-head" >
                    <h4 class=" heading glyphicons forward"><i></i>Basic Information</h4>
                </div>
                <div class="widget-body innerAll">
                    <input type="hidden" name="dash_no" id="dash_no" class="form-control" value="<?php echo $dashInfo->DASH_NO; ?>"/>
                    <label>Notification For</label>
                    <?php echo form_dropdown('cmbDashboard', $dashInfo->DASHFOR, $dashInfo->DASH_FOR, 'class=" form-control" id="cmbDashboard"'); ?>
                    <div class=" separator bottom"></div>
                    <label>Dashboard Note</label>
                    <textarea name="dashNote" id="dashNote" class="jqte_editor form-control"><?php echo $dashInfo->DASH_NOTE; ?></textarea>
                    <div class=" separator bottom"></div>
                    <label>Dashboard Notice</label>
                    <textarea name="dashNotice" id="dashNotice" class="jqte_editor form-control"><?php echo $dashInfo->DASH_NOTICE; ?></textarea>
                    <div class=" separator bottom"></div>
                    <label>Notice Valid till </label>
                    <input type="text" name="dashNoticeValid" placeholder="dd/mm/yyyy" id="dashNoticeValid" value="<?php echo date("d/m/Y", strtotime($dashInfo->VALID_TILL)); ?>" class="form-control"/>
                    <div class=" separator bottom"></div>
                    <label>Dashboard Alert</label>
                    <input type="text" name="dashAlert" id="dashAlert" class="form-control" value="<?php echo $dashInfo->DASH_ALERT; ?>"/>
                    <div class=" separator bottom"></div>
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
                            <?php foreach ($dashInfodetails as $row): ?>
                                <tr class="selectable dashChdRow_<?php echo $row->DASHCHD_NO; ?>">
                                    <td class="center js-sortable-handle"><span class="fa fa-arrows move"></span></td>
                            <input type="hidden" name="DASHCHD_NO[]" id="DASHCHD_NO_1" class="dashbordFor" value="<?php echo $row->DASHCHD_NO; ?>"/>                      
                            <td><?php echo form_input(array('name' => 'pre_dashDescrip[]', 'id' => 'dashDescrip_1', 'class' => 'form-control', 'value' => $row->DASH_DESC)); ?></td>
                            <td><?php echo form_input(array('name' => 'pre_dashValue[]', 'id' => 'dashValue_1', 'class' => 'form-control', 'value' => $row->DASH_VALUE)); ?></td>
                            <td class="center"><span class="deleteDataRow btn btn-xs btn-danger" title="Delete" dash_chd_no="<?php echo $row->DASHCHD_NO; ?>"><i class="fa fa-trash-o"></i></span></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <button id="saveVoucher" class="btn btn-success" type="submit"><i class="fa fa-check-circle"></i> Save</button>
                    <a class="btn btn-default" href=""> <i class="fa fa-times"></i>Cancel</a>
                </div>
            </div>
        </div>



    </form>
</div>

<script>
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
        
        $('form').submit(function () {
            window.onbeforeunload = null;
        });
    });
    //*/
</script>
