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
                        <div class="col-sm-4 mb-3">
                            <label class="">User Role</label>
                            <div class="listsearch-input-item">
                                <select data-placeholder="Select Role"  id="role_id" name="role_id"  class="chosen-select no-search-select" onchange="getModule();">
                                    <option value="">Select</option>
                                    <?php if(!empty($allrole)): ?>
                                    <?php foreach($allrole as $rol): ?>
                                        <?php if($role == 'administrator') if($rol->name == 'Developer') continue; ?>
                                        <option value="<?php echo $rol->id; ?>" <?php if(!empty($e_role_id)){if($e_role_id == $rol->id){echo 'selected';}} ?>><?php echo $rol->name; ?></option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <!-- dashboard-listings-item-->
                        <div class="col-sm-12">
                            <!--  agent card item -->
                                <table style="width:100%" class="table table-striped table-bordered text-start table-responsive ">
                                    <thead>
                                        <tr>
                                            <th>Module</th>
                                            <th><u>C</u><span class="hidden-xs">reate</span></th>
                                            <th><u>R</u><span class="hidden-xs">ead</span></th>
                                            <th><u>U</u><span class="hidden-xs">pdate</span></th>
                                            <th><u>D</u><span class="hidden-xs">elete</span></th>
                                        </tr>
                                    </thead>
                                    <tbody id="module_list">
                                    </tbody>
                                </table>
                            <!--  agent card item end -->										
                        </div>
                                                                    
                    </div>
                    <!-- dashboard-listings-wrap end-->
                </div>
                
            </div>
        </div>
   
<script>
    $(function() {
        $('.select2').select2();
    });
    
    function getModule() {
        var role_id = $('#role_id').val();
        $('#module_list').html('<div class="row"><div class="text-center col-lg-12"><i class="fal fa-spinner-third fa-spin" style="font-size:50px"></i></i></div></div>');
        $.ajax({
            url: '<?php echo site_url('settings/get_module'); ?>',
            type: 'post',
            data: {role_id: role_id},
            success: function(data) {
                $('#module_list').html(data);
            },
            complete: function() {
                // icheck();
            }
      });
    }

    function saveModule(x) {
        var rol = $('#rol').val();
        var mod = $('#mod' + x).val();
        var c = $('#c' + x);
        var r = $('#r' + x);
        var u = $('#u' + x);
        var d = $('#d' + x);
      
        if(c.is(':checked')){c = 1;} else {c = 0;}
        if(r.is(':checked')){r = 1;} else {r = 0;}
        if(u.is(':checked')){u = 1;} else {u = 0;}
        if(d.is(':checked')){d = 1;} else {d = 0;}
      
        $.ajax({
            url: '<?php echo site_url('settings/save_module'); ?>',
            type: 'post',
            data: {rol: rol, mod: mod, c: c, r: r, u: u, d: d},
            success: function(data) {
                //$('#module_list').html(data);
            }
        });
    }

    function icheck() {
        $('input[type="checkbox"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red'
        });
    }
  </script>
  <?php echo $this->endSection(); ?>