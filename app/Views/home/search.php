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
    <section class="parallax-section single-par color-bg">
        <div class="container">
            <div class="section-title center-align big-title">
                <h2><span>Listings Without Map</span></h2>
                <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h4>
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
                <a href="<?=site_url(); ?>">Home</a><a href="#">Listings</a> <span>New York</span>
            </div>
        </div>
    </div>
    <!-- breadcrumbs end -->
    <!-- col-list-wrap -->
    <section class="gray-bg small-padding ">
        <div class="container">
            <div class="mob-nav-content-btn  color-bg show-list-wrap-search ntm fl-wrap">Show  Filters</div>
            <!-- list-searh-input-wrap-->
            <div class="list-searh-input-wrap box_list-searh-input-wrap lws_mobile fl-wrap">
                <div class="list-searh-input-wrap-title fl-wrap"><i class="far fa-sliders-h"></i><span>Search Filters</span></div>
                <div class="custom-form fl-wrap">
                    <div class="row">
                        <!-- listsearch-input-item -->
                        <div class="col-sm-6">
                            <div class="listsearch-input-item  ">
                                <input type="text"   placeholder="Address , Street , State..." value="<?=$search; ?>"/>
                            </div>
                        </div>
                        <!-- listsearch-input-item -->
                        <!-- listsearch-input-item -->
                        <div class="col-sm-3">
                            <div class="listsearch-input-item">
                                <select data-placeholder="Status" class="chosen-select on-radius no-search-select" >
                                    <option>Any Status</option>
                                    <option>For Rent</option>
                                    <option>For Sale</option>
                                </select>
                            </div>
                        </div>
                        <!-- listsearch-input-item -->								
                        <!-- listsearch-input-item -->
                        <div class="col-sm-3">
                            <div class="listsearch-input-item">
                                <select data-placeholder="All Cities" class="chosen-select on-radius no-search-select" >
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
                        </div>
                        <!-- listsearch-input-item -->
                        <div class="clearfix"></div>
                        <!-- listsearch-input-item -->
                        <div class="col-sm-4">
                            <div class="listsearch-input-item">
                                <select data-placeholder="Categories" class="chosen-select on-radius no-search-select" >
                                    <option>All Categories</option>
                                    <option>House</option>
                                    <option>Apartment</option>
                                    <option>Hotel</option>
                                    <option>Villa</option>
                                    <option>Office</option>
                                </select>
                            </div>
                        </div>
                        <!-- listsearch-input-item -->								
                        <!-- listsearch-input-item -->
                        <div class="col-sm-5">
                            <div class="listsearch-input-item">
                                <div class="price-rage-item fl-wrap">
                                    <span class="pr_title">Price:</span>                            
                                    <input type="text" class="price-range-double" data-min="100" data-max="100000"  name="price-range2"  data-step="100" value="1" data-prefix="$">
                                </div>
                            </div>
                        </div>
                        <!-- listsearch-input-item -->								
                        <!-- listsearch-input-item -->
                        <div class="col-sm-3">
                            <div class="listsearch-input-item">
                                <a href="#" class="btn color-bg fw-btn float-btn small-btn">Search</a>										
                            </div>
                        </div>
                        <!-- listsearch-input-item --> 						
                    </div>
                    <div class="clearfix"></div>
                    <div class="hidden-listing-filter fl-wrap">
                        <div class="row">
                            <!-- listsearch-input-item -->								
                            <div class="col-sm-2">
                                <div class="listsearch-input-item">
                                    <label>Bedrooms</label>
                                    <select data-placeholder="Bedrooms" class="chosen-select on-radius no-search-select" >
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <!-- listsearch-input-item end-->
                            <!-- listsearch-input-item -->								
                            <div class="col-sm-2">
                                <div class="listsearch-input-item">
                                    <label>Bathrooms</label>
                                    <select data-placeholder="Bathrooms" class="chosen-select on-radius no-search-select" >
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </div>
                            <!-- listsearch-input-item end-->
                            <!-- listsearch-input-item -->
                            <div class="col-sm-2">
                                <div class="listsearch-input-item">
                                    <label>Floors</label>
                                    <select data-placeholder="Bathrooms" class="chosen-select on-radius no-search-select" >
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </div>
                            <!-- listsearch-input-item end-->
                            <!-- listsearch-input-item -->
                            <div class="col-sm-2">
                                <div class="listsearch-input-item">
                                    <label>Property Id</label>
                                    <input type="text" onClick="this.select()" placeholder="Id" value=""/>
                                </div>
                            </div>
                            <!-- listsearch-input-item end-->								
                            <!-- listsearch-input-item -->
                            <div class="col-sm-4">
                                <div class="listsearch-input-item">
                                    <label>Area Sq/ft</label>
                                    <div class="price-rage-item pr-nopad fl-wrap">
                                        <input type="text" class="price-range-double" data-min="1" data-max="1000"  name="price-range2"  data-step="1" value="1" data-prefix="">
                                    </div>
                                </div>
                            </div>
                            <!-- listsearch-input-item -->								
                        </div>
                        <div class="clearfix"></div>
                        <!-- listsearch-input-item-->
                        <div class="listsearch-input-item">
                            <label>Amenities</label>
                            <div class=" fl-wrap filter-tags">
                                <ul class="no-list-style">
                                    <li>
                                        <input id="check-aa" type="checkbox" name="check">
                                        <label for="check-aa">Elevator in building</label>
                                    </li>
                                    <li>
                                        <input id="check-b" type="checkbox" name="check">
                                        <label for="check-b"> Laundry Room</label>
                                    </li>
                                    <li>
                                        <input id="check-c" type="checkbox" name="check" checked>
                                        <label for="check-c">Equipped Kitchen</label>
                                    </li>
                                    <li>
                                        <input id="check-d" type="checkbox" name="check">
                                        <label for="check-d">Air Conditioned</label>
                                    </li>
                                    <li>
                                        <input id="check-d2" type="checkbox" name="check" checked>
                                        <label for="check-d2">Parking</label> 
                                    </li>
                                    <li>
                                        <input id="check-d3" type="checkbox" name="check" checked>
                                        <label for="check-d3">Swimming Pool</label> 
                                    </li>
                                    <li>   
                                        <input id="check-d4" type="checkbox" name="check">
                                        <label for="check-d4">Fitness Gym</label>
                                    </li>
                                    <li>   
                                        <input id="check-d5" type="checkbox" name="check">
                                        <label for="check-d5">Security</label>
                                    </li>
                                    <li>   
                                        <input id="check-d6" type="checkbox" name="check">
                                        <label for="check-d6">Garage Attached</label>
                                    </li>
                                    <li>   
                                        <input id="check-d7" type="checkbox" name="check">
                                        <label for="check-d7">Back yard</label>
                                    </li>
                                    <li>   
                                        <input id="check-d8" type="checkbox" name="check">
                                        <label for="check-d8">Fireplace</label>
                                    </li>
                                    <li>   
                                        <input id="check-d9" type="checkbox" name="check">
                                        <label for="check-d9">Window Covering</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- listsearch-input-item end--> 												
                    </div>
                </div>
                <div class="more-filter-option-wrap">
                    <div class="more-filter-option-btn more-filter-option act-hiddenpanel"> <span>Advanced search</span> <i class="fas fa-caret-down"></i></div>
                    <div class="reset-form reset-btn"> <i class="far fa-sync-alt"></i> Reset Filters</div>
                </div>
            </div>
            <!-- list-searh-input-wrap end-->							
            <!-- list-main-wrap-header-->
            <div class="list-main-wrap-header box-list-header fl-wrap">
                <!-- list-main-wrap-title-->
                <div class="list-main-wrap-title">
                    <h2>Results For :  <strong id="counts">8</strong></h2>
                </div>        
            </div>
            <!-- list-main-wrap-header end-->						
            <!-- listing-item-wrap-->
            <div class="listing-item-container three-columns-grid  box-list_ic fl-wrap">
                <!-- listing-item -->
                <div class="listing-item" id="load_data">
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
               					
            </div>
            <!-- listing-item-wrap end-->
            <!-- pagination-->
            <div class="pagination" id="load_more">
               
            </div>
            <!-- pagination end-->						
        </div>
    </section>
    <div class="limit-box fl-wrap"></div>
</div>
        

<?php echo $this->endSection(); ?>