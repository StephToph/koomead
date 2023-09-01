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
    <!--  section  -->
    <section class="hero-section hero-section_dec" data-scrollax-parent="true">
        <div class="bg-wrap">
            <div class="bg par-elem "  data-bg="<?=site_url();?>assets/images/bg1.jpg" data-scrollax="Businesses: { translateY: '30%' }"></div>
        </div>
        <div class="overlay"></div>
        <div class="container">
            <div class="hero-title hero-title_small">
                <h2>Find Businesses in your Locale
                </h2>
            </div>
            <div class="main-search-input-wrap">
                <div class="main-search-input fl-wrap">
                    <div class="main-search-input-item">
                        <input type="text" placeholder="What are you looking for?" value=""/>
                    </div>
                    <div class="main-search-input-item">
                        <select data-placeholder="Select" name="category_ids" id="category_ids" required class="mb-2 chosen-select">
                            <option value="">All Categories</option>
                            <?php
                                $country = $this->Crud->read_order('category', 'name', 'asc');
                                if(!empty($country)){
                                    foreach($country as $c){
                                        echo '<option value="'.$c->id.'">'.$c->name.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="main-search-input-item">
                        <select data-placeholder="Select" name="state_id" id="state_id" required class="mb-2 chosen-select" >
                                <option value="">All State</option>
                                <?php
                                    $country = $this->Crud->read_single_order('country_id', 161, 'state', 'name', 'asc');
                                    if(!empty($country)){
                                        foreach($country as $c){
                                            echo '<option value="'.$c->id.'">'.$c->name.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </select>
                    </div>
                    <button class="main-search-button color-bg" onclick="window.location.href='<?=site_url(); ?>'">  Search <i class="far fa-search"></i> </button>
                </div>
            </div>
            <div class="scroll-down-wrap">
                <div class="mousey">
                    <div class="scroller"></div>
                </div>
                <span>Scroll Down To Discover</span>
            </div>
        </div>
    </section>
    <!--  section  end-->
    <!-- breadcrumbs-->
    
    <!-- breadcrumbs end -->
    <!-- section -->
    <!-- <section class="gray-bg small-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="section-title fl-wrap">
                        <h4>Browse Hot Offers</h4>
                        <h2>Latest Businesses</h2>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="listing-filters gallery-filters">
                        <a href="#" class="gallery-filter  gallery-filter-active" data-filter="*"> <span>All Categories</span></a>
                        <a href="#" class="gallery-filter" data-filter=".for_sale"> <span>For Sale</span></a>
                        <a href="#" class="gallery-filter" data-filter=".for_rent"> <span>For Rent</span></a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="grid-item-holder gallery-items gisp fl-wrap">
                gallery-item
                <div class="gallery-item for_sale">
                    listing-item
                    <div class="listing-item">
                        <article class="geodir-category-listing fl-wrap">
                            <div class="geodir-category-img fl-wrap">
                                <a href="listing-single.html" class="geodir-category-img_item">
                                    <img src="<?=site_url();?>assets/images/all/3.jpg" alt="">
                                    <div class="overlay"></div>
                                </a>
                                <div class="geodir-category-location">
                                    <a href="#" class="single-map-item tolt" data-newlatitude="40.72956781" data-newlongitude="-73.99726866"   data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i> <span>  70 Bright St New York, USA</span></a>
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
                                <h3 class="title-sin_item"><a href="listing-single.html">Gorgeous House For Sale</a></h3>
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
                                    <a href="agent-single.html" class="gcf-company"><img src="<?=site_url();?>assets/images/avatar/2.jpg" alt=""><span>By Liza Rose</span></a>
                                    <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Good" data-starrating2="4"></div>
                                </div>
                            </div>
                        </article>
                    </div>
                    listing-item end															
                </div>
                gallery-item end-->
                <!-- gallery-item
                <div class="gallery-item for_sale">
                    listing-item
                    <div class="listing-item">
                        <article class="geodir-category-listing fl-wrap">
                            <div class="geodir-category-img fl-wrap">
                                <a href="listing-single.html" class="geodir-category-img_item">
                                    <img src="<?=site_url();?>assets/images/all/1.jpg" alt="">
                                    <div class="overlay"></div>
                                </a>
                                <div class="geodir-category-location">
                                    <a href="#" class="single-map-item tolt" data-newlatitude="40.88496706" data-newlongitude="-73.88191222" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i> <span>  40 Journal Square  , NJ, USA</span></a>												
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
                                <h3 class="title-sin_item"><a href="listing-single.html">Luxury Family Home</a></h3>
                                <div class="geodir-category-content_price">$ 320,000</div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                <div class="geodir-category-content-details">
                                    <ul>
                                        <li><i class="fal fa-bed"></i><span>4</span></li>
                                        <li><i class="fal fa-bath"></i><span>2</span></li>
                                        <li><i class="fal fa-cube"></i><span>460 ft2</span></li>
                                    </ul>
                                </div>
                                <div class="geodir-category-footer fl-wrap">
                                    <a href="agent-single.html" class="gcf-company"><img src="<?=site_url();?>assets/images/avatar/1.jpg" alt=""><span>By Anna Lips</span></a>
                                    <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Excellent" data-starrating2="5"></div>
                                </div>
                            </div>
                        </article>
                    </div>
                    listing-item end															
                </div>
                gallery-item end																
                gallery-item
                <div class="gallery-item for_rent">
                    listing-item
                    <div class="listing-item">
                        <article class="geodir-category-listing fl-wrap">
                            <div class="geodir-category-img fl-wrap">
                                <a href="listing-single.html" class="geodir-category-img_item">
                                    <img src="<?=site_url();?>assets/images/all/9.jpg" alt="">
                                    <div class="overlay"></div>
                                </a>
                                <div class="geodir-category-location">
                                    <a href="#" class="single-map-item tolt" data-newlatitude="40.94982541" data-newlongitude="-73.84357452" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i> <span> 34-42 Montgomery St , NY, USA</span></a>													
                                </div>
                                <ul class="list-single-opt_header_cat">
                                    <li><a href="#" class="cat-opt blue-bg">Rent</a></li>
                                    <li><a href="#" class="cat-opt color-bg">House</a></li>
                                </ul>
                                <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                <div class="geodir-category-listing_media-list">
                                    <span><i class="fas fa-camera"></i> 4</span>
                                </div>
                            </div>
                            <div class="geodir-category-content fl-wrap">
                                <h3 class="title-sin_item"><a href="listing-single.html">Family House for Rent</a></h3>
                                <div class="geodir-category-content_price">$ 700 / per month</div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                <div class="geodir-category-content-details">
                                    <ul>
                                        <li><i class="fal fa-bed"></i><span>2</span></li>
                                        <li><i class="fal fa-bath"></i><span>1</span></li>
                                        <li><i class="fal fa-cube"></i><span>220 ft2</span></li>
                                    </ul>
                                </div>
                                <div class="geodir-category-footer fl-wrap">
                                    <a href="agent-single.html" class="gcf-company"><img src="<?=site_url();?>assets/images/avatar/3.jpg" alt=""><span>By Mark Frosty</span></a>
                                    <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Good" data-starrating2="4"></div>
                                </div>
                            </div>
                        </article>
                    </div>
                    listing-item end																			
                </div>
                gallery-item end															
                gallery-item
                <div class="gallery-item for_sale">
                    listing-item
                    <div class="listing-item">
                        <article class="geodir-category-listing fl-wrap">
                            <div class="geodir-category-img fl-wrap">
                                <a href="listing-single.html" class="geodir-category-img_item">
                                    <img src="<?=site_url();?>assets/images/all/6.jpg" alt="">
                                    <div class="overlay"></div>
                                </a>
                                <div class="geodir-category-location">
                                    <a href="#" class="single-map-item tolt" data-newlatitude="40.72228267" data-newlongitude="-73.99246214" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i> <span> W 85th St, New York, USA</span></a>												
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
                                <h3 class="title-sin_item"><a href="listing-single.html">Contemporary Apartment</a></h3>
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
                                    <a href="agent-single.html" class="gcf-company"><img src="<?=site_url();?>assets/images/avatar/4.jpg" alt=""><span>By Bill Trust</span></a>
                                    <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Excellent
                                        " data-starrating2="5"></div>
                                </div>
                            </div>
                        </article>
                    </div>
                    listing-item end																			
                </div>
                gallery-item end															
                gallery-item
                <div class="gallery-item for_sale for_rent">
                    listing-item
                    <div class="listing-item">
                        <article class="geodir-category-listing fl-wrap">
                            <div class="geodir-category-img fl-wrap">
                                <a href="listing-single.html" class="geodir-category-img_item">
                                    <img src="<?=site_url();?>assets/images/all/5.jpg" alt="">
                                    <div class="overlay"></div>
                                </a>
                                <div class="geodir-category-location">
                                    <a href="#" class="single-map-item tolt" data-newlatitude="40.88496706" data-newlongitude="-73.88191222" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i> <span> 75 Prince St, NY, USA</span></a>												
                                </div>
                                <ul class="list-single-opt_header_cat">
                                    <li><a href="#" class="cat-opt blue-bg">Sale</a></li>
                                    <li><a href="#" class="cat-opt color-bg">Villa</a></li>
                                </ul>
                                <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                <div class="geodir-category-listing_media-list">
                                    <span><i class="fas fa-camera"></i> 12</span>
                                </div>
                            </div>
                            <div class="geodir-category-content fl-wrap">
                                <h3 class="title-sin_item"><a href="listing-single.html">Kayak Point House</a></h3>
                                <div class="geodir-category-content_price">$ 500.000</div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                <div class="geodir-category-content-details">
                                    <ul>
                                        <li><i class="fal fa-bed"></i><span>5</span></li>
                                        <li><i class="fal fa-bath"></i><span>1</span></li>
                                        <li><i class="fal fa-cube"></i><span>510 ft2</span></li>
                                    </ul>
                                </div>
                                <div class="geodir-category-footer fl-wrap">
                                    <a href="agent-single.html" class="gcf-company"><img src="<?=site_url();?>assets/images/avatar/6.jpg" alt=""><span>By Andy Sposty</span></a>
                                    <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Average" data-starrating2="3"></div>
                                </div>
                            </div>
                        </article>
                    </div>
                    listing-item end																		
                </div>
                gallery-item end															
                gallery-item
                <div class="gallery-item for_rent">
                    listing-item
                    <div class="listing-item">
                        <article class="geodir-category-listing fl-wrap">
                            <div class="geodir-category-img fl-wrap">
                                <a href="listing-single.html" class="geodir-category-img_item">
                                    <img src="<?=site_url();?>assets/images/all/8.jpg" alt="">
                                    <div class="overlay"></div>
                                </a>
                                <div class="geodir-category-location">
                                    <a href="#" class="single-map-item tolt" data-newlatitude="40.76221766" data-newlongitude="-73.96511769" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i> <span> 70 Bright St, Jersey City, NJ USA</span></a>													
                                </div>
                                <ul class="list-single-opt_header_cat">
                                    <li><a href="#" class="cat-opt blue-bg">Rent</a></li>
                                    <li><a href="#" class="cat-opt color-bg">Apartment</a></li>
                                </ul>
                                <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save"><span><i class="fal fa-heart"></i></span></a>
                                <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>
                                <div class="geodir-category-listing_media-list">
                                    <span><i class="fas fa-camera"></i> 21</span>
                                </div>
                            </div>
                            <div class="geodir-category-content fl-wrap">
                                <h3 class="title-sin_item"><a href="listing-single.html">Urban House</a></h3>
                                <div class="geodir-category-content_price">1500 / per month</div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                <div class="geodir-category-content-details">
                                    <ul>
                                        <li><i class="fal fa-bed"></i><span>5</span></li>
                                        <li><i class="fal fa-bath"></i><span>3</span></li>
                                        <li><i class="fal fa-cube"></i><span>1210 ft2</span></li>
                                    </ul>
                                </div>
                                <div class="geodir-category-footer fl-wrap">
                                    <a href="agent-single.html" class="gcf-company"><img src="<?=site_url();?>assets/images/avatar/5.jpg" alt=""><span>By Liza Kobart</span></a>
                                    <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Excellent
                                        " data-starrating2="5"></div>
                                </div>
                            </div>
                        </article>
                    </div>
                    listing-item end															
                </div>
                gallery-item end																
            </div>
            grid-item-holder	
            <a href="listing.html" class="btn float-btn small-btn color-bg">View All Businesses</a>
        </div>
    </section> -->
    <!-- section end-->	
    <!-- section -->
    <!-- <section>
        <div class="container">
            about-wrap
            <div class="about-wrap">
                <div class="row">
                    <div class="col-md-5">
                        <div class="about-title ab-hero fl-wrap">
                            <h2>Why Choose Our Businesses </h2>
                            <h4>Check video presentation to find   out more about us .</h4>
                        </div>
                        <div class="services-opions fl-wrap">
                            <ul>
                                <li>
                                    <i class="fal fa-headset"></i>
                                    <h4>24 Hours Support  </h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </li>
                                <li>
                                    <i class="fal fa-users-cog"></i>
                                    <h4>User Admin Panel</h4>
                                    <p>Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Curabitur convallis fringilla diam sed aliquam. </p>
                                </li>
                                <li>
                                    <i class="fal fa-phone-laptop"></i>
                                    <h4>Mobile Friendly</h4>
                                    <p>Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <div class="about-img fl-wrap">
                            <img src="<?=site_url();?>assets/images/all/27.jpg" class="respimg" alt="">
                            <div class="about-img-hotifer color-bg">
                                <p>Your website is fully responsive so visitors can view your content from their choice of device.</p>
                                <h4>Mark Antony</h4>
                                <h5>Homeradar CEO</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            about-wrap end 							
        </div>
    </section> -->
    <!-- section end-->	
    <!-- section  -->
    <section class="hidden-section no-padding-section">
        <div class="half-carousel-wrap">
            <div class="half-carousel-title color-bg">
                <div class="half-carousel-title-item fl-wrap">
                    <h2>Explore Best Cities</h2>
                    <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h5>
                </div>
                <div class="pwh_bg"></div>
            </div>
            <div class="half-carousel-conatiner">
                <div class="half-carousel fl-wrap full-height">
                    <!--slick-item -->
                    <div class="slick-item">
                        <div class="half-carousel-item fl-wrap">
                            <div class="bg-wrap bg-parallax-wrap-gradien">
                                <div class="bg"  data-bg="<?=site_url();?>assets/images/bg/long/1.jpg"></div>
                            </div>
                            <div class="half-carousel-content">
                                <div class="hc-counter color-bg">26 Businesses</div>
                                <h3><a href="listing.html">Explore NewYork</a></h3>
                                <p>Constant care and attention to the patients makes good record</p>
                            </div>
                        </div>
                    </div>
                    <!--slick-item end -->
                    <!--slick-item -->
                    <div class="slick-item">
                        <div class="half-carousel-item fl-wrap">
                            <div class="bg-wrap bg-parallax-wrap-gradien">
                                <div class="bg"  data-bg="<?=site_url();?>assets/images/bg/long/2.jpg"></div>
                            </div>
                            <div class="half-carousel-content">
                                <div class="hc-counter color-bg">89 Businesses</div>
                                <h3><a href="listing.html">Awesome London</a></h3>
                                <p>Constant care and attention to the patients makes good record</p>
                            </div>
                        </div>
                    </div>
                    <!--slick-item end -->									
                    <!--slick-item -->
                    <div class="slick-item">
                        <div class="half-carousel-item fl-wrap">
                            <div class="bg-wrap bg-parallax-wrap-gradien">
                                <div class="bg"  data-bg="<?=site_url();?>assets/images/bg/long/3.jpg"></div>
                            </div>
                            <div class="half-carousel-content">
                                <div class="hc-counter color-bg">102 Businesses</div>
                                <h3><a href="listing.html">Find Dream in Paris</a></h3>
                                <p>Constant care and attention to the patients makes good record</p>
                            </div>
                        </div>
                    </div>
                    <!--slick-item end -->
                    <!--slick-item -->
                    <div class="slick-item">
                        <div class="half-carousel-item fl-wrap">
                            <div class="bg-wrap bg-parallax-wrap-gradien">
                                <div class="bg"  data-bg="<?=site_url();?>assets/images/bg/long/4.jpg"></div>
                            </div>
                            <div class="half-carousel-content">
                                <div class="hc-counter color-bg">51 Businesses</div>
                                <h3><a href="listing.html">Elite Houses in Dubai</a></h3>
                                <p>Constant care and attention to the patients makes good record</p>
                            </div>
                        </div>
                    </div>
                    <!--slick-item end -->									
                </div>
            </div>
        </div>
    </section>
    <!--section end-->  					
    <!-- section -->
    <!-- <section >
        <div class="container">
            section-title
            <div class="section-title st-center fl-wrap">
                <h4>The Best Agents</h4>
                <h2>Meet Our Agents</h2>
            </div>
            section-title end
            <div class="clearfix"></div>
            <div class="listing-carousel-wrapper lc_hero carousel-wrap fl-wrap">
                <div class="listing-carousel carousel ">
                    slick-slide-item
                    <div class="slick-slide-item">
                         agent card item
                        <div class="listing-item">
                            <article class="geodir-category-listing fl-wrap">
                                <div class="geodir-category-img fl-wrap  agent_card">
                                    <a href="agent-single.html" class="geodir-category-img_item">
                                        <img src="<?=site_url();?>assets/images/agency/agent/1.jpg" alt="">
                                        <ul class="list-single-opt_header_cat">
                                            <li><span class="cat-opt color-bg">4 listings</span></li>
                                        </ul>
                                    </a>
                                    <div class="agent-card-social fl-wrap">
                                        <ul>
                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><span class="re_stars-title">Excellent</span></div>
                                </div>
                                <div class="geodir-category-content fl-wrap">
                                    <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Verified"><i class="fal fa-user-check"></i></div>
                                    <div class="agent_card-title fl-wrap">
                                        <h4><a href="agent-single.html" >Anna Lips</a></h4>
                                        <h5><a href="agency-single.html">CondorHome RealEstate agency</a></h5>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                    <div class="geodir-category-footer fl-wrap">
                                        <a href="agent-single.html" class="btn float-btn color-bg small-btn">View Profile</a>
                                        <a href="mailto:yourmail@email.com" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Write Message"><i class="fal fa-envelope"></i></a>
                                        <a href="tel:123-456-7890" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Call Now"><i class="fal fa-phone"></i></a>	
                                    </div>
                                </div>
                            </article>
                        </div>
                         agent card item end
                    </div>
                    slick-slide-item end
                    slick-slide-item
                    <div class="slick-slide-item">
                         agent card item
                        <div class="listing-item">
                            <article class="geodir-category-listing fl-wrap">
                                <div class="geodir-category-img fl-wrap  agent_card">
                                    <a href="agent-single.html" class="geodir-category-img_item">
                                        <img src="<?=site_url();?>assets/images/agency/agent/3.jpg" alt="">
                                        <ul class="list-single-opt_header_cat">
                                            <li><span class="cat-opt color-bg">6 listings</span></li>
                                        </ul>
                                    </a>
                                    <div class="agent-card-social fl-wrap">
                                        <ul>
                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-vk"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="3"><span class="re_stars-title">Average</span></div>
                                </div>
                                <div class="geodir-category-content fl-wrap">
                                    <div class="card-verified cv_not tolt" data-microtip-position="left" data-tooltip="Not Verified"><i class="fal fa-minus-octagon"></i></div>
                                    <div class="agent_card-title fl-wrap">
                                        <h4><a href="agent-single.html" >Jane Kobart</a></h4>
                                        <h5><a href="agency-single.html">Mavers RealEstate agency</a></h5>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                    <div class="geodir-category-footer fl-wrap">
                                        <a href="agent-single.html" class="btn float-btn color-bg small-btn">View Profile</a>
                                        <a href="mailto:yourmail@email.com" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Write Message"><i class="fal fa-envelope"></i></a>
                                        <a href="tel:123-456-7890" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Call Now"><i class="fal fa-phone"></i></a>	
                                    </div>
                                </div>
                            </article>
                        </div>
                         agent card item end
                    </div>
                    slick-slide-item end									
                    slick-slide-item
                    <div class="slick-slide-item">
                         agent card item
                        <div class="listing-item">
                            <article class="geodir-category-listing fl-wrap">
                                <div class="geodir-category-img fl-wrap  agent_card">
                                    <a href="agent-single.html" class="geodir-category-img_item">
                                        <img src="<?=site_url();?>assets/images/agency/agent/5.jpg" alt="">
                                        <ul class="list-single-opt_header_cat">
                                            <li><span class="cat-opt color-bg">23 listings</span></li>
                                        </ul>
                                    </a>
                                    <div class="agent-card-social fl-wrap">
                                        <ul>
                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-vk"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><span class="re_stars-title">Excellent
                                        </span>
                                    </div>
                                </div>
                                <div class="geodir-category-content fl-wrap">
                                    <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Verified"><i class="fal fa-user-check"></i></div>
                                    <div class="agent_card-title fl-wrap">
                                        <h4><a href="agent-single.html" >Bill Trust</a></h4>
                                        <h5><a href="agency-single.html">Your Sweet Home   agency</a></h5>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                    <div class="geodir-category-footer fl-wrap">
                                        <a href="agent-single.html" class="btn float-btn color-bg small-btn">View Profile</a>
                                        <a href="mailto:yourmail@email.com" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Write Message"><i class="fal fa-envelope"></i></a>
                                        <a href="tel:123-456-7890" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Call Now"><i class="fal fa-phone"></i></a>	
                                    </div>
                                </div>
                            </article>
                        </div>
                         agent card item end								
                    </div>
                    slick-slide-item end									
                    slick-slide-item
                    <div class="slick-slide-item">
                         agent card item
                        <div class="listing-item">
                            <article class="geodir-category-listing fl-wrap">
                                <div class="geodir-category-img fl-wrap  agent_card">
                                    <a href="agent-single.html" class="geodir-category-img_item">
                                        <img src="<?=site_url();?>assets/images/agency/agent/6.jpg" alt="">
                                        <ul class="list-single-opt_header_cat">
                                            <li><span class="cat-opt color-bg">12 listings</span></li>
                                        </ul>
                                    </a>
                                    <div class="agent-card-social fl-wrap">
                                        <ul>
                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="4"><span class="re_stars-title">Good</span></div>
                                </div>
                                <div class="geodir-category-content fl-wrap">
                                    <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Verified"><i class="fal fa-user-check"></i></div>
                                    <div class="agent_card-title fl-wrap">
                                        <h4><a href="agent-single.html" >Martin Smith</a></h4>
                                        <h5><a href="agency-single.html">Mavers RealEstate agency</a></h5>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                                    <div class="geodir-category-footer fl-wrap">
                                        <a href="agent-single.html" class="btn float-btn color-bg small-btn">View Profile</a>
                                        <a href="mailto:yourmail@email.com" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Write Message"><i class="fal fa-envelope"></i></a>
                                        <a href="tel:123-456-7890" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Call Now"><i class="fal fa-phone"></i></a>	
                                    </div>
                                </div>
                            </article>
                        </div>
                         agent card item end								
                    </div>
                    slick-slide-item end								
                </div>
                <div class="swiper-button-prev lc-wbtn lc-wbtn_prev"><i class="far fa-angle-left"></i></div>
                <div class="swiper-button-next lc-wbtn lc-wbtn_next"><i class="far fa-angle-right"></i></div>
            </div>
        </div>
    </section> -->
    <!-- section end-->					
    
    <section  class="subscribe-wrap padding-section" style="padding:10px">
       
    </sec>
    <!-- section end-->
</div>
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
<!-- subscribe-wrap end -->	 
<?php echo $this->endSection(); ?>