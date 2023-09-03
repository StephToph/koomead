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

		if($param1 == 'update'){
			if($this->request->getMethod() == 'post') {
				$email = $this->request->getVar('email');
				$fullname = $this->request->getVar('fullname');
				$phone = $this->request->getVar('phone');
				$dob = $this->request->getVar('date');
				$address = $this->request->getVar('address');
				$website = $this->request->getVar('website');
				$facebook = $this->request->getVar('facebook');
				$instagram = $this->request->getVar('instagram');
				$twitter = $this->request->getVar('twitter');
				$tiktok = $this->request->getVar('tiktok');
				$img = $this->request->getVar('img');
	
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
				
				 /// upload image
				 if(file_exists($this->request->getFile('pics'))) {
					$path = 'assets/images/user/';
					$file = $this->request->getFile('pics');
					$getImg = $this->Crud->img_upload($path, $file);
					$img = $getImg->path;
				}

				$social = [];
				$social['website'] = $website;
				$social['facebook'] = $facebook;
				$social['instagram'] = $instagram;
				$social['twitter'] = $twitter;
				$social['tiktok'] = $tiktok;
				
				// update profile
				$upd_data['email'] = $email;
				$upd_data['fullname'] = $fullname;
				$upd_data['phone'] = $phone;
				$upd_data['dob'] = $dob;
				$upd_data['address'] = $address;
				$upd_data['img_id'] = $img;
				$upd_data['social'] = json_encode($social);

				if($this->Crud->updates('id', $log_id, 'user', $upd_data) > 0) {
					echo $this->Crud->msg('success', 'Record Updated');
				} else {
					echo $this->Crud->msg('info', 'No Changes');
				}
	
				die;
			}

		}

		if($param1 == 'password'){
			if($this->request->getMethod() == 'post') {
				$cur_password = $this->request->getVar('cur_password');
				$password = $this->request->getVar('password');
				$confirm = $this->request->getVar('confirm');
				
				if(!$cur_password || !$password) {
					echo $this->Crud->msg('danger', 'Current/New Password field(s) missing');
					die;
				}
	
				if($this->Crud->check2('id', $log_id,'password', md5($cur_password), 'user') == 0) {
					echo $this->Crud->msg('warning', 'Incorrect Password');
					die;
				}
	
				if($password != $confirm) {
					echo $this->Crud->msg('danger', 'Password does not match, Try Again');
					die;
				}
				
				
				// update profile
				$upd_data['password'] = md5($password);
				
				if($this->Crud->updates('id', $log_id, 'user', $upd_data) > 0) {
					echo $this->Crud->msg('success', 'Password Updated and will take Effect on Next Login');
					echo '<script>$("#cur_password").val("");$("#password").val("");$("#confirm").val("");</script>';
				} else {
					echo $this->Crud->msg('info', 'No Changes');
				}
	
				die;
			}

		}
        

		$data['email'] = $this->Crud->read_field('id', $log_id, 'user', 'email');
		$data['fullname'] = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
        $data['phone'] = $this->Crud->read_field('id', $log_id, 'user', 'phone');
       	$data['dob'] = $this->Crud->read_field('id', $log_id, 'user', 'dob');
		$data['address'] = $this->Crud->read_field('id', $log_id, 'user', 'address');
        $data['country_id'] = $this->Crud->read_field('id', $log_id, 'user', 'country_id');
		$data['state_id'] = $this->Crud->read_field('id', $log_id, 'user', 'state_id');
		$data['city_id'] = $this->Crud->read_field('id', $log_id, 'user', 'city_id');
		$img = $this->Crud->read_field('id', $log_id, 'user', 'img_id');
		if(empty($img)) $img = 'assets/images/avatar.png';
        $data['img'] = $img;
        $data['social'] = json_decode($this->Crud->read_field('id', $log_id, 'user', 'social'));
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
