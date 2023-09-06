<?php

namespace App\Controllers;

class Home extends BaseController {
    private $db;

    public function __construct() {
		$this->db = \Config\Database::connect();
	}

    public function index() {
        $db = \Config\Database::connect();

        // check login
        $log_id = $this->session->get('km_id'); 
        $role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
        $role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
       

        $data['log_id'] = $log_id;
        $data['role'] = $role;
        
        
        $data['title'] = ' '.app_name;
        $data['page_active'] = 'home';
        return view('home/land', $data);
    }

    public function listing($param1='', $param2='', $param3='') {
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
					$negotiable = $this->request->getVar('negotiable');
					$img = $this->request->getVar('img');

					if($negotiable == 'on')$negotiable = 1; else $negotiable = 0;

					if($price_status == 'on')$price_status = 1; else $price_status = 0;


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
			if(!empty($this->request->getPost('active'))) { $active = $this->request->getPost('active'); } else { $active = ''; }
			if(!empty($this->request->getPost('country_id'))) { $country_id = $this->request->getPost('country_id'); } else { $country_id = ''; }
			if(!empty($this->request->getPost('state_id'))) { $state_id = $this->request->getPost('start_date'); } else { $state_id = ''; }
			if(!empty($this->request->getPost('city_id'))) { $city_id = $this->request->getPost('city_id'); } else { $city_id = ''; }
			if(!empty($this->request->getPost('start_date'))) { $start_date = $this->request->getPost('start_date'); } else { $start_date = ''; }
			if(!empty($this->request->getPost('category_id'))) { $category_id = $this->request->getPost('category_id'); } else { $category_id = ''; }
			if(!empty($this->request->getPost('end_date'))) { $end_date = $this->request->getPost('end_date'); } else { $end_date = ''; }
			
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$query = $this->Crud->filter_listings($limit, $offset, $log_id, $search,$category_id, $active,  $country_id,$state_id,$city_id, $start_date, $end_date);
				$all_rec = $this->Crud->filter_listings('', '', $log_id, $search, $category_id, $active, $country_id,$state_id,$city_id, $start_date, $end_date);
				if(!empty($all_rec)) { $count = count($all_rec); } else { $count = 0; }
				$role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
				$role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
				
				if(!empty($query)) {
					foreach($query as $q) {
						$id = $q->id;
						$name = $q->name;
						$category_id = $q->category_id;
						$state_id = $q->state_id;
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

							$user =  ucwords($this->Crud->read_field('id', $user_id, 'user', 'fullname'));
						
						
						$category = $this->Crud->read_field('id', $category_id, 'category', 'name');
						$main_id = $this->Crud->read_field('id', $category_id, 'category', 'category_id');
						$mains = $this->Crud->read_field('id', $main_id, 'category', 'name');
						
						$country = $this->Crud->read_field('id', $country_id, 'country', 'name');
						$state = $this->Crud->read_field('id', $state_id, 'state', 'name');
						$city = $this->Crud->read_field('id', $city_id, 'city', 'name');
						
						$loca = '';
						
						if(!empty($city_id)) $loca .= $city;
						if(!empty($state_id)) $loca .= ', '.$state;
						if(!empty($country_id)) $loca .= ', '.$country;

						$act = '<a href="javascript:;" class="pop tolt"  pageTitle="Disable '.$name.' Record" pageName="'.site_url('listing/index/manage/disable/'.$id).'" pageSize="modal-sm" data-microtip-position="top-left"  data-tooltip="Enable"><i class="far fa-signal"></i></a>';
						if($active > 0)$act = '<a href="javascript:;" class="pop tolt"  pageTitle="Disable '.$name.' Record" pageName="'.site_url('listing/index/manage/disable/'.$id).'" pageSize="modal-sm" data-microtip-position="top-left"  data-tooltip="Disable"><i class="far fa-signal-alt-slash"></i></a>';

						$item .= '
                            <div class="gallery-item">
                                <div class="listing-item">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img fl-wrap" style="height: 250px;">
                                            <a href="'.site_url('home/listing/view/'.$id).'" class="geodir-category-img_item mb-3">
                                                <img src="'.site_url($main).'" alt="" style="height:250px">
                                                <div class="overlay"style="height:250px"></div>
                                            </a>
                                            <div class="geodir-category-location pt-5">
                                                <a href="javascript:;" class="single-map-item"><i class="fas fa-map-marker-alt"></i> <span>'.$loca.'</span></a>
                                            </div>
                                            <ul class="list-single-opt_header_cat">
                                                <li><a href="javascript:;" class="cat-opt blue-bg mb-3">'.$category.'</a></li>
                                                <li><a href="javascript:;" class="cat-opt color-bg text-end"><b>'.$mains.'</b></a></li>
                                            </ul>
                                            
                                            <div class="geodir-category-listing_media-list">
                                                <span><i class="fas fa-eye"></i> 0</span>
                                            </div>
                                        </div>
                                        <div class="geodir-category-content fl-wrap">
                                            <h3 class="title-sin_item"><a href="'.site_url('home/listing/view/'.$id).'">'.ucwords($name).'</a></h3>
                                            <div class="geodir-category-content_price">$ '.number_format($price,2).'</div>
                                            
                                            <div class="geodir-category-footer fl-wrap">
                                                <a href="agent-single.html" class="gcf-company"><img src="'.site_url().'assets/images/avatar/2.jpg" alt=""><span>'.$user.'</span></a>
                                                <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Good" data-starrating2="4"></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>															
                            </div>
						';
					}
				}
			}
			if(empty($item)) {
				$resp['item'] = '
					<div class="text-center text-muted mb-5">
						<br/>
						<i class="fal fa-clipboard-list-check" style="font-size:150px;"></i><br/><br/>No Listing Returned
					</div>
				';
			} else {
				$resp['item'] = '<div class="grid-item-holder gallery-items fl-wrap" >'.$item.'</div>';
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

		
        
            
        $data['title'] = 'View Listing | '.app_name;
        $data['page_active'] = 'listing';
        if(empty($param2)){
            return redirect()->to(site_url(''));	
        }
        return view('home/list_view', $data);
        
    }

