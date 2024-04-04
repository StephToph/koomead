<?php

namespace App\Controllers;

class Auth extends BaseController {
    public function index() {
        return $this->login();
    }

    ///// LOGIN
    public function login() {
        // check login
        $log_id = $this->session->get('km_id');
        // if(!empty($log_id)) return redirect()->to(site_url('dashboard'));
        $redir = $this->session->get('km_redirect');
		

        if($this->request->getMethod() == 'post') {
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            if(!$email || !$password) {
                echo $this->Crud->msg('danger', 'Please provide Email and Password');
            } else {
                // check user login detail
                $user_id = $this->Crud->read_field2('email', $email, 'password', md5($password), 'user', 'id');
                if(empty($user_id)) {
                    echo $this->Crud->msg('danger', 'Invalid Authentication!');
                } else {
                    if($this->Crud->check2('id', $user_id, 'activate', 0, 'user') > 0){
                        echo $this->Crud->msg('danger', 'Account not Activated! Please verify your Email to activate your account.');
                    } else {
                        ///// store activities
                        $code = $this->Crud->read_field('id', $user_id, 'user', 'fullname');
                        $action = $code.' logged into Account ';
                        $this->Crud->activity('authentication', $user_id, $action);
                        $this->session->set('km_location', '');
                        echo $this->Crud->msg('success', 'Login Successful!');
                        $this->session->set('km_id', $user_id);
                        $redirs = 'dashboard';
                        
                        echo '<script>window.location.replace("'.site_url($redirs).'");</script>';

                    }
                    
                }
            }

            die;
        }
        
        $data['title'] = 'Log In | '.app_name;
        return view('auth/login', $data);
    }

    public function register() {
        if($this->request->getMethod() == 'post') {
            $fullname = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $user_role = 3;
            $password = $this->request->getPost('password');
            $phone = $this->request->getPost('phone');
            $otp = $this->request->getPost('otp');
            $agree = $this->request->getPost('agree');
            $country_id = $this->request->getPost('country_id');
            $state_id = $this->request->getPost('state_id');
            $address = $this->request->getPost('address');


            $Error = '';
			if($this->Crud->check('email', $email, 'user') > 0) {$Error .= 'Email Taken <br/>';}
			if($this->Crud->check('phone', $phone, 'user') > 0) {$Error .= 'Phone Number Taken <br/>';}

			if(empty($agree)) {$Error .= 'You must agree to Terms and Conditions';}
            

			if($Error) {
				echo $this->Crud->msg('danger', $Error);
				die;
			}

            $ins_data['fullname'] = $fullname;
			$ins_data['email'] = $email;
			$ins_data['role_id'] = $user_role;
			$ins_data['phone'] = $phone;
			$ins_data['country_id'] = $country_id;
			$ins_data['state_id'] = $state_id;
			$ins_data['address'] = $address;
			$ins_data['activate'] = 0;
			$ins_data['password'] = md5($password);
			$ins_data['reg_date'] = date(fdate);

			$ins_id = $this->Crud->create('user', $ins_data);
			if($ins_id > 0) {
                echo $this->Crud->msg('success', 'Account Created<br>Account Verified<br>You can Login now');
                $body = "Dear ".$fullname.",<br>
                    <p>Thank you for creating an account with ".app_name.". We're thrilled to have you on board!</p>
                    <p>A verification Email has been Sent to your email.</p>
                    Thank you for choosing ".app_name." <p>Once your email is verified, you'll have full access to all the features of ".app_name.".</p>
                    <p>Best regards</p>";
                 $this->Crud->send_email($email, 'Welcome Message', $body);

                 $body = "Dear ".$fullname.",<br>
                 <p>Welcome ".$fullname.", Thank you for creating an account with ".app_name.".</p>
                 <p><a href='".site_url('auth/verify/'.$ins_id)."'>Click this link to Verify Account</a></p>
               
                 <p>Best regards</p>";
                $this->Crud->send_email($email, 'Verification Email', $body);

				// echo '<script>location.reload(false);</script>';
			} else {
				echo $this->Crud->msg('danger', 'Please Try Again Later');
			}

			die;
        }
        // $data['form_link'] = base_url('auth/register');
        
        // $data['title'] = 'Register | '.app_name;
        // return view('auth/register', $data);
    }

