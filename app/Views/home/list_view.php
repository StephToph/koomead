<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>

<?php echo $this->extend('designs/frontend'); ?>
<?php echo $this->section('title'); ?>
    <?php echo $title; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
 <!-- content -->	
 <div class="content">
    <section class="hidden-section   single-hero-section" data-scrollax-parent="true" id="sec1">
        <?php 
            $name = $this->Crud->read_field('id', $param2, 'listing', 'name');
            $user_id = $this->Crud->read_field('id', $param2, 'listing', 'user_id');
            $category_id = $this->Crud->read_field('id', $param2, 'listing', 'category_id');
            $state_id = $this->Crud->read_field('id', $param2, 'listing', 'state_id');
            $country_id = $this->Crud->read_field('id', $param2, 'listing', 'country_id');
            $city_id = $this->Crud->read_field('id', $param2, 'listing', 'city_id');
            $price = $this->Crud->read_field('id', $param2, 'listing', 'price');
            $active = $this->Crud->read_field('id', $param2, 'listing', 'active');
            $negotiable = $this->Crud->read_field('id', $param2, 'listing', 'negotiable');
            $price_status = $this->Crud->read_field('id', $param2, 'listing', 'price_status');
            $description = $this->Crud->read_field('id', $param2, 'listing', 'description');
            $images = $this->Crud->read_field('id', $param2, 'listing', 'images');
            $reg_date = $this->Crud->read_field('id', $param2, 'listing', 'reg_date');
            
            $user = $this->Crud->read_field('id', $user_id, 'user', 'fullname');
            $user_mail = $this->Crud->read_field('id', $user_id, 'user', 'email');
            $user_phone = $this->Crud->read_field('id', $user_id, 'user', 'phone');
            $user_img = $this->Crud->read_field('id', $user_id, 'user', 'img_id');
            if(empty($user_img))$user_img = 'assets/images/avatar.png';
            $category = $this->Crud->read_field('id', $category_id, 'category', 'name');
            $main_id = $this->Crud->read_field('id', $category_id, 'category', 'category_id');
            $mains = $this->Crud->read_field('id', $main_id, 'category', 'name');
            
            $country = $this->Crud->read_field('id', $country_id, 'country', 'name');
            $state = $this->Crud->read_field('id', $state_id, 'state', 'name');
            $city = $this->Crud->read_field('id', $city_id, 'city', 'name');
            
            $loca = '';
            $image = json_decode($images);

            if($negotiable == 0)$negotiate = 'No'; else $negotiate = 'Yes';
            if($active == 0)$active = 'Disabled'; else $active = 'Active';
            
            if(!empty($city_id)) $loca .= $city;
            if(!empty($state_id)) $loca .= ', '.$state;
            if(!empty($country_id)) $loca .= ', '.$country;
            $main_img = $image[0];

        ?>
        <div class="bg-wrap bg-parallax-wrap-gradien">
            <div class="bg par-elem "  data-bg="<?=site_url($main_img); ?>" data-scrollax="properties: { translateY: '30%' }"></div>
        </div>
        <div class="container">
            <!--  list-single-opt_header-->
            <div class="list-single-opt_header fl-wrap">
                <ul class="list-single-opt_header_cat">
                    <li><a href="#" class="cat-opt color-bg"><?=$category; ?></a></li>
                    <li><a href="#" class="cat-opt blue-bg"><?=$mains; ?></a></li>
                </ul>
            </div>
            <!--  list-single-opt_header end -->
            <!--  list-single-header-item-->
            <div class="list-single-header-item no-bg-list_sh fl-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <h1><?=ucwords($name);?> <span class="verified-badge tolt" data-microtip-position="bottom"  data-tooltip="Verified"><i class="fas fa-check"></i></span></h1>
                        <div class="geodir-category-location fl-wrap">
                            <a href="#"><i class="fas fa-map-marker-alt"></i>  <?=$loca;?></a> 
                            <div class="listing-rating card-popup-rainingvis" data-starrating2="0"><span class="re_stars-title">Not Rated</span></div>
                        </div>
                        <div class="share-holder hid-share">
                            <a href="#" class="share-btn showshare sfcs">  <i class="fas fa-share-alt"></i>  Share   </a>
                            <div class="share-container  isShare"></div>
                        </div>
                    </div>
                </div>
                <div class="list-single-header-footer fl-wrap">
                    <div class="list-single-header-price" data-propertyprise="50500"><strong>Price:</strong><span>$</span><?=number_format($price);?></div>
                    <div class="list-single-header-date"><span>Date:</span><?=date('d.m.Y', strtotime($reg_date));?></div>
                    <div class="list-single-stats">
                        <ul class="no-list-style">
                            <li><span class="viewed-counter"><i class="fas fa-eye"></i> Viewed -  0 </span></li>
                            <li><span class="bookmark-counter"><i class="fas fa-heart"></i> Bookmark -  0 </span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="breadcrumbs fw-breadcrumbs smpar fl-wrap">
        <div class="container">
            <div class="breadcrumbs-list">
                <a href="<?=site_url(); ?>">Home</a><a href="javascript:;"><?=$mains; ?></a><a href="javascript:;"><?=$category; ?></a><span><?=ucwords($name); ?></span>
            </div>
            
            <a href="javascript:;" class="like-btn tolt" data-microtip-position="bottom"  data-tooltip="Report" > <i class="fas fa-exclamation-triangle"></i> Report </a>
            
            <a href="#sec15" class="like-btn"> <i class="fas fa-comment-alt"></i> Write a review</a>
            <div class="like-btn"><i class="fas fa-heart"></i> Save</div>
        </div>
    </div>
    <div class="gray-bg small-padding fl-wrap">
        <div class="container">
            <div class="row">
                <!--  listing-single content -->
                <div class="col-md-8">
                    <div class="list-single-main-wrapper fl-wrap">
                        <!--  scroll-nav-wrap -->
                        <div class="scroll-nav-wrap">
                            <nav class="scroll-nav scroll-init fixed-column_menu-init">
                                <ul class="no-list-style">
                                    <li><a class="act-scrlink" href="#sec1"><i class="fal fa-home-lg-alt"></i></a><span>Main</span></li>
                                    <li><a  href="#sec2"><i class="fal fa-image"></i></a><span>Gallery</span></li>
                                    <li><a href="#sec3"><i class="fal fa-info"></i> </a><span>Details</span></li>
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
                            </nav>
                        </div>
                        <!--  scroll-nav-wrap end-->
                        <div class="list-single-main-media fl-wrap" id="sec2">
                            <!-- gallery-items   -->
                            <div class="gallery-items grid-small-pad  list-single-gallery three-coulms lightgallery">
                                <!-- 1 -->
                                <?php if(!empty($images)){ foreach($image as $key => $value){ ?>
                                    <div class="gallery-item ">
                                        <div class="grid-item-holder">
                                            <div class="box-item">
                                                <img  src="<?=site_url($value); ?>"   alt="" style="height:180px">
                                                <a href="<?=site_url($value); ?>" class="gal-link popup-image"><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php }}?>
                                
                            </div>
                            <!-- end gallery items -->                                            
                        </div>
                        
                        <div class="list-single-main-container fl-wrap" id="sec3">
                            <!-- list-single-main-item -->
                            <div class="list-single-main-item fl-wrap">
                                <div class="list-single-main-item-title">
                                    <h3>About This Listing</h3>
                                </div>
                                <div class="list-single-main-item_content fl-wrap">
                                    <p><?=ucwords($description);?></p>
                                </div>
                            </div>
                                                                       
                            <!-- list-single-main-item -->
                            <!-- <div class="list-single-main-item fl-wrap" id="sec7">
                                <div class="list-single-main-item-title">
                                    <h3>Reviews <span>2</span></h3>
                                </div>
                                <div class="list-single-main-item_content fl-wrap">
                                    <div class="reviews-comments-wrap fl-wrap">
                                        <div class="review-total">
                                            <span class="review-number blue-bg">4.0</span>
                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="4"><span class="re_stars-title">Good</span></div>
                                        </div>
                                         
                                        <div class="reviews-comments-item">
                                            <div class="review-comments-avatar">
                                                <img src="<?=site_url(); ?>assets/images/avatar/2.jpg" alt=""> 
                                            </div>
                                            <div class="reviews-comments-item-text smpar">
                                                <div class="box-widget-menu-btn smact"><i class="far fa-ellipsis-h"></i></div>
                                                <div class="show-more-snopt-tooltip bxwt">
                                                    <a href="#"> <i class="fas fa-reply"></i> Reply</a>
                                                    <a href="#"> <i class="fas fa-exclamation-triangle"></i> Report </a>
                                                </div>
                                                <h4><a href="#">Liza Rose</a></h4>
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="3"><span class="re_stars-title">Average</span></div>
                                                <div class="clearfix"></div>
                                                <p>" Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. "</p>
                                                <div class="reviews-comments-item-date"><span class="reviews-comments-item-date-item"><i class="far fa-calendar-check"></i>12 April 2018</span><a href="#" class="rate-review"><i class="fal fa-thumbs-up"></i>  Helpful Review  <span>6</span> </a></div>
                                            </div>
                                        </div>
                                          
                                        <div class="reviews-comments-item">
                                            <div class="review-comments-avatar">
                                                <img src="<?=site_url(); ?>assets/images/avatar/3.jpg" alt=""> 
                                            </div>
                                            <div class="reviews-comments-item-text smpar">
                                                <div class="box-widget-menu-btn smact"><i class="far fa-ellipsis-h"></i></div>
                                                <div class="show-more-snopt-tooltip bxwt">
                                                    <a href="#"> <i class="fas fa-reply"></i> Reply</a>
                                                    <a href="#"> <i class="fas fa-exclamation-triangle"></i> Report </a>
                                                </div>
                                                <h4><a href="#">Adam Koncy</a></h4>
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><span class="re_stars-title">Excellent</span></div>
                                                <div class="clearfix"></div>
                                                <p>" Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus. Cras metus neque, gravida sodales massa ut. "</p>
                                                <div class="reviews-comments-item-date"><span class="reviews-comments-item-date-item"><i class="far fa-calendar-check"></i>03 December 2017</span><a href="#" class="rate-review"><i class="fal fa-thumbs-up"></i>  Helpful Review  <span>2</span> </a></div>
                                            </div>
                                        </div>                                                              
                                    </div>
                                </div>
                            </div> 
                            <div class="list-single-main-item fl-wrap" id="sec15">
                                <div class="list-single-main-item-title fl-wrap">
                                    <h3>Add Your Review</h3>
                                </div>
                                
                                <div id="add-review" class="add-review-box">
                                    <div class="leave-rating-wrap">
                                        <span class="leave-rating-title">Your rating  for this listing : </span>
                                        <div class="leave-rating">
                                            <input type="radio"    data-ratingtext="Excellent"   name="rating" id="rating-1" value="1"/>
                                            <label for="rating-1" class="fal fa-star"></label>
                                            <input type="radio" data-ratingtext="Good" name="rating" id="rating-2" value="2"/>
                                            <label for="rating-2" class="fal fa-star"></label>
                                            <input type="radio" name="rating"  data-ratingtext="Average" id="rating-3" value="3"/>
                                            <label for="rating-3" class="fal fa-star"></label>
                                            <input type="radio" data-ratingtext="Fair" name="rating" id="rating-4" value="4"/>
                                            <label for="rating-4" class="fal fa-star"></label>
                                            <input type="radio" data-ratingtext="Very Bad "   name="rating" id="rating-5" value="5"/>
                                            <label for="rating-5"    class="fal fa-star"></label>
                                        </div>
                                        <div class="count-radio-wrapper">
                                            <span id="count-checked-radio">Your Rating</span>  
                                        </div>
                                    </div>
                                    
                                    <form   class="add-comment custom-form">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Your name* <span class="dec-icon"><i class="fas fa-user"></i></span></label>
                                                    <input   name="phone" type="text"    onClick="this.select()" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Yourmail* <span class="dec-icon"><i class="fas fa-envelope"></i></span></label>
                                                    <input   name="reviewwname" type="text"    onClick="this.select()" value="">
                                                </div>
                                            </div>
                                            <textarea cols="40" rows="3" placeholder="Your Review:"></textarea>
                                        </fieldset>
                                        <button class="btn big-btn color-bg float-btn">Submit Review <i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </div> -->                                         
                        </div>
                    </div>
                </div>
                 
                <div class="col-md-4">
                    <!--box-widget-->
                    <div class="box-widget fl-wrap">
                        <div class="profile-widget">
                            <div class="profile-widget-header color-bg smpar fl-wrap">
                                <div class="pwh_bg"></div>
                                <div class="profile-widget-card">
                                    <div class="profile-widget-image">
                                        <img src="<?=site_url($user_img); ?>" alt="">
                                    </div>
                                    <div class="profile-widget-header-title">
                                        <h4><a href="javascript:;"><?=ucwords($user); ?></a></h4>
                                        <div class="clearfix"></div>
                                        <div class="pwh_counter"><span><?=$this->Crud->check('user_id', $user_id, 'listing'); ?></span> Listings</div>
                                        <div class="clearfix"></div>
                                        <div class="listing-rating card-popup-rainingvis" data-starrating2="0"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-content fl-wrap">
                                <div class="contats-list fl-wrap">
                                    <ul class="no-list-style">
                                        <li><span><i class="fal fa-phone"></i> Phone :</span> <a href="javascript:;"><?=$user_phone; ?></a></li>
                                        <li><span><i class="fal fa-envelope"></i> Mail :</span> <a href="javascript:;"><?=$user_mail; ?></a></li>
                                    </ul>
                                </div>
                                <div class="profile-widget-footer fl-wrap">
                                    <a href="javascript:;" class="btn float-btn color-bg small-btn">View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--box-widget end -->
                    <!--box-widget-->
                    <!-- <div class="box-widget fl-wrap">
                        <div class="box-widget-title fl-wrap">Featured Properties</div>
                        <div class="box-widget-content fl-wrap">
                            <div class="widget-posts  fl-wrap">
                                <ul class="no-list-style">
                                    <li>
                                        <div class="widget-posts-img"><a href="listing-single.html"><img src="<?=site_url(); ?>assets/images/all/small/1.jpg" alt=""></a>  
                                        </div>
                                        <div class="widget-posts-descr">
                                            <h4><a href="listing-single.html">Affordable Urban Room</a></h4>
                                            <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> 40 Journal Square  , NJ, USA</a></div>
                                            <div class="widget-posts-descr-price"><span>Price: </span> $ 1500 / per month</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="widget-posts-img"><a href="listing-single.html"><img src="<?=site_url(); ?>assets/images/all/small/2.jpg" alt=""></a>
                                        </div>
                                        <div class="widget-posts-descr">
                                            <h4><a href="listing-single.html">Family House</a></h4>
                                            <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> 70 Bright St New York, USA </a></div>
                                            <div class="widget-posts-descr-price"><span>Price: </span> $ 50000</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="widget-posts-img"><a href="listing-single.html"><img src="<?=site_url(); ?>assets/images/all/small/3.jpg" alt=""></a>
                                        </div>
                                        <div class="widget-posts-descr">
                                            <h4><a href="listing-single.html">Apartment to Rent</a></h4>
                                            <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i>75 Prince St, NY, USA</a></div>
                                            <div class="widget-posts-descr-price"><span>Price: </span> $100 / per night</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="widget-posts-img"><a href="listing-single.html"><img src="<?=site_url(); ?>assets/images/all/small/3.jpg" alt=""></a>
                                        </div>
                                        <div class="widget-posts-descr">
                                            <h4><a href="listing-single.html">Apartment to Rent</a></h4>
                                            <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i>75 Prince St, NY, USA</a></div>
                                            <div class="widget-posts-descr-price"><span>Price: </span> $100 / per night</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>                                                        
                            <a href="listing.html" class="btn float-btn color-bg small-btn">View All Properties</a>
                        </div>
                    </div> -->
                    
                    <div class="box-widget fl-wrap">
                        <div class="box-widget-fixed-init fl-wrap" id="sec-contact">
                            <div class="box-widget-title fl-wrap box-widget-title-color color-bg">Contact Property</div>
                            <div class="box-widget-content fl-wrap">
                                <div class="custom-form">
                                    <form method="post"  name="contact-property-form">
                                        <label>Your name* <span class="dec-icon"><i class="fas fa-user"></i></span></label>
                                        <input   name="phone" type="text"    onClick="this.select()" value="">
                                        <label>Your phone  * <span class="dec-icon"><i class="fas fa-phone"></i></span></label>
                                        <input   name="phone" type="text"    onClick="this.select()" value="">      
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Date   <span class="dec-icon"><i class="fas fa-calendar-check"></i></span></label>
                                                <div class="date-container fl-wrap">
                                                    <input type="text" placeholder="" style="padding: 16px 5px 16px 60px;"     name="datepicker-here"   value=""/>                                                 
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Time  </label>
                                                <select data-placeholder="9 AM" class="chosen-select on-radius no-search-select" >
                                                    <option>9 AM</option>
                                                    <option>10 AM</option>
                                                    <option>11 AM</option>
                                                    <option>12 AM</option>
                                                    <option>13 PM</option>
                                                    <option>14 PM</option>
                                                    <option>15 PM</option>
                                                    <option>16 PM</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn float-btn color-bg fw-btn"> Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--box-widget end -->                                   
                </div>
                <!--  sidebar end-->                            
            </div>
            <div class="fl-wrap limit-box"></div>
            <div class="listing-carousel-wrapper carousel-wrap fl-wrap">
                <div class="list-single-main-item-title">
                    <h3>Similar Properties</h3>
                </div>
                <div class="listing-carousel carousel ">
                    <!-- slick-slide-item -->
                    <div class="slick-slide-item">
                        <!-- listing-item -->
                        <div class="listing-item">
                            <article class="geodir-category-listing fl-wrap">
                                <div class="geodir-category-img fl-wrap">
                                    <a href="listing-single.html" class="geodir-category-img_item">
                                        <img src="<?=site_url(); ?>assets/images/all/3.jpg" alt="">
                                        <div class="overlay"></div>
                                    </a>
                                    <div class="geodir-category-location">
                                        <a href="#4" class="map-item"><i class="fas fa-map-marker-alt"></i>  70 Bright St New York, USA</a>
                                    </div>
                                    <ul class="list-single-opt_header_cat">
                                        <li><a href="#" class="cat-opt blue-bg">Sale</a></li>
                                        <li><a href="#" class="cat-opt color-bg">Apartment</a></li>
                                    </ul>
                                    <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                    <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                    <div class="geodir-category-listing_media-list">
                                        <span><i class="fas fa-camera"></i> 8</span>
                                    </div>
                                </div>
                                <div class="geodir-category-content fl-wrap">
                                    <h3><a href="listing-single.html">Gorgeous house for sale</a></h3>
                                    <div class="geodir-category-content_price">$ 600,000</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                    <div class="geodir-category-content-details">
                                        <ul>
                                            <li><i class="fal fa-bed"></i><span>3</span></li>
                                            <li><i class="fal fa-bath"></i><span>2</span></li>
                                            <li><i class="fal fa-cube"></i><span>450 ft2</span></li>
                                        </ul>
                                    </div>
                                    <div class="geodir-category-footer fl-wrap">
                                        <a href="agent-single.html" class="gcf-company"><img src="<?=site_url(); ?>assets/images/avatar/2.jpg" alt=""><span>By Liza Rose</span></a>
                                        <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Good" data-starrating2="4"></div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- listing-item end-->							
                    </div>
                    <!-- slick-slide-item end-->
                    <!-- slick-slide-item -->
                    <div class="slick-slide-item">
                        <!-- listing-item -->
                        <div class="listing-item">
                            <article class="geodir-category-listing fl-wrap">
                                <div class="geodir-category-img fl-wrap">
                                    <a href="listing-single.html" class="geodir-category-img_item">
                                        <img src="<?=site_url(); ?>assets/images/all/1.jpg" alt="">
                                        <div class="overlay"></div>
                                    </a>
                                    <div class="geodir-category-location">
                                        <a href="#4" class="map-item"><i class="fas fa-map-marker-alt"></i>   40 Journal Square  , NJ, USA</a>
                                    </div>
                                    <ul class="list-single-opt_header_cat">
                                        <li><a href="#" class="cat-opt blue-bg">Sale</a></li>
                                        <li><a href="#" class="cat-opt color-bg">Apartment</a></li>
                                    </ul>
                                    <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                    <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                    <div class="geodir-category-listing_media-list">
                                        <span><i class="fas fa-camera"></i> 47</span>
                                    </div>
                                </div>
                                <div class="geodir-category-content fl-wrap">
                                    <h3><a href="listing-single.html">Luxury Family Home</a></h3>
                                    <div class="geodir-category-content_price">$ 300,000</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                    <div class="geodir-category-content-details">
                                        <ul>
                                            <li><i class="fal fa-bed"></i><span>4</span></li>
                                            <li><i class="fal fa-bath"></i><span>2</span></li>
                                            <li><i class="fal fa-cube"></i><span>460 ft2</span></li>
                                        </ul>
                                    </div>
                                    <div class="geodir-category-footer fl-wrap">
                                        <a href="agent-single.html" class="gcf-company"><img src="<?=site_url(); ?>assets/images/avatar/1.jpg" alt=""><span>By Anna Lips</span></a>
                                        <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Excellent" data-starrating2="5"></div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- listing-item end-->							
                    </div>
                    <!-- slick-slide-item end-->									
                    <!-- slick-slide-item -->
                    <div class="slick-slide-item">
                        <!-- listing-item -->
                        <div class="listing-item">
                            <article class="geodir-category-listing fl-wrap">
                                <div class="geodir-category-img fl-wrap">
                                    <a href="listing-single.html" class="geodir-category-img_item">
                                        <img src="<?=site_url(); ?>assets/images/all/9.jpg" alt="">
                                        <div class="overlay"></div>
                                    </a>
                                    <div class="geodir-category-location">
                                        <a href="#4" class="map-item"><i class="fas fa-map-marker-alt"></i> 34-42 Montgomery St , NY, USA</a>
                                    </div>
                                    <ul class="list-single-opt_header_cat">
                                        <li><a href="#" class="cat-opt blue-bg">Sale</a></li>
                                        <li><a href="#" class="cat-opt color-bg">Apartment</a></li>
                                    </ul>
                                    <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                    <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                    <div class="geodir-category-listing_media-list">
                                        <span><i class="fas fa-camera"></i> 4</span>
                                    </div>
                                </div>
                                <div class="geodir-category-content fl-wrap">
                                    <h3><a href="listing-single.html">Gorgeous house for sale</a></h3>
                                    <div class="geodir-category-content_price">$ 120,000</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                    <div class="geodir-category-content-details">
                                        <ul>
                                            <li><i class="fal fa-bed"></i><span>2</span></li>
                                            <li><i class="fal fa-bath"></i><span>1</span></li>
                                            <li><i class="fal fa-cube"></i><span>220 ft2</span></li>
                                        </ul>
                                    </div>
                                    <div class="geodir-category-footer fl-wrap">
                                        <a href="agent-single.html" class="gcf-company"><img src="<?=site_url(); ?>assets/images/avatar/3.jpg" alt=""><span>By Mark Frosty</span></a>
                                        <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Good" data-starrating2="4"></div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- listing-item end-->							
                    </div>
                    <!-- slick-slide-item end-->									
                    <!-- slick-slide-item -->
                    <div class="slick-slide-item">
                        <!-- listing-item -->
                        <div class="listing-item">
                            <article class="geodir-category-listing fl-wrap">
                                <div class="geodir-category-img fl-wrap">
                                    <a href="listing-single.html" class="geodir-category-img_item">
                                        <img src="<?=site_url(); ?>assets/images/all/6.jpg" alt="">
                                        <div class="overlay"></div>
                                    </a>
                                    <div class="geodir-category-location">
                                        <a href="#4" class="map-item"><i class="fas fa-map-marker-alt"></i>  W 85th St, New York, USA </a>
                                    </div>
                                    <ul class="list-single-opt_header_cat">
                                        <li><a href="#" class="cat-opt blue-bg">Sale</a></li>
                                        <li><a href="#" class="cat-opt color-bg">Apartment</a></li>
                                    </ul>
                                    <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                    <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                    <div class="geodir-category-listing_media-list">
                                        <span><i class="fas fa-camera"></i> 13</span>
                                    </div>
                                </div>
                                <div class="geodir-category-content fl-wrap">
                                    <h3><a href="listing-single.html">Contemporary Apartment</a></h3>
                                    <div class="geodir-category-content_price">$ 1,600,000</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                    <div class="geodir-category-content-details">
                                        <ul>
                                            <li><i class="fal fa-bed"></i><span>4</span></li>
                                            <li><i class="fal fa-bath"></i><span>1</span></li>
                                            <li><i class="fal fa-cube"></i><span>550 ft2</span></li>
                                        </ul>
                                    </div>
                                    <div class="geodir-category-footer fl-wrap">
                                        <a href="agent-single.html" class="gcf-company"><img src="<?=site_url(); ?>assets/images/avatar/4.jpg" alt=""><span>By Bill Trust</span></a>
                                        <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Excellent
                                            " data-starrating2="5"></div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- listing-item end-->							
                    </div>
                    <!-- slick-slide-item end-->								
                </div>
                <div class="swiper-button-prev lc-wbtn lc-wbtn_prev"><i class="far fa-angle-left"></i></div>
                <div class="swiper-button-next lc-wbtn lc-wbtn_next"><i class="far fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
                <!-- content end -->	
