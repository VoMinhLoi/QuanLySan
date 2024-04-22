<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('Library.grid_system')
    @include('Library.responsive')
    @include('Library.variable')
    {{-- CSS container --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Định dạng nội dung của bảng */
        .table_desc {
            margin: 12px 0;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        }

        /* Định dạng các phần tử bảng */
        .table_desc table {
        width: 100%;
        border-collapse: collapse;
        }

        .table_desc th,
        .table_desc td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        }

        /* Định dạng hàng chẵn */
        .table_desc tr:nth-child(even) {
        background-color: #f2f2f2;
        }

        /* Định dạng input checkbox */
        .table_desc input[type="checkbox"] {
        margin: 0;
        padding: 0;
        }

        /* Định dạng hình ảnh sản phẩm */
        .table_desc .product_thumb img {
        width: 100px;
        height: auto;
        }

        /* Định dạng nút mở rộng */
        .table_desc .fa-plus {
        color: green;
        }

        /* Định dạng nút xoá */
        .table_desc .fa-trash {
        color: red;
        }

        /* Định dạng các link */
        .table_desc a {
        text-decoration: none;
        color: inherit;
        }

        /* Định dạng phần thông báo đặc biệt */
        .table_desc p {
        color: red;
        margin: 0;
        }
        /* Định dạng nội dung của mã giảm giá */
        .coupon_code {
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        }

        /* Định dạng tiêu đề */
        .coupon_code h3 {
        font-size: 20px;
        margin-bottom: 10px;
        }

        /* Định dạng nội dung bên trong */
        .coupon_inner {
        display: flex;
        flex-direction: column;
        }

        /* Định dạng các phần tử trong nội dung */
        .coupon_inner > * {
        margin-bottom: 10px;
        }

        /* Định dạng các phần tử trong giỏ hàng */
        .cart_subtotal {
        display: flex;
        justify-content: space-between;
        }

        .cart_subtotal p {
        margin: 0;
        }

        /* Định dạng nút Calculate shipping */
        .coupon_inner a {
        text-decoration: none;
        color: #007bff;
        }

        .coupon_inner a:hover {
        text-decoration: underline;
        }

        /* Định dạng nút thanh toán */
        .checkout_btn {
        text-align: center;
        }

        .checkout_btn a {
        text-decoration: none;
        color: #fff;
        background-color: #ffc107;
        padding: 10px 20px;
        border-radius: 5px;
        }

        .checkout_btn a:hover {
        background-color: #ffca2c;
        }
        .empty-cart-container {
            text-align: center;
            margin-bottom: 100px;
        }

        .empty-cart-container .image {
            margin-bottom: 20px;
        }

        .empty-cart-container .title {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .empty-cart-container .sub-title {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        .empty-cart-container a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
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
                    breadCrumbHeading.innerText = 'Túi'
                </script>
                <div class="row content">
                    <div class="col l-12 m-12 c-12">
                        @php
                            $maNguoiDung = Auth::user()->maNguoiDung;
                            $sportFieldQuantity = App\Models\ThueSan::where('maNguoiDung', $maNguoiDung)->count();
                        @endphp
                        @if($sportFieldQuantity == 0)
                            <div class="empty-cart-container" style="margin-bottom: 100px;">
                                <div class="image" style="text-align: center; width: 100px; height: 100px; margin: auto;">
                                    <img class="img-fluid" src="assets/img/empty-cart.jpg"  alt="">
                                </div>
                                <h4 class="title">Túi trống</h4>
                                <h6 class="sub-title">Không có vé sân nào trong túi</h6>
                                <a href="/sanbong" class="">Quay trở lại đặt sân</a>
                            </div>
                        
                        @else
                            <div class="table_desc">
                                <div class="table_page table-responsive">
                                    <h3 class="m-5">Thuê sân</h3>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="product_remove">Trạng thái</th>
                                            <th class="product_thumb">Hình Ảnh</th>
                                            <th class="product_name">Tên</th>
                                            <th class="product-date">Thời gian nhận</th>
                                            <th class="product_quantity">Thời gian trả</th>
                                            <th class="product_quantity">Giá</th>
                                            <th class="product_total">Tổng</th>
                                            <th class="product_remove">#</th>
                                        </tr>
                                        </thead>
                                        <tbody id="cartUpdate">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="coupon_code -aos-delay="400">
                                <h3>Giá trị thanh toán</h3>
                                <div class="coupon_inner">
                                    <div class="cart_subtotal">
                                        <p>Tổng tiền</p>
                                        <p class="cart_amount" id="cartSub">0 VNĐ</p>
                                    </div>
                                    <div class="checkout_btn">
                                        <a href="/checkout" class="btn btn-md btn-golden">Tiến hành thanh toán</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @include('Components.footer')
    </div>
    
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var apiThueSan = "http://127.0.0.1:8000/api/thuesan"
        var borrowHour = 1
        start()
        function start(){
            getThueSan(thueSans => {
                renderCart(thueSans)
            })
        }
        function getThueSan(callback){
            fetch(apiThueSan)
                .then(promise => promise.json())
                .then(callback)
            }
        function renderCart(thueSans){
            var tableBody = $('#cartUpdate')
            var apiSanBong = "http://127.0.0.1:8000/api/sanbong"
            thueSans.forEach((thueSan) => {
                fetch(apiSanBong+"/"+thueSan.maSan)
                    .then(response => response.json())
                    .then(sanBong => {
                        tableBody[0].innerHTML +=   `
                                                <tr id="item-${thueSan.id}">
                                                    <td class="product_remove"><input type="checkbox" class="checkboxselect"></td>
                                                    <td class="product_thumb">
                                                        <a><img src="assets/img/${sanBong.hinhAnh}.jpg" style="width: 100px; height: 66px; object-fit: cover;"></a>
                                                    </td>
                                                    <td class="product_name">
                                                        <a href="/productDetails?id=">
                                                            ${thueSan.thu ? `<p style="color:red">Thuê chu kì ${thueSan.ngay} ngày vào mỗi thứ ${formatThu(thueSan.thu)} <br> Bắt đầu từ: ${formatDate(thueSan.thoiGianBatDau)}</p>` : sanBong.tenSan}
                                                        </a>
                                                    </td>
                                                    ${thueSan.thu ? `<td class="product-date">${formatHour(thueSan.thoiGianBatDau)}</td>` : `<td class="product-date">${thueSan.thoiGianBatDau}</td>`}
                                                    ${thueSan.thu ? `<td class="product-date">${formatHour(thueSan.thoiGianKetThuc)}</td>` : `<td class="product-date">${thueSan.thoiGianKetThuc}</td>`}
                                                    <td class="product_total">
                                                        ${formatCurrency(sanBong.giaDichVu)}
                                                    </td>
                                                    <td class="product_total">
                                                        ${thueSan.ngay ? calculatorMoney(thueSan.ngay,thueSan.thu,thueSan.thoiGianBatDau,thueSan.thoiGianKetThuc,sanBong.giaDichVu) : calculatorMoney(null,null,thueSan.thoiGianBatDau,thueSan.thoiGianKetThuc,sanBong.giaDichVu)}
                                                    </td>
                                                    <td class="product_remove">
                                                        <a href="" class="a-disable" onclick="toggleSubRow(this, '', 'SB00001', '2024-04-15 16:00:00', '2024-04-15 17:00:00','')">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                        <button href="" class="a-disable delCart" onclick="deleteOutBag(${thueSan.id})"><i class="fa-solid fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            `;
                    })
            })
        }
        function formatThu(thuArray) {
            var template = thuArray.split(',');
            var chuNhat;
            if (template.includes("8")) // Sửa thành template.includes("8") để kiểm tra xem mảng có chứa số 8 hay không
                chuNhat = "chủ nhật";

            // Sử dụng phương thức filter() để lọc ra các số khác 8
            var string = template.filter(thu => thu !== "8").join(', ');

            if (chuNhat)
                string += ', ' + chuNhat; // Thêm vào chuỗi nếu có chủ nhật

            return string; // Trả về chuỗi sau khi đã được format
        }
        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = date.getDate();
            const month = date.getMonth() + borrowHour;
            const year = date.getFullYear();
            return `${day < 10 ? '0' + day : day}-${month < 10 ? '0' + month : month}-${year}`;
        }
        function formatHour(dateString) {
            const date = new Date(dateString);
            const hour = date.getHours();
            return `${hour}:00:00`;
        }
        function calculatorMoney(ngay, thu, thoiGianBatDau, thoiGianKetThuc, giaDichVu){
            var totalPrice
            if(ngay){
                var soNgay
                var week
                if(ngay == 28)
                    week = 4
                else
                    if(ngay == 21)
                        week = 3
                    else
                        if(ngay == 14)
                            week = 2
                        else
                            week = 1
                thu = thu.split(',').length
                soNgay = week * thu 
                borrowHour = tinhKhoangCach(thoiGianBatDau, thoiGianKetThuc)
                hourToDate = borrowHour/24
                borrowDateTotal = hourToDate + soNgay
                dateToHour = borrowHour*soNgay

                totalPrice = giaDichVu * dateToHour
                if(borrowDateTotal >= 28)
                    totalPrice *= 0.8
                else
                    if(borrowDateTotal >=21)
                        totalPrice *= 0.6
                    else
                        if(borrowDateTotal >=14)
                            totalPrice *= 0.6
                        if(borrowDateTotal >=7)
                            totalPrice *= 0.4
            }
            else {
                hour = tinhKhoangCach(thoiGianBatDau, thoiGianKetThuc)
                totalPrice = hour*giaDichVu
            }
            return formatCurrency(totalPrice)
        }
        function tinhKhoangCach(gioBatDau, gioKetThuc) {
            // Chuyển đổi thời gian thành đối tượng Date
            var batDau = new Date(gioBatDau);
            var ketThuc = new Date(gioKetThuc);
            
            // Tính toán khoảng cách thời gian (tính bằng mili giây)
            var khoangCachMiliseconds = ketThuc - batDau;
            
            // Chuyển đổi khoảng cách từ mili giây thành giờ
            var khoangCachGio = khoangCachMiliseconds / (1000 * 60 * 60);
            
            return khoangCachGio;
        }
        

        function parseCurrency(input) {
            return parseFloat(input.replace(/[^\d]/g, ''));
        }
        function deleteOutBag(maBag){
            if (confirm("Bạn có chắc chắn muốn xóa không?")) {
                fetch(apiThueSan+"/"+maBag,{
                    method: 'Delete',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.error)
                        toastr.error(data.error)
                    else
                        toastr.success(data.success)
                })
                var nameQuery = '#' + "item-" + maBag;
                var sanBongRowView = $(nameQuery);
                sanBongRowView.remove();
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>