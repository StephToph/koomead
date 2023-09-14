<?php

namespace App\Controllers;

class Home extends BaseController {
    private $db;

    public function __construct() {
		$this->db = \Config\Database::connect();
	}

    public function index() {
        $db = \Config\Database::connect();
        $this->session->set('km_redirect', uri_string());
        // check login
        $log_id = $this->session->get('km_id'); 
        $role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
        $role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
       

        $data['log_id'] = $log_id;
		$location = $this->session->get('km_location'); 
        $data['location'] = $location;
        $data['role'] = $role;
        
        
        $data['title'] = ' '.app_name;
        $data['page_active'] = 'home';
        return view('home/land', $data);
    }

    public function listing($param1='', $param2='', $param3='') {
		$db = \Config\Database::connect();
        
        $this->session->set('km_redirect', uri_string());
        // check login
        $log_id = $this->session->get('km_id');
        
		$log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
        $data['log_id'] = $log_id;
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

		if($param1 == 'message'){
			$message = $this->request->getPost('message');
			$listing_id = $this->request->getPost('listing_id');
			$business_id = $this->request->getPost('business_id');

			if($business_id == $log_id){
				echo $this->Crud->msg('warning', 'You cannot message yourself as you are the owner of the Business.');
			} else{
				$code = substr(md5(time().rand()), 0, 6);
				if($this->Crud->check3('sender_id', $log_id, 'receiver_id', $business_id, 'listing_id', $listing_id, 'message') > 0){
					$code = $this->Crud->read_field3('sender_id', $log_id, 'receiver_id', $business_id, 'listing_id', $listing_id, 'message', 'code');
				}
				$ins['message'] = $message;
				$ins['code'] = $code;
				$ins['listing_id'] = $listing_id;
				$ins['receiver_id'] = $business_id;
				$ins['sender_id'] = $log_id;
				$ins['reg_date'] = date(fdate);
				
				$ins_rec = $this->Crud->create('message', $ins);
				if($ins_rec > 0){
					$send = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
					$receive = $this->Crud->read_field('id', $business_id, 'user', 'fullname');
					$listing = $this->Crud->read_field('id', $listing_id, 'listing', 'name');
					$action = $send.' sent a message to '.$receive.' on Business { '.$listing.' }';
					$content = $send.' Sent You a Message';
					$item = 'message';$items = 'message';
					$this->Crud->notify($log_id, $business_id, $content, $item, $listing_id);
					$this->Crud->activity($items, $ins_rec, $action);
					echo $this->Crud->msg('success', 'Message Sent!<br><a href="'.site_url('message').'">Click to view Message Board</a>');
					echo '<script>$("#message").val(" ");</script>';
				} else {
					echo $this->Crud->msg('warning', 'Message Not Sent.<br>Try Again.');
				}
			}
			die;
		}

		
		if($param1 == 'promote'){
			
			$data['title'] = 'Promote Listing | '.app_name;
			$data['page_active'] = 'listing';
			if(empty($param2)){

				return redirect()->to(site_url(''));	
			} $this->session->set('km_redirect', uri_string());
			return view('home/list_promote', $data);

		} else {
			$this->saveDeviceInfo();
			

			$data['title'] = 'View Listing | '.app_name;
			$data['page_active'] = 'listing';
			if(empty($param2)){

				return redirect()->to(site_url(''));	
			} $this->session->set('km_redirect', uri_string());
			return view('home/list_view', $data);
		}
    }

