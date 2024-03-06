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
                
                <div class="dasboard-opt sl-opt fl-wrap float-end">
                    <span class="font-weight-bold float-start p-3 font-size-14">You have <span id="listCount"> 0</span> promotion(s)</span>
                    <a href="javascript:;" pageName="<?=site_url('listing/index/manage/promote/'.$param2);?>" pageTitle="Promote" class="btn btn-primary pop float-end" pageSize="modal-lg">Promote <i class="fal fa-plus"></i></a>	
                </div>
                <div class="dasboard-opt sl-opt fl-wrap">
                    <div class="dashboard-search-listing">
                        <input type="text" onclick="this.select()" id="search" oninput="load()" placeholder="Search" value="">
                        <button type="submit"><i class="far fa-search"></i></button>
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
    <input type="hidden" id="listing_id" value="<?=$param2; ?>">
    
    <!-- <script src="<?php echo site_url(); ?>assets/js/jquery.min.js"></script> -->
    <script>var site_url = '<?php echo site_url(); ?>';</script>
    <script>
        $(function() {
            load();
        });


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

            var search = $('#search').val();
            var listing_id = $('#listing_id').val();

            $.ajax({
                url: site_url + 'listing/promotion/load' + methods,
                type: 'post',
                data: { search: search,listing_id: listing_id },
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
                },
                complete: function () {
                    $.getScript(site_url + 'assets/js/jsmodal.js');
                }
            });
        }
    </script>   
<?php echo $this->endSection(); ?>