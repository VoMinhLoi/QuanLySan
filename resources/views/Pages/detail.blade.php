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
        .form-group-wrapper{
            display: flex;
        }
        .form-group-wrapper .form-group {
            flex: 1;
        }
        .form-group-wrapper .form-group + .form-group {
            margin-left: 12px;
        }
    </style>
    <style>
        @media print {
            .header, #scrollToTopBtn {
                opacity: 0;
            }
            .breadcrumb, #print-wrapper, .footer {
                display: none;
            }
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
                                <div class="form" id="form-infor">
                                    <h3 class="heading"><strong>Chi tiết thông tin mã vé {{ $ve->id }}</strong></h3>
                                    <div class="qr-code" style="display: flex; justify-content: center; flex-direction: column; align-items:center">
                                        <img src="{{ asset($mergedQrCodePath) }}" alt="QR Code" width="200px" height="200px">
                                        <h4>Mã QR vào cổng qua cảm biến hình ảnh cổng</h4>
                                    </div>
                                    <div id="print-wrapper" style="text-align: right">
                                        <button id="print" style="background: var(--primary-color); color: white; padding: 8px 12px; border-radius: 4px">Xuất file .pdf</button>
                                    </div>
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
                                                    @if (isset($chiTietThueSan->maDungCu))
                                                        <th class="product_quantity">Tổng tiền <br> {{ number_format($ve->tongTien, 0, ',', '.') }}<sup>₫</sup></th>
                                                    @else
                                                        <th class="product_quantity">Tổng tiền</th>
                                                    @endif
                                                    <th class="product_quantity">Ghi chú</th>
                                                    {{-- <th class="product_total">Tổng</th> --}}
                                                </tr>
                                                </thead>
                                                <tbody id="cartUpdate">
                                                    <tr id="item-">
                                                        <td class="product_thumb">
                                                            <a><img src="assets/img/{{$sanBong->hinhAnh}}" style="width: 100px; height: 66px; object-fit: cover;"></a>
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
                                                            Thuê sân <br>
                                                            {{ number_format($ve->tongTien - $chiTietThueSan->gia, 0, ',', '.') }}<sup>₫</sup>
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
                                                            @php
                                                                $batDau = new DateTime($chiTietThueSan->thoiGianBatDau);
                                                                $ketThuc = new DateTime($chiTietThueSan->thoiGianKetThuc);
                                                                
                                                                // Tính toán khoảng cách thời gian (tính bằng giây)
                                                                $khoangCachSeconds = $ketThuc->getTimestamp() - $batDau->getTimestamp();
                                                                
                                                                // Chuyển đổi khoảng cách từ giây thành giờ
                                                                $khoangCachGio = $khoangCachSeconds / (60 * 60);
                                                                
                                                                echo '<p style="color:black">Thuê '. $khoangCachGio.' tiếng</p>';
                                                            @endphp
                                                        </td>
                                                    </tr>
                                                    @if(isset($chiTietThueSan->maDungCu))
                                                        <tr>
                                                            @php
                                                                $tool = App\Models\DungCu::where('maDungCu',$chiTietThueSan->maDungCu)->first();
                                                                echo '<td><img src="assets/img/'.$tool->hinhAnh1.'" alt="tool" style="width: 100px; height: 66px; object-fit: cover;"></td>';
                                                                echo '<td>'.$tool->tenDungCu.'</td>';
                                                                echo '<td></td>';
                                                                echo '<td></td>';
                                                                echo '<td>'.number_format($tool->donGiaThue, 0, ',', '.').'<sup>₫</sup>/h</td>';
                                                                echo '<td>Thuê dụng cụ<br/>'.number_format($chiTietThueSan->gia, 0, ',', '.').'<sup>₫</sup></td>';
                                                                echo '<td>Số lượng: '.$chiTietThueSan->soLuong.'</td>';
                                                            @endphp
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group-wrapper">
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
                                        </div>
    
                                        <div class="form-group">
                                            <label for="maTT" class="form-label">Tỉnh thành</label>
                                            @php
                                                $maPXNow = $ve->maPX;
                                                $maQHNow = \App\Models\PhuongXa::where('maPhuongXa',$maPXNow)->first()['maQH'];
                                                $maTTNow = \App\Models\QuanHuyen::where('maQuanHuyen',$maQHNow)->first()['maTT'];
                                                $tenTTNow = \App\Models\TinhThanh::where('maTinhThanh',$maTTNow)->first()['tenTinhThanh'];
                                                // else
                                                //     echo '<option value="">-- Hãy chọn tỉnh thành --</option>';
                                            @endphp
                                            <input type="text" value="{{$tenTTNow}}" disabled class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="maQH" class="form-label">Quận huyện</label>
                                            @php
                                                $maQHNow = \App\Models\PhuongXa::where('maPhuongXa',$maPXNow)->first()['maQH'];
                                                $tenQHNow = \App\Models\QuanHuyen::where('maQuanHuyen',$maQHNow)->first()['tenQuanHuyen'];
                                            @endphp
                                            <input type="text" value="{{$tenQHNow}}" disabled class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="maPX" class="form-label">Phường xã</label>
                                            @php
                                                $tenPXNow = \App\Models\PhuongXa::where('maPhuongXa',$maPXNow)->first()['tenPhuongXa'];
                                            @endphp
                                            <input type="text" value="{{$tenPXNow}}" disabled class="form-control">
                                        </div>
                                        
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
                                    </div>
                                    <p class="">
                                        <strong>Lưu ý: </strong>Hủy sân trước <span style="color: red">1 tiếng thời gian bắt đầu</span> hoàn tiền lại 100% vào số dư tài khoản của bạn trên website đồng thời trước 1 tiếng bắt đầu có thể liện hệ admin để đổi sân, dời thời gian sân. Trước nữa tiếng bắt đầu hoàn lại 50%. Qua <span style="color: red">nữa tiếng</span> không thể hủy sân.
                                    </p>
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
        const printButtonView = document.querySelector('#print')
        // Cách 1: 
        // let temporary
        // printButtonView.onclick = ()=>{
        //     const inforFormView = document.querySelector('#form-infor')
        //     const bodyTagView = document.querySelector('body')
        //     const printWrapperView = document.querySelector('#print-wrapper')
        //     if(!temporary){
        //         const contentView = document.querySelector('.grid')
        //         temporary = contentView.innerHTML
        //     }
        //     printWrapperView.remove()
        //     bodyTagView.innerHTML = inforFormView.innerHTML
        //     window.print()
        //     bodyTagView.innerHTML = temporary
        // }

        // Cách 2:
        printButtonView.onclick = ()=> {
            window.print()
        }
    </script>
</html>
