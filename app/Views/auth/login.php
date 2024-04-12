<?php
    use App\Models\Crud;
    $this->Crud = new Crud();

    $log_user_img = 'assets/images/avatar.png';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/plugins.css">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/style.css?v=<?=time(); ?>">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/bootstrap.css?v=<?=time(); ?>">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/dashboard-style.css?v=<?=time(); ?>">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/color.css">
    <link rel="stylesheet" href="<?=site_url();?>assets/css/select2.min.css" />
    <link rel="shortcut icon" href="<?=site_url();?>assets/images/favicon.ico">

    <script src="<?=site_url(); ?>assets/js/jquery.min.js"></script>
    <!-- Include Bootstrap JS and Popper.js -->
    <script src="<?=site_url(); ?>assets/js/popper.min.js" ></script>
    <script src="<?=site_url(); ?>assets/js/bootstrap.min.js"></script>
    
    <!-- Include Bootstrap Select JS -->
    <script src="<?=site_url(); ?>assets/js/select2.min.js" ></script>


</head>

<body>
    <!--loader-->
    <div class="loader-wrap">
        <div class="loader-inner">
            <svg>
                <defs>
                    <filter id="goo">
                        <fegaussianblur in="SourceGraphic" stdDeviation="2" result="blur" />
                        <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 5 -2" result="gooey" />
                        <fecomposite in="SourceGraphic" in2="gooey" operator="atop" />
                    </filter>
                </defs>
            </svg>
        </div>
    </div>
    <!--loader end-->
    <!-- main -->
    <div id="main">
        <!-- header -->
        <header class="main-header">
            <!--  logo  -->
            <div class="logo-holder">
                <a href="<?=site_url(); ?>"><img src="<?=site_url();?>assets/images/logo.png" alt=""></a>
            </div>
            
            <div class="add-list_wrap">
                <?php

                if(empty($log_id)){
                    echo '<div class="show-reg-form "><a href="'.site_url('auth/login').'" class="add-list color-bg"  " pageTitle="" pageName="" pageSize="modal-xl"><i class="fal fa-plus"></i> <span>Add Listing</span></a></div>';
                } else {
                    if(!empty($log_id)){
                        if($role != 'administrator' && $role != 'developer'){
                            echo '<a href="'.site_url('listing/index/add').'" class="add-list color-bg"><i class="fal fa-plus"></i> <span>Add Listing</span></a>';
                        }
                    }
                }
                ?>

            </div>
           
            <?php if(!empty($log_id)){?>
            <div class="cart-btn  tolt show-header-modal" data-microtip-position="bottom"
                data-tooltip="Your Notification">
                <i class="fal fa-bell"></i>
                <span class="cart-btn_counter color-bg" id="notify_no">0</span>
            </div>
            <?php } ?>

            <?php


                if(empty($log_id)){
                    echo '<div class="show-reg-form"><a href="'.site_url('auth/login').'" class=""  pageTitle="" pageName="'.site_url('auth/login').'" pageSize="modal-xl"><i class="fas fa-user"></i><span>Sign In</span></a></div>';
                } else {
                    echo '<div class="show-reg-form"><a href="'.site_url('dashboard').'"><i class="fas fa-user"></i><span>User Dashboard</span></a></div>';
                }
            ?>

            <!-- header-search-wrapper end  -->
            <!-- wishlist-wrap-->
            <div class="header-modal novis_wishlist tabs-act">
                <div class="tabs-container">
                    <div class="tab">
                        <!--tab -->
                        <div id="tab-wish" class="tab-content first-tab">
                            <!-- header-modal-container-->
                            <div class="header-modal-container scrollbar-inner fl-wrap" data-simplebar>
                                <!--widget-posts-->
                                <div class="widget-posts  fl-wrap">
                                    <ul class="no-list-style" id="notify_show">

                                    </ul>
                                </div>
                                <!-- widget-posts end-->
                            </div>
                            <!-- header-modal-container end-->
                            <div class="header-modal-top fl-wrap">
                                <div class="clear_wishlist color-bg" onclick="mark_all();"><i
                                        class="fal fa-trash-alt"></i> Clear all</div><br>
                                <div class="clear_wishlist color-bg"><a class="text-white"
                                        href="<?=site_url('notification'); ?>"><i class="fal fa-eye"></i>See All</a>
                                </div>
                            </div>
                        </div>
                        <!--tab end -->

                    </div>
                    <!--tabs end -->
                </div>
            </div>
            <!--header-opt-modal-->
           
            <!--header-opt-modal end -->
        </header>
        <!-- header end  -->

        <div id="wrapper">	
            <div class="content">
                <section class="parallax-section single-par color-bg">
                    <div class="container">
                        <div class="section-title center-align big-title">
                            <h2><span>Login</span></h2>
                        </div>
                    </div>
                    <div class="pwh_bg"></div>
                    <div class="mrb_pin vis_mr mrb_pin3 "></div>
                    <div class="mrb_pin vis_mr mrb_pin4 "></div>
                </section>
                <!--  section  end-->
                <!-- breadcrumbs-->
                <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
                    <div class="container">
                        <div class="breadcrumbs-list">
                            <a href="<?=site_url(); ?>">Home</a><a href="javacript:;">Login</a>
                        </div>
                    </div>
                </div>
                <!-- breadcrumbs end -->

                <div class="main-register-holder tabs-act">
                    <div class="main-register-wrapper modalmain fl-wrap">
                        <div class="main-register" style="width:100%;padding:5% 22% 2% 15%;">
                            <div id="register_tab">
                                <ul class="tabs-menu fl-wrap no-list-style">
                                    <li  id="link-1" class="current"><a href="#tab-1" onclick="login();"><i class="fal fa-sign-in-alt"></i> Login</a></li>
                                    <li id="link-2"><a href="#tab-2" onclick="logins();"><i class="fal fa-user-plus"></i> Register</a></li>

                                </ul>
                                <!--tabs -->
                                <div class="tabs-container">
                                    <div class="tab">
                                        <!--tab -->
                                        <div id="tab-1" class="tab-content first-tab">
                                            <div class="row py-1">
                                                <div class="col-sm-12">
                                                    <div id="bb_ajax_msg"></div>
                                                </div>
                                            </div>
                                            <div class="customform">
                                                <?php echo form_open_multipart('auth/login', array('id'=>'bb_ajax_form', 'class'=>'text-start')); ?>
                                                <div class="form-group mb-3">
                                                    <label>Email Address *</label>
                                                    <input name="email" type="text" class="form-control" placeholder="Your Email" required  onClick="this.select()" value="">
                                                </div>
                                                <div class="form-group mb-3" style="position:relative">
                                                    <label>Password *</label>
                                                    <input name="password" class="form-control" id="password" placeholder="Your Password" type="password"  autocomplete="off" onClick="this.select()" value="">
                                                    <span class="eye" id="toggle-button" style="position: absolute;
                                                        top: 50%;
                                                        right: 10px; /* Adjust as needed */
                                                        transform: translateY(-50%);
                                                        cursor: pointer;"><i class="fal fa-eye"></i> </span>
                                                </div>
                                                
                                                <div class="lost_password">
                                                    <a href="javascript:;" onclick="forgots()">Reset your Password?</a>
                                                </div>
                                                <div class="clearfix"></div>
                                                <button type="submit" class="btn btn-primary color-bg bb_form_btn"> LogIn </button>
                                                </form>
                                            </div>
                                        </div>


                                        <div id="tab-2" class="tab-content"  style="display:none;">
                                            
                                            <div class="customform">
                                                <?php echo form_open_multipart('auth/register', array('id'=>'bb_ajax_form2', 'class'=>'text-start')); ?>
                                                    <div class="form-group mb-3">
                                                        <label>Full Name *</label>
                                                        <input name="name" type="text" class="form-control" placeholder="Your Name" required  onClick="this.select()" value="">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Email Address * </label>
                                                        <input name="email" type="email" id="email" class="form-control" placeholder="Your Mail" required  onClick="this.select()" value="">
                                                    </div>
                                                    
                                                    <div class="form-group mb-3">
                                                        <label>Phone Number * </label>
                                                        <input name="phone" type="text" class="form-control" placeholder="Your Phone Number" required onClick="this.select()" value="">
                                                    </div>
                                                    
                                                    <div class="form-group mb-3">
                                                        <label>Country *</label>
                                                        <select data-placeholder="Select" name="country_id" id="country_id"  required class="mb-2 form-select search-select"  onchange="get_state();">
                                                            <?php
                                                                $country = $this->Crud->read_order('country', 'name', 'asc');
                                                                if(!empty($country)){
                                                                    foreach($country as $c){
                                                                        if($c->name != 'Nigeria')continue;
                                                                        echo '<option value="'.$c->id.'">'.$c->name.'</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group mb-3">
                                                        <label>State of Residence *</label>
                                                        <select data-placeholder="Select" name="state_id" id="state_i" required class="mb-2 form-select search-select" onchange="get_citys()">
                                                            <option value="">Select State</option>
                                                            <?php
                                                                $country = $this->Crud->read_single_order('country_id', 161, 'state', 'name', 'asc');
                                                                if(!empty($country)){
                                                                    foreach($country as $c){                                                            
                                                                        echo '<option value="'.$c->id.'">'.$c->name.'</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group mb-5">
                                                        <div class="pass-input-wrap fl-wrap">
                                                            <label>Password *</label>
                                                            <input name="password" type="password" id="passwords" class="form-control"  placeholder="Your Password" autocomplete="off" required onClick="this.select()" value="">
                                                            <span class="eye" id="toggle-buttons" style="margin-bottom:-4% !important;"><i class="fal fa-eye"></i> </span>
                                                        </div>
                                                    </div>


                                                    <div class="form-group mt-3 mb-5">
                                                    
                                                        <div class="col-md-8 my-3" style="display:none;" id="otp_input">
                                                            <input name="otp" type="password" class="form-control" id="otp" placeholder="Your OTP" autocomplete="off"  onClick="this.select()" value="">
                                                        </div>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <div class="filter-tags ft-list my-3">
                                                        <input id="check-a2" type="checkbox" name="agree">
                                                        <label for="check-a2">I agree to the <a href="javascript:;">Privacy  Policy</a> and <a href="javascript:;">Terms and  Conditions</a></label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <button type="submit" class="btn btn-block btn-primary color-bg bb_form_btn" id="register_btn" > Register </button>
                                                </form>
                                            </div>
                                            <div class="row py-1">
                                                <div class="col-sm-12">
                                                    <div id="bb_ajax_msg2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--tab end -->
                                    </div>
                                </div>
                            </div>

                            <div id="forgot_tab" style="display:none;">
                                <!--tabs -->
                                <div class="container" style="padding:35px;">
                                    <div class="row py-1">
                                        <div class="col-sm-12">
                                            <div id="bb_ajax_msg3"></div>
                                        </div>
                                    </div>
                                    <div class="custom-form">

                                        <?php echo form_open_multipart('auth/password/forgot', array('id'=>'bb_ajax_form3', 'class'=>'')); ?>
                                            <label>Email Address * <span class="dec-icon"><i class="fal fa-envelope"></i></span></label>
                                            <input name="email" id="email" type="email" placeholder="Your Mail"  autocomplete="off" onClick="this.select()" required value="">
                                            <div id="code_resp" style="display:none">
                                                <label>Reset Code * <span class="dec-icon"><i class="fal fa-envelope"></i></span></label>
                                                <input name="code" id="code" type="text" placeholder="Reset Code"  onClick="this.select()" value="">

                                            </div>
                                            <div id="password_resp" style="display:none">
                                                <div class="pass-input-wrap fl-wrap">
                                                    <label>New Password * <span class="dec-icon"><i class="fal fa-key"></i></span></label>
                                                    <input name="pwd" id="pwd" type="password" placeholder="New Password" autocomplete="off" onClick="this.select()" value="">
                                                    <span class="eye"><i class="fal fa-eye"></i> </span>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <button type="submit" class="log_btn color-bg bb_orm_btn"> Reset </button>
                                        </form>
                                        <div class="lost_password">
                                            <a href="javascript:;" onclick="register()">Return to Login</a>
                                        </div>
                                    </div>
                                    <!--tab end -->
                                </div>

                            </div>
                        </div>

                    </div>
                                                                    
                </div>
 
               
            </div>
                                   
        </div>
    </div>
   
    <!--=============== scripts  ===============-->
    <script src="<?=site_url(); ?>assets/js/plugins.js"></script>
    <script src="<?=site_url(); ?>assets/js/scripts.js"></script>
    <script src="<?=site_url(); ?>assets/js/dashboard.js"></script>
    <script src="<?=site_url();?>assets/js/jsform.js"></script>
    <script src="<?=site_url();?>assets/js/jsmodal.js"></script>
<script>
    $(function() {
        $(".chosen-select").niceSelect();
    });
</script>
<script>
    var site_url = '<?php echo site_url(); ?>';

    function verify_email(){
        var email = $('#email').val();
        $('#otp_input').hide(500);
        if(email == ''){
            $('#otp_response').html('<span class="text-danger">Enter Email First for Account Verification</span>');
            $('#otp_input').hide(500);
        } else {
            $('#otp_response').html('Sending OTP Code...');
            $.ajax({
                url: site_url + 'auth/account/verify_email',
                type: 'post',
                data: {email : email},
                type: 'post',
                success: function(data) {
                    $('#otp_response').html(data);
                }
            });
        }
    }

    function get_state() {
        var country_id = $('#country_id').val();
        $.ajax({
            url: site_url + 'auth/account/get_state/' + country_id,
            type: 'post',
            success: function(data) {
                $('#states_id').html(data);
            }
        });
    }

    function logins() {
        $('#tab-2').show(500);
        $('#tab-1').hide(500);
        $('#link-2').addClass('current');
        $('#link-1').removeClass('current');

    }

    function login() {
        $('#tab-1').show(500);
        $('#tab-2').hide(500);
        $('#link-1').addClass('current');
        $('#link-2').removeClass('current');

    }

    
    function forgots() {
        $('#forgot_tab').show(500);
        $('#register_tab').hide(500);

    }

    function register() {
        $('#forgot_tab').hide(500);
        $('#register_tab').show(500);

    }


    function get_citys() {
        var state_id = $('#state_i').val();
        // console.log(state_id);
        $.ajax({
            url: site_url + 'auth/account/get_city/' + state_id,
            type: 'post',
            success: function(data) {
                $('#citys_id').html(data);
            }
        });
    }
    function togglePasswordVisibility() {
        const passwordInput = $('#password');
        if (passwordInput.attr('type') === 'password') {
            // Change input type to text to show the password
            passwordInput.attr('type', 'text');
        } else {
            // Change input type back to password to hide the password
            passwordInput.attr('type', 'password');
        }
    }

    $(document).ready(function() {
        const toggleButton = $('#toggle-button');

        toggleButton.on('click', function() {
            togglePasswordVisibility();
        });
    });
    function togglePasswordVisibilitys() {
        const passwordInput = $('#passwords');
        if (passwordInput.attr('type') === 'password') {
            // Change input type to text to show the password
            passwordInput.attr('type', 'text');
        } else {
            // Change input type back to password to hide the password
            passwordInput.attr('type', 'password');
        }
    }

    $(document).ready(function() {
        const toggleButton = $('#toggle-buttons');

        toggleButton.on('click', function() {
            togglePasswordVisibilitys();
        });
    });
</script>
