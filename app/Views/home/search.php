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
                <h2><span>Listings Without Map</span></h2>
                <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h4>
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
                <a href="<?=site_url(); ?>">Home</a><a href="#">Listings</a> <span>New York</span>
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
                                    <option value="all">All Country</option>
                                    <?php
                                            $country = $this->Crud->read_order('country', 'name', 'asc');
                                            if(!empty($country)){
                                                foreach($country as $c){
                                                    if($c->name != 'Nigeria' && $c->name != 'United Kingdom')continue;
                                                    echo '<option value="'.$c->id.'">'.$c->name.'</option>';
                                                }
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-2">
                            <div class="listsearch-input-item mb-2" id="states_id">
                                <select data-placeholder="Select" name="state_id" id="state_id" required  class="mb-2 chosen-select search-select" onchange="load()">
                                    <option value="all">Select Country First</option>

                                </select>
                            </div>  
                        </div>
                        <div class="col-12 col-sm-3 mb-2">
                            <div class="listsearch-input-item mb-2" id="citys_id">
                                <select data-placeholder="Select" onchange="load()" name="city_id" id="city_id"
                                    required class="mb-2 chosen-select search-select">
                                    <option value="all">Select State First</option>

                                </select>
                            </div>
                        </div>

                        <!-- listsearch-input-item -->								
                        <!-- listsearch-input-item -->
                        <div class="col-sm-3">
                            <div class="listsearch-input-item">
                                <select data-placeholder="All Cities" class="chosen-select on-radius no-search-select" >
                                    <option>All Cities</option>
                                    <option>New York</option>
                                    <option>London</option>
                                    <option>Paris</option>
                                    <option>Kiev</option>
                                    <option>Moscow</option>
                                    <option>Dubai</option>
                                    <option>Rome</option>
                                    <option>Beijing</option>
                                </select>
                            </div>
                        </div>
                        <!-- listsearch-input-item -->
                        <div class="clearfix"></div>
                        <!-- listsearch-input-item -->
                        <div class="col-sm-4">
                            <div class="listsearch-input-item">
                                <select data-placeholder="Categories" class="chosen-select on-radius no-search-select" >
                                    <option>All Categories</option>
                                    <option>House</option>
                                    <option>Apartment</option>
                                    <option>Hotel</option>
                                    <option>Villa</option>
                                    <option>Office</option>
                                </select>
                            </div>
                        </div>
                        <!-- listsearch-input-item -->								
                        <!-- listsearch-input-item -->
                        <div class="col-sm-5">
                            <div class="listsearch-input-item">
                                <div class="price-rage-item fl-wrap">
                                    <span class="pr_title">Price:</span>                            
                                    <input type="text" class="price-range-double" data-min="100" data-max="100000"  name="price-range2"  data-step="100" value="1" data-prefix="$">
                                </div>
                            </div>
                        </div>
                        <!-- listsearch-input-item -->								
                        <!-- listsearch-input-item -->
                        <div class="col-sm-3">
                            <div class="listsearch-input-item">
                                <a href="#" class="btn color-bg fw-btn float-btn small-btn">Search</a>										
                            </div>
                        </div>
                        <!-- listsearch-input-item --> 						
                    </div>
                    <div class="clearfix"></div>
                    <div class="hidden-listing-filter fl-wrap">
                        <div class="row">
                            <!-- listsearch-input-item -->								
                            <div class="col-sm-2">
                                <div class="listsearch-input-item">
                                    <label>Bedrooms</label>
                                    <select data-placeholder="Bedrooms" class="chosen-select on-radius no-search-select" >
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <!-- listsearch-input-item end-->
                            <!-- listsearch-input-item -->								
                            <div class="col-sm-2">
                                <div class="listsearch-input-item">
                                    <label>Bathrooms</label>
                                    <select data-placeholder="Bathrooms" class="chosen-select on-radius no-search-select" >
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </div>
                            <!-- listsearch-input-item end-->
                            <!-- listsearch-input-item -->
                            <div class="col-sm-2">
                                <div class="listsearch-input-item">
                                    <label>Floors</label>
                                    <select data-placeholder="Bathrooms" class="chosen-select on-radius no-search-select" >
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </div>
                            <!-- listsearch-input-item end-->
                            <!-- listsearch-input-item -->
                            <div class="col-sm-2">
                                <div class="listsearch-input-item">
                                    <label>Property Id</label>
                                    <input type="text" onClick="this.select()" placeholder="Id" value=""/>
                                </div>
                            </div>
                            <!-- listsearch-input-item end-->								
                            <!-- listsearch-input-item -->
                            <div class="col-sm-4">
                                <div class="listsearch-input-item">
                                    <label>Area Sq/ft</label>
                                    <div class="price-rage-item pr-nopad fl-wrap">
                                        <input type="text" class="price-range-double" data-min="1" data-max="1000"  name="price-range2"  data-step="1" value="1" data-prefix="">
                                    </div>
                                </div>
                            </div>
                            <!-- listsearch-input-item -->								
                        </div>
                        <div class="clearfix"></div>
                        <!-- listsearch-input-item-->
                        <div class="listsearch-input-item">
                            <label>Amenities</label>
                            <div class=" fl-wrap filter-tags">
                                <ul class="no-list-style">
                                    <li>
                                        <input id="check-aa" type="checkbox" name="check">
                                        <label for="check-aa">Elevator in building</label>
                                    </li>
                                    <li>
                                        <input id="check-b" type="checkbox" name="check">
                                        <label for="check-b"> Laundry Room</label>
                                    </li>
                                    <li>
                                        <input id="check-c" type="checkbox" name="check" checked>
                                        <label for="check-c">Equipped Kitchen</label>
                                    </li>
                                    <li>
                                        <input id="check-d" type="checkbox" name="check">
                                        <label for="check-d">Air Conditioned</label>
                                    </li>
                                    <li>
                                        <input id="check-d2" type="checkbox" name="check" checked>
                                        <label for="check-d2">Parking</label> 
                                    </li>
                                    <li>
                                        <input id="check-d3" type="checkbox" name="check" checked>
                                        <label for="check-d3">Swimming Pool</label> 
                                    </li>
                                    <li>   
                                        <input id="check-d4" type="checkbox" name="check">
                                        <label for="check-d4">Fitness Gym</label>
                                    </li>
                                    <li>   
                                        <input id="check-d5" type="checkbox" name="check">
                                        <label for="check-d5">Security</label>
                                    </li>
                                    <li>   
                                        <input id="check-d6" type="checkbox" name="check">
                                        <label for="check-d6">Garage Attached</label>
                                    </li>
                                    <li>   
                                        <input id="check-d7" type="checkbox" name="check">
                                        <label for="check-d7">Back yard</label>
                                    </li>
                                    <li>   
                                        <input id="check-d8" type="checkbox" name="check">
                                        <label for="check-d8">Fireplace</label>
                                    </li>
                                    <li>   
                                        <input id="check-d9" type="checkbox" name="check">
                                        <label for="check-d9">Window Covering</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- listsearch-input-item end--> 												
                    </div>
                </div>
                <div class="more-filter-option-wrap">
                    <div class="more-filter-option-btn more-filter-option act-hiddenpanel"> <span>Advanced search</span> <i class="fas fa-caret-down"></i></div>
                    <div class="reset-form reset-btn"> <i class="far fa-sync-alt"></i> Reset Filters</div>
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
            var active = $('#active').val();
            var category_id = $('#category_id').val();
            var search = $('#search').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            $.ajax({
                url: site_url + 'home/search/load' + methods,
                type: 'post',
                data: { category_id: category_id,start_date: start_date,end_date: end_date,search: search,city_id: city_id,state_id: state_id,country_id: country_id,active: active },
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