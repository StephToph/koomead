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
        <div class="dasboard-wrapper fl-wrap">
            <div class="dasboard-listing-box fl-wrap">
                
                <div class="dasboard-opt sl-opt fl-wrap float-end">
                    <span class="font-weight-bold float-start p-3 font-size-14">You have <span id="listCount"> 0</span> listing(s)</span>
                    <a href="<?=site_url('listing/index/add');?>" class="btn btn-primary float-end">Add New <i class="fal fa-plus"></i></a>	
                </div>
                <div class="dasboard-opt sl-opt fl-wrap">
                    <div class="dashboard-search-listing">
                        <input type="text" onclick="this.select()" id="search" oninput="load()" placeholder="Search" value="">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </div>

                    <a href="javascript:;" pageTitle="Add New" onclick="$('#filter_box').toggle();" class="btn btn-info float-end">Filter<i class="fal fa-filter"></i></a>	
                    
                </div>

                <div id="filter_box" class="row mb-3" style="display:none;">
                    <div  class="geodir-category-content fl-wrap">
                        <div class="col-12 col-sm-6 mb-2">
                            <div class="row">
                                <div class="col-6 col-sm-6 mb-3"> <label for="name" class="small text-muted">START DATE</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" oninput="loads()" style="border:1px solid #ddd;">
                                    
                                </div>
                                <div class="col-6 col-sm-6 mb-3"><label for="name" class="small text-muted">END DATE</label>
                                    
                                    <input type="date" class="form-control" name="end_date" id="end_date" oninput="loads()" style="border:1px solid #ddd;">
                                </div> 
                                <div class="col-sm-12" style="color: transparent;"><span id="date_resul"></span></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-2 mt-2">
                            <div class="listsearch-input-item">
                                <select data-placeholder="Select" name="country_id" id="country_id" class="mb-2 chosen-select search-select"  onchange="get_state();">
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
                        <div class="col-12 col-sm-3 mb-2 mt-2">
                            <div class="listsearch-input-item mb-2" id="states_id">
                                <select data-placeholder="Select" name="state_id" id="state_id" required  class="mb-2 chosen-select search-select" onchange="load()">
                                    <option value="all">Select Country First</option>

                                </select>
                            </div>  
                        </div>
                        <div class="col-12 col-sm-3 mb-2 mt-2">
                            <div class="listsearch-input-item mb-2" id="citys_id">
                                <select data-placeholder="Select" onchange="load()" name="city_id" id="city_id"
                                    required class="mb-2 chosen-select search-select">
                                    <option value="all">Select State First</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 mb-2 mt-2">
                            <div class="listsearch-input-item">
                                <select data-placeholder="All Status" id="ban" onchange="load('', '')" class="chosen-select no-search-select" >
                                    <option value="all">All Status</option>
                                    <option value="0">Active</option>
                                    <option value="1">Disabled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- dashboard-listings-wrap-->
                    <div class="row  mb-5">
                        <div class="geodir-category-content fl-wrap">
                            <div class="col-12 text-start ">
                                <ul class="list-group">
                                    <div id="load_data"></div>
                                </ul>

                                <div id="loadmore"></div>									
                            </div>
                        </div>                                      
                    </div>
                <!-- dashboard-listings-wrap end-->
            </div>
            
        </div>
    </div>

        
    <!-- <script src="<?php echo site_url(); ?>/assets/js/jquery.min.js"></script> -->
    <script>var site_url = '<?php echo site_url(); ?>';</script>
   
    <script>
        $(function() {
            load('', '');
        });

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
            var ban = $('#ban').val();
            var search = $('#search').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            $.ajax({
                url: site_url + 'listing/index/load' + methods,
                type: 'post',
                data: { ban: ban,start_date: start_date,end_date: end_date,search: search,city_id: city_id,state_id: state_id,country_id: country_id },
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