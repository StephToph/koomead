<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>

<?php echo $this->extend('designs/backend'); ?>
<?php echo $this->section('title'); ?>
    <?php echo $title; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<!-- content -->	
<div class="dashboard-content">
    <div class="dashboard-menu-btn color-bg"><span><i class="fas fa-bars"></i></span>Dasboard Menu</div>
    <div class="container dasboard-container">
        <!-- dashboard-title -->	
        <div class="dashboard-title fl-wrap">
            <div class="dashboard-title-item"><span><?=$page; ?></span></div>
            <div class="dashbard-menu-header">
                <div class="dashbard-menu-avatar fl-wrap">
                    <img src="<?=site_url(); ?>assets/images/avatar/5.jpg" alt="">
                    <h4>Welcome, <span><?=$log_name;?></span></h4>
                </div>
                <a href="<?=site_url('auth/logout');?>" class="log-out-btn   tolt" data-microtip-position="bottom"  data-tooltip="Log Out"><i class="far fa-power-off"></i></a>
            </div>
            
                            
        </div>
        <!-- dashboard-title end -->
        <!-- dasboard-wrapper-->
        <div class="dasboard-wrapper fl-wrap no-pag">
            <div class="row">
                <div class="col-md-7">
                    <div class="dasboard-widget-title fl-wrap">
                        <h5><i class="fas fa-user-circle"></i>Change Avatar</h5>
                    </div>
                    
                    <?php echo form_open_multipart('profile', array('id'=>'bb_ajax_form', 'class'=>'')); ?>
                    <div class="dasboard-widget-box nopad-dash-widget-box fl-wrap">
                        <div class="edit-profile-photo">
                            <img id="img0" style="height:80px;width:80px" src="<?=site_url(); ?>assets/images/avatar.png" class="respimg" alt="">
                            
                        </div>
                        <div class="bg-wrap bg-parallax-wrap-gradien">
                            <div class="bg"  data-bg="<?=site_url(); ?>assets/images/bg/3.jpg"></div>
                        </div>
                        <div class="change-photo-btn cpb-2  ">
                            <div class="photoUpload color-bg">
                                <span> <i class="far fa-camera"></i> Change Profile Photo </span>
                                <input type="file" class="upload" name="pics" id="img-upload">
                            </div>
                        </div>
                    </div>
                    <div class="dasboard-widget-title fl-wrap">
                        <h5><i class="fas fa-key"></i>Personal Info</h5>
                    </div>
                    <div class="dasboard-widget-box fl-wrap">
                        <div class="custom-form">
                            <label>Full Name <span class="dec-icon"><i class="far fa-user"></i></span></label>
                            <input type="text" name="fullname" value="<?=$fullname; ?>"/>
                            <label>Email Address <span class="dec-icon"><i class="far fa-envelope"></i></span></label>
                            <input type="text" name="email" placeholder="AlicaNoory@domain.com" value="<?=$email;?>"/>	
                            <label>Date of Birth </label>
                            <input type="date" name="date" class="form-control" value="<?=$dob; ?>"/>
                            
                            <label>Phone<span class="dec-icon"><i class="far fa-phone"></i> </span></label>
                            <input type="text" name="phone" placeholder="+7(123)987654" value="<?=$phone; ?>"/>	
                            <label>Adress <span class="dec-icon"><i class="fas fa-map-marker"></i> </span></label>
                            <input type="text" name="address" placeholder="USA 27TH Brooklyn NY" value="<?=$address;?>"/>										
                            <label>Website <span class="dec-icon"><i class="far fa-globe"></i> </span></label>
                            <input type="text" placeholder="themeforest.net" value=""/>										
                            <label>Facebook  <span class="dec-icon"><i class="fab fa-facebook"></i></span></label>
                            <input type="text" placeholder="https://www.facebook.com/" value=""/>
                            <label>Twitter <span class="dec-icon"><i class="fab fa-twitter"></i></span></label>
                            <input type="text" placeholder="https://twitter.com/" value=""/>
                            <label>Instagram<span class="dec-icon"><i class="fab fa-instagram"></i>  </span></label>
                            <input type="text" placeholder="https://www.instagram.com/" value=""/>	
                            <label>Tiktok<span class="dec-icon"><i class="fab fa-tiktok"></i>  </span></label>
                            <input type="text" placeholder="https://vk.com/" value=""/>										
                            <button class="btn    color-bg  float-btn">Save Changes</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="dasboard-widget-title dbt-mm fl-wrap">
                        <h5><i class="fas fa-key"></i>Change Password</h5>
                    </div>
                    <div class="dasboard-widget-box fl-wrap">
                        <div class="custom-form">
                            <div class="pass-input-wrap fl-wrap">
                                <label>Current Password<span class="dec-icon"><i class="far fa-lock-open-alt"></i></span></label>
                                <input type="password" class="pass-input" placeholder="" value=""/>
                                <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                            </div>
                            <div class="pass-input-wrap fl-wrap">
                                <label>New Password<span class="dec-icon"><i class="far fa-lock-alt"></i></span></label>
                                <input type="password" class="pass-input" placeholder="" value=""/>
                                <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                            </div>
                            <div class="pass-input-wrap fl-wrap">
                                <label>Confirm New Password<span class="dec-icon"><i class="far fa-shield-check"></i> </span></label>
                                <input type="password" class="pass-input" placeholder="" value=""/>
                                <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                            </div>
                            <button class="btn    color-bg  float-btn">Save Changes</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        
    
    <script src="<?php echo site_url(); ?>assets/js/jsform.js"></script>
    <script>
        function readURL(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#' + id).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#img-upload").change(function(){
            readURL(this, 'img0');
        });
    </script>
<?php echo $this->endSection(); ?>