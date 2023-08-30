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
   
    <meta name="robots" content="index, follow"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <!-- css   -->	
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/plugins.css">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/style.css">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/color.css">
    <!--  favicons  -->
    <link rel="shortcut icon" href="<?=site_url();?>assets/images/favicon.ico">
</head>
<body>
    <!--loader-->
    <div class="loader-wrap">
        <div class="loader-inner">
            <svg>
                <defs>
                    <filter id="goo">
                        <fegaussianblur in="SourceGraphic" stdDeviation="2" result="blur" />
                        <fecolormatrix in="blur"   values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 5 -2" result="gooey" />
                        <fecomposite in="SourceGraphic" in2="gooey" operator="atop"/>
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
            <div class="logo-holder"><a href="<?=site_url(); ?>"><img src="<?=site_url();?>assets/images/logo.png" alt=""></a></div>
            <!-- logo end  -->
            <!-- nav-button-wrap--> 
            <div class="nav-button-wrap color-bg nvminit">
                <div class="nav-button">
                    <span></span><span></span><span></span>
                </div>
            </div>
            <!-- nav-button-wrap end-->	
            <!-- header-search button  -->
            <div class="header-search-button">
                <i class="fal fa-search"></i>
                <span>Search...</span>
            </div>
            <!-- header-search button end  -->
            <!--  add new  btn -->
            <div class="add-list_wrap">
                <a href="dashboard-add-listing.html" class="add-list color-bg"><i class="fal fa-plus"></i> <span>Add Listing</span></a>
            </div>
            <!--  add new  btn end -->
            <!--  header-opt_btn -->
            <div class="header-opt_btn tolt" data-microtip-position="bottom"  data-tooltip="Language / Currency">
                <span><i class="fal fa-globe"></i></span>
            </div>
            <!--  header-opt_btn end -->
            <!--  cart-btn   -->
            <div class="cart-btn  tolt show-header-modal" data-microtip-position="bottom"  data-tooltip="Your Wishlist / Compare">
                <i class="fal fa-bell"></i>
                <span class="cart-btn_counter color-bg">5</span>
            </div>
            <!--  cart-btn end -->
            <!--  login btn -->
            <?php

                if(empty($log_id)){
                    echo '<div class="show-reg-form modal-open"><i class="fas fa-user"></i><span>Sign In</span></div>';
                } else {
                    echo '<div class="show-reg-form"><a href="'.site_url('dashboard').'"><i class="fas fa-user"></i><span>User Dashboard</span></a></div>';
                }
            ?>
            
            <!--  login btn  end -->
            <!--  navigation --> 
            <div class="nav-holder main-menu">
                <nav>
                    <ul class="no-list-style">
                        <li>
                            <a href="#" class="act-link">Home <i class="fa fa-caret-down"></i></a>
                            <!--second level -->   
                            <ul>
                                <li><a href="<?=site_url(); ?>">Parallax Image</a></li>
                                <li><a href="index2.html">Slider</a></li>
                                <li><a href="index3.html">Video</a></li>
                                <li><a href="index4.html">Slideshow</a></li>
                                <li><a href="dark/<?=site_url(); ?>" target="_blank">Dark Demo</a></li>
                            </ul>
                            <!--second level end-->
                        </li>
                        <li>
                            <a href="#">Listings <i class="fa fa-caret-down"></i></a>
                            <!--second level -->
                            <ul>
                                <li><a href="listing.html">Column map</a></li>
                                <li><a href="listing2.html">Column map 2</a></li>
                                <li><a href="listing3.html">Fullwidth Map</a></li>
                                <li><a href="listing4.html">Fullwidth Map 2</a></li>
                                <li><a href="listing5.html">Without Map</a></li>
                                <li><a href="listing6.html">Without Map 2</a></li>
                                <li>
                                    <a href="#">Single <i class="fa fa-caret-down"></i></a>
                                    <!--third  level  -->
                                    <ul>
                                        <li><a href="listing-single.html">Style 1</a></li>
                                        <li><a href="listing-single2.html">Style 2</a></li>
                                        <li><a href="listing-single3.html">Style 3</a></li>
                                    </ul>
                                    <!--third  level end-->
                                </li>
                            </ul>
                            <!--second level end-->
                        </li>
                        <li>
                            <a href="#">Agents<i class="fa fa-caret-down"></i></a>
                            <!--second level -->   
                            <ul>
                                <li><a href="agent-list.html">Agent List</a></li>
                                <li><a href="agency-list.html">Agency List</a></li>
                                <li><a href="agent-single.html">Agent Single</a></li>
                                <li><a href="agency-single.html">Agency Single</a></li>
                            </ul>
                            <!--second level end-->
                        </li>
                        <li>
                            <a href="blog.html">News</a>
                        </li>
                        <li>
                            <a href="#">Pages <i class="fa fa-caret-down"></i></a>
                            <!--second level -->   
                            <ul>
                                <li><a href="about.html">About</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="help.html">Help FAQ</a></li>
                                <li><a href="pricing.html">Pricing </a></li>
                                <li><a href="dashboard.html">User Dashboard</a></li>
                                <li><a href="blog-single.html">Blog Single</a></li>
                                <li><a href="compare.html">Compare</a></li>
                                <li><a href="coming-soon.html">Coming Soon</a></li>
                                <li><a href="404.html">404</a></li>
                            </ul>
                            <!--second level end-->                                
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- navigation  end -->
            <!-- header-search-wrapper -->
            <div class="header-search-wrapper novis_search">
                <div class="header-serach-menu">
                    <div class="custom-switcher fl-wrap">
                        <div class="fieldset fl-wrap">
                            <input type="radio" name="duration-1"  id="buy_sw" class="tariff-toggle" checked>
                            <label for="buy_sw">Buy</label>
                            <input type="radio" name="duration-1" class="tariff-toggle"  id="rent_sw">
                            <label for="rent_sw" class="lss_lb">Rent</label>
                            <span class="switch color-bg"></span>
                        </div>
                    </div>
                </div>
                <div class="custom-form">
                    <form method="post"  name="registerform">
                        <label>Keywords </label>
                        <input type="text" placeholder="Address , Street , State..." value=""/>
                        <label >Categories</label>
                        <select data-placeholder="Categories" class="chosen-select on-radius no-search-select" >
                            <option>All Categories</option>
                            <option>House</option>
                            <option>Apartment</option>
                            <option>Hotel</option>
                            <option>Villa</option>
                            <option>Office</option>
                        </select>
                        <label style="margin-top:10px;" >Price Range</label>
                        <div class="price-rage-item fl-wrap">
                            <input type="text" class="price-range" data-min="100" data-max="100000"  name="price-range1"  data-step="1" value="1" data-prefix="$">
                        </div>
                        <button onclick="location.href='listing.html'" type="button"  class="btn float-btn color-bg"><i class="fal fa-search"></i> Search</button>
                    </form>
                </div>
            </div>
            <!-- header-search-wrapper end  -->				
            <!-- wishlist-wrap--> 
            <div class="header-modal novis_wishlist tabs-act">
                <ul class="tabs-menu fl-wrap no-list-style">
                    <li class="current"><a href="#tab-wish">  Wishlist <span>- 3</span></a></li>
                    <li><a href="#tab-compare">  Compare <span>- 2</span></a></li>
                </ul>
                <!--tabs -->                       
                <div class="tabs-container">
                    <div class="tab">
                        <!--tab -->
                        <div id="tab-wish" class="tab-content first-tab">
                            <!-- header-modal-container--> 
                            <div class="header-modal-container scrollbar-inner fl-wrap" data-simplebar>
                                <!--widget-posts-->
                                <div class="widget-posts  fl-wrap">
                                    <ul class="no-list-style">
                                        <li>
                                            <div class="widget-posts-img"><a href="listing-single.html"><img src="<?=site_url();?>assets/images/all/small/1.jpg" alt=""></a>  
                                            </div>
                                            <div class="widget-posts-descr">
                                                <h4><a href="listing-single.html">Affordable Urban Room</a></h4>
                                                <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> 40 Journal Square  , NJ, USA</a></div>
                                                <div class="widget-posts-descr-price"><span>Price: </span> $ 1500 / per month</div>
                                                <div class="clear-wishlist"><i class="fal fa-trash-alt"></i></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="widget-posts-img"><a href="listing-single.html"><img src="<?=site_url();?>assets/images/all/small/2.jpg" alt=""></a>
                                            </div>
                                            <div class="widget-posts-descr">
                                                <h4><a href="listing-single.html">Family House</a></h4>
                                                <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> 34-42 Montgomery St , NY, USA</a></div>
                                                <div class="widget-posts-descr-price"><span>Price: </span> $ 50.000</div>
                                                <div class="clear-wishlist"><i class="fal fa-trash-alt"></i></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="widget-posts-img"><a href="listing-single.html"><img src="<?=site_url();?>assets/images/all/small/3.jpg" alt=""></a>
                                            </div>
                                            <div class="widget-posts-descr">
                                                <h4><a href="listing-single.html">Apartment to Rent</a></h4>
                                                <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i>75 Prince St, NY, USA</a></div>
                                                <div class="widget-posts-descr-price"><span>Price: </span> $100 / per night</div>
                                                <div class="clear-wishlist"><i class="fal fa-trash-alt"></i></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- widget-posts end-->
                            </div>
                            <!-- header-modal-container end--> 
                            <div class="header-modal-top fl-wrap">
                                <div class="clear_wishlist color-bg"><i class="fal fa-trash-alt"></i> Clear all</div>
                            </div>
                        </div>
                        <!--tab end -->
                        <!--tab -->
                        <div class="tab">
                            <div id="tab-compare" class="tab-content">
                                <!-- header-modal-container--> 
                                <div class="header-modal-container scrollbar-inner fl-wrap" data-simplebar>
                                    <!--widget-posts-->
                                    <div class="widget-posts  fl-wrap">
                                        <ul class="no-list-style">
                                            <li>
                                                <div class="widget-posts-img"><a href="listing-single.html"><img src="<?=site_url();?>assets/images/all/small/4.jpg" alt=""></a>  
                                                </div>
                                                <div class="widget-posts-descr">
                                                    <h4><a href="listing-single.html">Gorgeous house for sale</a></h4>
                                                    <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i>  70 Bright St New York, USA </a></div>
                                                    <div class="widget-posts-descr-price"><span>Price: </span> $ 52.100</div>
                                                    <div class="clear-wishlist"><i class="fal fa-trash-alt"></i></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="widget-posts-img"><a href="listing-single.html"><img src="<?=site_url();?>assets/images/all/small/5.jpg" alt=""></a>
                                                </div>
                                                <div class="widget-posts-descr">
                                                    <h4><a href="listing-single.html">Family Apartments</a></h4>
                                                    <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> W 85th St, New York, USA </a></div>
                                                    <div class="widget-posts-descr-price"><span>Price: </span> $ 72.400</div>
                                                    <div class="clear-wishlist"><i class="fal fa-trash-alt"></i></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- widget-posts end-->
                                </div>
                                <!-- header-modal-container end--> 										
                                <div class="header-modal-top fl-wrap">
                                    <a class="clear_wishlist color-bg" href="compare.html"><i class="fal fa-random"></i> Compare</a>
                                </div>
                            </div>
                        </div>
                        <!--tab end -->
                    </div>
                    <!--tabs end -->							
                </div>
            </div>
            <!--wishlist-wrap end -->                            
            <!--header-opt-modal-->  
            <div class="header-opt-modal novis_header-mod">
                <div class="header-opt-modal-container hopmc_init">
                    <div class="header-opt-modal-item lang-item fl-wrap">
                        <h4>Language: <span>EN</span></h4>
                        <div class="header-opt-modal-list fl-wrap">
                            <ul>
                                <li><a href="#" class="current-lan" data-lantext="EN">English</a></li>
                                <li><a href="#" data-lantext="FR">Franais</a></li>
                                <li><a href="#" data-lantext="ES">Espaol</a></li>
                                <li><a href="#" data-lantext="DE">Deutsch</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="header-opt-modal-item currency-item fl-wrap">
                        <h4>Currency: <span>USD</span></h4>
                        <div class="header-opt-modal-list fl-wrap">
                            <ul>
                                <li><a href="#" class="current-lan" data-lantext="USD">USD</a></li>
                                <li><a href="#" data-lantext="EUR">EUR</a></li>
                                <li><a href="#" data-lantext="GBP">GBP</a></li>
                                <li><a href="#" data-lantext="RUR">RUR</a></li>
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
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.</p>
                                    <div class="fw_hours fl-wrap">
                                        <span>Monday - Friday:<strong> 8am - 6pm</strong></span>
                                        <span>Saturday - Sunday:<strong> 9am - 3pm</strong></span>
                                    </div>
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
                                        <li><a href="about.html">About Our Company</a></li>
                                        <li><a href="blog.html">Our last News</a></li>
                                        <li><a href="pricing.html">Pricing Plans</a></li>
                                        <li><a href="contacts.html">Contacts</a></li>
                                        <li><a href="help.html">Help Center</a></li>
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
                                    <ul  class="footer-contacts fl-wrap">
                                        <li><span><i class="fal fa-envelope"></i> Mail :</span><a href="#" target="_blank">yourmail@domain.com</a></li>
                                        <li> <span><i class="fal fa-map-marker"></i> Adress :</span><a href="#" target="_blank">USA 27TH Brooklyn NY</a></li>
                                        <li><span><i class="fal fa-phone"></i> Phone :</span><a href="#">+7(111)123456789</a></li>
                                    </ul>
                                    <div class="footer-social fl-wrap">
                                        <ul>
                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-vk"></i></a></li>
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
                                    <p>Start working with Homeradar that can provide everything you need </p>
                                    <div class="api-links fl-wrap">
                                        <a href="#" class="api-btn color-bg"><i class="fab fa-apple"></i> App Store</a>  
                                        <a href="#" class="api-btn color-bg"><i class="fab fa-google-play"></i> Play Market</a>
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
                        <div class="copyright"> &#169; Homeradar 2022 .  All rights reserved.</div>
                        <div class="subfooter-nav">
                            <ul class="no-list-style">
                                <li><a href="#">Terms of use</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Blog</a></li>
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
        <div class="main-register-wrap modal">
            <div class="reg-overlay"></div>
            <div class="main-register-holder tabs-act">
                <div class="main-register-wrapper modal_main fl-wrap">
                    <div class="main-register-header color-bg">
                        <div class="main-register-logo fl-wrap">
                            <img src="<?=site_url();?>assets/images/white-logo.png" alt="">
                        </div>
                        <div class="main-register-bg">
                            <div class="mrb_pin"></div>
                            <div class="mrb_pin mrb_pin2"></div>
                        </div>
                        <div class="mrb_dec"></div>
                        <div class="mrb_dec mrb_dec2"></div>
                    </div>
                    <div class="main-register">
                        <div class="close-reg"><i class="fal fa-times"></i></div>
                        <ul class="tabs-menu fl-wrap no-list-style">
                            <li class="current"><a href="#tab-1"><i class="fal fa-sign-in-alt"></i> Login</a></li>
                            <li><a href="#tab-2"><i class="fal fa-user-plus"></i> Register</a></li>
                        </ul>
                        <!--tabs -->                       
                        <div class="tabs-container">
                            <div class="tab">
                                <!--tab -->
                                <div id="tab-1" class="tab-content first-tab">
                                    <div class="row py-1">
                                        <div class="col-sm-12"><div id="bb_ajax_msg"></div></div>
                                    </div>
                                    <div class="custom-form">

                                        <?php echo form_open_multipart('auth/login', array('id'=>'bb_ajax_form', 'class'=>'')); ?>
                                            <label>Username or Email Address  * <span class="dec-icon"><i class="fal fa-user"></i></span></label>
                                            <input name="email" type="text"  placeholder="Your Name or Mail"  onClick="this.select()" value="">
                                            <div class="pass-input-wrap fl-wrap">
                                                <label >Password  * <span class="dec-icon"><i class="fal fa-key"></i></span></label>
                                                <input name="password" placeholder="Your Password" type="password"  autocomplete="off" onClick="this.select()" value="" >
                                                <span class="eye"><i class="fal fa-eye"></i> </span>
                                            </div>
                                            <div class="lost_password">
                                                <a href="#">Lost Your Password?</a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <button type="submit"  class="log_btn color-bg bb_form_btn"> LogIn </button>
                                        </form>
                                    </div>
                                </div>
                                <!--tab end -->
                                <!--tab -->
                                <div class="tab">
                                    <div id="tab-2" class="tab-content">
                                        <div class="row py-1">
                                            <div class="col-sm-12"><div id="bb_ajax_msg2"></div></div>
                                        </div>
                                        <div class="custom-form">
                                            <?php echo form_open_multipart('auth/register', array('id'=>'bb_ajax_form2', 'class'=>'')); ?>
                                                <label >Full Name  * <span class="dec-icon"><i class="fal fa-user"></i></span></label>
                                                <input name="name" type="text" placeholder="Your Name"   required  onClick="this.select()" value="">
                                                <label>Email Address  * <span class="dec-icon"><i class="fal fa-envelope"></i></span></label>
                                                <input name="email" type="email"  placeholder="Your Mail"   required onClick="this.select()" value="">
                                                <label>Country</label>
                                                <div class="listsearch-input-item mb-2">
                                                    <select data-placeholder="Select" name="country_id" id="country_id" required class="mb-2 chosen-select search-select" onchange="get_state();">
                                                        <option value="">Select</option>
                                                        <?php
                                                            $country = $this->Crud->read_order('country', 'name', 'asc');
                                                            if(!empty($country)){
                                                                foreach($country as $c){
                                                                    echo '<option value="'.$c->id.'">'.$c->name.'</option>';
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <label>State</label>
                                                <div class="listsearch-input-item mb-2" id="states_id">
                                                    <select data-placeholder="Select" name="state_id" id="state_id" required onchange="get_city();" class="mb-2 chosen-select search-select" >
                                                        <option value="">Select Country First</option>
                                                       
                                                    </select>
                                                </div>
                                                <label>City</label>
                                                <div class="listsearch-input-item mb-2" id="citys_id">
                                                    <select data-placeholder="Select" name="city_id" id="city_id" required class="mb-2 chosen-select search-select" >
                                                        <option value="">Select State First</option>
                                                       
                                                    </select>
                                                </div>
                                                <label>Phone Number  * <span class="dec-icon"><i class="fal fa-phone"></i></span></label>
                                                <input name="phone" type="text"  placeholder="Your Phone Number"   required onClick="this.select()" value="">
                                                <div class="pass-input-wrap fl-wrap">
                                                    <label >Password  * <span class="dec-icon"><i class="fal fa-key"></i></span></label>
                                                    <input name="password" type="password" placeholder="Your Password"  autocomplete="off" required  onClick="this.select()" value="" >
                                                    <span class="eye"><i class="fal fa-eye"></i> </span>
                                                </div>
                                                <div class="filter-tags ft-list">
                                                    <input id="check-a2" type="checkbox" name="agree">
                                                    <label for="check-a2">I agree to the <a href="javascript:;">Privacy Policy</a> and <a href="javascript:;">Terms and Conditions</a></label>
                                                </div>
                                                <div class="clearfix"></div>
                                                <button type="submit"     class="log_btn color-bg bb_fom_btn"> Register </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--tab end -->
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--register form end -->
        <!--secondary-nav -->
        <div class="secondary-nav">
            <ul>
                <li><a href="dashboard-add-listing.html" class="tolt" data-microtip-position="left"  data-tooltip="Sell Property"><i class="fal fa-truck-couch"></i> </a></li>
                <li><a href="listing.html" class="tolt" data-microtip-position="left"  data-tooltip="Buy Property"> <i class="fal fa-shopping-bag"></i></a></li>
                <li><a href="compare.html" class="tolt" data-microtip-position="left"  data-tooltip="Your Compare"><i class="fal fa-exchange"></i></a></li>
            </ul>
            <div class="progress-indicator">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="-1 -1 34 34">
                    <circle cx="16" cy="16" r="15.9155"
                        class="progress-bar__background" />
                    <circle cx="16" cy="16" r="15.9155"
                        class="progress-bar__progress 
                        js-progress-bar" />
                </svg>
            </div>
        </div>
        <!--secondary-nav end -->
        <a class="to-top color-bg"><i class="fas fa-caret-up"></i></a>   
        <!--map-modal -->
        <div class="map-modal-wrap">
            <div class="map-modal-wrap-overlay"></div>
            <div class="map-modal-item">
                <div class="map-modal-container fl-wrap">
                    <h3> <span>Listing Title </span></h3>
                    <div class="map-modal-close"><i class="far fa-times"></i></div>
                    <div class="map-modal fl-wrap">
                        <div id="singleMap" data-latitude="40.7" data-longitude="-73.1"></div>
                        <div class="scrollContorl"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--map-modal end --> 			
    </div>
    <!-- Main end -->

    <!--=============== scripts  ===============-->
    <script src="<?=site_url();?>assets/js/jquery.min.js"></script>
    <script src="<?=site_url();?>assets/js/plugins.js"></script>
    <script src="<?=site_url();?>assets/js/scripts.js"></script>
    <script src="<?=site_url();?>assets/js/jsform.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwJSRi0zFjDemECmFl9JtRj1FY7TiTRRo&amp;libraries=places"></script>
    <script src="<?=site_url();?>assets/js/map-single.js"></script>
    <script>var site_url = '<?php echo site_url(); ?>';
        function get_state(){
            var country_id = $('#country_id').val();
            $.ajax({
                url: site_url + 'auth/account/get_state/' + country_id,
                type: 'post',
                success: function (data) {
                    $('#states_id').html(data);
                }
            });
        }

        function get_city(){
            var state_id = $('#state_id').val();
            $.ajax({
                url: site_url + 'auth/account/get_city/' + state_id,
                type: 'post',
                success: function (data) {
                    $('#citys_id').html(data);
                }
            });
        }
    </script>
</body>

</html>