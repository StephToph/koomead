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
                <div class="custom-form">
                    <div class="row">
                        <div class="col-sm-4 mb-3">		 
                            <label>Listing Title  <span class="dec-icon"><i class="far fa-briefcase"></i></span></label>
                            <input type="text" name="title" placeholder="Name of your business" value=""/>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Category</label>
                            <div class="listsearch-input-item">
                                <select data-placeholder="Main Category" id="main_id" onchange="get_category()" class="chosen-select search-select" required >
                                    <option value="0">Main Category</option>
                                    <?php
                                        $cate = $this->Crud->read_single_order('category_id', 0, 'category', 'name', 'asc');
                                        if(!empty($cate)){
                                            foreach($cate as $c){
                                                echo '<option value="'.$c->id.'">'.$c->name.'</option>';
                                            }
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Sub-Category</label><div id="category_ids">
                            <div class="listsearch-input-item">
                                <select data-placeholder="All Category" name="category_id" id="category_id" class="chosen-select search-select" required >
                                    <option value="0">Select Category First</option>
                                    
                                </select>
                            </div></div>
                        </div>
                        <div class=" col-sm-4 mb-3"><label>State</label>
                            <div id="states_id">
                                <div class="listsearch-input-item mb-2">
                                    <select data-placeholder="Select" name="state_id" id="state_id" required  class="mb-2 chosen-select search-select" onchange="get_city();">
                                        <option value="0">All State</option>
                                        <?php
                                            $country_id = $this->Crud->read_field('id', $log_id, 'user', 'country_id');
                                            $country = $this->Crud->read_single_order('country_id', $country_id, 'state', 'name', 'asc');
                                            if(!empty($country)){
                                                foreach($country as $c){
                                                    // if($c->name != 'Nigeria' && $c->name != 'United Kingdom')continue;
                                                    echo '<option value="'.$c->id.'">'.$c->name.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>  
                            </div>
                        </div>
                        <div class=" col-sm-4 mb-3"><label>City</label><div id="citys_id">
                            <div class="listsearch-input-item mb-2" id="citys_id">
                                <select data-placeholder="Select"  name="city_id" id="city_id"
                                    required class="mb-2 chosen-select search-select">
                                    <option value="all">Select State First</option>

                                </select>
                            </div></div>
                        </div>
                        <div class="col-sm-4  mb-3">		 
                            <label>Listing Price  <span class="dec-icon"><i class="far fa-money-bill-wave"></i></span></label>
                            <input type="text" name="price" placeholder="Listing Price" value=""/>
                        </div>
                                        
                        <div class="col-sm-7  mb-3">
                            <label>Description</label>
                            <div class="listsearch-input-item">
                                <textarea cols="40" rows="3" style="height: 135px" name="description" placeholder="Details" spellcheck="true"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3  mb-3">
                            <div class="content-widget-switcher fl-wrap mt-4">
                                <span class="content-widget-switcher-title">Contact for Price</span>
                                <div class="onoffswitch">
                                    <input type="checkbox" name="price_status" class="onoffswitch-checkbox" id="myonoffswitchmc423">
                                    <label class="onoffswitch-label" for="myonoffswitchmc423">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="content-widget-switcher fl-wrap" style="margin-top: 20px">
                                <span class="content-widget-switcher-title">Negotiable</span>
                                <div class="onoffswitch">
                                    <input type="checkbox" name="negotiable" class="onoffswitch-checkbox" id="myonoffswitchmc923">
                                    <label class="onoffswitch-label" for="myonoffswitchmc923">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="upload-item col-sm-4 text-center mb-5">
                            <div style="background-color:#f6f6f6; margin:2px; padding: 15px;" >
                                <div class="text-muted text-center"><b>PHOTOS</b></div>
                                <div for="img-upload" class="pointer text-center" style="cursor:pointer;">
                                    <img id="img0" src="<?php echo site_url('assets/images/file.png');?>" style="max-width:80%;" />
                                    <span class="btn btn-warning d-block"><i class="fal fa-images"></i> Choose Cover</span>
                                    <!-- <span class="btn btn-warning dblock"><i class="fal fa-images"></i> Choose Cover</span> -->
                                    <input class="d-none" type="file" name="pics[]" accept="image/*" id="img-upload">
                                    
                                </div><span type="button" class="btn btn-danger d-block remove-upload"  class="">Delete</span>
                            </div>
                            <span type="button" class="btn btn-primary -block"  id="add-upload">Add More</span>
                        </div>
                        <div class="row col-sm-12" id="image-uploads">

                        </div>
                    </div>
                </div>
            </div>
            <!-- dasboard-widget-box  end-->
           
           										
            <button type="submit" class="btn btn-primary d-block float-btn">Save Changes </button>
        </div>
    </div>

        
    <!-- <script src="<?php echo site_url(); ?>/assets/js/jquery.min.js"></script> -->
    <script>var site_url = '<?php echo site_url(); ?>';</script>
   
    <script>
        $(document).ready(function () {
        // Clone an existing image upload input and add it with a delete button
            $("#add-upload").click(function () {
                var clone = $(".upload-item:first").clone(); // Clone the first upload-item
                clone.find('input[type="file"]').val(''); // Clear the file input
                clone.find('.remove-upload').click(function () {
                $(this).parent().remove(); // Remove the cloned input and delete button
                });
                $("#image-uploads").append(clone); // Append the cloned input to the container
            });

            // Delete a clone when the delete button is clicked
            $(document).on('click', '.remove-upload', function () {
                $(this).parent().remove(); // Remove the cloned input and delete button
            });
        });

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

        function load(x, y) {

            
        }
    </script>   
<?php echo $this->endSection(); ?>