  <?php foreach ($user_details as $row) { ?>
<div class="row">
    <div class="col-md-10">
        <div class=" widget widget-body-white ">
            <div class="widget-head height-auto ">
                <div class="row row-merge ">
                    <div class="col-md-8">                      
                            <div class=" form-group">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style=" padding-left: 22px;" width="50%">Name</td>
                                            <td>                                            
                                                <strong ><?php echo $row->FULL_NAME; ?></strong>
                                            </td>                                          
                                        </tr>
                                        <tr>
                                            <td style=" padding-left: 22px;" width="50%">UG Group</td>
                                            <td>                                            
                                                <strong ><?php echo $row->USERGRP_NAME; ?></strong>
                                            </td>                                          
                                        </tr>
                                        <tr>
                                            <td style=" padding-left: 22px;" width="50%">UG Level</td>
                                            <td>                                            
                                                <strong ><?php echo $row->UGLEVE_NAME; ?></strong>
                                            </td>                                          
                                        </tr>
                                        <tr>
                                            <td style=" padding-left: 22px;" width="50%">Email</td>
                                            <td>                                            
                                                <strong ><?php echo $row->EMAIL; ?></strong>
                                            </td>                                          
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                                           
                        </div>
                
                    <div class="col-md-4">
                        <div class="innerAll inner-2x text-center">
                            <?php if (!$row->PROFILE_PIC_NAME == '') { ?>
                                <a data-toggle='tooltip' data-title='<?php echo $user_details->USERNAME; ?>' title="Click to view full image" data-placement='right' href="<?php echo base_url(); ?>resources/images/<?php echo $row->PROFILE_PIC_NAME; ?>" target="_blank" class="">
                                    <img width="60%" height="60%" src="<?php echo base_url(); ?>resources/images/<?php echo $row->PROFILE_PIC_NAME; ?>" alt="">
                                </a>
                                <?php
                            } else {
                                if ($row->GENDER == "M") {
                                    ?>
                                    <img width="50%" height="50%" src="<?php echo base_url(); ?>resources/images/default_mail.png" alt="">
                                <?php } else { ?>
                                    <img width="50%" height="50%" src="<?php echo base_url(); ?>resources/images/default_femail.jpg" alt="">
                                    <?php
                                }
                            }
                            ?>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php } ?>