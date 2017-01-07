<style>
    #multi-select{ overflow: auto; border: 1px solid #ccc;}
    #multi-select h1{ margin:0; font-size: 11px; border-right: 1px solid #ccc; background: -moz-linear-gradient(center top , #F7F7F7 0%, #E6E6E6 100%) repeat scroll 0 0 rgba(0, 0, 0, 0); padding: 5px;}
    #selectable .ui-selecting { background: #FECA40; }
    #selectable .ui-selected { background: #F39814; color: white; }
    #selectable,#selectable-target { list-style-type: none; margin: 0; padding: 0; height: 300px; overflow: auto; background: #fff; border-right: 1px solid #ccc;}
    #selectable li,#selectable-target li { padding: 0.4em; font-size: 11px; border-bottom: 1px solid #e3e3e3;}
    .ui-widget-content{ box-shadow: none;}
    #selectable .ui-selected,#selectable .ui-selecting,#selectable-target .ui-selected,#selectable-target .ui-selecting{ background: #5899C4; color: #fff;}
    #selectable-target{ border-radius: 3px; height: 300px;border-left: 1px solid #ccc; border-right: 0;}
    #multi-select-btn{ margin-top: 70px;}
    #multi-select-btn .iconb{ font-size: 14px; width:30px; margin-bottom: 5px;}
    .pointer{cursor: pointer;}
