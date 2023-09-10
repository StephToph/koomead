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
            return redirect()->to(site_url('profile'));	
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
				$all_rec = $this->Crud->api('get', 'notification/get', '&log_id='.$log_id);
                $all_rec = json_decode($all_rec);
				if(!empty($all_rec->data)) { $counts = count($all_rec->data); } else { $counts = 0; }

				$query = $this->Crud->api('get', 'notification/get', 'limit='.$limit.'&offset='.$offset.'&log_id='.$log_id);
				$data['count'] = $counts;
                $query = json_decode($query);
				//print_r($query);
				$items = '';
                if ($query->status == true) {
					if (!empty($query->data)) {
						foreach($query->data as $q) {
							$id = $q->id;
							$type_id = $q->item_id;
							$content = $q->content;
							$new = $q->new;
							$reg_date = date('M d, Y h:i A', strtotime($q->reg_date));
	
							$timespan = $this->Crud->timespan(strtotime($q->reg_date));
	
							$icon = 'vol';

							$st = '<span class="text-danger"  id="read_stat'.$id.'">Unread</span> &nbsp; &nbsp;';
							$btn = '
							<span id="read_btn'.$id.'"><a href="javascript:;" class="text-primary" onclick="reads('.$id.')">
								<em class="icon ni ni-check-circle-cut"></em> Mark as Read
								</a>&nbsp;
							</span><br>
							';
							if($new == 0){
								$st = '<span class="text-success" id="read_stat'.$id.'">Read</span>';
								$btn = '

								';
							}
							
							$item .= '
								<tr class="nk-tb-item">
									<td class="nk-tb-col">
										<a href="javascript:;" class="project-title">
											<div class="project-info">
												<h6 class="title">'.    $content.' <small>on '.$reg_date.'</small></h6>
												<p class="d-md-none">
													'.$st.'  <br>
													<span >'.$timespan.'</span><br>
													'.$btn.'
													<span id="read_resp'.$id.'"></span>
												</p>
											</div>
										</a>
									</td>
									<td class="nk-tb-col tb-col-lg">
										'.$st.'<br>
										<span>'.$timespan.'</span><br>
										'.$btn.'
										<span id="read_resp'.$id.'"></span>
									</td>
								</tr><!-- .nk-tb-item -->       
							';
						}
					}
				}
			}


			if(empty($item)) {
				$resp['item'] = '
					<div class="text-center text-muted">
						<br/><br/><br/><br/>
						<em class="icon ni ni-vol" style="font-size:150px;"></em><br/><br/>No Notification Returned
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

        $mod = 'moficiation/manage';
		
		if($param1 == 'manage') { // view for form data posting
			return view($mod.'_form', $data);
		} else { // view for main page
            
			$data['title'] = 'Notification | '.app_name;
			$data['page_active'] = $mod;

			return view($mod.'/list', $data);
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
