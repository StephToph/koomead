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
                <input type="hidden" name="d_category_id" value="<?php if(!empty($d_id)){echo $d_id;} ?>" />
            </div>
            
            <div class="col-sm-12 text-center">
                <button class="btn btn-danger text-uppercase" type="submit">
                    <i class="fal fa-trash"></i> Yes - Delete
                </button>
            </div>
        </div>
    <?php } ?>
    <!-- insert/edit view -->
    <?php if($param2 == 'edit' || $param2 == '') { ?>
        <div class="row">
            <div class="col-sm-12"><div id="bb_ajax_msg"></div></div>
        </div>

        <div class="row">
            <input type="hidden" name="cate_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />

            <div class="col-sm-12 mb-3">
                <div class="form-group">
                    <label for="commission">Name <span class="dec-icon"><i class="far fa-location"></i></span></label>
                    <input class="form-control" type="text" id="name" name="name" value="<?php if(!empty($e_name)) { echo $e_name; } ?>" required readonly>
                </div>
            </div>

            

            <div class="col-sm-12 text-center mb-5">
                <div style="background-color:#f6f6f6; margin:2px; padding: 15px;">
                    <div class="text-muted text-center"><b>STATE IMAGE</b></div>
                    <label for="img-upload" class="pointer text-center" style="cursor:pointer;float: none !important;">
                        <input type="hidden" name="img" value="<?php if(!empty($e_logo)){echo $e_logo;} ?>" />
                        <img id="img0" src="<?php if(!empty($e_logo)){echo site_url($e_logo);} else {echo site_url('assets/images/file.png');} ?>" style="max-width:80%;" />
                        <span class="btn btn-danger d-block"><i class="fal fa-images"></i> Choose Cover</span>
                        <input class="d-none" type="file" name="pics" id="img-upload">
                    </label>
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
        $('.selects2').select2();
    });
</script>