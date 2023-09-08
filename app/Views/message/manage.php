<?php
    use App\Models\Crud;
    $this->Crud = new Crud();
?>

<?php echo $this->extend('designs/backend'); ?>
<?php echo $this->section('title'); ?>
    <?php echo $title; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<div class="dashboard-content">
    <div class="dashboard-menu-btn color-bg"><span><i class="fas fa-bars"></i></span>Dasboard Menu</div>
    <div class="container dasboard-container  mb-5">
        <!-- dashboard-title -->	
        <div class="dashboard-title fl-wrap">
            <div class="dashboard-title-item"><span><?=$page; ?></span></div>
            <div class="dashbard-menu-header">
                <div class="dashbard-menu-avatar fl-wrap">
                    <img src="<?=site_url(); ?>assets/images/avatar.png" alt="">
                    <h4>Welcome, <span><?=$log_name;?></span></h4>
                </div>
                <a href="<?=site_url('auth/logout');?>" class="log-out-btn   tolt" data-microtip-position="bottom"  data-tooltip="Log Out"><i class="far fa-power-off"></i></a>
            </div>
        </div>
        <div class="dasboard-wrapper fl-wrap no-pag">
            <!-- dashboard-list-box-->
            <div class="dashboard-list-box fl-wrap">
                <div class="dasboard-widget-title fl-wrap">
                    <h5><i class="fas fa-comment-alt"></i> Messages</h5>
                    
                </div>
                <div class="chat-wrapper fl-wrap">
                   
                    <!--  chat-box-->
                    <div id="load_message">
                        <div class="text-center text-muted py-5" style="font-size:20px;">
                            <br/><br/>
                            <i class="fal fa-comment-alt-lines" style="font-size:150px;"></i><br/><br/>Select Chat to View Messages<br>
                        </div>
                    </div>
                    <!-- chat-box end-->
                    <!-- chat-contacts-->
                    <div class="chat-contacts" id="load_chats">
                        
                       
                    </div>
                    <!-- chat-contacts end-->
                </div>
                <!-- dashboard-list-box end-->			
            </div>
        </div>
    </div>
<input type="hidden" id="codes">
        
    <!-- <script src="<?php echo site_url(); ?>/assets/js/jquery.min.js"></script> -->
    <script>var site_url = '<?php echo site_url(); ?>';</script>
   
    <script>
        $(function() {
            load_chat();
        });

        

        function load_chat() {
           
            // $('#load_chats').html('<div class="col-sm-12 text-center"><br/><br/><br/><br/><i class="fal fa-spinner fa-spin" style="font-size:48px;"></i> Loading Chats</div>');
            var code = $('#codes').val();
           
            $.ajax({
                url: site_url + 'message/index/load_chat',
                type: 'post',
                success: function (data) {
                    var dt = JSON.parse(data);
                    $('#load_chats').html(dt.item);
                    
                    $('#listCount').html(dt.count);
                },
                complete: function () {
                    $.getScript(site_url + 'assets/js/jsmodal.js');
                    $('#chat_'+code).addClass('chat-contacts-item_active');
                }
            });
        }

        function get_chats(link){
            var id = link.id;
            // console.log(id);
            var delimiter = "_";
            var substrings = id.split(delimiter);
            var code = substrings[1];
            $(".chat-contacts-item_active").removeClass("chat-contacts-item_active");
            $('#chat_'+code).addClass('chat-contacts-item_active');
            $('#codes').val(code);
            load_message(code);
            // console.log(secondValue);
        }
        
         // Function to scroll to a specific element
         function scrollToLastElement(containerSelector) {
            var container = document.querySelector(containerSelector);
            if (container) {
                // Scroll to the last element
                container.scrollTop = container.scrollHeight;
            }
        }

        function load_message() {
           
        //    $('#load_message').html('<div class="col-sm-12 text-center"><br/><br/><br/><br/><i class="fal fa-spinner fa-spin" style="font-size:48px;"></i></div>');
           var code = $('#codes').val();
           
           $.ajax({
               url: site_url + 'message/index/load_message',
               type: 'post',
               data: {code:code},
               success: function (data) {
                   var dt = JSON.parse(data);
                   $('#load_message').html(dt.item);
                   scrollToLastElement('#chatBox');
               }
           });
       }

        function send_chat(){
            var code = $('#chat_code').val();
            var msg = $('#chat_msg').val();
            if(msg !== ''){
                $.ajax({
                    url: site_url + 'message/index/send_message',
                    type: 'post',
                    data: {code:code,msg:msg},
                    success: function (data) {
                    //    $('#msg_rep').html(data);
                        
                    },
                    complete: function () {
                        load_chat();load_message();$('#codes').val(code);
                    }
                });
            }
           
        }

       
    </script>   
<?php echo $this->endSection(); ?>