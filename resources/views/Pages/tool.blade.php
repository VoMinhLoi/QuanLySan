<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    @include('Library.grid_system')
    @include('Library.responsive')
    @include('Library.variable')
    {{-- CSS container --}}
    <style>
        .content {
            margin: 24px 0px 0px;
        }
        .choose + .choose {
            margin-top: 12px;
        }
    
        .choose__heading {
            font-weight: bold;
            padding: 0px 0px 12px;
            margin-bottom: 8px;
            position: relative;
        }
    
            
        .choose__heading::before {
            content: "";
            height: 2px;
            background-color: #ededed;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
        }
        .choose__heading::after {
            content: "";
            height: 4px;
            background-color: var(--primary-color);
            width: 114px;
            position: absolute;
            bottom: 0;
            left: 0;
        }
    
    
        .choose__filter {
            display: flex;
            flex-direction: column;
        }
    
        .choose__filter-range {
            margin: 0px 0px 10px; 
        }
        .choose__filter-index {
            color: #79808c;
        }
    
        .choose__filter-index-category {
            border:1px solid black;
            padding: 8px 12px;
        }
        .choose__filter-number {
            color: black;
        }
        .sorting {
            display: flex !important;
            min-height: 50px;
            line-height: 50px;
        }
    
        .sorting-view {
             display: flex;
             margin-right: 8px;
        }
        .sorting-view__item {
    
            width: 50px;
            height: 50px;
            border-radius: 50%;
            text-align: center;
            line-height: 50px;
        }
    
        .sorting-view__item:hover {
            background-color: var(--primary-color-hover);
            color: white;
            cursor: pointer;
        }
    
        .sorting-view__item--active {
            color: white;
            background: var(--primary-color) !important;
            cursor: text !important;
        }
    
        .sorting-view__item + .sorting-view__item {
            margin-left: 8px;
        }
    
        .filter-basic {
            justify-content: flex-end;
            align-items: center;
        }
        .filter-basic__fieldset-list {
            margin-left: 8px;
            border: 1px solid black;
            height: 50px;
            /* border-radius: 4px; */
        }
        .sorting-view__date {
            margin-left: 8px;
        }
        .sorting__input-time {
            margin: 0 8px;
            height: 28px;
            width: 36px;
            outline: none;
            text-align: center;
        }
    
        /* Football ground */
        .football-ground {
            box-shadow: 0px 0px 2px black;
        }
        .list-mode .football-ground {
            padding: 8px 0px;
        }
        .fg-image {
            box-shadow: 0px 1px 2px black; 
            position: relative;
            overflow: hidden;
        }
        .image-box {
            height: 216px;
            /* overflow: hidden; */
            position: relative;
        }
        .image-box__item {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
    
        .football-ground:hover .image-box__item--hover {
            opacity: 1;
        }
        .football-ground--0:hover .image-box__item--hover {
            opacity: 0;
        }
    
        .image-box__item--hover {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0;
            transition: all ease 0.7s;
        }
    
        .football-ground--0 .image-status {
            background-color: red ;
        }
    
        .image-status {
            background-color: var(--primary-color);
            color: white;
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 4px 8px;
        }
    
        .football-ground:hover .image-action {
            transform: translateY(0%);
        }
        .football-ground--0:hover .image-action {
            transform: translateY(100%);
        }
    
        .image-action {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-color);
            color: white;
            padding: 0 12px;
            transform: translateY(100%);
            transition: all linear 0.3s;
        }
    
        .image-action__item:hover {
            cursor: pointer;
            color: black;
        }
    
        .fg-infor {
            display: flex;
            justify-content: space-between;
            margin: 12px 20px;
        }
        .fg-infor__name {
            font-weight: bold;
            height: 48px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
        }
        
        .fg-infor__name:hover {
            color: var(--primary-color);
        }
        /* List mode */
        .list-mode .fg-infor {
            margin: 0;
        }
        .list-mode .fg-image {
            box-shadow: none;
        }
        .list-mode .fg-infor {
            justify-content: flex-start;
            flex-direction: column;
            padding-left: 20px;
        }
        .list-mode .fg-infor__name {
            font-size: 24px;
        }
        .fg-infor__price {
            color:red;
        }
        .list-mode .fg-infor__price {
            margin: 8px 0;
        }
        .fg-infor__location-price {
            display: flex;
            justify-content: space-between;
        }
        .list-mode .fg-infor__description {
            color: #79808c;
            margin-bottom: 8px;
            text-align: justify;

            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;
        }
        .fg-infor__action {
            height: 54px;
            display: flex;
            align-items: center;
            margin: 12px 0px 0;
        }
        .fg-infor__action-item {
            background: black;
            color: white;
            height: 100%;
            line-height: 54px;
            padding: 0 12px;
            border-radius: 4px;
        }
        .fg-infor__action-item + .fg-infor__action-item {
            margin-left: 12px;
        }
        .fg-infor__action-item:hover {
            background: var(--primary-color);
            cursor: pointer;
            align-items: flex-end;
        }
        .grid-mode, .list-mode{
            margin-top: 12px;
        }
        .sorting-search {
            width: 80%;
        }
        input.sorting-view__search {
            height: 100%;
            border: 1px solid black;
            margin-left: 12px;
            padding: 8px 12px;
            flex: 1;
            color: black;
        }
        .sorting-view__search::placeholder{
            color: rgb(217, 217, 217)
        }
        .button-search {
            background: var(--primary-color);
            color: white;
            padding: 0px 20px;
            cursor: pointer;
            border: 1px solid black;
        }
        .button-search:hover{
            background: white;
            color: var(--primary-color);
        }
        .toast-style {
            background-color: #333; /* Đặt màu nền */
            color: #fff; /* Đặt màu văn bản */
            font-weight: bold; /* Làm đậm văn bản */
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body >
    <div class="grid">
        @include('Components.header')
        <div class="container">
            <div class="grid wide" >
                @include('Components.breadcrumb')
                <script>
                    breadCrumbHeading.innerText = 'Dụng cụ hỗ trợ tập luyện'
                </script>
                <div class="row content">
                    {{-- <div class="col l-3 m-3 c-12">
                        <div class="choose">
                            <h2 class="choose__heading" for="choose">Lọc theo loại sân</h2>
                            <div class="choose__filter">
                                <label class="choose__filter-index" for="choose">Loại sân: 
                                </label>
                                <select class="choose__filter-index-category" id="choose">
                                    <option data-value="" class="option selected">Tất cả loại sân</option>
                                    <option data-value="1" class="option">Chuyền</option>
                                    <option data-value="2" class="option">Chuyền cát</option>
                                    <option data-value="3" class="option">Bóng đá</option>
                                    <option data-value="4" class="option">Bóng rỗ</option>
                                </select>
                            </div>
                        </div>
                        <div class="choose">
                            <h2 class="choose__heading">Lọc theo giá</h2>
                            <div class="choose__filter">
                                <input class="choose__filter-range" type="range" name="price" id="price" value="100" step="20">
                                <label class="choose__filter-index" for="price">Phạm vi: 
                                    <span class="choose__filter-number">
                                        <span class="choose__filter-number-from">100.000 </span>
                                        <span class="choose__filter-number-to">- 250.000</span>
                                        <sup>₫</sup>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col l-12 m-12 c-12">
                        <div class="row sorting-search">
                            <div class="col l-9 m-9 c-12 sorting" style="height: 100%; " >
                                <h2 class="sorting-view__heading" style="display: block">Tìm kiếm: </h2>
                                <div class="sorting-view" style="flex: 1">
                                    <input type="text" class="sorting-view__search" id="name-search" placeholder="Tên dụng cụ">
                                </div>
                                <button class="button-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                            {{-- <div class="col l-3 m-3 c-0 sorting opacity-0">
                                <label for="time">Thời gian thuê: </label>
                                <input type="number" id="time" value="1" class="">
                                <label for="time">Giờ</label>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col l-6 m-6 c-6 sorting ">
                                <ul class="sorting-view">
                                    <li class="sorting-view__item sorting-view__item-grid sorting-view__item--active">
                                        <i class="fa-solid fa-grip-vertical"></i>
                                    </li>
                                    <li class="sorting-view__item sorting-view__item-list">
                                        <i class="fa-solid fa-list"></i>
                                    </li>
                                </ul>
                                <h2 class="sorting-view__heading sorting-view__heading-sport-field-quantity"></h2>
                            </div>
                            <div class="col l-6 m-6 c-6 sorting filter-basic">
                                <label class="sorting-view__heading">Sắp xếp theo:</label>
                                <select class="filter-basic__fieldset-list">
                                    <option data-set="1" class="option selected">Xếp theo tên: A-Z</option>
                                    <option data-set="2" class="option">Xếp theo tên: Z-A</option>
                                    <option data-set="3" class="option">Xếp theo giá: thấp đến cao</option>
                                    <option data-set="4" class="option">Xếp theo giá: cao đến thấp</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="grid-mode">
                            <div class="row">
                            </div>
                        </div>
                        <div class="list-mode">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Components.footer')
    </div>
    <script>
        // Dùng lại cấu trúc của sân bóng bên book.blade.php
        var urlApiSanBong = 'http://127.0.0.1:8000/api/dungcu'
        var gridMode = $('.grid-mode .row')
        var listMode = $('.list-mode .row')
        listMode.classList.add('display-none')
        var dataAllSanBong//Lưu dữ liệu ban đầu 
        var dataAllSanBongFollowFilter
        start()
        function start(){
            getSanBong(sanbongs => {
                dataAllSanBong = sanbongs.filter((sanbong)=>{
                    return sanbong.soLuongBan > 0
                })
                dataAllSanBongFollowFilter = [...dataAllSanBong]
                renderSanBong(dataAllSanBongFollowFilter)
            })
        }
        function getSanBong(callback){
            fetch(urlApiSanBong)
                .then(response => response.json())
                .then(callback)
        }
        function renderSanBong(sanbongs){
            sportsFieldQuantity.innerHTML = sanbongs.length + " dụng cụ"
            sanbongs.forEach((sanbong)=>{
                let formattedPriceString = formatCurrency(sanbong.donGiaGoc.toString())
                gridMode.innerHTML +=    `
                                        <div class="col l-3 m-3 c-12">
                                            <div class="football-ground">
                                                <div class="fg-image">
                                                    <div class="image-box">
                                                        <img class="image-box__item" src="assets/img/${sanbong.hinhAnh1}">
                                                        ${sanbong.hinhAnhHover?`<img class="image-box__item image-box__item--hover"  src="assets/img/${sanbong.hinhAnhHover}">`:``}
                                                    </div>
                                                    <p class="image-status">Chính hãng</p>
                                                    <div class="image-action">
                                                        <p class="image-action__item" onclick="buyAndPay('${sanbong.maDungCu}')">Mua</p>
                                                    </div>
                                                </div>
                                                <div class="fg-infor">
                                                    <a href="/dungcu/${sanbong.maDungCu}" class="fg-infor__name">${sanbong.tenDungCu}</a>
                                                    
                                                </div>
                                                <div class="fg-infor">
                                                    <p class="fg-infor__price"><span>${formattedPriceString}</span></p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        `
                listMode.innerHTML +=   `
                                        <div class="football-ground row">
                                            <div class="fg-image col l-6 m-6 c-12">
                                                <div class="image-box">
                                                    <img class="image-box__item" src="assets/img/${sanbong.hinhAnh1}" style="width: 960px">
                                                    ${sanbong.hinhAnhHover?`<img class="image-box__item image-box__item--hover"  src="assets/img/${sanbong.hinhAnhHover}">`:``}
                                                </div>
                                                <p class="image-status">Chính hãng</p>
                                                
                                            </div>
                                            <div class="fg-infor col l-6 m-6 c-12">
                                                <a href="/dungcu/${sanbong.maDungCu}" class="fg-infor__name">${sanbong.tenDungCu}</a>
                                                <p class="fg-infor__price fg-infor__location-price"><span style=""><span>${formattedPriceString}</span></p>
                                                <p class="fg-infor__description">${sanbong.moTa}</p>
                                                <div class="fg-infor__action">
                                                    <p class="fg-infor__action-item fg-infor__action-improve" onclick="addToCart('${sanbong.maDungCu}')">Thêm vào giỏ</p>
                                                </div>
                                            </div>
                                        </div>
                                        `
            })
        }
        var gridButton = $(".sorting-view__item-grid");
        var listButton = $(".sorting-view__item-list");

        listButton.onclick = () => {
            gridButton.classList.remove('sorting-view__item--active')
            listButton.classList.add('sorting-view__item--active')
            gridMode.classList.add('display-none')
            listMode.classList.remove('display-none')
        };
        gridButton.onclick = () => {
            listButton.classList.remove('sorting-view__item--active')
            gridButton.classList.add('sorting-view__item--active')
            gridMode.classList.remove('display-none')
            listMode.classList.add('display-none')

        };
        function formatCurrency(input) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(input);
        }
        // Xử lý lọc theo dụng cụ
        var sportsFieldQuantity = $('.sorting-view__heading-sport-field-quantity')
        function handleFilter(datSanBong){
            // let price = parseInt(priceTo.innerHTML.replace(/[\s.-]/g, ''), 10)
            let searchString = document.querySelector('#name-search').value.toLowerCase()
            // if(!price)
            //     price = 200000
            datSanBong = dataAllSanBong.filter((sanbong)=>{
                // return sanbong.donGiaGoc <= price && (sanbong.tenDungCu.toLowerCase().includes(searchString) || sanbong.moTa.toLowerCase().includes(searchString))
                return (sanbong.tenDungCu.toLowerCase().includes(searchString))
            })
            switch(filterAZHighLow){
                case "Xếp theo tên: A-Z":
                    datSanBong.sort((a, b) => {
                        return a.tenDungCu.localeCompare(b.tenDungCu);
                    });
                    break;
                case "Xếp theo tên: Z-A":
                    datSanBong.sort((a, b) => {
                        return b.tenDungCu.localeCompare(a.tenDungCu);
                    });
                    break;
                case "Xếp theo giá: thấp đến cao":
                    datSanBong.sort((a, b) => {
                        return a.donGiaGoc - b.donGiaGoc;
                    });
                    break;
                case "Xếp theo giá: cao đến thấp":
                    datSanBong.sort((a, b) => {
                        return b.donGiaGoc - a.donGiaGoc;
                    });
                    break;
            }
            renderSanBong(datSanBong)
        }
        // {{-- Xử lý lọc theo giá --}}
        // var priceView = $(".choose__filter-range")
        // var priceTo = $('.choose__filter-number-to');
        // priceView.onchange = () => {
        //     gridMode.innerHTML = ""
        //     listMode.innerHTML = ""
        //     let price = priceView.value
        //     switch(price){
        //         case "0":
        //             priceTo.innerText = '';
        //             break;
        //         case "20":
        //             priceTo.innerText = '- 210.000';
        //             break;
        //         case "40":
        //             priceTo.innerText = '- 220.000';
        //             break;
        //         case "60":
        //             priceTo.innerText = '- 230.000';
        //             break;
        //         case "80":
        //             priceTo.innerText = '- 240.000';
        //             break;
        //         default:
        //             priceTo.innerText = '- 250.000';
        //     }
        //     handleFilter(dataAllSanBongFollowFilter)
        // }
        var normalFilterView = $('.filter-basic__fieldset-list')
        var filterAZHighLow
        normalFilterView.onchange = () => {
            gridMode.innerHTML = ""
            listMode.innerHTML = ""  
            filterAZHighLow = normalFilterView.value;
            handleFilter(dataAllSanBongFollowFilter)
        }
        var buttonSearchView = document.querySelector('.button-search')
            buttonSearchView.onclick = () => {
                gridMode.innerHTML = ""
                listMode.innerHTML = ""
                handleFilter(dataAllSanBongFollowFilter)
            }
        var inputSearchView = document.querySelector('#name-search')
        inputSearchView.addEventListener("keypress", function(event) {
            // Kiểm tra xem phím đã được nhấn có phải là phím Enter không (mã phím 13)
            if (event.keyCode === 13) {
                gridMode.innerHTML = ""
                listMode.innerHTML = ""
                handleFilter(dataAllSanBongFollowFilter)
            }
        });
        const apiGioHang = 'http://127.0.0.1:8000/api/giohang'
        const maNguoiDung = "{{ Auth::user()->maNguoiDung }}"
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        function addToCart(maDungCu){
            fetch(apiGioHang)
                .then(promise => promise.json())
                .then(data => {
                    data = data.filter((giohang)=> {
                        return giohang.maNguoiDung == maNguoiDung
                    })
                    console.log(data)
                    let isExistTool = data.every((giohang)=>{
                        return giohang.maDungCu !== maDungCu 
                    })
                    if(isExistTool){
                        fetch(apiGioHang,{
                            method: "post",
                            headers: {
                                "Content-type": 'application/json',
                                "X-csrf-token": token
                            },
                            body: JSON.stringify({"maNguoiDung": maNguoiDung, "maDungCu": maDungCu, "soLuong": 1})
                        })
                            .then(promise => {
                                toastr.success("Sản phẩm đã được thêm vào giỏ hàng.");
                            })
                    }
                    else
                        toastr.error("Sản phẩm đã tồn tại trong giỏ hàng.");
                })
        }
    </script>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        toastr.options = {
            "toastClass": "toast-style", // Đặt lớp CSS cho thông báo
            "titleClass": "toast-title-style", // Đặt lớp CSS cho tiêu đề thông báo
            "messageClass": "toast-message-style", // Đặt lớp CSS cho nội dung thông báo
            "closeButton": true, // Hiển thị nút đóng
            "timeOut": 0 // Không tự động tắt
        };
    </script>

</html>