<div class="row">
    <div class="col-md-10">
        <div class=" widget widget-body-white ">
            <div class="widget-head height-auto ">
                <div class="row row-merge ">
                    <div class="col-md-8">
                        <div class="form-group">
                            <table class="table table-bordered table-condensed">
                                <tbody>
                                    <tr>
                                        <th>Full Name</th>
                                        <td><?php echo $row->FULL_NAME; ?></td>                                          
                                    </tr>
                                    <tr>
                                        <th>User Group</th>
                                        <td><?php echo $row->USERGRP_NAME; ?></td>                                          
                                    </tr>
                                    <tr>
                                        <th>User Level</th>
                                        <td><?php echo $row->UGLEVE_NAME; ?></td>                                          
                                    </tr>
                                    <?php if ($row->SUB_PROJECT_TITLE != ''): ?>
                                        <tr>
                                            <th>Institute</th>
                                            <td><?php echo $row->INSTITUTE_NAME; ?></td>                                          
                                        </tr>
                                        <tr>
                                            <th>Sub Project</th>
                                            <td><?php echo $row->SUB_PROJECT_TITLE; ?></td>                                          
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th>Gender</th>
                                        <td><?php echo $row->GENDER_NAME; ?></td>                                          
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $row->EMAIL; ?></td>                                          
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><?php echo ($row->STATUS == 1) ? 'Active' : 'Inactive'; ?></td>                                          
                                    </tr>
                                </tbody>
                            </table>
                        </div>                                                                     
                    </div>
                    <div class="col-md-4">
                        <div class="innerAll inner-2x text-center">
                            <?php if (!$row->PROFILE_PIC_NAME == '') { ?>
                                <a data-toggle='tooltip' data-title='<?php echo $row->FULL_NAME; ?>' title="Click to view full image" data-placement='right' href="<?php echo base_url(); ?>resources/images/<?php echo $row->PROFILE_PIC_NAME; ?>" target="_blank" class="">
                                    <img width="60%" height="60%" src="<?php echo base_url(); ?>resources/images/<?php echo $row->PROFILE_PIC_NAME; ?>" alt="">
                                </a>
                                <?php
                            } else {
                                if ($row->GENDER == "M") {
                                    ?>
                                    <img width="50%" height="50%" src="<?php echo base_url(); ?>resources/images/default_mail.png" alt="Male">
                                <?php } else { ?>
                                    <img width="50%" height="50%" src="<?php echo base_url(); ?>resources/images/default_femail.jpg" alt="Female">
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