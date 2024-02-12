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
            $address = $this->Crud->read_field('id', $param2, 'listing', 'address');
            $email = $this->Crud->read_field('id', $param2, 'listing', 'email');
            $phone = $this->Crud->read_field('id', $param2, 'listing', 'phone');
            $profile = json_decode($this->Crud->read_field('id', $param2, 'listing', 'profile'));
            $price = $this->Crud->read_field('id', $param2, 'listing', 'price');
            $active = $this->Crud->read_field('id', $param2, 'listing', 'active');
            $negotiable = $this->Crud->read_field('id', $param2, 'listing', 'negotiable');
            $price_status = $this->Crud->read_field('id', $param2, 'listing', 'price_status');
            $description = $this->Crud->read_field('id', $param2, 'listing', 'description');
            $images = $this->Crud->read_field('id', $param2, 'listing', 'images');
            $reg_date = $this->Crud->read_field('id', $param2, 'listing', 'reg_date');
            $uri = 'home/listing/view/'.$param2;
			$view = $this->Crud->check('page', $uri, 'listing_view');
						
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
            
            if(!empty($address)) $loca .= $address.', ';
            if(!empty($city_id)) $loca .= $city;
            if(!empty($state_id)) $loca .= ', '.$state;
            if(!empty($country_id)) $loca .= ', '.$country;
            $main_img = $image[0];
            $cur = '£';
            if($country_id == '161')$cur = '&#8358;';

            $prices = '<span>'.$cur.'</span>'.number_format($price,2);
            if($price_status == 1)$prices = 'Contact for Price';
        ?>
        <div class="bg-wrap bg-parallax-wrap-gradien">
            <div class="bg par-elem "  data-bg="<?=site_url($main_img); ?>" data-scrollax="properties: { translateY: '30%' }"></div>
        </div>
        <div class="container">
            <!--  list-single-opt_header-->
            <div class="list-single-opt_header fl-wrap">
                <ul class="list-single-opt_header_cat">
                    <li><a href="#" class="cat-opt color-bg mb-3"><?=$category; ?></a></li>
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
                            
                        </div>
                        <div class="share-holder hid-share mb-5">
                            <a href="#" class="share-btn showshare sfcs">  <i class="fas fa-share-alt"></i>  Share   </a>
                            <div class="share-container  isShare"></div>
                        </div>
                    </div>
                </div>
                <div class="list-single-header-footer fl-wrap">
                    <div class="list-single-header-price text-white" data-propertyprise="50500"><strong>Price:</strong><?=$prices;?></div>
                    <div class="list-single-header-date"><span>Date:</span><?=date('d.m.Y', strtotime($reg_date));?></div>
                    <div class="list-single-stats">
                        <ul class="no-list-style">
                            <li><span class="viewed-counter"><i class="fas fa-eye"></i> Viewed -   <?=$view;?></span></li>
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
                                    <li><a href="#sec3"><i class="fal fa-info"></i> </a><span>About</span></li>
                                    <li><a href="#sec4"><i class="fal fa-address-card"></i> </a><span>Contact Details</span></li>
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
                            <div class="list-single-main-item fl-wrap" id="sec4">
                                <div class="list-single-main-item-title">
                                    <h3>Contact Details</h3>
                                </div>
                                <div class="list-single-main-item_content fl-wrap">
                                    <div class="details-list">
                                        <ul>
                                            <?php if(!empty($email)){?><li><span>Business Email:</span><?=$email; ?></li><?php } ?>
                                            <?php if(!empty($email)){?><li><span>Business Phone:</span><?=$phone; ?></li><?php } ?>
                                            <?php if(!empty($profile) && !empty($profile->website)){?><li style="width:100% !important;"><span>Business Website:</span><?=$profile->website; ?></li><?php } ?>
                                            <?php if(!empty($profile) && !empty($profile->facebook)){?><li style="width:100% !important;"><span>Business Facebook:</span><?=$profile->facebook; ?></li><?php } ?>
                                            <?php if(!empty($profile) && !empty($profile->whatsapp)){?><li style="width:100% !important;"><span>Business Whatsapp:</span><?=$profile->whatsapp; ?></li><?php } ?>
                                            <?php if(!empty($profile) && !empty($profile->instagram)){?><li style="width:100% !important;"><span>Business Instagram:</span><?=$profile->instagram; ?></li><?php } ?>
                                            <?php if(!empty($profile) && !empty($profile->twitter)){?><li style="width:100% !important;"><span>Business Twitter:</span><?=$profile->twitter; ?></li><?php } ?>
                                        </ul>
                                    </div>
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
                                    <a href="<?=site_url('home/profile/'.$user_id); ?>" class="btn float-btn color-bg small-btn">View Profile</a>
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
                            <div class="box-widget-title fl-wrap box-widget-title-color color-bg">Message Advertiser</div>
                            <div class="box-widget-content fl-wrap">
                                <div class="custom-form">
                                    
                                    <?php echo form_open_multipart('home/listing/message', array('id'=>'bb_ajax_form', 'class'=>'text-start customform')); ?>
                                        <input type="hidden" name="listing_id" value="<?=$param2;?>"> 
                                        <input type="hidden" name="business_id" value="<?=$user_id;?>"> 
                                        <label>Type a Message* </label>
                                        <div class="listsearch-input-item">
                                            <textarea cols="40" rows="3" id="message" name="message" style="height: 135px" placeholder="Messsage" spellcheck="true" required></textarea>
                                        </div>
                                        <?php
                                            // echo $log_id;
                                            if(empty($log_id)){
                                                echo '<button type="submit" class="btn float-btn show-reg-form modal-open color-bg fw-btn"> Send</button>';
                                            } else {
                                                echo '<button type="submit" class="btn float-btn color-bg fw-btn"> Send</button>';
                                            }
                                            ?>
                                        
                                    </form>
                                    <div class="row">
                                        <div class="col-sm-12 py-2"><div id="bb_ajax_msg"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--box-widget end -->                                   
                </div>
                <!--  sidebar end-->                            
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
<input type="hidden" id="promo_code" value="<?=$promo_code; ?>">
<input type="hidden" id="business_id" value="<?=$business_id; ?>">
<span id="load_data"></span>
<input type="hidden" id="country_id" value="">
<!-- subscribe-wrap end -->	 
<script src="<?php echo site_url(); ?>/assets/js/jquery.min.js"></script>
<script>var site_url = '<?php echo site_url(); ?>';</script>
   
<script>
    $(function() {
        load();
    });
    function load() {
        
        var promo_code = $('#promo_code').val();
        var business_id = $('#business_id').val();
       
        $.ajax({
            url: site_url + 'home/promotion/promo_check',
            type: 'post',
            data: { promo_code: promo_code,business_id: business_id},
            success: function (data) {
                
                    $('#load_data').html(data);
            }
        });
    }
</script>
<?php echo $this->endSection(); ?>