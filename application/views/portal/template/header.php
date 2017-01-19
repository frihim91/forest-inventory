<link href="<?php echo base_url(); ?>resources/resource_potal/assets/css/plugins/select2/select2.min.css" rel="stylesheet"/>
<style type="text/css">
    .sub-header {
        color: #FF4F57;
        font-size: 16px;
    }
    .navbar-default .navbar-nav > li > a {
        color: #000;
    }
    .dropdown-menu li, .dropdown-menu a {
        font-size: 12px;
    }
    .dropdown-menu li {
        color: #333 !important;
        padding: 0px 5px 0px 8px;
    }
    .dropdown-menu a {
        color: #443266 !important;
    }
    .dropdown-menu li ul li:hover {
        background-color: #428BCA;
    }


/*li a, .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}


    li.dropdown {
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: none;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}*/


/*.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
}
*/
/*.dropdown:hover .dropdown-menu {
    display: block;
}*/
</style>
<div class="navbar navbar-default yamm">
    <div class="navbar-header">
        <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle">
            <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    </div>
    <div id="navbar-collapse-grid" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown"><a href="#">Home</a></li>
           <!--  <li class="dropdown"><a href="<?php echo site_url('portal/index'); ?>">Home</a></li> -->

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About us <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li ><a href="#" >Introduction/Conceptual overview</a></li>
                     <li role="presentation" class="divider"></li>
                    <li><a href="#">Mission statement</a></li>
                     <li role="presentation" class="divider"></li>
                    <li ><a href="#">Organogram</a></li>
                     <li role="presentation" class="divider"></li>
                    <li ><a href="#">Staff Directory</a></li>
                   
                </ul>
            </li>


             <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Key Activities <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li ><a href="#">Forest inventory</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="#">Socio-economic survey</a></li>
                    <li role="presentation" class="divider"></li>
                    <li ><a href="#">LCCS</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="#">MRV</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="#">Capacity building</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="#">GHG Inventory</a></li>
                   
                </ul>
            </li>
          <li class="dropdown">
                <a href="#">Documents/Media</a>
            </li> 
            <!--    <li class="dropdown">
                <a href="<?php echo site_url('portal/contact'); ?>">Documents/Media</a>
            </li> --> 
            <li class="online_reg">
                <a href="#">News & Events</a>
            </li>
            <li class="dropdown">
                <a href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/tender-notice-n.pdf">Network</a>
            </li>
             
             <li class="dropdown">
                <a href="#">Themes</a>
            </li>

            <!--  <li class="dropdown">
                <a href="<?php echo base_url(); ?>resources/resource_potal/assets/portal/tender-notice-n.pdf">Themes</a>
            </li> -->

            <li class="dropdown">
                <a href="#">Projects</a>
            </li>

             <li class="dropdown">
                <a href="#">Vacancy</a>
            </li>

            <li class="dropdown">
                <a href="#">Gallery</a>
            </li>

             <li class="dropdown">
                <a href="#">Contact Us</a>
            </li>
        </ul>
<!--         <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url('portal/get_register'); ?>" class="btn btn-default btn-sm">Registration</a></li>
            <li>
                <div class="dropdown login_menu_btn">
                    <a href="<?php echo site_url('portal/login'); ?>" class="btn btn-default btn-sm dropdown-toggle login_btn_drp">Login</a>
                    <div class="dropdown-menu login">
                        <div id="login">
                            <div class="login_form">
                                <h3>
                                    <span class="lh1"><strong>ব্যবহারকারী</strong></span> &nbsp;<span class="lh2">
                                    <strong>লগ ইন</strong></span>
                                </h3>
                                <form action="#" method="post" id="login-form">
                                    <div class="form-group">
                                        <input type="email" name="email" required="" class="form-control inpup_field" id="exampleInputEmail1" placeholder="আপনার ইমেইল">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" required="" class="form-control inpup_field" id="exampleInputPassword1" placeholder="আপনার পাসওয়ার্ড">
                                    </div>
                                    <input type="checkbox"><span> আমাকে সাইন ইন রাখুন</span><br>
                                    <input type="submit" class="submit_value" value="Log In"><br>
                                </form>
                                <a href="#" class="account_problem">আমি আমার অ্যাকাউন্ট অ্যাক্সেস করতে পারছি না</a>
                            </div>
                            <div class="hr">
                                <div class="hr1"></div>
                                <div class="or">অথবা</div>
                                <div class="hr2"></div>
                            </div>
                            <div class="new_account">
                                <a href="<?php echo site_url('portal/get_register'); ?>"><strong>নতুন অ্যাকাউন্ট তৈরি করুন</strong></a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul> -->
    </div>
</div>

<script src="<?php echo base_url(); ?>resources/resource_potal/assets/js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>resources/resource_potal/assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>