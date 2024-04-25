<!DOCTYPE html>
<html lang="en">
<head>

    @include('Library.grid_system')
    @include('Library.responsive')
    @include('Library.variable')
    @include('Library.validator')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    <style>
        .image {
            margin-top: 20px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        img.coverimage {
            width: 100%;
            object-fit: cover;
            opacity: 0.5;
        }
        .avatar {
            position: absolute;
            width: 168px;
            height: 168px;
        }
        
        img.over-image {
            border-radius: 50%;
            border: 2px solid white;
            object-fit: cover;
            height: 100%;
        }
        .choose-avatar {
            position: absolute;
            bottom: 0px;
            right: 20px;
            color: white;
            background: #3a3b3c;
            height: 36px;
            line-height: 36px;
            width: 36px;
            text-align: center;
            border-radius: 50%;
            cursor: pointer;
        }
        .choose-avatar:hover {
            background: #6c6c6c;
        }
        .fullname {
            text-align: center;
            color: black;
        }
        .content {
            margin-top: 8px;
        }
        .side-bar__item-link {
            
            background: white;
            color:  var(--primary-color);
            padding: 12px 8px;
            display: block;
            cursor: pointer;
            border: 1px solid;
            border-radius: 8px; 
        }
        .side-bar__item + .side-bar__item {
            margin-top: 8px;
        }
        .side-bar__item-link--active,.side-bar__item-link:hover {
            
            background: var(--primary-color);
            color: white;
        }
        
        .main {
            background: white;
            min-height: unset;
            justify-content: flex-start;
            flex-direction: column
        }
        .form {
            box-shadow: unset;
            width: 100%;
            padding: 0 24px;
        }
    </style>
    {{-- CSS container --}}
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
        text-align: center;
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
        .btn-golden {
        text-align: center;
        margin: auto;
        }

        .btn-golden {
            margin-top: 12px; 
            text-decoration: none;
            color: #fff;
            background-color: #ffc107;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-golden:hover {
        background-color: #ffca2c;
        }
        .bound-pay {
            color: red; /* Thiết lập màu chữ là đỏ */
            /* display: flex;
            flex-direction: column;
            align-items: center; */
        }

        .bound-pay .form-message {
            text-align: center;
        }

        .bound-pay .btn-recharge {
            display: inline-block;
            background: var(--primary-color);
            width: fit-content;
            padding: 8px 12px;
            border-radius: 4px;
            color: white; /* Thiết lập màu chữ là đỏ */
            text-decoration: none; /* Loại bỏ gạch chân */
            margin-top: 10px; /* Khoảng cách giữa các phần tử con */
        }
        select.filter {
            border: 1px solid black;
            transform: translateX(-50%);
            position: relative;
            left: 50%;
        }
    </style>

</head>
    <body>
        <div class="grid">
            @include('Components.header')
            
            <div class="container">
                <div class="grid wide" >
                    @include('Components.breadcrumb')
                    <script>
                        breadCrumbHeading.innerText = 'Ví'
                    </script>
                    <div class="row content no-gutters">
                        <div class="col l-12 m-12 c-12">
                            <div class="main" id="main">
                                <form action="{{ url('/vnpay_payment') }}" method="POST" class="form" id="form-recharge" target="_blank">
                                    @csrf
                                    <p class="desc" >
                                        <img src="assets/img/vnpay.png" alt="VNPay" style="margin: auto">
                                    </p>
                                    <div class="spacer"></div>
                                    <div class="form-group">
                                        <p class="form-label">Số dư tài khoản: <i style="color: var(--primary-color)">{{ number_format(Auth::user()->soDuTaiKhoan , 0, ',', '.') }} <sup>đ</sup></i></p>
                                    </div>
                                    <div class="form-group">
                                      <label for="soTien" class="form-label">Số tiền</label>
                                      <input
                                        id="soTien"
                                        name="soTien"
                                        type="number"
                                        placeholder="Ví dụ: hai trăm nghìn VND - 200000"
                                        min="50000"
                                        step="50000"
                                        class="form-control"
                                        required
                                      />
                                      <span class="form-message"></span>
                                    </div>
                                    
                                    <button type="submit" name="redirect" class="form-submit">Nạp</button>
                                </form>
                                <form method="POST" class="form" id="form-infor">
                                    <h3 class="heading"><strong>Lịch sử giao dịch</strong></h3>
                                    <select class="filter">
                                        <option value="Tất cả giao dịch">Tất cả giao dịch</option>
                                        <option value="Thanh toán">Thanh toán</option>
                                        <option value="Nạp tiền">Nạp tiền</option>
                                        <option value="Hoàn tiền">Hoàn tiền</option>
                                    </select>
                                    <div class="table_desc">
                                        <div class="table_page table-responsive">
                                            <table>
                                                <thead>
                                                <tr>
                                                    {{-- <th class="product_remove">Trạng thái</th> --}}
                                                    <th class="product_thumb">Mã giao dịch</th>
                                                    <th class="product_name">Nội dung chuyển khoản</th>
                                                    <th class="product-date">Số tiền</th>
                                                    <th class="product_quantity">Thời gian</th>
                                                    <th class="product_quantity">Trạng thái</th>
                                                    {{-- <th class="product_total">Tổng</th> --}}
                                                </tr>
                                                </thead>
                                                <tbody id="lichSuGiaoDich">
                                                        @foreach ($lichSuGiaoDich as $item)
                                                            <tr id="item-">
                                                                <td class="product_thumb">
                                                                    @if(isset($item->transID))
                                                                        {{ $item->transID }}
                                                                    @else
                                                                        {{ $item->id }}
                                                                    @endif
                                                                </td>
                                                                <td class="product_name">
                                                                    {{ $item->ndck }}
                                                                </td>
                                                                <td class="product-date">
                                                                    {{ number_format($item->soTien, 0, ',', '.') }}<sup>₫</sup>
                                                                </td>
                                                                
                                                                <td class="product_total yard-note" style="text-align: center">
                                                                    {{
                                                                        \DateTime::createFromFormat('Y-m-d H:i:s', $item->thoiGian)->format('d-m-Y H:i:s') }}
                                                                </td>
                                                                <td class="product_total">
                                                                    @if($item->trangThai)
                                                                        <p style="color: green">Thành công</p>
                                                                    @else
                                                                        <p style="color: red">Thất bại</p>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <p class="">
                                        <strong>Lưu ý: </strong>Nếu giao dịch thất bại hãy liên hệ cho chúng tôi qua số điện thoại: <span style="color: var(--primary-color)">0899378634</span>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('Components.footer')
        </div>
    </body>
    <script>
    //     Validator({
    //     form: "#form-recharge",
    //     rules: [
    //     //   Validator.isRequired("#soTien", "Quý khách vui lòng nhập số tiền"),
    //     //   Validator.minMoney("#soTien", 50000),
    //     ],
    //     errorSelector: ".form-message",
    //     buttonSubmitSelector: ".form-submit",
    //     // Muốn submit không theo API mặc định của trình duyệt
    //     // onSubmit: function (data) {
    //     //   // fetch API
    //     //   console.log(data);
    //     // },
    //     formGroupSelector: ".form-group",
    //   });
        var filterView = document.querySelector('.filter')
        var tableLichSuGiaoDichView = document.getElementById('lichSuGiaoDich')
        var dataLSDG
        var dataThanhToanLSGD
        var dataNapTienLSGD
        var dataHoanTienLSGD
        filterView.onchange = ()=>{
            hanldeLichSuGiaoDich(filterView.value)
        }
        function hanldeLichSuGiaoDich(value){
            tableLichSuGiaoDichView.innerHTML = ""
            switch(value){
                case "Tất cả giao dịch":
                    if(!dataLSDG){
                        getLichSuGiaoDich(data => {
                            dataLSDG = data
                            renderLichSuGiaoDich(dataLSDG)
                        });
                    }
                    else
                        renderLichSuGiaoDich(dataLSDG)
                    break;
                case "Nạp tiền":
                    if(!dataNapTienLSGD){
                            getLichSuGiaoDich(data => {
                                dataNapTienLSGD = data.filter((LSGD)=>{
                                    return LSGD.loaiGD === 1
                                })
                                renderLichSuGiaoDich(dataNapTienLSGD)
                            });
                    }
                    else
                        renderLichSuGiaoDich(dataNapTienLSGD)
                    break;
                case "Thanh toán":
                    if(!dataThanhToanLSGD){
                                getLichSuGiaoDich(data => {
                                    dataThanhToanLSGD = data.filter((LSGD)=>{
                                        return LSGD.loaiGD === 2
                                    })
                                    renderLichSuGiaoDich(dataThanhToanLSGD)
                                });
                    }
                    else
                        renderLichSuGiaoDich(dataThanhToanLSGD)
                    break;
                case "Hoàn tiền":
                    if(!dataHoanTienLSGD){
                                getLichSuGiaoDich(data => {
                                    dataHoanTienLSGD = data.filter((LSGD)=>{
                                        return LSGD.loaiGD === 3
                                    })
                                    renderLichSuGiaoDich(dataHoanTienLSGD)
                                });
                    }
                    else
                        renderLichSuGiaoDich(dataHoanTienLSGD)
                    break;
            }
        }
        function getLichSuGiaoDich(callback){
            let maNguoiDung = "{{ Auth::user()->maNguoiDung }}"
            fetch("http://127.0.0.1:8000/api/lichsugiaodich")
                .then(response => response.json())
                .then(data => {
                    data = data.filter((LSGD)=>{
                        return LSGD.maNguoiDung == maNguoiDung
                    })
                    return data
                })
                .then(callback)
        }
        function renderLichSuGiaoDich(data){
            data.forEach((LSGD)=>{
                tableLichSuGiaoDichView.innerHTML +=     `
                                                        <tr id="item-">
                                                            <td class="product_thumb">
                                                                ${LSGD.transID?LSGD.transID:LSGD.id}
                                                            </td>
                                                            <td class="product_name">
                                                                ${LSGD.ndck}
                                                            </td>
                                                            <td class="product-date">
                                                                ${formatCurrency(LSGD.soTien)}<sup>₫</sup>
                                                            </td>
                                                            
                                                            <td class="product_total yard-note" style="text-align: center">
                                                                ${formatDate(LSGD.thoiGian)}
                                                            </td>
                                                            <td class="product_total">
                                                                ${LSGD.trangThai?`<p style="color: green">Thành công</p>`:`<p style="color: red">Thất bại</p>`}
                                                            </td>
                                                        </tr>
                                                    `
            })
        }
        function formatCurrency(input) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(input);
        }
        function formatDate(dateTimeString) {
        // Chia chuỗi thành các phần
            const parts = dateTimeString.split(' ');

            // Lấy phần ngày, tháng, năm
            const datePart = parts[0];
            const [year, month, day] = datePart.split('-');

            // Lấy phần giờ, phút, giây
            const timePart = parts[1];
            const [hours, minutes, seconds] = timePart.split(':');

            // Định dạng lại thành "dd-mm-yyyy hh:mm:ss"
            const formattedDate = `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
            
            return formattedDate;
        }
        
    </script>
    {{-- @if (session('json_message'))
        <script>toastr.success("{{ session('json_message') }}")</script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
</html>