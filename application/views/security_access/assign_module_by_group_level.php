<?php
foreach ($org_modules as $org_module) {
    $org_module_links = $this->utilities->findAllByAttributeWithJoin("sa_org_mlinks", "ati_module_links", "LINK_ID", "LINK_ID", "LINK_NAME", array("SA_MODULE_ID" => $org_module->SA_MODULE_ID));
    ?>
    <li>
        <a id="nut3" data-value="Bootstrap_Tree" data-toggle="branch" class="tree-toggle closed" href="#" style="color: #4A8BC2;"><?php echo $org_module->SA_MODULE_NAME; ?></a>
        <ul class="branch in" style="width: 98%; padding: 5px; margin-left: 15px;">
            <?php
            foreach ($org_module_links as $org_module_link):
                $active_pages = $this->utilities->findByAttribute("sa_uglw_mlink", array("SA_MLINKS_ID" => $org_module_link->SA_MLINKS_ID, "USERGRP_ID" => $group, "UG_LEVEL_ID" => $level));
                ?>
                <li style="border-bottom: 1px dashed #ccc; padding: 0 0 5px 0; background: #f2f2f2; padding-left: 5px;">
                    <span style="color: #333;"><i class="icon-file"></i> <?php echo $org_module_link->LINK_NAME; ?></span>
                    <span style="float: right;">
                        <span style="padding: 0 17px;">
                            <?php if ($org_module_link->CREATE == 1) { ?>
                                <input type="checkbox" class="chkPage"  title="Create" id="<?php echo (!empty($active_pages) ? $active_pages->CREATE : 0); ?>" <?php echo (!empty($active_pages) ? ($active_pages->CREATE == 1) ? "checked" : ""  : 0); ?> value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->SA_MLINKS_ID . ',' . 'C'; ?>" />
                            <?php } else { ?>
                                <input type="checkbox" title="Create" disabled="disabled"  />
                            <?php } ?>
                        </span>
                        <span style="padding: 0 17px;">
                            <?php if ($org_module_link->READ == 1) { ?>
                                <input type="checkbox" class="chkPage" title="Read" id="<?php echo (!empty($active_pages) ? $active_pages->READ : 0); ?>" <?php echo (!empty($active_pages) ? ($active_pages->READ == 1) ? "checked" : ""  : 0); ?> value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->SA_MLINKS_ID . ',' . 'R'; ?>" />
                            <?php } else { ?>
                                <input type="checkbox" title="Read" disabled="disabled" />
                            <?php } ?>
                        </span>
                        <span style="padding: 0 17px;">
                            <?php if ($org_module_link->UPDATE == 1) { ?>
                                <input type="checkbox" class="chkPage" title="Update" id="<?php echo (!empty($active_pages) ? $active_pages->UPDATE : 0); ?>" <?php echo (!empty($active_pages) ? ($active_pages->UPDATE == 1) ? "checked" : ""  : 0); ?> value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->SA_MLINKS_ID . ',' . 'U'; ?>" />
                            <?php } else { ?>
                                <input type="checkbox" title="Update" disabled="disabled" />
                            <?php } ?>
                        </span>
                        <span style="padding: 0 17px;">
                            <?php if ($org_module_link->DELETE == 1) { ?>
                                <input type="checkbox" class="chkPage" title="Delete" id="<?php echo (!empty($active_pages) ? $active_pages->DELETE : 0); ?>" <?php echo (!empty($active_pages) ? ($active_pages->DELETE == 1) ? "checked" : ""  : 0); ?> value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->SA_MLINKS_ID . ',' . 'D'; ?>" />
                            <?php } else { ?>
                                <input type="checkbox" title="Delete" disabled="disabled" />
                            <?php } ?>
                        </span>
                        <span style="padding: 0 17px;">
                            <?php if ($org_module_link->STATUS == 1) { ?>
                                <input type="checkbox" class="chkPage" title="Delete" id="<?php echo (!empty($active_pages) ? $active_pages->STATUS : 0); ?>" <?php echo (!empty($active_pages) ? ($active_pages->STATUS == 1) ? "checked" : ""  : 0); ?> value="<?php echo $org_module->SA_MODULE_ID . ',' . $org_module_link->SA_MLINKS_ID . ',' . 'S'; ?>" />
                            <?php } else { ?>
                                <input type="checkbox" title="Delete" disabled="disabled" />
                            <?php } ?>
                        </span>
                    </span>
                    <br clear="all" />
                </li>
            <?php endforeach; ?>
        </ul>
    </li>
    <?php
}
?>