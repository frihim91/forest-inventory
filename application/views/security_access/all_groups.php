<style type="text/css">
    .pointer{cursor: pointer}
    .error_field{
        border-color: #B94A48 !important;
    }
    .groupLevels {
        display: none;
    }
    .display_none {
        display: none;
    }
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
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
<div class="card">
    <div class="card-header">
        <h2 style="margin-bottom: 10px">
            User Group List
            <a class="btn btn-danger pull-right securityModal" data-toggle="modal"  href="#modal_window" >Create New Group</a>
        </h2>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" id="sample_1">
            <thead>
                <tr>
                    <th style="width:8px;">#</th>
                    <th>Group Name</th>
                    <th>Status</th>
                    <th style="width: 70px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($groups)) {
                    $i = 1;
                    foreach ($groups as $group) {
                        $group_levels = $this->utilities->findAllByAttribute("sa_ug_level", array("USERGRP_ID" => $group->USERGRP_ID, "ACTIVE_STATUS" => 1));
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i++; ?></td>
                            <td>
                                <div class="collapsibleDivHeader pointer">
                                    <strong><?php echo $group->USERGRP_NAME . " " . (!empty($group_levels) ? "(" . count($group_levels) . ")" : ""); ?> <span <?php echo (!empty($group_levels)) ? 'class="collapsiblePlus icon-plus" style="font-size: 10px; float:right;"' : '' ?>></span></strong>
                                    <span class = "rht rightLabel">
                                        <?php
                                        if (empty($group_levels)) {
                                            echo "<span style='color:#999999; font-size:10px; font-style:italic; margin-left:20px;'>No Level Created So Far</span>";
                                        }
                                        ?>
                                    </span>
                                </div>
                                <?php
                                if (!empty($group_levels)) {
                                    ?>
                                    <div class="collapsibleDivBody" style="display: none;">
                                        <ol class="collapsibleDivBodyContent arrow_box" style="margin: 10px 0; padding: 0 20px;">
                                            <?php
                                            foreach ($group_levels as $group_level) {
                                                ?>
                                                <li>
                                                    <span id="uglraw_<?php echo $group_level->UG_LEVEL_ID; ?>"><?php echo $group_level->UGLEVE_NAME; ?></span>
                                                    <input id="uglinput_<?php echo $group_level->UG_LEVEL_ID; ?>" class="display_none" type="text" value="<?php echo $group_level->UGLEVE_NAME; ?>"/> 
                                                    <span class="ugleveledit" id="uglvledit_<?php echo $group_level->UG_LEVEL_ID; ?>" uglvledit_id="<?php echo $group_level->UG_LEVEL_ID; ?>"><i style="color:blue; cursor: pointer;" class="fa fa-edit"></i></span>
                                                    <span  id="uglvlupdate_<?php echo $group_level->UG_LEVEL_ID; ?>" class="display_none update_level" uglvlupdate_id="<?php echo $group_level->UG_LEVEL_ID; ?>"><i style="color:green; cursor: pointer;" class="fa fa-check"></i></span>
                                                </li>
                                            <?php } ?>
                                        </ol>
                                    </div>
                                <?php } ?>
                            </td>
                            <td><?php echo ($group->ACTIVE_STATUS == 1) ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>'; ?></td>

                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-xs addLink securityModalL"  data-id="<?php echo $group->USERGRP_ID; ?>">Add Level</a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="securityModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
<div class="modal fade" id="securityModalL" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
<!--script for this page only-->
<script type="text/javascript">
    $(document).ready(function() {
        $('.toggleLevel').click(function() {
            $(this).siblings('.groupLevels').slideToggle(100, function() {
                $(this).siblings('.toggleLevel').toggleClass('test');
            });

            $(this).parent().parent().siblings().find('.groupLevels').hide(100, function() {
                $(this).siblings('.toggleLevel').removeClass('test');
                $(this).find('.answer').hide();
            });
        });
        $('.collapsibleDivHeader').click(function(){
            $(this).siblings('.collapsibleDivBody').slideToggle(100, function(){
                var $iconCon = $(this).siblings('.collapsibleDivHeader').find('.collapsiblePlus');
                if($iconCon.hasClass('icon-plus')){
                    $iconCon.addClass('icon-minus').removeClass('icon-plus');
                }else{
                    $iconCon.addClass('icon-plus').removeClass('icon-minus');
                }
            });
        });
        $(document).on("click",".securityModalL",function(){
            $("#securityModalL").modal('show');
            var group_id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('dashboard/securityAccess/createLevelModal'); ?>",
                data:{group_id:group_id},
                success: function(data) {                    
                    $(".modal-content").html(data); 
                }
            });
        });
               // $(document).on("click",".create_group",function(){ 
               //     var h_id = $(this).attr('data-hid');
               //     $.ajax({
               //         type: "POST",
               //         url: "<?php echo site_url('dashboard/securityAccess/groupModal'); ?>",
               //         data:{hid:h_id},
               //         beforeSend: function() {
               //             $("#modal_window .modal-title").html("Create Group"); 
               //             $("#modal_window .modal-content").html("loading..."); 
               //         },
               //         success: function(data) {                    
               //             $("#modal_window .modal-body").html(data); 
               //         }
               //     });
               // });
        $(document).on("click",".securityModal",function(){  
            $("#securityModal").modal('show');
           
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('dashboard/securityAccess/groupModal'); ?>", 
                success: function(data) {                    
                    $(".modal-content").html(data); 
                }
            });
        });
        
        $(document).on("click",".ugleveledit",function(){ 
            
            var lvlid = $(this).attr('uglvledit_id');
            
            $('#uglraw_'+lvlid).hide();
            $('#uglinput_'+lvlid).show();
            $('#uglvledit_'+lvlid).hide();
            $('#uglvlupdate_'+lvlid).show();
            
        });
        
        
        $(document).on("click",".update_level",function(){  
           
            var levelid = $(this).attr('uglvlupdate_id');
            var leveldata = $('#uglinput_'+levelid).val();
            //alert(levelid);
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('dashboard/securityAccess/update_user_group_lavel'); ?>", 
                data:{levelid:levelid, leveldata:leveldata},
                success: function(data) { 
                    if(data == 'updated'){
                        $('#uglraw_'+levelid).text($('#uglinput_'+levelid).val());
                        $('#uglraw_'+levelid).show();
                        $('#uglinput_'+levelid).hide();
                        $('#uglvledit_'+levelid).show();
                        $('#uglvlupdate_'+levelid).hide();
                    } else {
                        alert('Update failed! Try again later.');
                    }
                }
            });
        });
        
        
    });
</script>