<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>

<?php echo form_open_multipart($form_link, array('id'=>'bb_ajax_form2', 'class'=>'text-start customform')); ?>
    <!-- delete view -->
    <?php if($param2 == 'promote') { ?>
        <div class="row">
            <div class="col-sm-12 mt-4"><div id="bb_ajax_msg2"></div></div>
        </div>

        <div class="row">
            <?php 
                if(!in_array($log_id, $applicant)){
            ?>
            <div class="col-sm-12 text-center">
                <h3><b>Generate Promotion Link?</b></h3>
                <input type="hidden" name="promotion_id" value="<?php if(!empty($d_id)){echo $d_id;} ?>" />
            </div>
            
            <div class="col-sm-12 text-center">
                <button class="btn btn-primary text-uppercase" type="submit">
                    <i class="fal fa-paper-plane"></i> Yes - Generate
                </button>
            </div>
        </div>
        <?php } else { ?>

            <div class="col-sm-12 text-center">
                <h3 class="mb-3"><b>You have already applied to Promote this Business Listing.</b></h3>
                <h4>This is your unique link <br><span id="textToCopy" class="text-danger mt-3 mb-2"><?=site_url('home/promotion/'.$log_id.'/'.$codes); ?></span></h4>
            </div>
            <div class="col-sm-12 text-center">
                <button class="btn btn-primary text-uppercase" id="copyButton" type="button">
                    <i class="fal fa-paper-plane"></i> Copy Link
                </button>
            </div>
    <?php } }?>
    

    <?php echo form_close(); ?>
<script src="<?=site_url();?>assets/js/jsform.js"></script>

<script>
    $(function() {
        $('.selects2').select2();
    });
</script>
<script>
    var textToCopy = document.getElementById('textToCopy');
    var copyButton = document.getElementById('copyButton');

    copyButton.addEventListener('click', function () {
        var text = textToCopy.innerText; // Get the text to copy

        // Use the Clipboard API to copy the text
        navigator.clipboard.writeText(text)
            .then(() => {
                // Success callback: the text has been copied
                console.log('Text copied to clipboard: ' + text);

                // Provide a visual indication that the text has been copied (optional)
                copyButton.textContent = 'Link Copied!';
                setTimeout(() => {
                    copyButton.textContent = 'Copy Link';
                }, 4000); // Reset button text after 2 seconds
            })
            .catch(err => {
                // Error callback: handle errors here
                console.error('Could not copy text: ' + err);
            });
    });
</script>