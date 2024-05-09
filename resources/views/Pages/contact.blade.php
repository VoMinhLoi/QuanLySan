<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('Library.grid_system')
        @include('Library.responsive')
        @include('Library.variable')
        <style>
            .chat-bot {
                background: rgb(86, 185, 255);
                color: white;
            }
            .chat-bot-heading {
                background: var(--primary-color);
                display: flex;
                align-items: center;
                height: 70px;
                border-bottom: 1px solid black; 
            }
            .chat-bot-body {
                height: 400px;
                padding: 0 12px;
                position: relative;
                overflow-y: scroll;
            }
            .hidden-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .chat-bot-body__bot {
                margin-top: 12px;
                position: relative;
                display: flex;
                background: white;
                max-width: 60%;
                width: fit-content;
                color: var(--primary-color);
                align-items: center;
                padding: 4px 12px;
                border-radius: 8px;
            }

            .chat-bot-body__user {
                margin-top: 12px;
                position: relative;
                background: var(--primary-color);
                max-width: 40%;
                width: fit-content;
                left: 100%;
                transform: translateX(-100%);
                padding: 8px 12px;
                border-radius: 8px;
            }

            .chat-bot-footer {
                background: var(--primary-color);
                height: 50px;
                padding: 8px 12px;
                display: flex;
                align-items: center;
                border-top: 1px solid black; 
            }
            .chat-bot-footer__input {
                height: 100%;
                flex: 1;
                padding: 0 8px;
                color: black;
            }
            .chat-bot-footer__send {
                margin-left: 8px;
                height: 40px;
                width: 40px;
                font-size: 20px;
                background: rgb(86, 185, 255);
                border-radius:4px; 
            }
            .chat-bot-footer__send:hover {
                opacity: 0.7;
            }
        </style>
    </head>
    <body>
        <div class="grid">
            @include('Components.header')
            <div class="container">
                <div class="grid wide">
                    @include('Components.breadcrumb')
                    <script>
                        breadCrumbHeading.innerText = 'Liên hệ'
                    </script>
                    <div class="row no-gutters">
                        <div class="col l-12 m-12 c-12">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.8938657781437!2d108.17775297460003!3d16.070996439391656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218fcdd80b585%3A0xfed1485cf372e066!2sDUPES!5e0!3m2!1sen!2s!4v1712807756688!5m2!1sen!2s" style="margin-top: 40px;" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                        </div>
                    </div>
                    <div class="row  no-gutters">
                        <div class="col l-12 m-12 c-12">
                            <div class="chat-bot">
                                <div class="chat-bot-heading">
                                    <img style="margin-left: 8px" class="header-logo__image" src="assets/img/Logo-Truong-Dai-hoc-The-duc-The-thao-Da-Nang.png" alt="logo trường đại học thể dục thể thao">
                                    <p style="margin-left: 8px">Tư vấn tự động</p>
                                </div>
                                <div class="chat-bot-body hidden-scrollbar">
                                </div>
                                <div class="chat-bot-footer">
                                    <input type="text" class="chat-bot-footer__input" required>
                                    <button  class="chat-bot-footer__send"><i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('Components.footer')
        </div>
    </body>
    <script>
        var buttonSendView = document.querySelector('.chat-bot-footer__send')
        var inputView = document.querySelector('.chat-bot-footer__input')
        var bodyConversationView  = document.querySelector('.chat-bot-body')
        buttonSendView.onclick = () => { 
            if(inputView.value){
                let dataUserMessage = inputView.value
                let messageUserView = document.createElement('div')
                messageUserView.innerHTML =     `
                                                <div class="chat-bot-body__user">
                                                    <p>${dataUserMessage}</p>
                                                </div>
                                                `
                bodyConversationView.append(messageUserView)
                hanldeCallApiGPT(dataUserMessage)
                inputView.value = ""
            }
        }
        bodyConversationView.addEventListener('scroll', function() {
            if (this.scrollHeight > this.clientHeight) {
                this.classList.remove('hidden-scrollbar');
            } else {
                this.classList.add('hidden-scrollbar');
            }
        });
        // Mutation event support will be disabled by default starting in Chrome 127, around July 30, 2024. Code should be migrated before that date to avoid site breakage.
        bodyConversationView.addEventListener('DOMNodeInserted', autoScrollToBottom);
        function autoScrollToBottom() {
            bodyConversationView.scrollTop = bodyConversationView.scrollHeight - bodyConversationView.clientHeight;
        }


        function hanldeCallApiGPT(dataUserMessage){
            $.ajax({            
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                type: 'post',
                url: '{{ url('lienhe') }}',
                data: {
                    'input': dataUserMessage
                },
                success: function (data){
                    let div = document.createElement('div')
                    div.setAttribute('class','chat-bot-body__bot')
                    div.innerHTML = `<img class="header-logo__image" src="assets/img/Logo-Truong-Dai-hoc-The-duc-The-thao-Da-Nang.png" alt="logo trường đại học thể dục thể thao">
                                    <p style="margin-left: 8px">${data}</p>`;
                    bodyConversationView.append(div)
                }

            })
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</html>