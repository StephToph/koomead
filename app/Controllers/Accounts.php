<?php

namespace App\Controllers;

class Accounts extends BaseController {
	private $db;

    public function __construct() {
		$this->db = \Config\Database::connect();
	}


    //// PARENTS
    public function user($param1='', $param2='', $param3='') {
        // check login
        $log_id = $this->session->get('km_id');
        if(empty($log_id)) return redirect()->to(site_url(''));
		
        $this->session->set('km_redirect', uri_string());
        $role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
        $role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
        $role_c = $this->Crud->module($role_id, 'accounts/user', 'create');
        $role_r = $this->Crud->module($role_id, 'accounts/user', 'read');
        $role_u = $this->Crud->module($role_id, 'accounts/user', 'update');
        $role_d = $this->Crud->module($role_id, 'accounts/user', 'delete');
        if($role_r == 0){
            return redirect()->to(site_url('profile'));	
        }

        $data['log_id'] = $log_id;
        $data['role'] = $role;
        $data['role_c'] = $role_c;

        $table = 'user';

		$form_link = site_url('accounts/user/');
		if($param1){$form_link .= $param1.'/';}
		if($param2){$form_link .= $param2.'/';}
		if($param3){$form_link .= $param3.'/';}
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$data['form_link'] = rtrim($form_link, '/');
		
		$log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
        $data['log_name'] = $log_name;
        $data['page'] = 'Users';
       
		// manage record
		if($param1 == 'manage') {
			// prepare for delete
			if($param2 == 'delete') {
				if($param3) {
					$edit = $this->Crud->read_single('id', $param3, $table);
					if(!empty($edit)) {
						foreach($edit as $e) {
							$data['d_id'] = $e->id;
						}
					}

					if($this->request->getMethod() == 'post'){
						$del_id = $this->request->getVar('d_user_id');
						if($this->Crud->deletes('id', $del_id, $table) > 0) {
							
							echo $this->Crud->msg('success', 'Record Deleted');
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('danger', 'Please try later');
						}	
						exit;	
					}
				}
			} else {
				// prepare for edit
				if($param2 == 'edit') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['e_id'] = $e->id;
								$data['e_activate'] = $e->activate;
								$data['e_email'] = $e->email;
							}
						}
					}
				}// prepare for edit
				if($param2 == 'view') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['id'] = $e->id;
								$data['activate'] = $e->activate;
								$data['email'] = $e->email;
								$data['fullname'] = $e->fullname;
								$data['phone'] = $e->phone;
								$data['address'] = $e->address;
								$data['dob'] = $e->dob;
								$data['country_id'] = $e->country_id;
								$data['state_id'] = $e->state_id;
								$data['city_id'] = $e->city_id;
								$data['role_id'] = $e->role_id;
								if(!empty($e->img_id)){$img = $e->img_id;} else{$img ='assets/images/avatar.png';}
								$data['img_id'] = $img;
								$data['social'] = json_decode($e->social);
								$data['bank_details'] = $e->bank_details;
								$data['reg_date'] = $e->reg_date;
							}
						}
					}
				}

				if($this->request->getMethod() == 'post'){
					$user_id = $this->request->getVar('user_id');
					$ban = $this->request->getVar('ban');
					$password = $this->request->getVar('password');

					$ins_data['activate'] = $ban;
					if(!empty($password))$ins_data['password'] = md5($password);
					$role_id = $this->Crud->read_field('name', 'User', 'access_role', 'id');
				
					// do create or update
					if ($user_id) {
						$upd_rec = $this->Crud->updates('id', $user_id, $table, $ins_data);
						if ($upd_rec > 0) {
							///// store activities
							$code = $this->Crud->read_field('id', $user_id, $table, 'fullname');
							$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
							$action = $by.' updated User '.$code.' Record';
							$this->Crud->activity('account', $user_id, $action);

							echo $this->Crud->msg('success', 'Record Updated');
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info', 'No Changes');
						}
					}
					die;	
				}
			}
		}

        // record listing
		if($param1 == 'load') {
			$limit = $param2;
			$offset = $param3;

			$rec_limit = 25;
			$item = '';
			$counts = 0;

			if(empty($limit)) {$limit = $rec_limit;}
			if(empty($offset)) {$offset = 0;}
			
			if(!empty($this->request->getPost('state_id'))) { $state_id = $this->request->getPost('state_id'); } else { $state_id = '0'; }
			if(!empty($this->request->getPost('country_id'))) { $country_id = $this->request->getPost('country_id'); } else { $country_id = '0'; }
			if(!empty($this->request->getPost('city_id'))) { $city_id = $this->request->getPost('city_id'); } else { $city_id = '0'; }
			if(!empty($this->request->getPost('business'))) { $business = $this->request->getPost('business'); } else { $business = '0'; }
			if(!empty($this->request->getPost('promoted'))) { $promoted = $this->request->getPost('promoted'); } else { $promoted = '0'; }
			if(!empty($this->request->getPost('ban'))) { $ban = $this->request->getPost('ban'); } else { $ban = '0'; }
			$search = $this->request->getPost('search');
			if (!empty($this->request->getPost('start_date'))) {$start_date = $this->request->getPost('start_date');} else {$start_date = '';}
			if (!empty($this->request->getPost('end_date'))) {$end_date = $this->request->getPost('end_date');} else {$end_date = '';}
			$log_id = $this->session->get('km_id');
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$all_rec = $this->Crud->filter_user('', '', $log_id, $search, $ban, $business, $promoted, $start_date, $end_date, $country_id, $state_id, $city_id);
				if(!empty($all_rec)) { $counts = count($all_rec); } else { $counts = 0; }
				$query = $this->Crud->filter_user($limit, $offset, $log_id, $search, $ban, $business, $promoted, $start_date, $end_date, $country_id, $state_id, $city_id);

				if(!empty($query)) {
					foreach($query as $q) {
						$id = $q->id;
						$fullname = $q->fullname;
						$email = $q->email;
						$phone = $q->phone;
						$role_id = $q->role_id;
						$country_id = $q->country_id;
						$state_id = $q->state_id;
						$has_promoted = $q->has_promoted;
						$has_business = $q->has_business;
						$city_id = $q->city_id;
						$ban = $q->activate;
						$reg_date = date('M d, Y h:i A', strtotime($q->reg_date));
						$avatar = $q->img_id;
						if(empty($avatar)){
							$avatar = 'assets/images/avatar.png';
						}
						
						if($ban > 0){
							$b = '<span class="text-success small font-weight-bold font-size-12">ACCOUNT ACTIVE</span>';
						} else {
							$b = '<span class="text-danger small font-weight-bold font-size-12">ACCOUNT BANNED</span>';
						}

						$country = $this->Crud->read_field('id', $country_id, 'country', 'name');
						$state = $this->Crud->read_field('id', $state_id, 'state', 'name');
						$city = $this->Crud->read_field('id', $city_id, 'city', 'name');
						$role = $this->Crud->read_field('id', $role_id, 'access_role', 'name');
						$list = $this->Crud->check('user_id', $id, 'listing');
						
						$loca = '';
						if(!empty($country_id)) $loca .= $country;
						if(!empty($state_id)) $loca .= '&#8594; '.$state;
						if(!empty($city_id)) $loca .= '<br>&#8594; '.$city;

						$business = '<span class="text-danger small mb-2 font-weight-bold font-size-12">NO BUSINESS</span>';
						if($has_business > 0)$business = '<span class="text-success small mb-2 font-weight-bold font-size-12">HAS BUSINESS</span>';
						$promoted = '<span class="text-danger small mb-2 font-weight-bold font-size-12">NO PROMOTION</span>';
						if($has_promoted > 0)$promoted = '<span class="text-success small mb-2 font-weight-bold font-size-12">HAS PROMOTION</span>';
						
						// add manage buttons
						if($role_u != 1) {
							$all_btn = ''.$business.'<br> '.$promoted.'';
						} else {
							$all_btn = '
								<div class="text-right">
									'.$business.'<br> '.$promoted.'<br><br>
									<a href="javascript:;" class="text-info pop mt-2 mb-5 mr-1" pageTitle="Edit '.$fullname.' Details" pageName="'.site_url('accounts/user/manage/edit/'.$id).'" pageSize="modal-md">
										<i class="fal fa-pen-alt"></i> EDIT
									</a>
									<a href="javascript:;" class="text-danger pop mb-5 ml-1  mr-1" pageTitle="Delete '.$fullname.' Record" pageName="'.site_url('accounts/user/manage/delete/'.$id).'" pageSize="modal-sm">
										<i class="fal fa-trash"></i> DELETE
									</a>
									<a href="'.site_url('accounts/user/manage/view/'.$id).'" class="text-success mb-5 ml-1" pageTitle="View '.$fullname.' User" pageName="" pageSize="modal-lg">
										<i class="fal fa-eye"></i> VIEW
									</a>
									
								</div>
							';
						}
						
						$sub = '';
						$item .= '
							<li class="list-group-item">
								<div class="row p-2">
									<div class="col-3 col-md-1">
										<img alt="" src="'.site_url($avatar).'"  class="p-1 rounded-circle" height="70" width="70"/>
									</div>
							
									<div class="col-9 col-md-4 mb-4">
										<div class="single">
											<div class="text-muted font-size-12">'.$reg_date.'</div>
											<b class="font-size-16 text-primary">'.strtoupper($fullname).'</b>
											<div class="small text-muted">'.$phone.'</div>
											<div class="small text-email">'.$email.'</div>
											'.$b.'
										</div>
									</div>
									<div class="col-12 col-md-4 mb-4">
										<b class="font-size-16 text-primary">'.ucwords($role).'</b>
										<div class="font-size-14 text-danger ">'.$list.' Listing(s)</div>
										<div class="font-size-14 text-dark ">'.$loca.'</div>
									</div>
									<div class="col-12 col-md-3">
										
										<b class="font-size-12">'.$all_btn.'</b>
									</div>
								</div>
							</li>
						';
					}
				}
			}
			
			if(empty($item)) {
				$resp['item'] = '
					<div class="text-center text-muted">
						<br/><br/><br/><br/>
						<i class="fal fa-users" style="font-size:150px;"></i><br/><br/>No User Returned
					</div>
				';
			} else {
				$resp['item'] = $item;
			}

			$resp['count'] = $counts;

			$more_record = $counts - ($offset + $rec_limit);
			$resp['left'] = $more_record;

			if($counts > ($offset + $rec_limit)) { // for load more records
				$resp['limit'] = $rec_limit;
				$resp['offset'] = $offset + $limit;
			} else {
				$resp['limit'] = 0;
				$resp['offset'] = 0;
			}

			echo json_encode($resp);
			die;
		}
		
        if($param1 == 'manage') { // view for form data posting
			if($param2 == 'view'){ 
				$data['page'] = 'User View';
       
				$data['title'] = 'User View | '.app_name;
            	$data['page_active'] = 'accounts/user';
				return view('account/user_view', $data);
			} else{
			return view('account/user_form', $data);

			}
		} else { // view for main page
            $data['title'] = 'User | '.app_name;
            $data['page_active'] = 'accounts/user';
            return view('account/user', $data);
        }
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
            echo '<div class="listsearch-input-item mb-2">
                <select data-placeholder="Select" name="state_id" id="state_id"  required onchange="get_city();" class="mb-2 chosen-select search-select" >
                    '.$st.'
                </select></div><script>$("#state_id").niceSelect();</script>
            ';
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
                }
            }
            echo '<div class="listsearch-input-item mb-2">
                <select data-placeholder="Select" name="city_id" id="city_id" onchange="load()" required class="mb-2 chosen-select search-select" >
                    '.$st.'
                </select></div><script>$("#city_id").niceSelect();</script>
            ';
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
            ';
        }
    }

	
}
