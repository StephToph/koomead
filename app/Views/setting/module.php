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
                        <a href="javascript:;" class="gradient-bg dashboard-addnew_btn pop show-popup-form" pageTitle="ADD" pageName="<?=site_url('settings/modules/manage'); ?>">Add New <i class="fal fa-plus"></i></a>	
                        <!-- price-opt-->
                        
                    </div>
                    <!-- dashboard-listings-wrap-->
                    <div class="dashboard-listings-wrap fl-wrap">
                        <div class="row">
                            
                            <!-- dashboard-listings-item-->
                            <div class="col-12">
                                <!--  agent card item -->
                                <div class="listing-item">
                                        <div class="geodir-category-content fl-wrap">
                                        <table id="datatable" class="table table-striped table-bordered text-start table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th>Module</th>
                                                    <th width="150px"></th>
                                                </tr>
                                            </thead>
                                            <tbody> </tbody>
                                        </table>
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

<?php echo $this->endSection(); ?>