<!-- content end -->	
<!-- subscribe-wrap -->	
<div class="subscribe-wrap fl-wrap">
    <div class="container">
        <div class="subscribe-container fl-wrap color-bg">
            <div class="pwh_bg"></div>
            <div class="mrb_dec mrb_dec3"></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="subscribe-header">
                        <h4>newsletter</h4>
                        <h3>Sign up for newsletter and get latest news and update</h3>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="footer-widget fl-wrap">
                        <div class="subscribe-widget fl-wrap">
                            <div class="subcribe-form">
                                <form id="subscribe">
                                    <input class="enteremail fl-wrap" name="email" id="subscribe-email" placeholder="Enter Your Email" spellcheck="false" type="text">
                                    <button type="submit" id="subscribe-button" class="subscribe-button color-bg">  Subscribe</button>
                                    <label for="subscribe-email" class="subscribe-message"></label>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="country_id" value="">
<!-- subscribe-wrap end -->	 
<script src="<?php echo site_url(); ?>/assets/js/jquery.min.js"></script>
<script>var site_url = '<?php echo site_url(); ?>';</script>
   
<script>
    $(function() {
        load('', '');
    });

    

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
            url: site_url + 'home/listing/load' + methods,
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
            },
            complete: function () {
                $.getScript(site_url + 'assets/js/jsmodal.js');
            }
        });
    }

    function get_country(country){
        if(country !== ''){
            $.ajax({
                url: site_url + 'home/listing/get_country',
                type: 'post',
                data: {country: country },
                success: function (data) {
                    $('#country_id').val(data);
                    load();
                }
            });
        }
    }
    fetch("http://ip-api.com/json/")
    .then(response => response.json())
    .then(data => {
        const country = data.country;
        console.log(country);
        // Use the country information as needed.
        get_country(country);
    })
    .catch(error => {
        console.error("Error fetching IP information:", error);
    });
    
</script>
<?php echo $this->endSection(); ?>