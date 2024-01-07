<?php

namespace App\Controllers;

class Wallets extends BaseController {

    //Wallet
	public function list($param1='', $param2='', $param3='') {
		
        // check login
        $log_id = $this->session->get('km_id');
        if(empty($log_id)) return redirect()->to(site_url(''));
		$mod = 'wallets/list';
        $this->session->set('km_redirect', uri_string());
        $role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
        $role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
        $role_c = $this->Crud->module($role_id, 'wallets/list', 'create');
        $role_r = $this->Crud->module($role_id, 'wallets/list', 'read');
        $role_u = $this->Crud->module($role_id, 'wallets/list', 'update');
        $role_d = $this->Crud->module($role_id, 'wallets/list', 'delete');
        if($role_r == 0){
            // return redirect()->to(site_url('profile'));	
        }
        $log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
        $data['log_name'] = $log_name;
        $data['page'] = 'Wallet';
        $data['log_id'] = $log_id;
        $data['role'] = $role;
        $data['role_c'] = $role_c;
		$table = 'wallets';
		$form_link = site_url($mod);
		if($param1){$form_link .= '/'.$param1;}
		if($param2){$form_link .= '/'.$param2;}
		if($param3){$form_link .= '/'.$param3;}
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$data['form_link'] = $form_link;

		$country_id = $this->Crud->read_field('id', $log_id, 'user', 'country_id');
        $state_id = $this->Crud->read_field('id', $log_id, 'user', 'state_id');
        $data['country_id'] = $country_id;
		
		if($param1 == 'transact'){
			/////// CHACK PAYMENT RESPONSE //////
			$ref = $this->request->getPost('ref');
			$trans = $this->request->getPost('trans');
			$status = $this->request->getPost('status');
            // echo 'test';
			if($ref && $trans && $status) {
				if($status == 'success') {
					$user_id = $this->session->get('km_wallet_id');
					$amount = $this->session->get('f_amount');
					if(!empty($user_id) && !empty($amount)){
						$v_ins['user_id'] = $user_id;
						$v_ins['type'] = 'credit';
						$v_ins['amount'] = $amount;
						$v_ins['item'] = 'fund';
						$v_ins['country_id'] = $country_id;
						$v_ins['state_id'] = $state_id;
						$v_ins['item_id'] = $user_id;
						$v_ins['remark'] = 'Wallet Funding';
						$v_ins['reg_date'] = date(fdate);
						
						$w_id = $this->Crud->create('wallet', $v_ins);
						if($w_id > 0) {
							echo $this->Crud->msg('success', 'Wallet Funded');
							$this->session->set('f_amount', '');
							$this->session->set('km_wallet_id', '');
							///// store activities
							$by = $this->Crud->read_field('id', $user_id, 'user', 'fullname');
							$action = $by.' Funded Wallet with &#8358;'.number_format((float)$amount).' ';
							$this->Crud->activity('wallet', $w_id, $action);
							$redir = 'wallets/list';
							echo '<script>window.location.replace("'.site_url($redir).'");</script>';
						} else {
							echo $this->Crud->web_msg('danger', 'Failed! - Please Contact Support.');
							
						}
					}
				}
			}

			////////////////////////////////////
			die;
		}

		if($param1 == 'stripe_transact'){
			/////// CHACK PAYMENT RESPONSE //////
			$check_session = $this->request->getGet('session_id');
            // echo 'test';
			$status = 'failed';
			if($check_session) {
				$status = 'success';
				if($status == 'success') {
					$user_id = $this->session->get('km_wallet_id');
					$amount = $this->session->get('f_amount');
					if(!empty($user_id) && !empty($amount)){
						$v_ins['user_id'] = $user_id;
						$v_ins['type'] = 'credit';
						$v_ins['amount'] = $amount;
						$v_ins['item'] = 'fund';
						$v_ins['item_id'] = $user_id;
						$v_ins['country_id'] = $country_id;
						$v_ins['state_id'] = $state_id;
						$v_ins['remark'] = 'Wallet Funding';
						$v_ins['reg_date'] = date(fdate);
						
						$w_id = $this->Crud->create('wallet', $v_ins);
						if($w_id > 0) {
							echo $this->Crud->msg('success', 'Wallet Funded');
							$this->session->set('f_amount', '');
							$this->session->set('km_wallet_id', '');
							///// store activities
							$by = $this->Crud->read_field('id', $user_id, 'user', 'fullname');
							$action = $by.' Funded Wallet with £'.number_format((float)$amount).' ';
							$this->Crud->activity('wallet', $w_id, $action);
							$redir = 'wallets/list';
							echo '<script>window.location.replace("'.site_url($redir).'");</script>';
						} else {
							echo $this->Crud->web_msg('danger', 'Failed! - Please Contact Support.');
							
						}
					}
				}
			}

			////////////////////////////////////
			die;
		}
		// manage record
		if($param1 == 'manage') {
			// prepare for delete
			if($param2 == 'delete') {
				if($param3) {
					$edit = $this->Crud->read_single('id', $param3, $table);
                    //echo var_dump($edit);
					if(!empty($edit)) {
						foreach($edit as $e) {
							$data['d_id'] = $e->id;
						}
					}
					
					if($this->request->getMethod() == 'post'){
						$del_id =  $this->request->getVar('d_pump_id');
                        $code = $this->Crud->read_field('id', $del_id, 'pump', 'name');
						$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
						$action = $by.' deleted pump ('.$code.')';
							
                        if($this->Crud->deletes('id', $del_id, $table) > 0) {

							///// store activities
							$this->Crud->activity('pump', $del_id, $action);
							
							echo $this->Crud->msg('success', 'Record Deleted');
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('danger', 'Please try later');
						}
						die;	
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
								$data['e_product'] = $e->product;
								$data['e_price'] = $e->price;
								
							}
						}
					}
				}

				
				if($this->request->getMethod() == 'post'){
					$pump_id =  $this->request->getVar('pump_id');
					$name =  $this->request->getVar('name');
					$product =  $this->request->getVar('product');
					$price =  $this->request->getVar('price');
					
					// do create or update
					if($pump_id) {
						$upd_data['name'] = $name;
						$upd_data['product'] = $product;
						$upd_data['price'] = $price;
						
						$upd_rec = $this->Crud->updates('id', $pump_id, $table, $upd_data);
						if($upd_rec > 0) {
							///// store activities
							$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
							$code = $this->Crud->read_field('id', $pump_id, 'pump', 'name');
							$action = $by.' updated Pump ('.$code.') Record';
							$this->Crud->activity('pump', $pump_id, $action);

							echo $this->Crud->msg('success', 'Updated');
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info', 'No Changes');	
						}
                        die;
					} else {
						if($this->Crud->check2('name', $name, 'user_id', $log_id, $table) > 0) {
							echo $this->Crud->msg('warning', 'Record Already Exist');
						} else {
							$ins_data['name'] = $name;
							$ins_data['product'] = $product;
							$ins_data['price'] = $price;
							$ins_data['user_id'] = $log_id;
							$ins_data['reg_date'] = date(fdate);
							
							$ins_rec = $this->Crud->create($table, $ins_data);
							if($ins_rec > 0) {
								echo $this->Crud->msg('success', 'Record Created');
								///// store activities
								$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
								$code = $this->Crud->read_field('id', $ins_rec, 'pump', 'name');
								$action = $by.' created Pump ('.$code.') Record';
								$this->Crud->activity('pump', $ins_rec, $action);
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('danger', 'Please try later');	
							}	
						}

					}die;
						
				}
			}
		}

		// wallet statement
		if($param1 == 'statement') {
		    $data['statement_id'] = $param2;
		}

		if($param1 == 'approve') {
		    $data['approve_id'] = $param2;
			
			if($this->request->getMethod() == 'post'){
				$approve_id =  $this->request->getVar('approve_id');
				
				$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
				$action = $by.' Approved Wallet Withdraw Request';
				$upd_data['approved'] = 1;
				$upd_data['approve_id'] = $log_id;
				$upd_data['approve_date'] = date(fdate);
				
				$upd_rec = $this->Crud->updates('id', $approve_id, 'wallet_request', $upd_data);
				if($upd_rec > 0) {
					///// store activities
					$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
					$action = $by.' approved Wallet Withdraw Request';
					$this->Crud->activity('wallet', $approve_id, $action);

					echo $this->Crud->msg('success', 'Request Approved');
					echo '<script>location.reload(false);</script>';
				} else {
					echo $this->Crud->msg('info', 'No Changes');	
				}
				die;	
				
			}
		}

		// wallet statement
		if($param1 == 'download') {
			if(!empty($param2)){
				$wallet = '';
				$user = $this->Crud->read_field('id', $param2, 'user', 'fullname');
				$comms = $this->Crud->read_single('user_id', $param2, 'wallet');
				if(!empty($comms)) {
					$count = 1;
					foreach($comms as $co) {
						$items = array();

						$items[] = $count;
						$items[] = date('Y-m-d H:i:s', strtotime($co->reg_date));
						$type = $co->type;
						$amount = $co->amount;
						$item = $co->item;
						$remark = $co->remark;
						
						$items[] = strtoupper($type);
						$items[] = $amount;
						$items[] = strtoupper($item);
						$items[] = $remark;
						$row[] = $items;
						$count += 1;
					}
				}

				// echo $this->Crud->msg('info', 'Exporting & Downloading.<br>Please Wait..');
				// now export CSV
				$dfile_name = $user.' Wallet Statement - '.date('dmY');
				$fname = $dfile_name.'.csv';
				header( "Content-Type: text/csv;charset=utf-8" );
				header( "Content-Disposition: attachment;filename=$fname" );
				header("Pragma: no-cache");
				header("Expires: 0");
				
				$output = fopen('php://output', 'w');
			
				// Column Title
				fputcsv($output, array('S/N', 'Reg Date', 'Type', 'Amount', 'Transaction Type', 'Remark'));
				
				// Column Items
				if(!empty($row)) {
					foreach($row as $fields) {
						fputcsv($output, $fields);
					}
				}
				
				fclose($output);
			}
			die;
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
			
			if (!empty($this->request->getPost('search'))) {$search = $this->request->getPost('search');} else {$search = '';}
			if (!empty($this->request->getPost('country_id'))) {$country_id = $this->request->getPost('country_id');} else {$country_id = '';}
			if(!empty($this->request->getPost('type'))) { $type = $this->request->getPost('type'); } else { $type = ''; }
			if(!empty($this->request->getPost('transact'))) { $transact = $this->request->getPost('transact'); } else { $transact = ''; }
			if(!empty($this->request->getPost('start_date'))) { $start_date = $this->request->getPost('start_date'); } else { $start_date = date('Y-01-01'); }
			if(!empty($this->request->getPost('end_date'))) { $end_date = $this->request->getPost('end_date'); } else { $end_date = date('Y-m-d'); }
			
		
			
			$log_id = $this->session->get('km_id');
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$all_rec = $this->Crud->filter_wallet('', '', $log_id, $type, $transact,$search, $start_date, $end_date,$country_id);
              
				if(!empty($all_rec)) { $counts = count($all_rec); } else { $counts = 0; }

				$query = $this->Crud->filter_wallet($limit, $offset, $log_id, $type, $transact,$search, $start_date, $end_date,$country_id);
				if(!empty($all_rec)) { $count = count($all_rec); } else { $count = 0; }
				$total = 0;
				$credit = 0;
				$debit = 0;
				$nig_total = 0;
				$nig_bal = 0;
				$nig_credit = 0;
				$nig_debit = 0;
				//print_r($query);
				$curr = '&#8358;';$curss = '&#8358;';
				if($role == 'developer' || $role == 'administrator'){
					$wal = $this->Crud->date_range1($start_date, 'reg_date',$end_date, 'reg_date', 'country_id !=', '161', 'wallet');
					$curs = '£';
					
					if(!empty($wal)){
						foreach($wal as $w){
							if($w->type == 'credit')$credit += (float)$w->amount;
							if($w->type == 'debit')$debit += (float)$w->amount;
							
						}
						$bal = $credit - $debit;
					}
					$wal = $this->Crud->date_range1($start_date, 'reg_date',$end_date, 'reg_date', 'country_id', '161', 'wallet');
					if(!empty($wal)){
						foreach($wal as $w){
							if($w->type == 'credit')$nig_credit += (float)$w->amount;
							if($w->type == 'debit')$nig_debit += (float)$w->amount;
							
						}
						$nig_bal = $nig_credit - $nig_debit;
					}
					$resp['total'] = $curs.number_format($total, 2);
					$resp['credit'] = $curs.number_format($credit, 2);
					$resp['debit'] = $curs.number_format($debit, 2);
					$resp['nig_total'] = $curss.number_format($nig_bal, 2);
					$resp['nig_credit'] = $curss.number_format($nig_credit, 2);
					$resp['nig_debit'] = $curss.number_format($nig_debit, 2);
				} else{
					$curs ='';$curss='';
					$wal = $this->Crud->date_range2($start_date, 'reg_date',$end_date, 'reg_date', 'user_id', $log_id, 'country_id !=', '161', 'wallet');
					if(!empty($wal)){
						foreach($wal as $w){
							if($w->type == 'credit')$credit += (float)$w->amount;
							if($w->type == 'debit')$debit += (float)$w->amount;
							
						}
						$bal = $credit - $debit;$curs = '£';
					}
					$wal = $this->Crud->date_range2($start_date, 'reg_date',$end_date, 'reg_date', 'user_id', $log_id, 'country_id', '161', 'wallet');
					if(!empty($wal)){
						foreach($wal as $w){
							if($w->type == 'credit')$nig_credit += (float)$w->amount;
							if($w->type == 'debit')$nig_debit += (float)$w->amount;
							
						}
						$nig_bal = $nig_credit - $nig_debit;$curss = '&#8358;';
					}
					$resp['total'] = $curs.number_format($total, 2);
					$resp['credit'] = $curs.number_format($credit, 2);
					$resp['debit'] = $curs.number_format($debit, 2);
					$resp['nig_total'] = $curss.number_format($nig_bal, 2);
					$resp['nig_credit'] = $curss.number_format($nig_credit, 2);
					$resp['nig_debit'] = $curss.number_format($nig_debit, 2);
				}
				
				if(!empty($query)) {
					foreach($query as $q) {
						
						$id = $q->id;
						$user_id = $q->user_id;
						$type = $q->type;
						$mod = $q->item;
						$mod_id = $q->item_id;
						$request_id = $q->request_id;
						$remark = $q->remark;
						$amount = number_format((float)$q->amount, 2);
						$reg_date = date('M d, Y h:i A', strtotime($q->reg_date));

						$user_email = $this->Crud->read_field('id', $user_id, 'user', 'email');
						$country = $q->country_id;
						$curr = '£';
                        if($country == 161)$curr = ' ₦';
						// user 
						$user = $this->Crud->read_field('id', $user_id, 'user', 'fullname');
						$user_role_id = $this->Crud->read_field('id', $user_id, 'user', 'role_id');
						$user_role = strtoupper($this->Crud->read_field('id', $user_role_id, 'access_role', 'name'));
						$user_image_id = $this->Crud->read_field('id', $user_id, 'user', 'img_id');
						$user_image = $this->Crud->image($user_image_id, 'big');

						// module
						if($mod == 'order') {
							$remark = '
								<a href="javascript:;" class="text-success pop" pageTitle="Order Statement" pageName="'.site_url('order/list/manage/edit/'.$mod_id).'" pageSize="modal-lg">
									<span class="m-l-3 m-r-10"><b>'.$remark.'</b></span>
								</a>
							';
						}
						
						
						$request ='';
						$req_sta = $this->Crud->read_field('id', $request_id, 'wallet_request', 'approved');
						if($request_id > 0 && $req_sta == 0){
							$request .= '<h6 class="blinking-text text-danger">Pending Approval</h6>
							';
							if($role_d > 0){
								$request .= '<a href="javascript:;" class="pop btn btn-info"  pageTitle="Approve Request" pageName="'.site_url('wallets/list/approve/'.$request_id).'" pageSize="modal-md" data-microtip-position="top-left"  data-tooltip="Enable"><i class="far fa-check"></i> Approve Request</a>';
							}
						}


					
						// color
						$color = 'success';
						if($type == 'debit') { $color = 'danger';}

						$item .= '
							<li class="list-group-item">
								<div class="row pt-3">
									<div class="col-2 col-sm-4 mb-2">
										<div class="text-muted">'.$reg_date.'</div>
										<a href="javascript:;" class="pop" pageTitle="Wallet Statement" pageName="'.site_url('wallets/list/statement/'.$user_id).'" pageSize="modal-lg">
											<img alt="" src="'.site_url($user_image).'" class="p-1 rounded" height="50"/>
											<span class="text-primary font-weight-bold">'.strtoupper($user).'</span>
										</a>  
										
									</div>
									<div class="col-10 col-md-5 mb-4">
										<div class="single">
											<b class="font-size-16 text-'.$color.'">'.strtoupper($type).'</b>
											<div class="font-size-16 text-dark">'.strtoupper($remark).'</div>
											<span class="tb-lead"><b>' . $curr . $amount . '</b></span>
										</div>
									</div>
									<div class="col-12 col-md-3 mb-4">
										<div class="single">'.$request.'
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
						<i class="fal fa-wallet" style="font-size:150px;"></i><br/><br/>No Wallet Returned<br/><br/><br/>
					</div>
				';
			} else {
				$resp['item'] = $item;
			}
			$total = $credit - $debit;
			
			
			$resp['count'] = $count;

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

		if($param1 == 'manage' || $param1 == 'fund' || $param1 == 'statement' || $param1 == 'withdraw'|| $param1 == 'approve' ) { // view for form data posting
			return view($mod.'_form', $data);
		} else { // view for main page
			
			$data['title'] = 'Wallets  | '.app_name;
			$data['page_active'] = $mod;
			return view($mod, $data);
		}
    }

	public function wallet_fund(){
		$user_id = $this->request->getPost('user_id');
		$country_id = $this->request->getPost('country_id');
		$amount = $this->request->getPost('tot_amount');
		$r_amount = $this->request->getPost('amount');

		////// FORMAT PAYMENT
		if($country_id != '161'){
			if($amount > 0) {
				$r_amount = $amount * 100;
				$this->session->set('f_amount', $amount);
				$this->session->set('km_wallet_id', $user_id);
				echo $this->Crud->stripe_inline($r_amount);
			}
		} else{
			$pay_script = '';
			if($amount > 0) {
				$ref = 'KMD-'.time().rand(0,9).rand(1,9);

				$redir = site_url('wallets/list');

				$user = $this->Crud->read_field('id', $user_id, 'user', 'fullname');
				$phone = $this->Crud->read_field('id', $user_id, 'user', 'phone');
				$email = $this->Crud->read_field('id', $user_id, 'user', 'email');
				$this->session->set('f_amount', $r_amount);
				
				$user_ids = $user_id;
				$user = ucwords($user);
				
				
				$this->session->set('km_wallet_id', $user_id);
				$pay_script = $this->Crud->paystack($ref, $email, $amount, $redir);
				echo $pay_script;
				echo '<script>payWithPaystack()</script>';
			} else {
				$this->session->set('is_card', '');
			}

		}
		
	}

	public function withdraw(){
		$user_id = $this->request->getPost('user_id');
		$country_id = $this->request->getPost('country_id'); 
		$state_id = $this->Crud->read_field('id', $user_id, 'user', 'state_id');
        
		$amount = $this->request->getPost('amount');
		$balance = $this->request->getPost('balance');
		$nig_threshhold = $this->Crud->read_field('name', 'nigeria_limit', 'setting', 'value');
		$uk_threshhold = $this->Crud->read_field('name', 'uk_limit', 'setting', 'value');
		////// FORMAT PAYMENT
		$status = false;
		$request= 0;
		$cur = '';
		if($country_id == '161'){
			$cur = '&#8358;';
			if($amount > 0) {
				if($amount > $balance){
					echo $this->Crud->msg('danger', 'Insufficient Funds');
				} else{
					if($amount > $nig_threshhold){
						echo $this->Crud->msg('danger', 'Threshold is '.$cur.$nig_threshhold);
					} else {
						$ref = $this->Crud->transfer_referance();
						$rec_code = $this->Crud->read_field('user_id', $user_id, 'transfer_recipient', 'recp_id');
						$bank = $this->Crud->read_field('id', $user_id, 'user', 'bank_details');
						
						if(empty($rec_code)){
							echo $this->Crud->msg('danger', 'Please Provide your Bank Account Details in your Profile');
						} else{
							if(empty(json_decode($bank))){
								echo $this->Crud->msg('danger', 'Invalid Bank Account Details in your Profile');
							} else{
								$banks = json_decode($bank);
								if(!empty($banks->account_number) && !empty($banks->bank_code)){
									
									$acc_no = $banks->account_number;
									$bank_code = $banks->bank_code;
									$with_data = [
										"source"=>"balance",
										"amount"=>$amount,
										"account_number"=>$acc_no,
										"bank_code"=>$bank_code,
										"reference"=>$ref,
										"recipient"=>$rec_code,
										"reason"=>"Wallet Withdrawal"
	
									];
									// print_r($with_data);
									$withdraw = $this->Crud->withdraws($with_data);
									$withdraws = json_decode($withdraw);
									if($withdraws->status == 'true'){
										$status = true;
										echo $this->Crud->msg('success', 'Withdrawal Successful.');
									} else{
										echo $this->Crud->msg('danger', 'Withdrawal Transaction not Successful. Try Again Later.');
									}

								} else {

									echo $this->Crud->msg('danger', 'Invalid Bank Account Details in your Profile');

								}
								
							}
						}
					}
				}
			} else {
				echo $this->Crud->msg('danger', 'Amount cannot be Zero');
			}
		} else{
			$cur = '£';
			if($amount > 0){
				if($amount > $balance){
					echo $this->Crud->msg('danger', 'Insufficient Funds');
				} else{
					if($amount > $uk_threshhold){
						echo $this->Crud->msg('danger', 'Threshold is '.$cur.$uk_threshhold);
					} else {
						if($this->Crud->check2('user_id', $user_id, 'approved', 0, 'wallet_request') > 0){
							echo $this->Crud->msg('danger', 'You already have a pending request.');
						} else {
							$req['user_id'] = $user_id;
							$req['amount'] = $amount;
							$req['reg_date'] = date(fdate);
							
							$request = $this->Crud->create('wallet_request', $req);

							if($request > 0){
								$status = true;
								echo $this->Crud->msg('success', 'Wallet Withdraw Request Submitted. Would be approved shortly');
								
								$a_id = $this->Crud->read_field('name', 'Administrator', 'access_role', 'id');
								$d_id = $this->Crud->read_field('name', 'Developer', 'access_role', 'id');
								
								$use = $this->Crud->read('user');
								if(!empty($use)){
									foreach($use as $u){
										if($u->role_id != $a_id && $u->role_id != $d_id)continue;
										$id = $u->id;
										$this->Crud->notify($user_id, $id, 'Wallet Request Withdrawal Placed', 'wallet', $request);
									}
								}
								
							} else {
								echo $this->Crud->msg('danger', 'Wallet Withdraw Request Failed.');

							}
						}

					}

				}
			} else {
				echo $this->Crud->msg('danger', 'Amount cannot be Zero');
			}
		}

		if($status == true){
			if(!empty($user_id) && !empty($amount)){
				$v_ins['user_id'] = $user_id;
				$v_ins['type'] = 'debit';
				$v_ins['amount'] = $amount;
				$v_ins['request_id'] = $request;
				$v_ins['item'] = 'withdraw';
				$v_ins['country_id'] = $country_id;
				$v_ins['state_id'] = $state_id;
				$v_ins['item_id'] = $user_id;
				$v_ins['remark'] = 'Wallet Withdrawal';
				$v_ins['reg_date'] = date(fdate);
				
				$w_id = $this->Crud->create('wallet', $v_ins);
				if($w_id > 0) {
					
					$by = $this->Crud->read_field('id', $user_id, 'user', 'fullname');
					$action = $by.' Withdrawed '.$cur.number_format((float)$amount).' from Wallet';
					$this->Crud->activity('wallet', $w_id, $action);
					$redir = 'wallets/list';
					echo '<script>window.location.replace("'.site_url($redir).'");</script>';
				} else {
					echo $this->Crud->web_msg('danger', 'Failed! - Please Contact Support.');
					
				}
			}
		}
	}

	public function	export(){
		$start = $this->session->get('comm_start_date');
		$end = $this->session->get('comm_end_date');
		$state = $this->session->get('comm_state_id');
		$states = '';
		if(!empty($state)){$st = $this->Crud->read_field('id', $state, 'state', 'name'); $states = $st.' State ';}

		if(!empty($start) && !empty($end)){
			if(!empty($state)){
				$comms = $this->Crud->date_range1($start, 'reg_date', $end, 'reg_date', 'state_id', $state, 'commission');
			} else {
				$comms = $this->Crud->date_range($start, 'reg_date', $end, 'reg_date', 'commission');
			}
		} else {
			if(!empty($state)){
				$comms = $this->Crud->read_single('state_id', $state, 'commission');
			} else {
				$comms = $this->Crud->read('commission');
			}
		}
		$codes = '';
		if(!empty($comms)) {
			$count = 1;
			foreach($comms as $co) {
				$item = array();

				$item[] = $count;
				$item[] = date('Y-m-d', strtotime($co->reg_date));
				$code = $co->code;
				$i = 0;
				if($codes != $code){
					$adminFee = number_format((float)$this->Crud->read_field3('role_id', 0, 'code', $code, 'type', 'fee', 'commission', 'amount'), 2);
					$adminComm = number_format((float)$this->Crud->read_field3('role_id', 0, 'code', $code, 'type', 'commission', 'commission', 'amount'), 2);
					$markupComm = number_format((float)$this->Crud->read_field3('role_id', 0, 'code', $code, 'type', 'markup', 'commission', 'amount'), 2);
					$vendorComm = number_format((float)$this->Crud->read_field3('role_id', 2, 'code', $code, 'type', 'commission', 'commission', 'amount'), 2);
					$deliveryComm = number_format((float)$this->Crud->read_field3('role_id', 3, 'code', $code, 'type', 'commission', 'commission', 'amount'), 2);
					$isvComm = number_format((float)$this->Crud->read_field3('role_id', 12, 'code', $code, 'type', 'commission', 'commission', 'amount'), 2);
					$clusterComm = number_format((float)$this->Crud->read_field3('role_id', 13, 'code', $code, 'type', 'commission', 'commission', 'amount'), 2);
					$agentComm = number_format((float)$this->Crud->read_field3('role_id', 14, 'code', $code, 'type', 'commission', 'commission', 'amount'), 2);

					$item[] = $code;
					$item[] = $adminFee;
					$item[] = $adminComm;
					$item[] = $markupComm;
					$item[] = $vendorComm;
					$item[] = $deliveryComm;
					$item[] = $isvComm;
					$item[] = $clusterComm;
					$item[] = $agentComm;
					$i++;
					$row[] = $item;
					$count += 1;
					$codes = $code;
				}

				
			}
		}


		// now export CSV
		$dfile_name = $states.'Commission Report-'.date('dmY', strtotime($start)).'-'.date('dmY', strtotime($end));
		$fname = $dfile_name.'.csv';
		header( "Content-Type: text/csv;charset=utf-8" );
		header( "Content-Disposition: attachment;filename=$fname" );
		header("Pragma: no-cache");
		header("Expires: 0");
		
		$output = fopen('php://output', 'w');
	
		// Column Title
		fputcsv($output, array('S/N', 'Reg Date', 'Order Code', 'Admin Fee', 'Admin Comission', 'Markup', 'Vendor Commission', 'Delivery Commission', 'ISV Commission', 'Cluster Commission', 'Sales Agent Commission'));
		
		// Column Items
		if(!empty($row)) {
		 	foreach($row as $fields) {
		 		fputcsv($output, $fields);
		 	}
		}
		
		fclose($output);
	}
    ////// ACCOUNT STATEMENT
	public function account($id=0) {
	    $email = $this->request->getVar('email');
	    if(!empty($email)) { $id = $this->Crud->read_field('email', $email, 'user', 'id'); }
	    
	    if(empty($id)) { redirect(site_url('wallet')); }
	    
	    $items = '';
	    $total_credit = 0;
	    $total_debit = 0;
	    
	    $name = $this->Crud->read_field('id', $id, 'user', 'fullname');
	    $query = $this->Crud->read_single_order('user_id', $id, 'wallet', 'id', 'asc');
	    if(!empty($query)) {
	        foreach($query as $q) {
	            $date = date('M d, Y h:iA', strtotime($q->reg_date));
	            
	            $credit = '-';
	            $debit = '-';
	            if($q->type == 'credit') {
	                $credit = '&#8358;'.number_format((float)$q->amount, 2);
	                $total_credit += $q->amount;
	            } else {
	                $debit = '&#8358;'.number_format((float)$q->amount, 2);
	                $total_debit += $q->amount;
	            }
	            
	            $items .= '
	                <tr>
	                    <td>'.$date.'</td>
	                    <td align="right">'.$credit.'</td>
	                    <td align="right">'.$debit.'</td>
	                </tr>
	            ';
	        }
	    }
	    
	    echo '
	        <h3>'.$name.' Wallet Account Statement
	            <div style="font-size:small; color:#666;">as at '.date('M d, Y h:iA').'</div>
	        </h3>
	        <table class="table table-striped text-start">
	            <thead>
	                <tr>
	                    <td><b>DATE</b></td>
	                    <td width="200px" align="right"><b>CR</b></td>
	                    <td width="200px" align="right"><b>DR</b></td>
	                </tr>
	            </thead>
	            <tbody>'.$items.'</tbody>
	        </table>
	        <hr/>
	        <div class="float-start"><b>TOTAL CREDIT:</b> &#8358;'.number_format((float)$total_credit, 2).'<br/>
	        <b>TOTAL DEBIT:</b> &#8358;'.number_format((float)$total_debit, 2).'</div>
			<a class="float-end btn btn-danger" href="'.site_url('wallets/list/download/'.$id).'"><em class="icon ni ni-download"></em> <span>Download</span></a><div class="col-sm-12 py-2" id="export_resp"></div>
	    ';
	}

	public function request($id=0) {
		$request_id = $id;
		$user_id = $this->Crud->read_field('id', $id, 'wallet_request', 'user_id');

	    $items = '';
	    
	    $name = $this->Crud->read_field('id', $user_id, 'user', 'fullname');
		$country_id = $this->Crud->read_field('id', $user_id, 'user', 'country_id');
	    $bank_details = json_decode($this->Crud->read_field('id', $user_id, 'user', 'bank_details'));
	    $query = $this->Crud->read_single_order('user_id', $user_id, 'wallet_request', 'id', 'asc');
	    if(!empty($query)) {
	        foreach($query as $q) {
	            $date = date('M d, Y h:iA', strtotime($q->reg_date));
				$st = '<span class="text-danger">Pending</span>';
				if($q->approved > 0){
					$st = '<span class="text-success">Approved</span>';
				}

				$a_date = '-';
				if(!empty($q->approve_date) && $q->approve_date != 0){
					$a_date = date('M d, Y h:iA', strtotime($q->approve_date));
				}
	            $items .= '
	                <tr>
	                    <td>'.$date.'</td>
	                    <td align="right">'.number_format($q->amount,2).'</td>
	                    <td align="right">'.$st.'</td>
	                    <td align="center">'.$a_date.'</td>
	                </tr>
	            ';
	        }
	    }
		$bank = '';
		if(!empty($bank_details)){
			if($country_id == '161'){
				$bank .= 'Bank Account: '.$bank_details->account_number.' | Account Name:'.$bank_details->account_name;
			} else {
				$bank .= 'Paypal Info: '.$bank_details->paypal;
			}
		}
	    
	    echo '
	        <h3>'.$name.' Wallet Withdraw Request History
	            <div style="font-size:small; color:#666;">as at '.date('M d, Y h:iA').'</div>
	        </h3>
			<h5 class="text-danger mt-2 mb-3">'.$bank.'</h5>
	        <table class="table table-striped text-start">
	            <thead>
	                <tr>
	                    <td><b>DATE</b></td>
	                    <td width="" align="right"><b>AMOUNT</b></td>
	                    <td width="" align="right"><b>STATUS</b></td>
	                    <td width="" align="right"><b>APPROVE DATE</b></td>
	                </tr>
	            </thead>
	            <tbody>'.$items.'</tbody>
	        </table>
			
	        
	    ';
	}

	
    

}