</style>
<div class="widget-body"> 
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="center">#</th>
                    <th class="center">Logo</th>
                    <th class="center">Organization</th>
                    <th class="center">Status</th>
                    <th class="center">Group</th>
                    <th class="center">User</th>
                    <th class="center">Modules</th>
                    <th class="center">Pages</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                //echo '<pre>'; print_r($careProviders); exit;
                foreach ($careProviders as $careProvider) {
                    $countGroups = $this->utilities->findAllByAttribute("sa_user_group", array("ORG_ID" => $careProvider->ORG_ID));
                    //$countUsers = $this->global_model->findAllByAttribute("sa_users", array("ORG_ID" => $careProvider->ORG_ID));
                    $count_modules = $this->utilities->findAllByAttribute("sa_org_modules", array("ORG_ID" => $careProvider->ORG_ID));
                    ?>
                    <tr>
                        <td class="center"><?php echo $i . '.'; ?></td>
                        <td class="center"><img style="width: 50px;" src="<?php echo base_url(); ?>resources/images/<?php echo $careProvider->LOGO; ?>" alt="<?php echo $careProvider->ORG_NAME; ?>" title="<?php echo $careProvider->ORG_NAME; ?>" /></td>
                        <td class="center"><?php echo $careProvider->ORG_NAME; ?></td>
                        <td class="center">
                            <?php if ($careProvider->STATUS == '1') { ?>
                                <span style="color:green; font-size: 25px;" data-hId="<?php echo $careProvider->ORG_ID; ?>" status="<?php echo $careProvider->STATUS; ?>" class="statusType" ><i class="md md-check-box"></i></span>
                            <?php } else { ?>
                                <span style="color:red; font-size: 25px;" data-hId="<?php echo $careProvider->ORG_ID; ?>" status="<?php echo $careProvider->STATUS; ?>" class="statusType" ><i class="md-not-interested"></i></span>
                            <?php } ?>
                        </td>
                        <td class="center">
                            <a class="btn btn-danger create_group" data-toggle="modal" href="#modal_window" data-hid="<?php echo $careProvider->ORG_ID; ?>">Create Group</a>
                        </td>
                        <td class="center">
                            
                             <a class="btn btn-danger addUser" data-toggle="modal" href="#modal_window" data-hid="<?php echo $careProvider->ORG_ID; ?>">Create User</a>
                        </td>
                        <td class="center" style="width: 140px;">
                            <a class="btn btn-danger addModule" data-toggle="modal" href="#modal_window" data-hid="<?php echo $careProvider->ORG_ID; ?>">Assign Module</a>
                        </td>
                        <td class="center">
                            <a class="btn btn-danger addLink" data-toggle="modal" href="#modal_window" data-hid="<?php echo $careProvider->ORG_ID; ?>">Add Pages</a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table> 
    </div>
</div>
<div class="clear"></div> 
<!-- Content ends -->

<div class="dialog" title="Add Module To Template"></div>
<div class="modal fade" id="modal_window" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"  id="common_modal_content">
            <div class="modal-header">
                <h4 class="modal-title" id="common_modal_title">Create Module</h4>
            </div>
            <div class="modal-body" id="common_modal_body"> </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on("click", ".create_group", function () {
        var h_id = $(this).attr('data-hid');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('securityAccess/groupModal'); ?>",
            data: {hid: h_id},
            beforeSend: function () {
                $("#modal_window .modal-title").html("Create Group");
                $("#modal_window .modal-body").html("loading...");
            },
            success: function (data) {
                $("#modal_window .modal-body").html(data);
            }
        });
    });
    $(document).on("click", ".addUser", function () {
        var h_id = $(this).attr('data-hid');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('securityAccess/createUser'); ?>",
            data: {hid: h_id},
            beforeSend: function () {
                $("#modal_window .modal-title").html("Create User");
                $("#modal_window .modal-body").html("loading...");
            },
            success: function (data) {
                $("#modal_window .modal-body").html(data);
            }
        });
    });

    $(document).on("click", ".addUserToGroup", function () {
        $(".dialog").dialog("open");
        var h_id = $(this).attr('data-hid');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/careProviders/userAssignToGroupModal'); ?>",
            data: {hid: h_id},
            beforeSend: function () {
                $(".dialog").dialog({
                    width: 850,
                    height: "auto"
                });
                $(".ui-dialog-title").html("Create Group");
                $(".dialog").html("<div class='loader'>Please Wait...</div>");
            },
            success: function (data) {
                $(".dialog").html(data);
            }
        });
    });
    $(document).on("click", ".addModule", function () {
        var h_id = $(this).attr('data-hid');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('securityAccess/moduleModal'); ?>",
            data: {hid: h_id},
            beforeSend: function () {
            },
            success: function (data) {
                $("#modal_window .modal-body").html(data);
                $("#selectable").selectable({
                    stop: function (event, ui) {
                        var result = $("#multi-select-add-single-ids").empty();
                        $(".ui-selected", this).each(function () {
                            result.append("<input type='hidden' name='add_selected_single_id[]' value='" + $(this).attr("id") + "' />");
                            result.append("<input type='hidden' name='add_selected_single_name[]' value='" + $(this).attr("title") + "' />");
                        });
                    }
                });
            }
        });
    });

    $(document).on("click", ".addLink", function () {
        var h_id = $(this).attr('data-hid');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('securityAccess/moduleModalLink'); ?>",
            data: {hid: h_id},
            beforeSend: function () {
                $("#modal_window .modal-title").html("Assign Pages");
                $("#modal_window .modal-body").html("loading...");
            },
            success: function (data) {
                $("#modal_window .modal-body").html(data);
            }
        });
    });

    $(document).on("click", "#add_single", function () {
        if (confirm("Are You Sure?")) {
            if ($("#multi-select-add-single-ids").children().length > 0) {
                var module_ids = $("#frmModuleIds").serialize();
                //alert(module_ids)
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('securityAccess/addModules'); ?>",
                    data: module_ids,
                    beforeSend: function () {
                        $("#selectable").html("loading...");
                        $("#selectable-target").html("loading...");
                    },
                    success: function (data) {
                        $("#multi-select-add-single-ids").html("");
                        $("#selectable-target").html(data);
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('securityAccess/getModules'); ?>",
                            success: function (data) {
                                $("#selectable").html(data);
                            }
                        });
                    }
                });
            } else {
                alert("Please Select A Module To Add.");
                return false;
            }
        }
        else {
            return false;
        }
    });

    $(document).on("dblclick", ".rename-module", function () {
        $(this).children(".module-name").addClass("hidden");
        $(this).children(".module-name-input").removeClass("hidden");
        $(this).children(".remove-module").addClass("hidden");
    });

    $(document).on('keypress', '.txtModuleName', function (e) {
        var mname = $(this).parent().siblings(".module-name");
        var mcontrol = $(this).parent();
        var mremove = $(this).parent().siblings(".remove-module");
        var p = e.which;
        if (p == 13) {
            var hc_module_id = $(this).attr("data-hc-module-id");
            var module_name = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('securityAccess/updateModule'); ?>",
                data: {m_id: hc_module_id, m_name: module_name},
                beforeSend: function () {

                },
                success: function (data) {
                    mcontrol.addClass("hidden");
                    mname.removeClass("hidden").html(module_name).css("color", data);
                    mremove.removeClass("hidden");
                }
            });
        }
    });

    $(document).on("click", ".remove-module", function () {
        if (confirm("Are You Sure?")) {
            var hc_module_id = $(this).attr("data-hc-module-id");
            var mList = $(this).parent();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('securityAccess/removeHcModule'); ?>",
                data: {m_id: hc_module_id},
                beforeSend: function () {

                },
                success: function (data) {
                    mList.remove();
                }
            });
        }
        else {
            return false;
        }
    });

    $(document).on("click", ".remove-module-input", function () {
        $(this).parent().siblings(".module-name").removeClass("hidden");
        $(this).parent().addClass("hidden");
        $(this).parent().siblings(".remove-module").removeClass("hidden");
    });

    $(document).ready(function () {
        $(document).on("click", ".statusType", function () {
            if (confirm("Are You Sure?")) {
                var status = $(this).attr('status');
                var h_id = $(this).attr('data-hId');
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('admin/careProviders/changeOrgStatus'); ?>",
                    data: {hid: h_id, st: status},
                    success: function (result) {
                        window.location.reload(true);
                    }
                });
            }
            else {
                return false;
            }
        });

        //            $( ".dialog" ).dialog({
        //                autoOpen: false,
        //                width: 550,
        //                modal: true
        //            });            

        $("body").on("click", "#btnSubmitModule", function () {
            var module_form = $("#frmModules").serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/setup/assignModuleToHcTemplate'); ?>",
                data: module_form,
                success: function (result) {
                    $(".frmMsg").html(result);
                    $('div.menu_body:eq(0)').show();
                    $('.acc .toogle-div:eq(0)').show().css({
                        color: "#2B6893"
                    });
                }
            });
        });

        $(document).on("click", ".module-link", function () {
            var link_id = $(this).val();
            var module_id = $(this).attr("data-module-id");
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/careProviders/addLinkToTemplateModule'); ?>",
                data: {module: module_id, link: link_id},
                success: function (data) {
                    $(this).siblings().css("color", data);
                }
            });
        });
    });

    $(document).on("click", ".addGroup", function () {
        //$( ".dialog" ).dialog("open");
        var h_id = $(this).attr('data-hid');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/careProviders/groupModal'); ?>",
            data: {hid: h_id},
            beforeSend: function () {
            },
            success: function (data) {
                $(".dialog").html(data);
            }
        });
    });

    $(document).on("click", ".addUserToGroup", function () {
        //$( ".dialog" ).dialog("open");
        var h_id = $(this).attr('data-hid');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/careProviders/userAssignToGroupModal'); ?>",
            data: {hid: h_id},
            beforeSend: function () {
            },
            success: function (data) {
                $(".dialog").html(data);
            }
        });
    });

    $(document).on("click", ".chkAssignPage", function () {
        var value = $(this).val();
        var checked = ($($(this)).is(':checked')) ? 1 : 2;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('securityAccess/assignModulePage'); ?>",
            data: {values: value, is_checked: checked},
            success: function (result) {
                //alert(result);
            }
        });
    });

</script>