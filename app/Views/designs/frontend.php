<?php
    use App\Models\Crud;
    $this->Crud = new Crud();

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
    <title><?php echo $this->renderSection('title'); ?></title>

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
                            $cur = 'NGN';
                            $sel = 'class="current-lan"';
                            if(!empty($log_id)){
                                $country = $this->Crud->read_field('id', $log_id, 'user', 'country_id'); 
                                if($country != 161){
                                    $cur = 'UK';
                                    $sel = 'class="current-lan"';
                                }
                            }
                        ?>
                        <h4>Country: <span><?=$cur;?></span></h4>
                        <div class="header-opt-modal-list fl-wrap">
                            <ul>
                                <li><a href="javascript:;" onclick="get_country('Nigeria')" <?=$sel;?>
                                        data-lantext="NGN">Nigeria</a></li>
                                <li><a href="javascript:;" onclick="get_country('United Kingdom')"
                                        data-lantext="UK">United Kingdom</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--header-opt-modal end -->
        </header>
        <!-- header end  -->

        <div id="wrapper">

            <?php echo $this->renderSection('content'); ?>

            <!-- footer -->
            <footer class="main-footer fl-wrap">
                <div class="footer-inner fl-wrap">
                    <div class="container">
                        <div class="row">
                            <!-- footer widget-->
                            <div class="col-md-3">
                                <div class="footer-widget fl-wrap">
                                    <div class="footer-widget-logo fl-wrap">
                                        <img src="<?=site_url();?>assets/images/logo.png" alt="">
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar
                                        neque. Nulla finibus lobortis pulvinar.</p>

                                </div>
                            </div>
                            <!-- footer widget end-->
                            <!-- footer widget-->
                            <div class="col-md-3">
                                <div class="footer-widget fl-wrap">
                                    <div class="footer-widget-title fl-wrap">
                                        <h4>Helpful links</h4>
                                    </div>
                                    <ul class="footer-list fl-wrap">
                                        <li><a href="javascript:;">About Our Company</a></li>
                                        <li><a href="javascript:;">Our last News</a></li>
                                        <li><a href="javascript:;">Pricing Plans</a></li>
                                        <li><a href="javascript:;">Contacts</a></li>
                                        <li><a href="javascript:;">Help Center</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- footer widget end-->
                            <!-- footer widget-->
                            <div class="col-md-3">
                                <div class="footer-widget fl-wrap">
                                    <div class="footer-widget-title fl-wrap">
                                        <h4>Contacts Info</h4>
                                    </div>
                                    <ul class="footer-contacts fl-wrap">
                                        <li><span><i class="fal fa-envelope"></i> Mail :</span><a
                                                href="javascript:;">admin@koomeli.com</a></li>
                                        <li> <span><i class="fal fa-map-marker"></i> Adress :</span><a
                                                href="javascript:;">USA 27TH Brooklyn NY</a></li>
                                        <li><span><i class="fal fa-phone"></i> Phone :</span><a
                                                href="javascript:;">+7(111)123456789</a></li>
                                    </ul>
                                    <div class="footer-social fl-wrap">
                                        <ul>
                                            <li><a href="javascript:;"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="javascript:;"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="javascript:;"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="javascript:;"><i class="fab fa-vk"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- footer widget end-->
                            <!-- footer widget-->
                            <div class="col-md-3">
                                <div class="footer-widget fl-wrap">
                                    <div class="footer-widget-title fl-wrap">
                                        <h4>Download our API</h4>
                                    </div>
                                    <p>Start working with <?=app_name; ?> that can provide everything you need </p>
                                    <div class="api-links fl-wrap">
                                        <a href="javascript:;" class="api-btn color-bg"><i class="fab fa-apple"></i> App
                                            Store</a>
                                        <a href="javascript:;" class="api-btn color-bg"><i
                                                class="fab fa-google-play"></i> Play Market</a>
                                    </div>
                                </div>
                            </div>
                            <!-- footer widget end-->
                        </div>
                    </div>
                </div>
                <!--sub-footer-->
                <div class="sub-footer gray-bg fl-wrap">
                    <div class="container">
                        <div class="copyright"> &#169; <?=app_name; ?> <?=date('Y'); ?> . All rights reserved.</div>
                        <div class="subfooter-nav">
                            <ul class="no-list-style">
                                <li><a href="javascript:;">Terms of use</a></li>
                                <li><a href="javascript:;">Privacy Policy</a></li>
                                <li><a href="javascript:;">Blog</a></li>
                            </ul>
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
    <?php

    if($page_active == 'home'){?>
            
        <input type="hidden" id="country_id" value="">

        <script>var site_url = '<?php echo site_url(); ?>';</script>
        <script>
            
            function load(x, y) {
                var more = 'no';
                var methods = '';
                if (parseInt(x) > 0 && parseInt(y) > 0) {
                    more = 'yes';
                    methods = '/' +x + '/' + y;
                }

                if (more == 'no') {
                    $('#load_data').html('<div class="col-sm-12 text-center"><br/><i class="fal fa-spinner fa-spin" style="font-size:48px;"></i><br/><br/><br/></div>');
                } else {
                    $('#loadmore').html('<div class="col-sm-12 text-center"><i class="fal fa-spinner fa-spin"></i></div>');
                }

                var country_id = $('#country_id').val();
                var state_id = $('#state_id').val();
            

                $.ajax({
                    url: site_url + 'home/list_load/load' + methods,
                    type: 'post',
                    data: {state_id: state_id,country_id: country_id },
                    success: function (data) {
                        var dt = JSON.parse(data);
                        if (more == 'no') {
                            $('#load_data').html(dt.item);
                        } else {
                            $('#load_data').append(dt.item);
                        }

                        if (dt.offset > 0) {
                            $('#loadmore').html('<a href="javascript:;" class="btn btn-secondary b-block p-30" onclick="load(' + dt.limit + ', ' + dt.offset + ');"><i class="fal fa-repeat"></i> Load ' + dt.left + ' More</a>');
                        } else {
                            $('#loadmore').html('');
                        }

                        $('#listCount').html(dt.count);
                    }
                });
            }

            function load_state(x, y) {
                var more = 'no';
                var methods = '';
                if (parseInt(x) > 0 && parseInt(y) > 0) {
                    more = 'yes';
                    methods = '/' +x + '/' + y;
                }

                if (more == 'no') {
                    $('#load_state').html('<div class="col-sm-12 text-center"><br/><i class="fal fa-spinner fa-spin" style="font-size:48px;"></i><br/><br/><br/></div>');
                } else {
                    $('#loadmore').html('<div class="col-sm-12 text-center"><i class="fal fa-spinner fa-spin"></i></div>');
                }

                var country_id = $('#country_id').val();
                var state_id = $('#state_id').val();
            

                $.ajax({
                    url: site_url + 'home/list_state/load' + methods,
                    type: 'post',
                    data: {state_id: state_id,country_id: country_id },
                    success: function (data) {
                        var dt = JSON.parse(data);
                        if (more == 'no') {
                            $('#load_state').html(dt.item);
                        } else {
                            $('#load_state').append(dt.item);
                        }
                    },
                        complete: function () {
                            $.getScript(site_url + 'assets/js/jsmodal.js');
                        }
                });
            }


            function get_country(country){
                if(country !== ''){
                    $.ajax({
                        url: site_url + 'home/get_country',
                        type: 'post',
                        data: {country: country },
                        success: function (data) {
                            $('#country_id').val(data);
                            
                            console.log(data);
                            load('','');load_state('','');
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error("AJAX Error:", textStatus, errorThrown);
                        }
                    });
                }
            }
            
            function modals(country){
                $(".modal").on('hidden.bs.modal', function () {
                    $(this).data('bs.modal', null);
                });	
                var country_id = $('#country_id').val();
                var pageTitle = 'Location Info';
                var pageName = site_url + 'home/location/'+country;
                var pageSize = 'modal-md';
               
                $(".modal-dialog").addClass(pageSize);
                $(".modal-center .modal-title").html(pageTitle);
                $(".modal-center .modal-body").html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-spin" style="font-size:24px;"></i> Processing Request.. Please Wait..</div>');
                $(".modal-center .modal-body").load(pageName);
                $(".modal-center").modal("show");
            }

            function showCountry(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                // Use a reverse geocoding service to get the country from the latitude and longitude.
                // You can use an API like OpenCage Geocoder, Google Geocoding API, or others.
                // Here, we're using the Nominatim service for simplicity.
                const apiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`;

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        const country = data.address.country;
                        
                        console.log(country);
                        // Use the country information as needed.
                        if(country !== 'Nigeria' && country != 'United Kingdom'){
                            modals(country);
                            
                        } else{
                            get_country(country);
                        }
                       
                    })
                    .catch(error => {
                        console.error("Error fetching country information:", error);
                    });
            }

            function showError(error) {
                console.error("Error getting location:", error);
            }

            // Check if the Geolocation API is available in the browser

            <?php 

            if(empty($log_id)){
                if(!empty($location)){?>
                    var country = '<?=$location; ?>';
                    get_country(country);
               <?php }else{?>
                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(showCountry, showError);
                } else {
                    console.error("Geolocation is not available in this browser.");
                }

                <?php }?>
               
            <?php } else {  $country = $this->Crud->read_field('id', $log_id, 'user', 'country_id'); 
                $country =  $this->Crud->read_field('id', $country, 'country', 'name'); ?>
                // console.log('tre'+<?=$country; ?>);
                var country = '<?=$country; ?>';
                get_country(country);
            <?php } ?>
        </script>


    <?php } ?>
    <script>
            var site_url = '<?php echo site_url(); ?>';

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

            function forgots() {
                $('#forgot_tab').show(500);
                $('#register_tab').hide(500);

            }

            function register() {
                $('#forgot_tab').hide(500);
                $('#register_tab').show(500);

            }


            function get_city() {
                var state_id = $('#state_id').val();
                $.ajax({
                    url: site_url + 'auth/account/get_city/' + state_id,
                    type: 'post',
                    success: function(data) {
                        $('#citys_id').html(data);
                    }
                });
            }

            function get_category() {
                var category_id = $('#category_id').val();
                $.ajax({
                    url: site_url + 'auth/account/get_category/' + category_id,
                    type: 'post',
                    success: function(data) {
                        $('#subs_id').html(data);
                    }
                });
            }
            </script>

            <script>
            var site_url = '<?php echo site_url(); ?>';
            </script>

            <script>
            <?php if($log_id){?>
            $(function() {
                loada('', '');
            });
            <?php } ?>


            function loada(x, y) {
                var more = 'no';
                var methods = '';


                if (more == 'no') {
                    $('#notify_show').html(
                        '<div class="col-sm-12 text-center"><br/><i class="fal fa-spinner fa-spin" style="font-size:48px;"></i></div>'
                        );
                } else {
                    $('#loadmore').html(
                        '<div class="col-sm-12 text-center"><i class="fal fa-spinner fa-spin"></i></div>');
                }

                var country_id = $('#country_id').val();
                var state_id = $('#state_id').val();


                $.ajax({
                    url: site_url + 'notification/index/nav_load' + methods,
                    type: 'post',
                    success: function(data) {
                        var dt = JSON.parse(data);
                        if (more == 'no') {
                            $('#notify_show').html(dt.item);
                        }

                        $('#notify_no').html(dt.count);
                    },
                });
            }
            </script>

            <script>
            function mark_read(id) {
                $.ajax({
                    url: site_url + 'notification/mark_read/' + id,
                    type: 'post',
                    success: function(data) {
                        // window.location.replace("<?=site_url('notification/list'); ?>");
                        load();
                    }
                });
            }

            function mark_all() {
                $.ajax({
                    url: site_url + 'notification/mark_all',
                    type: 'post',
                    success: function(data) {
                        load();
                    }
                });
            }

            function plays() {
                var src = '<?=site_url(); ?>' + 'assets/audio/3.wav';
                var audio = new Audio(src);
                audio.play();
            }

            <?php 
           $notify = $this->Crud->read2('to_id', $log_id, 'new', 1, 'notify');
           if(!empty($notify)){?>
            $(function() {
                plays();
            });
            <?php }?>
            </script>

</body>

</html>