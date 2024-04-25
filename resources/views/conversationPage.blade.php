<x-primary-layout>
    <div class="container-fluid section-padding">
        <h3 style="padding: 30px 0 0 100px;">Conversation</h3>
        <div>
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
                                    <span> {{ $talk->title   }}</span>
                                    <!-- <p>1767 Messages</p> -->
                                </div>
                            </div>

                        </div>
                        <div class="card-body msg_card_body" id="mainContainer">
                            @foreach ($cm as $key => $message)
                                @if ($key % 2 == 0)
                                    <div class="d-flex justify-content-start mb-4" data-seq="{{ $key + 1 }}">
                                        <div class="msg_cotainer">
                                            {{ $message->line_message }}
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-end mb-4" data-seq="{{ $key + 1 }}">
                                        <div class="d-flex flex-column">
                                            <div class="msg_cotainer_send">
                                                {{ $message->line_message }}
                                            </div>
                                            {{-- <div class="accuracy align-self-end" style="color: #22dd00">Accuracy 20%</div>
                                <div class="accuracy align-self-end" style="color: #e33131">Accuracy 20%</div> --}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <div class="input-group d-flex justify-content-center" id="footerBox">
                                @if ($order->progress != 100)
                                    {
                                    <textarea name="message" id="textArea" class="form-control type_msg" placeholder="Type your message..."></textarea>
                                    <div class="input-group-append">
                                        <span class="input-group-text send_btn" id="send_btn"
                                            onclick="sendChat(event)"><i class="bi bi-send"></i></span>
                                    </div>
                                    }
                                @else
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('assets/images/success.gif') }}" alt=""
                                            style="height: 50px; width: 50px">
                                        <div class="text-white">
                                            Completed
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendChat(e) {
            textArea.disabled = true;
            send_btn.disabled = true;
            let newSeq = Number(mainContainer.children[mainContainer.children.length - 1].dataset.seq) + 1;
            fetch('/api/sendMessage', {
                    'headers': {
                        'accept': 'application/json',
                        'content-type': 'application/json',
                    },
                    'method': 'POST',
                    'body': JSON.stringify({
                        'message': textArea.value,
                        'talk_id': {{ $talk->id }},
                        'seq': newSeq
                    })
                })
                .then((e) => e.json()).then((res) => {
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
                    parent.dataset.seq = newSeq;
                    if (res.nextMessage) {
                        let parent1 = document.createElement('div');
                        parent1.classList.add('d-flex', 'justify-content-start', 'mb-4');
                        let child1 = document.createElement('div');
                        child1.classList.add('msg_cotainer');
                        child1.innerText = res.nextMessage;
                        parent1.appendChild(child1);
                        mainContainer.appendChild(parent1);
                        parent1.dataset.seq = res.nextSeq;
                    }
                    if (res.isEnd) {
                        window.location.reload();
                    }
                    mainContainer.scrollTo(0, mainContainer.scrollHeight);
                }).finally(() => {
                    textArea.value = "";
                    textArea.disabled = false;
                    send_btn.disabled = false;
                });
        }
    </script>

</x-primary-layout>
