<?php

namespace App\Controllers;

class Message extends BaseController {
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
		
        $this->session->set('km_redirect', uri_string());
        $role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
        $role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
        $role_c = $this->Crud->module($role_id, 'message', 'create');
        $role_r = $this->Crud->module($role_id, 'message', 'read');
        $role_u = $this->Crud->module($role_id, 'message', 'update');
        $role_d = $this->Crud->module($role_id, 'message', 'delete');
        if($role_r == 0){
            return redirect()->to(site_url('profile'));	
        }

        $data['log_id'] = $log_id;
        $data['role'] = $role;
        $data['role_c'] = $role_c;
		$log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
        $data['log_name'] = $log_name;
        $data['page'] = 'Message';
       
        $table = 'message';

		$form_link = site_url('message/index/');
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
						$del_id = $this->request->getVar('d_listing_id');
						///// store activities
						$code = $this->Crud->read_field('id', $del_id, 'listing', 'name');
						$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
						$action = $by.' deleted Listing '.$code.' Record';
						
						if($this->Crud->deletes('id', $del_id, $table) > 0) {
							$this->Crud->activity('listing', $del_id, $action);

							echo $this->Crud->msg('success', 'Record Deleted');
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('danger', 'Please try later');
						}
						exit;	
					}
				}
			} elseif($param2 == 'disable'){
				if($param3) {
					$edit = $this->Crud->read_single('id', $param3, $table);
					if(!empty($edit)) {
						foreach($edit as $e) {
							$data['e_id'] = $e->id;
							$data['e_active'] = $e->active;
						}
					}

					if($this->request->getMethod() == 'post'){
						$del_id = $this->request->getVar('d_listing_id');
						$active = $this->request->getVar('active');
						
						///// store activities
						$code = $this->Crud->read_field('id', $del_id, 'listing', 'name');
						$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
						$action = $by.' enabled Listing '.$code.'';
						if($active  == 0)$action = $by.' disabled Listing '.$code.'';

						if($this->Crud->updates('id', $del_id, $table, array('active'=>$active)) > 0) {
							$this->Crud->activity('listing', $del_id, $action);

							echo $this->Crud->msg('success', 'Listing Status Updated');
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('danger', 'Please try later');
						}
						exit;	
					}
				}
			} else {
				// prepare for edit
				
				if($this->request->getMethod() == 'post'){
					$listing_id = $this->request->getVar('listing_id');
					$title = $this->request->getVar('title');
					$sub_id = $this->request->getVar('sub_id');
					$state_id = $this->request->getVar('state_id');
					$city_id = $this->request->getVar('city_id');
					$price = $this->request->getVar('price');
					$description = $this->request->getVar('description');
					$price_status = $this->request->getVar('price_status');
					$email = $this->request->getVar('b_email');
					$phone = $this->request->getVar('b_phone');
					$website = $this->request->getVar('website');
					$address = $this->request->getVar('address');
					$facebook = $this->request->getVar('facebook');
					$instagram = $this->request->getVar('instagram');
					$whatsapp = $this->request->getVar('whatsapp');
					$twitter = $this->request->getVar('twitter');
					$negotiable = $this->request->getVar('negotiable');
					$img = $this->request->getVar('img');

					if($negotiable == 'on')$negotiable = 1; else $negotiable = 0;

					if($price_status == 'on')$price_status = 1; else $price_status = 0;
					$profile = [];

					$profile['website'] = $website;
					$profile['facebook'] = $facebook;
					$profile['instagram'] = $instagram;
					$profile['whatsapp'] = $whatsapp;
					$profile['twitter'] = $twitter;
					

					$uploadedImagePaths = [];
					/// upload image
                    if(!empty($_FILES['pics']['name'])) {
                        $path = 'assets/images/listings/'.$log_id.'/';
						
        				if (!is_dir($path)) mkdir($path, 0755);

						
						for ($i = 0; $i < count($_FILES['pics']['name']); $i++) {
							$filename = $_FILES['pics']['name'][$i];
							$tmp_name = $_FILES['pics']['tmp_name'][$i];
							$uniqueName = uniqid() . '_' . $filename;

							$target_path = $path . $uniqueName;
					
							 // Move the uploaded file to the desired directory
							if (move_uploaded_file($tmp_name, $target_path)) {
								$uploadedImagePaths[] = $target_path;
							} else {
								// Handle the case where the file couldn't be moved
								// echo "Error uploading file '$filename'.<br>";
							}
						}
                    }

					if(!empty($img)){
						foreach ($img as $key => $value) {
							if(!empty($value))$uploadedImagePaths[] = $value;
						}
					}

					if(empty($uploadedImagePaths)){
						echo $this->Crud->msg('danger', 'At least one image must be uploaded');
						die;
					}
					// echo json_encode($uploadedImagePaths);
					// die;
					
					// echo $negotiable.' '.$price_status;
					$p_data['name'] = $title;
					$p_data['state_id'] = $state_id;
					$p_data['country_id'] = $this->Crud->read_field('id', $state_id, 'state', 'country_id');
					$p_data['city_id'] = $city_id;
					$p_data['price'] = $price;
					$p_data['images'] = json_encode($uploadedImagePaths);
					$p_data['description'] = $description;
					$p_data['price_status'] = $price_status;
					$p_data['negotiable'] = $negotiable;
					$p_data['category_id'] = $sub_id;
					$p_data['address'] = $address;
					$p_data['email'] = $email;
					$p_data['phone'] = $phone;
					$p_data['profile'] = json_encode($profile);

					// check if already exist
					if(!empty($listing_id)) {
						$upd_rec = $this->Crud->updates('id', $listing_id, $table, $p_data);
						if($upd_rec > 0) {
							///// store activities
							$code = $this->Crud->read_field('id', $listing_id, 'listing', 'name');
							$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
							$action = $by.' updated Listing '.$code.' Record';
							$this->Crud->activity('listing', $listing_id, $action);

							echo $this->Crud->msg('success', 'Listing Updated');
							echo '<script>window.location.replace("'.site_url('listing').'");</script>';
						} else {
							echo $this->Crud->msg('info', 'No Changes');	
						}
					} else {
						$p_data['reg_date'] = date(fdate);
						$p_data['user_id'] = $log_id;


						$ins_rec = $this->Crud->create('listing', $p_data);
						if($ins_rec > 0) {
							///// store activities
							$code = $this->Crud->read_field('id', $ins_rec, 'listing', 'name');
							$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
							$action = $by.' created Listing '.$code.' Record';
							$this->Crud->activity('listing', $ins_rec, $action);

							echo $this->Crud->msg('success', 'Listing Created');
							echo '<script>window.location.replace("'.site_url('listing').'");</script>';
						} else {
							echo $this->Crud->msg('danger', 'Please try later');	
						}
					}

					die;	
				}
			}
		}

		if($param1 == 'edit') {
			if($param2) {
				$edit = $this->Crud->read_single('id', $param2, $table);
				if(!empty($edit)) {
					foreach($edit as $e) {
						$data['e_id'] = $e->id;
						$data['e_name'] = $e->name;
						$data['e_category_id'] = $e->category_id;
						$data['e_state_id'] = $e->state_id;
						$data['e_city_id'] = $e->city_id;
						$data['e_description'] = $e->description;
						$data['e_price'] = $e->price;
						$data['e_price_status'] = $e->price_status;
						$data['e_negotiable'] = $e->negotiable;
						$data['e_images'] = json_decode($e->images);
						$data['e_address'] = $e->address;
						$data['e_email'] = $e->email;
						$data['e_phone'] = $e->phone;
						$data['e_profile'] = json_decode($e->profile);
						$data['e_main'] = $this->Crud->read_field('id', $e->category_id, 'category', 'category_id');
						
					}
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
			$active = $this->request->getVar('active');
			if(!empty($this->request->getPost('country_id'))) { $country_id = $this->request->getPost('country_id'); } else { $country_id = ''; }
			if(!empty($this->request->getPost('state_id'))) { $state_id = $this->request->getPost('start_date'); } else { $state_id = ''; }
			if(!empty($this->request->getPost('city_id'))) { $city_id = $this->request->getPost('city_id'); } else { $city_id = ''; }
			if(!empty($this->request->getPost('start_date'))) { $start_date = $this->request->getPost('start_date'); } else { $start_date = ''; }
			if(!empty($this->request->getPost('category_id'))) { $category_id = $this->request->getPost('category_id'); } else { $category_id = ''; }
			if(!empty($this->request->getPost('end_date'))) { $end_date = $this->request->getPost('end_date'); } else { $end_date = ''; }
			
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$query = $this->Crud->filter_listing($limit, $offset, $log_id, $search,$category_id, $active,  $country_id,$state_id,$city_id, $start_date, $end_date);
				$all_rec = $this->Crud->filter_listing('', '', $log_id, $search, $category_id, $active, $country_id,$state_id,$city_id, $start_date, $end_date);
				if(!empty($all_rec)) { $count = count($all_rec); } else { $count = 0; }
				$role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
				$role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
				
				if(!empty($query)) {
					foreach($query as $q) {
						$id = $q->id;
						$name = $q->name;
						$category_id = $q->category_id;
						$state_id = $q->state_id;
						$address = $q->address;
						$country_id = $q->country_id;
						$city_id = $q->city_id;
						$price = $q->price;
						$description = $q->description;
						$price_status = $q->price_status;
						$negotiable = $q->negotiable;
						$user_id = $q->user_id;
						$active = $q->active;
						$images = $q->images;
						$reg_date = date('M d, Y h:i A', strtotime($q->reg_date));

						$images = json_decode($images);
						$main = 'assets/images/file.png';
						if(!empty($images)){
							$main = $images[0];
						}

						$users = 'a';
						if($role == 'developer' || $role == 'administrator'){
							$users = '<br><div class="geodir-category-location mb-2">
								<a href="javascript:;"><i class="fal fa-user-secret"></i> <span>'.ucwords($this->Crud->read_field('id', $user_id, 'user', 'fullname')).'</b></span></a>
							</div>';
						}
						
						$category = $this->Crud->read_field('id', $category_id, 'category', 'name');
						$main_id = $this->Crud->read_field('id', $category_id, 'category', 'category_id');
						$mains = $this->Crud->read_field('id', $main_id, 'category', 'name');
						
						$country = $this->Crud->read_field('id', $country_id, 'country', 'name');
						$state = $this->Crud->read_field('id', $state_id, 'state', 'name');
						$city = $this->Crud->read_field('id', $city_id, 'city', 'name');
						
						$loca = '';
						
						if(!empty($address)) $loca .= $address.', ';
						if(!empty($city_id)) $loca .= $city;
						if(!empty($state_id)) $loca .= ', '.$state;
						if(!empty($country_id)) $loca .= ', '.$country;

						$act = '<a href="javascript:;" class="pop tolt"  pageTitle="Disable '.$name.' Record" pageName="'.site_url('listing/index/manage/disable/'.$id).'" pageSize="modal-sm" data-microtip-position="top-left"  data-tooltip="Enable"><i class="far fa-signal"></i></a>';
						if($active > 0)$act = '<a href="javascript:;" class="pop tolt"  pageTitle="Disable '.$name.' Record" pageName="'.site_url('listing/index/manage/disable/'.$id).'" pageSize="modal-sm" data-microtip-position="top-left"  data-tooltip="Disable"><i class="far fa-signal-alt-slash"></i></a>';
						$item .= '
							<li class="list-group-item ">
								<div class="row pt-4 align-items-center ">
									<div class="col-md-12">
										<div class="dashboard-listings-item fl-wrap">
											<div class="dashboard-listings-item_img text-center">
												<div class="bg-wrap">
													<div class="bg  "  data-bg="'.site_url($main).'" style="background-image: url('.$main.');"></div>
												</div>
												<div class="overlay"></div>
												<a href="'.site_url('listing/index/view/'.$id).'" class="color-bg">View</a>
											</div>
											<div class="dashboard-listings-item_content">
												<h4><a href="'.site_url('listing/index/view/'.$id).'">'.$name.'</a></h4>
												<div class="geodir-category-location mb-3">
													<a href="javascript:;"><i class="fal fa-list-alt"></i> <span>'.$category.'&#8594; <b>'.$mains.'</b></span></a>
												</div><br>
												<div class="geodir-category-location mb-2">
													<a href="javascript:;"><i class="fas fa-map-marker-alt"></i> <span> '.$loca.'</span></a>
												</div>
												
												'.$users.'
												<div class="clearfix"></div>
												<div class="dashboard-listings-item_opt text-center">
													<span class="viewed-counter"><i class="fas fa-eye"></i> Viewed -  0 </span>
													<ul>
														<li><a href="'.site_url('listing/index/edit/'.$id).'" class="tolt" data-microtip-position="top-left"  data-tooltip="Edit"><i class="far fa-edit"></i></a></li>
														<li>'.$act.'</li>
														<li><a href="javascript:;" class="pop tolt"  pageTitle="Delete '.$name.' Record" pageName="'.site_url('listing/index/manage/delete/'.$id).'" pageSize="modal-sm" data-microtip-position="top-left"  data-tooltip="Delete"><i class="far fa-trash-alt"></i></a></li>
													</ul>
												</div>
											</div>
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
						<i class="fal fa-clipboard-list-check" style="font-size:150px;"></i><br/><br/>No Listing Returned
					</div>
				';
			} else {
				$resp['item'] = $item;
			}
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
		
		
		// record listing
		if($param1 == 'load_chat') {
			
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$query = $this->Crud->read_group('km_message', 'code');
				$counts = count($query);
				$count = 0;
				$item = '';
				if(!empty($query)) {
					$array = [];
					
					foreach($query as $q) {
						$id = $q->id;
						$sender_id = $q->sender_id;
						$code = $q->code;
						$listing_id = $q->listing_id;
						$receiver_id = $q->receiver_id;
						$message = $q->message;
						$reg_date = date('M d, Y h:i A', strtotime($q->reg_date));

						//check if message has been initiated before between the parties

						
						$count = $this->Crud->check3('receiver_id', $log_id, 'code', $code, 'status', 0, 'message');
						$m_count = '';
						if($count > 0)$m_count = '<div class="message-counter">'.$count.'</div>';

						$listing = $this->Crud->read_field('id', $listing_id, 'listing', 'name');
						$sender = $this->Crud->read_field('id', $sender_id, 'user', 'fullname');
						$sender_img = $this->Crud->read_field('id', $sender_id, 'user', 'img_id');
						if(empty($sender_img))$sender_img = 'assets/images/avatar.png';

						$item .= '
							<a class="chat-contacts-item" href="javascript:;" id="chat_'.$code.'" onclick="get_chats(this)">
								<div class="dashboard-message-avatar">
									<img src="'.site_url($sender_img).'" alt="">
									'.$m_count.'
								</div>
								<div class="chat-contacts-item-text">
									<h4>'.$sender.'</h4>
									
									<span>'.$reg_date.' </span>
									<h4 class="text-info">'.ucwords($listing).'</h4>
									<p>'.$message.'</p>
								</div>
							</a>
						
						';
					}
				}
			}
			if(empty($item)) {
				$resp['item'] = '
					<div class="text-center text-muted">
						<br/><br/><br/><br/>
						<i class="fal fa-comment-alt-lines" style="font-size:150px;"></i><br/><br/>No Chat Returned
					</div>
				';
			} else {
				$resp['item'] = $item;
			}
			$resp['count'] = $counts;

			
			echo json_encode($resp);
			die;
		}

		// record listing
		if($param1 == 'load_message') {
			
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$code = $this->request->getPost('code');

				$query = $this->Crud->read_single_order('code', $code, 'km_message', 'id', 'asc');
				$counts = count($query);
				$count = 0;
				$item = '';
				if(!empty($query)) {
					foreach($query as $q) {
						$id = $q->id;
						$sender_id = $q->sender_id;
						$code = $q->code;
						$listing_id = $q->listing_id;
						$receiver_id = $q->receiver_id;
						$message = $q->message;
						$reg_date = date('M d, Y h:i A', strtotime($q->reg_date));

						//check if message has been initiated before between the parties

						
						$count = $this->Crud->check3('receiver_id', $log_id, 'code', $code, 'status', 0, 'message');
						$m_count = '';
						if($count > 0)$m_count = '<div class="message-counter">'.$count.'</div>';

						$listing = $this->Crud->read_field('id', $listing_id, 'listing', 'name');
						$sender = $this->Crud->read_field('id', $sender_id, 'user', 'fullname');
						$sender_img = $this->Crud->read_field('id', $sender_id, 'user', 'img_id');
						if(empty($sender_img))$sender_img = 'assets/images/avatar.png';

						$receiver = $this->Crud->read_field('id', $receiver_id, 'user', 'fullname');
						$receiver_img = $this->Crud->read_field('id', $receiver_id, 'user', 'img_id');
						if(empty($receiver_img))$receiver_img = 'assets/images/avatar.png';

						if($sender_id == $log_id){
							$ite = '
							<div class="chat-message chat-message_user fl-wrap">
								<div class="dashboard-message-avatar">
									<img src="'.site_url($sender_img).'" alt="">
									<span class="chat-message-user-name cmun_sm">'.ucwords($sender).'</span>
								</div>
								<span class="massage-date">'.date('d F Y', strtotime($q->reg_date)).'  <span>'.date('h:i A', strtotime($q->reg_date)).' </span></span>
								<p>'.$message.'</p>
							</div>
							
							';
						}

						if($receiver_id == $log_id){
							$ite = '
								<div class="chat-message   fl-wrap">
									<div class="dashboard-message-avatar">
										<img src="'.site_url($sender_img).'" alt="">
										<span class="chat-message-user-name cmun_sm">'.ucwords($sender).'</span>
									</div>
									<span class="massage-date">'.date('d F Y', strtotime($q->reg_date)).'  <span>'.date('h:i A', strtotime($q->reg_date)).' </span></span>
									<p>'.$message.'</p>
								</div>
							
							';
						}

						$item .= $ite.'
							
						';
					}
				}
			}
			if(empty($item)) {
				$resp['item'] = '<div class="chat-box fl-wrap">
				<div class="chat-box-scroll fl-wrap full-height" data-simplebar="init">
					<div class="text-center text-muted">
						<br/><br/><br/><br/>
						<i class="fal fa-comment-alt-lines" style="font-size:150px;"></i><br/><br/>No Message Returned
					</div></div>
					</div>
				';
			} else {
				$resp['item'] = '
					<div class="chat-box fl-wrap">
						<div class="chat-box-scroll fl-wrap full-height" data-simplebar="init" id="chatBox">
						'.$item.'
						</div>
					</div>
					<input type="hidden" id="chat_code" value="'.$code.'">
					<div class="chat-widget_input">
						<textarea id="chat_msg" placeholder="Type Message" ></textarea>
						<button type="button" onclick="send_chat()" class="color-bg"><i class="fal fa-paper-plane"></i></button>
					</div>
					<script>
					
					</script>
					';
			}
			$resp['count'] = $counts;

			
			echo json_encode($resp);
			die;
		}

		if($param1 == 'send_message'){
			$code = $this->request->getPost('code');
			$msg = $this->request->getPost('msg');
			
			$listing_id = $this->Crud->read_field('code', $code, 'message', 'listing_id');
			$sender_id = $this->Crud->read_field('code', $code, 'message', 'sender_id');
			$receiver_id = $this->Crud->read_field('code', $code, 'message', 'receiver_id');

			if($log_id == $sender_id){
				$send_id = $sender_id;
				$receive_id = $receiver_id;
				
			} else {
				$send_id = $receiver_id;
				$receive_id = $sender_id;
				
			}

			$data = array(
                'sender_id' => $send_id,
                'receiver_id' => $receive_id,
                'listing_id' => $listing_id,
                'code' => $code,
                'message' => $msg,
                'reg_date' => date('Y-m-d H:i:s'),
                'status' => 0,
            );

			$this->Crud->create('message', $data);

			die;
		}

		if($param1 == 'update_message'){
			$code = $this->request->getPost('code');
			
			$query = $this->Crud->read_single('code', $code, 'message');
			if(!empty($query)){
				foreach($query as $q){
					$id = $q->id;
					if($q->receiver_id != $log_id)continue;
					$this->Crud->updates('id', $id, 'message', array('status' => '1'));
				}
			}

			die;
		}
		
		
        if($param1 == 'manage') { // view for form data posting
			return view('message/manage_form', $data);
		
		} else { // view for main page
            
			$data['title'] = 'Message | '.app_name;
            $data['page_active'] = 'listing';
            return view('message/manage', $data);
        }
    }

}