    public function account($param1='', $param2=''){
        if($param1 == 'get_state'){
            if(empty($param2)){
                $st =  '<option value="">Select Country First</option>';
            } else {
                $state = $this->Crud->read_single_order('country_id', $param2, 'state', 'name', 'asc');
                if(!empty($state)){
                    $st =  '<option value="">Select State</option>';
                    foreach ($state as $s) {
                        $st .= '<option value="'.$s->id.'">'.$s->name.'</option>';
                    }
                } else {
                    $st =  '<option value="">Select Country First</option>';
                }
            }
            echo '
                <select data-placeholder="Select" name="state_id" id="state_ids" required onchange="get_city();" class="mb-2 chosen-selects search-select" >
                    '.$st.'
                </select><script>$(".chosen-selects").niceSelect();</script>
            ';die;
        }

        if($param1 == 'get_city'){
            if(empty($param2)){
                $st =  '<option value="">Select State First</option>';
            } else {
                $state = $this->Crud->read_single_order('state_id', $param2, 'city', 'name', 'asc');
                if(!empty($state)){
                    $st =  '<option value="">Select City</option>';
                    foreach ($state as $s) {
                        $st .= '<option value="'.$s->id.'">'.$s->name.'</option>';
                    }
                }  else {
                    $st =  '<option value="">Select State First</option>';
                }
            }
            echo $st;
            die;
        }

        if($param1 == 'get_category'){
            if(empty($param2)){
                $st =  '<option value="">Select Category First</option>';
            } else {
                $state = $this->Crud->read_single_order('category_id', $param2, 'category', 'name', 'asc');
                if(!empty($state)){
                    $st =  '<option value="">Select Sub Category</option>';
                    foreach ($state as $s) {
                        $st .= '<option value="'.$s->id.'">'.$s->name.'</option>';
                    }
                }
            }
            echo '<div class="listsearch-input-item mb-2">
                <select data-placeholder="Select" name="sub_id" id="sub_id" required class="mb-2 chosen-select" >
                    '.$st.'
                </select></div><script>$("#sub_id").niceSelect();</script>
            ';die;
        }

        if($param1 == 'verify_email'){
            $param2 = $this->request->getPost('email');
            if(!empty($param2)){
                if($this->Crud->check('email', $param2, 'user') > 0){
                    echo '<span class="text-danger">Email Already Exist.</span>
                    <script>$("#otp_input").hide(500);</script>
                    ';
                } else {
                    $datas['email'] = $param2;
                    $code = substr(md5(time().rand()), 0, 6);
                    $datas['otp'] = $code;
                    $status = false;
    
                    if($this->Crud->check('email', $param2, 'otp') == 0){
                        $ins = $this->Crud->create('otp', $datas);
                        if($ins > 0){
                            $status = true;
                        }
                    } else {
                        $ins = $this->Crud->updates('email', $param2, 'otp', $datas);
                        if($ins > 0){
                            $status = true;
                        }
                    }
    
                    if($status == true){
                        // email content
                        $subject = 'Email Confirmation';
                        $body = 'Your Email Verification Code is '.$code.'. If you do not request this action, please ignore. Thank you.';
                        $em = $this->Crud->send_email($param2, $subject, $body);
                        if($em > 0){
                            echo '<span class="text-success">OTP Email Sent</span>
                                <script>$("#otp_input").show(500);
                                $("#register_btn").prop("disabled", false);</script>
                            ';
                        }
                    }  

                }
                
            }
        }
    }
    ///// LOGOUT
    public function logout() {
        if (!empty($this->session->get('km_id'))) {
            $user_id = $this->session->get('km_id');
            ///// store activities
            $code = $this->Crud->read_field('id', $user_id, 'user', 'fullname');
            $action = $code . ' logged out from Account';
            $this->Crud->activity('authentication', $user_id, $action);

            $this->session->remove('km_id');
        }
        session()->destroy();
        return redirect()->to(site_url());
    }

