@extends('admin.layout.layout')
@section('contents')
<table class="table table-striped projects text-center">
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
            <th>Hành động </th>
            {{-- <th class="product_total">Tổng</th> --}}
        </tr>
        </thead>
        <tbody id="cartUpdate">
            <tr id="item-">
                <td class="product_thumb">
                    <a><img src="https://minhloiiot.id.vn/assets/img/{{$sanBong->hinhAnh}}" style="width: 100px; height: 66px; object-fit: cover;"></a>
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
                <td>
                    @if(!isset($daSuDung))
                        <button id="yard-change-button" class="btn-success" onclick="updateChiTietThueSan('{{ $chiTietThueSan->maCTTS }}', '{{ $chiTietThueSan->maSan }}', '{{ $chiTietThueSan->thoiGianBatDau }}', '{{ $chiTietThueSan->thoiGianKetThuc }}', '{{ $sanBong->giaDichVu }}')" style="margin-bottom: 8px">Sửa</button>
                        
                        @php
                            $existBaoTri = App\Models\SanBong::where('maSan',$chiTietThueSan->maSan)->where('trangThai',0)->first();
                            $existChuaXoa = App\Models\ChiTietThueSan::withoutTrashed()->where('maCTTS',$chiTietThueSan->maCTTS)->first();
                        @endphp
                        @if(!empty($existBaoTri))
                            @if(!empty($existChuaXoa))
                                <button class="btn-danger" onclick="handleDeleteChiTietThueSan('{{ $chiTietThueSan->maCTTS }}')">Bảo trì</button>
                            @endif
                        @endif
                    @endif
                </td>
            </tr>
            @if(isset($chiTietThueSan->maDungCu))
                <tr>
                    @php
                        $tool = App\Models\DungCu::where('maDungCu',$chiTietThueSan->maDungCu)->first();
                        echo '<td><img src="https://minhloiiot.id.vn/assets/img/'.$tool->hinhAnh1.'" alt="tool" style="width: 100px; height: 66px; object-fit: cover;"></td>';
                        echo '<td>'.$tool->tenDungCu.'</td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td>'.number_format($tool->donGiaThue, 0, ',', '.').'<sup>₫</sup>/h</td>';
                        echo '<td>Thuê dụng cụ<br/>'.number_format($chiTietThueSan->gia, 0, ',', '.').'<sup>₫</sup></td>';
                        echo '<td>Số lượng: '.$chiTietThueSan->soLuong.'</td>';
                    @endphp
                </tr>
            @endif
    </table>
    <div class="d-flex flex-wrap justify-content-around">
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
    <div class="form-group" style="margin: 0 24px;">
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
    <div class="over-lay display-none">
        @include('admin.chitietthuesan.update')
    </div>
@endsection
<script>
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
    function handleDeleteChiTietThueSan(maCTTS){
        Refund(maCTTS)
    }
    function Refund(maCTTS){
        getOneChiTietThueSan(maCTTS, CTTS => 
            getVe(CTTS.maVe, ve => {
                updateUserMoney(ve.tongTien, maCTTS, ve.maNguoiDung, CTTS.maSan, CTTS.thoiGianBatDau, CTTS.thoiGianKetThuc, ve.taiKhoan)
            })
        )
    }
    function getOneChiTietThueSan(maCTTS, callback){
        fetch("http://127.0.0.1:8000/api/chitietthuesan/"+maCTTS)
            .then(response => response.json())
            .then(callback)
    }
    function getVe(maVe, callback){
        fetch("http://127.0.0.1:8000/api/ve/"+maVe)
            .then(response => response.json())
            .then(callback)
    }
    function updateUserMoney(money, maCTTS, maNguoiDung, maSan, thoiGianBatDau, thoiGianKetThuc, taiKhoan){
        var data = {}
        data['soDuTaiKhoan'] = money;
        fetch("http://127.0.0.1:8000/api/user/"+maNguoiDung,{
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    toastr.success(data.success)
                    deleteChiTietThueSan(maCTTS)
                    createLichSuGiaoDich(money, maNguoiDung, maSan)
                    createThongBaoHuy(maNguoiDung, maSan)
                    sendMail(maCTTS, maSan, money, thoiGianBatDau, thoiGianKetThuc, taiKhoan)
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
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
    function createLichSuGiaoDich(money, maNguoiDung, maSan){
        let lsgd = {}
        lsgd['maNguoiDung'] = maNguoiDung;
        lsgd['ndck'] = "Hoàn tiền hủy sân "+maSan+" vì đang bảo trì";
        lsgd['soTien'] = money;
        lsgd['thoiGian'] = layThoiGianHienTai();
        lsgd['trangThai'] = 1;
        lsgd['loaiGD'] = 3;
        fetch('http://127.0.0.1:8000/api/lichsugiaodich',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify(lsgd)
        })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    toastr.success(data.success)
                    window.location.href = "/booking"
                }
                else
                    toastr.error(data.error)
            })
    }
    function createThongBaoHuy(maNguoiDung, maSan){
        let dataThongBao = {}
        dataThongBao['loaiTB'] = 2
        dataThongBao['maNguoiDung'] = maNguoiDung
        dataThongBao['tieuDe'] = "Sân "+maSan+ " bảo trì."
        dataThongBao['noiDung'] = "Sân quý khách đặt hiện tại đã hủy vì đang bảo trì để mang lại trải nghiệm tốt nhất. Số tiền đặt sân sẽ hoàn lại 100%."
        
        fetch("http://127.0.0.1:8000/api/thongbao", {
            method: "POST",
            headers: {
                // "Content-Type": "application/x-www-form-urlencoded", x-www-form-urlencoded: form data
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
    function sendMail(maCTTS, maSan, money, thoiGianBatDau, thoiGianKetThuc, taiKhoan){
        fetch('http://127.0.0.1:8000/booking',{
            method: 'post',
            headers: {
                'Content-type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
