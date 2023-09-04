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
                        <img src="<?=site_url(); ?>assets/images/avatar.png" alt="">
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
                    
                    <?php echo form_open_multipart('profile/index/update', array('id'=>'bb_ajax_form', 'class'=>'')); ?>
                    <div class="dasboard-widget-box nopad-dash-widget-box fl-wrap">
                        <div class="edit-profile-photo">
                            <img id="img0" style="height:80px;width:80px" src="<?=site_url($img); ?>" class="respimg" alt="">
                            <input type="hidden" name="img" value="<?php if(!empty($img)){echo $img;} ?>" />
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
                            <input type="text" name="fullname" value="<?=$fullname; ?>" required/>
                            <label>Email Address <span class="dec-icon"><i class="far fa-envelope"></i></span></label>
                            <input type="text" name="email" placeholder="AlicaNoory@domain.com" required value="<?=$email;?>"/>	
                            <label>Date of Birth </label>
                            <input type="date" name="date" class="form-control" required value="<?=$dob; ?>"/>
                            
                            <label>Phone<span class="dec-icon"><i class="far fa-phone"></i> </span></label>
                            <input type="text" name="phone" placeholder="+7(123)987654" required value="<?=$phone; ?>"/>	
                            <label>Adress <span class="dec-icon"><i class="fas fa-map-marker"></i> </span></label>
                            <input type="text" name="address" placeholder="USA 27TH Brooklyn NY" value="<?=$address;?>"/>										
                            <label>Website <span class="dec-icon"><i class="far fa-globe"></i> </span></label>
                            <?php
                                $website = '';
                                $facebook = '';
                                $twitter = '';
                                $instagram = '';
                                $tiktok = '';
                                if(!empty($social)){
                                    $website = $social->website;
                                    $facebook = $social->facebook;
                                    $twitter = $social->twitter;
                                    $instagram = $social->instagram;
                                    $tiktok = $social->tiktok;
                                    
                                }
                            ?>
                            <input type="text" name="website" placeholder="koomeli.com" value="<?=$website; ?>"/>										
                            <label>Facebook  <span class="dec-icon"><i class="fab fa-facebook"></i></span></label>
                            <input type="text" name="facebook" placeholder="https://www.facebook.com/" value="<?=$facebook; ?>"/>
                            <label>Twitter <span class="dec-icon"><i class="fab fa-twitter"></i></span></label>
                            <input type="text" name="twitter" placeholder="https://twitter.com/" value="<?=$twitter; ?>"/>
                            <label>Instagram<span class="dec-icon"><i class="fab fa-instagram"></i>  </span></label>
                            <input type="text" name="instagram" placeholder="https://www.instagram.com/" value="<?=$instagram; ?>"/>	
                            <label>Tiktok<span class="dec-icon"><i class="fab fa-tiktok"></i>  </span></label>
                            <input type="text" name="tiktok" placeholder="https://tiktok.com/" value="<?=$tiktok; ?>"/>										
                            <button class="btn btn-primary d-block mb-5">Save Changes</button>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><div id="bb_ajax_msg"></div></div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <div class="dasboard-widget-title dbt-mm fl-wrap">
                        <h5><i class="fal fa-money-check"></i> Bank Information</h5>
                    </div>
                    <div class="dasboard-widget-box fl-wrap mb-5">
                        <?php echo form_open_multipart('profile/index/bank', array('id'=>'bb_ajax_form2', 'class'=>'', 'clear'=>'true')); ?>
                        <div class="row">
                            <div class="col-sm-12"><div id="bb_ajax_msg2"></div></div>
                        </div>
                        <div class="custom-form">
                            <label>Bank</label>
                            <div class="listsearch-input-item mb-2">
                                <select data-placeholder="Select" name="bank_code" id="bank_code" required class="mb-2 chosen-select search-select">
                                    <option value="">Select Bank</option>
                                    <?php
                                        $bank = $this->Crud->read_order('bank', 'name', 'asc');
                                       if(!empty($bank)){
                                            foreach($bank as $b){
                                                $sel = '';
                                                if(!empty($bank_details)){
                                                    if(!empty($bank_details->bank_code)){
                                                        if($bank_details->bank_code == $b->code)$sel = 'selected';
                                                    }
                                                }
                                                echo '<option value="'.$b->code.'" '.$sel.'>'.$b->name.'</option>';
                                            }
                                       }
                                       $acc_no = '';$acc_name = '';
                                       if(!empty($bank_details)){
                                            if(!empty($bank_details->account_number)){
                                                $acc_no = $bank_details->account_number;
                                                $acc_name = $bank_details->account_name;
                                            }
                                        }
                                    ?>
                                </select>
                                
                            </div>
                            <label>Account Number <span class="dec-icon"><i class="fas fa-user-circle"></i> </span></label>
                            <input type="text" name="account_number" placeholder="0000000000" required minlength="10" value="<?=$acc_no; ?>"/>
                            <label class="text-center text-danger font-weight-bold" style="font-size:14px;"><?=strtoupper($acc_name); ?></label>
                            <button class="btn    color-bg  float-btn">Save Changes</button>
                        </div>
                        </form>
                    </div>
                    <div class="dasboard-widget-title dbt-mm fl-wrap">
                        <h5><i class="fas fa-key"></i>Change Password</h5>
                    </div>
                    <div class="dasboard-widget-box fl-wrap">
                        <?php echo form_open_multipart('profile/index/password', array('id'=>'bb_ajax_form3', 'class'=>'', 'clear'=>'true')); ?>
                        <div class="row">
                            <div class="col-sm-12"><div id="bb_ajax_msg3"></div></div>
                        </div>
                        <div class="custom-form">
                            <div class="pass-input-wrap fl-wrap">
                                <label>Current Password<span class="dec-icon"><i class="far fa-lock-open-alt"></i></span></label>
                                <input type="password" name="cur_password" class="pass-input" placeholder="" required/>
                                <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                            </div>
                            <div class="pass-input-wrap fl-wrap">
                                <label>New Password<span class="dec-icon"><i class="far fa-lock-alt"></i></span></label>
                                <input type="password" name="password" class="pass-input" placeholder="" required/>
                                <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                            </div>
                            <div class="pass-input-wrap fl-wrap">
                                <label>Confirm New Password<span class="dec-icon"><i class="far fa-shield-check"></i> </span></label>
                                <input type="password" name="confirm" class="pass-input" placeholder="" required/>
                                <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                            </div>
                            <button class="btn    color-bg  float-btn">Save Changes</button>
                        </div>
                        </form>
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