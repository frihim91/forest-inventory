<style type="text/css">
    @media print {
        #conditionalArea, .heading-arrow{display: none;}
        th.border-bottom-none, td.border-bottom-none{border-bottom: medium none !important;}
        th.border-top-none, td.border-top-none{border-top: medium none !important;}
    }
</style>
<div id="conditionalArea" class="row">
    <div class="col-sm-12 col-md-4">
        <div class="widget widget-body-white">
            <div class="widget-head">
                <h4 class="heading glyphicons forward"><i></i>Module Report Category</h4>
            </div>
            <div class="widget-body padding-none">
                <div class="widget-body innerAll">
                    <label for="RE_MOD">Select Report</label>
                    <?php echo form_dropdown('RE_MOD', $report_mod, '', 'class="dropdown-option " id="RE_MOD" style="width: width: 100%;" required '); ?>
                    <div class="separator bottom"></div>
                    <div class="row separator-mini">
                        <div style="float: right; padding-right: 5px;">
<!--                            <button type="button" data-toggle="print" class="btn btn-info btn-icon glyphicons print hidden-print"><i></i> Print</button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget widget-body-white"  id="reportCatList"></div>
    </div> 
    <div class="col-md-8 col-sm-12">
        <div class="widget">
            <div class="widget-head">
                <h4 class="heading glyphicons down_arrow"><i></i>Report Parameters</h4>
            </div>
            <div class="widget-body innerAll" id="reportParameterArea">
            </div>
        </div>
    </div>
</div>
<div id="reportShowArea" class="row"></div>
<script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/inputmask/assets/lib/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '#RE_MOD', function () {
            var report_id = $(this).val();
            if (report_id == '') {
                $('#reportParameterArea').html('');
                $('#reportShowArea').html('');
                $('#reportCatList').html('');
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('dashboard/securityAccess/add_parameters_by_report_module'); ?>',
                    data: {report_id: report_id},
                    success: function (data) {
                        $('#reportParameterArea').html(data);
                        $('#reportShowArea').html('');
                    }
                });
                
                 $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('dashboard/securityAccess/get_parameters_by_report_module'); ?>',
                    data: {report_id: report_id},
                    success: function (data) {
                        $('#reportCatList').html(data);
                    }
                });
            }
        });
        
        $(document).on('click', '.editCatParameter', function () {
            var cat_id = $(this).attr('cat_no');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('dashboard/securityAccess/edit_report_module_cat'); ?>',
                    data: {cat_id: cat_id},
                    success: function (data) {
                        $('#reportParameterArea').html(data);
                    }
                });

        });

        $(document).on("click", "#showReport", function (e) {
            $('#reportShowArea').html('');
            var isSubmit = 'Yes';
            $('.required_field').each(function () {
                if ($(this).val() == "") {
                    $(this).css("border", "1px solid red");
                    isSubmit = 'No';
                } else {
                    $(this).css("border", "");
                }
            });
            if (isSubmit == 'Yes') {
                //if (confirm("Are you sure you want to Show Report ?")) {
                $.ajax({
                    type: 'POST',
                    url: $('#frmShowReport').attr("action"),
                    data: $("#frmShowReport").serialize(),
                    success: function (data) {
                        $('#reportShowArea').html(data);
                    }
                });
                /*}
                 else {
                 return false;
                 }*/
            }
            e.preventDefault();
        });
    });

        
    $(document).ready(function () {
        var warning = true;
        $('form').submit(function() {
            window.onbeforeunload = null;
        });
    });
    
</script>