<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>

<?php echo $this->extend('designs/frontend'); ?>
<?php echo $this->section('title'); ?>
    <?php echo $title; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
    
                    

<script src="<?=site_url();?>assets/js/jsmodal.js"></script>
    <script src="<?=site_url(); ?>assets/js/select2.min.js" ></script>
<?php echo $this->endSection(); ?>