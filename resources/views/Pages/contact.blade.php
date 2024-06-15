<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                margin-bottom: 12px;
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
                text-align: justify;
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
            .chat-bot-footer__send, .chat-bot-footer__send--stop {
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
            .thinking {
                margin-left: 8px;
                font-style: italic;
                color: grey;
            }
            .dot-loading {
                display: inline-block;
                position: relative;
            }
            .dot-loading span {
                display: inline-block;
                position: relative;
                animation: dotBounce 1s infinite;
                font-weight: bold;
                font-size: 20px;
            }
            .dot-loading span:nth-child(1) {
                animation-delay: 0s;
            }
            .dot-loading span:nth-child(2) {
                animation-delay: 0.2s;
            }
            .dot-loading span:nth-child(3) {
                animation-delay: 0.4s;
            }
            @keyframes dotBounce {
                0%, 100% {
                    transform: translateY(0);
                }
                50% {
                    transform: translateY(-10px);
                }
            }
        </style>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
            integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
          />
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
                                    <p style="margin-left: 8px">Chatbot</p>
                                </div>
                                <div class="chat-bot-body hidden-scrollbar">
                                    
                                </div>
                                <div class="chat-bot-footer">
                                    <input type="text" class="chat-bot-footer__input" required placeholder="Những điều cần biết về thể thao hay vấn đề, tình trạng chuấn thương của bạn?">
                                    <button  class="chat-bot-footer__send"><i class="fa-solid fa-paper-plane"></i></button>
                                    <button  class="chat-bot-footer__send--stop display-none"><i class="fa-solid fa-pause fa-fw"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row  no-gutters" style="display: flex; justify-content: center; align-items: center">
                        Hỗ trợ kỹ thuật: minhloi1131130@gmail.com - <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" viewBox="0 0 30 20" version="1.1">
                            <rect width="30" height="20" fill="#da251d"></rect>
                            <polygon points="15,4 11.47,14.85 20.71,8.15 9.29,8.15 18.53,14.85" fill="#ff0"></polygon>
                          </svg> +84 (0)89 378 634
                    </div>
                </div>
            </div>
            @include('Components.footer')
        </div>
    </body>
    <script>
        const buttonSendView = document.querySelector('.chat-bot-footer__send')
        const buttonSendViewStop = document.querySelector('.chat-bot-footer__send--stop')
        const inputView = document.querySelector('.chat-bot-footer__input')
        const bodyConversationView  = document.querySelector('.chat-bot-body')
        var i  = window.console = 1;
        var isStopped = false;
        buttonSendView.onclick = () => {
            buttonSendView.classList.add('display-none')
            buttonSendViewStop.classList.remove('display-none')
            if(inputView.value){
                let dataUserMessage = inputView.value
                inputView.value = ""
                let messageUserView = document.createElement('div')
                messageUserView.setAttribute('class','chat-bot-body__user')
                messageUserView.innerHTML =     `
                                                    <p>${dataUserMessage}</p>
                                                `
                bodyConversationView.append(messageUserView)
                let loadView = document.createElement('div')
                loadView.setAttribute('class','thinking')
                loadView.innerHTML = 'Đang xử lý <span class="dot-loading"><span>.</span><span>.</span><span>.</span></span>';
                bodyConversationView.append(loadView)
                let div = document.createElement('div')
                div.setAttribute('class','chat-bot-body__bot')
                div.innerHTML = `<img class="header-logo__image" src="assets/img/Logo-Truong-Dai-hoc-The-duc-The-thao-Da-Nang.png" alt="logo trường đại học thể dục thể thao">
                                <p class="response-from-serve-${i}" style="margin-left: 8px; text-align: justify;"></p>`;
                bodyConversationView.append(div)
                let messageChatBox = div.querySelector(".response-from-serve-" + i);
                fetch("http://127.0.0.1:8000/lienhe", {
                    method: "post",
                    headers: {
                        "Content-type": "application/json",
                        "X-csrf-token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ text: dataUserMessage }),
                    })
                    .then((response) => response.json())
                    .then(async (data) => {
                        if(data.error){
                            toastr.warning(data.error)
                            bodyConversationView.removeChild(loadView)
                            bodyConversationView.removeChild(div)
                            buttonSendView.classList.remove("display-none");
                            buttonSendViewStop.classList.add("display-none");
                        }
                        else{
                            bodyConversationView.removeChild(loadView)
                            arrayData = data.text.split(" ").filter((word) => word !== "");
                            for (let j = 0; j < arrayData.length; j++) {
                            if (isStopped) break;
                            messageChatBox.innerText += " " + arrayData[j];
                            await new Promise((resolve) => setTimeout(resolve, 100)); // Chờ 1000ms trước khi thêm từ tiếp theo
                            }

                            i++;
                            buttonSendView.classList.remove("display-none");
                            buttonSendViewStop.classList.add("display-none");
                        }

                    })
                    .catch(error =>{ 
                        bodyConversationView.removeChild(loadView)
                        bodyConversationView.removeChild(div)
                        buttonSendView.classList.remove("display-none");
                        buttonSendViewStop.classList.add("display-none");
                        toastr.error("Lỗi xử lý dữ liệu ChatBot")
                    });
            }else{
                buttonSendView.classList.remove("display-none");
                buttonSendViewStop.classList.add("display-none");
                toastr.info("Xin chào, hãy cho tôi biết vấn đề của bạn là gì?");
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
            bodyConversationView.scrollTop = bodyConversationView.scrollHeight - bodyConversationView.clientHeight + 92;
        }
        buttonSendViewStop.onclick = ()=> {
            buttonSendView.classList.remove('display-none')
            buttonSendViewStop.classList.add('display-none')
            isStopped = true
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
      integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script>
      toastr.options = {
        toastClass: "toast-style", // Đặt lớp CSS cho thông báo
        titleClass: "toast-title-style", // Đặt lớp CSS cho tiêu đề thông báo
        messageClass: "toast-message-style", // Đặt lớp CSS cho nội dung thông báo
        closeButton: true, // Hiển thị nút đóng
        timeOut: 0, // Không tự động tắt
      };
    </script>
        {{-- <script>
        

        // function hanldeCallApiGPT(dataUserMessage){
        //     $.ajax({            
        //         headers: {
        //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //         },
        //         type: 'post',
        //         url: '{{ url('lienhe') }}',
        //         data: {
        //             'input': dataUserMessage
        //         },
        //         success: function (data){
        //             let div = document.createElement('div')
        //             div.setAttribute('class','chat-bot-body__bot')
        //             div.innerHTML = `<img class="header-logo__image" src="assets/img/Logo-Truong-Dai-hoc-The-duc-The-thao-Da-Nang.png" alt="logo trường đại học thể dục thể thao">
        //                             <p style="margin-left: 8px">${data}</p>`;
        //             bodyConversationView.append(div)
        //             buttonSendView.style.opacity = 1
        //             buttonSendView.style.cursor = "pointer"
        //             buttonSendView.disabled = false;
        //             inputView.disabled = false;
        //         }

        //     })
        // }
        // var dataChiTietThueSanString = ""
        // var ngayHienTai = new Date()

        // fetch("http://127.0.0.1:8000/api/chitietthuesan")
        //     .then(response => response.json())
        //     .then(CTTSs => {
        //         dataChiTietThueSanString += CTTSs.reduce((initial, value, index)=>{
        //             let formatThoiGianBatDau = new Date(value.thoiGianBatDau)
        //             let formatThoiGianKetThuc = new Date(value.thoiGianKetThuc)
        //             // console.table(formatThoiGianBatDau.getTime(), formatThoiGianKetThuc.getTime(), ngayHienTai.getTime())
        //             if(ngayHienTai.getTime()< formatThoiGianBatDau.getTime() || ngayHienTai.getTime() < formatThoiGianKetThuc)
        //                 return initial + (index+1) + ". " + value.thoiGianBatDau + value.thoiGianKetThuc
        //             return initial
        //         },"")
        //         console.log(dataChiTietThueSanString)
        //     })
        // var dataToolsGlobalString = ""
        // fetch("http://127.0.0.1:8000/api/dungcu")
        //     .then(response => response.json())
        //     .then(tools => {
        //         dataToolsGlobalString += tools.reduce((initial, value, index)=>{
        //             // console.log(value.tenDungCu,value.trangThai)
        //             if(value.trangThai){
        //                 // let trangThaiString = " và sẩn phẩm này còn kinh doanh."
        //                 // return initial + " " +value.tenDungCu + " có số lượng có thể thuê: " + (value.soLuongCon - value.soLuongChoThue) + " cái" + trangThaiString
        //                 return initial +value.tenDungCu + ", "
        //             }
        //             return initial
        //         },"")
        //         console.log(dataToolsGlobalString)
        //     })
        // var i  = 1
        // var listHistory = []
        // listHistory.push({"role": "system","content": "Bạn là một trợ lý ảo. Hãy tư vấn khách dựa trên thông tin lịch sân: "+dataChiTietThueSanString})
            
        // async function hanldeCallApiGPT(text) {

        //     // let apiServerBorrow = 'http://103.20.97.118:5002/chat_stream/'
        //     // let apiServerMinhHoang = "https://provider-obituaries-resolutions-entrepreneurs.trycloudflare.com/chat_stream/"
        //     let apiServerMinhHoang = "https://sandra-cubic-hungry-flights.trycloudflare.com/chat"
        //     listHistory.push({"role": "user","content": text})
        //     if(listHistory.length == 5){
        //         listHistory.pop(listHistory[1])
        //         listHistory.pop(listHistory[2])
        //     }
        //     const response = await fetch(apiServerMinhHoang, {
        //         method: 'POST',
        //         headers: {
        //         'Content-Type': 'application/json'
        //         },
        //         body: JSON.stringify(listHistory)
        //     });

        //     if (!response.ok) {
        //         throw new Error(`Request failed with status ${response.status}`);
        //     }

        //     // Xử lý stream dữ liệu
        //     const reader = response.body.getReader();
        //     const decoder = new TextDecoder();
        //     let full_text = ""
        //     let div = document.createElement('div')
        //     div.setAttribute('class','chat-bot-body__bot')
        //     div.innerHTML = `<img class="header-logo__image" src="assets/img/Logo-Truong-Dai-hoc-The-duc-The-thao-Da-Nang.png" alt="logo trường đại học thể dục thể thao">
        //                     <p class="response-from-serve-${i}" style="margin-left: 8px">${full_text}</p>`;
        //     bodyConversationView.push(div)
        //     while (true) {
        //         const { done, value } = await reader.read();

        //         if (done) {
        //         break;
        //         }
        //         const decodedValue = decoder.decode(value);
        //         // full_text += decodedValue
        //         let messageChatBox = document.querySelector('.response-from-serve-'+i)
        //         messageChatBox.innerText += " "+ decodedValue.replace("</s>", "");
        //     }
        //     listHistory.push({"role": "system","content": messageChatBox.innerText})
        //     i++
        //     buttonSendView.style.opacity = 1
        //     buttonSendView.style.cursor = "pointer"
        //     buttonSendView.disabled = false;
        //     inputView.disabled = false;
        // }
    </script> --}}
</html>