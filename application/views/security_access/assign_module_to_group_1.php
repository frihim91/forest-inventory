<style type="text/css">
    .error_field{
        border-color: #B94A48 !important;
    }
</style>
<div class="msg">
    <?php
    if (validation_errors() != false) {
        echo '<div class="alert alert-block alert-error fade in">';
        echo '<button data-dismiss="alert" class="close icon-remove" type="button"></button>';
        echo validation_errors();
        echo '</div>';
    }
    ?>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="widget green">
            <div class="widget-title">
                <h4><i class="icon-reorder"></i> Module Assign Form </h4>
                <a href="<?php echo site_url('cp/securityAccess/allGroup'); ?>" class="label label-important"><span  class="icon-eye-open"></span> View All Groups</a>
                <span class="tools">
                    <a href="javascript:void(0);" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="widget-body">
                <table class="table table-striped table-bordered nestedTable" id="sample_1">
                    <thead>
                        <tr>
                            <th rowspan="2" class="bg-font-normal">Pages</th>
                            <th colspan="50" class="text-center bg-font-normal">Groups</th>
                        </tr>
                        <tr>
                            <?php foreach ($groups as $group): ?>
                                <th class="text-center bg-font-normal"><?php echo $group->USERGRP_NAME; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($org_modules as $org_module): ?>
                            <tr title="<?php echo $org_module->SA_MODULE_NAME; ?>">
                                <th class="bg-font-normal" colspan="50" style="background: url('<?php echo base_url(); ?>resources/img/header_bg.jpg'); padding: 3px; color: #427DAE;"><?php echo $org_module->SA_MODULE_NAME; ?></th>                                
                            </tr>
                            <?php
                            $org_module_links = $this->utilities->findAllByAttributeWithJoin("sa_org_mlinks", "ati_module_links", "LINK_ID", "LINK_ID", "LINK_NAME", array("SA_MODULE_ID" => $org_module->SA_MODULE_ID));
                            foreach ($org_module_links as $org_module_link):
                                ?>
                                <tr title="<?php echo $org_module_link->LINK_NAME; ?>">
                                    <td class="bg-font-normal" style="text-align: left;"><?php echo $org_module_link->LINK_NAME; ?></td>
                                    <?php
                                    foreach ($groups as $group):
                                        ?>
                                        <td class="text-center">
                                            <input type="checkbox"  class="assignMlink" title="<?php echo "Group: $group->USERGRP_NAME, Page: $org_module_link->LINK_NAME"; ?>" <?php echo ($this->utilities->is_it_checked_or_not($group->USERGRP_ID, $org_module_link->SA_MLINKS_ID) == TRUE) ? 'checked="checked"' : ''; ?> value="<?php echo "$group->USERGRP_ID,$org_module_link->SA_MLINKS_ID"; ?>" id="<?php echo $org_module_link->LINK_ID; ?>" rel="<?php echo $org_module->SA_MODULE_ID; ?>" />
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.assignMlink').click(function() {
            var status = ($($(this)).is(':checked'))? 1 : 0;
            var dataArray = {
                position_value: $(this).val(),
                module_id: $(this).attr("rel"),
                link_id: $(this).attr("id"),
                status : status
            }
            $.ajax({   
                url: "ajax_permission_change",
                type: "post", 
                dataType: "json",  
                data: dataArray
            }) 
        });
    });
</script>