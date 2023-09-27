<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>

<?php echo $this->extend('designs/backend'); ?>
<?php echo $this->section('title'); ?>
    <?php echo $title; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<div class="dashboard-content">
    <div class="dashboard-menu-btn color-bg"><span><i class="fas fa-bars"></i></span>Dasboard Menu</div>
    <div class="container dasboard-container  mb-5">
        <!-- dashboard-title -->	
        <div class="dashboard-title fl-wrap">
            <div class="dashboard-title-item"><span><?=$page; ?></span></div>
            <div class="dashbard-menu-header">
                <div class="dashbard-menu-avatar fl-wrap">
                    <img src="<?=site_url(); ?>assets/images/avatar.png" alt="">
                    <h4>Welcome, <span><?=$log_name;?></span></h4>
                </div>
                <a href="<?=site_url('auth/logout');?>" class="log-out-btn   tolt" data-microtip-position="bottom"  data-tooltip="Log Out"><i class="far fa-power-off"></i></a>
            </div>
        </div>
       
        <div class="dasboard-wrapper fl-wrap no-pag">
            <div class="dasboard-widget-title fl-wrap" id="sec1">
                <h5><i class="fas fa-info"></i>Basic Informations</h5>
            </div>
            <!-- dasboard-widget-title end -->
            <!-- dasboard-widget-box  -->
            <div class="dasboard-widget-box fl-wrap">
                
                <?php echo form_open_multipart('listing/index/manage', array('id'=>'bb_ajax_form', 'class'=>'text-start customform')); ?>
    
                <div class="custom-form">
                    <div class="row">
                        <input type="hidden" name="listing_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
                        <div class="col-sm-4 mb-3">		 
                            <label>Listing Title  <span class="dec-icon"><i class="far fa-briefcase"></i></span></label>
                            <input type="text" name="title" placeholder="Name of your business" required value="<?php if(!empty($e_name)){echo $e_name;} ?>"/>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Category</label>
                            <div class="listsearch-input-item">
                                <select data-placeholder="Main Category" id="main_id" onchange="get_category()" class="chosen-select search-select" required >
                                    <option value="">Main Category</option>
                                    <?php
                                        $cate = $this->Crud->read_single_order('category_id', 0, 'category', 'name', 'asc');
                                        if(!empty($cate)){
                                            foreach($cate as $c){
                                                $sel = '';
                                                if(!empty($e_main)){
                                                    if($e_main == $c->id)$sel ='selected';
                                                }
                                                echo '<option value="'.$c->id.'" '.$sel.'>'.$c->name.'</option>';
                                            }
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <?php
                            if(!empty($e_category_id)){?>
                                <div class="col-sm-4 mb-3">
                                    <label>Sub-Category</label><div id="category_ids">
                                    <div class="listsearch-input-item">
                                        <select data-placeholder="All Category" name="sub_id" id="category_id" class="chosen-select search-select" required >
                                            <option value="">Select Category</option>
                                            <?php
                                                $cate = $this->Crud->read_single_order('category_id', $e_main, 'category', 'name', 'asc');
                                                if(!empty($cate)){
                                                    foreach($cate as $c){
                                                        $sel = '';
                                                        if(!empty($e_category_id)){
                                                            if($e_category_id == $c->id)$sel ='selected';
                                                        }
                                                        echo '<option value="'.$c->id.'" '.$sel.'>'.$c->name.'</option>';
                                                    }
                                                }
                                            ?>
                                    
                                        </select>
                                    </div></div>
                                </div>
                          <?php  } else {
                        ?>
                            <div class="col-sm-4 mb-3">
                                <label>Sub-Category</label>
                                <div id="category_ids">
                                    <div class="listsearch-input-item">
                                        <select data-placeholder="All Category" name="category_id" id="category_id" class="chosen-select search-select" required >
                                            <option value="">Select Category First</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class=" col-sm-4 mb-3"><label>State</label>
                            <div id="states_id">
                                <div class="listsearch-input-item mb-2">
                                    <select data-placeholder="Select" name="state_id" id="state_id" required  class="mb-2 chosen-select search-select" onchange="get_city();">
                                        <option value="">All State</option>
                                        <?php
                                            $country_id = $this->Crud->read_field('id', $log_id, 'user', 'country_id');
                                            $country = $this->Crud->read_single_order('country_id', $country_id, 'state', 'name', 'asc');
                                            if(!empty($country)){
                                                foreach($country as $c){
                                                    $sel ='';
                                                    if(!empty($e_state_id)){
                                                        if($e_state_id == $c->id)$sel='selected';
                                                    }
                                                    // if($c->name != 'Nigeria' && $c->name != 'United Kingdom')continue;
                                                    echo '<option value="'.$c->id.'" '.$sel.'>'.$c->name.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>  
                            </div>
                        </div>
                        <?php 
                            if(!empty($e_city_id)){
                        ?>
                            <div class=" col-sm-4 mb-3"><label>City</label><div id="citys_id">
                                <div class="listsearch-input-item mb-2" id="citys_id">
                                    <select data-placeholder="Select"  name="city_id" id="city_id"
                                        required class="mb-2 chosen-select search-select">
                                        <option value="">Select City</option>
                                        <?php
                                            $country = $this->Crud->read_single_order('state_id', $e_state_id, 'city', 'name', 'asc');
                                            if(!empty($country)){
                                                foreach($country as $c){
                                                    $sel ='';
                                                    if(!empty($e_city_id)){
                                                        if($e_city_id == $c->id)$sel='selected';
                                                    }
                                                    // if($c->name != 'Nigeria' && $c->name != 'United Kingdom')continue;
                                                    echo '<option value="'.$c->id.'" '.$sel.'>'.$c->name.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div></div>
                            </div>
                        <?php 
                            } else {
                        ?>
                            <div class=" col-sm-4 mb-3"><label>City</label><div id="citys_id">
                                <div class="listsearch-input-item mb-2" id="citys_id">
                                    <select data-placeholder="Select"  name="city_id" id="city_id"
                                        required class="mb-2 chosen-select search-select">
                                        <option value="">Select State First</option>

                                    </select>
                                </div></div>
                            </div>
                        <?php 
                            }
                        ?>
                        
                        <div class="col-sm-4  mb-3">		 
                            <label>Listing Price  <span class="dec-icon"><i class="far fa-money-bill-wave"></i></span></label>
                            <input type="text" name="price" placeholder="Listing Price"  value="<?php if(!empty($e_price)){echo $e_price;} ?>"/>
                        </div>

                        <div class="col-sm-8 mb-3">
                            <label>Address <span class="dec-icon"><i class="far fa-map-marker"></i></span></label>
                            <input type="text" name="address" placeholder="Address of your business" value="<?php if(!empty($e_address)){echo $e_address;} ?>"/>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Email Address <span class="dec-icon"><i class="far fa-envelope"></i></span>  </label>
                            <input type="email" name="b_email" value="<?php if(!empty($e_email)){echo $e_email;} ?>" placeholder="JessieManrty@koomeli.com" />
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Phone <span class="dec-icon"><i class="far fa-phone"></i> </span> </label>
                            <input type="text" name="b_phone" placeholder="+7(123)987654" value="<?php if(!empty($e_phone)){echo $e_phone;} ?>"/>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label> Website <span class="dec-icon"><i class="far fa-globe"></i> </span> </label>
                            <input type="text" name="website" placeholder="https://koomeli.net" value="<?php if(!empty($e_profile) && !empty($e_profile->website)){echo $e_profile->website;} ?>"/>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label> Facebook <span class="dec-icon"><i class="fab fa-facebook"></i> </span> </label>
                            <input type="text" name="facebook" placeholder="https://facebook.com/koomeli" value="<?php if(!empty($e_profile) && !empty($e_profile->facebook)){echo $e_profile->facebook;} ?>"/>
                        </div>
                          <div class="col-sm-4 mb-3">
                            <label> Instagram <span class="dec-icon"><i class="fab fa-instagram"></i> </span> </label>
                            <input type="text" name="instagram" placeholder="https://instagram.com/koomeli" value="<?php if(!empty($e_profile) && !empty($e_profile->instagram)){echo $e_profile->instagram;} ?>"/>
                        </div>
                          <div class="col-sm-4 mb-3">
                            <label> Twitter <span class="dec-icon"><i class="fab fa-twitter"></i> </span> </label>
                            <input type="text" name="twitter" placeholder="https://twitter.com/koomeli" value="<?php if(!empty($e_profile) && !empty($e_profile->twitter)){echo $e_profile->twitter;} ?>"/>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label> Whatsapp <span class="dec-icon"><i class="fab fa-whatsapp"></i> </span> </label>
                            <input type="text" name="whatsapp" placeholder="https://whatsapp.com/koomeli" value="<?php if(!empty($e_profile) && !empty($e_profile->whatsapp)){echo $e_profile->whatsapp;} ?>"/>
                        </div>
                                        
                        <div class="col-md-8  mb-3">
                            <label>Description</label>
                            <div class="listsearch-input-item">
                                <textarea cols="40" rows="3" style="height: 250px" name="description" required placeholder="Details" spellcheck="true"><?php if(!empty($e_description)){echo $e_description;} ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4  mb-3">
                            <div class="content-widget-switcher fl-wrap mt-4">
                                <span class="content-widget-switcher-title">Contact for Price</span>
                                <div class="onoffswitch">
                                    <?php $ch ='';
                                        if(!empty($e_price_status)){
                                           if($e_price_status == 1)$ch ='checked';
                                        }
                                    ?>
                                    <input type="checkbox" name="price_status" class="onoffswitch-checkbox" <?=$ch; ?> id="myonoffswitchmc423">
                                    <label class="onoffswitch-label" for="myonoffswitchmc423">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="content-widget-switcher fl-wrap" style="margin-top: 20px">
                                <span class="content-widget-switcher-title">Negotiable</span>
                                <div class="onoffswitch">
                                    <?php $ch ='';
                                        if(!empty($e_negotiable)){
                                            if($e_negotiable == 1)$ch ='checked';
                                        }
                                    ?>
                                    <input type="checkbox" name="negotiable" class="onoffswitch-checkbox" <?=$ch; ?> id="myonoffswitchmc923">
                                    <label class="onoffswitch-label" for="myonoffswitchmc923">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="content-widget-switcher fl-wrap mb-3" style="margin-top: 20px">
                                <span class="content-widget-switcher-title">Visible to Selected Location</span>
                                <div class="onoffswitch">
                                    <?php $ch ='';$vs = 'none';
                                        if(!empty($e_visible_status)){
                                            if($e_visible_status == 1)$ch ='checked';$vs='block';
                                        }
                                    ?>
                                    <input type="checkbox" name="visible_status" class="onoffswitch-checkbox" <?=$ch; ?> id="myonoffswitchmc9231" onchange="visibles()">
                                    <label class="onoffswitch-label" for="myonoffswitchmc9231">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9  mb-3" style="display:<?=$vs;?>;" id="visible_resp">
                            
                            <label>State Visible</label>
                            <div class="listsearch-input-item">
                                <select data-placeholder="Select State" name="visible_local[]" multiple id="visible_local" class="mb-2 chosen-select search-select">
                                        <option value="">All State</option>
                                        <?php
                                            $country_id = $this->Crud->read_field('id', $log_id, 'user', 'country_id');
                                            $country = $this->Crud->read_single_order('country_id', $country_id, 'state', 'name', 'asc');
                                            if(!empty($country)){
                                                foreach($country as $c){
                                                    $sel ='';
                                                    if(!empty($e_visible_state)){
                                                        if(in_array($c->id, $e_visible_state))$sel='selected';
                                                    }
                                                    // if($c->name != 'Nigeria' && $c->name != 'United Kingdom')continue;
                                                    echo '<option value="'.$c->id.'" '.$sel.'>'.$c->name.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                            </div>
                        </div>

                        <div class="col-sm-3 text-center mb-5" id="original-div">
                            <div style="background-color:#f6f6f6; margin:2px; padding: 15px;" >
                                <div class="text-muted text-center"><b>MAIN PHOTO</b></div>
                                <label for="img-upload" class="pointer text-center" style="cursor:pointer; float: none !important;">
                                        
                                    <input type="hidden" id="hiddens" name="img[]" value="<?php if(!empty($e_images)){echo $e_images[0];} ?>" />
                                    <img id="img0" src="<?php  if(!empty($e_images)){echo site_url($e_images[0]);} else {echo site_url('assets/images/file.png');} ?>" style="max-width:80%;" />
                                    <span class="btn btn-warning d-block"><i class="fal fa-images"></i> Choose Image</span>
                                    <input class="d-none img-upload" type="file" name="pics[]"  id="img-upload">
                                    
                                </label>
                                <!-- <span type="button" class="btn btn-danger d-block remove-upload"  class="">Delete</span> -->
                            </div>
                            
                        </div>
                        <div class="row" id="cloned-divs-container">
                            <?php
                                if(!empty($e_images)){
                                    if(count($e_images) > 1){
                                        for ($i=1; $i < count($e_images); $i++) { ?>

                                            <div class="col-sm-3 cloned-div text-center mb-5">
                                                <div style="background-color:#f6f6f6; margin:2px; padding: 15px;" >
                                                    <div class="text-muted text-center"><b id="counter"> PHOTO <?=$i; ?></b></div>
                                                    <label for="img-upload<?=$i; ?>" class="pointer text-center" style="cursor:pointer; float: none !important;">
                                                            
                                                        <input type="hidden" id="hidden<?=$i; ?>" name="img[]" value="<?php if(!empty($e_images)){echo $e_images[$i];} ?>" />
                                                        <img id="img<?=$i;?>" src="<?php  if(!empty($e_images)){echo site_url($e_images[$i]);} else {echo site_url('assets/images/file.png');} ?>" style="max-width:80%;" />
                                                        <span class="btn btn-warning d-block"><i class="fal fa-images"></i> Choose Image</span>
                                                        <input class="d-none img-upload" type="file" name="pics[]"  id="img-upload<?=$i;?>" >
                                                        
                                                    </label>
                                                    
                                                </div>
                                                <button type="button" class="delete-button btn btn-danger" onclick="deleteButtonAction(this)"><i class="fal fa-trash"></i> Delete</button>
                                            </div>
                                       <?php }
                                    }
                                }

                            ?>
                        </div>
                        <span type="button" class="btn btn-secondary -block mt-3" id="add-button"><i class="fal fa-plus"></i> Add More Images</span>
                        
                    </div>
                    <div class="row mb-5 mt-5">
                        <div class="col-sm-12"><div id="bb_ajax_msg"></div></div>
                    </div>

                </div> 
                <div class="col-sm-12 text-center">
                    <button class="btn btn-primary text-uppercase" type="submit">
                        <i class="fal fa-save"></i> Save Changes
                    </button>
                </div>
                </form>
            </div>
            <!-- dasboard-widget-box  end-->
           
           										
           
        </div>
    </div>

        
    <!-- <script src="<?php echo site_url(); ?>/assets/js/jquery.min.js"></script> -->
    <script>var site_url = '<?php echo site_url(); ?>';</script>
   
    <script>
        $(document).ready(function () {
            let cloneCounter = 1;

            // Function to update the clone counters
            function addChangeFunctionality(element) {
                element.change(function () {
                readURL(this, $(this).siblings('img').attr('id'));
                });
            }
            function updateCloneCounters() {
                $("#cloned-divs-container .cloned-div").each(function (index) {
                    $(this).find("b").text("PHOTOS " + (index + 1));
                    $(this).find("img").attr("id","img" + (index + 1));
                    $(this).find('input[type="file"]').attr("id","img-upload" + (index + 1));
                    $(this).find("label").attr("for","img-upload" + (index + 1));
                });
            }
            // Function to clone a div, edit its content, and add a delete button
            function cloneAndEditDiv() {
                var clone = $("#original-div").clone();
                clone.attr("id", ""); // Remove the ID attribute to avoid duplication
                clone.addClass("cloned-div"); 
                cloneCounter++; 
                clone.find('input[type="file"]').val(''); // Clear the file input
                clone.find('img').attr('src', '<?php echo site_url('assets/images/file.png');?>'); // Clear the file input
       
                clone.find("b").text("PHOTOS "+ cloneCounter);
                clone.find("img").attr("id", "img"+cloneCounter);
                clone.find('input[type="file"]').attr("id", "img-upload"+cloneCounter);
                clone.find("label").attr("for", "img-upload"+cloneCounter);
                addChangeFunctionality(clone.find('.img-upload'));
                

                // Add "Delete" button for cloned div
                var deleteButton = $('<button class="delete-button btn btn-danger"><i class="fal fa-trash"></i> Delete</button>');
                deleteButton.click(function () {
                    clone.remove();
                    updateCloneCounters(); 
                });
                clone.append(deleteButton);

                $("#cloned-divs-container").append(clone);
                updateCloneCounters();
            }
            

            // Clone and edit when the "Add" button is clicked
            $("#add-button").click(function () {
                cloneAndEditDiv();
            });
        });


        // Function to update the clone counters
        for (let i = 1; i < 50; i++) {
            $("#img-upload"+i).change(function(){
                readURL(this, 'img'+i);
                $('#hidden'+i).val('');
            });
            
        }
        
        function visibles(){
            var checkbox = document.getElementById("myonoffswitchmc9231");

            if (checkbox.checked) {
                $('#visible_resp').show(500);
            } else {
                $('#visible_resp').hide(500);
            }
        }


        function deleteButtonAction(button) {
            // Find the parent <div> and remove it
            var parentDiv = button.closest('.cloned-div');
            if (parentDiv) {
                parentDiv.remove(); updateCloneCounterss();
            }
        }

        function updateCloneCounterss() {
            // Calculate the number of remaining cloned divs and update the counter
            var clonedDivs = document.querySelectorAll('.cloned-div');
            var counter = document.getElementById('counter');
            if (counter) {
                counter.textContent = ' PHOTO ' + clonedDivs.length;
            }
        }
        function get_category() {
            var main_id = $('#main_id').val();
            $.ajax({
                url: site_url + 'accounts/account/get_category/' + main_id,
                type: 'post',
                success: function(data) {
                    $('#category_ids').html(data);
                }
            });
        }

        function get_state() {
            load();
            var country_id = $('#country_id').val();
            $.ajax({
                url: site_url + 'accounts/account/get_state/' + country_id,
                type: 'post',
                success: function(data) {
                    $('#states_id').html(data);
                }
            });
        }

        function get_city() {
            load();
            var state_id = $('#state_id').val();
            $.ajax({
                url: site_url + 'accounts/account/get_city/' + state_id,
                type: 'post',
                success: function(data) {
                    $('#citys_id').html(data);
                }
            });
        }

        function readURL(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    if(id != 'vid') {
                        $('#' + id).attr('src', e.target.result);
                    } else {
                        $('#' + id).show(500);
                    }
                }
                reader.readAsDataURL(input.files[0]);
            
            }
        }
        
        $("#img-upload").change(function(){
            readURL(this, 'img0');
            $('#hiddens').val('');
        });


        function load(x, y) {

            
        }
    </script>   
<?php echo $this->endSection(); ?>