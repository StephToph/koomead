<?php
    use App\Models\Crud;
    $this->Crud = new Crud();

    $log_name = $this->Crud->read_field('id', $log_id, 'user', 'fullname');
    $log_role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
	$log_role = strtolower($this->Crud->read_field('id', $log_role_id, 'access_role', 'name'));
    $log_user_img_id = $this->Crud->read_field('id', $log_id, 'user', 'img_id');
    $log_user_img = $this->Crud->image($log_user_img_id, 'big');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $this->renderSection('title'); ?></title>
   
    <meta name="robots" content="index, follow"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <!-- css   -->	
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/plugins.css">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/style.css?v=<?=time(); ?>">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/bootstrap.css?v=<?=time(); ?>">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/dashboard-style.css?v=<?=time(); ?>">
    <link type="text/css" rel="stylesheet" href="<?=site_url();?>assets/css/color.css">
    <link rel="stylesheet" href="<?=site_url();?>assets/css/select2.min.css" />
    <link rel="shortcut icon" href="<?=site_url();?>assets/images/favicon.ico">


    <script src="<?=site_url(); ?>assets/js/jquery.min.js"></script>
    <!-- Include Bootstrap JS and Popper.js -->
    <script src="<?=site_url(); ?>assets/js/popper.min.js" ></script>
    <script src="<?=site_url(); ?>assets/js/bootstrap.min.js"></script>
    
    <!-- Include Bootstrap Select JS -->
    <script src="<?=site_url(); ?>assets/js/select2.min.js" ></script>
