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
            <div class="dasboard-listing-box fl-wrap">
                <div class="row  mb-5">
                    <div class="geodir-category-content fl-wrap">
                        <div class="col-12 text-tart ">
                            <div class="content-tabs-wrap tabs-act fl-wrap">
                                <div class="content-tabs fl-wrap">
                                    <ul class="tabs-menu fl-wrap no-list-style">
                                        <li class="current"><a href="#tab-profile"> <i class="fal fa-id-card-alt" style="font-size:24px;"></i>  Profile  </a></li>
                                        <li><a href="#tab-listing"> <i class="fal fa-user-tie" style="font-size:24px;"></i> My Listings</a></li>
                                        <li><a href="#tab-p_listing"> <i class="fal fa-business-time" style="font-size:24px;"></i>  Listings Promoted</a></li>
                                        <li><a href="#tab-message"> <i class="fal fa-envelope-open-text" style="font-size:24px;"></i> Messages</a></li>
                                    </ul>
                                </div>
                                <!--tabs -->                       
                                <div class="tabs-container">
                                    <!--tab -->
                                    <div class="tab">
                                        <div id="tab-profile" class="tab-content first-tab">
                                            <!-- listing-item-wrap-->
                                            <div class="listing-item-container one-column-grid-wrap  box-list_ic fl-wrap">
                                                <!-- listing-item -->
                                                <div class="listing-item">
                                                    <article class="geodir-category-listing fl-wrap">
                                                        <div class="row" style="padding:10px;">
                                                            <section class="graybg small-padding ">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-md-7">
                                                                            <div class="card-info smpar fl-wrap ">
                                                                                <div class="bg-wrap bg-parallax-wrap-gradien">
                                                                                    <div class="bg"  data-bg="<?=site_url(); ?>assets/images/bg/8.jpg"></div>
                                                                                </div>
                                                                                <div class="card-info-media">
                                                                                    <div class="bg"  data-bg="<?=site_url($img_id); ?>"></div>
                                                                                </div>
                                                                                <div class="card-info-content">
                                                                                    <div class="agent_card-title fl-wrap">
                                                                                        <h4> <?=strtoupper($fullname); ?> </h4>
                                                                                        <div class="geodir-category-location fl-wrap">
                                                                                            <h5><a href="javascript:;"><?=$this->Crud->read_field('id', $role_id, 'access_role', 'name'); ?></a></h5>
                                                                                           
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="list-single-stats">
                                                                                        <ul class="no-list-style">
                                                                                            <li><span class="viewed-counter"><i class="fas fa-eye"></i> Viewed -  0 </span></li>
                                                                                            <li><span class="bookmark-counter"><i class="fas fa-comment-alt"></i> Reviews -  0 </span></li>
                                                                                            <li><span class="bookmark-counter"><i class="fas fa-sitemap"></i> Listings -  0 </span></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <!-- <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Verified"><i class="fal fa-user-check"></i></div> -->
                                                                                </div>
                                                                            </div>
                                                                            <div class="list-single-main-container fl-wrap mb-3">
                                                                                <!-- list-single-main-item -->
                                                                                <div class="list-single-main-item fl-wrap">
                                                                                    <div class="list-single-main-item-title">
                                                                                        <h3>About This Agent</h3>
                                                                                    </div>
                                                                                    <div class="list-single-main-item_content fl-wrap">
                                                                                        <?php if(!empty($country_id)){
                                                                                            $country = $this->Crud->read_field('id', $country_id, 'country', 'name');
                                                                                        ?>
                                                                                        <div class="list-single-tags fl-wrap tags-stylwrap" style="margin-top: 10px;">
                                                                                            <span>Country:</span>
                                                                                            <a href="javascript:;"><?=$country; ?></a>
                                                                                        </div>
                                                                                        <?php } ?>
                                                                                        
                                                                                        <?php if(!empty($state_id)){
                                                                                            $state = $this->Crud->read_field('id', $state_id, 'state', 'name');
                                                                                        ?>
                                                                                        <div class="list-single-tags fl-wrap tags-stylwrap" style="margin-top: 10px;">
                                                                                            <span>State:</span>
                                                                                            <a href="javascript:;"><?=$state; ?></a>
                                                                                        </div>
                                                                                        <?php } ?>
                                                                                        
                                                                                        <?php if(!empty($city_id)){
                                                                                            $city = $this->Crud->read_field('id', $city_id, 'city', 'name');
                                                                                        ?>
                                                                                        <div class="list-single-tags fl-wrap tags-stylwrap" style="margin-top: 10px;">
                                                                                            <span>City:</span>
                                                                                            <a href="javascript:;"><?=$city; ?></a>
                                                                                        </div>
                                                                                        <?php } ?>
                                                                                        
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                                <!-- list-single-main-item end -->             						
                                                                            </div>
                                                                            
                                                                            
                                                                            <!-- content-tabs-wrap end -->
                                                                        </div>
                                                                        <!-- col-md 8 end -->
                                                                        <!--  sidebar-->
                                                                        <div class="col-md-5">
                                                                            <!--box-widget-->
                                                                            <div class="box-widget bwt-first fl-wrap">
                                                                                <div class="box-widget-title fl-wrap box-widget-title-color color-bg no-top-margin">User Details</div>
                                                                                <div class="box-widget-content fl-wrap">
                                                                                    <div class="contats-list clm fl-wrap">
                                                                                        <ul class="no-list-style">
                                                                                            <li><span><i class="fal fa-envelope"></i> Mail :</span> <a href="javascript:;"><?=$email; ?></a></li>
                                                                                            <li><span><i class="fal fa-phone"></i> Phone :</span> <a href="javascript:;"><?=$phone; ?></a></li>
                                                                                            <li><span><i class="fal fa-map-marker"></i> Adress :</span> <a href="javascript:;"> <?=$address; ?></a></li>
                                                                                            
                                                                                            <li><span><i class="fal fa-calendar-alt"></i> Date of Birth :</span> <a href="javascript:;"><?php if(!empty($dob))echo date('d F, Y', strtotime($dob)); ?></a></li>
                                                                                            <li><span><i class="fal fa-calendar-plus"></i> Reg Date :</span> <a href="javascript:;"><?=date('d F, Y H:ia', strtotime($reg_date)) ?></a></li>
                                                                                            <li><span><i class="fal fa-browser"></i> Website :</span> <a href="javascript:;"><?php if(!empty($social) && !empty($social->website)) echo $social->website; ?></a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="profile-widget-footer fl-wrap">
                                                                                        <div class="card-info-content_social ">
                                                                                            <ul>
                                                                                                <?php 
                                                                                                    if(!empty($social)){
                                                                                                ?>
                                                                                                <?php  if(!empty($social->facebook)){?><li><a href="<?=$social->facebook; ?>" ><i class="fab fa-facebook-f"></i></a></li><?php } ?>
                                                                                                <?php  if(!empty($social->twitter)){?><li><a href="<?=$social->twitter; ?>" ><i class="fab fa-twitter"></i></a></li><?php } ?>
                                                                                                <?php  if(!empty($social->twitter)){?><li><a href="<?=$social->instagram; ?>" ><i class="fab fa-instagram"></i></a></li><?php } ?>
                                                                                                <?php  if(!empty($social->tiktok)){?><li><a href="<?=$social->tiktok; ?>" ><i class="fab fa-vk"></i></a></li><?php } ?>
                                                                                                
                                                                                                <?php } ?>
                                                                                            </ul>
                                                                                        </div>
                                                                                        <!-- <a href="#sec-contact" class="custom-scroll-link tolt csls" data-microtip-position="left" data-tooltip="Write Message"><i class="fal fa-paper-plane"></i></a> -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--box-widget end --> 									
                                                                            <!--box-widget-->         									
                                                                        </div>
                                                                        <!--   sidebar end-->								
                                                                    </div>
                                                                </div>
                                                                <div class="limit-box fl-wrap"></div>
                                                            </section>
                                                        </div>
                                                    </article>
                                                </div>								
                                            </div>
                                            <!-- listing-item-wrap end-->
                                            					
                                        </div>
                                    </div>
                                    <!--tab  end-->
                                    <!--tab -->
                                    <div class="tab">
                                        <div id="tab-listing" class="tab-content">
                                            <div class="list-single-main-container fl-wrap" style="margin-top: 30px;">
                                                <!-- list-single-main-item -->
                                                <div class="text-center text-muted mb-3">
                                                    <br/><br/><br/><br/>
                                                    <i class="fal fa-user-tie" style="font-size:150px;"></i><br/><br/>No Listing Returned
                                                </div>										
                                            </div>
                                        </div>
                                    </div>
                                    <!--tab end-->	
                                    <div class="tab">
                                        <div id="tab-p_listing" class="tab-content">
                                            <div class="list-single-main-container fl-wrap" style="margin-top: 30px;">
                                                <div class="text-center text-muted mb-3">
                                                    <br/><br/><br/><br/>
                                                    <i class="fal fa-business-time" style="font-size:150px;"></i><br/><br/>No Listing Promoted
                                                </div>        										
                                            </div>
                                        </div>
                                    </div>
                                    <!--tab end-->	
                                    <div class="tab">
                                        <div id="tab-message" class="tab-content">
                                            <div class="list-single-main-container fl-wrap" style="margin-top: 30px;">
                                                <div class="text-center text-muted mb-3">
                                                    <br/><br/><br/><br/>
                                                    <i class="fal fa-envelope-open-text" style="font-size:150px;"></i><br/><br/>No Message
                                                </div>            										
                                            </div>
                                        </div>
                                    </div>
                                    <!--tab end-->							
                                </div>
                                <!--tabs end-->  
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