    public function password($param1='', $param2=''){
        if($param1 == 'forgot'){
            if($this->request->getMethod() == 'post'){
                $email = $this->request->getVar('email');
                $codes = $this->request->getVar('code');
                $password = $this->request->getVar('pwd');

                if(!empty($email) && empty($codes)){
                    if($this->Crud->check('email', $email, 'user') == 0){
                        echo $this->Crud->msg('danger', 'Invalid Email');
                        die;
                    } else {
                        $code = substr(md5(time().rand()), 0, 6);
                        if($this->Crud->updates('email', $email, 'user', array('reset'=>$code)) > 0) {
                            $fullname = $this->Crud->read_field('email', $email, 'user', 'fullname');

                            // email content
                            $bcc = '';
                            $subject = 'Reset Code';
                            $body = '<span style="font-size:18px">You requested to reset your account password. Your secret code is <b>'.$code.'.</b> If you do not request this action, please ignore. Your account will be protected. Thank you.</span>';
                            $em = $this->Crud->send_email($email, $subject, $body);
                            if($em){
                                echo $this->Crud->msg('success', 'Reset Code Sent to your Email!');
                                echo '<script>$("#code_resp").show(500);$("#password_resp").hide();$("#pwd").val("");</script>';
                            } else {
                                echo $this->Crud->msg('danger', 'Please Try again Later!');
                            }
                            
                        }
                    }die;
                }

                if(!empty($email) && !empty($codes) && empty($password)){
                    if($this->Crud->check('email', $email, 'user') == 0){
                        echo $this->Crud->msg('danger', 'Invalid Email');
                        die;
                    } else {
                        $cod = $this->Crud->read_field('email', $email, 'user', 'reset');
                        if($cod != $codes){
                            echo $this->Crud->msg('danger', 'Invalid Reset Code<br>Try Again');
                        } else{
                            echo $this->Crud->msg('success', 'Reset Code Accepted<br>Enter New Password');
                            echo '<script>$("#password_resp").show(500);$("#code_resp").hide(500);$("#pwd").val("");</script>';
                        }
                    }die;
                }

                if(!empty($email) && !empty($codes) && !empty($password)){
                    if($this->Crud->check('email', $email, 'user') == 0){
                        echo $this->Crud->msg('danger', 'Invalid Email');
                        die;
                    } else {
                        $id = $this->Crud->read_field2('email',$email, 'reset', $codes, 'user', 'id');
                        if($this->Crud->updates('id', $id, 'user', array('password'=>md5($password),'reset'=>'')) > 0){
                            echo $this->Crud->msg('success', 'Password reset Successfully.<br>Please Login now');
                            echo '<script>$("#password_resp").hide(500);$("#code_resp").hide(500);$("#forgot_tab").hide(5000);
                            $("#register_tab").show(5000);$("#email").val("");$("#code").val("");$("#pwd").val("");$("#bb_ajax_msg3").html("");</script> ';
                        } else {
                            echo $this->Crud->msg('danger', 'Error. Try Again');
                        }
                        
                    } die;
                }
            }
        }
    }

    Public function verify($param1){
        if(!empty($param1)){
            if($this->Crud->check('id', $param1, 'user')>0){
                $this->Crud->updates('id', $param1, 'user', array('activate'=>1, 'email_verify'=>1));
                echo '<h3>Account Verified. Logging in Now</h3>';
                $this->session->set('km_id', $param1);
                $redirs = 'dashboard';
                
                echo '<script>window.location.replace("'.site_url($redirs).'");</script>';
       
            }
        } else{
            echo '<script>window.location.replace("'.site_url('').'");</script>';
        }
    }
}
