<?php
    use App\Models\Crud;
    $this->Crud = new Crud();

    $log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
    $log_role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
	$log_role = strtolower($this->Crud->read_field('id', $log_role_id, 'access_role', 'name'));
    $log_user_img = 'assets/images/avatar.png';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $this->renderSection('title'); ?></title>

    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/plugins.css">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/style.css?v=<?=time(); ?>">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/bootstrap.css?v=<?=time(); ?>">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/dashboard-style.css?v=<?=time(); ?>">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/color.css">
    <link rel="stylesheet" href="<?=site_url();?>assets/css/select2.min.css" />
    <link rel="shortcut icon" href="<?=site_url();?>assets/images/favicon.ico">

    <?=$link_preview; ?>


   


    <script src="<?=site_url(); ?>assets/js/jquery.min.js"></script>
    <!-- Include Bootstrap JS and Popper.js -->
    <script src="<?=site_url(); ?>assets/js/popper.min.js" ></script>
    <script src="<?=site_url(); ?>assets/js/bootstrap.min.js"></script>
    
    <!-- Include Bootstrap Select JS -->
    <script src="<?=site_url(); ?>assets/js/select2.min.js" ></script>


</head>

<body></body>