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
		
        $this->session->set('km_redirect', uri_string());
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

		$form_link = site_url('listing/index/');
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
			} elseif($param2 == 'promote'){
				if($param3) {
					$edit = $this->Crud->read_single('id', $param3, $table);
					if(!empty($edit)) {
						foreach($edit as $e) {
							$data['e_id'] = $e->id;
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
					$visible_status = $this->request->getVar('visible_status');
					$visible_local = $this->request->getVar('visible_local');
					$negotiable = $this->request->getVar('negotiable');
					$img = $this->request->getVar('img');

					
					if($negotiable == 'on')$negotiable = 1; else $negotiable = 0;
					if($visible_status == 'on')$visible_status = 1; else $visible_status = 0;

					if($price_status == 'on')$price_status = 1; else $price_status = 0;
					$profile = [];

					if($visible_status == 1){
						if(empty($visible_local))echo $this->Crud->msg('danger', 'Select the State to Display your Listing');die;
					}

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
					$p_data['display_status'] = $visible_status;
					$p_data['display_local'] = json_encode($visible_local);
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
							
							$this->Crud->updates('id', $log_id, 'user', array('has_business'=>1));
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
						$data['e_visible_status'] = $e->display_status;
						$data['e_visible_state'] = json_decode($e->display_local);
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

						$page = 'home/listing/view/'.$id;
						$view = $this->Crud->check('page', $page, 'listing_view');
						

						$users = '';
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
						
						$promote = $this->Crud->check('listing_id', $id, 'business_promotion');
						$ad = '
							<li>
								<a href="'.site_url('listing/index/promote/'.$id).'" class="tolt"  pageTitle="Promote '.$name.'" pageName="" pageSize="modal-lg" data-microtip-position="top-left"  data-tooltip="Promote"><i class="far fa-ad"></i></a>
							</li>
						';

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
													<span class="viewed-counter"><i class="fas fa-eye"></i> Viewed -  '.$view.' </span>
													<span class="viewed-counter"><i class="fas fa-ad"></i> Promotion -  '.$promote.' </span>
													<ul>
														<li><a href="'.site_url('listing/index/edit/'.$id).'" class="tolt" data-microtip-position="top-left"  data-tooltip="Edit"><i class="far fa-edit"></i></a></li>'.$ad.'
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

		
        if($param1 == 'manage') { // view for form data posting
			return view('listing/manage_form', $data);
		} elseif($param1 == 'view'){
			$data['title'] = 'View Listing | '.app_name;
            $data['page_active'] = 'listing';
			if(empty($param2)){
				return redirect()->to(site_url('listing'));	
			}
			return view('listing/view', $data);
		} elseif($param1 == 'promote'){
			$data['title'] = 'Promote Listing | '.app_name;
            $data['page_active'] = 'listing';
			$data['page'] = 'Promote Listing';
			if(empty($param2)){
				return redirect()->to(site_url('listing'));	
			}
			return view('listing/promote', $data);
		} elseif($param1 == 'add' || $param1=='edit'){
			if($param1 == 'edit'){
				 $data['page'] = 'Edit Listing';
				$data['title'] = 'Edit Listing | '.app_name;
			} else {
				$data['page'] = 'New Listing';
             
				$data['title'] = 'New Listing | '.app_name;
			}
            $data['page_active'] = 'listing';
           
			return view('listing/add', $data);
		} else { // view for main page
            
			$data['title'] = 'My Listing | '.app_name;
            $data['page_active'] = 'listing';
            return view('listing/manage', $data);
        }
    }

	public function promote($param1='', $param2=''){
		if(!empty($param1)){
			$log_id = $this->session->get('km_id');
        
			$prom = $this->Crud->read_single('id', $param1, 'promotion');
			$country = $this->Crud->read_field('id', $param2, 'listing', 'country_id');
			if(!empty($prom)){
				foreach($prom as $p){
					$resp['no_view'] = $p->view;
					$resp['duration'] = $p->duration;
					$resp['expiry_date'] = date("Y-m-d H:i:s", strtotime("+$p->duration days", strtotime(date("Y-m-d H:i:s"))));
					if($country == 161){
						$resp['amount'] = $p->nig_amount;
						$resp['currs'] = '&#8358;';

					} else {
						$resp['amount'] = $p->amount;
						$resp['currs'] = '<i class="fal fa-pound-sign"></i>';
					}
					
				}
	
				echo json_encode($resp);
				die;
			}
		}
	}

	public function promotion($param1='', $param2='', $param3='') {
		$db = \Config\Database::connect();
		$this->session->set('km_redirect', uri_string());
        
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
            // return redirect()->to(site_url('profile'));	
        }
        $log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
        $data['log_name'] = $log_name;
        $data['page'] = 'Promotions';
        $data['log_id'] = $log_id;
        $data['role'] = $role;
        $data['role_c'] = $role_c;

        $table = 'business_promotion';

		$form_link = site_url('listing/promotion/');
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
			if($param2 == 'add'){
				if($this->request->getMethod() == 'post'){
					$promote_id = $this->request->getVar('promote_id');
					$listing_id = $this->request->getVar('listing_id');
                    $amount = $this->request->getVar('amount');
					$no_view = $this->request->getVar('no_view');
                    $expiry_date = $this->request->getVar('expiry_date');
                    $duration = $this->request->getVar('duration');

					$promoter_no = $this->Crud->read_field('id', $promote_id, 'promotion', 'promoter_no');
					$user_id = $this->Crud->read_field('id', $listing_id, 'listing', 'user_id');
					$country_id = $this->Crud->read_field('id', $user_id, 'listing', 'country_id');
					$state_id = $this->Crud->read_field('id', $user_id, 'listing', 'state_id');
					$p_data['listing_id'] = $listing_id;
					$p_data['promotion_id'] = $promote_id;
					$p_data['amount'] = $amount;
					$p_data['no_view'] = $no_view;
					$p_data['promoter_no'] = $promoter_no;
					$p_data['expiry_date'] = $expiry_date;
					$code = substr(md5(time().rand()), 0, 6);
                    
					// if($this->Crud->check3('listing_id', $listing_id, 'user_id', $user_id, 'status', 0, $table) > 0){
					// 	echo $this->Crud->msg('warning', 'You have an active Promotion on this Listing.<br>Try again Later');
					// 	die;
					// }

					//Get Business Wallet Balance
					$wallet = $this->Crud->read_single('user_id', $user_id, 'wallet');
					$bal = 0;
					if(!empty($wallet)){
						$credit = 0;$debit =0;
						foreach($wallet as $w){
							if($w->type == 'credit')$credit +=(float)$w->amount;
							if($w->type == 'debit')$debit +=(float)$w->amount;
							
						}
						$bal = $credit - $debit;
					}
					
					if($bal <= $amount){
						echo $this->Crud->msg('danger', 'Insufficient Funds.<br>Please Fund Account First');
					} else{
						if($this->Crud->check('code', $code, $table) > 0) {
							echo $this->Crud->msg('warning', 'Promotion Already Exist');
						} else {
							$p_data['code'] = $code;
							$p_data['user_id'] = $user_id;
							$p_data['reg_date'] = date(fdate);
					
							$ins_rec = $this->Crud->create($table, $p_data);
							if($ins_rec > 0) {
								//Deduct Catch from wallet
								$v_ins['user_id'] = $user_id;
								$v_ins['type'] = 'debit';
								$v_ins['amount'] = $amount;
								$v_ins['item'] = 'listing';
								$v_ins['item_id'] = $ins_rec;
								$v_ins['country_id'] = $country_id;
								$v_ins['state_id'] = $state_id;
								$v_ins['remark'] = 'Business Listing Promotion';
								$v_ins['reg_date'] = date(fdate);
								$w_id = $this->Crud->create('wallet', $v_ins);

								$this->Crud->updates('id', $listing_id, 'listing', array('promote_status'=>1));
								///// store activities
								$code = $this->Crud->read_field('id', $ins_rec, $table, 'code');
								$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
								$action = $by.' Created Promotion '.$code.' for Business';
								$this->Crud->activity('setup', $ins_rec, $action);
								
							
								$this->Crud->updates('id', $user_id, 'user', array('has_promoted'=>1));
								echo $this->Crud->msg('success', 'Promotion Created');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('danger', 'Please try later');	
							}	
						}
					
					}
					

					die;	
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
								$data['e_price'] = $e->amount;
								$data['e_nig_price'] = $e->nig_amount;
								$data['e_view'] = $e->view;
								$data['e_status'] = $e->status;
								$data['e_duration'] = $e->duration;
								$data['e_promoter_no'] = $e->promoter_no;
							}
						}
					}
				}


				// if($this->request->getMethod() == 'post'){
				// 	$promotion_id = $this->request->getVar('promotion_id');
				// 	$promote_id = $this->request->getVar('promote_id');
				// 	$listing_id = $this->request->getVar('listing_id');
                //     $amount = $this->request->getVar('amount');
				// 	$no_view = $this->request->getVar('no_view');
                //     $expiry_date = $this->request->getVar('expiry$expiry_date');
                //     $duration = $this->request->getVar('duration');


				// 	$p_data['name'] = $name;
				// 	$p_data['amount'] = $amount;
				// 	$p_data['status'] = $status;
				// 	$p_data['nig_amount'] = $nig_amount;
				// 	$p_data['view'] = $view;
				// 	$p_data['duration'] = $duration;
				// 	$p_data['promoter_no'] = $promoter_no;
					

				// 	// check if already exist
				// 	if(!empty($promotion_id)) {
				// 		$upd_rec = $this->Crud->updates('id', $promotion_id, $table, $p_data);
				// 		if($upd_rec > 0) {
				// 			///// store activities
				// 			$code = $this->Crud->read_field('id', $promotion_id, $table, 'name');
				// 			$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
				// 			$action = $by.' updated Promotion '.$code.' Record';
				// 			$this->Crud->activity('setup', $promotion_id, $action);

				// 			echo $this->Crud->msg('success', 'Promotion Updated');
				// 			echo '<script>location.reload(false);</script>';
				// 		} else {
				// 			echo $this->Crud->msg('info', 'No Changes');	
				// 		}
				// 	} else {
				// 		if($this->Crud->check('name', $name, $table) > 0) {
				// 			echo $this->Crud->msg('warning', 'Record Already Exist');
				// 		} else {
				// 			$p_data['reg_date'] = date(fdate);
					
				// 			$ins_rec = $this->Crud->create($table, $p_data);
				// 			if($ins_rec > 0) {
				// 				///// store activities
				// 				$code = $this->Crud->read_field('id', $ins_rec, $table, 'name');
				// 				$by = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
				// 				$action = $by.' Created Promotion '.$code.' Record';
				// 				$this->Crud->activity('setup', $ins_rec, $action);

				// 				echo $this->Crud->msg('success', 'Promotion Created');
				// 				echo '<script>location.reload(false);</script>';
				// 			} else {
				// 				echo $this->Crud->msg('danger', 'Please try later');	
				// 			}	
				// 		}
				// 	}
				// 	die;	
				// }
			}
		}

		if($param1 == 'view') {
			if($param2) {
				$edit = $this->Crud->read_single('id', $param2, 'business_promotion');
				if(!empty($edit)) {
					foreach($edit as $e) {
						$data['d_id'] = $e->id;
						$data['code'] = $e->code;
						$data['applicant'] = json_decode($e->applicant);
					}
					
					
				}
			}
			return view('listing/promotion_form', $data);
			exit;	
		}
        // record listing
		if($param1 == 'load') {
			$limit = $param2;
			$offset = $param3;

			$rec_limit = 60;
			$item = '';
			$counts = 0;

			if(empty($limit)) {$limit = $rec_limit;}
			if(empty($offset)) {$offset = 0;}
			
			if (!empty($this->request->getPost('search'))) {$search = $this->request->getPost('search');} else {$search = '';}
			if(!empty($this->request->getPost('promotion_id'))) { $promotion_id = $this->request->getPost('promotion_id'); } else { $promotion_id = ''; }
			if(!empty($this->request->getPost('listing_id'))) { $listing_id = $this->request->getPost('listing_id'); } else { $listing_id = ''; }
			if(!empty($this->request->getPost('start_date'))) { $start_date = $this->request->getPost('start_date'); } else { $start_date = ''; }
			if(!empty($this->request->getPost('end_date'))) { $end_date = $this->request->getPost('end_date'); } else { $end_date = ''; }
			

			$log_id = $this->session->get('km_id');
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$query = $this->Crud->filter_promotion($limit, $offset, $log_id, $search, $promotion_id, $listing_id, $start_date, $end_date);
				$all_rec = $this->Crud->filter_promotion('', '', $log_id, $search, $promotion_id, $listing_id, $start_date, $end_date);
				if(!empty($all_rec)) { $count = count($all_rec); } else { $count = 0; }
				
				if(!empty($query)) {
					foreach($query as $q) {
						$id = $q->id;
						$promotion_id = $q->promotion_id;
						$listing_id = $q->listing_id;
						$amount = $q->amount;
						$code = $q->code;
                        $no_view = $q->no_view;
						$expiry_date = $q->expiry_date;
						$reg_date = $q->reg_date;
                        $status = $q->status;
						
						$st = '<b class="text-danger mb-2">Expired</b><br>';
						if($status == 0)$st = '<b class="text-success mb-2">Active</b><br>';
                        
						
							$all_btn = '
							<b><a href="javascript:;" class="text-primary pop mr-3" pageTitle="View '.$code.' Listing" pageName="'.site_url('listing/promotion/view/'.$id).'" pageSize="modal-md">
								<i class="fal fa-eye"></i> VIEW
							</a> </b>
							
                            ';
							
							$promotion = $this->Crud->read_field('id', $promotion_id, 'promotion', 'name');
                        $country = $this->Crud->read_field('id', $listing_id, 'listing', 'country_id');
						$cur = '£';
                        if($country == 161)$cur = ' ₦';
						
						$item .= '
							<li class="list-group-item">
								<div class="row pt-3">
									<div class="col-12 col-sm-5 mb-2">
										<div class="single">
											<div class="font-size-12 small text-dark">'.date('d F Y', strtotime($reg_date)).'</div>
											<b class="text-primary">'.strtoupper($code).'</b>
											<div class="font-size-12 small text-danger">Expires &rarr;'.date('d F Y', strtotime($expiry_date)).'</div>
										</div>
									</div>
									<div class="col-12 col-md-4 mb-2">
										<div class="single">
                                            <div class="text-dark font-weight-bold"> '.strtoupper($promotion).' PROMOTION</div>
											<b class="font-size-14 text-danger">'.$cur.''.number_format($amount,2).'</b>
											<div class="text-muted">'.$no_view.' Views</div>
										</div>
									</div>
                                    <div class="col-12 col-md-3 mb-2">
										<div class="single text-end">'.$st.'<br>
											<div class="text-muted ">'.$all_btn.'</div>
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
						<i class="fal fa-ad" style="font-size:150px;"></i><br/><br/>No Promotion Returned<br>
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



        if($param1 == 'view') { // view for form data posting
			return view('listing/promotion_form', $data);
		} else { // view for main page
            
			$data['title'] = 'Promotions | '.app_name;
            $data['page_active'] = 'settings/promotion';
            return view('listing/promoton', $data);
        }
    }
}
