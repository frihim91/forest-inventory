<?php
//echo "<pre>";
//print_r($user_info);
?>
<style type="text/css">
    .modal{ left: 25%; width: 90%;}
</style>
<ul class="accessChart" style="display: none;">
    <li>
        <img alt="<?php echo $user_info->FULL_NAME; ?>" class="tooltips" data-placement="top" title="<?php echo $user_info->FULL_NAME; ?>" src="<?php echo base_url(); ?>resources/img/avatar-mini.png">
        <br/>
        <?php echo $user_info->FULL_NAME; ?><br />
        <ul>
            <?php
            $dtls = $this->careProvider_model->getOrgModulesByUser($user_info->USER_ID);
            if (!empty($dtls)) {
                foreach ($dtls as $dtl) {
                    $modid = $dtl->SA_MODULE_ID;
                    if ($user_info->USERGRP_ID != "") {
                        $links = $this->careProvider_model->get_all_module_linksByUser($user_info->USER_ID,$modid);
                    } else {
                        //$links_user = $this->careProvider_model->get_all_module_links_from_user($modid);
                    }
                    if (!empty($links)) {
                        ?>
                        <li>
                            <?php echo $dtl->SA_MODULE_NAME; ?>
                            <ul>
                                <?php
                                foreach ($links as $link) {
                                    ?>
                                    <li><?php echo $link->LINK_NAME; ?></li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php ?>
                        </li>
                        <?php
                    }
                }
            } else {
                echo "<li>No Module Assigned</li>";
            }
            ?>
        </ul>
    </li>
</ul>
<div class="chart"></div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".accessChart").orgChart({container: $(".chart")});
        $(".orgChart table tbody > tr > td:first .node0").css({"backgroundColor":"#fff","border":"0","boxShadow":"none","width":"200px"});
    });
</script>