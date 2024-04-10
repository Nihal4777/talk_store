<x-admin-layout>
    <h3 style="padding: 30px 0 0 100px;">Real Time Chat</h3>
        <div class="row justify-content-center h-full">
            <div class="col-md-8 col-xl-6 col-12 chat">
                <div class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                    class="rounded-circle user_img">
                            </div>
                            <div class="user_info">
                                <span>Waiting For User</span>
                            </div>
                        </div>

                    </div>
                    <div class="card-body msg_card_body" id="mainContainer">

                    </div>
                    <div class="card-footer">
                        <div class="input-group d-flex justify-content-center">
                            <textarea name="message" id="textArea" class="form-control type_msg" placeholder="Type your message..."></textarea>
                            <div class="input-group-append">
                                <span class="input-group-text send_btn" id="send_btn" onclick="sendChat(event)"><i
                                        class="bi bi-send"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('1c736033547afaeacd02', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('presence-waiting-chat-{{ $user->id }}');
        channel.bind('connected', function(data) {
            window.location.href='';
        });
    </script>
</x-admin-layout>