    public function list_load($param1='', $param2='', $param3=''){
        $log_id = $this->session->get('km_id');
        
        
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
            $cur = '$';
            if($country_id == '161')$cur = '&#8358;';

			
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
                            $user_img = $this->Crud->read_field('id', $user_id, 'user', 'img_id');
                            if(empty($user_img))$user_img = 'assets/images/avatar.png';
                            
						
						$category = $this->Crud->read_field('id', $category_id, 'category', 'name');
						$main_id = $this->Crud->read_field('id', $category_id, 'category', 'category_id');
						$mains = $this->Crud->read_field('id', $main_id, 'category', 'name');
						
						$country = $this->Crud->read_field('id', $country_id, 'country', 'name');
						$state = $this->Crud->read_field('id', $state_id, 'state', 'name');
						$city = $this->Crud->read_field('id', $city_id, 'city', 'name');
						
						$loca = '';

						$uri = 'home/listing/view/'.$id;
						$view = $this->Crud->check('page', $uri, 'listing_view');
						
						$prices = '<span>'.$cur.'</span>'.number_format($price,2);
						if($price_status == 1)$prices = 'Contact for Price';

						if(!empty($city_id)) $loca .= $city;
						if(!empty($state_id)) $loca .= ', '.$state;
						if(!empty($country_id)) $loca .= ', '.$country;

						$promote = '';
						if($this->Crud->check2('listing_id', $id, 'status', '0', 'business_promotion') > 0){
							$promote = '
								<span class="float-end tolt" style="float:right" data-microtip-position="top-left"  data-tooltip="Promote"><a href="'.site_url('home/listing/promote/'.$id).'" class="text-primary"><i class="fas fa-paper-plane"></i> </a></span>
							';
						}

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
                                                <span><i class="fas fa-eye"></i> '.$view.'</span>
                                            </div>
                                        </div>
                                        <div class="geodir-category-content fl-wrap">
                                            <h3 class="title-sin_item"><a href="'.site_url('home/listing/view/'.$id).'">'.ucwords($name).'</a></h3>
                                            <div class="geodir-category-content_price">'.$prices.' '.$promote.'</div>

											<div class="geodir-category-footer fl-wrap">
                                                <a href=javascript:;" class="gcf-company"><img src="'.site_url($user_img).'" alt=""><span>'.$user.'</span></a>
                                               
                                            </div>
                                        </div>
                                    </article>
                                </div>															
                            </div>
						';
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

	public function list_state($param1='', $param2='', $param3=''){
        $log_id = $this->session->get('km_id');
        
        
        // record listing
		if($param1 == 'load') {
			$limit = $param2;
			$offset = $param3;

			$count = 0;
			$rec_limit = 25;
			$item = '';

			if($limit == '') {$limit = $rec_limit;}
			if($offset == '') {$offset = 0;}
			
			if(!empty($this->request->getPost('country_id'))) { $country_id = $this->request->getPost('country_id'); } else { $country_id = ''; }
			
			$cur = '$';
            if($country_id == '161')$cur = '&#8358;';

			
				$querys = $this->Crud->read_single('country_id', $country_id, 'state');
				//Get state in current country to get number of listing
				$query = [];
				if(!empty($querys)){
					foreach($querys as $qu){
						if($this->Crud->check('state_id', $qu->id, 'listing') > 0){
							$query[$qu->name] = $this->Crud->check('state_id', $qu->id, 'listing');
						}
					}
				}
				arsort($query);
				// $query = $this->Crud->read_single('country_id', $country_id, 'listing', '', '');
				if(!empty($all_rec)) { $count = count($all_rec); } else { $count = 0; }
				$c = 1;
				if(!empty($query)) {
					foreach($query as $q => $val) {
						if($c >8)continue;
						$id = $this->Crud->read_field('name', $q, 'state', 'id');
						$main = $this->Crud->read_field('name', $q, 'state', 'images');
						if(empty($main))$main = 'assets/images/bg/long/1.jpg';
						$item .= '
							<div class="slick-item">
								<div class="half-carousel-item fl-wrap">
									<div class="bg-wrap bg-parallax-wrap-gradien">
										<div class="bg"  data-bg="'.site_url($main).'" style="background-image:url('.$main.')"></div>
									</div>
									<div class="half-carousel-content">
										<div class="hc-counter color-bg">'.$val.' Businesses</div>
										<h3><a href="javascript:;">Explore '.$q.'</a></h3>
									</div>
								</div>
							</div>
						';
						$c++;
					}
				}
			
			if(empty($item)) {
				$resp['item'] = '
					<div class="text-center text-muted mb-5">
						<br/><br>
						<i class="fal fa-street-view mt-5" style="font-size:150px;"></i><br/><br/>No Listing Returned
					</div>
				';
			} else {
				$resp['item'] = '<div class="half-carousel fl-wrap full-height" >'.$item.'</div><script>
					$(".half-carousel").slick({
						infinite: true,
						slidesToShow: 3,
						dots: true,
						arrows: false,
						centerMode: false,
						variableWidth: false,
						responsive: [{
								breakpoint: 1224,
								settings: {
									slidesToShow: 2,
									centerMode: false,
								}
							},
							{
								breakpoint: 564,
								settings: {
									slidesToShow: 1,
									centerMode: false,
								}
							}
						]
				
					});
				</script>';
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
        if($country != 'Nigeria' && $country != 'United Kingdom')$country = 'United Kingdom';
		$this->session->set('km_location', $country);
        if($this->Crud->check('name', $country, 'country') > 0){
            echo $this->Crud->read_field('name', $country, 'country', 'id');
        } else {
            echo 0;
        }
       
    }

	public function location($param1=''){
		if($this->request->getMethod() == 'post'){

			$country_id = $this->request->getPost('country_id');
			$country = $this->Crud->read_field('id', $country_id, 'country', 'name');
			$this->session->set('km_location', $country);
			echo $this->Crud->msg('info', 'Location Saved');
			echo '<script>location.reload(false);</script>';
			die;
		}

		
        $log_id = $this->session->get('km_id'); 
        $data['log_id'] = $log_id;
		$data['country'] = $param1;
        return view('home/location', $data);
	}

	public function saveDeviceInfo(){
        // Get user agent information (browser, OS, etc.)
        $userAgent = $this->request->getUserAgent();

        // Get the IP address of the device
        $ipAddress = $this->request->getIPAddress();
		$uri = $this->request->uri->getPath();

		$request = service('request');
		$xForwardedFor = $request->getHeader('HTTP_X_FORWARDED_FOR');
        
		// Extract the original client's IP address from the list
		$ipAddress = isset($xForwardedFor) ? explode(',', $xForwardedFor)[0] : $request->getIPAddress();
        // Create a timestamp for the current visit
        $timestamp = date('Y-m-d H:i:s');
	

        // Prepare data to insert into the database
        $data = [
            'user_agent' => $userAgent,
            'ip_address' => $ipAddress,
            'page' => $uri,
            'reg_date' => $timestamp,
        ];

		if($this->Crud->check2('ip_address', $ipAddress, 'page', $uri, 'listing_view') == 0){
			$this->Crud->create('listing_view', $data);
		}
       return json_encode($data);
    }
}
