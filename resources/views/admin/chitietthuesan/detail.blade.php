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
                        <button id="yard-change-button" class="btn-success" onclick="updateChiTietThueSan('{{ $chiTietThueSan->maCTTS }}', '{{ $chiTietThueSan->maSan }}', '{{ $chiTietThueSan->thoiGianBatDau }}', '{{ $chiTietThueSan->thoiGianKetThuc }}')" style="margin-bottom: 8px">Sửa</button>
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