    public function list_load($param1='', $param2='', $param3=''){
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
			if(!empty($this->request->getPost('active'))) { $active = $this->request->getPost('active'); } else { $active = ''; }
			if(!empty($this->request->getPost('country_id'))) { $country_id = $this->request->getPost('country_id'); } else { $country_id = ''; }
			if(!empty($this->request->getPost('state_id'))) { $state_id = $this->request->getPost('start_date'); } else { $state_id = ''; }
			if(!empty($this->request->getPost('city_id'))) { $city_id = $this->request->getPost('city_id'); } else { $city_id = ''; }
			if(!empty($this->request->getPost('start_date'))) { $start_date = $this->request->getPost('start_date'); } else { $start_date = ''; }
			if(!empty($this->request->getPost('category_id'))) { $category_id = $this->request->getPost('category_id'); } else { $category_id = ''; }
			if(!empty($this->request->getPost('end_date'))) { $end_date = $this->request->getPost('end_date'); } else { $end_date = ''; }
			
            $log_id = 1;
			if(!$log_id) {
				$item = '<div class="text-center text-muted">Session Timeout! - Please login again</div>';
			} else {
				$query = $this->Crud->filter_listings($limit, $offset, $log_id, $search,$category_id, $active,  $country_id,$state_id,$city_id, $start_date, $end_date);
				$all_rec = $this->Crud->filter_listings('', '', $log_id, $search, $category_id, $active, $country_id,$state_id,$city_id, $start_date, $end_date);
				if(!empty($all_rec)) { $count = count($all_rec); } else { $count = 0; }
				$role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
				$role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
				
				if(!empty($query)) {
					foreach($query as $q) {
						$id = $q->id;
						$name = $q->name;
						$category_id = $q->category_id;
						$state_id = $q->state_id;
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

							$user =  ucwords($this->Crud->read_field('id', $user_id, 'user', 'fullname'));
						
						
						$category = $this->Crud->read_field('id', $category_id, 'category', 'name');
						$main_id = $this->Crud->read_field('id', $category_id, 'category', 'category_id');
						$mains = $this->Crud->read_field('id', $main_id, 'category', 'name');
						
						$country = $this->Crud->read_field('id', $country_id, 'country', 'name');
						$state = $this->Crud->read_field('id', $state_id, 'state', 'name');
						$city = $this->Crud->read_field('id', $city_id, 'city', 'name');
						
						$loca = '';
						
						if(!empty($city_id)) $loca .= $city;
						if(!empty($state_id)) $loca .= ', '.$state;
						if(!empty($country_id)) $loca .= ', '.$country;

						$act = '<a href="javascript:;" class="pop tolt"  pageTitle="Disable '.$name.' Record" pageName="'.site_url('listing/index/manage/disable/'.$id).'" pageSize="modal-sm" data-microtip-position="top-left"  data-tooltip="Enable"><i class="far fa-signal"></i></a>';
						if($active > 0)$act = '<a href="javascript:;" class="pop tolt"  pageTitle="Disable '.$name.' Record" pageName="'.site_url('listing/index/manage/disable/'.$id).'" pageSize="modal-sm" data-microtip-position="top-left"  data-tooltip="Disable"><i class="far fa-signal-alt-slash"></i></a>';

						$item .= '
                            <div class="gallery-item">
                                <div class="listing-item">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img fl-wrap" style="height: 250px;">
                                            <a href="'.site_url('home/listing/view/'.$id).'" class="geodir-category-img_item mb-3">
                                                <img src="'.site_url($main).'" alt="" style="height:250px">
                                                <div class="overlay"style="height:250px"></div>
                                            </a>
                                            <div class="geodir-category-location pt-5">
                                                <a href="javascript:;" class="single-map-item"><i class="fas fa-map-marker-alt"></i> <span>'.$loca.'</span></a>
                                            </div>
                                            <ul class="list-single-opt_header_cat">
                                                <li><a href="javascript:;" class="cat-opt blue-bg mb-3">'.$category.'</a></li>
                                                <li><a href="javascript:;" class="cat-opt color-bg text-end"><b>'.$mains.'</b></a></li>
                                            </ul>
                                            
                                            <div class="geodir-category-listing_media-list">
                                                <span><i class="fas fa-eye"></i> 0</span>
                                            </div>
                                        </div>
                                        <div class="geodir-category-content fl-wrap">
                                            <h3 class="title-sin_item"><a href="'.site_url('home/listing/view/'.$id).'">'.ucwords($name).'</a></h3>
                                            <div class="geodir-category-content_price">$ '.number_format($price,2).'</div>
                                            
                                            <div class="geodir-category-footer fl-wrap">
                                                <a href="agent-single.html" class="gcf-company"><img src="'.site_url().'assets/images/avatar/2.jpg" alt=""><span>'.$user.'</span></a>
                                                <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="top" data-tooltip="Good" data-starrating2="4"></div>
                                            </div>
                                        </div>
                                    </article>
                                </div>															
                            </div>
						';
					}
				}
			}
			if(empty($item)) {
				$resp['item'] = '
					<div class="text-center text-muted mb-5">
						<br/>
						<i class="fal fa-clipboard-list-check" style="font-size:150px;"></i><br/><br/>No Listing Returned
					</div>
				';
			} else {
				$resp['item'] = '<div class="grid-item-holder gallery-items fl-wrap" >'.$item.'</div>';
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
			// die;
		}

    }
    public function get_country(){
            $country = $this->request->getPost('country');
            if($this->Crud->check('name', $country, 'country') > 0){
                echo $this->Crud->read_field('name', $country, 'country', 'id');
            } else {
                echo 0;
            }
       
    }
}
