<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>

<?php echo $this->extend('designs/backend'); ?>
<?php echo $this->section('title'); ?>
    <?php echo $title; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<div class="dashboard-content">
    <div class="dashboard-menu-btn color-bg"><span><i class="fas fa-bars"></i></span>Dasboard Menu</div>
    <div class="container dasboard-container  mb-5">
        <!-- dashboard-title -->	
        <div class="dashboard-title fl-wrap">
            <div class="dashboard-title-item"><span><?=$page; ?></span></div>
            <div class="dashbard-menu-header">
                <div class="dashbard-menu-avatar fl-wrap">
                    <img src="<?=site_url(); ?>assets/images/avatar.png" alt="">
                    <h4>Welcome, <span><?=$log_name;?></span></h4>
                </div>
                <a href="<?=site_url('auth/logout');?>" class="log-out-btn   tolt" data-microtip-position="bottom"  data-tooltip="Log Out"><i class="far fa-power-off"></i></a>
            </div>
        </div>
        <div class="dasboard-wrapper fl-wrap">
            <div class="smallpadding fl-wrap">
                <div class="container">
                    <div class="row">
                        <?php
                            $name = $this->Crud->read_field('id', $param2, 'listing', 'name');
                            $user_id = $this->Crud->read_field('id', $param2, 'listing', 'user_id');
                            $category_id = $this->Crud->read_field('id', $param2, 'listing', 'category_id');
                            $state_id = $this->Crud->read_field('id', $param2, 'listing', 'state_id');
                            $country_id = $this->Crud->read_field('id', $param2, 'listing', 'country_id');
                            $address = $this->Crud->read_field('id', $param2, 'listing', 'address');
                            $email = $this->Crud->read_field('id', $param2, 'listing', 'email');
                            $phone = $this->Crud->read_field('id', $param2, 'listing', 'phone');
                            $city_id = $this->Crud->read_field('id', $param2, 'listing', 'city_id');
                            $price = $this->Crud->read_field('id', $param2, 'listing', 'price');
                            $active = $this->Crud->read_field('id', $param2, 'listing', 'active');
                            $profile = $this->Crud->read_field('id', $param2, 'listing', 'profile');
                            $negotiable = $this->Crud->read_field('id', $param2, 'listing', 'negotiable');
                            $price_status = $this->Crud->read_field('id', $param2, 'listing', 'price_status');
                            $description = $this->Crud->read_field('id', $param2, 'listing', 'description');
                            $images = $this->Crud->read_field('id', $param2, 'listing', 'images');
                            $reg_date = $this->Crud->read_field('id', $param2, 'listing', 'reg_date');
                            
                            $user = $this->Crud->read_field('id', $user_id, 'user', 'fullname');
                            $user_img = $this->Crud->read_field('id', $user_id, 'user', 'img_id');
                            if(empty($user_img))$user_img = 'assets/images/avatar.png';
                            $category = $this->Crud->read_field('id', $category_id, 'category', 'name');
                            $main_id = $this->Crud->read_field('id', $category_id, 'category', 'category_id');
                            $mains = $this->Crud->read_field('id', $main_id, 'category', 'name');
                            
                            $country = $this->Crud->read_field('id', $country_id, 'country', 'name');
                            $state = $this->Crud->read_field('id', $state_id, 'state', 'name');
                            $city = $this->Crud->read_field('id', $city_id, 'city', 'name');
                            

                            $page = 'home/listing/view/'.$param2;
						    $view = $this->Crud->check('page', $page, 'listing_view');
						
                            $loca = '';
                            $profiles = json_decode($profile);
                            $image = json_decode($images);

                            if($negotiable == 0)$negotiate = 'No'; else $negotiate = 'Yes';
                            if($active == 0)$active = 'Disabled'; else $active = 'Active';
                            
                            if(!empty($address)) $loca .= $address.', ';
						    if(!empty($city_id)) $loca .= $city;
                            if(!empty($state_id)) $loca .= ', '.$state;
                            if(!empty($country_id)) $loca .= ', '.$country;
                        ?>
                        <!--  listing-single content -->
                        <div class="col-md-12">
                            <div class="list-singlemain-wrapper fl-wrap">
                                <div class="list-single-header-item  fl-wrap" id="sec1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h1><?=strtoupper($name); ?> <span class="verified-badge tolt" data-microtip-position="bottom"  data-tooltip="Verified"><i class="fas fa-check"></i></span></h1>
                                            <div class="geodir-category-location fl-wrap">
                                                <a href="#"><i class="fas fa-map-marker-alt"></i>  <?=$loca; ?></a> 
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <a class="host-avatar-wrap" href="javascript:;">
                                            <span>By <?=ucwords($user); ?></span>
                                            <img src="<?=site_url($user_img); ?>" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                         $country = $this->Crud->read_field('id', $param2, 'listing', 'country_id');
                                         $cur = '&#8358;';
                                         if($country == 161)$cur = ' ₦';
                                    ?>
                                    <div class="list-single-header-footer fl-wrap">
                                        <div class="list-single-header-price" data-propertyprise="50500"><strong>Price:</strong><span><?=$cur; ?></span><?=number_format($price,2); ?></div>
                                        <div class="list-single-header-date"><span>Date:</span><?=date('d F, Y', strtotime($reg_date)); ?></div>
                                        <div class="list-single-stats">
                                            <ul class="no-list-style">
                                                <li><span class="viewed-counter"><i class="fas fa-eye"></i> Viewed -  <?=$view; ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-single-main-media fl-wrap">
                                    <div class="single-slider-wrapper carousel-wrap fl-wrap">
                                        <div class="slider-for fl-wrap carousel lightgallery"  >
                                            <?php if($image){
                                                foreach($image as $i => $val){
                                            ?>
                                            <!--  slick-slide-item -->
                                            <div class="slick-slide-item">
                                                <div class="box-item">
                                                    <a href="<?=site_url($val); ?>" class="gal-link popup-image"><i class="fal fa-search"  ></i></a>
                                                    <img src="<?=site_url($val); ?>" alt="" style="height:600px;" height="80">
                                                </div>
                                            </div>
                                            <?php } } ?>
                                           
                                        </div>
                                        <div class="swiper-button-prev ssw-btn"><i class="fas fa-caret-left"></i></div>
                                        <div class="swiper-button-next ssw-btn"><i class="fas fa-caret-right"></i></div>
                                    </div>
                                    <div class="single-slider-wrapper fl-wrap">
                                        <div class="slider-nav fl-wrap">
                                            <?php if($image){
                                                foreach($image as $i => $val){
                                            ?>
                                            <div class="slick-slide-item"><img src="<?=site_url($val); ?>" style="height:200px;" alt="" height="80"></div>

                                            <?php } } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-single-facts fl-wrap">
                                    <!-- inline-facts -->
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-home-lg"></i>
                                            <h6>Category</h6>
                                            <span><?=$category; ?></span>
                                        </div>
                                    </div>
                                    <!-- inline-facts end -->
                                    <!-- inline-facts  -->
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-users"></i>
                                            <h6>Main Category</h6>
                                            <span><?=$mains; ?></span>
                                        </div>
                                    </div>     
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-vote-nay"></i>
                                            <h6>Negotiable</h6>
                                            <span><?=$negotiate; ?></span>
                                        </div>
                                    </div>     
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-user-cowboy"></i>
                                            <h6>Active</h6>
                                            <span><?=$active; ?></span>
                                        </div>
                                    </div>   

                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-user-cowboy"></i>
                                            <h6>Email</h6>
                                            <span><?=$email; ?></span>
                                        </div>
                                    </div>    
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-user-cowboy"></i>
                                            <h6>Phone</h6>
                                            <span><?=$phone; ?></span>
                                        </div>
                                    </div>

                                    <?php if(!empty($profiles->website)){?>    
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-user-cowboy"></i>
                                            <h6>Website</h6>
                                            <span><?=$profiles->website; ?></span>
                                        </div>
                                    </div> 
                                    <?php } ?>  

                                    <?php if(!empty($profiles->facebook)){?> 
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-user-cowboy"></i>
                                            <h6>Facebook</h6>
                                            <span><?=$profiles->facebook; ?></span>
                                        </div>
                                    </div> 
                                    <?php } ?>  
                                    <?php if(!empty($profiles->instagram)){?>  
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-user-cowboy"></i>
                                            <h6>Instagram</h6>
                                            <span><?=$profiles->instagram; ?></span>
                                        </div>
                                    </div> 
                                    <?php } ?>  
                                    <?php if(!empty($profiles->twitter)){?>  
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-user-cowboy"></i>
                                            <h6>Twitter</h6>
                                            <span><?=$profiles->twitter; ?></span>
                                        </div>
                                    </div> 
                                    <?php } ?>   
                                    <?php if(!empty($profiles->whatsapp)){?> 
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-user-cowboy"></i>
                                            <h6>Whatsapp</h6>
                                            <span><?=$profiles->whatsapp; ?></span>
                                        </div>
                                    </div>   
                                    <?php } ?>                                                                     
                                </div>
                                <div class="list-single-main-container fl-wrap">
                                    <!-- list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap">
                                        <div class="list-single-main-item-title">
                                            <h3>About This Listing</h3>
                                        </div>
                                        <div class="list-single-main-item_content fl-wrap">
                                            <p><?=ucwords($description); ?></p>
                                        </div>
                                    </div>
                                                                               
                                    <!-- list-single-main-item -->
                                                                       
                                </div>
                            </div>
                        </div>           
                    </div>
                </div>
            </div>
        </div>
    </div>

        
    <!-- <script src="<?php echo site_url(); ?>/assets/js/jquery.min.js"></script> -->
    <script>var site_url = '<?php echo site_url(); ?>';</script>
   
    <script>
        $(function() {
            load('', '');
        });

        function get_state() {
            load();
            var country_id = $('#country_id').val();
            $.ajax({
                url: site_url + 'accounts/account/get_state/' + country_id,
                type: 'post',
                success: function(data) {
                    $('#states_id').html(data);
                }
            });
        }

        function get_city() {
            load();
            var state_id = $('#state_id').val();
            $.ajax({
                url: site_url + 'accounts/account/get_city/' + state_id,
                type: 'post',
                success: function(data) {
                    $('#citys_id').html(data);
                }
            });
        }


        function loads() {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            if(!start_date || !end_date){
                $('#date_resul').css('color', 'Red');
                $('#date_resul').html('Enter Start and End Date!!');
            } else if(start_date > end_date){
                $('#date_resul').css('color', 'Red');
                $('#date_resul').html('Start Date cannot be greater!');
            } else {
                load('', '');
                $('#date_resul').html('');
            }
        }

        function load(x, y) {
            var more = 'no';
            var methods = '';
            if (parseInt(x) > 0 && parseInt(y) > 0) {
                more = 'yes';
                methods = '/' +x + '/' + y;
            }

            if (more == 'no') {
                $('#load_data').html('<div class="col-sm-12 text-center"><br/><br/><br/><br/><i class="fal fa-spinner fa-spin" style="font-size:48px;"></i></div>');
            } else {
                $('#loadmore').html('<div class="col-sm-12 text-center"><i class="fal fa-spinner fa-spin"></i></div>');
            }

            var country_id = $('#country_id').val();
            var state_id = $('#state_id').val();
            var city_id = $('#city_id').val();
            var ban = $('#ban').val();
            var search = $('#search').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            $.ajax({
                url: site_url + 'accounts/user/load' + methods,
                type: 'post',
                data: { ban: ban,start_date: start_date,end_date: end_date,search: search,city_id: city_id,state_id: state_id,country_id: country_id },
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
    </script>   
<?php echo $this->endSection(); ?>