</head>
<body>
    <!--loader-->
    <div class="loader-wrap">
        <div class="loader-inner">
            <svg>
                <defs>
                    <filter id="goo">
                        <fegaussianblur in="SourceGraphic" stdDeviation="2" result="blur" />
                        <fecolormatrix in="blur"   values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 5 -2" result="gooey" />
                        <fecomposite in="SourceGraphic" in2="gooey" operator="atop"/>
                    </filter>
                </defs>
            </svg>
        </div>
    </div>
    <!--loader end-->
    <!-- main -->
    <div id="main">
         <!-- header -->
        <header class="main-header">
                <!--  logo  -->
                <div class="logo-holder"><a href="<?=site_url(); ?>"><img src="<?=site_url(); ?>assets/images/logo.png" alt=""></a></div>
                
                <div class="add-list_wrap">
                    <a href="<?=site_url('listing/index/add'); ?>" class="add-list color-bg"><i class="fal fa-plus"></i> <span>Add Listing</span></a>
                </div>
                <!--  add new  btn end -->
                <!--  header-opt_btn -->
                <div class="header-opt_btn tolt" data-microtip-position="bottom"  data-tooltip="Country">
                    <span><i class="fal fa-globe"></i></span>
                </div>
                <!--  header-opt_btn end -->
                <!--  cart-btn   -->
                <?php if(!empty($log_id)){?>
                    <div class="cart-btn  tolt show-header-modal" data-microtip-position="bottom"  data-tooltip="Your Notification">
                        <i class="fal fa-bell"></i>
                        <span class="cart-btn_counter color-bg" id="notify_no">0</span>
                    </div>
                <?php } ?>
                <!--  cart-btn end -->
                <!--  login btn -->
                <div class="show-reg-form dasbdord-submenu-open"><img src="<?=site_url(); ?>assets/images/avatar.png" alt=""></div>
                <!--  login btn  end -->
                <!--  dashboard-submenu-->
                <div class="dashboard-submenu">
                    <div class="dashboard-submenu-title fl-wrap">Welcome , <span><?=$log_name; ?></span></div>
                    <ul>
                        <li><a href="<?=site_url('dashboard'); ?>"><i class="fal fa-chart-line"></i>Dashboard</a></li>
                        <li><a href="<?=site_url('listing/index/add'); ?>"> <i class="fal fa-file-plus"></i>Add Listing</a></li>
                        <li><a href="<?=site_url('profile'); ?>"><i class="fal fa-user-edit"></i>Settings</a></li>
                    </ul>
                    <a href="<?=site_url('auth/logout'); ?>" class="color-bg db_log-out"><i class="far fa-power-off"></i> Log Out</a>
                </div>
                <!--  dashboard-submenu  end -->
                
               
                			
                <!-- wishlist-wrap--> 
                <div class="header-modal novis_wishlist tabs-act">
                    <div class="tabs-container">
                        <div class="tab">
                            <!--tab -->
                            <div id="tab-wish" class="tab-content first-tab">
                                <!-- header-modal-container--> 
                                <div class="header-modal-container scrollbar-inner fl-wrap" data-simplebar>
                                    <!--widget-posts-->
                                    <div class="widget-posts  fl-wrap">
                                        <ul class="no-list-style" id="notify_show">
                                            
                                        </ul>
                                    </div>
                                    <!-- widget-posts end-->
                                </div>
                                <!-- header-modal-container end--> 
                                <div class="header-modal-top fl-wrap">
                                    <div class="clear_wishlist color-bg" onclick="mark_all();"><i class="fal fa-trash-alt"></i> Clear all</div><br>
                                    <div class="clear_wishlist color-bg"><a class="text-white" href="<?=site_url('notification'); ?>"><i class="fal fa-eye"></i>See All</a></div>
                                </div>
                            </div>
                            <!--tab end -->
                            
                        </div>
                        <!--tabs end -->							
                    </div>
                </div>
                <!--wishlist-wrap end -->                            
                <!--header-opt-modal-->  
                <div class="header-opt-modal novis_header-mod">
                    <div class="header-opt-modal-container hopmc_init">
                        <div class="header-opt-modal-item lang-item fl-wrap">
                            <h4>Country: <span>NGN</span></h4>
                            <div class="header-opt-modal-list fl-wrap">
                                <ul>
                                    <li><a href="#" class="current-lan" data-lantext="NGN">Nigeria</a></li>
                                    <li><a href="#" data-lantext="UK">United Kingdom</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--header-opt-modal end -->  
        </header>
            <!-- header end  -->	
        
        <div id="wrapper">
            <!-- dashbard-menu-wrap -->	
            <div class="dashbard-menu-overlay"></div>
            <div class="dashbard-menu-wrap">
                <div class="dashbard-menu-close"><i class="fal fa-times"></i></div>
                <div class="dashbard-menu-container">
                    <!-- user-profile-menu-->
                    <div class="user-profile-menu">
                        <h3>Main</h3>
                        <ul class="no-list-style">
                            <!-- Dynamic Menu Items --> 
                            <?php
                                $menu = '';
                                $modules = $this->Crud->read_single_order('parent', 0, 'access_module', 'priority', 'asc');
                                if(!empty($modules)) {
                                    foreach($modules as $mod) {
                                        // get level 2
                                        $level2 = '';
                                        if($this->Crud->mod_read($log_role_id, $mod->link) == 1) {
                                            $mod_level2 = $this->Crud->read_single_order('parent', $mod->id, 'access_module', 'priority', 'asc');
                                            if(!empty($mod_level2)) {
                                                $open = false; $show = false;
                                                foreach($mod_level2 as $mod2) {
                                                    
                                                    if($this->Crud->mod_read($log_role_id, $mod2->link) == 1) {
                                                        // add parent to first
                                                        if(empty($level2)) {
                                                            // $level2 = '
                                                            //     <li>
                                                            //         <a href="'.site_url($mod->link).'">'.$mod->name.'</a>
                                                            //     </li>
                                                            // ';
                                                        }
                                                        if($page_active == $mod2->link){$tog = 'sl_tog';
                                                            $style = 'style="display:block"'; $a_active = 'user-profile-act';} else {$a_active = ''; $tog='';$style='';}
                                                        
                                                        // add the rest
                                                        $level2 .= '
                                                            <li>
                                                                <a href="'.site_url($mod2->link).'"  class="'.$a_active.' '.$tog.'"><i class="'.$mod2->icon.'"></i>'.$mod2->name.'</a>
                                                            </li>
                                                        '; 
                                                    }
                                                }
                                                
                                                $level2 = '
                                                    <ul class="no-list-style" '.$style.'>
                                                        '.$level2.'
                                                    </ul>
                                                ';
                                            }

                                            if($page_active == $mod->link){$a_active = 'user-profile-act';} else {$a_active = '';}
                                            if($level2){
                                                $submenu = 'submenu-link';
                                                $dlink = 'javascript:void(0);';
                                            } else {
                                                $submenu = ''; 
                                                $dlink = site_url($mod->link);
                                               
                                            }

                                            $menu .= '
                                                <li>
                                                    <a class="'.$submenu.'  '.$a_active.'"  href="'.$dlink.'">
                                                        <i class="'.$mod->icon.'"></i>'.$mod->name.'
                                                    </a>
                                                    '.$level2.'
                                                </li>
                                            ';
                                        }
                                    }
                                }

                                echo $menu;
                            ?>
                            
                             <!-- Modules and Roles -->
                            <?php if($log_role == 'developer') { 
                                $tog='';$style='';
                                if($page_active == 'module' || $page_active == 'role' || $page_active == 'access'){
                                    $tog = 'sl_tog';
                                    $style = 'style="display:block"';
                                }
                                ?>
                            <li>
                                <a class="submenu-link <?=$tog; ?>" href="javascript:void(0);"><i class="fal fa-plus"></i> Access Roles</a>
                                <ul  class="no-list-style" <?=$style; ?>>
                                    <li >
                                        <a href="<?php echo site_url('settings/modules'); ?>" class="<?php if($page_active=='module') {echo 'user-profile-act';} ?>"><i class="fas fa-tools"></i>Modules</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('settings/roles'); ?>" class="<?php if($page_active=='role') {echo 'user-profile-act';} ?>"><i class="fas fa-toolbox"></i>Roles</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('settings/access'); ?>" class="<?php if($page_active=='access') {echo 'user-profile-act';} ?>"><i class="fas fa-wrench"></i>Access CRUD</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="<?php if($page_active=='app') {echo 'user-profile-act';} ?>">
                                <a href="<?php echo site_url('settings/app'); ?>"><i class="fas fa-user-cog"></i> App Settings
                                </a>
                            </li>
                            <?php } ?>
                            
                            <li><a href="<?php echo site_url(); ?>"><i class="fal fa-home-lg-alt"></i> Web View</a></li>
                        </ul>
                    </div>
                    <!-- user-profile-menu end-->
                    
                </div>
                <div class="dashbard-menu-footer"> &#169;  <?=app_name; ?> <?=date('Y'); ?> .  All rights reserved.</div>
            </div>
            <!-- dashbard-menu-wrap end  -->
            <?php echo $this->renderSection('content'); ?>
                <!-- dashboard-footer -->
                <div class="dashboard-footer">
                    <div class="dashboard-footer-links fl-wrap">
                        <span>Helpfull Links:</span>
                        <ul>
                            <li><a href="javasctipt:;">About  </a></li>
                            <li><a href="javasctipt:;">Blog</a></li>
                            <li><a href="javasctipt:;">Pricing Plans</a></li>
                            <li><a href="javasctipt:;">Contacts</a></li>
                            <li><a href="javasctipt:;">Help Center</a></li>
                        </ul>
                    </div>
                    <a href="#main" class="dashbord-totop  custom-scroll-link"><i class="fas fa-caret-up"></i></a>
                </div>
                <!-- dashboard-footer end -->				
            </div>
            <!-- content end -->	
            <div class="dashbard-bg gray-bg"></div>
        </div>
        <!-- wrapper end -->
    </div>
    <!-- Main end -->

    <div class="modal modal-center fade modality" id="modal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">  </h5>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal">
                        <i class="fal fa-times-octagon"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>
    <!--=============== scripts  ===============-->
    <script src="<?=site_url(); ?>assets/js/charts.js"></script>
    <script src="<?=site_url(); ?>assets/js/plugins.js"></script>
    <script src="<?=site_url(); ?>assets/js/scripts.js"></script>
    <script src="<?=site_url(); ?>assets/js/dashboard.js"></script>
    <script src="<?=site_url();?>assets/js/jsform.js"></script>
    
