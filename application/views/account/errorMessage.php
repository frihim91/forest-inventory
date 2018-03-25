<style type="text/css">
    .page_content{
        padding: 15px;
        background-color: white;
        margin-top: 15px;
    }
    .page_des_big_image{
        width: 100%;
        height: 300px;
    }
    .bdy_des{
        margin-top: 25px;
    }
    .breadcump{
        background-image: url("<?php echo base_url("resources/images/breadcump_image.jpg")?>");
        height: 103px;
    }
    .breadcump-wrapper{
        background-color: #000000 !important;
        opacity: 0.7;
        width: 100%;
        height:100%;
    }
    .wrapper{
        padding:30px !important;
        color: #FFFFFF;
        font-weight: bold;
    }
    .breadcump_row a{
        color: white;
    }
    .submit_block {
        /* text-align: right; */
        padding: 10px;
        clear: both;
    }

</style>
<style type="text/css">
    #exist_email, #exist_email_2{
        display:none;
        color: red;
    }
    #link_sent, #link_sent_2{
        display:none;
        color: green;
    }
    #for_password, #for_username{
        display: none;
    }
    .pull-right{
        margin-bottom: 5px;
        margin-top: -8px;
    }
    #loading, #loading2{
        display: none;
        color: blue;
    }
    .not_registered{
        color:red;
    }
    .modal-dialog{
        width: 420px !important;
    }

    .lead{
        text-align: center;
        margin-bottom: -5px;
    }
    .close_btn{
        margin-top: 22px;
    }
    .control-label{
        font-weight: 100;
    }
    
</style>
<?php
$lang_ses = $this->session->userdata("site_lang");
?>
<div class="col-sm-12 breadcump img-responsive">
    <div class="row">
        <div class="breadcump-wrapper">
            <div class="wrapper">
                <div style="font-size:25px;" class="breadcump_row"><?php echo $this->lang->line("register"); ?>
                </div>
                <div class="breadcump_row"><a href="<?php echo base_url() ?>"><?php echo $this->lang->line("home"); ?></a> ><?php echo $this->lang->line("register"); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 page_content">
    <div class="col-sm-12 bdy_des">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <h4 class="modal-title text-center">FAO || Food and Agriculture Organization of the United Nations.</h4>
                </div>
                <div class="col-sm-5">
                 <div class="row">
                    <div class="col-sm-12">
                        <p>You already reset your password.please try to login</p>
                        <div class="well">
                          <?php echo form_open("", "id='recovery_info' method='post'"); ?>
                          <a class="btn btn-primary btn-block" type="submit" href="<?php echo site_url('accounts/userLogin'); ?>">Review my recovery info</a>
                          <?php echo form_close(); ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
</div>

