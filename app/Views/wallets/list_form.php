
<?php
use App\Models\Crud;
$this->Crud = new Crud();
?>
<?php echo form_open_multipart($form_link, array('id'=>'bb_ajax_form', 'class'=>'')); ?>
    <!-- delete view -->
    <?php if($param2 == 'delete') { ?>
        <div class="row">
            <div class="col-sm-12"><div id="bb_ajax_msg"></div></div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-center">
                <h3><b>Are you sure?</b></h3>
                <input type="hidden" name="d_branch_id" value="<?php if(!empty($d_id)){echo $d_id;} ?>" />
            </div>
            
            <div class="col-sm-12 text-center">
                <button class="btn btn-danger text-uppercase" type="submit">
                    <i class="ri-delete-bin-4-line"></i> Yes - Delete
                </button>
            </div>
        </div>
    <?php } ?>

    <?php if($param1 == 'statement') { ?>
        <div class="row">
            <div id="statement" class="col-sm-12"> </div>
        </div>
    <?php } ?>
<?php echo form_close(); ?>
<script>
    $('.js-select2').select2();
    var sid = '<?php if(!empty($statement_id)) { echo $statement_id; } ?>';
    
    $(document).ready(function(){
        if(sid != '') { statement(); }
    });
    function statement() {
        // $('#fullname').html('Verifying...');
        
        $.ajax({
            url: '<?php echo base_url('wallets/account'); ?>/' + sid,
            success: function(data) {
                $('#statement').html(data);
            }
      });
    }
    function statea() {
        var country = $('#country_id').val();
        $.ajax({
            url: '<?=site_url('accounts/get_state/');?>'+ country,
            success: function(data) {
                $('#state_resp').html(data);
            }
        });
        
    }

    function lgaa() {
        var lga = $('#state').val();
        $.ajax({
            url: '<?=site_url('accounts/get_lga/');?>'+ lga,
            success: function(data) {
                $('#lga_resp').html(data);
            }
        });
    }
    function export_wallet(id){
        $('#export_resp').html('<div class="col-sm-12 text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div> Loading Please Wait..</div>');
        $.ajax({
            url: '<?=site_url('wallets/list/download/');?>'+ id,
            success: function(data) {
                $('#export_resp').html(data);
            }
        });
    }
</script>
<script src="<?php echo site_url(); ?>assets/js/jsform.js"></script>