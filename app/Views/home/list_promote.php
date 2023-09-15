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
            $cur = '$';
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
                <div class="col-md-9">
                    <div class="list-single-main-wrapper fl-wrap">
                        <!--  scroll-nav-wrap -->
                        <div class="scroll-nav-wrap">
                            <nav class="scroll-nav scroll-init fixed-column_menu-init">
                                <ul class="no-list-style">
                                    <li><a class="act-scrlink" href="#sec1"><i class="fal fa-home-lg-alt"></i></a><span>Main</span></li>
                                    <li><a  href="#sec2"><i class="fal fa-image"></i></a><span>Gallery</span></li>
                                    <li><a href="#sec3"><i class="fal fa-info"></i> </a><span>About</span></li>
                                    <li><a href="#sec4"><i class="fal fa-address-card"></i> </a><span>Contact Details</span></li>
                                    <li><a href="#sec5"><i class="fal fa-paper-plane"></i> </a><span>Promotion</span></li>
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
                            <div class="list-single-main-item fl-wrap" id="sec5">
                                <div class="list-single-main-item-title">
                                    <h3>Listing Promotion Details</h3>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <!-- pricing-column -->
                                    <?php
                                        $prom = $this->Crud->read2('listing_id', $param2, 'status', '0', 'business_promotion');
                                        if(!empty($prom)){$count = 1;
                                            foreach($prom as $p){
                                                
                                                if($count < 10)$count = '0'.$count;
                                                $p_name = $this->Crud->read_field('id', $p->promotion_id, 'promotion', 'name');
                                                $duration = $this->Crud->read_field('id', $p->promotion_id, 'promotion', 'duration');
                                                $promoter_no = $this->Crud->read_field('id', $p->promotion_id, 'promotion', 'promoter_no');
                                                $view = $this->Crud->read_field('id', $p->promotion_id, 'promotion', 'view');
                                                $p_amount = $p->amount / $promoter_no;
                                                $p_view = $p->no_view / $promoter_no;
                                                $cur = '$';
                                                if($this->Crud->check2('id', $p->listing_id, 'country_id', '161', 'listing') > 0)$cur = '₦';
                                                if(date('Y-m-d') > $p->expiry_date)continue;
                                                $app = json_decode($p->applicant);
                                    ?>
                                            <div class="col-md-6">
                                                <div class="pricing-column fl-wrap">
                                                    <div class="pricing-header">
                                                        <h3><span><?=$count; ?>.</span><?=$p_name; ?></h3>
                                                        <div class="price-num price-item fl-wrap">
                                                            <div class="price-num-item"><span class="mouth-cont"><span class="curen"><?=$cur; ?></span><?=$p_amount; ?></span><span class="year-cont"><span class="curen">$</span></span></div>
                                                            <div class="price-num-desc"><span class="mouth-cont">For  <?=$p_view; ?> Views</span></div>
                                                        </div>
                                                        <p>Promote Business Listing on your Social Platforms and Earn  </p>
                                                    </div>
                                                    <div class="pricing-content fl-wrap">
                                                        <ul class="no-list-style">
                                                            <li>Expires: <?=date('d F Y',strtotime($p->expiry_date)); ?></li>
                                                            <!-- <li class="not-included">90 Days Availability</li>
                                                            <li class="not-included">Non-Featured</li>
                                                            <li class="not-included">Limited Support</li> -->
                                                        </ul>
                                                        <?php
                                                            if(in_array($log_id, $app)){
                                                                echo '
                                                                    <div class="col-sm-12 text-cener">
                                                                        <h6>This is your unique link <br><span id="textToCopy" class="text-danger mt-3 mb-2">'.site_url('home/promotion/'.$log_id.'/'.$p->code).'</span></h6>
                                                                    </div>
                                                                    <div class="col-sm-12 text-center">
                                                                        <button class="btn btn-primary text-uppercase" id="copyButton" onclick="copyTextToClipboard();" type="button">
                                                                           Copy Link
                                                                        </button>
                                                                    </div>
                                                                    ';
                                                            }
                                                        ?>
                                                        <a href="javascript:;" class="btn btn-primary  pops " pageTitle="Promote " pageName="<?=site_url('home/listing/manage/promote/'.$p->id); ?>" pageSize="modal-md"><?php if(in_array($log_id, $app)){
                                                            
                                                            echo 'View Analytics';}else{echo 'Participate';} ?></a>  
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                       $count++;
                                     }
                                    }
                                    ?>
                                </div>
                            </div>                                          
                                                                   
                        </div>
                    </div>
                </div>
                 
                <div class="col-md-3">
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
            <div class="fl-wrap limit-box"></div>
            <!-- <div class="listing-carousel-wrapper carousel-wrap fl-wrap">
                <div class="list-single-main-item-title">
                    <h3>Similar Properties</h3>
                </div>
                <div class="listing-carousel carousel ">
                    
                    <div class="slick-slide-item">
                        
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
                    </div>
                    
                    <div class="slick-slide-item">
                        
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
                    </div>
                    <div class="slick-slide-item">
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
                    </div>
                    <div class="slick-slide-item">
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
                    </div>								
                </div>
                <div class="swiper-button-prev lc-wbtn lc-wbtn_prev"><i class="far fa-angle-left"></i></div>
                <div class="swiper-button-next lc-wbtn lc-wbtn_next"><i class="far fa-angle-right"></i></div>
            </div> -->
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

<script src="<?=site_url();?>assets/js/jsmodal.js"></script>
    <script src="<?=site_url(); ?>assets/js/select2.min.js" ></script>
<?php echo $this->endSection(); ?>