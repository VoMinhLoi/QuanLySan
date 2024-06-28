
<style>
    .hour-start--busy{
        background: red;
        color: white;
    }
</style>
@extends('admin.layout.layout')
@section('contents')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lịch đặt sân</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý sân</li>
                <li class="breadcrumb-item">Lịch đặt sân</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <form style="margin-left: 12px" onsubmit="seeCalendar(event)">
        <select name="maSan" id="maSan" required style="height: 29px">
            @php
                $sanBongs = App\Models\SanBong::all();
            @endphp
            @foreach($sanBongs as $item)
                <option value="{{ $item->maSan }}">{{ $item->maSan . " - " . $item->tenSan }}</option>
            @endforeach
        </select>
        <input type="date" name="thoiGianBatDau" id="thoiGianBatDau" required>
        <button type="submit" id="btn-see-calendar" class="btn-primary">Xem lịch</button>
    </form>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lịch đặt sân</h3>
        
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
            <table class="table table-striped projects text-center">
                <thead >
                    <tr>
                        <th style="width: 10%">
                            Mã vé
                        </th>
                        <th style="width: 10%">
                            Mã sân
                        </th>
                        <th style="width: 10%">
                            Mã người dùng đặt
                        </th>
                        <th style="width: 10%">
                            Tên người dùng
                        </th>
                        <th style="width: 10%">
                            Địa chỉ
                        </th>
                        <th style="width: 10%">
                            Số điện thoại
                        </th>
                        <th style="width: 10%">
                            Thời gian bắt đầu
                        </th>
                        <th style="width: 10%">
                            Thời gian kết thúc
                        </th>
                        <th style="width: 10%">
                            Tổng tiền
                        </th>
                        <th style="width: 10%">
                            Ghi chú
                        </th>
                        <th style="width: 10%">
                            Hành động
                        </th>
                    </tr>
                </thead>
                    <tbody >
                        @foreach ($chiTietThueSan as $item)
                            <tr class="{{ "row-".$item->id }} ">
                                <td>
                                    {{'V'.$item->maVe . ' - CTTS'.$item->maCTTS }}
                                </td>
                                <td id="td-maSan">
                                    {{$item->maSan }}
                                    @php
                                        $tenSan = App\Models\SanBong::where('maSan',$item->maSan)->first()->tenSan;
                                    @endphp
                                    {{ ' - '. $tenSan }}
                                </td>
                                @php
                                    $ve = App\Models\Ve::where('id',$item->maVe)->first();
                                @endphp
                                <td class="column-name-branch">
                                    {{ 'ND'.$ve->maNguoiDung }}
                                </td>
                                <td class="column-name-branch">
                                    {{ $ve->hoTen }}
                                </td>
                                <td class="column-name-branch">
                                    @php
                                        $phuongXa = App\Models\PhuongXa::where('maPhuongXa', $ve->maPX)->first();
                                        $tenPX = $phuongXa->tenPhuongXa;
                                        $quanHuyen = App\Models\QuanHuyen::where('maQuanHuyen', $phuongXa->maQH)->first();
                                        $tenQH = $quanHuyen->tenQuanHuyen;
                                        $tenTT = App\Models\TinhThanh::where('maTinhThanh', $quanHuyen->maTT)->first()->tenTinhThanh;
                                    @endphp
                                    {{ $ve->diaChi.", ".$tenPX.", ".$tenQH.", ".$tenTT }}
                                </td>
                                <td class="column-name-branch">
                                    {{ $ve->SDT }}
                                </td>
                                <td class="project-state column-time-open">
                                    {{\DateTime::createFromFormat('Y-m-d H:i:s',  $item->thoiGianBatDau)->format('d-m-Y H:i:s') }}
                                </td>
                                <td class="project-state column-time-open">
                                    {{\DateTime::createFromFormat('Y-m-d H:i:s',  $item->thoiGianKetThuc)->format('d-m-Y H:i:s') }}
                                </td>
                                <td class="column-name-branch">
                                    <strong>{{ number_format($ve->tongTien, 0, ',', '.') }} <sup>₫</sup></strong>
                                </td>
                                <td class="column-name-branch"> 
                                    @php
                                        $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
                                        $batDau = new DateTime($item->thoiGianBatDau, $timezone);
                                        $hienTai = new DateTime('now', $timezone);
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
                                    @if (!empty($item->deleted_at))
                                        <span style="color: red">Đã hủy</span><br/>
                                        @if (isset($item->maDungCu))
                                            Thuê {{ $item->maDungCu }}
                                            <br/>
                                            Số lượng: {{ $item->soLuong }}
                                        @endif
                                    @else 
                                        @if ($tongSoGiay < 0)
                                            Đã sử dụng.<br/>
                                        @endif
                                        @if (isset($item->maDungCu))
                                            @if ($item->daTra == 0)
                                                <div class="return-tool-panel-{{ $item->maCTTS }}">
                                                    Thuê {{ $item->maDungCu }}
                                                    <br/>
                                                    Số lượng: {{ $item->soLuong }}
                                                    <button onclick="returnTool('{{ $item->maCTTS }}', '{{ $item->maDungCu }}', '{{ $item->soLuong }}')" style="margin-top: 2px">Nhận lại dụng cụ thuê</button>
                                                </div>
                                            @else
                                                Đã trả dụng cụ {{ $item->maDungCu }} với số lượng {{ $item->soLuong }}
                                            @endif
                                        @endif
                                    @endif
                                   
                                </td>
                                <td id="td-action">
                                    @if (!empty($item->deleted_at))
                                        
                                    @else 
                                        @if($tongSoGiay > 3600)
                                            <button id="yard-change-button" class="btn-success" onclick="updateChiTietThueSan('{{ $item->maCTTS }}', '{{ $item->maSan }}', '{{ $item->thoiGianBatDau }}', '{{ $item->thoiGianKetThuc }}', '{{ $giaDichVu = App\Models\SanBong::where('maSan',$item->maSan)->first()->giaDichVu; }}')" style="margin-bottom: 8px">Sửa</button>
                                        @endif
                                    @endif
                                    @php
                                        $existBaoTri = App\Models\SanBong::where('maSan',$item->maSan)->where('trangThai',0)->first();
                                        $existChuaXoa = App\Models\ChiTietThueSan::withoutTrashed()->where('maCTTS',$item->maCTTS)->first();
                                    @endphp
                                    @if ($tongSoGiay > 0)
                                        @if(!empty($existBaoTri))
                                            @if(!empty($existChuaXoa))
                                                <button class="btn-danger" onclick="handleDeleteChiTietThueSan('{{ $item->maCTTS }}')">Bảo trì</button>
                                            @endif
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            <div style="margin: 12px auto 0">
                {{-- class="pagination" --}}
                {{ $chiTietThueSan->links() }}
                {{-- {{ $chiTietThueSan->links('pagicustom') }} pagicustom: view --}}
            </div>
            <!-- /.card-body -->
        </div>
        <div class="over-lay display-none">
            @include('admin.chitietthuesan.update')
        </div>
        <p style="text-align: center">
            Chỉnh sửa thông tin sân trước <span style="color: red">1 tiếng thời gian bắt đầu</span>. Qua <span style="color: red">1 tiếng trước thời gian bắt đầu</span> không thể thay đổi.
        </p>
        <div class="over-wrapper display-none"
            style="    position: fixed;
            padding-top: 12px;
            top: 30%;
            background: white;
            text-align: center;
            width: 500px;
            border: 1px solid black;
            border-radius: 4px;
            left: 40%;
            z-index: 3;
            ">
            <h1>Bảng lịch đặt sân vé</h1>
            <div class="hour-start-wrapper"
                style="display: flex;
                flex-wrap:wrap;
                justify-content: center">
                @for ($i = 0; $i <= 23; $i++)
                    <a id=".hour-start-{{ $i }}" class="hourStart" style="    border: 1px solid black;
                    width: 60px;
                    height: 60px;
                    margin: 4px;
                    text-align: center;
                    line-height: 60px;
                    display: block;
                    font-size: 9px;" target="_blank" href="#">{{ $i  }}</a>
                @endfor
            </div>
            <button id="hidden-calendar" class="btn-primary" style="margin-bottom: 12px" onclick="hanldeCloseCalendar()">Đóng</button>
    </div>
    </section>
