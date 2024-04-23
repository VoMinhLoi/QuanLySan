<!DOCTYPE html>
<html lang="en">
<head>
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
    </style>
</head>
    <body>
        <div class="grid">
            @include('Components.header')
            
            <div class="container">
                <div class="grid wide" >
                    @include('Components.breadcrumb')
                    <script>
                        breadCrumbHeading.innerText = 'Túi > Xem chi tiết'
                    </script>
                    <div class="row content no-gutters">
                        <div class="col l-12 m-12 c-12">
                            <div class="main" id="main">
                                <form method="POST" class="form" id="form-infor">
                                    <h3 class="heading"><strong>Chi tiết thông tin mã vé {{ $ve->id }}</strong></h3>
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
                                                    <th class="product_quantity">Tổng tiền</th>
                                                    <th class="product_quantity">Ghi chú</th>
                                                    {{-- <th class="product_total">Tổng</th> --}}
                                                </tr>
                                                </thead>
                                                <tbody id="cartUpdate">
                                                    <tr id="item-">
                                                        <td class="product_thumb">
                                                            <a><img src="assets/img/{{$sanBong->hinhAnh}}.jpg" style="width: 100px; height: 66px; object-fit: cover;"></a>
                                                        </td>
                                                        <td class="product_name">
                                                            <a href="/productDetails?id=">
                                                                {{$sanBong->tenSan}}
                                                            </a>
                                                        </td>
                                                        <td class="product-date">{{ \DateTime::createFromFormat('Y-m-d H:i:s', $chiTietThueSan->thoiGianBatDau)->format('d-m-Y H:i:s') }}</td>
                                                        <td class="product-date">{{ \DateTime::createFromFormat('Y-m-d H:i:s', $chiTietThueSan->thoiGianKetThuc)->format('d-m-Y H:i:s') }}</td>
                                                        <td class="product_total">
                                                            {{ number_format($sanBong->giaDichVu, 0, ',', '.') }}
                                                            <sup>₫</sup>/h
                                                        </td>
                                                        <td class="product_total">
                                                            {{ number_format($ve->tongTien, 0, ',', '.') }}<sup>₫</sup>
                                                        </td>
                                                        <td class="product_total yard-note" style="text-align: center">
                                                            @php
                                                                $thoiGianBatDau = new DateTime($chiTietThueSan->thoiGianBatDau);
                                                                $ngayHomNay = new DateTime();
                                                            @endphp
                                                            
                                                            @if ($thoiGianBatDau->format('Y-m-d') == $ngayHomNay->format('Y-m-d'))
                                                                <strong style="color: red">Hôm nay</strong><br>
                                                                
                                                            @endif
                                                            @if(isset($daSuDung))
                                                                <strong>{{ $daSuDung }}</strong>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="hoTen" class="form-label">Họ và tên</label>
                                        <input
                                            disabled
                                            id="hoTen"
                                            name="hoTen"
                                            type="text"
                                            value="{{ $ve->hoTen }}"
                                            class="form-control"
                                        />
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group">
                                    <label for="SDT" class="form-label">Số điện thoại</label>
                                    <input
                                        disabled
                                        id="SDT"
                                        name="SDT"
                                        type="text"
                                        value="{{ $ve->SDT }}"
                                        class="form-control"
                                    />
                                    <span class="form-message"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="maTT" class="form-label">Tỉnh thành</label>
                                        <select class="form-control" id="maTT" disabled>
                                            @php
                                                if($ve->maPX){
                                                    $maPXNow = $ve->maPX;
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
                                        <select class="form-control" id="maQH" disabled>
                                            @php
                                                if($ve->maPX){
                                                    $maPXNow = $ve->maPX;
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
                                        <select name="maPX" class="form-control" id="maPX" disabled>
                                            @php
                                                if($ve->maPX){
                                                    $maPXNow = $ve->maPX;
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
                                            disabled
                                            id="diaChi"
                                            name="diaChi"
                                            type="text"
                                            placeholder="Số đường, tổ, xóm, thôn, làng"
                                            value="{{ $ve->diaChi }}"
                                            class="form-control"
                                        />
                                        <span class="form-message"></span>
                                    </div>
                                    <p class="">
                                        <strong>Lưu ý: </strong>Hủy sân trước 4 tiếng hoàn lại 100% nhưng hủy sân sau 3 tiếng hoàn lại 50%. Sau 2 tiếng không thể hủy sân.
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
</html>