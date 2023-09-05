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

    <!-- profile view -->
    <?php if($param2 == 'profile') { ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="text-muted small">DATA</div>
                <div class="row small">
                    <div class="col-sm-6">
                        <img alt="" src="<?php echo $v_img; ?>" width="100%" />
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted">NAME</div>
                        <div><?php echo strtoupper($v_name); ?></div><br/>

                        <div class="text-muted">PHONE</div>
                        <div><?php echo $v_phone; ?></div><br/>

                        <div class="text-muted">EMAIL</div>
                        <div><?php echo $v_email; ?></div><br/>

                        <div class="text-muted">ADDRESS</div>
                        <div><?php echo $v_address; ?></div><br/>

                        <div class="text-muted">STATE</div>
                        <div><?php echo $v_state; ?></div><br/>

                        <div class="text-muted">COUNTRY</div>
                        <div><?php echo $v_country; ?></div><br/>

                        <div class="text-muted">ISV</div>
                        <div><?php echo $v_isv; ?></div><br/>

                        <div class="text-muted">CLUSTER</div>
                        <div><?php echo $v_cluster; ?></div><br/>
                    </div>


                    <div class="col-sm-12">
                        
                    </div>

                    <div class="col-sm-6">
                        
                    </div>

                    <div class="col-sm-6">
                        
                    </div>
                </div>
                <br/>
            </div>
           
        </div>
    <?php } ?>

    <?php if($param2 == 'view') { ?>
        <div class="row" style="padding:10px;">
            <?php
                $items = '';
               
                $query = $this->Crud->read_single_order('parent_id', $param3, 'child', 'id', 'asc');
                if(!empty($query)) {
                    foreach($query as $q) {
                        $date = date('M d, Y h:i:sA', strtotime($q->reg_date));
                        $user = $q->name;
                        $age_id = $q->age_id;
                        $age = $this->Crud->read_field('id', $age_id, 'age', 'name');
                        
                        $items .= '
                            <tr>
                                <td>'.$date.'</td>
                                <td align="right">'.strtoupper($user).'</td>
                                <td align="right">'.strtoupper($age).'</td>
                            </tr>
                        ';
                    }
                } else {
                    $items .= '
                            <tr>
                                <td colspan="3" class="text-center">No Child</td>
                                
                            </tr>
                        ';
                }

                echo '
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td><b>DATE</b></td>
                                <td width="200px" align="right"><b>CHILD</b></td>
                                <td width="200px" align="right"><b>AGE</b></td>
                            </tr>
                        </thead>
                        <tbody>'.$items.'</tbody>
                    </table>
                ';
            ?>
        </div>
    <?php } ?>

    <!-- insert/edit view -->
    <?php if($param2 == 'edit' || $param2 == '') { ?>
        <div class="row">
            <div class="col-sm-12"><div id="bb_ajax_msg"></div></div>
        </div>

        <div class="row">
            <input type="hidden" name="user_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />

            
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="markerter_id"><?php if(!empty($e_email)) { echo 'Reset'; } ?> Password</label>
                    <input class="form-control" type="text" id="password" name="password">
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="markerter_id">Ban</label>
                    <div class="listsearch-input-item mb-2">
                        <select data-placeholder="Select" id="ban" name="ban" required class="mb-2 select22 form-select">
                            <option value="0" <?php if(!empty($e_activate)){if($e_activate == 0){echo 'selected';}} ?>>No</option>
                            <option value="1" <?php if(!empty($e_activate)){if($e_activate == 1){echo 'selected';}} ?>>Yes</option>
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

<script src="<?php echo base_url(); ?>/assets/js/jsform.js"></script>
<script>
    $(".select22").select2();
</script>