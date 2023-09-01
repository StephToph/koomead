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
						$del_id = $this->request->getVar('d_parent_id');
						if($this->Crud->deletes('id', $del_id, $table) > 0) {
							if($this->Crud->check('parent_id', $del_id,  'child') > 0){
								$child = $this->Crud->read_single('parent_id',$del_id,  'child');
								if(!empty($child)){
									foreach($child as $c){
										 $this->Crud->deletes('id', $c->id, 'child');
									}
								}
							}
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
								$data['e_fullname'] = $e->fullname;
								$data['e_phone'] = $e->phone;
								$data['e_email'] = $e->email;
								$data['e_pin'] = $e->pin;
								$data['e_ban'] = $e->ban;
							}
						}
					}
				}

				if($this->request->getMethod() == 'post'){
					$user_id = $this->request->getVar('user_id');
					$fullname = $this->request->getVar('fullname');
					$email = $this->request->getVar('email');
					$phone = $this->request->getVar('phone');
					$pin = $this->request->getVar('pin');
					$ban = $this->request->getVar('ban');
					$password = $this->request->getVar('password');

					// echo $pin;die;
					$ins_data['fullname'] = $fullname;
					$ins_data['email'] = $email;
					$ins_data['phone'] = $phone;
					$ins_data['pin'] = $pin;
					$ins_data['ban'] = $ban;
					if(!empty($password))$ins_data['password'] = md5($password);
					$role_id = $this->Crud->read_field('name', 'User', 'access_role', 'id');
				
					// do create or update
					if ($user_id) {
						$upd_rec = $this->Crud->updates('id', $user_id, $table, $ins_data);
						if ($upd_rec > 0) {
							///// store activities
							$code = $this->Crud->read_field('id', $user_id, $table, 'fullname');
							$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
							$action = $by.' updated Parent '.$code.' Record';
							$this->Crud->activity('account', $user_id, $action);

							echo $this->Crud->msg('success', 'Record Updated');
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info', 'No Changes');
						}
					} else {
						if($this->Crud->check('email', $email, 'user') > 0){
							echo $this->Crud->msg('danger', 'Email Already Taken');
						} elseif($this->Crud->check('phone', $phone, 'user') > 0){
							echo $this->Crud->msg('danger', 'Phone Number Already Taken');
						} else{
							$ins_data['reg_date'] = date(fdate);
							$ins_data['role_id'] = $role_id;

							$user_id = $this->Crud->create('user', $ins_data);
							if($user_id > 0) {
								///// store activities
								$action = $fullname.' created an Account';
								$this->Crud->activity('account', $user_id, $action);

								echo $this->Crud->msg('success', 'Record Created');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('info', 'No Changes');
							}
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
			
			if(!empty($this->request->getPost('ban'))) { $ban = $this->request->getPost('ban'); } else { $ban = '0'; }
			$search = $this->request->getPost('search');
			if (!empty($this->request->getPost('start_date'))) {$start_date = $this->request->getPost('start_date');} else {$start_date = '';}
			if (!empty($this->request->getPost('end_date'))) {$end_date = $this->request->getPost('end_date');} else {$end_date = '';}
			$log_id = $this->session->get('km_id');
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$all_rec = $this->Crud->filter_user('', '', $log_id, $search, $ban, $start_date, $end_date);
				if(!empty($all_rec)) { $counts = count($all_rec); } else { $counts = 0; }
				$query = $this->Crud->filter_user($limit, $offset, $log_id, $search, $ban, $start_date, $end_date);

				if(!empty($query)) {
					foreach($query as $q) {
						$id = $q->id;
						$fullname = $q->fullname;
						$email = $q->email;
						$phone = $q->phone;
						$role_id = $q->role_id;
						$country_id = $q->country_id;
						$state_id = $q->state_id;
						$city_id = $q->city_id;
						$ban = $q->activate;
						$reg_date = date('M d, Y h:i A', strtotime($q->reg_date));
						$avatar = $q->img_id;
						if(empty($avatar)){
							$avatar = 'assets/images/avatar.png';
						}
						
						if(empty($ban) && $ban == 0){
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
						if(!empty($country_id)) $loca .= '&#8594; '.$state;
						if(!empty($country_id)) $loca .= '<br>&#8594; '.$city;
						
						// add manage buttons
						if($role_u != 1) {
							$all_btn = '';
						} else {
							$all_btn = '
								<div class="textright">
									<a href="javascript:;" class="text-info pop mb-5 mr-1" pageTitle="Edit '.$fullname.' Details" pageName="'.site_url('accounts/user/manage/edit/'.$id).'" pageSize="modal-lg">
										<i class="fal fa-pen-alt"></i> EDIT
									</a>
									<a href="javascript:;" class="text-danger pop mb-5 ml-1  mr-1" pageTitle="Delete '.$fullname.' Record" pageName="'.site_url('accounts/user/manage/delete/'.$id).'" pageSize="modal-sm">
										<i class="fal fa-trash"></i> DELETE
									</a>
									<a href="javascript:;" class="text-success pop mb-5 ml-1" pageTitle="View '.$fullname.' User" pageName="'.site_url('accounts/user/manage/view/'.$id).'" pageSize="modal-lg">
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
			return view('account/user_form', $data);
		} else { // view for main page
            $data['title'] = 'User | '.app_name;
            $data['page_active'] = 'accounts/user';
            return view('account/user', $data);
        }
    }

	//// CHILDREN
    public function children($param1='', $param2='', $param3='') {
        // check login
        $log_id = $this->session->get('km_id');
        if(empty($log_id)) return redirect()->to(site_url('auth'));

        $role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
        $role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
        $role_c = $this->Crud->module($role_id, 'accounts/children', 'create');
        $role_r = $this->Crud->module($role_id, 'accounts/children', 'read');
        $role_u = $this->Crud->module($role_id, 'accounts/children', 'update');
        $role_d = $this->Crud->module($role_id, 'accounts/children', 'delete');
        if($role_r == 0){
            return redirect()->to(site_url('profile'));	
        }

        $data['log_id'] = $log_id;
        $data['role'] = $role;
        $data['role_c'] = $role_c;

        $table = 'child';

		$form_link = site_url('accounts/children/');
		if($param1){$form_link .= $param1.'/';}
		if($param2){$form_link .= $param2.'/';}
		if($param3){$form_link .= $param3.'/';}
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$data['form_link'] = rtrim($form_link, '/');
		
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
						$del_id = $this->request->getVar('d_child_id');
						///// store activities
						$code = $this->Crud->read_field('id', $del_id, $table, 'name');
						$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
						$action = $by.' deleted Child '.$code.' Record';

						if($this->Crud->deletes('id', $del_id, $table) > 0) {
							
							$this->Crud->activity('account', $del_id, $action);
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
								$data['e_name'] = $e->name;
								$data['e_parent_id'] = $e->parent_id;
								$data['e_age_id'] = $e->age_id;
							}
						}
					}
				}

				if($this->request->getMethod() == 'post'){
					$child_id = $this->request->getVar('child_id');
					$name = $this->request->getVar('name');
					$parent_id = $this->request->getVar('parent_id');
					$age_id = $this->request->getVar('age_id');
					

					$ins_data['name'] = $name;
					$ins_data['parent_id'] = $parent_id;
					$ins_data['age_id'] = $age_id;
					
					
					// do create or update
					if($child_id) {
						$upd_rec = $this->Crud->updates('id', $child_id, $table, $ins_data);
						if($upd_rec > 0) {
							///// store activities
							$code = $this->Crud->read_field('id', $child_id, $table, 'name');
							$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
							$action = $by.' updated Child '.$code.' Record';
							$this->Crud->activity('account', $child_id, $action);

							echo $this->Crud->msg('success', 'Record Updated');
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info', 'No Changes');	
						}
						
					} else {
						if($this->Crud->check2('name', $name, 'parent_id', $parent_id, $table) > 0) {
							echo $this->Crud->msg('warning', 'Child`s name already exist for this Parent');
						} else {
							if($this->Crud->check('parent_id', $parent_id, $table) > 3){
								echo $this->Crud->msg('danger', 'Maximum number of Children per Parent is 3');
							} else {
								$ins_data['reg_date'] = date(fdate);
								$ins_rec = $this->Crud->create($table, $ins_data);
								if($ins_rec > 0) {
									///// store activities
									$code = $this->Crud->read_field('id', $ins_rec, $table, 'name');
									$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
									$action = $by.' created Child '.$code.' Record';
									$this->Crud->activity('account', $ins_rec, $action);

									echo $this->Crud->msg('success', 'Record Created');
									echo '<script>location.reload(false);</script>';
								} else {
									echo $this->Crud->msg('danger', 'Please try later');	
								}	
							}
							
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
			
			if(!empty($this->request->getPost('age_id'))) { $ageID = $this->request->getPost('age_id'); } else { $ageID = ''; }
			if(!empty($this->request->getPost('parent_id'))) { $parentID = $this->request->getPost('parent_id'); } else { $parentID = ''; }
			if (!empty($this->request->getPost('start_date'))) {$start_date = $this->request->getPost('start_date');} else {$start_date = '';}
			if (!empty($this->request->getPost('end_date'))) {$end_date = $this->request->getPost('end_date');} else {$end_date = '';}
			
			$search = $this->request->getPost('search');

			$log_id = $this->session->get('km_id');
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$all_rec = $this->Crud->filter_children('', '', $log_id, $ageID, $parentID, $search, $start_date, $end_date);
				if(!empty($all_rec)) { $counts = count($all_rec); }
				$query = $this->Crud->filter_children($limit, $offset, $log_id, $ageID, $parentID, $search, $start_date, $end_date);

				if(!empty($query)) {
					foreach($query as $q) {
						$id = $q->id;
						$name = $q->name;
						$avatar = $q->avatar;
						$age = $this->Crud->read_field('id', $q->age_id, 'age', 'name');
						$parent = $this->Crud->read_field('id', $q->parent_id, 'user', 'fullname');
						$reg_date = date('M d, Y h:i A', strtotime($q->reg_date));

						// count children
						// $children = $this->db->table('child')->where('parent_id', $q->id)->countAllResults();
						
						if(empty($avatar)){
							$avatar = 'assets/images/avatar.png';
						}
						// add manage buttons
						$all_btn = '';
						if($role_u != 1) {
							$all_btn = '';
						} else {
							$all_btn = '
								<div class="text-right">
									<a href="javascript:;" class="text-danger pop" pageTitle="Delete '.$name.' Details" pageName="'.base_url('accounts/children/manage/delete/'.$id).'" pageSize="modal-sm">
										<i class="anticon anticon-delete"></i> DELETE
									</a>
									<a href="javascript:;" class="text-primary pop" pageTitle="Edit '.$name.' Details" pageName="'.base_url('accounts/children/manage/edit/'.$id).'" pageSize="modal-md">
										<i class="anticon anticon-edit"></i> EDIT
									</a>
								</div>
							';
						}

						$item .= '
							<li class="list-group-item">
								<div class="row p-t-10">
									<div class="col-2 col-md-1">
										<img alt="" src="'.site_url($avatar).'" class="p-1 avatar" />
									</div>
									<div class="col-10 col-md-5 m-b-10">
										<div class="single">
											<div class="text-muted font-size-12">'.$reg_date.'</div>
											<b class="font-size-16 text-primary">'.$name.'</b>
											<div class="small text-muted">'.$parent.'</div>
										</div>
									</div>
									<div class="col-7 col-md-4 m-b-5">
										<div class="text-muted font-size-12">AGE</div>
										<div class="font-size-14">
											'.$age.'
										</div>
									</div>
									<div class="col-5 col-md-2">
										<b class="font-size-14">'.$all_btn.'</b>
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
						<i class="anticon anticon-team" style="font-size:150px;"></i><br/><br/>No Children Returned
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

		$data['parents'] = $this->Crud->read_single_order('role_id', 3, 'user', 'fullname', 'ASC');
		$data['ages'] = $this->Crud->read_order('age', 'id', 'ASC');

        if($param1 == 'manage') { // view for form data posting
			return view('account/children_form', $data);
		} else { // view for main page
            $data['title'] = 'Children | '.app_name;
            $data['page_active'] = 'accounts/children';
            return view('account/children', $data);
        }
    }

	
}
