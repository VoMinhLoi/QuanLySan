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
        th.product_quantity {
            text-align: center;
        }
        td .button-action {
            padding: 8px 12px;
            color: white;
            border-radius: 4px;
            text-align: center;
            display: block;
        }
        .button-action + .button-action {
            margin-top: 4px;
        }
        .button-action--delete {
            background: red;
        }
        .button-action--infor {
            background: var(--primary-color)
        }
        select.filter {
            border: 1px solid black;
            transform: translateX(-50%);
            position: relative;
            left: 50%;
        }
        .pagination {
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: .25rem;
        }
        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #dee2e6;
            width: 100%;
            height: 100%;
        }
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
            height: 100%;
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
                    breadCrumbHeading.innerText = 'Đơn hàng'
                </script>
                <div class="row content no-gutters">
                    <div class="col l-12 m-12 c-12">
                        <div class="main" id="main">
                            <form method="POST" class="form" id="form-infor">
                                <h3 class="heading"><strong>Các đơn hàng đã đặt</strong></h3>
                                {{-- <select class="filter">
                                    <option value="Tất cả các vé">Tất cả đơn hàng</option>
                                    <option value="Những vé chưa sử dụng">Đơn hàng chưa nhận</option>
                                    <option value="Những vé đã sử dụng">Đơn hàng đã nhận</option>
                                    <option value="Những vé chưa sử dụng">Đơn hàng chưa thanh toán</option>
                                    <option value="Những vé đã sử dụng">Đơn hàng đã thanh toán</option>
                                </select> --}}
                                <div class="table_desc">
                                    <div class="table_page table-responsive">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th class="product_remove">Mã đơn hàng</th>
                                                {{-- <th class="product_thumb product_quantity">Hình Ảnh</th> --}}
                                                <th class="product_name product_quantity">Món</th>
                                                <th class="product-date product_quantity">Thời gian đặt hàng</th>
                                                <th class="product_quantity">Thời gian nhận đơn</th>
                                                <th class="product_quantity">Tổng tiền</th>
                                                <th class="product_quantity" column="2">Hoạt động</th>
                                                <th class="product_quantity" column="2">Ghi chú</th>
                                                {{-- <th class="product_total">Tổng</th> --}}
                                            </tr>
                                            </thead>
                                            <tbody id="cartUpdate">
                                                @foreach ($donHangList as $item)
                                                    <tr id="item-{{$item->id}}">
                                                        <td>
                                                            DH{{$item->id}}
                                                        </td>
                                                        @php
                                                            $chiTietDonHangs = App\Models\ChiTietDonHang::where('maDonHang', $item->id)->get();
                                                        @endphp
                                                        <td><strong>{{ $chiTietDonHangs->count() }} món</strong>
                                                            <br>
                                                            @foreach($chiTietDonHangs as $CTDH)
                                                                <a href="/dungcu/{{ $CTDH->maDungCu }}" target="_blank">
                                                                    ({{ $CTDH->maDungCu }})
                                                                </a>
                                                            @endforeach
                                                        </td>
                                                        <td class="product-date">{{\DateTime::createFromFormat('Y-m-d H:i:s',  $item->ngayDatHang)->format('d-m-Y H:i:s') }}</td>
                                                        @if (isset($item->ngayNhanHang))
                                                            <td class="product-date">{{\DateTime::createFromFormat('Y-m-d H:i:s',  $item->ngayNhanHang)->format('d-m-Y H:i:s') }}</td>
                                                        @else
                                                            <td style="color:red"> Chưa nhận đơn</td>
                                                        @endif
                                                        <td class="product_total">
                                                            {{ number_format($item->tongTien, 0, ',', '.') }}<sup>₫</sup>
                                                        </td>
                                                        <td style="text-align: center">
                                                            @if ($item->daThanhToan)
                                                                <strong style="color:rgb(12, 79, 234)">Đã thanh toán <br/></strong>
                                                            @else
                                                                <strong style="color:red">Chưa thanh toán <br/></strong>
                                                            @endif
                                                        </td>
                                                        <td style="flex-direction: column">
                                                            {{-- @php
                                                                $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
                                                                $hienTai = new DateTime('now', $timezone);
                                                                $batDau = new DateTime($item->thoiGianBatDau, $timezone);
                                                                $khoangCach = $hienTai->diff($batDau); // This will give you the difference in days    
                                                                $ngay = $khoangCach->days;
                                                                $gio = $khoangCach->h;
                                                                $phut = $khoangCach->i;
                                                                $giay = $khoangCach->s;
                            
                                                                // Tính tổng số giây
                                                                $tongSoGiay = $ngay * 86400 + $gio * 3600 + $phut * 60 + $giay;
                                                                if ($khoangCach->invert === 1) {
                                                                    $tongSoGiay *= -1;
                                                                }
                                                            @endphp
                                                            @if($tongSoGiay >= 1800)
                                                                <a style="cursor: pointer" class="button-action button-action--delete" onclick="cancelCalendar('{{$item->maCTTS}}')">Hủy</a>
                                                            @endif
                                                             --}}
                                                            <a class="button-action button-action--infor" href="/chitietdonhang/{{$item->id}}" target="_blank">Chi tiết</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                    <div id="paginate" style="margin: 12px auto 0; display:flex; justify-content: center">
                                        {{ $donHangList->links() }}
                                    </div>
                                </div>
                                {{-- <p class="">
                                    <strong>Lưu ý: </strong>Hủy sân trước <span style="color: red">1 tiếng thời gian bắt đầu</span> hoàn tiền lại 100% vào số dư tài khoản của bạn trên website đồng thời trước 1 tiếng bắt đầu có thể liện hệ admin để đổi sân, dời thời gian sân. Trước nữa tiếng bắt đầu hoàn lại 50%. Qua <span style="color: red">nữa tiếng</span> không thể hủy sân.
                                </p> --}}
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
    var dataChiTietThueSan
    var dataChiTietThueSanNgayChuaSuDungGlobal
    var dataChiTietThueSanNgayDaSuDungGlobal
    var maNguoiDung = parseInt("{{ Auth::user()->maNguoiDung }}")
    // var myTicketsGlobal = []
    var maVeOfmyTicketGlobal = []
    const globalToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    start()
    function start(){
        getTickets()
    }
    function getTickets(){
        fetch("http://127.0.0.1:8000/api/donhang")
                    .then(response => response.json())
                    .then(data => {
                        if(data.error)
                            toastr.error(data.error)
                        else{
                            data = data.filter(ve => {
                                return ve.maNguoiDung == maNguoiDung
                            })
                            // myTicketsGlobal = data
                            data.forEach(ticket => {
                                maVeOfmyTicketGlobal.push(ticket.id)
                            });
                            if(maVeOfmyTicketGlobal)
                                getChiTietThueSan()

                        }
                    })
    }
    function getChiTietThueSan(){
        fetch("http://127.0.0.1:8000/api/chitietthuesan")
                    .then(response => response.json())
                    .then(data => {
                        if(data.error)
                        toastr.error(data.error)
                        else{

                            let filteredData = data.filter(CTTS => maVeOfmyTicketGlobal.includes(CTTS.maVe));

                            // Sắp xếp filteredData theo maCTTS giảm dần
                            filteredData.sort((a, b) => b.maCTTS - a.maCTTS);

                            // Gán kết quả cho dataChiTietThueSan
                            dataChiTietThueSan = filteredData;
                            // handleRenderTicket(dataChiTietThueSan)
                        }
                    })
                }
    const tableBody = document.querySelector('#cartUpdate')
    const thoiGianHienTai = layThoiGianHienTai();
    
    function handleRenderTicket(dataCTTS){
        let promises = dataCTTS.map(CTTS => {
            return fetch("http://127.0.0.1:8000/api/sanbong/"+CTTS.maSan)
                .then(response => response.json());
        });

        Promise.all(promises)
            .then(sanBongs => {
                dataCTTS.forEach((CTTS, index) => {
                    let sanBong = sanBongs[index];
                    tableBody.innerHTML +=   `
                                                <tr id="item-${CTTS.maCTTS}">
                                                    <td>
                                                        V${CTTS.maVe}
                                                    </td>
                                                    <td class="product_thumb">
                                                        <a><img src="assets/img/${sanBong.hinhAnh}" style="width: 100px; height: 66px; object-fit: cover;"></a>
                                                    </td>
                                                    <td class="product_name">
                                                        <a href="/productDetails?id=">
                                                            ${sanBong.tenSan}
                                                        </a>
                                                    </td>
                                                    <td class="product-date">${formatDate(CTTS.thoiGianBatDau)}</td>
                                                    <td class="product-date">${formatDate(CTTS.thoiGianKetThuc)}</td>
                                                    <td class="product_total">
                                                        ${formatCurrency(sanBong.giaDichVu)}/h
                                                    </td>
                                                    <td style="flex-direction: column">
                                                        ${tinhKhoangCach(thoiGianHienTai, CTTS.thoiGianBatDau)>=0.5?`<a style="cursor: pointer" class="button-action button-action--delete" onclick="cancelCalendar('${CTTS.maCTTS}')" >Hủy</a>`:``}
                                                        <a class="button-action button-action--infor" href="/chitietthuesan/${CTTS.maCTTS}" target="_blank">Chi tiết</a>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <strong style="color:red">${isToday(CTTS.thoiGianBatDau)?'Hôm nay <br/>':''}</strong>
                                                    </td>
                                                </tr>
                    `;
                });
            });
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
    function formatCurrency(input) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(input);
    }
    function isToday(dateString) {
        // Chuyển đổi chuỗi thời gian bắt đầu thành đối tượng Date
        const startDate = new Date(dateString);

        // Lấy ngày, tháng và năm hiện tại
        const today = new Date();
        const todayDate = today.getDate();
        const todayMonth = today.getMonth() + 1; // Lưu ý: Tháng bắt đầu từ 0 (0 là tháng 1)
        const todayYear = today.getFullYear();

        // Lấy ngày, tháng và năm của thời gian bắt đầu
        const startDateDate = startDate.getDate();
        const startMonth = startDate.getMonth() + 1; // Lưu ý: Tháng bắt đầu từ 0 (0 là tháng 1)
        const startYear = startDate.getFullYear();

        // Kiểm tra xem thời gian bắt đầu có phải là ngày hôm nay không
        return todayDate === startDateDate && todayMonth === startMonth && todayYear === startYear;
    }
    // ${tinhKhoangCach(thoiGianHienTai, CTTS.thoiGianBatDau)<=0?'Đã sử dụng':''}
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
    function layThoiGianHienTai() {
        var now = new Date();

        // Lấy thông tin ngày, tháng, năm, giờ, phút, giây
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
        var date = String(now.getDate()).padStart(2, '0');
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var seconds = String(now.getSeconds()).padStart(2, '0');

        // Tạo chuỗi định dạng yyyy-mm-dd hh:mm:ss
        var formattedTime = `${year}-${month}-${date} ${hours}:${minutes}:${seconds}`;

        return formattedTime;
    }
    var filterView = document.querySelector('.filter')
    filterView.onchange = ()=>{
        handleFilter(filterView.value)
    }
    const paginationView = document.querySelector('#paginate')
    function handleFilter(value){
        tableBody.innerHTML = ""
        switch(value){
            case "Tất cả các vé":
                window.location.href ="/tui"
                break;
            case "Những vé chưa sử dụng":
                if(!dataChiTietThueSanNgayChuaSuDungGlobal)
                    dataChiTietThueSanNgayChuaSuDungGlobal = dataChiTietThueSan.filter(function(item) {
                        let ngayHienTai = new Date();
                        let thoiGianBatDau = new Date(item.thoiGianBatDau);
                        return thoiGianBatDau >= ngayHienTai;
                    });
                paginationView.classList.add('display-none')
                handleRenderTicket(dataChiTietThueSanNgayChuaSuDungGlobal)
                break;
            case "Những vé đã sử dụng":
                if(!dataChiTietThueSanNgayDaSuDungGlobal)
                    dataChiTietThueSanNgayDaSuDungGlobal = dataChiTietThueSan.filter(function(item) {
                        let ngayHienTai = new Date();
                        let thoiGianBatDau = new Date(item.thoiGianBatDau);
                        return thoiGianBatDau < ngayHienTai;
                    });
                paginationView.classList.add('display-none')
                handleRenderTicket(dataChiTietThueSanNgayDaSuDungGlobal)
                break;
        }
            
        
        
        // console.log(dataChiTietThueSanNgayChuaSuDungGlobal, dataChiTietThueSanNgayDaSuDungGlobal, dataChiTietThueSan)
    }
    function cancelCalendar(value){
        
        if(confirm("Hủy sân trước 1 tiếng bắt đầu hoàn 100%, trước 30 phút thì hoàn 50%, vậy bạn có chắc chắn muốn hủy vé này không?")){
            deleteRowViewAndQuantityCart(value)
            handleDeleteChiTietThueSan(value)
        }
    }
    function deleteRowViewAndQuantityCart(value){
        let rowIsDeletedView = document.querySelector('#item-'+value)
        rowIsDeletedView.remove();
        let quantityInBag = document.querySelector('.header-private-item__quantity--in-bag')
        quantityInBag.innerText = parseInt(quantityInBag.innerText) - 1
    }
    function handleDeleteChiTietThueSan(value){
        Refund(value)
    }
    function Refund(value){
        getOneChiTietThueSan(value, CTTS => 
            getVe(CTTS.maVe, ve => {
                let cancelHourBeforeDistance = tinhKhoangCach(thoiGianHienTai, CTTS.thoiGianBatDau)
                if(cancelHourBeforeDistance >= 1)
                    updateUserMoney(ve.tongTien, value, CTTS.maSan, CTTS.thoiGianBatDau, CTTS.thoiGianKetThuc)
                else
                    if(cancelHourBeforeDistance >= 0.5)
                        updateUserMoney(parseFloat(ve.tongTien/2), value, CTTS.maSan, CTTS.thoiGianBatDau, CTTS.thoiGianKetThuc)
                    else
                        toastr.error("Không thể hủy sân vì đã qua giờ quy định.")
            })
        )
    }
    function getOneChiTietThueSan(value, callback){
        fetch("http://127.0.0.1:8000/api/chitietthuesan/"+value)
            .then(response => response.json())
            .then(callback)
    }
    function getVe(maVe, callback){
        fetch("http://127.0.0.1:8000/api/ve/"+maVe)
            .then(response => response.json())
            .then(callback)
    }
    function updateUserMoney(money, maCTTS, maSan, thoiGianBatDau, thoiGianKetThuc){
        var data = {}
        data['soDuTaiKhoan'] = money;
        fetch("http://127.0.0.1:8000/api/user/"+parseInt("{{ Auth::user()->maNguoiDung }}"),{
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': globalToken,
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    toastr.success(data.success)
                    deleteChiTietThueSan(maCTTS)
                    createLichSuGiaoDich(money, maSan)
                    createThongBaoHuy(maSan)
                    sendMail(maCTTS, maSan, money, thoiGianBatDau, thoiGianKetThuc)
                }
                else
                    toastr.error(data.error)
            })
            .catch(error => {
                toastr.error("Lỗi hoàn tiền");
                console.error('Error:', error);
            });
    }
    function deleteChiTietThueSan(maCTTS){
        fetch("http://127.0.0.1:8000/api/chitietthuesan/"+maCTTS,{
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': globalToken
                }
            })
            .then(response => response.json())
            .then(data=> {
                if(data.success){
                    toastr.success(data.success)
                }
                else
                    toastr.error(data.error)
                    if(data.chiTietThueSan.maDungCu)
                        updateToolRentingQuantity(data.chiTietThueSan)
            })
    }
    function updateToolRentingQuantity(chiTietThueSan){
            fetch("http://127.0.0.1:8000/api/dungcu/"+chiTietThueSan.maDungCu, {
                method: "PUT",
                headers: {
                    // "Content-Type": "application/x-www-form-urlencoded", x-www-form-urlencoded: form data
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': globalToken,
                },
                // body: JSON.stringify(data),
                body: JSON.stringify({ soLuongChoThue: -chiTietThueSan.soLuong }),
            })
            .then(response => {
                return response.json(); // Chuyển đổi phản hồi sang JSON
            })
            .then(data => {
                if(data.error)
                    toastr.error(data.error)
                else{
                    toastr.success(data.success)
                }// Dữ liệu JSON trả về từ function store
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    function createLichSuGiaoDich(money, maSan){
        let lsgd = {}
        lsgd['maNguoiDung'] = "{{ Auth::user()->maNguoiDung }}";
        lsgd['ndck'] = "Hoàn tiền hủy sân " + maSan;
        lsgd['soTien'] = money;
        lsgd['thoiGian'] = layThoiGianHienTai();
        lsgd['trangThai'] = 1;
        lsgd['loaiGD'] = 3;
        fetch('http://127.0.0.1:8000/api/lichsugiaodich',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': globalToken,
            },
            body: JSON.stringify(lsgd)
        })
            .then(response => response.json())
            .then(data => {
                if(data.success)
                    toastr.success(data.success)
                else
                    toastr.error(data.error)
            })
    }
    function createThongBaoHuy(maSan){
        let dataThongBao = {}
        dataThongBao['loaiTB'] = 2
        dataThongBao['maNguoiDung'] = "{{ Auth::user()->maNguoiDung }}"
        dataThongBao['tieuDe'] = "Hủy sân "+maSan+" thành công."
        dataThongBao['noiDung'] = "Việc hủy sân hợp lệ trước giờ bắt đầu."
        
        fetch("http://127.0.0.1:8000/api/thongbao", {
            method: "POST",
            headers: {
                // "Content-Type": "application/x-www-form-urlencoded", x-www-form-urlencoded: form data
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': globalToken,
            },
            // body: JSON.stringify(data),
            body: JSON.stringify(dataThongBao),
            })
            .then(response => {
                return response.json(); // Chuyển đổi phản hồi sang JSON
            })
            .then(data => {
                if(data.error)
                    toastr.error(data.error)
                else{
                    toastr.success(data.success)
                }// Dữ liệu JSON trả về từ function store
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    const taiKhoan = "{{ Auth::user()->taiKhoan }}"
    function sendMail(maCTTS, maSan, money, thoiGianBatDau, thoiGianKetThuc){
        fetch('http://127.0.0.1:8000/tui',{
            method: 'post',
            headers: {
                'Content-type': 'application/json',
                'X-CSRF-TOKEN': globalToken
            },
            body: JSON.stringify({taiKhoan ,maCTTS,maSan, money, thoiGianBatDau, thoiGianKetThuc})
        })
            .then(promises => promises.json())
            .then(data => {
                if(data.success)
                    toastr.success(data.success)
                else
                    toastr.error(data.error)
            })
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>