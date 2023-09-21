<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>
<?php echo form_open_multipart($form_link, array('id'=>'bb_ajax_form', 'class'=>'text-start custom-form')); ?>
    
    <?php if($param2 == 'delete') { ?>
        <div class="row">
            <div class="col-sm-12"><div id="bb_ajax_msg"></div></div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-center">
                <h3><b>Are you sure?</b></h3>
                <input type="hidden" name="d_promotion_id" value="<?php if(!empty($d_id)){echo $d_id;} ?>" />
            </div>
            
            <div class="col-sm-12 text-center">
                <button class="btn btn-danger text-uppercase" type="submit">
                    <i class="fal fa-trash"></i> Yes - Delete
                </button>
            </div>
        </div>
    <?php } ?>
    <?php if($param2 == 'view') { ?>
       
       <div class="row">
           <table  class="table table-striped table-bordered text-start table-responsive ">
               <thead>
                   <tr>
                       <th>Module</th>
                       <th width="150px"></th>
                   </tr>
               </thead>
               <tbody> </tbody>
           </table>
       </div>
   <?php } ?>

    <!-- insert/edit view -->
    <?php if($param2 == 'edit' || $param2 == '') { ?>
        <div class="row">
            <div class="col-sm-12"><div id="bb_ajax_msg"></div></div>
        </div>

        <div class="row">
            <input type="hidden" name="promotion_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />

            <div class="col-sm-12 mb-3">
                <div class="form-group">
                    <label for="commission">Name <span class="dec-icon"><i class="far fa-location"></i></span></label>
                    <input class="form-control" type="text" id="name" name="name" value="<?php if(!empty($e_name)) { echo $e_name; } ?>" required>
                </div>
            </div>

            <div class="col-sm-6 mb-3">
                <div class="form-group">
                    <label for="commission">UK Price <span class="dec-icon"><i class="far fa-location"></i></span></label>
                    <input class="form-control" type="text" id="price" name="price" value="<?php if(!empty($e_price)) { echo $e_price; } ?>" required>
                </div>
            </div>

            <div class="col-sm-6 mb-3">
                <div class="form-group">
                    <label for="commission">Nigeria Price <span class="dec-icon"><i class="far fa-location"></i></span></label>
                    <input class="form-control" type="text" id="nig_price" name="nig_price" value="<?php if(!empty($e_nig_price)) { echo $e_nig_price; } ?>" required>
                </div>
            </div>

            <div class="col-sm-6 mb-3">
                <div class="form-group">
                    <label for="commission">No of Views <span class="dec-icon"><i class="far fa-location"></i></span></label>
                    <input class="form-control" type="text" id="view" name="view" value="<?php if(!empty($e_view)) { echo $e_view; } ?>" required>
                </div>
            </div>

            <div class="col-sm-6 mb-3">
                <div class="form-group">
                    <label for="commission">Number of Promoter <span class="dec-icon"><i class="far fa-location"></i></span></label>
                    <input class="form-control" type="text" id="promoter_no" name="promoter_no" value="<?php if(!empty($e_promoter_no)) { echo $e_promoter_no; } ?>" required>
                </div>
            </div>

            <div class="col-sm-6 mb-3">
                <div class="form-group">
                    <label for="commission">Duration(Days) <span class="dec-icon"><i class="far fa-location"></i></span></label>
                    <input class="form-control" type="text" id="duration" name="duration" value="<?php if(!empty($e_duration)) { echo $e_duration; } ?>" required>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="markerter_id">Active</label>
                    <div class="listsearch-input-item mb-2">
                        <select data-placeholder="Select" id="status" name="status" required class="mb-2 select22 form-select">
                            <option value="0" <?php if(!empty($e_status)){if($e_status == 0){echo 'selected';}} ?>>Yes</option>
                            <option value="1" <?php if(!empty($e_status)){if($e_status == 1){echo 'selected';}} ?>>No</option>
                        </select>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12 text-center">
                <button class="btn btn-primary bb_form_btn" type="submit">
                    <i class="fal fa-save"></i> Save Record
                </button>
            </div>
        </div>
    <?php } ?>
<?php echo form_close(); ?>

<script src="<?php echo site_url(); ?>assets/js/jsform.js"></script>
<script>
    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                if(id != 'vid') {
                    $('#' + id).attr('src', e.target.result);
                } else {
                    $('#' + id).show(500);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#img-upload").change(function(){
        readURL(this, 'img0');
    });

    
</script>
<script>
    $(function() {
        $('.select22').select2();
    });
</script>