<script>var site_url = '<?php echo site_url(); ?>';</script>
   
<script>
    $(function() {
        loada('', '');
    });

    

    function loada(x, y) {
        var more = 'no';
        var methods = '';
        

        if (more == 'no') {
            $('#notify_show').html('<div class="col-sm-12 text-center"><br/><i class="fal fa-spinner fa-spin" style="font-size:48px;"></i></div>');
        } else {
            $('#loadmore').html('<div class="col-sm-12 text-center"><i class="fal fa-spinner fa-spin"></i></div>');
        }

        var country_id = $('#country_id').val();
        var state_id = $('#state_id').val();
       

        $.ajax({
            url: site_url + 'notification/index/nav_load' + methods,
            type: 'post',
            success: function (data) {
                var dt = JSON.parse(data);
                if (more == 'no') {
                    $('#notify_show').html(dt.item);
                }

                $('#notify_no').html(dt.count);
            },
        });
    }

    
</script>

    <script>
        function mark_read(id){
            $.ajax({
                url: site_url + 'notification/mark_read/' + id,
                type: 'post',
                success: function (data) {
                    // window.location.replace("<?=site_url('notification/list'); ?>");
                    load();
                }
            });
        }

        function mark_all(){
            $.ajax({
                url: site_url + 'notification/mark_all',
                type: 'post',
                success: function (data) {
                    load();
                }
            });
        }

        function plays(){
            var src = '<?=site_url(); ?>' +'assets/audio/3.wav';
            var audio = new Audio(src);
            audio.play();
        }

        <?php 
        $notify = $this->Crud->read2('to_id', $log_id, 'new', 1, 'notify');
        if(!empty($notify)){?>
            $(function() {
                plays();
            });
        <?php }?>
    </script>

    <script src="<?=site_url();?>assets/js/jsmodal.js"></script>
    <?php if(!empty($table_rec)){ ?>
         
        <link rel="stylesheet" href="<?=site_url(); ?>assets/css/dataTables.bootstrap4.min.css">
        <script src="<?php echo site_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo site_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                //datatables
                var table = $('#datatable').DataTable({ 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [<?php if(!empty($order_sort)){echo '['.$order_sort.']';} ?>], //Initial order.
                    "language": {
                        "processing": "<i class='fa fa-spinner fa-spin' aria-hidden='true'></i> Processing... please wait"
                    },
                    // "pagingType": "full",
            
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        url: "<?php echo site_url($table_rec); ?>",
                        type: "POST",
                        complete: function() {
                            $.getScript('<?php echo site_url(); ?>assets/js/jsmodal.js');
                        }
                    },
            
                    //Set column definition initialisation properties.
                    "columnDefs": [
                        { 
                            "targets": [<?php if(!empty($no_sort)){echo $no_sort;} ?>], //columns not sortable
                            "orderable": false, //set not orderable
                        },
                    ],
            
                });
            
            });
        </script>
    
    <?php } ?>
</body>

</html>