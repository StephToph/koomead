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
                            <div class="bg par-elem "  data-bg="<?=site_url();?>assets/images/bg/14.jpg" data-scrollax="properties: { translateY: '30%' }"></div>
                        </div>
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="hero-title hero-title_small">
                                <h4>Real Estate Searching Platform</h4>
                                <h2>Find The House of Your Dream  <br>
                                    Using Our Platform
                                </h2>
                            </div>
                            <div class="main-search-input-wrap">
                                <div class="main-search-input fl-wrap">
                                    <div class="main-search-input-item">
                                        <input type="text" placeholder="What are you looking for?" value=""/>
                                    </div>
                                    <div class="main-search-input-item">
                                        <select data-placeholder="All Categories"  class="chosen-select no-search-select" >
                                            <option>All Statuses</option>
                                            <option>For Rent</option>
                                            <option>For Sale</option>
                                        </select>
                                    </div>
                                    <div class="main-search-input-item">
                                        <select data-placeholder="All Categories"  class="chosen-select" >
                                            <option>All Cities</option>
                                            <option>New York</option>
                                            <option>London</option>
                                            <option>Paris</option>
                                            <option>Kiev</option>
                                            <option>Moscow</option>
                                            <option>Dubai</option>
                                            <option>Rome</option>
                                            <option>Beijing</option>
                                        </select>
                                    </div>
                                    <button class="main-search-button color-bg" onclick="window.location.href='listing.html'">  Search <i class="far fa-search"></i> </button>
                                </div>
                            </div>
                            <div class="hero-notifer fl-wrap">Need more search options? <a href="listing.html">Advanced Search</a> </div>
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
                    <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
                        <div class="container">
                            <div class="breadcrumbs-list">
                                <a href="#">Home</a>  <span>Home Image</span>
                            </div>
                            <div class="share-holder hid-share">
                                <a href="#" class="share-btn showshare sfcs">  <i class="fas fa-share-alt"></i>  Share   </a>
                                <div class="share-container  isShare"></div>
                            </div>
                        </div>
                    </div>
                    <!-- breadcrumbs end -->
                    <!-- section -->
                    <section class="gray-bg small-padding">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="section-title fl-wrap">
                                        <h4>Browse Hot Offers</h4>
                                        <h2>Latest Properties</h2>
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
                            <!-- grid-item-holder-->	
                            <div class="grid-item-holder gallery-items gisp fl-wrap">
                                <!-- gallery-item-->
                                <div class="gallery-item for_sale">
                                    <!-- listing-item -->
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
                                    <!-- listing-item end-->															
                                </div>
                                <!-- gallery-item end-->
                                <!-- gallery-item-->
                                <div class="gallery-item for_sale">
                                    <!-- listing-item -->
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
                                    <!-- listing-item end-->															
                                </div>
                                <!-- gallery-item end-->																
                                <!-- gallery-item-->
                                <div class="gallery-item for_rent">
                                    <!-- listing-item -->
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
                                    <!-- listing-item end-->																			
                                </div>
                                <!-- gallery-item end-->															
                                <!-- gallery-item-->
                                <div class="gallery-item for_sale">
                                    <!-- listing-item -->
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
                                    <!-- listing-item end-->																			
                                </div>
                                <!-- gallery-item end-->															
                                <!-- gallery-item-->
                                <div class="gallery-item for_sale for_rent">
                                    <!-- listing-item -->
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
                                    <!-- listing-item end-->																		
                                </div>
                                <!-- gallery-item end-->															
                                <!-- gallery-item-->
                                <div class="gallery-item for_rent">
                                    <!-- listing-item -->
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
                                    <!-- listing-item end-->															
                                </div>
                                <!-- gallery-item end-->																
                            </div>
                            <!-- grid-item-holder-->	
                            <a href="listing.html" class="btn float-btn small-btn color-bg">View All Properties</a>
                        </div>
                    </section>
                    <!-- section end-->	
                    <!-- section -->
                    <section>
                        <div class="container">
                            <!--about-wrap -->
                            <div class="about-wrap">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="about-title ab-hero fl-wrap">
                                            <h2>Why Choose Our Properties </h2>
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
                            <!-- about-wrap end  -->							
                        </div>
                    </section>
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
                                                <div class="hc-counter color-bg">26 Properties</div>
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
                                                <div class="hc-counter color-bg">89 Properties</div>
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
                                                <div class="hc-counter color-bg">102 Properties</div>
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
                                                <div class="hc-counter color-bg">51 Properties</div>
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
                    <section >
                        <div class="container">
                            <!-- section-title -->
                            <div class="section-title st-center fl-wrap">
                                <h4>The Best Agents</h4>
                                <h2>Meet Our Agents</h2>
                            </div>
                            <!-- section-title end -->
                            <div class="clearfix"></div>
                            <div class="listing-carousel-wrapper lc_hero carousel-wrap fl-wrap">
                                <div class="listing-carousel carousel ">
                                    <!-- slick-slide-item -->
                                    <div class="slick-slide-item">
                                        <!--  agent card item -->
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
                                        <!--  agent card item end -->
                                    </div>
                                    <!-- slick-slide-item end-->
                                    <!-- slick-slide-item -->
                                    <div class="slick-slide-item">
                                        <!--  agent card item -->
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
                                        <!--  agent card item end -->
                                    </div>
                                    <!-- slick-slide-item end-->									
                                    <!-- slick-slide-item -->
                                    <div class="slick-slide-item">
                                        <!--  agent card item -->
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
                                        <!--  agent card item end -->								
                                    </div>
                                    <!-- slick-slide-item end-->									
                                    <!-- slick-slide-item -->
                                    <div class="slick-slide-item">
                                        <!--  agent card item -->
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
                                        <!--  agent card item end -->								
                                    </div>
                                    <!-- slick-slide-item end-->								
                                </div>
                                <div class="swiper-button-prev lc-wbtn lc-wbtn_prev"><i class="far fa-angle-left"></i></div>
                                <div class="swiper-button-next lc-wbtn lc-wbtn_next"><i class="far fa-angle-right"></i></div>
                            </div>
                        </div>
                    </section>
                    <!-- section end-->					
                    <!-- section -->
                    <section class="color-bg small-padding">
                        <div class="container">
                            <div class="main-facts fl-wrap">
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="578">0</div>
                                            </div>
                                        </div>
                                        <h6>Agents and Agencys</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="12168">0</div>
                                            </div>
                                        </div>
                                        <h6>Happy Customers Every Year</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="2172">0</div>
                                            </div>
                                        </div>
                                        <h6>Won Awards</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="732">0</div>
                                            </div>
                                        </div>
                                        <h6>New Listing Every Week</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                            </div>
                        </div>
                        <div class="svg-bg">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%"
                                height="100%" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice">
                                <defs>
                                    <lineargradient id="bg">
                                        <stop offset="0%" style="stop-color:rgba(255, 255, 255, 0.6)"></stop>
                                        <stop offset="50%" style="stop-color:rgba(255, 255, 255, 0.1)"></stop>
                                        <stop offset="100%" style="stop-color:rgba(255, 255, 255, 0.6)"></stop>
                                    </lineargradient>
                                    <path id="wave" stroke="url(#bg)" fill="none" d="M-363.852,502.589c0,0,236.988-41.997,505.475,0
                                        s371.981,38.998,575.971,0s293.985-39.278,505.474,5.859s493.475,48.368,716.963-4.995v560.106H-363.852V502.589z" />
                                </defs>
                                <g>
                                    <use xlink:href="#wave">
                                        <animatetransform attributeName="transform" attributeType="XML" type="translate" dur="10s" calcMode="spline"
                                            values="270 230; -334 180; 270 230" keyTimes="0; .5; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
                                            repeatCount="indefinite" />
                                    </use>
                                    <use xlink:href="#wave">
                                        <animatetransform attributeName="transform" attributeType="XML" type="translate" dur="8s" calcMode="spline"
                                            values="-270 230;243 220;-270 230" keyTimes="0; .6; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
                                            repeatCount="indefinite" />
                                    </use>
                                    <use xlink:href="#wave">
                                        <animatetransform attributeName="transform" attributeType="XML" type="translate" dur="6s" calcMode="spline"
                                            values="0 230;-140 200;0 230" keyTimes="0; .4; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
                                            repeatCount="indefinite" />
                                    </use>
                                    <use xlink:href="#wave">
                                        <animatetransform attributeName="transform" attributeType="XML" type="translate" dur="12s" calcMode="spline" values="0 240;140 200;0 230"
                                            keyTimes="0; .4; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0" repeatCount="indefinite" />
                                    </use>
                                </g>
                            </svg>
                        </div>
                    </section>
                    <!-- section end-->	 
                    <!-- section -->
                    <section class="gray-bg ">
                        <div class="container">
                            <div class="section-title st-center fl-wrap">
                                <h4>Testimonilas</h4>
                                <h2>What Our Clients Say</h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="testimonials-slider-wrap">
                            <div class="testimonials-slider">
                                <!--slick-item -->
                                <div class="slick-item">
                                    <div class="text-carousel-item fl-wrap">
                                        <div class="text-carousel-item-header fl-wrap">
                                            <div class="popup-avatar"><img src="<?=site_url();?>assets/images/avatar/1.jpg" alt=""></div>
                                            <div class="review-owner fl-wrap">Jessie Wilcox</div>
                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="5"> </div>
                                        </div>
                                        <div class="text-carousel-content fl-wrap">
                                            <p> "In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore luptatum."</p>
                                            <a href="#" class="testim-link color-bg">Via Facebook</a>
                                        </div>
                                    </div>
                                </div>
                                <!--slick-item end -->							
                                <!--slick-item -->
                                <div class="slick-item">
                                    <div class="text-carousel-item fl-wrap">
                                        <div class="text-carousel-item-header fl-wrap">
                                            <div class="popup-avatar"><img src="<?=site_url();?>assets/images/avatar/2.jpg" alt=""></div>
                                            <div class="review-owner fl-wrap">Austin Harisson</div>
                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="4"> </div>
                                        </div>
                                        <div class="text-carousel-content fl-wrap">
                                            <p> "Feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te odio dignissim qui blandit praesent blandit praesent luptatum zzril.Vulputate urna. Nulla tristique mi a massa convallis."</p>
                                            <a href="#" class="testim-link color-bg">Via Twitter</a>
                                        </div>
                                    </div>
                                </div>
                                <!--slick-item end -->
                                <!--slick-item -->
                                <div class="slick-item">
                                    <div class="text-carousel-item fl-wrap">
                                        <div class="text-carousel-item-header fl-wrap">
                                            <div class="popup-avatar"><img src="<?=site_url();?>assets/images/avatar/3.jpg" alt=""></div>
                                            <div class="review-owner fl-wrap">Garry Colonsi</div>
                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="4"> </div>
                                        </div>
                                        <div class="text-carousel-content fl-wrap">
                                            <p> "In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore luptatum."</p>
                                            <a href="#" class="testim-link color-bg">Via Facebook</a>
                                        </div>
                                    </div>
                                </div>
                                <!--slick-item end -->								
                                <!--slick-item -->
                                <div class="slick-item">
                                    <div class="text-carousel-item fl-wrap">
                                        <div class="text-carousel-item-header fl-wrap">
                                            <div class="popup-avatar"><img src="<?=site_url();?>assets/images/avatar/4.jpg" alt=""></div>
                                            <div class="review-owner fl-wrap">Antony Moore</div>
                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="5"> </div>
                                        </div>
                                        <div class="text-carousel-content fl-wrap">
                                            <p> "Feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te odio dignissim qui blandit praesent blandit praesent luptatum zzril.Vulputate urna. Nulla tristique mi a massa convallis."</p>
                                            <a href="#" class="testim-link color-bg">Via Twitter</a>
                                        </div>
                                    </div>
                                </div>
                                <!--slick-item end -->								
                            </div>
                        </div>
                    </section>
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