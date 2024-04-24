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
        }
        .fg-image {
            box-shadow: 0px 0px 2px black;
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
            background-color: white;
            color: var(--primary-color);
            padding: 0 12px;
            transform: translateY(100%);
            transition: all linear 0.3s;
        }
    
        .image-action__item:hover {
            cursor: pointer;
            color: green;
        }
    
        .fg-infor {
            display: flex;
            justify-content: space-between;
            margin: 12px 20px;
        }
        .fg-infor__name {
            font-weight: bold;
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
        .list-mode .fg-infor__price {
            color: red;
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
                    breadCrumbHeading.innerText = 'Đặt sân'
                </script>
                <div class="row content">
                    <div class="col l-3 m-3 c-12">
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
                                        <span class="choose__filter-number-from">200.000 </span>
                                        <span class="choose__filter-number-to">- 250.000</span>
                                        <sup>₫</sup>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col l-9 m-9 c-12">
                        <div class="row sorting-search">
                            <div class="col l-9 m-9 c-12 sorting" style="height: 100%; " >
                                <h2 class="sorting-view__heading" style="display: block">Tìm kiếm sân: </h2>
                                <div class="sorting-view" style="flex: 1">
                                    <input type="text" class="sorting-view__search" id="name-search" placeholder="Tên sân, mô tả, vị trí">
                                </div>
                                <button class="button-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                            <div class="col l-3 m-3 c-0 sorting opacity-0">
                                {{-- <label for="time">Thời gian thuê: </label>
                                <input type="number" id="time" value="1" class="">
                                <label for="time">Giờ</label> --}}
                            </div>
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
    <div class="overlay" style="    width: 100%;    height: 100%;    position: fixed; top: 40px;    display: flex;    justify-content: center; align-items: flex-end;">
        @include('Elements.dialog')
    </div>
        <script>
            var urlApiSanBong = 'http://127.0.0.1:8000/api/sanbong'
            var gridMode = $('.grid-mode .row')
            var listMode = $('.list-mode .row')
            listMode.classList.add('display-none')
            var dataAllSanBong//Lưu dữ liệu ban đầu 
            var dataAllSanBongFollowFilter
            var form = $('.overlay');
            start()
            function start(){
                form.classList.toggle('display-none');
                getSanBong(sanbongs => {
                    dataAllSanBong = sanbongs
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
                sportsFieldQuantity.innerHTML = sanbongs.length + " sân thể thao"
                sanbongs.forEach((sanbong)=>{
                    let formattedPriceString = formatCurrency(sanbong.giaDichVu.toString())
                    if(sanbong.trangThai === 1){
                        gridMode.innerHTML +=    `
                                                <div class="col l-6 m-6 c-12">
                                                    <div class="football-ground">
                                                        <div class="fg-image">
                                                            <div class="image-box">
                                                                <img class="image-box__item" src="assets/img/${sanbong.hinhAnh}.jpg">
                                                                <img class="image-box__item image-box__item--hover"  src="assets/img/${sanbong.hinhAnh}_hover.jpg">
                                                            </div>
                                                            <p class="image-status">Hoạt động</p>
                                                            <div class="image-action">
                                                                <p class="image-action__item" onclick="showImproveDialog('${sanbong.maSan}')">Đặt sân</p>
                                                            </div>
                                                        </div>
                                                        <div class="fg-infor">
                                                            <a href="#" class="fg-infor__name">${sanbong.tenSan}</a>
                                                            <p class="fg-infor__price"><span>${formattedPriceString}</span>/h</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                `
                        listMode.innerHTML +=   `
                                                <div class="football-ground row">
                                                    <div class="fg-image col l-6 m-6 c-12">
                                                        <div class="image-box">
                                                            <img class="image-box__item" src="assets/img/${sanbong.hinhAnh}.jpg">
                                                            <img class="image-box__item image-box__item--hover"  src="assets/img/${sanbong.hinhAnh}_hover.jpg">
                                                        </div>
                                                        <p class="image-status">Hoạt động</p>
                                                        
                                                    </div>
                                                    <div class="fg-infor col l-6 m-6 c-12">
                                                        <a href="#" class="fg-infor__name">${sanbong.tenSan}</a>
                                                        <p class="fg-infor__price fg-infor__location-price"><span style="color: black">Vị trí: ${sanbong.viTri}</span><span>${formattedPriceString}/h</span></p>
                                                        <p class="fg-infor__description">${sanbong.moTa}</p>
                                                        <div class="fg-infor__action">
                                                            <p class="fg-infor__action-item fg-infor__action-improve" onclick="showImproveDialog('${sanbong.maSan}')">Đặt sân</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                `
                    }
                    else{
                        gridMode.innerHTML +=    `
                                                <div class="col l-6 m-6 c-12">
                                                    <div class="football-ground football-ground--0">
                                                        <div class="fg-image">
                                                            <div class="image-box">
                                                                <img class="image-box__item" src="assets/img/${sanbong.hinhAnh}.jpg">
                                                                <img class="image-box__item image-box__item--hover"  src="assets/img/${sanbong.hinhAnh}_hover.jpg">
                                                            </div>
                                                            <p class="image-status">Bảo trì</p>
                                                            <div class="image-action">
                                                                <p class="image-action__item" onclick="showImproveDialog('${sanbong.maSan}')">Đặt sân</p>
                                                            </div>
                                                        </div>
                                                        <div class="fg-infor">
                                                            <a href="#" class="fg-infor__name">${sanbong.tenSan}</a>
                                                            <p class="fg-infor__price"><span>${formattedPriceString}</span>/h</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                `
                        listMode.innerHTML +=   `
                                                <div class="football-ground football-ground--0 row">
                                                    <div class="fg-image col l-6 m-6 c-12">
                                                        <div class="image-box">
                                                            <img class="image-box__item" src="assets/img/${sanbong.hinhAnh}.jpg">
                                                            <img class="image-box__item image-box__item--hover"  src="assets/img/${sanbong.hinhAnh}_hover.jpg">
                                                        </div>
                                                        <p class="image-status">Bảo trì</p>
                                                        
                                                    </div>
                                                    <div class="fg-infor col l-6 m-6 c-12">
                                                        <a href="#" class="fg-infor__name">${sanbong.tenSan}</a>
                                                        <p class="fg-infor__price fg-infor__location-price"><span style="color: black">Vị trí: ${sanbong.viTri}</span><span>${formattedPriceString}/h</span></p>
                                                        <p class="fg-infor__description">${sanbong.moTa}</p>
                                                    </div>
                                                </div>
                                                `
                    }
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
        </script>
        {{-- Định dạng tiền bằng js --}}
        <script>
            function formatCurrency(input) {
                return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(input);
            }
        </script>
        {{-- Xử lý lọc theo sân bóng --}}
        <script>
            var categoryListView = document.querySelector('.choose__filter-index-category')
            var sportsFieldQuantity = $('.sorting-view__heading-sport-field-quantity')
            categoryListView.onchange = ()=>{
                // console.log(categoryListView.value)
                gridMode.innerHTML = ""
                listMode.innerHTML = ""
                handleFilter(dataAllSanBongFollowFilter)
            }
            function handleFilter(datSanBong){
                let price = parseInt(priceTo.innerHTML.replace(/[\s-]/g, ''), 10) * 1000
                let searchString = document.querySelector('#name-search').value.toLowerCase()
                if(!price)
                    price = 200000
                datSanBong = dataAllSanBong.filter((sanbong)=>{
                    if(categoryListView.value === "Tất cả loại sân")
                        return sanbong.giaDichVu <= price && (sanbong.tenSan.toLowerCase().includes(searchString) || sanbong.moTa.toLowerCase().includes(searchString) || sanbong.viTri.toLowerCase().includes(searchString))
                    return sanbong.loaiSan === categoryListView.value && sanbong.giaDichVu <= price && (sanbong.tenSan.toLowerCase().includes(searchString) || sanbong.moTa.toLowerCase().includes(searchString) || sanbong.viTri.toLowerCase().includes(searchString))
                })
                switch(filterAZHighLow){
                    case "Xếp theo tên: A-Z":
                        datSanBong.sort((a, b) => {
                            return a.tenSan.localeCompare(b.tenSan);
                        });
                        break;
                    case "Xếp theo tên: Z-A":
                        datSanBong.sort((a, b) => {
                            return b.tenSan.localeCompare(a.tenSan);
                        });
                        break;
                    case "Xếp theo giá: thấp đến cao":
                        datSanBong.sort((a, b) => {
                            return a.giaDichVu - b.giaDichVu;
                        });
                        break;
                    case "Xếp theo giá: cao đến thấp":
                        datSanBong.sort((a, b) => {
                            return b.giaDichVu - a.giaDichVu;
                        });
                        break;
                }
                renderSanBong(datSanBong)
            }
        </script>
        {{-- Xử lý lọc theo giá --}}
        <script>
            var priceView = $(".choose__filter-range")
            var priceTo = $('.choose__filter-number-to');
            priceView.onchange = () => {
                gridMode.innerHTML = ""
                listMode.innerHTML = ""
                let price = priceView.value
                switch(price){
                    case "0":
                        priceTo.innerText = '';
                        break;
                    case "20":
                        priceTo.innerText = '- 210.000';
                        break;
                    case "40":
                        priceTo.innerText = '- 220.000';
                        break;
                    case "60":
                        priceTo.innerText = '- 230.000';
                        break;
                    case "80":
                        priceTo.innerText = '- 240.000';
                        break;
                    default:
                        priceTo.innerText = '- 250.000';
                }
                handleFilter(dataAllSanBongFollowFilter)
            }
        </script>
        {{-- Xử lý lọc theo A-Z, Z-A, giá từ cao tới thấp, từ thấp tới cao --}}
        <script>
            var normalFilterView = $('.filter-basic__fieldset-list')
            var filterAZHighLow
            normalFilterView.onchange = () => {
                gridMode.innerHTML = ""
                listMode.innerHTML = ""  
                filterAZHighLow = normalFilterView.value;
                handleFilter(dataAllSanBongFollowFilter)
            }
        </script>
        <script>
            // var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // function addToBag(maSan){
            //     var data = {}
            //     var apiThueSan = "http://127.0.0.1:8000/api/thuesan"
            //     if (parseInt("{{ Auth::check() }}")) {
            //         data["maNguoiDung"] = parseInt("{{ Auth::user()->maNguoiDung }}"),
            //         data["maSan"] = maSan,
            //         data["soLuong"] = 1,
            //         data["thoiGianBatDau"] = getTimeStart().toString(),
            //         data["thoiGianKetThuc"] = getTimeEnd().toString(),
            //         data["trangThai"] = 0,

            //         // Thêm token CSRF vào yêu cầu POST
            //         data["_token"] = csrfToken;
            //         console.log(JSON.stringify(data))
            //         fetch(apiThueSan,{
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json'
            //             },
            //             body: JSON.stringify(data)
            //         })
            //         .then(response => response.json())
            //         .then(data => {
            //             if(data.error)
            //                 toastr.error(data.error)
            //             else
            //                 toastr.success(data.success)
            //         })
            //     }
            //     else{
            //         window.location.href = "/dangnhap"; 
            //     }
            // }
            function getTimeStart(dateStart, hourStart) {
                const currentDate = new Date(dateStart);

                // Tính toán ngày và giờ bắt đầu
                const startDateTime = new Date(currentDate);
                startDateTime.setHours(0); // Đặt giờ bắt đầu thành 0 giờ của ngày hiện tại
                startDateTime.setMinutes(0);
                startDateTime.setSeconds(0);

                // Nếu hourStart là 24, thì cộng thêm 1 ngày vào ngày hiện tại
                if (hourStart === 24) {
                    startDateTime.setDate(startDateTime.getDate() + 1);
                } else {
                    startDateTime.setHours(hourStart);
                }

                // Tính toán ngày và giờ kết thúc
                const endDateTime = new Date(startDateTime.getTime());

                // Lấy thông tin ngày, tháng, năm, giờ, phút và giây từ đối tượng Date
                const year = endDateTime.getFullYear();
                const month = String(endDateTime.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0, nên cộng thêm 1
                const day = String(endDateTime.getDate()).padStart(2, '0');
                const hours = String(endDateTime.getHours()).padStart(2, '0');
                const minutes = String(endDateTime.getMinutes()).padStart(2, '0');
                const seconds = String(endDateTime.getSeconds()).padStart(2, '0');
                // Tạo chuỗi định dạng Y-m-d h-m-s
                const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
                return formattedDate;
            }
            function getTimeEnd(startTime, borrowHour, hourStart) {
                const startDateTime = new Date(startTime);
                
                // Đặt giờ bắt đầu
                startDateTime.setHours(parseInt(hourStart));

                // Cộng thêm số giờ thuê
                startDateTime.setHours(startDateTime.getHours() + parseInt(borrowHour));

                // Lấy thông tin ngày, tháng, năm, giờ, phút và giây từ đối tượng Date
                const year = startDateTime.getFullYear();
                const month = String(startDateTime.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0, nên cộng thêm 1
                const day = String(startDateTime.getDate()).padStart(2, '0');
                const hours = String(startDateTime.getHours()).padStart(2, '0');
                const minutes = String(startDateTime.getMinutes()).padStart(2, '0');
                const seconds = String(startDateTime.getSeconds()).padStart(2, '0');

                // Tạo chuỗi định dạng Y-m-d h-m-s
                const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
                return formattedDate;
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
        </script>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>