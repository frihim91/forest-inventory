<?php
/*
  echo '<pre>';
  print_r($subprojectinfo);
  echo '</pre>'; exit;
  // */
?>

<div class="innerLR">
    <div class="row">
        <?php if (isset($dashAlertData->DASH_ALERT) && $dashAlertData->DASH_ALERT != '') { ?>
            <div class="alert alert-danger">
                <a class="close dismisAlert" al_no="<?php echo $dashAlertData->ALERT_NO ?>" data-dismiss="alert">&times;</a>
                <p><i class="fa fa-bell"></i> <?php echo $dashAlertData->DASH_ALERT; ?></p>
            </div>
        <?php } ?>

        <?php if (isset($dashboardmst->DASH_ALERT) && $dashboardmst->DASH_ALERT != '' && ($dashboardmst->VALID_TILL >= date('Y-m-d'))) { ?>
            <div class="alert alert-warning">
                <a class="close" al_no="<?php echo $dashboardmst->DASH_NO ?>" data-dismiss="alert">&times;</a>
                <p><i class="fa fa-bell"></i> <?php echo $dashboardmst->DASH_ALERT; ?></p>
            </div>
        <?php } ?>
        <div class="col-md-6 tablet-column-reset">
            <div class="row">
                <div class="col-md-12">
                    <!-- Website Traffic Chart -->
                    <div class="widget widget-heading-simple widget-body-white widget-employees">
                        <!-- Widget Heading -->
                        <div class="widget-head">
                            <h4 class="heading glyphicons user"><i></i>Sub Projects</h4>
                        </div>
                        <!-- // Widget Heading END -->
                        <div class="widget-body padding-none">

                            <div class="row row-merge">

                                <div class="col-md-12 detailsWrapper">
                                    <div class="ajax-loading hide">
                                        <i class="fa fa-spinner fa fa-spin fa fa-4x"></i>
                                    </div>
                                    <div class="innerAll">
                                        <div class="title">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="text-primary"><?php echo $subprojectinfo->SUB_PROJECT_TITLE; ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p class="muted"><strong> Window Name </strong> : <?php echo $subprojectinfo->PR_WINDOW_NAME; ?></p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <p class="muted"><strong>Complete Proposal No (CP)</strong> : <?php echo $subprojectinfo->CP_NO; ?></p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <p class="muted"><strong>Area/Discipline/Subject as per section 19.2 of AIFOM</strong> : <?php echo $subprojectinfo->IMPLEMENT_UNIT_NO_NAME; ?></p>
                                                        </div>
                                                        <div class="col-md-12">&nbsp;</div>
                                                        <div class="col-md-12">
                                                            <h5 class="strong text-uppercase text-primary"><i class="fa fa-calendar text-regular fa fa-fixed-width"></i> Implementation Period</h5>
                                                            <p class="muted"><?php //echo $subprojectinfo->PROJECT_TIME . ($this->utilities->formatDate('M d, Y', $subprojectinfo->START_DT) != '') ? ' ( ' . $this->utilities->formatDate('M d, Y', $subprojectinfo->START_DT) . ' to ' . $this->utilities->formatDate('M d, Y', $subprojectinfo->END_DT) . ' )' : '';                             ?></p>
                                                            <hr />
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="col-md-12">
                                                                <div class="col-md-3"><strong>Commencement : </strong></div>
                                                                <div class="col-md-9">
                                                                    <p class="muted"><?php echo $this->utilities->formatDate('d M, Y', $subprojectinfo->START_DT); ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="col-md-3"><strong>Completion : </strong></div>
                                                                <div class="col-md-9">
                                                                    <p class="muted"><?php echo $this->utilities->formatDate('d M, Y', $subprojectinfo->END_DT); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">&nbsp;</div>

                                                        <div class="col-md-12">
                                                            <h5 class="strong text-uppercase text-primary"><i class="fa fa-money text-regular fa fa-fixed-width"></i> Total cost</h5>
                                                            <hr/>
                                                            <p class="muted"></p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="col-md-12">
                                                                <div class="col-md-2"><strong>In Taka : </strong></div>
                                                                <div class="col-md-10">
                                                                    <p class="muted"><?php echo $subprojectinfo->TOTAL_COST_TK; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="col-md-2"><strong>In US$ : </strong></div>
                                                                <div class="col-md-10">
                                                                    <p class="muted"><?php echo $subprojectinfo->TOTAL_COST_US; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">&nbsp;</div>
                                                <div class="col-md-12">

                                                    <h5 class="strong text-uppercase text-primary"><i class="fa fa-archive text-regular fa fa-fixed-width"></i> General Objective</h5>
                                                    <hr/>
                                                    <p><?php echo $subprojectinfo->GENERAL_OBJECTIVE; ?></p>
                                                    <div class="row">
                                                        <div class="widget widget-heading-simple widget-body-gray" data-toggle="collapse-widget">
                                                            <div class="widget-head "><i class="fa fa-group text-regular fa fa-fixed-width"></i><span class="text-uppercase strong text-primary"> Management</span> <span class="text-lowercase strong padding-none">Team</span></div>
                                                            <ul class="team">
                                                                <?php
                                                                $i = 1;
                                                                foreach ($subprojectstaff as $row):
                                                                    ?>
                                                                    <li style="width: 46%; margin: 5px 2%;"><span class="crt"><?php echo $i; ?></span><span class="strong"><?php echo $row->FIRST_NAME . ' ' . $row->MIDDLE_NAME . ' ' . $row->LAST_NAME; ?></span><span class="muted">&nbsp;<?php echo $row->DESIGNATION; ?></span></li>
                                                                    <?php
                                                                    $i++;
                                                                endforeach;
                                                                ?>
                                                            </ul>

                                                        </div>
                                                    </div>

                                                    <!--                                                    <div id="chart_pie" class="flotchart-holder"></div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- // Website Traffic Chart END -->
                </div>
            </div>
        </div>

        <div class="col-md-6 tablet-column-reset">
            <div class="col-md-6 tablet-column-reset">


                <div class="widget widget-heading-simple widget-body-gray">
                    <div class="widget-head widget-heading-simple">
                        <h4 class="heading glyphicons money"><i></i>Total. </h4>
                    </div>
                    <div class="widget-body">
                        <a href="#" class="widget-stats widget-stats-2 widget-stats-easy-pie">
                            <div data-builder-exclude="element children" data-percent="23" class="easy-pie inverse easyPieChart"><span class="value">23</span>%</div>
                            <span class="txt"><span class="count text-large inline-block">134</span> Million</span>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                </div>

                <div class="widget widget-heading-simple widget-body-gray" data-toggle="collapse-widget">
                    <div class="widget-head">
                        <h4 class="heading glyphicons shopping_cart"><i></i>Budget Details (in BDT lakh)</h4>
                    </div>
                    <div class="widget-body list products">
                        <table class="table table-striped">
                            <tbody>
                                <?php foreach ($sub_project_budget as $row) { ?>
                                    <!-- List item -->
                                    <tr>
                                        <td style="font-size: 25px; color: #666;"><i class="fa fa-money"></i></td>
                                        <td style="vertical-align: middle;"><?php echo $row->ITEM_NAME ?></td>
                                        <td class="text-right" style="vertical-align: middle;"><?php echo $this->utilities->drpchange($row->ESTIMATED_COST); ?></td>
                                    </tr>
                                    <!-- // List item END -->
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- List item -->
                    </div>
                </div>


            </div>

            <div class="col-md-6">
                <?php if (!empty($me_uploads)) { ?>
                    <div class="widget widget-heading-simple widget-body-white">
                        <div class="widget-head widget-heading-simple">
                            <h4 class="heading glyphicons envelope"><i></i>Notice Board</h4>
                        </div>
                        <div class="widget-body">
                            <table class="table table-bordered table-striped" width="100%" id="">
                                <thead>
                                    <tr>
                                        <th class="center">Type </th>
                                        <th class="center">Upload Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $medirUrl = base_url('resources/uploads/me_uploads/');
                                    foreach ($me_uploads as $row) {
                                        ?>
                                        <tr>
                                            <td><a target="_blank" href="<?php echo $medirUrl . '/' . $row->ATTACHMENT_FILE; ?>" title="Click here to View"><?php echo $row->LOOKUP_DATA_NAME; ?></a></td>
                                            <td><?php echo date('d M, Y', strtotime($row->CRE_DT)); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                <?php if (isset($dashMessageData->DASH_MESSAGE) && ($dashMessageData->DASH_MESSAGE != '')) { ?>
                    <div class="widget widget-heading-simple widget-body-white">
                        <div class="widget-head widget-heading-simple">
                            <h4 class="heading glyphicons envelope"><i></i>Message for six month report. </h4>
                        </div>
                        <div class="widget-body">
                            <p><?php echo $dashMessageData->DASH_MESSAGE; ?></p>
                        </div>
                    </div>
                    <?php
                }
                if ($dashboardmst->VALID_TILL >= date('Y-m-d')) {
                    ?>
                    <div class="widget widget-heading-simple widget-body-white">
                        <div class="widget-head widget-heading-simple">
                            <h4 class="heading glyphicons envelope"><i></i>Note</h4>
                        </div>
                        <div class="widget-body">
                            <?php echo $dashboardmst->DASH_NOTE; ?>
                        </div>
                    </div>
                    <div class="widget widget-heading-simple widget-body-white">
                        <div class="widget-head widget-heading-simple">
                            <h4 class="heading glyphicons envelope"><i></i>Notice</h4>
                        </div>
                        <div class="widget-body">
                            <?php echo $dashboardmst->DASH_NOTICE; ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="widget widget-heading-simple widget-body-white">
                    <div class="widget-head">
                        <h4 class="heading glyphicons star"><i></i>Additional Information </h4>
                    </div>
                    <div class="widget-body list bg-gray">
                        <ul>
                            <?php foreach ($dashboardchd as $dashinfo): ?>
                                <li>
                                    <a href="#"><?php echo $dashinfo->DASH_VALUE; ?></a>
                                </li>  
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>




            </div>

            <div class="col-md-12">
                <div class="widget">  
                    <div class="widget-head">
                        <h4 class="heading">Upload Documents</h4>
                    </div>
                    <div class="widget-body">
                        <?php echo form_open_multipart('subproject/reports/upload_sp_documents', array('class' => 'margin-none', 'id' => '')); ?>
                        <div class="row">  
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label class="col-md-5 control-label" for="upload_type">Document Type <span class="requiredLevel">*</span></label>
                                    <div class="col-md-6">
                                        <?php echo form_dropdown('UPLOAD_TYPE', $upload_doc_type, '', 'class="form-control" id="upload_type" required'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4 help">
                                    <strong><span class="help-head">Help: </span>Document Type</strong>
                                    <hr>
                                    <p class="muted">Please Select Document Type.</p>
                                </div> 
                            </div> 
                        </div>

                        <div class="row">  
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label class="col-md-5 control-label" for="upload_file">Select File: <span class="requiredLevel">*</span></label>
                                    <div class="col-md-6">
                                        <input type="file" name="DOC_FILE" accept=".pdf,.png,.jpg" id="upload_file" required />
                                    </div>
                                </div>
                                <div class="col-md-4 help">
                                    <strong><span class="help-head">Help: </span>Select File</strong>
                                    <hr>
                                    <p class="muted">Allowed file type: pdf, jpg, png and maximum size is 5 MB</p>
                                </div> 
                            </div> 
                        </div>

                        <div class="row">  
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label class="col-md-5 control-label" for="remarks">Remarks: </label>
                                    <div class="col-md-6">
                                        <textarea name="REMARKS" id="remarks"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 help">
                                    <strong><span class="help-head">Help: </span>Remarks</strong>
                                    <hr>
                                    <p class="muted">Brief Description about the Document.</p>
                                </div> 
                            </div> 
                        </div>

                        <div class="row">  
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label class="col-md-5 control-label">&nbsp;</label>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-primary" name="submit" value="Upload"  />
                                    </div>
                                </div>

                            </div> 
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>


                <?php if (!empty($uploaded_file)) { ?>
                    <div class="widget">  
                        <div class="widget-head">
                            <h4 class="heading">Uploaded Documents</h4>
                        </div>
                        <div class="widget-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="center">Upload Type</th>
                                        <th class="center">Upload Date</th>
                                        <th class="center">Remarks</th>
                                        <th class="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dirUrl = base_url('resources/uploads/sp_docs/');
                                    $i = 1;
                                    foreach ($uploaded_file as $row) {
                                        ?>
                                        <tr id="upld_row<?php echo $row->UPLOAD_NO; ?>">
                                            <td><?php echo $row->LOOKUP_DATA_NAME; ?></td>
                                            <td><?php echo date('d M, Y', strtotime($row->CRE_DT)); ?></td>
                                            <td><?php echo $row->REMARKS; ?></td>
                                            <td class="center">
                                                <a class="btn btn-info btn-xs text-center" target="_blank" href="<?php echo $dirUrl . '/' . $row->ATTACHMENT_FILE; ?>" title="<?php echo $row->LOOKUP_DATA_NAME; ?>" ><i class="fa fa-file"></i></a>   
                                                <span class=" btn btn-danger btn-xs deleteBtn text-center" title="Delete" file_name="<?php echo $row->ATTACHMENT_FILE; ?>" upd_no="<?php echo $row->UPLOAD_NO; ?>"><i class="fa fa-trash-o"></i></span>                                               
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/charts/flot/assets/lib/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/charts/flot/assets/lib/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/charts/flot/assets/lib/plugins/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/charts/flot/assets/custom/js/flotcharts.common.js"></script>
<script src="<?php echo base_url(); ?>resources/assets/components/modules/admin/charts/flot/assets/custom/js/flotchart-simple.init.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/charts/easy-pie/assets/lib/js/jquery.easy-pie-chart.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/charts/easy-pie/assets/custom/easy-pie.init.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/employees/assets/js/employees.init.js"></script>
<script src="<?php echo base_url(); ?>resources/assets/components/modules/admin/charts/flot/assets/custom/js/flotchart-pie.init.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/charts/flot/assets/lib/plugins/jquery.flot.orderBars.js"></script>
<script src="<?php echo base_url(); ?>resources/assets/components/modules/admin/charts/flot/assets/custom/js/flotchart-bars-ordered.init.js"></script>
<script src="<?php echo base_url(); ?>resources/shared/components/modules/admin/charts/flot/assets/lib/jquery.flot.pie.js"></script>

<script type="text/javascript">
    var basePath = '',
    commonPath = '<?php echo base_url(); ?>resources/assets/',
    rootPath = '<?php echo base_url(); ?>',
    DEV = false,
    componentsPath = '<?php echo base_url(); ?>resources/assets/components/';	
    var primaryColor = '#4a8bc2',
    dangerColor = '#b55151',
    infoColor = '#74a6d0',
    successColor = '#609450',
    warningColor = '#ab7a4b',
    inverseColor = '#45484d';	
    var themerPrimaryColor = primaryColor;
    
    
    (function($)
    {
        if (typeof charts == 'undefined') 
            return;

        charts.chart_ordered_bars = 
            {
            // chart data
            data: null,

            // will hold the chart object
            plot: null,

            // chart options
            options:
                {
                bars: {
                    show:true,
                    barWidth: 0.2,
                    fill:1
                },
                grid: {
                    show: true,
                    aboveData: false,
                    color: "#3f3f3f" ,
                    labelMargin: 5,
                    axisMargin: 0, 
                    borderWidth: 0,
                    borderColor:null,
                    minBorderMargin: 5 ,
                    clickable: true, 
                    hoverable: true,
                    autoHighlight: false,
                    mouseActiveRadius: 20,
                    backgroundColor : { }
                },
                series: {
                    grow: {
                        active:false
                    }
                },
                legend: {
                    position: "ne", 
                    backgroundColor: null, 
                    backgroundOpacity: 0
                },
                colors: [],
                tooltip: true,
                tooltipOpts: {
                    content: "%s : %y.0",
                    shifts: {
                        x: -30,
                        y: -50
                    },
                    defaultTheme: false
                }
            },
		
            placeholder: "#chart_ordered_bars",

            // initialize
            init: function()
            {
                // apply styling
                charts.utility.applyStyle(this);
			
                //some data
                var d1 = [];
                for (var i = 0; i <= 10; i += 1)
                    d1.push([i, parseInt(Math.random() * 30)]);
		 
                var d2 = [];
                for (var i = 0; i <= 10; i += 1)
                    d2.push([i, parseInt(Math.random() * 30)]);
		 
                var d3 = [];
                for (var i = 0; i <= 10; i += 1)
                    d3.push([i, parseInt(Math.random() * 30)]);
		 
                var ds = new Array();
		 
                ds.push({
                    label: "Data One",
                    data:d1,
                    bars: {
                        order: 1
                    }
                });
                ds.push({
                    label: "Data Two",
                    data:d2,
                    bars: {
                        order: 2
                    }
                });
                ds.push({
                    label: "Data Three",
                    data:d3,
                    bars: {
                        order: 3
                    }
                });
                this.data = ds;

                this.plot = $.plot($(this.placeholder), this.data, this.options);
            }
        };
		
        $(window).on('load', function(){
            setTimeout(function(){
                charts.chart_ordered_bars.init();
            }, 100);
        });
        
	
    })(jQuery);

        
    $(".dismisAlert").click(function(){
        if (confirm('Are You Sure?')) {
            var al_no = $(this).attr('al_no');
            $.ajax({ 
                type: "POST",
                url: "<?php echo site_url('apps/dismiss_dashboard_alert'); ?>",
                data: {al_no: al_no},
                success: function(result) {
                }                
            });
        }else{
            return false;
        }
    });
    
    $(".deleteBtn").click(function(){
        if (confirm('Are You Sure?')) {
            var file_name = $(this).attr('file_name');
            var upd_no = $(this).attr('upd_no');
            $.ajax({ 
                type: "POST",
                url: "<?php echo site_url('subproject/reports/delete_sp_documents'); ?>",
                data: {file_name:file_name, upd_no: upd_no},
                success: function(result) {
                    $('#upld_row'+upd_no).remove();
                }                
            });
        }else{
            return false;
        }
    });

</script>