<?php //echo '<pre>';print_r($$profile_data);exit;?>
<div class="widget widget-body-white">
    <div class="widget-body">
        <?php  foreach($profile_data as $row){?>
        <form method="post" action="<?php echo site_url('dashboard/dashboard/profile_data_edit'); ?>">
             <input type="hidden" name="textUserId" id="textUserId" value="<?php echo $row->USER_ID; ?>"/>
            <div class="tab-content">
                <div class="row">
                    <div class="form-group"> 
                        <div class="col-md-8">
                            <label class="col-md-2 control-label">First Name</label>
                            <div class="col-md-4"> 
                                <input type="text" value="<?php echo $row->FIRST_NAME ?>" name="textFirstName" id="textFirstName" class=" form-control" required="required"/> 
                            </div>
                        </div>
                        <div class="col-md-4 help">
                            <strong><span  class="help-head">Help: </span>First Name</strong>
                            <hr>
                            <p class="muted">Please enter  First Name here.</p>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="form-group"> 
                        <div class="col-md-8">
                            <label class="col-md-2 control-label">Middle Name</label>
                            <div class="col-md-4"> 
                                <input type="text" value="<?php echo $row->MIDDLE_NAME ?>" name="textMiddleName" id="textMiddleName" class=" form-control" required="required"/> 
                            </div>
                        </div>
                        <div class="col-md-4 help">
                            <strong><span  class="help-head">Help: </span>Middle Name</strong>
                            <hr>
                            <p class="muted">Please enter Middle here.</p>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="form-group"> 
                        <div class="col-md-8">
                            <label class="col-md-2 control-label">Last Name</label>
                            <div class="col-md-4"> 
                                <input type="text" value="<?php echo $row->LAST_NAME ?>" name="textLastName" id="textLastName" class=" form-control"/> 
                            </div>
                        </div>
                        <div class="col-md-4 help">
                            <strong><span  class="help-head">Help: </span>Last Name</strong>
                            <hr>
                            <p class="muted">Please enter Last here.</p>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="form-group"> 
                        <div class="col-md-8">
                            <label class="col-md-2 control-label">Email</label>
                            <div class="col-md-6"> 
                                <input type="email" value="<?php echo $row->EMAIL ?>" name="textEmail" id="textEmail" class=" form-control" required="required"/> 
                            </div>
                        </div>
                        <div class="col-md-4 help">
                            <strong><span  class="help-head">Help: </span>Email</strong>
                            <hr>
                            <p class="muted">Please enter Email here.</p>
                        </div>  
                    </div>
                </div>
                <div class="separator"></div>  
                <center>
                    <div class="form-actions">
                        <button class="btn btn-success" type="submit"><i class="fa fa-check-circle"></i>Update</button>
                    </div>
                </center>
            </div>
        </form>
         <?php } ?>
    </div>
</div>

