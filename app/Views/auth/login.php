<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>


    <div class="main-register-holder tabs-act">
        <div class="main-register-wrapper modalmain fl-wrap">
            <div class="main-register-header color-bg">
                <div class="main-register-logo fl-wrap">
                    <img src="<?=site_url();?>assets/images/white-logo.png" alt="">
                </div>
                <div class="main-register-bg">
                    <div class="mrb_pin"></div>
                    <div class="mrb_pin mrb_pin2"></div>
                </div>
                <div class="mrb_dec"></div>
                <div class="mrb_dec mrb_dec2"></div>
            </div>
            <div class="main-register">
                <div id="register_tab">
                    <ul class="tabs-menu fl-wrap no-list-style">
                        <li  id="link-1" class="current"><a href="#tab-1" onclick="login();"><i class="fal fa-sign-in-alt"></i> Login</a></li>
                        <li id="link-2"><a href="#tab-2" onclick="logins();"><i class="fal fa-user-plus"></i> Register</a></li>

                    </ul>
                    <!--tabs -->
                    <div class="tabs-container">
                        <div class="tab">
                            <!--tab -->
                            <div id="tab-1" class="tab-content first-tab">
                                <div class="row py-1">
                                    <div class="col-sm-12">
                                        <div id="bb_ajax_msg"></div>
                                    </div>
                                </div>
                                <div class="custom-form">
                                    <?php echo form_open_multipart('auth/login', array('id'=>'bb_ajax_form', 'class'=>'')); ?>
                                    <label>Email Address * <span class="dec-icon"><i class="fal fa-user"></i></span></label>
                                    <input name="email" type="text" placeholder="Your Email" onClick="this.select()" value="">
                                    <div class="pass-input-wrap fl-wrap">
                                        <label>Password * <span class="dec-icon"><i class="fal fa-key"></i></span></label>
                                        <input name="password" id="password" placeholder="Your Password" type="password"  autocomplete="off" onClick="this.select()" value="">
                                        <span class="eye" id="toggle-button"><i class="fal fa-eye"></i> </span>
                                    </div>
                                    <div class="lost_password">
                                        <a href="javascript:;" onclick="forgots()">Reset your Password?</a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <button type="submit" class="log_btn color-bg bb_form_btn"> LogIn </button>
                                    </form>
                                </div>
                            </div>


                            <div id="tab-2" class="tab-content"  style="display:none;">
                                
                                <div class="customform">
                                    <?php echo form_open_multipart('auth/register', array('id'=>'bb_ajax_form2', 'class'=>'text-start')); ?>
                                        <div class="form-group mb-3">
                                            <label>Full Name *</label>
                                            <input name="name" type="text" class="form-control" placeholder="Your Name" required  onClick="this.select()" value="">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Email Address * </label>
                                            <input name="email" type="email" id="email" class="form-control" placeholder="Your Mail" required  onClick="this.select()" value="">
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label>Phone Number * </label>
                                            <input name="phone" type="text" class="form-control" placeholder="Your Phone Number" required onClick="this.select()" value="">
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label>Country *</label>
                                            <select data-placeholder="Select" name="country_id" id="country_id"  required class="mb-2 form-select search-select"  onchange="get_state();">
                                                <?php
                                                    $country = $this->Crud->read_order('country', 'name', 'asc');
                                                    if(!empty($country)){
                                                        foreach($country as $c){
                                                            if($c->name != 'Nigeria')continue;
                                                            echo '<option value="'.$c->id.'">'.$c->name.'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        
                                        
                                        <div class="form-group mb-3">
                                            <label>State of Residence *</label>
                                            <select data-placeholder="Select" name="state_id" id="state_i" required class="mb-2 form-select search-select" onchange="get_citys()">
                                                <option value="">Select State</option>
                                                <?php
                                                    $country = $this->Crud->read_single_order('country_id', 161, 'state', 'name', 'asc');
                                                    if(!empty($country)){
                                                        foreach($country as $c){                                                            
                                                            echo '<option value="'.$c->id.'">'.$c->name.'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group mb-5">
                                            <div class="pass-input-wrap fl-wrap">
                                                <label>Password *</label>
                                                <input name="password" type="password" id="passwords" class="form-control"  placeholder="Your Password" autocomplete="off" required onClick="this.select()" value="">
                                                <span class="eye" id="toggle-buttons" style="margin-bottom:-4% !important;"><i class="fal fa-eye"></i> </span>
                                            </div>
                                        </div>


                                        <div class="form-group mt-3 mb-5">
                                           
                                            <div class="col-md-8 my-3" style="display:none;" id="otp_input">
                                                <input name="otp" type="password" class="form-control" id="otp" placeholder="Your OTP" autocomplete="off"  onClick="this.select()" value="">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="filter-tags ft-list my-5">
                                            <input id="check-a2" type="checkbox" name="agree">
                                            <label for="check-a2">I agree to the <a href="javascript:;">Privacy  Policy</a> and <a href="javascript:;">Terms and  Conditions</a></label>
                                        </div>
                                        <div class="clearfix"></div>
                                        <button type="submit" class="btn btn-block btn-primary color-bg bb_form_btn" id="register_btn" > Register </button>
                                    </form>
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-12">
                                        <div id="bb_ajax_msg2"></div>
                                    </div>
                                </div>
                            </div>
                            <!--tab end -->
                        </div>
                    </div>
                </div>

                <div id="forgot_tab" style="display:none;">
                    <!--tabs -->
                    <div class="container" style="padding:35px;">
                        <div class="row py-1">
                            <div class="col-sm-12">
                                <div id="bb_ajax_msg3"></div>
                            </div>
                        </div>
                        <div class="custom-form">

                            <?php echo form_open_multipart('auth/password/forgot', array('id'=>'bb_ajax_form3', 'class'=>'')); ?>
                                <label>Email Address * <span class="dec-icon"><i class="fal fa-envelope"></i></span></label>
                                <input name="email" id="email" type="email" placeholder="Your Mail"  autocomplete="off" onClick="this.select()" required value="">
                                <div id="code_resp" style="display:none">
                                    <label>Reset Code * <span class="dec-icon"><i class="fal fa-envelope"></i></span></label>
                                    <input name="code" id="code" type="text" placeholder="Reset Code"  onClick="this.select()" value="">

                                </div>
                                <div id="password_resp" style="display:none">
                                    <div class="pass-input-wrap fl-wrap">
                                        <label>New Password * <span class="dec-icon"><i class="fal fa-key"></i></span></label>
                                        <input name="pwd" id="pwd" type="password" placeholder="New Password" autocomplete="off" onClick="this.select()" value="">
                                        <span class="eye"><i class="fal fa-eye"></i> </span>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <button type="submit" class="log_btn color-bg bb_orm_btn"> Reset </button>
                            </form>
                            <div class="lost_password">
                                <a href="javascript:;" onclick="register()">Return to Login</a>
                            </div>
                        </div>
                        <!--tab end -->
                    </div>

                </div>
            </div>

        </div>
                                                        
    </div>
    
<script src="<?=site_url();?>assets/js/jsform.js"></script>

<script>
    $(function() {
        $(".chosen-select").niceSelect();
    });
</script>
<script>
    var site_url = '<?php echo site_url(); ?>';

    function verify_email(){
        var email = $('#email').val();
        $('#otp_input').hide(500);
        if(email == ''){
            $('#otp_response').html('<span class="text-danger">Enter Email First for Account Verification</span>');
            $('#otp_input').hide(500);
        } else {
            $('#otp_response').html('Sending OTP Code...');
            $.ajax({
                url: site_url + 'auth/account/verify_email',
                type: 'post',
                data: {email : email},
                type: 'post',
                success: function(data) {
                    $('#otp_response').html(data);
                }
            });
        }
    }

    function get_state() {
        var country_id = $('#country_id').val();
        $.ajax({
            url: site_url + 'auth/account/get_state/' + country_id,
            type: 'post',
            success: function(data) {
                $('#states_id').html(data);
            }
        });
    }

    function logins() {
        $('#tab-2').show(500);
        $('#tab-1').hide(500);
        $('#link-2').addClass('current');
        $('#link-1').removeClass('current');

    }

    function login() {
        $('#tab-1').show(500);
        $('#tab-2').hide(500);
        $('#link-1').addClass('current');
        $('#link-2').removeClass('current');

    }

    
    function forgots() {
        $('#forgot_tab').show(500);
        $('#register_tab').hide(500);

    }

    function register() {
        $('#forgot_tab').hide(500);
        $('#register_tab').show(500);

    }


    function get_citys() {
        var state_id = $('#state_i').val();
        // console.log(state_id);
        $.ajax({
            url: site_url + 'auth/account/get_city/' + state_id,
            type: 'post',
            success: function(data) {
                $('#citys_id').html(data);
            }
        });
    }
    function togglePasswordVisibility() {
        const passwordInput = $('#password');
        if (passwordInput.attr('type') === 'password') {
            // Change input type to text to show the password
            passwordInput.attr('type', 'text');
        } else {
            // Change input type back to password to hide the password
            passwordInput.attr('type', 'password');
        }
    }

    $(document).ready(function() {
        const toggleButton = $('#toggle-button');

        toggleButton.on('click', function() {
            togglePasswordVisibility();
        });
    });
    function togglePasswordVisibilitys() {
        const passwordInput = $('#passwords');
        if (passwordInput.attr('type') === 'password') {
            // Change input type to text to show the password
            passwordInput.attr('type', 'text');
        } else {
            // Change input type back to password to hide the password
            passwordInput.attr('type', 'password');
        }
    }

    $(document).ready(function() {
        const toggleButton = $('#toggle-buttons');

        toggleButton.on('click', function() {
            togglePasswordVisibilitys();
        });
    });
</script>