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
                                 <span class="online_icon" id="liveDot"></span>
                                 {{-- <span class="online_icon offline"></span> --}}
                        </div>
                        <div class="user_info">
                            <span>Live Chat Support</span>
                            
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

        var channel = pusher.subscribe('presence-chat-{{ $ue->user_id }}-{{ $user->id }}');
        channel.bind('my-event', function(data) {
            // alert(JSON.stringify(data));
            let parent1=document.createElement('div');
            parent1.classList.add('d-flex','justify-content-start','mb-4');
            let child1=document.createElement('div');
            child1.classList.add('msg_cotainer');
            child1.innerText=data.message;
            parent1.appendChild(child1);
            mainContainer.appendChild(parent1);
            mainContainer.scrollTo(0, mainContainer.scrollHeight);
        });
        channel.bind('disconnected', function(data) {
            liveDot.classList.add("offline");
            /*****************************/
            // Make red dot (offline) remove offline class name
            // liveDot.classList.remove("offline")
            /*******************************/
            alert("User Disconnected");
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        });
    </script>
    <script>
        function sendChat(e) {
            textArea.disabled = true;
            send_btn.disabled = true;
            let parent = document.createElement('div');
            parent.classList.add('d-flex', 'justify-content-end', 'mb-4');
            let child = document.createElement('div');
            child.classList.add('d-flex', 'flex-column');
            let grandChild = document.createElement('div');
            grandChild.classList.add('msg_cotainer_send');
            grandChild.innerText = textArea.value;
            child.appendChild(grandChild);
            parent.appendChild(child);
            mainContainer.appendChild(parent);
            mainContainer.scrollTo(0, mainContainer.scrollHeight);
            // parent.dataset.seq = newSeq;
            // let newSeq = Number(mainContainer.children[mainContainer.children.length - 1].dataset.seq) + 1;
            fetch('/api/sendChatMessage', {
                    'headers': {
                        'accept': 'application/json',
                        'content-type': 'application/json',
                    },
                    'method': 'POST',
                    'body': JSON.stringify({
                        'message': textArea.value,
                        // 'seq':newSeq
                    })
                })
                .then((e) => e.json()).then((res) => {
                    if (res.status) {
                        textArea.value='';
                        // parent1.dataset.seq=res.nextSeq;
                    } else {
                        alert("Some error occurred");
                    }
                }).finally(() => {
                    textArea.disabled = false;
                    send_btn.disabled = false;
                });
        }
    </script>
</x-admin-layout>
