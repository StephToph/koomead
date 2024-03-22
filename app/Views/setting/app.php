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
        <div class="dasboard-wrapper fl-wrap text-start">
            <div class="dasboard-listing-box fl-wrap">
                <div class="row geodir-category-content">
                    
                    <!-- dashboard-listings-item-->
                    <div class="col-sm-12">
                        <table class="table table-responsive table-striped">
                            <thead>
                                <tr>
                                    <td><b>NAME</b></td>
                                    <td><b>VALUE</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(!empty($settings)) {
                                        foreach($settings as $s) {
                                            if($role != 'developer'){
                                                if($s->name != 'admin_share' && $s->name != 'promoter_share' && $s->name != 'viewer_share'  && $s->name != 'sandbox'){
                                                    continue;
                                                }
                                            }
                                            echo '
                                                <tr>
                                                    <td>'.ucwords(str_replace('_',' ',$s->name)).'</td>
                                                    <td>
                                                        <input id="value'.$s->id.'" type="text" value="'.$s->value.'" class="form-control" oninput="update_app('.$s->id.');" />
                                                    </td>
                                                </tr>
                                            ';
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>									
                    </div>
                                                                
                </div>
                <!-- dashboard-listings-wrap end-->
            </div>
            
        </div>
    </div>
    
<script>
    function update_app(id) {
        var value = $('#value' + id).val();
        
        $.ajax({
            url: '<?php echo site_url('settings/update_app'); ?>',
            type: 'post',
            data: {id: id, value: value},
            success: function(data) {}
        });
    }
  </script>
  
<?php echo $this->endSection(); ?>