@endsection
<script>
    function returnTool(maCTTS, maDungCu, soLuong){
        let returnToolPanel = document.querySelector('.return-tool-panel-'+maCTTS)
        if(confirm("Bạn đã kiểm tra dụng cụ thuê và người dùng đã trả dụng cụ đầy đủ?")){
            returnToolPanel.innerHTML = "Đã trả dụng cụ " + maDungCu + " với số lượng "+soLuong
            fetch("http://127.0.0.1:8000/api/chitietthuesan/"+maCTTS,{
                method: "PUT",
                headers: {
                    // "Content-Type": "application/x-www-form-urlencoded", x-www-form-urlencoded: form data
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                // body: JSON.stringify(data),
                body: JSON.stringify({ daTra: 1 }),
            })
                .then(response => response.json())
                .then(data =>{
                    if(data.success){
                        toastr.success(data.success)
                        fetch("http://127.0.0.1:8000/api/dungcu/"+maDungCu, {
                            method: "PUT",
                            headers: {
                                // "Content-Type": "application/x-www-form-urlencoded", x-www-form-urlencoded: form data
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                            // body: JSON.stringify(data),
                            body: JSON.stringify({ soLuongChoThue: -soLuong }),
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
                    else
                        toastr.error(data.error)

                })
        }
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
    function handleDeleteChiTietThueSan(maCTTS){
        Refund(maCTTS)
    }
    function Refund(maCTTS){
        getOneChiTietThueSan(maCTTS, CTTS => 
            getVe(CTTS.maVe, ve => {
                updateUserMoney(ve.tongTien, maCTTS, ve.maNguoiDung, CTTS.maSan)
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
    function updateUserMoney(money, maCTTS, maNguoiDung, maSan){
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
    let dataChiTietThueSansGlobal;

    fetch('http://127.0.0.1:8000/api/chitietthuesan')
        .then(response => response.json())
        .then(data => { 
            dataChiTietThueSansGlobal = data;
            // console.log(dataChiTietThueSansGlobal);
        })
        .catch(error => console.error('Error fetching data:', error));

    function seeCalendar(e) {
        const overWrapper = document.querySelector('.over-wrapper')
        overWrapper.classList.remove('display-none')
        e.preventDefault();
        const maSanView = document.querySelector('#maSan').value;
        const thoiGianBatDau = document.querySelector('#thoiGianBatDau').value;

        var allHours = document.querySelectorAll('.hourStart');
        allHours.forEach(function(p, index) {
            p.href = "#"
            p.innerText = index
            p.classList.remove('hour-start--busy')
        });
        // Example usage of dataChiTietThueSansGlobal
        if (dataChiTietThueSansGlobal) {
            
            const filteredDataBatDau = dataChiTietThueSansGlobal.filter(item => {
                const formatThoiGianBatDau = item.thoiGianBatDau.split(" ")[0];
                return item.maSan === maSanView && formatThoiGianBatDau === thoiGianBatDau;
            });
            filteredDataBatDau.forEach(sanBong => {
                
                // const wrapperHourStartView = document.querySelector('.hour-start-wrapper')
                // const formatThoiGianBatDauYYYYMMDD = sanBong.thoiGianBatDau.split(" ")[0]
                // const formatThoiGianKetThucYYYYMMDD = sanBong.thoiGianKetThuc.split(" ")[0]
                let hourStart = parseInt(sanBong.thoiGianBatDau.split(" ")[1].split(":")[0])
                let hourEnd = parseInt(sanBong.thoiGianKetThuc.split(" ")[1].split(":")[0])

                const hourBorrow = hourEnd - hourStart
                if(hourBorrow >= 0){
                    if(hourBorrow === 1)
                        allHours.forEach(function(p) {
                            var hourValue = parseInt(p.innerText);
                            if (hourValue === hourStart){
                                p.href = "http://127.0.0.1:8000/booking/" + sanBong.maCTTS
                                p.innerText += " - CTTS"+sanBong.maCTTS
                                p.classList.add('hour-start--busy')
                            }
                        });
                    else
                        allHours.forEach(function(p) {
                            var hourValue = parseInt(p.innerText);
                            if (hourStart <= hourValue && hourValue < hourEnd){
                                p.href = "http://127.0.0.1:8000/booking/" + sanBong.maCTTS
                                p.innerText += " - CTTS"+sanBong.maCTTS
                                p.classList.add('hour-start--busy')
                            }
                        });
                }
                else {
                    allHours.forEach(function(p) {
                        var hourValue = parseInt(p.innerText);
                        if (hourStart <= hourValue && hourValue <= 24){
                            p.href = "http://127.0.0.1:8000/booking/" + sanBong.maCTTS
                            p.innerText += " - CTTS"+sanBong.maCTTS
                            p.classList.add('hour-start--busy')
                        }
                    });
                }
            })
            const filteredDataKetThuc = dataChiTietThueSansGlobal.filter(item=> {
                const formatThoiGianBatDau = item.thoiGianBatDau.split(" ")[0];
                const formatThoiGianKetThuc = item.thoiGianKetThuc.split(" ")[0];
                return item.maSan === maSanView && formatThoiGianKetThuc === thoiGianBatDau && formatThoiGianBatDau !== thoiGianBatDau;
            })
            filteredDataKetThuc.forEach(sanBong => {
                let hourEnd = parseInt(sanBong.thoiGianKetThuc.split(" ")[1].split(":")[0])
                allHours.forEach(function(p) {
                    var hourValue = parseInt(p.innerText);
                    if (1 <= hourValue && hourValue < hourEnd){
                        p.href = "http://127.0.0.1:8000/booking/" + sanBong.maCTTS
                        p.innerText += " - CTTS"+sanBong.maCTTS
                        p.classList.add('hour-start--busy')
                    }
                });
            })
        } else {
            console.error('Data is not yet loaded');
        }
    }
    function hanldeCloseCalendar(){
        const overWrapper = document.querySelector('.over-wrapper')
        overWrapper.classList.add('display-none')
        var allHours = document.querySelectorAll('.hourStart');
        allHours.forEach(function(p, index) {
            p.href = "#"
            p.innerText = index
            p.classList.remove('hour-start--busy')
        });
    }
</script>