<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>

<?php echo $this->extend('designs/backend'); ?>
<?php echo $this->section('title'); ?>
    <?php echo $title; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<!-- content -->	
<div class="dashboard-content">
    <div class="dashboard-menu-btn color-bg"><span><i class="fas fa-bars"></i></span>Dasboard Menu</div>
    <div class="container dasboard-container">
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
                <div class="dasboard-opt sl-opt fl-wrap">
                    <div class="dashboard-search-listing">
                        <input type="text" onclick="this.select()" id="search" oninput="load()" placeholder="Search" value="">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </div>
                    
                    <a href="javascript:;" pageTitle="Add New" onclick="$('#filter_box').toggle();" class="btn btn-info float-end">Filter <i class="fal fa-filter"></i></a>	
                   
                    
                </div>
                <div id="filter_box" class="row mb-3 pt-3" style="display:none;">
                    <div  class="geodir-category-content fl-wrap">
                        <div class="col-12 col-sm-6 mb-2">
                            <div class="row">
                                <div class="col-6 col-sm-6 mb-3"> <label for="name" class="small text-muted">START DATE</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" oninput="loads()" style="border:1px solid #ddd;">
                                    
                                </div>
                                <div class="col-6 col-sm-6 mb-3"><label for="name" class="small text-muted">END DATE</label>
                                    
                                    <input type="date" class="form-control" name="end_date" id="end_date" oninput="loads()" style="border:1px solid #ddd;">
                                </div> 
                            </div>
                            
                        </div>
                        <div class="col-12 col-sm-3 mb-2 mt-2">
                            <div class="listsearch-input-item">
                                <select data-placeholder="All Status" id="type" onchange="load('', '')" class="chosen-select no-search-select" >
                                    <option value="all">All Type</option>
                                    <option value="credit">Credit</option>
                                    <option value="debit">Debit</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="dasboard-opt sl-opt fl-wrap float-end">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="dashboard-stats fl-wrap">
                                <i class="fal fa-cash-register"></i>
                                <h4>Available Balance</h4>
                                <div class="dashboard-stats-count" id="total">0</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="dashboard-stats fl-wrap">
                                <i class="fal fa-sack-dollar"></i>
                                <h4>Total Credited</h4>
                                <div class="dashboard-stats-count" id="credit">0</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="dashboard-stats fl-wrap">
                                <i class="fal fa-money-bill-alt"></i>
                                <h4>Total Debited</h4>
                                <div class="dashboard-stats-count" id="debit">0</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!-- dashboard-listings-wrap-->
                <div class="dashboard-listings-wrap fl-wrap">
                    <div class="row">
                        
                        <!-- dashboard-listings-item-->
                        <div class="col-12 text-start">
                            <!--  agent card item -->
                            <div class="listing-item">
                                    <div class="geodir-category-content fl-wrap">
                                    <ul class="list-group">
                                        <div id="load_data"></div>
                                    </ul>

                                    <div id="loadmore"></div>
                                    </div>
                            </div>
                            <!--  agent card item end -->										
                        </div>
                                                                    
                    </div>
                </div>
                <!-- dashboard-listings-wrap end-->
            </div>
            
        </div>
    </div>

    
    <!-- <script src="<?php echo site_url(); ?>assets/js/jquery.min.js"></script> -->
    <script>var site_url = '<?php echo site_url(); ?>';</script>
    <script>
        $(function() {
            $('.selects2').select2();
            load('', '');
        });

        
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
                methods = '/'+x + '/' + y;
            }

            if (more == 'no') {
                $('#load_data').html('<div class="col-sm-12 text-center"><br/><br/><br/><br/><i class="fal fa-spinner fa-spin" style="font-size:48px;"></i> Loading.. Please Wait..</div>');
            } else {
                $('#loadmore').html('<div class="col-sm-12 text-center"><i class="fal fa-spinner fa-spin" style="font-size:29px;"></i> Loading.. Please Wait..</div>');
            }

            var country_id = $('#country_id').val();
            var state_id = $('#state_id').val();
            var city_id = $('#city_id').val();
            var type = $('#type').val();
            var status = $('#status').val();
            var search = $('#search').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            $.ajax({
                url: site_url + 'wallets/list/load' + methods,
                type: 'post',
                data: { start_date: start_date,end_date: end_date,type: type,search: search },
                success: function (data) {
                    var dt = JSON.parse(data);
                    if (more == 'no') {
                        $('#load_data').html(dt.item);
                    } else {
                        $('#load_data').append(dt.item);
                    }

                    if (dt.offset > 0) {
                        $('#loadmore').html('<a href="javascript:;" class="btn btn-secondary d-block p-30" onclick="load(' + dt.limit + ', ' + dt.offset + ');"><i class="fal fa-repeat-alt"></i> Load ' + dt.left + ' More</a>');
                    } else {
                        $('#loadmore').html('');
                    }

                    $('#listCount').html(dt.count);
                    $('#total').html(dt.total);
                    $('#credit').html(dt.credit);
                    $('#debit').html(dt.debit);
                },
                complete: function () {
                    $.getScript(site_url + 'assets/js/jsmodal.js');
                }
            });
        }
    </script>   
<?php echo $this->endSection(); ?>