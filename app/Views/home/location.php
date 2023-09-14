<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>
<?php echo form_open_multipart('home/location', array('id'=>'bb_ajax_form2', 'class'=>'text-start ')); ?>
    
        <div class="row">
            <div class="col-sm-12"><div id="bb_ajax_msg2"></div></div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-center mb-3">
                <h3><b> You are Currently in <?=$country; ?></b></h3>
                <h4>We Currently serve United Kingdom and Nigerian Users<br>Select a Country we serve.</h4>
            </div>
            
            <div class="col-sm-12 mb-3">
                <div class="form-group">
                    <select id="country_id" name="country_id" class="form-select selects2" required>
                        <option value="">None</option>
                        <?php 
                            $category = $this->Crud->read_order('country', 'name', 'asc');
                            if(!empty($category)) {
                                foreach($category as $c) {
                                    $c_sel = '';
                                    if($c->name != 'Nigeria' && $c->name != 'United Kingdom')continue;
                                    echo '<option value="'.$c->id.'" '.$c_sel.'>'.$c->name.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-12 text-center">
                <button class="btn btn-danger bb_for_btn" type="submit">
                    <i class="fal fa-save"></i> Save Record
                </button>
            </div>
        </div>
<?php echo form_close(); ?>

<script src="<?=site_url();?>assets/js/jsform.js"></script>

<script>
    $(function() {
        $('.selects2').select2();
    });
</script>