<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>

<?php echo $this->extend('designs/frontend'); ?>
<?php echo $this->section('title'); ?>
    <?php echo $title; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<!-- content -->	
<div class="content">
    <section class="parallax-section single-par color-bg">
        <div class="container">
            <div class="section-title center-align big-title">
                <h2><span>Search Business Listing</span></h2>
            </div>
        </div>
        <div class="pwh_bg"></div>
        <div class="mrb_pin vis_mr mrb_pin3 "></div>
        <div class="mrb_pin vis_mr mrb_pin4 "></div>
    </section>
    <!--  section  end-->
    <!-- breadcrumbs-->
    <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
        <div class="container">
            <div class="breadcrumbs-list">
                <a href="<?=site_url(); ?>">Home</a><a href="javacript:;">Listings</a>
            </div>
        </div>
    </div>
    <!-- breadcrumbs end -->
    <!-- col-list-wrap -->
    <section class="gray-bg small-padding ">
        <div class="container">
            <div class="mob-nav-content-btn  color-bg show-list-wrap-search ntm fl-wrap">Show  Filters</div>
            <!-- list-searh-input-wrap-->
            <div class="list-searh-input-wrap box_list-searh-input-wrap lws_mobile fl-wrap">
                <div class="list-searh-input-wrap-title fl-wrap"><i class="far fa-sliders-h"></i><span>Search Filters</span></div>
                <div class="custom-form fl-wrap">
                    <div class="row">
                        <!-- listsearch-input-item -->
                        <div class="col-sm-6">
                            <div class="listsearch-input-item  ">
                                <input type="text" id="search" oninput="load()"  placeholder="Address , Street , State..." value="<?=$search; ?>"/>
                            </div>
                        </div>
                       
                        <div class="col-12 col-sm-3 mb-2">
                            <div class="listsearch-input-item">
                                <select data-placeholder="Select" name="country_id" id="country_id" class="mb-2 chosen-select search-select"  onchange="get_states();">
                                    <?php
                                            $country = $this->Crud->read_order('country', 'name', 'asc');
                                            if(!empty($country)){
                                                foreach($country as $c){
                                                    $sel = '';
                                                    if($c->name == $location)$sel = 'selected';
                                                    if($c->name != 'Nigeria')continue;
                                                    echo '<option value="'.$c->id.'" '.$sel.'>'.$c->name.'</option>';
                                                }
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <?php $location = 'Nigeria';
                          if(!empty($location)){
                            $country_id = $this->Crud->read_field('name', $location, 'country', 'id');
                            ?>
                                <script>$(function() {getstates('', '');});</script>
                                <div class="col-12 col-sm-3 mb-2">
                                    <div class="listsearch-input-item mb-2" id="states_id">
                                        <select data-placeholder="Select" name="state_id" id="state_id" required  class="mb-2 chosen-select search-select" onchange="get_citys()">
                                        <option value="all">All State</option>
                                            <?php
                                                    $country = $this->Crud->read_single_order('country_id', $country_id, 'state', 'name', 'asc');
                                                    if(!empty($country)){
                                                        foreach($country as $c){
                                                            $sel = '';
                                                            if($c->id == $state_id)$sel = 'selected';
                                                            echo '<option value="'.$c->id.'" '.$sel.'>'.$c->name.'</option>';
                                                        }
                                                    }
                                                ?>
                                        </select>
                                    </div>  
                                </div>
                            
                            <?php if($state_id){

                            }
                          }  
                        ?>
                        
                        <div class="col-12 col-sm-3 mb-2">
                            <div class="listsearch-input-item mb-2" id="citys_id">
                                <select data-placeholder="Select" onchange="load()" name="city_id" id="city_id"
                                    required class="mb-2 chosen-select search-select">
                                    <option value="all">Select State First</option>

                                </select>
                            </div>
                        </div>

                      
                        <!-- listsearch-input-item -->
                        <div class="col-sm-3">
                            <div class="listsearch-input-item">
                                <select data-placeholder="Main Category" id="main_id" onchange="get_categorys()" class="chosen-select search-select" required >
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
                       
                        <div class="col-sm-3">
                            <div class="listsearch-input-item mb-2" id="category_ids">
                                <select data-placeholder="All Category" name="category_id" id="category_id" class="chosen-select search-select" required >
                                    <option value="">Select Category First</option>
                                    
                                </select>
                            </div>
                        </div>
                        <!-- listsearch-input-item --> 						
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
            </div>
            <!-- list-searh-input-wrap end-->							
            <!-- list-main-wrap-header-->
            <div class="list-main-wrap-header box-list-header fl-wrap">
                <!-- list-main-wrap-title-->
                <div class="list-main-wrap-title">
                    <h2>Results:  <strong id="listCount">0</strong> Records</h2>
                </div>        
            </div>
            <!-- list-main-wrap-header end-->						
            <!-- listing-item-wrap-->
            <div class="listing-item-container four-columns-grid  box-list_ic fl-wrap" id="load_data">
               
               					
            </div>
            <!-- listing-item-wrap end-->
            <!-- pagination-->
            <div class="pagination" id="load_more">
               
            </div>
            <!-- pagination end-->						
        </div>
    </section>
    <div class="limit-box fl-wrap"></div>
</div>
        
<script>var site_url = '<?php echo site_url(); ?>';</script>
   
    <script>
        $(function() {
            load('', '');
        });

        function get_states() {
            var country_id = $('#country_id').val();
            $.ajax({
                url: site_url + 'home/account/get_state/' + country_id,
                type: 'post',
                success: function(data) {
                    $('#states_id').html(data);
                    load();
                }
            });
        }

        function get_citys() {
            var state_id = $('#state_id').val();
            $.ajax({
                url: site_url + 'home/account/get_city/' + state_id,
                type: 'post',
                success: function(data) {
                    $('#citys_id').html(data);
                     load();
                }
            });
        }

        function get_categorys() {
            var main_id = $('#main_id').val();
            $.ajax({
                url: site_url + 'home/account/get_category/' + main_id,
                type: 'post',
                success: function(data) {
                    $('#category_ids').html(data);
                }
            });
        }

        function loads() {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            if(!start_date || !end_date){
                $('#date_resul').css('color', 'Red');
                $('#date_resul').html('Enter Start and End Date!!');
            } else if(start_date > end_date){
                $('#date_resul').css('color', 'Red');
                $('#date_resul').html('Start Date cannot be greater!');
            } else {
                load('', '');
                $('#date_resul').html('');
            }
        }

        function load(x, y) {
            var more = 'no';
            var methods = '';
            if (parseInt(x) > 0 && parseInt(y) > 0) {
                more = 'yes';
                methods = '/' +x + '/' + y;
            }

            if (more == 'no') {
                $('#load_data').html('<div class="col-sm-12 text-center"><br/><br/><br/><br/><i class="fal fa-spinner fa-spin" style="font-size:48px;"></i></div>');
            } else {
                $('#loadmore').html('<div class="col-sm-12 text-center"><i class="fal fa-spinner fa-spin"></i></div>');
            }

            var country_id = $('#country_id').val();
            var state_id = $('#state_id').val();
            var city_id = $('#city_id').val();
            var main_id = $('#main_id').val();
            var sub_id = $('#sub_id').val();
            var search = $('#search').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            $.ajax({
                url: site_url + 'home/search/load' + methods,
                type: 'post',
                data: { main_id: main_id,start_date: start_date,end_date: end_date,search: search,city_id: city_id,state_id: state_id,country_id: country_id,sub_id: sub_id },
                success: function (data) {
                    var dt = JSON.parse(data);
                    if (more == 'no') {
                        $('#load_data').html(dt.item);
                    } else {
                        $('#load_data').append(dt.item);
                    }

                    if (dt.offset > 0) {
                        $('#loadmore').html('<a href="javascript:;" class="btn btn-secondary b-block p-30" onclick="load(' + dt.limit + ', ' + dt.offset + ');"><i class="fal fa-repeat"></i> Load ' + dt.left + ' More</a>');
                    } else {
                        $('#loadmore').html('');
                    }

                    $('#listCount').html(dt.count);
                },
                complete: function () {
                    $.getScript(site_url + 'assets/js/jsmodal.js');
                }
            });
        }
    </script>  
<?php echo $this->endSection(); ?>