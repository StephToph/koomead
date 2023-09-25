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
    <?php 
            $user_id = $param2;
            
            $user = $this->Crud->read_field('id', $user_id, 'user', 'fullname');
            $user_mail = $this->Crud->read_field('id', $user_id, 'user', 'email');
            $user_phone = $this->Crud->read_field('id', $user_id, 'user', 'phone');
            $address = $this->Crud->read_field('id', $user_id, 'user', 'address');
            $city_id = $this->Crud->read_field('id', $user_id, 'user', 'city_id');
            $country_id = $this->Crud->read_field('id', $user_id, 'user', 'country_id');
            $state_id = $this->Crud->read_field('id', $user_id, 'user', 'state_id');
            $social = json_decode($this->Crud->read_field('id', $user_id, 'user', 'social'));
            $user_img = $this->Crud->read_field('id', $user_id, 'user', 'img_id');
            if(empty($user_img))$user_img = 'assets/images/avatar.png';

            $website = '';
            $socials = '';
            if(!empty($social)){
                $website = $social->website;
                $facebook = $social->facebook;
                $twitter = $social->twitter;
                $instagram = $social->instagram;
                $tiktok = $social->tiktok;

                if(!empty($website))$socials .= ' <li><a href="'.$website.'" target=""><i class="fal fa-browser"></i></a></li>';
                if(!empty($facebook))$socials .= ' <li><a href="'.$facebook.'" target=""><i class="fab fa-facebook"></i></a></li>';
                if(!empty($twitter))$socials .= ' <li><a href="'.$twitter.'" target=""><i class="fab fa-twitter"></i></a></li>';
                if(!empty($instagram))$socials .= ' <li><a href="'.$instagram.'" target=""><i class="fab fa-instagram"></i></a></li>';
                if(!empty($tiktok))$socials .= ' <li><a href="'.$tiktok.'" target=""><i class="fab fa-vk"></i></a></li>';

                
            }
            
            $country = $this->Crud->read_field('id', $country_id, 'country', 'name');
            $state = $this->Crud->read_field('id', $state_id, 'state', 'name');
            $city = $this->Crud->read_field('id', $city_id, 'city', 'name');
            
            $loca = '';
            if(!empty($address)) $loca .= $address.', ';
            if(!empty($city_id)) $loca .= $city;
            if(!empty($state_id)) $loca .= ', '.$state;
            if(!empty($country_id)) $loca .= ', '.$country;
            
            $view = $this->Crud->read_single('user_id', $user_id, 'listing');
            $views = 0;
            if(!empty($view)){
                foreach($view as $v){
                    $link = 'home/listing/view/'.$v->id;
                    $views += (int)$this->Crud->check('page', $link, 'listing_view');
                }
            }
            $listing = $this->Crud->check('user_id', $user_id, 'listing');
            
        ?>
    <!-- breadcrumbs-->
    <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap   top-smpar  ">
        <div class="container">
            <div class="breadcrumbs-list">
                <a href="<?=site_url(); ?>">Home</a><a href="<?=site_url('search'); ?>">Businesses</a> <span><?=strtoupper($user); ?></span>
            </div>
        </div>
    </div>
    <!-- breadcrumbs end -->
    <!-- col-list-wrap -->
    <section class="gray-bg small-padding ">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-info smpar fl-wrap">
                       <div class="bg-wrap bg-parallax-wrap-gradien">
                            <div class="bg"  data-bg="<?=site_url(); ?>assets/images/bg/8.jpg"></div>
                        </div>
                        <div class="card-info-media">
                            <div class="bg"  data-bg="<?=site_url($user_img); ?>"></div>
                        </div>
                        <div class="card-info-content">
                            <div class="agent_card-title fl-wrap">
                                <h4> <?=strtoupper($user); ?> </h4>
                            </div>
                            <div class="list-single-stats">
                                <ul class="no-list-style">
                                    <li><span class="viewed-counter"><i class="fas fa-eye"></i> Viewed -  <?=$views;?> </span></li>
                                    <li><span class="bookmark-counter"><i class="fas fa-sitemap"></i> Listings -  <?=$listing;?> </span></li>
                                </ul>
                            </div>
                            <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Verified"><i class="fal fa-user-check"></i></div>
                        </div>
                    </div>
                    <div class="list-single-main-container fl-wrap">
                        <!-- list-single-main-item -->
                        <div class="list-single-main-item fl-wrap">
                            <div class="list-single-main-item_content fl-wrap">
                                <div class="list-single-tags fl-wrap tags-stylwrap" style="margin-top: 20px;">
                                    <span>Service Areas:</span>
                                    <a href="javascript:;"><?=$country; ?></a>
                                    <a href="javascript:;"><?=$state; ?></a>
                                    <a href="javascript:;"><?=$city; ?></a>
                                </div>
                            </div>
                        </div>
                        <!-- list-single-main-item end -->             						
                    </div>
                    <!-- content-tabs-wrap -->
                    <div class="content-tabs-wrap tabs-act fl-wrap">
                        <div class="content-tabs fl-wrap">
                            <ul class="tabs-menu fl-wrap no-list-style">
                                <li class="current"><a href="#tab-listing">  Listing  </a></li>
                            </ul>
                        </div>
                        <!--tabs -->                       
                        <div class="tabs-container">
                            <!--tab -->
                            <div class="tab">
                                <div id="tab-listing" class="tab-content first-tab">
                                    <!-- listing-item-wrap-->
                                    <div class="listing-item-container one-column-grid-wrap  box-list_ic fl-wrap" id="load_data">
                                        
                                        <!-- listing-item end-->								
                                    </div>
                                    <!-- listing-item-wrap end-->
                                    <!-- pagination-->
                                    <div class="pagination" id="loadmore">
                                       
                                    </div>
                                    <!-- pagination end-->						
                                </div>
                            </div>
                           							
                        </div>
                        <!--tabs end-->  
                    </div>
                    <!-- content-tabs-wrap end -->
                </div>
                <!-- col-md 8 end -->
                <!--  sidebar-->
                <div class="col-md-4">
                    <!--box-widget-->
                    <div class="box-widget bwt-first fl-wrap">
                        <div class="box-widget-title fl-wrap box-widget-title-color color-bg no-top-margin">Business Contacts</div>
                        <div class="box-widget-content fl-wrap">
                            <div class="contats-list clm fl-wrap">
                                <ul class="no-list-style">
                                    <li><span><i class="fal fa-phone"></i> Phone :</span> <a href="#"><?=$user_phone; ?></a></li>
                                    <li><span><i class="fal fa-envelope"></i> Mail :</span> <a href="#"><?=$user_mail; ?></a></li>
                                    <li><span><i class="fal fa-map-marker"></i> Adress :</span> <a href="#"> <?=$address; ?></a></li>
                                </ul>
                            </div>
                            <div class="profile-widget-footer fl-wrap">
                                <div class="card-info-content_social ">
                                    <ul>
                                        <?=$socials; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--box-widget end --> 									
                    <!--box-widget-->
                    <div class="box-widget fl-wrap">
                        <div class="box-widget-fixed-init fl-wrap" id="sec-contact">
                            <div class="box-widget-title fl-wrap box-widget-title-color color-bg">Message Business</div>
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
                <!--   sidebar end-->								
            </div>
        </div>
        <div class="limit-box fl-wrap"></div>
    </section>
</div>
        
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
                $('#load_data').html('<div class="col-sm-12 text-center"><br/><br/><br/><br/><i class="fal fa-spinner fa-spin" style="font-size:48px;"></i></div>');
            } else {
                $('#loadmore').html('<div class="col-sm-12 text-center"><i class="fal fa-spinner fa-spin"></i></div>');
            }

            var user_id = <?=$param2; ?>;

            $.ajax({
                url: site_url + 'home/profile/load' + methods,
                type: 'post',
                data: { user_id: user_id },
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