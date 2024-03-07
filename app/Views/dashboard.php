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
           
            <div class="row">
                <div class="col-sm-12 py-2 d-sm-none" style="text-align:right;">
                    <h5>Welcome, <span><?=$log_name;?></span></h5>
                </div>
                <div class="col-sm-12" style="text-align:right;">
                    <input type="hidden" id="date_type">

                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle"  data-toggle="dropdown">
                            <span><i class="fal fa-filter"></i> <span id="filter_type">This Month</span></span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item text-muted typeBtn" href="javascript:;" data-value="Today">Today</a>
                            <a class="dropdown-item text-muted typeBtn" href="javascript:;" data-value="Yesterday">Yesterday</a>
                            <a class="dropdown-item text-muted typeBtn" href="javascript:;" data-value="Last_Week">Last 7 Days</a>
                            <a class="dropdown-item text-muted typeBtn active" href="javascript:;" data-value="">This Month</a>
                            <a class="dropdown-item text-muted typeBtn" href="javascript:;" data-value="Last_Month">Last 30 Days</a>
                            <a class="dropdown-item text-muted typeBtn" href="javascript:;" data-value="Date_Range">Date Range</a>
                        </div>
                    </div>
                    
                    <div class="btn-group align-items-center mt-3" id="data-resp" style="display:none;">
                        &nbsp;|&nbsp;<b>Date:</b>&nbsp;
                        <input type="date" class="form-control" name="date_from" id="date_from" oninput="load()" style="border:1px solid #ddd;" placeholder="START DATE">
                        &nbsp;<i class="fal fa-arrow-right"></i>&nbsp;
                        <input type="date" class="form-control" name="date_to" id="date_to" oninput="load()" style="border:1px solid #ddd;" placeholder="END DATE">
                    </div>
                </div>
                <div class="col-md-12" style="color:transparent; text-align:right;"><span id="date_resul"></span></div>

            </div>

            <!-- dashboard-title end -->		
            <div class="dasboard-wrapper fl-wrap no-pag">
                <div class="dashboard-stats-contaner fl-wrap">
                    <div class="row">
                        <!--dashboard-stats-->
                       <div class="col-md-3 col-sm-6">
                            <div class="dashboard-stats fl-wrap">
                                <i class="fal fa-chart-bar"></i>
                                <h4>Total Listing</h4>
                                <div class="dashboard-stats-count" id="total_list">0</div>
                            </div>
                        </div>
                        <!-- dashboard-stats end -->
                       <!--dashboard-stats-->
                        <div class="col-md-3 col-sm-6">
                            <div class="dashboard-stats fl-wrap">
                                <i class="fal fa-map-marked"></i>
                                <h4>Active Listings</h4>
                                <div class="dashboard-stats-count" id="active_list">0</div>
                            </div>
                        </div>
                        <!-- dashboard-stats end -->
                        <!--dashboard-stats-->
                        <div class="col-md-3 col-sm-6">
                            <div class="dashboard-stats fl-wrap">
                                <i class="fal fa-eye"></i>
                                <h4>Promoted Listing</h4>
                                <div class="dashboard-stats-count" id="promote_list">0</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="dashboard-stats fl-wrap">
                                <i class="fal fa-eye"></i>
                                <h4>Listing Views</h4>
                                <div class="dashboard-stats-count" id="list_view">0</div>
                            </div>
                        </div>
                        <!-- dashboard-stats end -->
                       <?php if($role != 'user'){?>
                            <!--dashboard-stats-->
                            <div class="col-md-4 col-sm-6">
                                <div class="dashboard-stats fl-wrap">
                                    <i class="fal fa-users"></i>
                                    <h4>No of User</h4>
                                    <div class="dashboard-stats-count" id="user">0</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="dashboard-stats fl-wrap">
                                    <i class="fal fa-users"></i>
                                    <h4>No of Business</h4>
                                    <div class="dashboard-stats-count" id="business">0</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="dashboard-stats fl-wrap">
                                    <i class="fal fa-users"></i>
                                    <h4>No of Promoted Business</h4>
                                    <div class="dashboard-stats-count" id="promoted">0</div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- dashboard-stats end -->		
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="dashboard-widget-title fl-wrap">Last Activites</div>
                        <div class="dashboard-list-box  fl-wrap" id="activity_load">
                            <!-- dashboard-list end-->
                            
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!--box-widget-->
                        <div class="dasboard-widget fl-wrap mt-5">
                            <div class="dasboard-widget-title fl-wrap">
                                <h5><i class="fas fa-comment-alt"></i>Last Messages</h5>
                            </div>
                            <div class="chat-contacts fl-wrap" id="message_load">
                                
                                <!-- chat-contacts-item -->
                            </div>
                        </div>
                        
                        <!--box-widget end --> 								
                    </div>
                </div>
            </div>
        </div>
        
        <script>
    $(function() {
        load_metrics();
        load_activity();load_message();
    });

    $('.typeBtn').click(function() {
        $('#date_type').val($(this).attr('data-value'));
        $('#filter_type').html($(this).html());
        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        if($(this).attr('data-value') == 'Date_Range') {
            $('#data-resp').show(300);
        } else {
            $('#data-resp').hide(300);
            load_metrics();
              load_activity();load_message();
        }
    });

    function load_metrics(){

        var date_type = $('#date_type').val();
        var date_from = $('#date_from').val();
        var date_to = $('#date_to').val();
       
        $.ajax({
            url: site_url + 'dashboard/load_metric',
            type: 'post',
            data: { date_type: date_type, date_from: date_from, date_to: date_to },
            success: function (data) {
                var dt = JSON.parse(data);
                $('#total_list').html(dt.total_list);
                $('#list_view').html(dt.list_view);
                $('#active_list').html(dt.active_list);
                $('#promoted').html(dt.promoted);
                $('#user').html(dt.user);
                $('#promote_list').html(dt.promote_list);
                $('#business').html(dt.business);
               
            }
        });
    
    }

    function load_activity(){
        $('#activity_load').html('<div class="col-sm-12 text-center"><i class="fal fa-spinner fa-spin" style="font-size:29px;"></i>  </div>');
        
        var date_type = $('#date_type').val();
        var date_from = $('#date_from').val();
        var date_to = $('#date_to').val();

       
        $.ajax({
            url: site_url + 'dashboard/activity_load',
            type: 'post',
            data: { date_type: date_type, date_from: date_from, date_to: date_to },
            success: function (data) {
                var dt = JSON.parse(data);
                $('#activity_load').html(dt.activity_load);
                    
            }
        });
    
    }

    function load_message(){
        $('#message_load').html('<div class="col-sm-12 text-center"><i class="fal fa-spinner fa-spin" style="font-size:29px;"></i>  </div>');
        
        var date_type = $('#date_type').val();
        var date_from = $('#date_from').val();
        var date_to = $('#date_to').val();

       
        $.ajax({
            url: site_url + 'dashboard/message_load',
            type: 'post',
            data: { date_type: date_type, date_from: date_from, date_to: date_to },
            success: function (data) {
                var dt = JSON.parse(data);
                $('#message_load').html(dt.message_load);
                    
            }
        });
    
    }

    



</script>  
<?php echo $this->endSection(); ?>