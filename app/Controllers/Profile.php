<?php

namespace App\Controllers;

class Profile extends BaseController {
    public function index($param1='', $param2='', $param3='') {
        // check login
        $log_id = $this->session->get('km_id');
        if(empty($log_id)) return redirect()->to(site_url(''));

        $role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
        $role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
        $main_email = $this->Crud->read_field('id', $log_id, 'user', 'email');
		$log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
        $data['log_name'] = $log_name;
        $data['page'] = 'My Profile';
       
        $data['log_id'] = $log_id;
        $data['role'] = $role;

		$table = 'user';

		$form_link = site_url('profile/index/');
		if($param1){$form_link .= $param1.'/';}
		if($param2){$form_link .= $param2.'/';}
		if($param3){$form_link .= $param3.'/';}
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$data['form_link'] = rtrim($form_link, '/');

        if($this->request->getMethod() == 'post') {
			$email = $this->request->getVar('email');
			$fullname = $this->request->getVar('fullname');
            $phone = $this->request->getVar('phone');

			if(!$email || !$fullname) {
				echo $this->Crud->msg('danger', 'Email, Fullname field(s) missing');
				die;
			}

			if($email != $main_email) {
				if($this->Crud->check('email', $email, 'user') > 0) {
					echo $this->Crud->msg('danger', 'Email already taken, try another');
					die;
				}
			}

			// update profile
			$upd_data['email'] = $email;
			$upd_data['fullname'] = $fullname;
            $upd_data['phone'] = $phone;
			if($this->Crud->updates('id', $log_id, 'user', $upd_data) > 0) {
				echo $this->Crud->msg('success', 'Record Updated');
			} else {
				echo $this->Crud->msg('info', 'No Changes');
			}

			die;
		}

		$data['email'] = $this->Crud->read_field('id', $log_id, 'user', 'email');
		$data['fullname'] = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
        $data['phone'] = $this->Crud->read_field('id', $log_id, 'user', 'phone');
       	$data['dob'] = $this->Crud->read_field('id', $log_id, 'user', 'dob');
		$data['address'] = $this->Crud->read_field('id', $log_id, 'user', 'address');
        $data['country_id'] = $this->Crud->read_field('id', $log_id, 'user', 'country_id');
		$data['state_id'] = $this->Crud->read_field('id', $log_id, 'user', 'state_id');
		$data['city_id'] = $this->Crud->read_field('id', $log_id, 'user', 'city_id');
        $data['img_id'] = $this->Crud->read_field('id', $log_id, 'user', 'img_id');
        $data['social'] = $this->Crud->read_field('id', $log_id, 'user', 'social');
		$data['bank_details'] = $this->Crud->read_field('id', $log_id, 'user', 'bank_details');
       
        $data['title'] = 'Profile | '.app_name;
        $data['page_active'] = 'profile';
        return view('profile/profile', $data);
    }

    public function password() {
		// check login
        $log_id = $this->session->get('km_id');
        if(empty($log_id)) return redirect()->to(site_url('auth'));

        $data['log_id'] = $log_id;

		if($this->request->getMethod() == 'post') {
			$old = $this->request->getVar('old');
			$new = $this->request->getVar('new');
			$confirm = $this->request->getVar('confirm');

			if($this->Crud->check2('id', $log_id, 'password', md5($old), 'user') <= 0) {
				echo $this->Crud->msg('danger', 'Current Password not correct');
			} else {
				if($new != $confirm) {
					echo $this->Crud->msg('info', 'New and Confirm Password not matched');
				} else {
					if($this->Crud->updates('id', $log_id, 'user', array('password'=>md5($new))) > 0) {
						echo $this->Crud->msg('success', 'Password changed successfully');
					} else {
						echo $this->Crud->msg('danger', 'Please try later');
					}
				}
			}

			die;
		}

		$data['title'] =  'Change Password | '.app_name;
		$data['page_active'] = 'profile';

		return view('profile/password', $data);
	}
}
