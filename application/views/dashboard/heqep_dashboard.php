<div class="innerLR">
    <div class="row">
        <div class="col-md-8 tablet-column-reset">
            <div class="row">
                <div class="col-md-8">
                    <div  class="widget widget-body-white" data-toggle="collapse-widget">

                        <div class="widget-head">
                            <h4 class="heading glyphicons cardio"><i></i>Total Number of Sub Project</h4>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th class="text-center">&nbsp;</th>
                                <?php
                                foreach ($windowinfo as $windows):
                                    $ttl_window_amt_{$windows->PR_WINDOW_NO} = 0;
                                    ?>
                                    <th class="text-center"><?php echo $windows->WINDOW_NAME; ?></th>
                                    <?php
                                endforeach;
                                ?>
                                <th class="text-center">Total</th>
                            </tr>
                            <?php
                            $grant_ttl_amt = 0;
                            foreach ($roundinfo as $rounds):
                                ?>
                                <tr>
                                    <td><?php echo $rounds->ROUND_NAME; ?></td>
                                    <?php
                                    $ttl_round_window = 0;
                                    foreach ($windowinfo as $windows):
                                        ?>
                                        <td class="text-center">
                                            <?php
                                            foreach ($subProject as $row):
                                                if ($rounds->ROUND_NO == $row->ROUND_NO && $windows->PR_WINDOW_NO == $row->PR_WINDOW_NO):
                                                    $ttl_round_window+=$row->NUMBER_OF_PROJECT;
                                                    $grant_ttl_amt+=$row->NUMBER_OF_PROJECT;
                                                    echo $row->NUMBER_OF_PROJECT;
                                                    $ttl_window_amt_{$windows->PR_WINDOW_NO} += $row->NUMBER_OF_PROJECT;
                                                endif;
                                            endforeach;
                                            ?>
                                        </td>
                                    <?php endforeach; ?>
                                    <td class="text-center"><b><?php echo $ttl_round_window; ?></b></td>  <!-- Round Total -->
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td class="text-right"><b>Total:</b></td>
                                <?php foreach ($windowinfo as $windows): ?>
                                    <td class="text-center"><b><?php echo $ttl_window_amt_{$windows->PR_WINDOW_NO}; ?></b></td>
                                <?php endforeach; ?>
                                <td class="text-center"><b><?php echo $grant_ttl_amt; ?></b></td>  <!-- Round Total -->
                            </tr>
                        </table>
                        <div class="widget-head">
                            <h4 class="heading glyphicons bank"><i></i>This Quarter Uses of funds by Project Component</h4>
                        </div>

                        <table class="table table-bordered table-striped">
                            <tr>
                                <td colspan="2" class="text-right">Amount in Lakh</td>
                            </tr>
                            <tr>
                                <th>Project Activities</th>
                                <th class="text-right">Amount</th>
                            </tr>

                            <?php
                            $ttl_componentamount = 0;
                            foreach ($useoffundbycomponent as $rowcomponent):
                                $ttl_componentamount+= $rowcomponent->total;
                                ?>
                                <tr>
                                    <td><?php echo $rowcomponent->ac_name; ?></td> 
                                    <td class="text-right"><?php echo number_format($this->utilities->drpchange($rowcomponent->total), 2); ?></td> 
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th class="text-right">Total:</th> 
                                <td class="text-right"><?php echo number_format($this->utilities->drpchange($ttl_componentamount), 2); ?></td> 
                            </tr>
                        </table>  
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Website Height Chart -->
                    <div class="widget widget-body-white" data-toggle="collapse-widget">
                        <table id="window_wise_project_no" style="width: 100%; height: 300px;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($windowWiseNo as $winno): ?>
                                    <tr>
                                        <td><?php echo $winno->WINDOW_NAME; ?></td>
                                        <td><?php echo $winno->NUMBER_OF_PROJECT; ?> </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- // Website Traffic Chart END -->

                    <a href="#" class="widget-stats widget-stats-2">
                        <span class="count text-large inline-block"><?php echo number_format($this->utilities->drpchange($ttl_componentamount), 2); ?></span>Lakh</span></span></br>
                        <span class="txt">Fund used(This Quarter)</span>
                    </a>
                    <?php
                    if (!empty($dashboardmst)) {
                        if (date('d m Y', strtotime($dashboardmst->VALID_TILL)) > date('d m Y')) {
                            ?>
                            <div class="widget widget-body-gray">
                                <div class="widget-head">
                                    <h4 class="heading glyphicons star"><i></i>Note </h4>
                                </div>
                                <!-- // Widget Heading END -->

                                <div class="widget-body list bg-gray">
                                    <!-- List -->
                                    <ul>
                                        <li>
                                            <a><?php echo $dashboardmst->DASH_NOTE; ?></a>
                                        </li>  

                                    </ul>
                                    <!-- // List END -->
                                </div>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 tablet-column-reset">

            <!-- Widget -->
            <div class="widget widget-heading-simple widget-body-gray">
                <?php
                if (!empty($dashboardmst)) {
                    if (date('d m Y', strtotime($dashboardmst->VALID_TILL)) > date('d m Y')) {
                        ?>
                        <div class="widget widget-heading-simple widget-body-gray">
        <?php if (!empty($dashboardmst->DASH_ALERT)): ?>
                                <div class="alert alert-primary">
                                    <a class="close" data-dismiss="alert">&times;</a>
                                    <p><?php echo $dashboardmst->DASH_ALERT ?></p>
                                </div>
        <?php endif; ?>
                            <div class="widget-head">
                                <h3 class="heading glyphicons notes"><i></i>Notice</h3>
                            </div>
                            <div class="widget-body">
                                <p><?php echo $dashboardmst->DASH_NOTICE ?></p>
                            </div>

                        </div>
    <?php
    }
}
?>

                <!-- Website Bar Chart -->
                <div class="widget widget-body-white" data-toggle="collapse-widget">

                    <table id="window_wise_project_info" style="width: 100%; height: 300px;" >
                        <thead>
                            <tr>
                                <th></th>
<?php foreach ($windowinfodesc as $windows): ?>
                                    <th class="text-center"><?php echo $windows->WINDOW_NAME; ?></th>
                            <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php foreach ($roundinfo as $rounds): ?>
                                <tr>
                                    <td><?php echo $rounds->ROUND_NAME; ?></td>
                                        <?php foreach ($windowinfodesc as $windows): ?>
                                        <td class="text-center">
                                            <?php
                                            foreach ($subProject as $row):
                                                if ($rounds->ROUND_NO == $row->ROUND_NO && $windows->PR_WINDOW_NO == $row->PR_WINDOW_NO):
                                                    echo $row->NUMBER_OF_PROJECT;
                                                endif;
                                            endforeach;
                                            ?>
                                        </td>
    <?php endforeach; ?>

                                </tr>
                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
<?php
if (!empty($dashboardmst)) {
    if (date('d m Y', strtotime($dashboardmst->VALID_TILL)) > date('d m Y')) {
        ?>
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
    <?php
    }
}
?>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#window_wise_project_info').highcharts({
            data: {
                table: document.getElementById('window_wise_project_info')
            },
            chart: {
                type: 'bar' /* 'bar' column for histograme*/
            },
            title: {
                text: 'Windows Wise Project'  /*  false for Hide title*/
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: false  /*Hide Footer*/
                }
            }, credits: {
                enabled: false
            }, /* Credits display highchat.com*/
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true,
                        color: '#FFFFFF'
                    }
                },
            
                series: {
                    stacking: 'normal'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.point.y;
                }
            }
        });

        $('#window_wise_project_no').highcharts({
            data: {
                table: document.getElementById('window_wise_project_no')
            },
            chart: {
                type: 'pie' /* 'bar' column for histograme*/
            },
            title: {
                text: 'Windows Wise Project'  /*  false for Hide title*/
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: false  /*Hide Footer*/
                }
            }, credits: {
                enabled: false
            }, /* Credits display highchat.com*/
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true,
                        color: '#FFFFFF'
                    }
                },
            
                series: {
                    stacking: 'normal'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.point.y;
                }
            }
        });
    });
</script>
<script src="<?php echo base_url('resources/js/highcharts.js'); ?>"></script> <!-- For High Chart Graphs -->
<script src="<?php echo base_url('resources/js/data.js'); ?>"></script> <!-- For pick data form html table for High chart-->