<style type="text/css">
    .error_field{
        border-color: #B94A48 !important;
    }
    .modal{ left: 25%; width: 90%;}
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
<div class="widget green">
    <div class="widget-title">
        <h4><i class="icon-reorder"></i> Module Assign To Level Form </h4>
    </div>
    <div class="widget-body">
        <?php
        if (!empty($levels)) {
            ?>
            <table class="table table-striped table-bordered nestedTable" id="sample_1">
                <thead>
                    <tr>
                        <th rowspan="2" class="bg-font-normal">Pages</th>
                        <th colspan="50" class="text-center bg-font-normal">Levels</th>
                    </tr>
                    <tr>
                        <?php foreach ($levels as $level): ?>
                            <th class="text-center bg-font-normal"><?php echo $level->UGLEVE_NAME; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    /* echo "<pre>";
                      print_r($group_modules); */
                    foreach ($group_modules as $group_module):
                        ?>
                        <tr title="<?php echo $group_module->SA_MODULE_NAME; ?>">
                            <th class="bg-font-normal" colspan="50" style="background: url('<?php echo base_url(); ?>resources/img/header_bg.jpg'); padding: 3px; color: #427DAE;"><?php echo $group_module->SA_MODULE_NAME; ?></th>                                
                        </tr>
                        <?php
                        $org_module_links = $this->utilities->findAllByAttributeWithJoin("sa_ugw_mlink", "ati_module_links", "LINK_ID", "LINK_ID", "LINK_NAME", array("SA_MODULE_ID" => $group_module->SA_MODULE_ID));
                        foreach ($org_module_links as $org_module_link):
                            ?>
                            <tr title="<?php echo $org_module_link->LINK_NAME; ?>">
                                <td class="bg-font-normal" style="text-align: left;"><?php echo $org_module_link->LINK_NAME; ?></td>
                                <?php
                                foreach ($levels as $level):
                                    ?>
                                    <td class="text-center">
                                        <input type="checkbox"  class="assignMlink" title="<?php echo "Group: $level->UGLEVE_NAME, Page: $org_module_link->LINK_NAME"; ?>" <?php echo ($this->utilities->level_is_it_checked_or_not($level->UG_LEVEL_ID, $org_module_link->SA_MLINKS_ID) == TRUE) ? 'checked="checked"' : ''; ?> value="<?php echo "$level->UG_LEVEL_ID,$org_module_link->SA_MLINKS_ID"; ?>" id="<?php echo $org_module_link->USERGRP_ID; ?>" rel="<?php echo $group_module->SA_MODULE_ID; ?>" />
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php
        }else {
            ?>
            <p>No Levels Available.</p>
            <?php
        }
        ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.assignMlink').click(function() {
            var status = ($($(this)).is(':checked'))? 1 : 0;
            var dataArray = {
                position_value: $(this).val(),
                module_id: $(this).attr("rel"),
                group_id: $(this).attr("id"),
                status : status
            }
            $.ajax({   
                url: "ajax_permission_change_level",
                type: "post", 
                dataType: "json",  
                data: dataArray
            }) 
        });
    });
</script>