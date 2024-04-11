<!DOCTYPE html>
<html lang="en">
<head>
    @include('Library.grid_system')
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
            display: flex;
            height: 50px;
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
            height: 100%;
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
            justify-content: space-between;
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
        .grid-mode {
            /* display: none; */
        }
        /* List mode */
        .list-mode {
            display: none;
        }
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
        .list-mode .fg-infor__description {
            color: #79808c;
            margin-bottom: 8px;
            text-align: justify;
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
                    breadCrumbHeading.innerText = 'Đặt sân'
                </script>
                <div class="row content">
                    <div class="col l-3">
                        <div class="choose">
                            <h2 class="choose__heading">Lọc theo loại sân</h2>
                            <div class="choose__filter">
                                <label class="choose__filter-index" for="choose">Loại sân: 
                                </label>
                                <select class="choose__filter-index-category">
                                    <option data-value="1" class="option selected">Tất cả loại sân</option>
                                    <option data-value="2" class="option">Bóng chuyền</option>
                                    <option data-value="4" class="option">Bóng chuyền cát</option>
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
                    <div class="col l-9">
                        <div class="row">
                            <div class="col l-6 sorting">
                                <ul class="sorting-view">
                                    <li class="sorting-view__item sorting-view__item-grid sorting-view__item--active">
                                        <i class="fa-solid fa-grip-vertical"></i>
                                    </li>
                                    <li class="sorting-view__item sorting-view__item-list">
                                        <i class="fa-solid fa-list"></i>
                                    </li>
                                </ul>
                                <h2 class="sorting-view__heading">15 Sân bóng cho quý khách chọn lựa</h2>
                            </div>
                            <div class="col l-6 sorting filter-basic">
                                <label class="">Sắp xếp theo:</label>
                                <select class="filter-basic__fieldset-list">
                                    <option data-value="1" class="option selected">Xếp theo tên: A-Z</option>
                                    <option data-value="2" class="option">Xếp theo tên: Z-A</option>
                                    <option data-value="3" class="option">Xếp theo giá: thấp đến cao</option>
                                    <option data-value="4" class="option">Xếp theo giá: cao đến thấp</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l-6 sorting">
                                <h2 class="sorting-view__heading">Chọn thời gian thuê: </h2>
                                <div class="sorting-view">
                                    <input type="datetime-local" min="2024-04-10T02:02" class="sorting-view__date">
                                </div>
                            </div>
                            <div class="col l-6 sorting filter-basic">
                                <label for="time">Thời gian thuê: </label>
                                <input type="number" id="time" value="1" class="sorting__input-time">
                                <p>Giờ</p>
                            </div>
                        </div>
                        <div class="grid-mode">
                            <div class="row">
                                <div class="col l-6">
                                    <div class="football-ground">
                                        <div class="fg-image">
                                            <div class="image-box">
                                                <img class="image-box__item" src="assets/img/sanbongchuyen.jpg">
                                                <img class="image-box__item image-box__item--hover"  src="assets/img/sanbongchuyen_hover.jpg">
                                            </div>
                                            <p class="image-status">Hoạt động</p>
                                            <div class="image-action">
                                                <p class="image-action__item">Thêm vào túi</p>
                                                <p class="image-action__item">Nâng</p>
                                            </div>
                                        </div>
                                        <div class="fg-infor">
                                            <a href="#" class="fg-infor__name">Sân bóng chuyền số 1</a>
                                            <p class="fg-infor__price"><span>200.000</span>VNĐ/h</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col l-6">
                                    <div class="football-ground football-ground--0">
                                        <div class="fg-image">
                                            <div class="image-box">
                                                <img class="image-box__item" src="assets/img/sanbongda.jpg">
                                                <img class="image-box__item image-box__item--hover" src="assets/img/sanbongda_hover.jpg">
                                            </div>
                                            <p class="image-status">Bảo trì</p>
                                            <div class="image-action">
                                                <p class="image-action__item">Thêm vào túi</p>
                                                <p class="image-action__item">Nâng</p>
                                            </div>
                                        </div>
                                        <div class="fg-infor">
                                            <p class="fg-infor__name">Sân bóng chuyền số 1</p>
                                            <p class="fg-infor__price"><span>200.000</span>VNĐ/h</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-6">
                                    <div class="football-ground">
                                        <div class="fg-image">
                                            <div class="image-box">
                                                <img class="image-box__item" src="assets/img/sanbongchuyencat.jpg">
                                                <img class="image-box__item image-box__item--hover"  src="assets/img/sanbongchuyencat_hover.jpg">
                                            </div>
                                            <p class="image-status">Hoạt động</p>
                                            <div class="image-action">
                                                <p class="image-action__item">Thêm vào túi</p>
                                                <p class="image-action__item">Nâng</p>
                                            </div>
                                        </div>
                                        <div class="fg-infor">
                                            <a href="#" class="fg-infor__name">Sân bóng chuyền số 1</a>
                                            <p class="fg-infor__price"><span>200.000</span>VNĐ/h</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col l-6">
                                    <div class="football-ground">
                                        <div class="fg-image">
                                            <div class="image-box">
                                                <img class="image-box__item" src="assets/img/sanbongro.jpg">
                                                <img class="image-box__item image-box__item--hover" src="assets/img/sanbongro_hover.jpg">
                                            </div>
                                            <p class="image-status">Hoạt động</p>
                                            <div class="image-action">
                                                <p class="image-action__item">Thêm vào túi</p>
                                                <p class="image-action__item">Nâng</p>
                                            </div>
                                        </div>
                                        <div class="fg-infor">
                                            <p class="fg-infor__name">Sân bóng chuyền số 1</p>
                                            <p class="fg-infor__price"><span>200.000</span>VNĐ/h</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-mode">
                            <div class="football-ground row">
                                <div class="fg-image col l-6">
                                    <div class="image-box">
                                        <img class="image-box__item" src="assets/img/sanbongchuyen.jpg">
                                        <img class="image-box__item image-box__item--hover"  src="assets/img/sanbongchuyen_hover.jpg">
                                    </div>
                                    <p class="image-status">Hoạt động</p>
                                    
                                </div>
                                <div class="fg-infor col l-6">
                                    <a href="#" class="fg-infor__name">Sân bóng chuyền số 1</a>
                                    <p class="fg-infor__price"><span>200.000</span>VNĐ/h</p>
                                    <p class="fg-infor__description">Sân bóng nằm ở vị trí đầu tiên phía bên trái cổng ra vào. Thời gian đông khách thường vào khung giờ sau 18h.</p>
                                    <div class="fg-infor__action">
                                        <p class="fg-infor__action-item fg-infor__action-cart">Thêm vào túi</p>
                                        <p class="fg-infor__action-item fg-infor__action-improve">Nâng</p>
                                    </div>
                                </div>
                            </div>
                            <div class="football-ground--0 row">
                                <div class="fg-image col l-6">
                                    <div class="image-box">
                                        <img class="image-box__item" src="assets/img/sanbongchuyen.jpg">
                                        <img class="image-box__item image-box__item--hover"  src="assets/img/sanbongchuyen_hover.jpg">
                                    </div>
                                    <p class="image-status">Bảo trì</p>
                                    
                                </div>
                                <div class="fg-infor col l-6">
                                    <a href="#" class="fg-infor__name">Sân bóng chuyền số 1</a>
                                    <p class="fg-infor__price"><span>200.000</span>VNĐ/h</p>
                                    <p class="fg-infor__description">Sân bóng nằm ở vị trí đầu tiên phía bên trái cổng ra vào. Thời gian đông khách thường vào khung giờ sau 18h.</p>
                                    
                                </div>
                            </div>
                            <div class="football-ground row">
                                <div class="fg-image col l-6">
                                    <div class="image-box">
                                        <img class="image-box__item" src="assets/img/sanbongchuyen.jpg">
                                        <img class="image-box__item image-box__item--hover"  src="assets/img/sanbongchuyen_hover.jpg">
                                    </div>
                                    <p class="image-status">Hoạt động</p>
                                    
                                </div>
                                <div class="fg-infor col l-6">
                                    <a href="#" class="fg-infor__name">Sân bóng chuyền số 1</a>
                                    <p class="fg-infor__price"><span>200.000</span>VNĐ/h</p>
                                    <p class="fg-infor__description">Sân bóng nằm ở vị trí đầu tiên phía bên trái cổng ra vào. Thời gian đông khách thường vào khung giờ sau 18h.</p>
                                    <div class="fg-infor__action">
                                        <p class="fg-infor__action-item fg-infor__action-cart">Thêm vào túi</p>
                                        <p class="fg-infor__action-item fg-infor__action-improve">Nâng</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var gridButton = $(".sorting-view__item-grid");
            var listButton = $(".sorting-view__item-list");

            listButton.onclick = () => {
                gridButton.classList.remove('sorting-view__item--active')
                listButton.classList.add('sorting-view__item--active')
                var gridMode = $('.grid-mode')
                gridMode.classList.toggle('display-none')
                var listMode = $('.list-mode')
                listMode.classList.toggle('display-block')
            };
            gridButton.onclick = () => {
                listButton.classList.remove('sorting-view__item--active')
                gridButton.classList.add('sorting-view__item--active')
                var gridMode = $('.grid-mode')
                gridMode.classList.toggle('display-none')
                var listMode = $('.list-mode')
                listMode.classList.toggle('display-block')

            };
            var rangePrice = $('.choose__filter-range');
            var priceTo = $('.choose__filter-number-to');
            var onePercentToPrice = 2.5;
            rangePrice.onchange = function(){
                console.log(rangePrice.value)
                switch(rangePrice.value){
                    case '0':
                        priceTo.innerText = '';
                        break;
                    case '20':
                        priceTo.innerText = '- 210.000';
                        break;
                    case '40':
                        priceTo.innerText = '- 220.000';
                        break
                    case '60':
                        priceTo.innerText = '- 230.000';
                        break
                    case '80':
                        priceTo.innerText = '- 240.000';
                        break
                    case '100':
                        priceTo.innerText = '- 250.000';
                        break
                }
            }
        </script>
        @include('Components.footer')
    </div>
</body>
</html>