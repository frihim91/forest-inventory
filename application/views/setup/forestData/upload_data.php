        <style>
            .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
            .help-head{color:#A82400;}
            .form-group:hover .help{ background: #e3e3e3;}
        </style>

        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/assets/redactor/redactor.css" />
        <script src="<?php echo base_url(); ?>resources/assets/redactor/redactor.js"></script>
        <script src="<?php echo base_url(); ?>resources/assets/redactor/redactor.min.js"></script>
    <script>
    $(document).ready(function () {
        $('.redactor').redactor();
        $('.dropdown-option').select2();

        var warning = true;
        $('form input:text, form input:checkbox, form input:radio, form textarea, form select').on('change', function() {
            window.onbeforeunload = function() {
                if (warning){
                     return 1;
                }
            }
        });

        $('form').submit(function() {
            window.onbeforeunload = null;
        });

    });
</script>
        <div class="widget">
            <div class="widget-head">
                <h4 class="heading">Upload Image</h4>
            </div>

            <div class="widget-body">
                <?php echo form_open_multipart('dashboard/ForestData/uploadForestData', "class='form-horizontal margin-none'"); ?>
                <div class="msg">
                    <?php
                    if (validation_errors() != false) {
                        ?>
                        <div class="alert alert-danger">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <?php echo validation_errors(); ?>
                        </div>
                        <?php
                    }
                    ?>
                     </div>



                    <div class="row">
                                <div class="form-group">
                                    <div class="col-md-8">

                                        <div class="col-md-6">
                                         <label for="firstname">Table Name</label>
                                            <select name="table_name" id="table_name" class="singleSelectExample" style="width:400px">
                                            <option value="">--Select--</option>
                                            <option value="ae">ae</option>
                                            <option value="bd_aez1988">bd_aez1988</option>
                                            <option value="botanical_description">botanical_description</option>
                                            <option value="contributor_info">contributor_info</option>
                                            <option value="botanical_description">botanical_description</option>
                                            <option value="district">district</option>
                                            <option value="division">division</option>
                                            <option value="ef">ef</option>
                                            <option value="ef_ipcc">ef_ipcc</option>
                                            <option value="family">family</option>
                                            <option value="faobiomes">faobiomes</option>
                                            <option value="genus">genus</option>
                                            <option value="group_location">group_location</option>
                                            <option value="landcover">landcover</option>
                                            <option value="location">location</option>
                                            <option value="rd">rd</option>
                                            <option value="reference">reference</option>
                                            <option value="species">species</option>
                                            <option value="species_character">species_character</option>
                                            <option value="species_group">species_group</option>
                                            <option value="species_image">species_image</option>
                                            <option value="species_localname">species_localname</option>
                                            <option value="union">union</option>
                                            <option value="upazilla">upazilla</option>
                                            <option value="wd">wd</option>
                                            <option value="zones">zones</option>
                                         
                                         </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 help">
                                        <strong><span  class="help-head">Help: </span>Table Name</strong>
                                        <hr>
                                        <p class="muted">Please enter Table Name in english here.</p>
                                    </div>
                                </div>
                            </div>

                     <div class="row">
                        <div class="form-group">
                            <div class="col-md-8">

                                <div class="col-md-8">

                                 <div class="col-md-6">
                                     <label>Upload File</label>

                                     <input type="file" name="userfile" size="20" />
                                     </div>

                                </div>
                            </div>
                            <div class="col-md-4 help">
                                <strong><span  class="help-head">Help: </span>Upload File</strong>
                                <hr>
                                <p class="muted">Please Upload File here.</p>
                            </div>
                        </div>
                    </div>

                <div class="separator"> 
                    <a style="display:none" class="downloadDatasetUrl" href="#">Download Dataset format</a>
                </div>
                <center>
                    <div class="form-actions">
                        <button class="btn btn-success" type="submit"><i class="fa fa-check-circle"></i> Save</button>
                    </div>
                </center>
                <?php echo form_close(); ?>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>resources/shared/components/common/forms/elements/fuelux-checkbox/fuelux-checkbox.init.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('body').on('keyup', '.numericOnly', function () {
                    var val = $(this).val();
                    $(this).val(val.replace(/[^\d]/g, ''));
                });
            });
        </script>


        <script>
            $(document).ready(function() {
                $(document).on("click", ".editVisitor", function() {
                    var visitor_id = $(this).attr("id");
                    $.ajax({
                        type: "POST",
                        data: {visitor_id: visitor_id},
                        url: "<?php echo site_url('setup/org/editVisitor'); ?>",
                        success: function(data) {
                            $('#editVisitor').html(data);
                        }
                    });
                });
                var i = 1;
                $(document).on("click", "#addFileId", function() {
                    $('#moreFile').append('<span class="appeend_data"><div class="col-md-8" id="file_' + i + '"><input type="file" name="userfile[]" size="20" /></div><div class="col-md-4"><a href="#" class="btn btn-danger btn-xs removeclass">X</a></div></span>');

                });
                $(document).on('click', '.removeclass', function() {
                    $(this).closest('span').remove();
                    $('.imgFile').attr('id', 'moreFile');
                    return false;
                });

            });
        </script>
          <script>
               // Setting default configuration here or you can set through configuration object as seen below
               $.fn.select2.defaults = $.extend($.fn.select2.defaults, {
                 allowClear: true, // Adds X image to clear select
                 closeOnSelect: true, // Only applies to multiple selects. Closes the select upon selection.
                 placeholder: 'Select...',
                 minimumResultsForSearch: 15 // Removes search when there are 15 or fewer options
               });

               $(document).ready(

                 function () {

                   // Single select example if using params obj or configuration seen above
                   var configParamsObj = {
                     placeholder: 'Select an option...', // Place holder text to place in the select
                     minimumResultsForSearch: 3 // Overrides default of 15 set above
                   };
                   $(".singleSelectExample").select2(configParamsObj);
                 });
             </script>
<script type="text/javascript">
    $(document).on("change", "#table_name", function() {
        window.onbeforeunload = null;
        var tableName=$(this).val();
        //downloadDatasetUrl
        if(tableName!='')
        {
            var url="<?php echo site_url() ?>"+'/'+'data'+'/'+'downloadDataFormat'+'/'+tableName;
            $("a.downloadDatasetUrl").attr("href",url);
             var str='<i class="glyphicon glyphicon-download-alt"></i> Download <b>'+tableName+'</b> CSV Dataset Format';
             //alert(str);
             $("a.downloadDatasetUrl").html(str);   
            $("a.downloadDatasetUrl").show('fade');
            $
        }
        else 
        {
            $("a.downloadDatasetUrl").hide('fade');
        }
       
    })
</script>