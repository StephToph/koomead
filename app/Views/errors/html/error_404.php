

<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
    $log_id = 0;
    $log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
    $log_role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
	$log_role = strtolower($this->Crud->read_field('id', $log_role_id, 'access_role', 'name'));
    $log_user_img = 'assets/images/avatar.png';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Page not Found</title>

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
            <div class="logo-holder"><a href="<?=site_url(); ?>"><img src="<?=site_url();?>assets/images/logo.png"
                        alt=""></a></div>
            <!-- logo end  -->

            <!-- nav-button-wrap end-->

            <!-- header-search button end  -->
            <!--  add new  btn -->
            <div class="add-list_wrap">
                <?php

                if(empty($log_id)){
                    echo '<div class="show-reg-form "><a href="javascript:;" class="add-list pops color-bg"  " pageTitle="" pageName="'.site_url('auth/login').'" pageSize="modal-xl"><i class="fal fa-plus"></i> <span>Add Listing</span></a></div>';
                } else {
                    echo '<a href="'.site_url('listing/index/add').'" class="add-list color-bg"><i class="fal fa-plus"></i> <span>Add Listing</span></a>';
                }
                ?>

            </div>
            <!--  add new  btn end -->
            <!--  header-opt_btn -->
            <div class="header-opt_btn tolt" style="display:bloc" data-microtip-position="bottom"
                data-tooltip="Country">
                <span><i class="fal fa-globe"></i></span>
            </div>
            <!--  header-opt_btn end -->
            <!--  cart-btn   -->
            <!--  cart-btn   -->
            <?php if(!empty($log_id)){?>
            <div class="cart-btn  tolt show-header-modal" data-microtip-position="bottom"
                data-tooltip="Your Notification">
                <i class="fal fa-bell"></i>
                <span class="cart-btn_counter color-bg" id="notify_no">0</span>
            </div>
            <?php } ?>

            <?php


                if(empty($log_id)){
                    echo '<div class="show-reg-form"><a href="javascript:;" class="pops"  " pageTitle="" pageName="'.site_url('auth/login').'" pageSize="modal-xl"><i class="fas fa-user"></i><span>Sign In</span></a></div>';
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
            <div class="header-opt-modal novis_header-mod">
                <div class="header-opt-modal-container hopmc_init">
                    <div class="header-opt-modal-item lang-item fl-wrap">
                        <?php 
                            $cur = '₦';
                            $sel = 'class="current-lan"';
                            if(!empty($log_id)){
                                $country = $this->Crud->read_field('id', $log_id, 'user', 'country_id'); 
                                if($country != 161){
                                    $cur = '&#8358;';
                                    $sel = 'class="current-lan"';
                                }
                            }
                        ?>
                        <h4>Country: <span><?=$cur;?></span></h4>
                        <div class="header-opt-modal-list fl-wrap">
                            <ul>
                                <li><a href="javascript:;" onclick="get_country('Nigeria')" <?=$sel;?>
                                        data-lantext="₦">Nigeria</a></li>
                                <li><a href="javascript:;" onclick="get_country('United Kingdom')"
                                        data-lantext="$">United Kingdom</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--header-opt-modal end -->
        </header>
        <!-- header end  -->

        <div id="wrapper">
            <div class="content">
                <!--  section  -->
                <section class="parallax-section color-bg" data-scrollax-parent="true">
                    <div class="container">
                        <div class="error-wrap">
                            <div class="hero-text-big">
                                <h6>404</h6>
                            </div>
                            <p>We're sorry, but the Page you were looking for, couldn't be found.</p>
                            <div class="clearfix"></div>
                            
                            <a href="<?=site_url(); ?>" class="btn   color-bg">Back to Home Page</a>
                        </div>
                    </div>
                    <div class="pwh_bg fw-pwh">
                        <div class="mrb_pin vis_mr mrb_pin3 "></div>
                        <div class="mrb_pin vis_mr mrb_pin4 "></div>
                    </div>
                </section>
                <!--  section  end-->
            </div>
            </div>
                    </div>
                </div>
                <!--sub-footer end -->
            </footer>
            <!-- footer end -->
        </div>
        <!-- wrapper end -->
        <!--register form -->
        <div class="main-register-wrap ">
            <div class="reg-overlay"></div>
                <div class="secondary-nav">
                    <ul>
                        <li><a href="javascript:;" class="tolt show-reg-form modal-open" data-microtip-position="left"
                                data-tooltip="Register"><i class="fal fa-sign-in-alt"></i></a></li>
                        <li><a href="javascript:;" class="tolt show-reg-form modal-open" data-microtip-position="left"
                                data-tooltip="Login"> <i class="fal fa-shopping-bag"></i></a></li>
                    </ul>
                    <div class="progress-indicator">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34">
                            <circle cx="16" cy="16" r="15.9155" class="progress-bar__background" />
                            <circle cx="16" cy="16" r="15.9155" class="progress-bar__progress 
                        js-progress-bar" />
                        </svg>
                    </div>
                </div>
                <!--secondary-nav end -->
                <a class="to-top color-bg"><i class="fas fa-caret-up"></i></a>
                <!--map-modal -->

                <!--map-modal end -->
            </div>
            <!-- Main end -->                            
        </div>
    </div>
    <div class="modal modal-center fade modality" id="modal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">  </h5>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal">
                        <i class="fal fa-times-octagon"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                
            </div>
        </div>
    </div>

   
    <!--=============== scripts  ===============-->
    <script src="<?=site_url(); ?>assets/js/charts.js"></script>
    <script src="<?=site_url(); ?>assets/js/plugins.js"></script>
    <script src="<?=site_url(); ?>assets/js/scripts.js"></script>
    <script src="<?=site_url(); ?>assets/js/dashboard.js"></script>
    <script src="<?=site_url();?>assets/js/jsform.js"></script>
         