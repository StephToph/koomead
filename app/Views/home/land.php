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
            <div class="bg par-elem "  data-bg="<?=site_url();?>assets/images/bg1.jpg" data-scrollax="Businesses: { translateY: '30%' }" style="background-position: top;"></div>
        </div>
        <div class="overlay"></div>
        <div class="container">
            <div class="hero-title hero-title_small">
                <h2>Find Businesses in your Locale
                </h2>
            </div>
            <div class="main-search-input-wrap">
                <div class="main-search-input fl-wrap">
                    
                    <?php echo form_open_multipart('home/search', array('id'=>'bb_ajax_for', 'class'=>'')); ?>
                    <div class="main-search-input-item">
                        <input type="text" name="search" placeholder="What are you looking for?" required value=""/>
                        <input type="text" name="search" placeholder="What are you looking for?" required value=""/>
                    </div>
                    <div class="main-search-input-item">
                        <select data-placeholder="Select" name="category_ids" id="category_ids" required class="mb-2 chosen-select">
                            <option value="all">All Categories</option>
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
                                <option value="all">All State</option>
                                <?php
                                    $c_id = $this->Crud->read_field('name', $location, 'country', 'id');
                                    $country = $this->Crud->read_single_order('country_id', $c_id, 'state', 'name', 'asc');
                                    if(!empty($country)){
                                        foreach($country as $c){
                                            echo '<option value="'.$c->id.'">'.$c->name.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </select>
                    </div>
                    <button class="main-search-button color-bg" >  Search <i class="far fa-search"></i> </button>
                    </form>
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
    
    <!-- breadcrumbs end -->
    <!-- section -->
    <section class="gray-bg small-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="section-title fl-wrap">
                        <h4>Browse Hot Offers</h4>
                        <h2>Featured Business</h2>
                    </div>
                </div>
                <div class="col-md-8">
                    
                </div>
            </div>
            <div class="clearfix"></div>
            <div id="load_data">
                
            </div>
            
            	
            <a href="javascript:;" class="btn float-btn small-btn color-bg">View All Businesses</a>
        </div><div class="clearfix"></div>
    </section>
    
    
    <section class="hidden-section no-padding-section">
        <div class="half-carousel-wrap">
            <div class="half-carousel-title color-bg">
                <div class="half-carousel-title-item fl-wrap">
                    <h2>Explore Best Cities</h2>
                    <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h5>
                </div>
                <div class="pwh_bg"></div>
            </div>
            <div class="half-carousel-conatiner" id="load_state">
                <div class="half-carousel fl-wrap full-height" >

                    <!--slick-item -->
                    <div class="slick-item">
                        <div class="half-carousel-item fl-wrap">
                            <div class="bg-wrap bg-parallax-wrap-gradien">
                                <div class="bg"  data-bg="<?=site_url();?>assets/images/bg/long/1.jpg"></div>
                            </div>
                            <div class="half-carousel-content">
                                <div class="hc-counter color-bg">0 Businesses</div>
                                <h3><a href="listing.html">Explore NewYork</a></h3>
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
<?php echo $this->endSection(); ?>