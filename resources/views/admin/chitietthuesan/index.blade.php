
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
                    </tr>
                </thead>
                    <tbody >
                        @foreach ($chiTietThueSan as $item)
                            <tr class="{{ "row-".$item->id }} ">
                                <td>
                                    {{'V'.$item->maVe }}
                                </td>
                                <td>
                                    {{$item->maSan }}
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
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
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
</script>