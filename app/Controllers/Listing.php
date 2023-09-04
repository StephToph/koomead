<?php

namespace App\Controllers;

class Listing extends BaseController {
    private $db;

    public function __construct() {
		$this->db = \Config\Database::connect();
	}

	//// listing
    public function index($param1='', $param2='', $param3='') {
		$db = \Config\Database::connect();

        // check login
        $log_id = $this->session->get('km_id');
        if(empty($log_id)) return redirect()->to(site_url(''));

        $role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
        $role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
        $role_c = $this->Crud->module($role_id, 'listing', 'create');
        $role_r = $this->Crud->module($role_id, 'listing', 'read');
        $role_u = $this->Crud->module($role_id, 'listing', 'update');
        $role_d = $this->Crud->module($role_id, 'listing', 'delete');
        if($role_r == 0){
            return redirect()->to(site_url('profile'));	
        }

        $data['log_id'] = $log_id;
        $data['role'] = $role;
        $data['role_c'] = $role_c;
		$log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
        $data['log_name'] = $log_name;
        $data['page'] = 'My Listings';
       
        $table = 'listing';

		$form_link = site_url('listing/index');
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
						$del_id = $this->request->getVar('d_age_id');
						///// store activities
						$code = $this->Crud->read_field('id', $del_id, 'age', 'name');
						$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
						$action = $by.' deleted Age '.$code.' Record';
						
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
							}
						}
					}
				}

				if($this->request->getMethod() == 'post'){
					$age_id = $this->request->getVar('age_id');
					$name = $this->request->getVar('name');

					$p_data['name'] = $name;

					// check if already exist
					if(!empty($age_id)) {
						$upd_rec = $this->Crud->updates('id', $age_id, $table, $p_data);
						if($upd_rec > 0) {
							///// store activities
							$code = $this->Crud->read_field('id', $age_id, 'age', 'name');
							$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
							$action = $by.' updated Age '.$code.' Record';
							$this->Crud->activity('setup', $age_id, $action);

							echo $this->Crud->msg('success', 'Record Updated');
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info', 'No Changes');	
						}
					} else {
						$ins_rec = $this->Crud->create('age', $p_data);
						if($ins_rec > 0) {
							///// store activities
							$code = $this->Crud->read_field('id', $ins_rec, 'age', 'name');
							$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
							$action = $by.' created Age '.$code.' Record';
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

			$count = 0;
			$rec_limit = 25;
			$item = '';

			if($limit == '') {$limit = $rec_limit;}
			if($offset == '') {$offset = 0;}
			
			$search = $this->request->getVar('search');
			if(!empty($this->request->getPost('start_date'))) { $start_date = $this->request->getPost('start_date'); } else { $start_date = ''; }
			if(!empty($this->request->getPost('end_date'))) { $end_date = $this->request->getPost('end_date'); } else { $end_date = ''; }
			
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$query = $this->Crud->filter_activity($limit, $offset, $log_id, $search, $start_date, $end_date);
				$all_rec = $this->Crud->filter_activity('', '', $log_id, $search, $start_date, $end_date);
				if(!empty($all_rec)) { $count = count($all_rec); } else { $count = 0; }

				if(!empty($query)) {
					foreach($query as $q) {
						$id = $q->id;
						$type = $q->item;
						$type_id = $q->item_id;
						$action = $q->action;
						$reg_date = date('M d, Y h:i A', strtotime($q->reg_date));

						$timespan = $this->Crud->timespan(strtotime($q->reg_date));

						$icon = 'vote-yea';
						if($type == 'authentication') $icon = 'lock-alt';
						if($type == 'setup') $icon = 'tools';
						if($type == 'account') $icon = 'users';
						if($type == 'tools') $icon = 'toolbox';
						if($type == 'coupon') $icon = 'reconciliation';

						$item .= '
							<li class="list-group-item">
								<div class="row pt-4 align-items-center">
									<div class="col-1 text-center">
										<i class="fal fa-'.$icon.' text-muted" style="font-size:50px;"></i>
									</div>
									<div class="col-11">
										'.$action.' <small>on '.$reg_date.'</small>
										<div class="text-muted small text-right">'.$timespan.'</div>
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
						<i class="fal fa-chart-network" style="font-size:150px;"></i><br/><br/>No Activities Returned
					</div>
				';
			} else {
				$resp['item'] = $item;
			}

			$more_record = $count - ($offset + $rec_limit);
			$resp['left'] = $more_record;

			if($count > ($offset + $rec_limit)) { // for load more records
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
			return view('listing/manage_form', $data);
		} else { // view for main page
            
			$data['title'] = 'My Listing | '.app_name;
            $data['page_active'] = 'listing';
            return view('listing/manage', $data);
        }
    }

}
