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
            return redirect()->to(site_url('profile'));	
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
}
