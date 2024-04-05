<?php

namespace App\Controllers;

class Notification extends BaseController {

    /////// ACTIVITIES
	public function index($param1='', $param2='', $param3='') {
		$db = \Config\Database::connect();

        // check login
        $log_id = $this->session->get('km_id');
        if(empty($log_id)) return redirect()->to(site_url(''));
		
        $this->session->set('km_redirect', uri_string());
        $role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
        $role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
        $role_c = $this->Crud->module($role_id, 'notification', 'create');
        $role_r = $this->Crud->module($role_id, 'notification', 'read');
        $role_u = $this->Crud->module($role_id, 'notification', 'update');
        $role_d = $this->Crud->module($role_id, 'notification', 'delete');
        if($role_r == 0){
            // return redirect()->to(site_url('profile'));	
        }

        $data['log_id'] = $log_id;
        $data['role'] = $role;
        $data['role_c'] = $role_c;
		$log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
        $data['log_name'] = $log_name;
        $data['page'] = 'Notification';
       
        $table = 'notify';

		$form_link = site_url('notification/index/');
		if($param1){$form_link .= $param1.'/';}
		if($param2){$form_link .= $param2.'/';}
		if($param3){$form_link .= $param3.'/';}
		
		// record listing
		if($param1 == 'load') {
			$limit = $param2;
			$offset = $param3;

			$counts = 0;
			$rec_limit = 25;
			$item = '';

			if($limit == '') {$limit = $rec_limit;}
			if($offset == '') {$offset = 0;}
			
			
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$all_rec = $this->Crud->read_single('to_id', $log_id, 'notify',);
                if(!empty($all_rec->data)) { $counts = count($all_rec->data); } else { $counts = 0; }

				$query = $this->Crud->read_single('to_id', $log_id, 'notify', $limit, $offset);
				$data['count'] = $counts;
                
				$items = '';
				if (!empty($query)) {
					foreach($query as $q) {
						$id = $q->id;
						$type = $q->item;
						$itema = $q->item;
						$new = $q->new;
						$from_id = $q->from_id;
						$content = $q->content;
						$reg_date = date('M d, Y h:i A', strtotime($q->reg_date));

						$from = $this->Crud->read_field('id', $from_id, 'user', 'fullname');
						$timespan = $this->Crud->timespan(strtotime($q->reg_date));

						$icon = 'bell';

						$st = '<span class="text-danger"  id="read_stat'.$id.'">Unread</span> &nbsp; &nbsp;';
						$btn = '
						<span id="read_btn'.$id.'"><a href="javascript:;" class="text-primary" onclick="reads('.$id.')">
							<i class="fal fa-check-circle-cut"></i> Mark as Read
							</a>&nbsp;
						</span><br>
						';
						if($new == 0){
							$st = '<span class="text-success" id="read_stat'.$id.'">Read</span>';
							$btn = '

							';
						}
						
						$item .= '
							<li class="list-group-item">
								<div class="row pt-4 align-items-center">
									<div class="col-2 col-sm-2 text-centr">
										<i class="fal fa-'.$icon.' text-muted" style="font-size:45px;"></i>
									</div>
									<div class="col-10 col-sm-10">
										You received a new '.ucwords(str_replace('_', ' ', $itema)).' notification from '.$from.' <small>on '.$reg_date.'</small>
										<div class="text-muted small text-right">'.$st.'<br>'.$timespan.'<br>'.$btn.'<span id="read_resp'.$id.'"></span></div>
										
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
						<em class="fal fa-bell" style="font-size:150px;"></em><br/><br/>No Notification Returned
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

            //print_r($resp);
			echo json_encode($resp);
			die;
		}

		if($param1 == 'nav_load') {
			$limit = $param2;
			$offset = $param3;

			$counts = 0;
			$rec_limit = 5;
			$item = '';

			if($limit == '') {$limit = $rec_limit;}
			if($offset == '') {$offset = 0;}
			
			
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$all_rec = $this->Crud->read2('to_id', $log_id, 'new', 1, 'notify');
               if(!empty($all_rec)) { $counts = count($all_rec); } else { $counts = 0; }

				$query = $this->Crud->read2('to_id', $log_id, 'new', 1, 'notify', $limit, $offset);
				$data['count'] = $counts;
                
				$items = '';
				if (!empty($query)) {
					foreach($query as $q) {
						$id = $q->id;
						$type_id = $q->item_id;
						$content = $q->content;
						$itema = $q->item;
						$item_id = $q->item_id;
						$new = $q->new;
						$reg_date = date('M d, Y h:i A', strtotime($q->reg_date));

						$link= '';
						if($itema == 'message'){
							$link = 'message';
						}
						if($itema == 'wallet'){
							$link = 'wallets/list';
						}
						if($itema == 'listing'){
							$link = 'listing';
						}
						
						
						$item .= '
							<li>
								<div class="widget-posts-descr">
									<h4> <a href="'.site_url($link).'">New Notification</a></h4>
									<div class="geodir-category-location fl-wrap"><a onclick="mark_read('.$id.')" href="'.site_url($link).'"><i class="fas fa-user-ninja"></i>'.$content.'</a></div>
									<div class="clear-wishlist tolt" data-microtip-position="left"  data-tooltip="Mark as Read"><i class="fal fa-envelope-open" onclick="mark_read('.$id.')"></i></div>
								</div>
							</li>  
						';
					}
				}
			}


			if(empty($item)) {
				$resp['item'] = '
				<li>
					<div class="widget-posts-descr text-center">
						<h4>No New Notification</h4>
					
					</div>
				</li>
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

            //print_r($resp);
			echo json_encode($resp);
			die;
		}

        $mod = 'notification/manage';
		
		if($param1 == 'manage') { // view for form data posting
			return view($mod.'_form', $data);
		} else { // view for main page
            
			$data['title'] = 'Notification | '.app_name;
			$data['page_active'] = 'notification';

			return view($mod, $data);
		}
	
	}

	public function mark_all(){
		$id = $this->session->get('km_id');
		if($id){
			$notify = $this->Crud->read_single('to_id', $id, 'notify');
			if(!empty($notify)){
				foreach ($notify as $n) {
					$upd = $this->Crud->updates('id', $n->id, 'notify', array('new'=>0));
					
				}
			}
			
		}
	}

	public function mark_read($id){
		if($id){
			$upd = $this->Crud->updates('id', $id, 'notify', array('new'=>0));
			if($upd > 0){
				echo '<span class="text-success">Marked</span>';
				echo '<script>$("#read_stat'.$id.'").html("Read");$("#read_btn'.$id.'").hide();</script>';
			} else{
				echo '<span class="text-danger">Please Try Again</span>';
				
			}
		}
	}

}
