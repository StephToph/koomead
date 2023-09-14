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
                    ///// store activities
					$code = $this->Crud->read_field('id', $user_id, 'user', 'fullname');
					$action = $code.' logged into Account ';
					$this->Crud->activity('authentication', $user_id, $action);
                    $this->session->set('km_location', '');
                    echo $this->Crud->msg('success', 'Login Successful!');
                    $this->session->set('km_id', $user_id);
                    if($redir == ''){
                        $redirs = 'dashboard';
                    } else {
                        $redirs = $redir;
                    }
                    echo '<script>window.location.replace("'.site_url($redirs).'");</script>';
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
            $agree = $this->request->getPost('agree');
            $country_id = $this->request->getPost('country_id');
            $state_id = $this->request->getPost('state_ids');
            $city_id = $this->request->getPost('city_id');

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
			$ins_data['city_id'] = $city_id;
			$ins_data['activate'] = 1;
			$ins_data['password'] = md5($password);
			$ins_data['reg_date'] = date(fdate);

			$ins_id = $this->Crud->create('user', $ins_data);
			if($ins_id > 0) {
				echo $this->Crud->msg('success', 'Account Created, You can now Sign In');
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
            echo '<div class="listsearch-input-item mb-2">
                <select data-placeholder="Select" name="city_id" id="city_id" required class="mb-2 chosen-selec search-select" >
                    '.$st.'
                </select></div><script>$(".chosen-selec").niceSelect();</script>
            ';die;
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
}
