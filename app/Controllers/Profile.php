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
				$back_img = $this->request->getVar('back_img');
	
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

				 /// upload image
				 if(file_exists($this->request->getFile('back_pics'))) {
					$path = 'assets/images/user/';
					$file = $this->request->getFile('back_pics');
					$getImg = $this->Crud->img_upload($path, $file);
					$back_img = $getImg->path;
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
				$upd_data['back_img'] = $back_img;
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
        
		if($param1 == 'bank'){
			if($this->request->getMethod() == 'post') {
				$bank_code = $this->request->getVar('bank_code');
				$account_number = $this->request->getVar('account_number');
				$paypal = $this->request->getVar('paypal');
				
				
				
				if(!empty($paypal)){
					$banks = [];
					$banks['paypal'] = $paypal;

					$upd_data['bank_details'] = json_encode($banks);
					if($this->Crud->updates('id', $log_id, 'user', $upd_data) > 0) {
						echo $this->Crud->msg('success', 'Bank Information Updated');
					} else {
						echo $this->Crud->msg('info', 'No Changes');
					}
				}

				if($bank_code && $account_number){
					$valid = $this->Crud->validate_account($account_number, $bank_code);
					$valids = json_decode($valid);
					if($valids->status == 'true'){
						$acc_name = $valids->data->account_name;
						if(!empty($acc_name)){
							$banks = [];
							$banks['bank_code'] = $bank_code;
							$banks['account_number'] = $account_number;
							$banks['account_name'] = $acc_name;

							$upd_data['bank_details'] = json_encode($banks);
							$msg = 'Bank Account Validated.<br> <b>'.$acc_name.'</b><br>Bank Details Updated';
							if($this->Crud->updates('id', $log_id, 'user', $upd_data) > 0) {
								echo $this->Crud->msg('success', $msg);
								// Create Transfer Recipient 
								$recps = [
									"type" =>"nuban",
									"name"=>$acc_name,
									"bank_code"=>$bank_code,
									"account_number"=>$account_number,
									"currency"=>"NGN"
								];
								
								$cre = $this->Crud->create_recipient($recps);
								$credit = json_decode($cre);
								if($credit->status == 'true'){
									$recp_id = $credit->data->id;
									$recp_code = $credit->data->recipient_code;

									$trans['recp_id'] = $recp_id;
									$trans['recipient_code'] = $recp_code;

									if($this->Crud->check('user_id', $log_id, 'transfer_recipient') == 0){
										
										$trans['user_id'] = $log_id;
										$this->Crud->create('transfer_recipient', $trans);
									} else {
										$this->Crud->updates('user_id', $log_id, 'transfer_recipient', $trans);

									}
									
								}
							} else {
								echo $this->Crud->msg('info', 'No Changes');
							}

							
						} else {
							echo $this->Crud->msg('danger', 'Account not Found');
						}
					} else {
						echo $this->Crud->msg('danger', 'Invalid Account Details');
					}
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
        $back_img = $this->Crud->read_field('id', $log_id, 'user', 'back_img');
		if(empty($back_img)) $back_img = 'assets/images/bg/3.jpg';
        $data['back_img'] = $back_img;
        $data['social'] = json_decode($this->Crud->read_field('id', $log_id, 'user', 'social'));
		$data['bank_details'] = json_decode($this->Crud->read_field('id', $log_id, 'user', 'bank_details'));
       
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

	public function get_bank(){
		$bank = $this->Crud->rave_banks();
		
		$banks = json_decode($bank);
		print_r($bank);
		if(!empty($banks->data)){
			foreach ($banks->data as $b) {
				$in['bank_id'] = $b->id;
				$in['code'] = $b->code;
				$in['name'] = $b->name;
				
				if($this->Crud->check2('bank_id', $b->id, 'code', $b->code, 'bank') > 0){continue;}else{
					$this->Crud->create('bank', $in);
				}
			}
		}
	}
}
