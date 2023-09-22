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
		if($param2){$form_link .= '/'.$param2.'/';}
		if($param3){$form_link .= $param3;}
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$data['form_link'] = $form_link;
		
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
			if(!empty($this->request->getPost('type'))) { $type = $this->request->getPost('type'); } else { $type = ''; }
			if(!empty($this->request->getPost('transact'))) { $transact = $this->request->getPost('transact'); } else { $transact = ''; }
			if(!empty($this->request->getPost('start_date'))) { $start_date = $this->request->getPost('start_date'); } else { $start_date = ''; }
			if(!empty($this->request->getPost('end_date'))) { $end_date = $this->request->getPost('end_date'); } else { $end_date = ''; }
			
			$total = 0;
			$credit = 0;
			$debit = 0;
			
			$log_id = $this->session->get('km_id');
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$all_rec = $this->Crud->filter_wallet('', '', $log_id, $type, $transact,$search, $start_date, $end_date);
              
				if(!empty($all_rec)) { $counts = count($all_rec); } else { $counts = 0; }

				$query = $this->Crud->filter_wallet($limit, $offset, $log_id, $type, $transact,$search, $start_date, $end_date);
				if(!empty($all_rec)) { $count = count($all_rec); } else { $count = 0; }
				
				//print_r($query);
				$curr = '&#8358;';
					
				if(!empty($query)) {
					foreach($query as $q) {
						
						$id = $q->id;
						$user_id = $q->user_id;
						$type = $q->type;
						$mod = $q->item;
						$mod_id = $q->item_id;
						$remark = $q->remark;
						$amount = number_format((float)$q->amount, 2);
						$reg_date = date('M d, Y h:i A', strtotime($q->reg_date));

						$user_email = $this->Crud->read_field('id', $user_id, 'user', 'email');
						$country = $this->Crud->read_field('id', $user_id, 'user', 'country_id');
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
						
						
						if($type == 'credit')$credit+= (float)$q->amount;
						if($type == 'debit')$debit+= (float)$q->amount;
						
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
									<div class="col-10 col-md-8 mb-4">
										<div class="single">
											<b class="font-size-16 text-'.$color.'">'.strtoupper($type).'</b>
											<div class="font-size-16 text-dark">'.strtoupper($remark).'</div>
											<span class="tb-lead"><b>' . $curr . $amount . '</b></span>
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
			
			$resp['total'] = $curr.number_format($total, 2);
			$resp['credit'] = $curr.number_format($credit, 2);
			$resp['debit'] = $curr.number_format($debit, 2);
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

		if($param1 == 'manage' || $param1 == 'fund' || $param1 == 'statement' ) { // view for form data posting
			return view($mod.'_form', $data);
		} else { // view for main page
			
			$data['title'] = 'Wallets  | '.app_name;
			$data['page_active'] = $mod;
			return view($mod, $data);
		}
    }

	public function wallet_fund(){
		$user_id = $this->request->getPost('user_id');
		$amount = $this->request->getPost('tot_amount');
		$r_amount = $this->request->getPost('amount');

		////// FORMAT PAYMENT
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

	
    

}
