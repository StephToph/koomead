
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
    
<?php if($param1 == 'fund'){?>
    <div class="login-opup">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="login">
                    <div class="row">
                        <div class="col-sm-12"><div id="bb_ajax_msg2"></div></div>
                    </div>
                    <?php echo form_open_multipart('wallets/wallet_fund', array('id'=>'bb_ajax_form2', 'class'=>'')); ?>
                    <div class="row g-6">
                        <input type="hidden" name="user_id" value="<?php if(!empty($log_id)){echo $log_id;} ?>">
                        <input type="hidden" name="country_id" value="<?php if(!empty($country_id)){echo $country_id;} ?>">
                        <?php
                            if($country_id == '161'){?>
                            <div class="bg-white border rounded mb-3 col-md-12 col-12 mx-1">
                                <input type="text" class="form-control bg-white border-0 ps-0" onchange="amo_cal();" oninput="this.value=this.value.replace(/[^\d]/,'')" name="amount" id="amount" required placeholder="5000">
                            </div>

                                
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                        <?php } else {?>

                            <div class="bg-white border rounded mb-3 col-md-12 col-12 mx-1">
                                <input type="text" class="form-control bg-white border-0 ps-0" onchange="cur_cal();" oninput="this.value=this.value.replace(/[^\d]/,'')" name="amount" id="amount" required placeholder="5000">
                            </div>
                            
                            <script src="https://js.stripe.com/v3/"></script>
                        <?php } ?>
                        
                        <div class="bg-white border rounded mb-3 col-md-12 col-12 mx-1">
                            <h3 id="t_amount" class="text-center text-success mb-1 fw-bold">0.00</h3>
                            <input type="hidden" class="form-control bg-white border-0 ps-0"  name="tot_amount" id="tot_amount" readonly placeholder="0.00">
                        </div>
                    </div>
                    <div class="row g-4 mt-4">
                        <div class="col-sm-12">
                           <!-- <img src="<?=site_url('assets/images/pay.png'); ?>" style="width:100%"> -->
                        </div>
                    </div>
                    <button class="btn btn-lg text-white py-3 bb_form_btn px-4 text-uppercase w-100 mt-4" style="background-color:#1b2a53 !important;"  type="submit" id="btns">Make Payment <i class="bi bi-arrow-right ms-2"></i></button>
                    
                </form>
                    
                </div>
                
            </div>
        </div>
    </div>
<?php } ?>

<?php if($param1 == 'withdraw'){?>
    <div class="login-opup">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="login">
                    <div class="row">
                        <div class="col-sm-12"><div id="bb_ajax_msg3"></div></div>
                    </div>
                    <?php echo form_open_multipart('wallets/withdraw', array('id'=>'bb_ajax_form3', 'class'=>'')); ?>
                    <div class="row g-6">
                        <input type="hidden" name="user_id" value="<?php if(!empty($log_id)){echo $log_id;} ?>">
                        <input type="hidden" name="country_id" value="<?php if(!empty($country_id)){echo $country_id;} ?>">
                        <?php
                            if($country_id == '161'){?>
                            <div class="bg-white border rounded mb-3 col-md-12 col-12 mx-1">
                                <input type="text" class="form-control bg-white border-0 ps-0" onchange="amo_cal();" oninput="this.value=this.value.replace(/[^\d]/,'')" name="amount" id="amount" required placeholder="5000">
                            </div>

                        <?php } else {?>

                            <div class="bg-white border rounded mb-3 col-md-12 col-12 mx-1">
                                <input type="text" class="form-control bg-white border-0 ps-0" onchange="cur_cal();" oninput="this.value=this.value.replace(/[^\d]/,'')" name="amount" id="amount" required placeholder="5000">
                            </div>
                            
                        <?php } ?>
                        
                    </div>
                    <button class="btn btn-lg text-white py-3 bb_form_btn px-4 text-uppercase w-100 mt-4" style="background-color:#1b2a53 !important;"  type="submit" id="btns">Withdraw <i class="bi bi-arrow-right ms-2"></i></button>
                    
                </form>
                    
                </div>
                
            </div>
        </div>
    </div>
<?php } ?>

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
    function isEmpty(str) {
        return (!str || str.length === 0);
    }

    function amo_cal() {
        var amount = $('#amount').val();
        var tot = 0.00; // Initialize tot with a default value
        
        if (!isEmpty(amount)) {
            var amo = parseFloat(amount);
            var tota = (0.015 * amo) + amo;
            var ans = Math.ceil(tota); // Round up to the nearest unit
            tot = ans.toLocaleString('en-US', { style: 'currency', currency: 'NGN' });
        }
        
        $('#tot_amount').val(ans);
        $('#t_amount').html(tot);
    }

    function cur_cal() {
        var amount = $('#amount').val();
        var tot = 0.00; // Initialize tot with a default value
        
        if (!isEmpty(amount)) {
            var amo = parseFloat(amount);
            var tota = (0.029 * amo) + amo + 0.3;
            var ans = Math.ceil(tota); // Round up to the nearest unit
            tot = ans.toLocaleString('en-US', { style: 'currency', currency: 'eur' });
        }
        
        $('#tot_amount').val(ans);
        $('#t_amount').html(tot);
    }

</script>
<script src="<?php echo site_url(); ?>assets/js/jsform.js"></script>