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
                    <div id="load_message">
                        <div class="text-center text-muted py-5" style="font-size:20px;">
                            <br/><br/>
                            <i class="fal fa-comment-alt-lines" style="font-size:150px;"></i><br/><br/>Select Chat to View Messages<br>
                        </div>
                    </div>

                    <div class="chat-widget_input" id="textareas" style="display:none;">
                        <div id="typingIndicator"></div>
						<textarea id="chat_msg" placeholder="Type Message" ></textarea>
						<button type="button" id="send_btn" onclick="send_chat()" class="color-bg"><i class="fal fa-paper-plane"></i></button>
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
<style>
            /* Style the scrollbar */
            #chatBoxs::-webkit-scrollbar {
                width: 6px; /* Adjust the width as desired */
            }

            /* Style the scrollbar track (the background) */
            #chatBoxs::-webkit-scrollbar-track {
                background: #f1f1f1; /* Change the background color as needed */
            }

            /* Style the scrollbar thumb (the draggable part) */
            #chatBoxs::-webkit-scrollbar-thumb {
                background: #888; /* Change the color of the scrollbar thumb */
            }

            /* Style the scrollbar thumb on hover */
            #chatBoxs::-webkit-scrollbar-thumb:hover {
                background: #555; /* Change the hover color */
            }
        </style>
    <!-- <script src="<?php echo site_url(); ?>/assets/js/jquery.min.js"></script> -->
    <script>var site_url = '<?php echo site_url(); ?>';</script>
   
    <script>
        $(function() {
            load_chat();
        });

        var chatId = $('#codes').val();
        function last_msg(elementId){
            var element = $('#chats_'+elementId);
            console.log(element);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        

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

                    setInterval(function() {
                        load_message();
                    }, 5000);
                }
            });
        }
         // Set a timeout for 10 minutes
         setTimeout(function() {
            load_message(); // Stop the interval after 10 minutes
            }, 10 * 60 * 1000); // 10 minutes in milliseconds


        function get_chats(link){
            var id = link.id;
            // console.log(id);
            var delimiter = "_";
            var substrings = id.split(delimiter);
            var code = substrings[1];
            $(".chat-contacts-item_active").removeClass("chat-contacts-item_active");
            $('#chat_'+code).addClass('chat-contacts-item_active');
            $('#codes').val(code);
            update_message();
            load_message(code);
            // console.log(secondValue);
        }
        
        

        function update_message() {
           
            //    $('#load_message').html('<div class="col-sm-12 text-center"><br/><br/><br/><br/><i class="fal fa-spinner fa-spin" style="font-size:48px;"></i></div>');
            var code = $('#codes').val();
            
            $.ajax({
                url: site_url + 'message/index/update_message',
                type: 'post',
                data: {code:code},
                success: function (data) {load_chat();
                }
            });
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
                    $('#textareas').show(500);
                }
            });
        }

        $('#chat_msg').keypress(function(event){
            // Check if Enter key is pressed (keyCode 13)
            if(event.which === 13){
                // Prevent default behavior of Enter key (form submission)
                event.preventDefault();
                // Call function to send chat message
                send_chat();
            }
        });

        function send_chat(){
            var code = $('#chat_code').val();
            var msg = $('#chat_msg').val();
            $('#send_btn').prop('disabled',true);
            if(msg !== ''){
                $.ajax({
                    url: site_url + 'message/index/send_message',
                    type: 'post',
                    data: {code:code,msg:msg},
                    success: function (data) {
                        $('#chat_msg').val('');
                        //    $('#msg_rep').html(data);
                        $('#send_btn').prop('disabled',false);
                        
                    },
                    complete: function () {
                        load_chat();load_message();$('#codes').val(code);$('#chat_msg').val('');
                    }
                });
            }
           
        }

        $(document).ready(function(){
             // Function to send typing status
            function sendTypingStatus(isTyping, chatId) {
                $.ajax({
                    url: '<?= site_url('message/updateTypingStatus') ?>',
                    type: 'POST',
                    data: {is_typing: isTyping, chat_id: chatId},
                    success: function() {}
                });
            }
            
            
            // Check for typing status periodically
            function checkTypingStatus() {
                var chatId = $('#codes').val();
                $.ajax({
                    url: '<?= site_url('message/checkTypingStatus') ?>',
                    type: 'POST',
                    data: {chat_id: chatId},
                    success: function(data) {
                        $('#typingIndicator').text(data.is_typing ? 'Typing...' : '');
                    }
                });
            }

           // Set a timeout for 10 minutes
            setTimeout(function() {
                clearInterval(typingStatusInterval); // Stop the interval after 10 minutes
            }, 10 * 60 * 1000); // 10 minutes in milliseconds

            // Start the interval for checking typing status
            var typingStatusInterval = setInterval(checkTypingStatus,6000); // Check every 3 seconds initially

            // Send typing status when user starts typing
            $('#chat_msg').on('input', function() {
                var chatId = $('#codes').val();
                sendTypingStatus(true, chatId);
            });

            // Send typing status when user stops typing
            $('#chat_msg').on('blur', function() {
                var chatId = $('#codes').val();
                sendTypingStatus(false, chatId);
            });

        });

        
    </script>   
<?php echo $this->endSection(); ?>