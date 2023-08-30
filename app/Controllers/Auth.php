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

                    echo $this->Crud->msg('success', 'Login Successful!');
                    $this->session->set('km_id', $user_id);
                    echo '<script>window.location.replace("'.site_url('dashboard').'");</script>';
                }
            }

            die;
        }
        
        // $data['title'] = 'Log In | '.app_name;
        // return view('auth/login', $data);
    }

    public function register() {
        if($this->request->getMethod() == 'post') {
            $fullname = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $user_role = 3;
            $password = $this->request->getPost('password');
            $phone = $this->request->getPost('phone');
            $agree = $this->request->getPost('agree');

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
			$ins_data['actiate'] = 1;
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
                }
            }
            echo '
                <select data-placeholder="Select" name="state_id" id="state_id" required onchange="get_city();" class="mb-2 chosen-select search-select" >
                    '.$st.'
                </select>
            ';
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
}
