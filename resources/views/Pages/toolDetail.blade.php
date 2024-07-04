<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    @include('Library.grid_system')
    @include('Library.responsive')
    @include('Library.variable')
    @include('Library.validator')
    <style>
        .image-description, .product, .address, .trade, .infor-supplemnet {
            background-color: white;
            border-radius: 8px;
            padding: 16px;
        }
        
        .image-product-cover {
            display: block;
        }
        
        .image-product {
            border: 1px solid #ededf1;
            border-radius: 8px;
            width: 100%;
        }
        
        .description {
            margin-top: 16px;
        }
        
        .description-title, .address-title {
            font-size: 16px;
            color: rgb(39, 39, 42);
            font-weight: 600;
        }
        
        .description-list {
            margin-top: 4px;
        }
        
        .description-item {
            font-size: 14px;
            color: #27272A;
            text-align: justify;
        }
        
        .description-item__icon {
            color: #0c68ff;
            margin-right: 8px;
        }
        
        .description-item + .description-item {
            margin-top: 8px;
        }
        
        .product-genuine-brand {
            display: flex;
            height: 18px;
            align-items: center;
        }
        
        .product__brand {
            font-size: 10px;
            color: rgb(36, 36, 36);
            margin-left: 8px;
        }
        
        .product__brand-link {
            color: #6173b8;
        }
        
        .product__genuine {
            color: #0057e0;
            background-color: #f2f7ff;
            width: 100px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 33px;
            padding: 0 4px;
        }
        
        .product__name {
            line-height: 150%;
            font-size: 20px;
            color: rgb(39, 39, 42);
            font-weight: 500;
        }
        
        .product__price {
            font-size: 24px;
            font-weight: 500;
            position: relative;
        }
        
        .product__price-has-discount::after {
            content: "-47%";
            font-size: 12px;
            height: 18px;
            line-height: 18px;
            background-color: #f5f5fa;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            padding: 0 4px;
            border-radius: 20px;
            color: rgb(39, 39, 42);
            font-weight: 500;
            margin-left: 12px;
        }
        
        .item-product-infor__evaluate {
            height: 24px;
            display: flex;
            justify-content: start;
            align-items: center;
            font-size: 14px;
        }
        
        .item-product-infor-evaluate__star {
            color: #fcc629;
            scale: 0.8;
        }
        
        .item-product-infor-evaluate__saled {
            color: #aeaeb4;
            font-size: 14px;
            padding-left: 4px;
            border-left: 1px solid #f2f2f5;
            margin-left: 4px;
        }
        
        .address, .infor-supplemnet {
            margin-top: 8px;
        }
        
        .address-detail {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }
        
        .address-detail, .delivery-date, .delivery-hour {
            margin-top: 4px;
        }
        
        .delivery-date {
            display: flex;
            align-items: center;
        }
        
        .delivery-date__icon {
            width: 32px;
        }
        
        .delivery-date__detail {
            margin-left: 8px;
            text-transform: capitalize;
            font-size: 14px;
        }
        
        .delivery-hour {
            font-size: 14px;
        }
        
        .trade-brand {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .trade-brand__img {
            width: 40px;
            height: 40px;
            -o-object-fit: contain;
            object-fit: contain;
            border-radius: 50%;
        }
        
        .trade-brand__name {
            margin-left: 8px;
        }
        
        .trade-brand-name__offical {
            font-size: 15px;
            display: flex;
        }
        
        .trade-brand-name__offical-img {
            width: 72px;
            height: 20px;
            margin-left: 4px;
        }
        
        .trade-action__name {
            display: flex;
            align-items: center;
        }
        
        .trade-action {
            padding-top: 16px;
            border-top: 1px solid #ededf1;
        }
        
        .trade-action__name-img {
            width: 40px;
            height: 40px;
        }
        
        .quantity {
            margin-top: 16px;
        }
        
        .quantity__title {
            font-size: 14px;
            font-weight: bold;
        }
        
        .quantity__button {
            display: flex;
            margin-top: 12px;
        }
        
        .quantity__button-descrease, .quantity__button-number,
        .quantity__button-increase {
            border: 1px solid rgb(166, 166, 176);
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 4px;
            text-align: center;
            margin-left: 8px;
            cursor: pointer;
        }

        .quantity__button--disable {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .quantity__button button:nth-child(1) {
            margin: 0;
        }
        
        .quantity__button-descrease,
        .quantity__button-increase {
        }
        
        .quantity__button-number {
            width: 40px;
            transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
            outline: none;
        }
        
        .button--disable {
            border-color: rgba(196, 196, 207, 0.3);
            color: #d8d8d8;
            cursor:not-allowed;
        }
        
        .price {
            margin-top: 16px;
        }
        
        .price__title {
            font-weight: bold;
        }
        
        .price__total {
            font-size: 24px;
        }
        
        .action {
            margin-top: 16px;
            display: flex;
            flex-direction: column;
        }
        
        .action__pay, .action__cart, .action__buy {
            padding: 8px;
            height: 40px;
            border-radius: 4px;
            border: 1px solid #2a7aff;
            color: #2a7aff;
            font-size: 16px;
            margin-top: 8px;
        }
        
        .action__pay {
            background-color: #ff424e;
            color: white;
            border: none;
        }
        
        .action button:nth-child(1) {
            margin: 0;
        }
        
        .infor-supplemnet__title {
            font-size: 16px;
            font-weight: bold;
        }
        
        .infor-supplemnet__item {
            color: #27272A;
            padding: 8px 0;
            font-size: 14px;
            border-bottom: 1px solid rgb(235, 235, 240);
            display: flex;
        }
        
        .infor-supplemnet__item-name, .infor-supplemnet__item-value {
            width: 50%;
        }
        
        .infor-supplemnet__item-name {
            color: rgb(166, 166, 176);
        }
        
        .infor-supplemnet__item:last-child {
            border: none;
        }
        
        @media (max-width: 1023px) {
            .c-m-margin-bottom-16px {
            margin-bottom: 16px;
            }
        }
        @media (max-width: 739px) {
            .c-order-1 {
            order: -1;
            }
        }
        body {
            position: relative;
        }
        
        .up__link {
            position: fixed;
            right: 16px;
            bottom: 16px;
            height: 40px;
            width: 40px;
            background-color: white;
            border: 1px solid #0057e0;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
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
                    breadCrumbHeading.innerText = 'Dụng cụ > Chi tiết dụng cụ'
                </script>
                <div class="row content">
                    <div class="col l-4 m-4 c-6">
                        <div class="image-description">
                            <a href="#" class="image-product-cover">
                                <img class="image-product" src="https://minhloiiot.id.vn/assets/img/{{ $dungCu->hinhAnh1 }}" alt="15 Pro max">
                            </a>
                            <div class="description">
                                <h1 class="description-title">Đặc điểm nổi bật</h1>
                                <ul class="description-list">
                                    @php
                                        $moTaArray = explode('. ', $dungCu->moTa);
                                        $moTaArray = array_filter($moTaArray, function($value) { return !is_null($value) && $value !== ''; });
                                    @endphp
                                    @foreach ($moTaArray as $item)
                                        <li class="description-item">
                                            <i class="fa-solid fa-circle-check description-item__icon"></i>
                                            {{ $item }}                                            
                                        </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col l-5 m-4 c-6">
                        <div class="product-and-address c-m-margin-bottom-16px">
                            <div class="product">
                                <div class="product-genuine-brand">
                                    <p class="product__genuine">
                                        <i class="fa-solid fa-circle-check"></i>
                                        Chính hãng 
                                    </p>
                                    {{-- <span class="warranty__item-value product__brand">
                                        Thương hiệu: 
                                        <a href="#" class="product__brand-link">
                                            <?php ?>
                                            {{ $brandName }}
                                        </a>
                                    </span> --}}
                                </div>
                                <h1 class="product__name">{{ $dungCu->name }}</h1>
                                <ul class="item-product-infor__evaluate">
                                    <li class="item-product-infor-evaluate__star">
                                        <i class="fa-solid fa-star"></i>
                                        
                                    </li>
                                    <li class="item-product-infor-evaluate__star">
                                        <i class="fa-solid fa-star"></i>
                                        
                                    </li>
                                    <li class="item-product-infor-evaluate__star">
                                        <i class="fa-solid fa-star"></i>
                                        
                                    </li>
                                    <li class="item-product-infor-evaluate__star">
                                        <i class="fa-solid fa-star"></i>
                                        
                                    </li>
                                    <li class="item-product-infor-evaluate__star">
                                        <i class="fa-solid fa-star"></i>
                                        
                                    </li>
                                    <li class="item-product-infor-evaluate__saled">Đã bán 999</li>
                                </ul>
                                <p class="product__price product__price-has-discount" style="display: inline-block">{{ number_format($dungCu->donGiaGoc, 0, ',', '.') }}
                                </p>
                                <sup>₫</sup>
                            </div>
                            <div class="address">
                                <h1 class="address-title">Thông tin vận chuyển</h1>
                                <div class="address-detail">
                                    <p>
                                        @php
                                            $phuongXa = App\Models\PhuongXa::where('maPhuongXa', Auth::user()->maPX)->first();
                                            $quanHuyen = App\Models\QuanHuyen::where('maQuanHuyen', $phuongXa->maQH)->first();
                                            $tenTinh = App\Models\TinhThanh::where('maTinhThanh', $quanHuyen->maTT)->first()->tenTinhThanh;
                                        @endphp
                                        Giao đến {{ $phuongXa->tenPhuongXa }}, {{ $quanHuyen->tenQuanHuyen }}, {{ $tenTinh }}
                                    </p>
                                    <a style="color: #0362ff" href="/hosocanhan" target="_blank">Đổi</a>
                                </div>
                                <div class="delivery-date">
                                    <img class="delivery-date__icon" src="https://minhloiiot.id.vn/assets/img/icon-xe.png" alt="icon-oto">
                                    <p class="delivery-date__detail">giao thứ bảy, chủ nhật</p>
                                </div>
                                <div class="delivery-hour">
                                    {{-- Trước 19h, 20/01:  --}}
                                    <span style="color: #00AB56">Miễn phí <del style="color: #808089; font-size: 14px;">22.000₫</del></span>
                                </div>
                            </div>
                            <div class="infor-supplemnet">
                                <ul class="infor-supplemnet__list">
                                    <li class="infor-supplemnet__title">Thông tin bảo hàng</li>
                                    <li class="infor-supplemnet__item">
                                        <p class="infor-supplemnet__item-name">Thời gian bảo hành</p>
                                        <p class="infor-supplemnet__item-value">1 tháng</p>
                                    </li>
                                    <li class="infor-supplemnet__item">
                                        <p class="infor-supplemnet__item-name">Hình thức bảo hành</p>
                                        <p class="infor-supplemnet__item-value">Dụng cụ thể thao</p>
                                    </li>
                                    <li class="infor-supplemnet__item">
                                        <p class="infor-supplemnet__item-name">Nơi bảo hành</p>
                                        <p class="infor-supplemnet__item-value">Bảo hành chính hãng</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="infor-supplemnet">
                                <ul class="infor-supplemnet__list">
                                    <li class="infor-supplemnet__title">Thông tin chi tiết</li>
                                    {{-- <li class="infor-supplemnet__item">
                                        <p class="infor-supplemnet__item-name">Thương hiệu</p>
                                        <p class="infor-supplemnet__item-value">Apple</p>
                                    </li> --}}
                                    <li class="infor-supplemnet__item">
                                        <p class="infor-supplemnet__item-name">Xuất xứ thương hiệu</p>
                                        <p class="infor-supplemnet__item-value">Mỹ</p>
                                    </li>
                                    <li class="infor-supplemnet__item">
                                        <p class="infor-supplemnet__item-name">Kích thước</p>
                                        <p class="infor-supplemnet__item-value">Dài 259.9 mm - Ngang 276.7mm - Dày 28.25mm</p>
                                    </li>
                                    {{-- <li class="infor-supplemnet__item">
                                        <p class="infor-supplemnet__item-name">Chất liệu</p>
                                        <p class="infor-supplemnet__item-value">Khung Titan & Mặt lưng kính cường lực</p>
                                    </li> --}}
                                    <li class="infor-supplemnet__item">
                                        <p class="infor-supplemnet__item-name">Xuất xứ (Made in)</p>
                                        <p class="infor-supplemnet__item-value">Trung Quốc</p>
                                    </li>
                                    <li class="infor-supplemnet__item">
                                        <p class="infor-supplemnet__item-name">Trọng lượng sản phẩm</p>
                                        <p class="infor-supplemnet__item-value">221 g</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col l-3 m-4 c-12 c-order-1">
                        <div class="trade">
                            {{-- <div class="trade-brand">
                                <img class="trade-brand__img" src="assets/img/tiki_trade.png" alt="trade">
                                <div class="trade-brand__name">
                                    <div class="trade-brand-name__offical">
                                        Tiki Trading
                                        <img class="trade-brand-name__offical-img" src="assets/img/offical.png" alt="offical">
                                    </div>
                                    <p class="trade-brand-name__evaluate">
                                        <ul class="item-product-infor__evaluate">
                                            4.7
                                            <li class="item-product-infor-evaluate__star">
                                                <i class="fa-solid fa-star"></i>
                                                
                                            </li>
                                            <li class="item-product-infor-evaluate__saled">(5.4tr+ đánh giá)</li>
                                        </ul>
                                    </p>
                                </div>
                            </div> --}}
                            <form class="trade-action" id="formTool">

                                {{-- <div class="trade-action__name">
                                    <img class="trade-action__name-img" src="assets/img/{{ $dungCu->hinhAnh1 }}" alt="iphone15">
                                    Titan Xanh, 256GB
                                </div> --}}
                                <div class="quantity">
                                    <h1 class="quantity__title">Số lượng</h1>
                                    <div class="quantity__button">
                                        <p class="quantity__button-descrease quantity__button--disable" onclick="descreasingQuantity()">
                                            -
                                        </p>
                                        <input type="text" class="quantity__button-number" value="1" name="soLuong" onchange="enterQuantity()">
                                        <p class="quantity__button-increase" onclick="increasingQuantity()">
                                            +
                                        </p>
                                    </div>
                                </div>
                                <div class="price">
                                    <h1 class="price__title">
                                        Tạm tính
                                    </h1>
                                    <div style="display: flex">
                                        <input type="text" name="totalPrice" value="{{number_format($dungCu->donGiaGoc, 0, ',', '.')}}₫" style="outline: none;" class="price__total" >
                                    </div>
                                </div>
                                <div class="action">
                                    <input type="text" name="maDungCu" value="{{ $dungCu->maDungCu }}" style="display: none">
                                    <input type="text" name="maNguoiDung" value=" {{ Auth::user()->maNguoiDung }} " style="display: none">
                                    <input class="action__cart form-submit" type="submit" value="Thêm vào giỏ" style="background: white; color: var(--primary-color)">
                                </div>
                            </form>
                            {{-- @if(Auth::check())
                                <form  action="{{ route('addCartToDelivery') }}" method="POST">
                                    <input type="hidden" name="product_id" value=" {{ $dungCu->maDungCu  }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="totalPrice" value="{{ $dungCu->donGiaGoc  }}">
                                    <input type="hidden" class="quantity__button-number" value="1" name="quantity">
                                    <input class="action__pay" type="submit" value="Mua ngay" style="text-align:center; width: 100%">
                                </form>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Components.footer')
    </div>
</body>
<script>
    const inputQuantityView = document.querySelector('.quantity__button-number')
    const descreasingButtonView = document.querySelector('.quantity__button-descrease')
    const priceToTalView = document.querySelector('.price__total')
    const priceView = document.querySelector('.product__price')
    const apiGioHang = 'http://127.0.0.1:8000/api/giohang'
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        function descreasingQuantity(){
            if(inputQuantityView.value > 1){
                inputQuantityView.value = parseInt(inputQuantityView.value) - 1
                priceToTalView.value = formatCurrency(parseInt(priceView.innerText.replace(/\D/g, '')) * parseInt(inputQuantityView.value))
                if(inputQuantityView.value == 1)
                    descreasingButtonView.classList.add('quantity__button--disable')
            }
        }
        function increasingQuantity(){
            inputQuantityView.value = parseInt(inputQuantityView.value) + 1
            priceToTalView.value = formatCurrency(parseInt(priceView.innerText.replace(/\D/g, '')) * parseInt(inputQuantityView.value))
            descreasingButtonView.classList.remove('quantity__button--disable')
        }
        function enterQuantity(){
            const value = parseInt(inputQuantityView.value)
            if(value >= 1)
                inputQuantityView.value = value
            else
                inputQuantityView.value = 1
            priceToTalView.value = formatCurrency(parseInt(priceView.innerText.replace(/\D/g, '')) * parseInt(inputQuantityView.value))
            if(inputQuantityView.value == 1)
                descreasingButtonView.classList.add('quantity__button--disable')
            else
                descreasingButtonView.classList.remove('quantity__button--disable')
        }
        Validator({
            form: "#formTool",
            rules: [
            ],
            errorSelector: ".form-message",
            buttonSubmitSelector: ".form-submit",
            // Muốn submit không theo API mặc định của trình duyệt
            onSubmit: function (data) {
                console.log(data)
                addToCart(data)
            },
            formGroupSelector: ".form-group",
        })
        function formatCurrency(input) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(input);
        }
        function addToCart(dataRow){
            fetch(apiGioHang)
                .then(promise => promise.json())
                .then(data => {
                    data = data.filter((giohang)=> {
                        return giohang.maNguoiDung == dataRow.maNguoiDung
                    })
                    console.log(data)
                    let isExistTool = data.every((giohang)=>{
                        return giohang.maDungCu !== dataRow.maDungCu 
                    })
                    if(isExistTool){
                        fetch(apiGioHang,{
                            method: "post",
                            headers: {
                                "Content-type": 'application/json',
                                "X-csrf-token": token
                            },
                            body: JSON.stringify({"maNguoiDung": dataRow.maNguoiDung, "maDungCu": dataRow.maDungCu, "soLuong": dataRow.soLuong})
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