<div id="multi-select">
    <div style="float: left; width: 45%;">
        <h1>All Modules</h1>
        <ol id="selectable">
            <?php
            foreach ($modules as $module) {
                ?>
                <li class="ui-widget-content" id="<?php echo $module->MODULE_ID; ?>" title="<?php echo $module->MODULE_NAME; ?>"><?php echo $module->MODULE_NAME; ?></li>
            <?php } ?>
        </ol>
    </div>
    <div id="multi-select-btn" style="float: left; width: 10%; text-align: center;">
        <form id="frmModuleIds" method="post">
            <input type="hidden" name="hid" value="<?php echo $hid; ?>" />
            <div  id="multi-select-add-single-id">
                <span id="add_single" class="btn btn-primary"><i class="fa fa-angle-double-right"></i></span>
                <span id="multi-select-add-single-ids"></span>
            </div>
        </form>
    </div>
    <div style="float: left; width: 45%;">
        <h1 style="border-right: 0; border-left: 1px solid #ccc;">Selected Modules</h1>
        <ol id="selectable-target">
            <?php
            if (!empty($active_modules)) {
                foreach ($active_modules as $active_module) {
                    ?>
                    <li class="rename-module" style="overflow: auto;" id="<?php echo $active_module->SA_MODULE_NAME; ?>" title="<?php echo $active_module->SA_MODULE_NAME; ?>">
                        <span class="module-name"><?php echo $active_module->SA_MODULE_NAME; ?></span>
                        <span class="module-name-input hidden">
                            <input type="text" id="txtModuleName" data-hc-module-id="<?php echo $active_module->SA_MODULE_ID; ?>" class="txtModuleName" value="<?php echo $active_module->SA_MODULE_NAME; ?>" style="width:90%; margin: 1px; float: left;" />
                            <span class="remove-module-input pull-right fa fa-times pointer" title="Delete Module" style="font-size: 16px; color: red;"><span class="md-backspace"></span></span>
                        </span>
                        <span class="remove-module pull-right fa fa-times pointer" title="Delete Module" style="font-size: 16px; color: red;" data-hc-module-id="<?php echo $active_module->SA_MODULE_ID; ?>">
                            <span class="md-backspace"></span>
                        </span>
                    </li>
                    <?php
                }
            } else {
                ?>
                <li>No Module Assigned.</li>
                <?php
            }
            ?>
        </ol>
    </div>
</div>