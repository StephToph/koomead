<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>

<?php echo form_open_multipart($form_link, array('id'=>'bb_ajax_form', 'class'=>'text-start custom-form')); ?>
    <!-- delete view -->
    <?php if($param2 == 'delete') { ?>
        <div class="row">
            <div class="col-sm-12"><div id="bb_ajax_msg"></div></div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-center">
                <h3><b>Are you sure?</b></h3>
                <input type="hidden" name="d_listing_id" value="<?php if(!empty($d_id)){echo $d_id;} ?>" />
            </div>
            
            <div class="col-sm-12 text-center">
                <button class="btn btn-danger text-uppercase" type="submit">
                    <i class="fal fa-trash"></i> Yes - Delete
                </button>
            </div>
        </div>
    <?php } ?>

    <?php if($param2 == 'disable') { ?>
        <div class="row">
            <div class="col-sm-12"><div id="bb_ajax_msg"></div></div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-center">
                <h3><b>Are you sure?</b></h3>
                <input type="hidden" name="d_listing_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <div class="listsearch-input-item mb-2">
                        <select data-placeholder="Select" id="active" name="active" required class="mb-2 select22 form-select">
                            <option value="0" <?php if(empty($e_active)){if($e_active == 0){echo 'selected';}} ?>>Yes</option>
                            <option value="1" <?php if(!empty($e_active)){if($e_active == 1){echo 'selected';}} ?>>No</option>
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <button class="btn btn-danger text-uppercase" type="submit">
                    <i class="fal fa-trash"></i> Yes - Delete
                </button>
            </div>
        </div>
    <?php } ?>

    <?php echo form_close(); ?>
    
    <?php echo form_open_multipart('listing/promotion/manage/add', array('id'=>'bb_ajax_form2', 'class'=>'text-start custom-form')); ?>
    <!-- insert/edit view -->
    <?php if($param2 == 'promote') { ?>
        <div class="row">
            <div class="col-sm-12"><div id="bb_ajax_msg2"></div></div>
        </div>

        <div class="row">
            <input type="hidden" name="listing_id" id="listing_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="markerter_id">Promotion Type</label>
                    <div class="listsearch-input-item mb-2">
                        <select data-placeholder="Select" id="promotion_id" name="promote_id" onchange="promote();" required class="mb-2 select22 form-select">
                            <option value="">Select</option>
                            <?php 
                                $prom = $this->Crud->read_single_order('status', 0, 'promotion', 'name', 'asc');
                                if(!empty($prom)){
                                    foreach($prom as $p){
                                        $sel = '';
                                       if(!empty($e_promotion_id)){if($e_promotion_id == $p->id){$sel= 'selected';}} 
                                        echo '<option value="'.$p->id.'" '.$sel.'>'.$p->name.'</option>';
                                    }
                                }

                            ?>
                            
                        </select>
                        
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="markerter_id"><span class="dec-icon"><i class="fal fa-sack-dollar"></i> </span> Amount</label>
                    <input class="form-control" type="text" id="amount" name="amount" readonly required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="markerter_id"><span class="dec-icon"><i class="far fa-eye"></i> </span> Expected Number of View</label>
                    <input class="form-control" type="text" id="no_view" name="no_view" readonly required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="markerter_id"> <span class="dec-icon"><i class="far fa-clock"></i> </span> Duration (Days)</label>
                    <input class="form-control" type="text" id="duration" name="duration" readonly required>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="markerter_id"> <span class="dec-icon"><i class="far fa-calendar-alt"></i> </span> Expiry Date</label>
                    <input class="form-control" type="text" id="expiry_date" name="expiry_date" readonly required>
                </div>
            </div>

           

            <div class="col-sm-12 text-center">
                <button class="btn btn-primary bb_form_btn" type="submit">
                    <i class="fal fa-save"></i> Run Promotion
                </button>
            </div>
        </div>
    <?php } ?>

    <?php echo form_close(); ?>
<script src="<?php echo base_url(); ?>/assets/js/jsform.js"></script>
<script>
    $(".select22").select2();
    function promote(){
        var promotion_id = $('#promotion_id').val();
        var listing_id = $('#listing_id').val();
        if(promotion_id !== ''){
            $.ajax({
                url: site_url + 'listing/promote/' + promotion_id + '/'+listing_id,
                type: 'post',
                success: function (data) {
                    var dt = JSON.parse(data);
                    $('#amount').val(dt.amount);
                    $('#duration').val(dt.duration);
                    $('#expiry_date').val(dt.expiry_date);
                    $('#no_view').val(dt.no_view);
                    

                }
            });
        }
    }
</script>