<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    @include('Library.grid_system')
    @include('Library.responsive')
    @include('Library.variable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .trade, .all-product, .all-product-detail {
        background-color: white;
        border-radius: 8px;
        padding: 16px 0;
        }

        .trade-action__name {
        display: flex;
        align-items: center;
        }

        .trade-action {
        padding: 16px;
        border-top: 1px solid #ededf1;
        }

        .trade-action__name-img {
        width: 40px;
        height: 40px;
        }

        .name-desc {
        font-size: 14px;
        }

        .desc {
        color: #808089;
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        visibility: hidden;
        }

        .price {
        margin-top: 16px;
        }

        .price__title {
        font-weight: bold;
        }

        .price__total {
        font-size: 24px;
        color: #ff424e;
        }

        .action {
        margin-top: 16px;
        display: flex;
        flex-direction: column;
        }

        .action__pay {
        padding: 8px;
        height: 40px;
        border-radius: 4px;
        font-size: 16px;
        margin-top: 8px;
        background-color: #ff424e;
        color: white;
        border: none;
        }

        .all-product {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        color: #787878;
        margin: 8px 0;
        }

        .all-product ~ .all-product {
        margin-top: 8px;
        }

        .all-product__title {
        margin-left: 8px;
        }

        .all-product__first, .all-product__second {
        display: flex;
        align-items: center;
        flex: 1;
        }

        .all-product__second {
        justify-content: space-around;
        }

        .all-product-detail {
        margin-top: 8px;
        }

        .product {
        width: 100%;
        display: flex;
        }

        .product-infor, .product-pay {
        display: flex;
        flex: 1;
        align-items: center;
        }

        .product-infor__img {
        width: 80px;
        margin: auto;
        }

        .product-pay {
        justify-content: space-around;
        }

        .product__price {
        font-weight: bold;
        }

        .product__quantity {
        display: flex;
        }

        .product__quantity-descrease, .product__quantity-increase {
        padding: 0 8px;
        width: 24px;
        color: rgb(170, 165, 165);
        }

        .product__quantity-descrease {
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
        }
        .product__quantity-number--descrease, .product__quantity-number--increase, .product__quantity-number {
            border: 1px solid rgb(200, 200, 200);
            text-align: center;
            width: 32px;
            height: 32px;
        }
        .product__quantity-number--descrease-disable {
            opacity: 0.5;
            cursor:not-allowed;
        }
        .product__quantity-number {
        outline: none;
        width: 32px;
        }


        .product__quantity-increase {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
        }

        .product__money {
        color: #ff424e;
        }
        td {
            text-align: center;
        }
        th {
            flex: 1;
            text-align: center;
        }
        .container {
            margin: 90px 0 0;
            background: rgb(245 245 249);
            padding-bottom: 40px;
            min-height: 366px;
        }
        .fa-trash-can:hover {
            color: red;
            cursor: pointer
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
                    breadCrumbHeading.innerText = 'Giỏ hàng dụng cụ'
                </script>
                <div class="row content">
                    @if (count($gioHang) == 0)
                        <?php echo    
                            '<div style="width: 100%; text-align: center; margin: 96px 0;">         
                                <img src="assets/img/empty-cart.jpg" width="70px" height="70px" alt="empty" style="margin: auto">
                                <p>Hiện chưa có sản phẩm nào trong giỏ hàng. Quay trở lại trang dụng cụ <strong><a href="/muadungcu" style="color: red">Tại dây</a></strong></p>
                            </div>
                            '; ?>
                    @else
                        <div class="row">
                            <table class="col l-9 m-9 c-12">
                                <thead class="all-product">
                                    <tr style="display: flex; width: 100%">
                                        <th>
                                            <input type="checkbox" id="allCheckbox">
                                        </th>
                                        <th colspan="2">
                                            <label class="all-product__title" for="checked-all-product">Tất cả</label>
                                        </th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền </th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="all-product-detail">
                                    <?php
                                        $totalPay = 0;
                                    ?>
                                        @foreach ($gioHang as $item)
                                            @php
                                                $product = \App\Models\DungCu::where('maDungCu', $item->maDungCu)->first();
                                                
                                                $numericPriceString = preg_replace("/[^0-9]/", "", $product->donGiaGoc);
                                                $totalPrice = intval($numericPriceString)*$item->soLuong;
                                            @endphp
                            
                                            <tr class="product" style="align-items: center">
                                                <td style="flex: 1">
                                                    <input type="checkbox" class="checkbox_item" data-set="{{ $totalPrice }}" onclick="calculatorMoney(this,{{ $totalPrice }})">
                                                </td>
                                                {{-- <a href="{{ route('product.detail',$item->id) }}" class="product-infor"> --}}
                                                    {{-- <input type="checkbox" class="product-checkbox" onclick="choosePay()"> --}}
                                                <td style="flex: 1">
                                                    <img class="product-infor__img" src="{{ asset('assets/img/' . $product->hinhAnh1) }}" alt="img">
                                                    
                                                    <div class="name-desc" style="margin-left: 8px">
                                                        <a class="name" href="/product/{{ $product->maDungCu }}" target="_blank">{{ $product->tenDungCu }}</a>
                                                        <p class="desc">{{ $product->moTa }}</p>
                                                    </div>
                                                </td>
                                                    {{-- <p class="product__price">{{ number_format( intval($product->price), 0, ',', '.') }}</p> --}}
                                                <td class="product__price" style="flex: 1">{{number_format($product->donGiaGoc, 0, ',', '.')}}<sup>₫</sup></td>
                                                <td class="" style="flex: 1">
                                                    @if($item->soLuong === 1)
                                                        <button class="product__quantity-number--descrease product__quantity-number--descrease-disable" onclick="descreaseQuantity(this,'{{ $item->id }}')">-</button>
                                                    @else
                                                        <button class="product__quantity-number--descrease" onclick="descreaseQuantity(this,'{{ $item->id }}')">-</button>
                                                    @endif
                                                    <input class="product__quantity-number" type="text" name="quantity" value="{{ $item->soLuong }}" onchange="enterQuantity(this,'{{ $item->id }}')">
                                                    <button class="product__quantity-number--increase" onclick="increaseQuantity(this,'{{ $item->id }}')">+</button>
                                                </td>
                                                {{-- <td class="product__money" style="flex: 1">{{ number_format($totalPrice, 0, ',', '.') }}<sup>₫</sup></td> --}}
                                                <td class="product__money" style="flex: 1">{{ number_format($totalPrice, 0, ',', '.') }}<sup>₫</sup></td>
                                                
                                                {{-- <a href="{{ route('deleteCart',$item->id) }}"><i class="fa-solid fa-trash-can"></i></a> --}}
                                                <td onclick="deleteItem('{{ $item->id }}')" style="flex: 1"><i class="fa-solid fa-trash-can"></i></td>
                                            </tr>
                                            <?php 
                                            // $totalPay += $totalPrice
                                            ?>
                                        @endforeach
                                </tbody>
                            </table>
                            <div class="col l-3 m-3 c-12" style="margin-top: 12px">
                                <div class="trade">
                                    <div class="trade-action">
                                        <div class="price">
                                            <h1 class="price__title">
                                                Tổng tiền
                                            </h1>
                                            <div class="price__total">
                                                {{-- {{ number_format($totalPay, 0, ',', '.') }} --}}
                                                0
                                                <sup>₫</sup>
                                            </div>
                                        </div>
                                        <div class="action">
                                            <a class="action__pay" style="text-align: center; cursor: pointer">
                                                Mua ngay
                                            </a>
                                            {{-- <button class="action__buy"  onclick="showLogin()">
                                                Mua trả góp - trả sau
                                            </button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @include('Components.footer')
    </div>
</body>
    <script>
        const quantityInputView = document.querySelector('.product__quantity-number')
        const allCheckboxView = document.querySelector('#allCheckbox')
        const checkboxItemsView = document.querySelectorAll('.checkbox_item')
        const priceTotalView = document.querySelector('.price__total')
        let totalPriceGlobal = 0
        let allChecked = false;
        allCheckboxView.onclick = ()=>{
            allChecked = !allChecked
            checkboxItemsView.forEach(element => {
                if(allCheckboxView.checked !== element.checked){
                    element.checked = allChecked;
                    if(allChecked)
                        totalPriceGlobal += parseInt(element.dataset.set)
                    else
                        totalPriceGlobal -= parseInt(element.dataset.set)
                }
            });
            priceTotalView.innerText = formatCurrency(totalPriceGlobal)
        }
        function formatCurrency(input) {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(input);
        }
        function calculatorMoney(input, totalPriceOfItem){
            if(input.checked)
                totalPriceGlobal += totalPriceOfItem
            else
                totalPriceGlobal -= totalPriceOfItem
            priceTotalView.innerText = formatCurrency(totalPriceGlobal)
        }
        function descreaseQuantity(buttonDescreaseView, maGioHang){
            const quantityInput = buttonDescreaseView.nextElementSibling
            if(quantityInput.value > 1){
                quantityInput.value = parseInt(quantityInput.value) - 1
                enterQuantity(quantityInput, maGioHang)
                if(parseInt(quantityInput.value) == 1)
                    buttonDescreaseView.classList.add('product__quantity-number--descrease-disable')
            }
            else
                buttonDescreaseView.classList.add('product__quantity-number--descrease-disable')    
        }
        function increaseQuantity(buttonIncreaseView, maGioHang){
            const quantityInput = buttonIncreaseView.previousElementSibling
            const buttonDescreaseView = quantityInput.previousElementSibling
            buttonDescreaseView.classList.remove('product__quantity-number--descrease-disable')
            quantityInput.value = parseInt(quantityInput.value) + 1
            enterQuantity(quantityInput, maGioHang)
        }
        const apiGioHang = 'http://127.0.0.1:8000/api/giohang'
        function enterQuantity(inputQuantityView, maGioHang){
            fetch(apiGioHang+"/"+maGioHang,{
                method: 'put',
                headers: {
                    'content-type': 'application/json',
                    'x-csrf-token': token
                },
                body: JSON.stringify({'soLuong': inputQuantityView.value})
            })
                .then(promise => promise.json())
                .then(data => {
                    if(data.success){
                        toastr.success(data.success)
                        window.location.href = "/giohang"
                    }
                    else
                        toastr.error(data.error)
                })
        }
        const token = document.querySelector("meta[name='csrf-token']").getAttribute('content')
        function deleteItem(maGioHang){
            fetch(apiGioHang + "/" + maGioHang,{
                method: 'delete',
                headers: {
                    'X-csrf-token': token,
                    'content-type': 'application/json'
                }
            })
                .then(promise => promise.json())
                .then(data => {
                    if(data.success){
                        toastr.success(data.success)
                        window.location.href = "/giohang"
                    }
                    else
                        toastr.error(data.error)
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