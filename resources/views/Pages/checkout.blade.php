<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('Library.grid_system')
    @include('Library.responsive')
    @include('Library.variable')
    @include('Library.validator')
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
            padding: 32px 24px 0px; 
        }
    </style>
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
            display: flex;
            justify-content: center;
            align-items: center;
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
    </style>
</head>
<body>
    <div class="grid">
        @include('Components.header')
        
        <div class="container">
            <div class="grid wide" >
                @include('Components.breadcrumb')
                <script>
                    breadCrumbHeading.innerText = 'Vé'
                </script>
                <div class="row content no-gutters">
                    <div class="col l-12 m-12 c-12">
                        <div class="main" id="main">
                            <form method="POST" class="form" id="form-infor">
                                <h3 class="heading"><strong>Thông tin vé</strong></h3>
                                <div class="table_desc">
                                    <div class="table_page table-responsive">
                                        <table>
                                            <thead>
                                            <tr>
                                                {{-- <th class="product_remove">Trạng thái</th> --}}
                                                <th class="product_thumb">Hình Ảnh</th>
                                                <th class="product_name">Tên</th>
                                                <th class="product-date">Thời gian nhận</th>
                                                <th class="product_quantity">Thời gian trả</th>
                                                <th class="product_quantity">Giá dịch vụ</th>
                                                {{-- <th class="product_total">Tổng</th> --}}
                                            </tr>
                                            </thead>
                                            <tbody id="cartUpdate">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="hoTen" class="form-label">Họ và tên</label>
                                    <input
                                    id="hoTen"
                                    name="hoTen"
                                    type="text"
                                    value="{{ Auth::user()->ho .' ' .Auth::user()->ten }}"
                                    class="form-control"
                                    />
                                    <span class="form-message"></span>
                                </div>
                                <div class="form-group">
                                <label for="SDT" class="form-label">Số điện thoại</label>
                                <input
                                    id="SDT"
                                    name="SDT"
                                    type="text"
                                    value="{{ Auth::user()->SDT }}"
                                    class="form-control"
                                />
                                <span class="form-message"></span>
                                </div>

                                <div class="form-group">
                                    <label for="maTT" class="form-label">Tỉnh thành</label>
                                    <select class="form-control" id="maTT">
                                        @php
                                            if(Auth::user()->maPX){
                                                $maPXNow = Auth::user()->maPX;
                                                $maQHNow = \App\Models\PhuongXa::where('maPhuongXa',$maPXNow)->first()['maQH'];
                                                $maTTNow = \App\Models\QuanHuyen::where('maQuanHuyen',$maQHNow)->first()['maTT'];
                                                $listTinhThanh = \App\Models\TinhThanh::all();
                                                foreach ($listTinhThanh as $tinhThanh) {
                                                    if($maTTNow === $tinhThanh->maTinhThanh)
                                                        echo '<option value="'. $tinhThanh->maTinhThanh .'" selected>'.$tinhThanh->tenTinhThanh.'</option>';
                                                    else
                                                        echo '<option value="'. $tinhThanh->maTinhThanh .'">'.$tinhThanh->tenTinhThanh.'</option>';
                                                }
                                            }
                                            // else
                                            //     echo '<option value="">-- Hãy chọn tỉnh thành --</option>';
                                        @endphp
                                    </select>
                                <span class="form-message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="maQH" class="form-label">Quận huyện</label>
                                    <select class="form-control" id="maQH">
                                        @php
                                            if(Auth::user()->maPX){
                                                $maPXNow = Auth::user()->maPX;
                                                $maQHNow = \App\Models\PhuongXa::where('maPhuongXa',$maPXNow)->first()['maQH'];
                                                $maTT = \App\Models\QuanHuyen::where('maQuanHuyen',$maQHNow)->first()['maTT'];
                                                $listQuanHuyen = \App\Models\QuanHuyen::where('maTT',$maTT)->get();
                                                foreach ($listQuanHuyen as $quanHuyen) {
                                                    if($maQHNow === $quanHuyen->maQuanHuyen)
                                                        echo '<option value="'. $quanHuyen->maQuanHuyen .'" selected>'.$quanHuyen->tenQuanHuyen.'</option>';
                                                    else
                                                        echo '<option value="'. $quanHuyen->maQuanHuyen .'">'.$quanHuyen->tenQuanHuyen.'</option>';
                                                }
                                            }
                                        @endphp
                                    </select>
                                <span class="form-message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="maPX" class="form-label">Phường xã</label>
                                    <select name="maPX" class="form-control" id="maPX">
                                        @php
                                            if(Auth::user()->maPX){
                                                $maPXNow = Auth::user()->maPX;
                                                $maQH = \App\Models\PhuongXa::where('maPhuongXa',$maPXNow)->first()['maQH'];
                                                $listPhuongXa = \App\Models\PhuongXa::where('maQH',$maQH)->get();
                                                foreach ($listPhuongXa as $phuongXa) {
                                                    if($maPXNow === $phuongXa->maPhuongXa)
                                                        echo '<option value="'. $phuongXa->maPhuongXa .'" selected>'.$phuongXa->tenPhuongXa.'</option>';
                                                    else
                                                        echo '<option value="'. $phuongXa->maPhuongXa .'">'.$phuongXa->tenPhuongXa.'</option>';
                                                }
                                            }
                                        @endphp
                                    </select>
                                <span class="form-message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="diaChi" class="form-label">Địa chỉ</label>
                                    <input
                                    id="diaChi"
                                    name="diaChi"
                                    type="text"
                                    placeholder="Số đường, tổ, xóm, thôn, làng"
                                    value="{{ Auth::user()->diaChi }}"
                                    class="form-control"
                                    />
                                    <span class="form-message"></span>
                                </div>
                            <div class="coupon_code -aos-delay="400">
                                <h3>Giá trị thanh toán</h3>
                                <div class="coupon_inner">
                                    <div class="cart_subtotal">
                                        <p>Khuyến mãi</p>
                                        <p class="promotion-percent">0</p>
                                    </div>
                                    <div class="cart_subtotal">
                                        <p>Tổng tiền</p>
                                        <p class="cart_amount" id="cartSub"></p>
                                    </div>
                                    
                                    <div class="cart_subtotal">
                                        <p>Phương thức thanh toán</p>
                                        <p >Online</p>
                                    </div>
                                </div>
                            </div>
                            
                            <button class="btn btn-md btn-golden">Thanh toán</button>
                          </form>
                            @php
                                // $veCuoiCung = App\Models\Ve::latest()->first();
                                $idVeMoi = App\Models\Ve::orderBy('id', 'desc')->first()->id + 1;
                                if(empty($idVeMoi)){
                                    $idVeMoi = rand(1000, 9999); // Thay 1000 và 9999 bằng khoảng giá trị bạn muốn
                                }
                                $maSan = $_GET['maSan'];
                                $tenSanBong = App\Models\SanBong::where('maSan',$maSan)->first()->tenSan;
                                $ndck = "Thanh toán tiền ".$tenSanBong;
                            @endphp
                            <div class="bound-pay display-none">{{--  --}}
                                <span class="form-message ">Vui lòng nạp tiền</span>
                                <form id="form-recharge" class="sub-nav__item" method="POST" action="{{ url('/vnpay_payment') }}" target="_blank">
                                    @csrf
                                    <input type="hidden" name="idVe" value="{{ $idVeMoi }}">
                                    <input type="hidden" name="ndck" value="{{ $ndck }}">
                                    <button type="submit" name="redirect"  class="sub-nav__item-link" style="background: var(--primary-color); color: white; width: fit-content; margin-left: 8px; height: 40px;">Nạp tiền</button>
                                </form>
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
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);


    // Lấy giá trị của các tham số truy vấn cần thiết
    const maNguoiDung = "{{ Auth::user()->maNguoiDung }}";
    const maSan = urlParams.get('maSan');
    const soLuong = urlParams.get('soLuong');
    const thoiGianBatDau = urlParams.get('thoiGianBatDau');
    const thoiGianKetThuc = urlParams.get('thoiGianKetThuc');
    const trangThai = urlParams.get('trangThai');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    // console.log(urlParams.get('thoiGianBatDau'),maNguoiDung)
    var tableBody = document.querySelector('#cartUpdate')
    var apiSanBong = "http://127.0.0.1:8000/api/sanbong"
    let getGiaDichVu
    let getTenSanBong
    fetch(apiSanBong+"/"+maSan)
                    .then(response => response.json())
                    .then(sanBong => {
                                getGiaDichVu = sanBong.giaDichVu
                                getTenSanBong = sanBong.tenSan
                                tableBody.innerHTML +=   `
                                                                            <tr id="item-">
                                                                                <td class="product_thumb">
                                                                                    <a><img src="assets/img/${sanBong.hinhAnh}.jpg" style="width: 100px; height: 66px; object-fit: cover;"></a>
                                                                                </td>
                                                                                <td class="product_name">
                                                                                    <a href="/productDetails?id=">
                                                                                        ${sanBong.tenSan}
                                                                                    </a>
                                                                                </td>
                                                                                <td class="product-date">${formatDate(thoiGianBatDau)}</td>
                                                                                <td class="product-date">${formatDate(thoiGianKetThuc)}</td>
                                                                                <td class="product_total">
                                                                                    ${formatCurrency(sanBong.giaDichVu)}/h
                                                                                </td>
                                                                            </tr>
                                                                        `;
                    })
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
    function formatCurrency(input) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(input);
    }
    //Đợi lấy giá dịch vụ từ fetch rồi mới render
    setTimeout(() => {
        renderTotalPrice()
    }, 1000);
    var totalPrice
    function renderTotalPrice(){
        var totalPriceView = document.querySelector('#cartSub')
        totalPrice = calculatorMoneyAndPromotion(thoiGianBatDau, thoiGianKetThuc, getGiaDichVu)
        console.log(totalPrice)
        // Lấy URL hiện tại
        // var currentURL = window.location.href;
        // // Tạo một đối tượng URL từ URL hiện tại
        // var urlObject = new URL(currentURL);
        // // Thêm thông tin vào URL sử dụng phương thức searchParams
        // urlObject.searchParams.append('totalPrice', totalPrice);
        // // Lấy URL mới với thông tin đã thêm
        // var newURL = urlObject.toString();
        // window.history.pushState({ path: newURL }, '', newURL);

        // Redirect hoặc sử dụng URL mới tùy ý
        totalPriceView.innerHTML =  `
                                    ${totalPrice}
                                    ` 
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
        function calculatorMoneyAndPromotion(thoiGianBatDau, thoiGianKetThuc, giaDichVu){
            hour = tinhKhoangCach(thoiGianBatDau, thoiGianKetThuc)
            totalPrice = hour*giaDichVu
            var promotionPercentView = document.querySelector('.promotion-percent')
            // if(hour >= 48){
            //     totalPrice *= 0.3
            //     promotionPercentView.innerHTML = "70%"
            // }
            // else
                if(hour >= 24){
                    totalPrice *= 0.5
                    promotionPercentView.innerHTML = "50%"
                }
                else
                    if(hour>=12){
                        totalPrice *= 0.8
                        promotionPercentView.innerHTML = "20%"
                    }
            
            return formatCurrency(totalPrice)
        }
    }
    var apiProvince = 'http://127.0.0.1:8000/api/tinhthanh'
    var apiDistrict = 'http://127.0.0.1:8000/api/quanhuyen'
    var apiWard = 'http://127.0.0.1:8000/api/phuongxa'

    var provinceList = $('#maTT') 
    var districtList = $('#maQH') 
    var wardList = $('#maPX') 
    start()
    function start(){
        getProvince(provinces => renderProvince(provinces))
    }
    function getProvince(callback) {
        fetch(apiProvince)
            .then(response => response.json())
            .then(callback)
    }
    function renderProvince(provinces){
        if(provinceList.innerHTML.length === 77){
            provinces.forEach((province)=>{
                var option = document.createElement("option")
                option.value = province.maTinhThanh
                option.innerText = province.tenTinhThanh
                provinceList.appendChild(option)
            })
            getDistrict(districts => renderDistrict(districts))
            getWards(wards => renderWard(wards))
        }

    }
    
    // Xử lý khi lắng nghe chọn tỉnh sẽ chuyển ra danh sách quận huyện, phường chính xác
        provinceList.addEventListener('change', function() {
                getDistrict(districts => renderDistrict(districts))
                // getWards(wards => renderWard(wards)) setTimeout bất đồng bộ sẽ lắng nghe sau và lấy giá trị maQH đúng, chứ không là sẽ chạy đồng thời 2 function và sẽ lấy maQH trước khi reset lại list quận huyện
                setTimeout(() => {
                    getWards(wards => renderWard(wards))
                }, 500);
        });
        function getDistrict(callback){
            var maTT = provinceList.value;
            fetch(apiDistrict+"/"+maTT)
                .then(response => response.json())
                .then(callback)
        }
        function renderDistrict(districts){
            districtList.innerHTML = ""
            districts.forEach((district)=>{
                var option = document.createElement("option")
                option.value = district.maQuanHuyen
                option.innerText = district.tenQuanHuyen
                districtList.appendChild(option)
            })
        }
        districtList.addEventListener('change', function() {
            getWards(wards => renderWard(wards))
        });
        function getWards(callback){
            // console.log(districtList.value)
            var maQH = districtList.value;
            fetch(apiWard+"/"+maQH)
                .then(response => response.json())
                .then(callback)
        }
        function renderWard(wards){
            wardList.innerHTML = ""
            wards.forEach((ward)=>{
                var option = document.createElement("option")
                option.value = ward.maPhuongXa
                option.innerText = ward.tenPhuongXa
                wardList.appendChild(option)
            })
        }
    // Validator
        var apiUser = 'http://127.0.0.1:8000/api/user'
        var apiVe = 'http://127.0.0.1:8000/api/ve'
        var apiChiTietThueSan = 'http://127.0.0.1:8000/api/chitietthuesan'
        var dataSDTMaPXDiaChihoTenNguoiDat 
        var apiLichSuGiaoDich = "http://127.0.0.1:8000/api/lichsugiaodich"
        Validator({
                form: "#form-infor",
                rules: [
                    Validator.minLength("#SDT",10, 'Yêu cầu số điện thoại từ 10 - 11 số'),
                    Validator.isRequired("#hoTen"),
                    Validator.isRequired("#diaChi"),
                ],
                errorSelector: ".form-message",
                buttonSubmitSelector: ".btn-golden",
                // Muốn submit không theo API mặc định của trình duyệt
                onSubmit: function (data) {
                    data['tongTien'] = parseCurrency(totalPrice);
                    dataSDTMaPXDiaChihoTenNguoiDat = data;
                    
                    let formatThoiGianBatDau = new Date(thoiGianBatDau); // Giả sử thoiGianBatDau là một chuỗi đại diện cho thời gian bắt đầu
                    let thoiDiemHienTai = new Date();
                    // console.log("Thời gian bắt đầu: "+ formatThoiGianBatDau.getTime())
                    // console.log("Thời gian hiện tại:"+ thoiDiemHienTai.getTime())
                    if (formatThoiGianBatDau.getTime() > thoiDiemHienTai.getTime()) {
                        handleMoneyUser(data['tongTien']);
                    } else {
                        toastr.error('Thời gian bắt đầu không hợp lệ.');
                    }
                },
                formGroupSelector: ".form-group",
        });
        function parseCurrency(input) {
            return parseFloat(input.replace(/[^\d]/g, ''));
        }
        function handleMoneyUser (pay){
            fetch(apiUser+'/'+"{{ Auth::user()->maNguoiDung }}")
            .then(response => response.json())
            .then(data => {
                var payView = document.querySelector('.bound-pay');
                if(data.soDuTaiKhoan < pay){
                    toastr.error("Số tiền của quý khách không đủ để thanh toán")
                    payView.classList.remove('display-none')
                    setTimeout(transferToTalPriceToVNpay(), 10000)
                    function transferToTalPriceToVNpay(){
                        var formRecharge = document.querySelector('#form-recharge'); // Assuming .sub-nav__item contains a form element
                        var input = document.createElement('input');
                        Object.assign(input, {
                            type: "hidden",
                            name: "totalPrice", // Assuming totalPrice is a variable containing the name
                            value: totalPrice // Assuming totalPrice is a variable containing the value
                        });
                        // console.log(input)
                        // console.log(formRecharge)
                        formRecharge.appendChild(input);
                    }
                }
                else{
                    payView.classList.add('display-none')
                    toastr.success("Thanh toán thành công")
                    createVe(pay)
                }
            })
        }
        function createVe(pay){
            // console.log("MaPX, diaChi: " + dataSDTMaPXDiaChihoTenNguoiDat.diaChi)
            // console.log("Tongtien" + totalPrice)
            let dataVe = {}
            dataVe["maNguoiDung"] = "{{ Auth::user()->maNguoiDung }}"
            dataVe["diaChi"] = dataSDTMaPXDiaChihoTenNguoiDat.diaChi
            dataVe["maPX"] = dataSDTMaPXDiaChihoTenNguoiDat.maPX
            dataVe["SDT"] = dataSDTMaPXDiaChihoTenNguoiDat.SDT
            dataVe["tongTien"] = pay
            dataVe["daThanhToan"] = 1
            dataVe["trangThai"] = 0
            dataVe["hoTen"] = dataSDTMaPXDiaChihoTenNguoiDat.hoTen
            dataVe["_token"] = token
            // console.log("Data ves: "+dataVe)
            fetch(apiVe, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(dataVe),
            })
            // Trả về promise
            .then(response => {
                return response.json();
            })
            .then(data => {
                if(data.error)
                    toastr.error(data.error)
                else{
                    toastr.success(data.success)
                    // console.log(data.idVe)
                    createChiTietThueSan(data.idVe, pay)
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        function createChiTietThueSan(maVe, pay){
            // console.log(maVe)
            let dataChiTietThueSan = {}
            dataChiTietThueSan['maVe'] = maVe
            dataChiTietThueSan['maSan'] = maSan
            dataChiTietThueSan['maHinhThuc'] = 1
            dataChiTietThueSan['thoiGianBatDau'] = thoiGianBatDau
            dataChiTietThueSan['thoiGianKetThuc'] = thoiGianKetThuc
            dataChiTietThueSan["_token"] = token
            fetch(apiChiTietThueSan, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(dataChiTietThueSan),
            })
            // Trả về promise
            .then(response => {
                return response.json();
            })
            .then(data => {
                if(data.error)
                    toastr.error(data.error)
                else{
                    toastr.success(data.success)
                    createLichSuGiaoDich(pay)
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        function createLichSuGiaoDich(pay){
            let dataLichSuGiaoDich = {}
            dataLichSuGiaoDich['maNguoiDung'] = "{{ Auth::user()->maNguoiDung }}"
            dataLichSuGiaoDich['ndck'] = "Thanh toán tiền đặt " + getTenSanBong
            dataLichSuGiaoDich['soTien'] = -pay
            dataLichSuGiaoDich['trangThai'] = 0
            dataLichSuGiaoDich['loaiGD'] = 2
            dataLichSuGiaoDich['thoiGian'] = getCurrentDateTime()
            dataLichSuGiaoDich['_token'] = token
            fetch(apiLichSuGiaoDich, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(dataLichSuGiaoDich),
            })
            // Trả về promise
            .then(response => {
                return response.json();
            })
            .then(data => {
                if(data.error)
                    toastr.error(data.error)
                else{
                    toastr.success(data.success)
                    updateMoneyUserByTriggerDatabase(data.idLichSuGiaoDich)
                    // window.location.href = "/tui";
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        function getCurrentDateTime() {
            const now = new Date();
            const year = now.getFullYear();
            let month = now.getMonth() + 1;
            month = month < 10 ? '0' + month : month; // Đảm bảo tháng có hai chữ số
            let day = now.getDate();
            day = day < 10 ? '0' + day : day; // Đảm bảo ngày có hai chữ số
            let hours = now.getHours();
            hours = hours < 10 ? '0' + hours : hours; // Đảm bảo giờ có hai chữ số
            let minutes = now.getMinutes();
            minutes = minutes < 10 ? '0' + minutes : minutes; // Đảm bảo phút có hai chữ số
            let seconds = now.getSeconds();
            seconds = seconds < 10 ? '0' + seconds : seconds; // Đảm bảo giây có hai chữ số

            const currentDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            return currentDateTime;
        }
        function updateMoneyUserByTriggerDatabase(idLichSuGiaoDich){
            let dataTrangThai = {}
            dataTrangThai['trangThai'] = 1
            dataTrangThai['_token'] = token
            fetch(apiLichSuGiaoDich+"/"+idLichSuGiaoDich, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(dataTrangThai),
            })
            // Trả về promise
            .then(response => {
                return response.json();
            })
            .then(data => {
                if(data.error)
                    toastr.error(data.error)
                else{
                    toastr.success(data.success)
                    window.location.href = "/sanbong";
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>