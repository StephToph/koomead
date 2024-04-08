<?php

namespace App\Controllers;

class Dashboard extends BaseController {
    private $db;

    public function __construct() {
		$this->db = \Config\Database::connect();
	}

    public function index() {
        $db = \Config\Database::connect();

        // check login
        $log_id = $this->session->get('km_id');
        if(empty($log_id)) return redirect()->to(site_url(''));
		
        $this->session->set('km_redirect', uri_string());
        $role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
        $role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
        $role_c = $this->Crud->module($role_id, 'dashboard', 'create');
        $role_r = $this->Crud->module($role_id, 'dashboard', 'read');
        $role_u = $this->Crud->module($role_id, 'dashboard', 'update');
        $role_d = $this->Crud->module($role_id, 'dashboard', 'delete');
        if($role_r == 0){
            return redirect()->to(site_url('profile'));	
        }

        
        $log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
        $data['log_name'] = $log_name;
        $data['page'] = 'Dashboard';
        $data['log_id'] = $log_id;
        $data['role'] = $role;
        $data['role_c'] = $role_c;


        $data['title'] = 'Dashboard | '.app_name;
        $data['page_active'] = 'dashboard';
        return view('dashboard', $data);
    }

    //// CATEGORY
    public function category($param1='', $param2='', $param3='') {
		$db = \Config\Database::connect();

        // check login
        $log_id = $this->session->get('km_id');
        if(empty($log_id)) return redirect()->to(site_url(''));
		
        $this->session->set('km_redirect', uri_string());
        $role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
        $role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
        $role_c = $this->Crud->module($role_id, 'dashboard/category', 'create');
        $role_r = $this->Crud->module($role_id, 'dashboard/category', 'read');
        $role_u = $this->Crud->module($role_id, 'dashboard/category', 'update');
        $role_d = $this->Crud->module($role_id, 'dashboard/category', 'delete');
        if($role_r == 0){
            // return redirect()->to(site_url('profile'));	
        }
        $log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
        $data['log_name'] = $log_name;
        $data['page'] = 'Category';
        $data['log_id'] = $log_id;
        $data['role'] = $role;
        $data['role_c'] = $role_c;

        $table = 'category';

		$form_link = site_url('dashboard/category/');
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
						$del_id = $this->request->getVar('d_category_id');
						///// store activities
						$code = $this->Crud->read_field('id', $del_id, $table, 'name');
						$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
						$action = $by.' Deleted Category '.$code.' Record';
						
						if($this->Crud->deletes('id', $del_id, $table) > 0) {
							$this->Crud->activity('setup', $del_id, $action);

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
								$data['e_category_id'] = $e->category_id;
								$data['e_logo'] = $e->logo;
								$data['e_status'] = $e->status;
							}
						}
					}
				}

				if($this->request->getMethod() == 'post'){
					$cate_id = $this->request->getVar('cate_id');
					$category_id = $this->request->getVar('category_id');
					$name = $this->request->getVar('name');
					$status = $this->request->getVar('status');
                    $logo = $this->request->getVar('img');


                    /// upload image
                    if(file_exists($this->request->getFile('pics'))) {
                        $path = 'assets/images/categorys/';
                        $file = $this->request->getFile('pics');
                        $getImg = $this->Crud->img_upload($path, $file);
                        $logo = $getImg->path;
                    }


					$p_data['name'] = $name;
					$p_data['status'] = $status;
                    $p_data['logo'] = $logo;
                    $p_data['category_id'] = $category_id;


					// check if already exist
					if(!empty($cate_id)) {
						$upd_rec = $this->Crud->updates('id', $cate_id, $table, $p_data);
						if($upd_rec > 0) {
							///// store activities
							$code = $this->Crud->read_field('id', $cate_id, $table, 'name');
							$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
							$action = $by.' updated Category '.$code.' Record';
							$this->Crud->activity('setup', $cate_id, $action);

							echo $this->Crud->msg('success', 'Record Updated');
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info', 'No Changes');	
						}
					} else {
						if($this->Crud->check2('category_id', $category_id, 'name', $name, $table) > 0) {
							echo $this->Crud->msg('danger', 'Record Already Exist');
							die;
						}

						$ins_rec = $this->Crud->create($table, $p_data);
						if($ins_rec > 0) {
							///// store activities
							$code = $this->Crud->read_field('id', $ins_rec, $table, 'name');
							$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
							$action = $by.' Created Category '.$code.' Record';
							$this->Crud->activity('setup', $ins_rec, $action);

							echo $this->Crud->msg('success', 'Record Created');
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('danger', 'Please try later');	
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
			
			if (!empty($this->request->getPost('category_id'))) {$category_id = $this->request->getPost('category_id');} else {$category_id = '';}
			if (!empty($this->request->getPost('status'))) {$status = $this->request->getPost('status');} else {$status = '0';}
			if (!empty($this->request->getPost('search'))) {$search = $this->request->getPost('search');} else {$search = '';}
			

			$log_id = $this->session->get('km_id');
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$all_rec = $this->Crud->filter_category('', '', $log_id, $category_id, $status, $search);
				if(!empty($all_rec)) { $counts = count($all_rec); } else { $counts = 0; }
				$query = $this->Crud->filter_category($limit, $offset, $log_id, $category_id, $status, $search);

				if(!empty($query)) {
					foreach($query as $q) {
						$id = $q->id;
						$name = $q->name;
						$category_id = $q->category_id;
						$status = $q->status;
						$logo = $q->logo;
                        if(empty($logo))$logo = 'assets/images/category/menu.png';
						
                        if($status == 0)$st = '<span class="text-success">ACTIVE</span>';
                        if($status > 0)$st = '<span class="text-danger">DISABLED</span>';
                        
                        $category = $this->Crud->read_field('id', $category_id, 'category', 'name');
                        $cate = '';
                        if(!empty($category_id))$cate = '&#8594; '.$category;
                        // add manage buttons
                        if($role_u != 1) {
                            $all_btn = '';
                        } else {
							$all_btn = '
                                <a href="javascript:;" class="text-primary pop" pageTitle="Manage '.$name.'" pageName="'.site_url('dashboard/category/manage/edit/'.$id).'" pageSize="modal-md">
                                    <i class="fal fa-edit"></i> Edit
                                </a> ||  
                                <a href="javascript:;" class="text-danger pop" pageTitle="Delete '.$name.'" pageName="'.site_url('dashboard/category/manage/delete/'.$id).'" pageSize="modal-md">
                                    <i class="fal fa-trash"></i> Delete
                                </a>
                                    
                            ';
							
                            
                        }
						$c = '';
						if($category_id == 0)$c = '<span class="text-dark">'.$this->Crud->check('category_id', $id, 'category').' Sub Categories</span>';

						$item .= '
							<li class="list-group-item">
								<div class="row pt-3">
									<div class="col-2 col-sm-1 mb-2">
                                        <img alt="" src="'.site_url($logo).'" class="p-1 rounded" height="50"/>
                                        
									</div>
									<div class="col-10 col-md-6 mb-4">
										<div class="single">
                                            <div class="text-muted">'.$st.'</div>
											<b class="font-size-16 text-primary">'.strtoupper($name).'</b>
                                            <div class="font-size-12 small text-dark">'.strtoupper($cate).'</div>'.$c.'
										</div>
									</div>
                                    <div class="col-12 col-md-3 mb-2">
										<div class="single">
											<div class="text-muted">'.$all_btn.'</div>
										</div>
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
						<i class="fal fa-sitemap" style="font-size:150px;"></i><br/><br/>No Category Returned
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
			return view('dashboard/category_form', $data);
		} else { // view for main page
            
			$data['title'] = 'Categories | '.app_name;
            $data['page_active'] = 'dashboard/category';
            return view('dashboard/category', $data);
        }
    }
    public function mail() {
        // $body['from'] = 'itcerebral@gmail.com';
        // $body['to'] = 'iyinusa@yahoo.co.uk';
        // $body['subject'] = 'Test Email';
        // $body['text'] = 'Sending test email via mailgun API';
        // echo $this->Crud->mailgun($body);
        $to = 'tofunmi015@gmail.com';
        $subject = 'Test Email';
        $body = 'Sending test email from local email server';
        echo $this->Crud->send_email($to, $subject, $body);
    }

    public function category_update(){
        $category = 'REPAIR & CONSTRUCTION';
        $category_id = $this->Crud->read_field('name', $category, 'category', 'id');
        if(!empty($category_id)){
            $cates = "
            BUILDING MATERIALS, DOORS, ELECTRICAL EQUIPMENT, ELECTRICAL HAND TOOLS, HAND TOOLS, MEASURING & LAYOUT TOOLS, PLUMING & WATER SUPPLY, SOLAR ENERYGY, WINDOWS, OTHER REPAIRS & CONSTRUCTION ITEMS
            
            ";
            $cate = explode(',', $cates);
            foreach ($cate as $c) {
                if($this->Crud->check2('category_id', $category_id, 'name', $c, 'category') == 0){
                    $cats['category_id'] = $category_id;
                    $cats['name'] = $c;
                    
                    $this->Crud->create('category', $cats);
                }
                echo $c . "<br>";
            }
        }
    }

	public function load_metric(){
		$log_id = $this->session->get('km_id');
		$role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
		$role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
		$date_type = $this->request->getPost('date_type');
		if(!empty($this->request->getPost('date_from'))) { $date_froms = $this->request->getPost('date_from'); } else { $date_froms = ''; }
		if(!empty($this->request->getPost('date_to'))) { $date_tos = $this->request->getPost('date_to'); } else { $date_tos = ''; }
		if($date_type == 'Today'){
			$date_from = date('Y-m-d');
			$date_to = date('Y-m-d');
		} elseif($date_type == 'Yesterday'){
			$date_from = date('Y-m-d', strtotime( '-1 days' ));
			$date_to = date('Y-m-d', strtotime( '-1 days' ));
		} elseif($date_type == 'Last_Week'){
			$date_from = date('Y-m-d', strtotime( '-7 days' ));
			$date_to = date('Y-m-d');
		} elseif($date_type == 'Last_Month'){
			$date_from = date('Y-m-d', strtotime( '-30 days' ));
			$date_to = date('Y-m-d');
		} elseif($date_type == 'Date_Range'){
			$date_from = $date_froms;
			$date_to = $date_tos;
		} else {
			$date_from = date('Y-m-01');
			$date_to = date('Y-m-d');
		}
		
		if(!$log_id) {
			$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
		} else {
			
			// Admin
			if($role == 'administrator' || $role == 'developer') {
				
				$v_id = $this->Crud->read_field('name', 'User', 'access_role', 'id');
				

				$total_promo = $this->Crud->date_check1($date_from, 'reg_date',  $date_to, 'reg_date', 'applicant_id', $log_id, 'application');
				$active_promo = $this->Crud->date_check2($date_from, 'reg_date',  $date_to, 'reg_date', 'user_id', $log_id, 'status', '0', 'business_promotion');
				$unactive_promo = $this->Crud->date_check2($date_from, 'reg_date',  $date_to, 'reg_date', 'user_id', $log_id,'status', '1',  'business_promotion');
				$promo_view = $this->Crud->date_check($date_from, 'reg_date',  $date_to, 'reg_date', 'listing_view');
				
				$total_list = $this->Crud->date_check($date_from, 'reg_date',  $date_to, 'reg_date', 'listing');
				$list_view = $this->Crud->date_check($date_from, 'reg_date',  $date_to, 'reg_date',  'listing_view');
				$active_list = $this->Crud->date_check1($date_from, 'reg_date',  $date_to, 'reg_date', 'active', 1, 'listing');
				$user = $this->Crud->date_check1($date_from, 'reg_date',  $date_to, 'reg_date', 'role_id', $v_id, 'user');
				$promote_list = $this->Crud->date_check1($date_from, 'reg_date',  $date_to, 'reg_date', 'promote_status', 1, 'listing');
				$business = $this->Crud->date_check1($date_from, 'reg_date',  $date_to, 'reg_date', 'has_business', 1, 'user');
				$promoted = $this->Crud->date_check1($date_from, 'reg_date',  $date_to, 'reg_date', 'has_promoted', 1, 'user');
				
				// $list_views = 0;
				// if(!empty($list_view)){
				// 	foreach($list_view as $list){

				// 	}
				// }
				$resp['total_promo'] = number_format((float)($total_promo));
				$resp['active_promo'] = number_format((float)($active_promo));
				$resp['unactive_promo'] = number_format((float)($unactive_promo));
				$resp['promo_view'] = number_format((float)($promo_view));
				
			
				$resp['total_list'] = number_format((float)($total_list));
				$resp['promote_list'] = number_format((float)($promote_list));
				$resp['list_view'] = number_format((float)($list_view));
				$resp['active_list'] = number_format((float)($active_list));
				$resp['promoted'] = number_format((float)($promoted));
				$resp['user'] = number_format((float)($user));
				$resp['business'] = number_format((float)($business));
			}

			// Admin
			if($role != 'administrator' && $role != 'developer') {
				
				$v_id = $this->Crud->read_field('name', 'User', 'access_role', 'id');
				

				
				$total_promo = $this->Crud->date_check1($date_from, 'reg_date',  $date_to, 'reg_date', 'applicant_id', $log_id, 'application');
				$active_promo = $this->Crud->date_check2($date_from, 'reg_date',  $date_to, 'reg_date', 'user_id', $log_id, 'status', '0', 'business_promotion');
				$unactive_promo = $this->Crud->date_check2($date_from, 'reg_date',  $date_to, 'reg_date', 'user_id', $log_id,'status', '1',  'business_promotion');
				$promo_view = $this->Crud->date_check1($date_from, 'reg_date',  $date_to, 'reg_date', 'user_id', $log_id, 'listing_view');
				
				$total_list = $this->Crud->date_check1($date_from, 'reg_date',  $date_to, 'reg_date', 'user_id', $log_id, 'listing');
				$list_view = $this->Crud->date_range1($date_from, 'reg_date',  $date_to, 'reg_date', 'user_id', $log_id, 'listing');
				$promote_list = $this->Crud->date_check2($date_from, 'reg_date',  $date_to, 'reg_date', 'promote_status', 1, 'user_id', $log_id,  'listing');
				$active_list = $this->Crud->date_check2($date_from, 'reg_date',  $date_to, 'reg_date', 'active', 1, 'user_id', $log_id, 'listing');
				$user = 0;
				
				$list_views = 0;
				if(!empty($list_view)){
					foreach($list_view as $list){
						$page = 'home/listing/view/'.$list->id;
						$view = $this->Crud->check('page', $page, 'listing_view');
						$list_views += $view;
					}
				}
				$resp['promote_list'] = number_format((float)($promote_list));
				$resp['total_promo'] = number_format((float)($total_promo));
				$resp['active_promo'] = number_format((float)($active_promo));
				$resp['unactive_promo'] = number_format((float)($unactive_promo));
				$resp['promo_view'] = number_format((float)($promo_view));
				
				$resp['total_list'] = number_format((float)($total_list));
				$resp['list_view'] = number_format((float)($list_view));
				$resp['active_list'] = number_format((float)($active_list));
				$resp['user'] = number_format((float)($user));
			}

			

		}
		
		echo json_encode($resp);
		die;
	}

	public function activity_load(){
		$log_id = $this->session->get('km_id');
		$role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
		$role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
		$date_type = $this->request->getPost('date_type');
		if(!empty($this->request->getPost('date_from'))) { $date_froms = $this->request->getPost('date_from'); } else { $date_froms = ''; }
		if(!empty($this->request->getPost('date_to'))) { $date_tos = $this->request->getPost('date_to'); } else { $date_tos = ''; }
		if($date_type == 'Today'){
			$date_from = date('Y-m-d');
			$date_to = date('Y-m-d');
		} elseif($date_type == 'Yesterday'){
			$date_from = date('Y-m-d', strtotime( '-1 days' ));
			$date_to = date('Y-m-d', strtotime( '-1 days' ));
		} elseif($date_type == 'Last_Week'){
			$date_from = date('Y-m-d', strtotime( '-7 days' ));
			$date_to = date('Y-m-d');
		} elseif($date_type == 'Last_Month'){
			$date_from = date('Y-m-d', strtotime( '-30 days' ));
			$date_to = date('Y-m-d');
		} elseif($date_type == 'Date_Range'){
			$date_from = $date_froms;
			$date_to = $date_tos;
		} else {
			$date_from = date('Y-m-01');
			$date_to = date('Y-m-d');
		}
		
		if(!$log_id) {
			$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
		} else {
			$activity_query = $this->Crud->date_range2($date_from, 'reg_date',  $date_to, 'reg_date', 'item', 'authentication','item_id', $log_id, 'activity',5);

			// Admin
			if($role == 'administrator' || $role == 'developer') {
				$activity_query = $this->Crud->date_range($date_from, 'reg_date',  $date_to, 'reg_date', 'activity',5);

			}
			$activity_load = '';
			if(!empty($activity_query)){
				foreach($activity_query as $q){
					$activity_load .= '
						<div class="dashboard-list fl-wrap">
							<div class="dashboard-message">
								<span class="close-dashboard-item"></span>
								<div class="main-dashboard-message-icon color-bg"><i class="far fa-check"></i></div>
								<div class="main-dashboard-message-text">
									<p>'.$q->action.' </p>
								</div>
								<div class="main-dashboard-message-time"><i class="fal fa-calendar-week"></i> '.$this->Crud->timespan(strtotime($q->reg_date)).'</div>
							</div>
						</div>
					
					';
				}
			}
			$resp['activity_load'] = $activity_load;
		}
		
		echo json_encode($resp);
		die;
	}

	public function message_load(){
		$log_id = $this->session->get('km_id');
		$role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
		$role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
		$date_type = $this->request->getPost('date_type');
		if(!empty($this->request->getPost('date_from'))) { $date_froms = $this->request->getPost('date_from'); } else { $date_froms = ''; }
		if(!empty($this->request->getPost('date_to'))) { $date_tos = $this->request->getPost('date_to'); } else { $date_tos = ''; }
		if($date_type == 'Today'){
			$date_from = date('Y-m-d');
			$date_to = date('Y-m-d');
		} elseif($date_type == 'Yesterday'){
			$date_from = date('Y-m-d', strtotime( '-1 days' ));
			$date_to = date('Y-m-d', strtotime( '-1 days' ));
		} elseif($date_type == 'Last_Week'){
			$date_from = date('Y-m-d', strtotime( '-7 days' ));
			$date_to = date('Y-m-d');
		} elseif($date_type == 'Last_Month'){
			$date_from = date('Y-m-d', strtotime( '-30 days' ));
			$date_to = date('Y-m-d');
		} elseif($date_type == 'Date_Range'){
			$date_from = $date_froms;
			$date_to = $date_tos;
		} else {
			$date_from = date('Y-m-01');
			$date_to = date('Y-m-d');
		}
		
		if(!$log_id) {
			$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
		} else {
			
			// Admin
			if($role == 'administrator' || $role == 'developer') {
				$activity_query = $this->Crud->date_range_group($date_from, 'reg_date',  $date_to, 'reg_date', 'km_message','code');
				
			} else {
				$activity_query = $this->Crud->date_range1_group($date_from, 'reg_date',  $date_to, 'reg_date', 'receiver_id', $log_id,'km_message','code',5);

			
			}
			
			$counts = 0;
			$message_load = '';
			if(!empty($activity_query)){
				foreach($activity_query as $q){
					if($counts > 5)continue;
					$send = $this->Crud->read_field('id', $q->sender_id, 'user', 'fullname');
					$send_img = $this->Crud->read_field('id', $q->sender_id, 'user', 'img_id');
					$receive =  $this->Crud->read_field('id', $q->receiver_id, 'user', 'fullname');
					
					// //check if message has been initiated before between the parties

					// if($role != 'administrator' && $role !=' developer'){
					// 	if($q->sender_id != $log_id && $q->receiver_id != $log_id)continue;
					// }

					if(empty($send_img)){
						$send_img = 'assets/images/avatar.png';
					}
					$count = $this->Crud->check2('code', $q->code, 'status', 0, 'message');
					$c = '';
					if($count > 0)$c='<div class="message-counter">'.$count.'</div>';
					$message_load .= '
						<a class="chat-contacts-item" href="'.site_url('message').'">
							<div class="dashboard-message-avatar">
								<img src="'.site_url($send_img).'" alt="">
								'.$c.'
							</div>
							<div class="chat-contacts-item-text">
								<h4>'.ucwords($send).'</h4>
								<span>'.$this->Crud->timespan(strtotime($q->reg_date)).' </span>
								<p>'.$q->message.'</p>
							</div>
						</a>
					
					';
					$counts ++;
				}
			} else {
				$message_load .= '
					<a class="chat-contacts-item" href="javascript:;">
						<div class="chat-contacts-item-text">
							<h4>No Message</h4>
						</div>
					</a>
				';
			}
			$resp['message_load'] = $message_load;
		}
		
		echo json_encode($resp);
		die;
	}

}	
