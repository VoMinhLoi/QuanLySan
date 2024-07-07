<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('Library.grid_system')
    @include('Library.responsive')
    @include('Library.variable')
    @include('Library.validator')
    <style>
        .coupon {
            background: var(--primary-color);
            color: white;
            border-radius: 8px;
        }
        .coupon + .coupon {
            margin-left: 8px;
        }
        .coupon-logo {
            border-right: 1px dashed white;
            text-align: center;
        }
        .coupon-infor {
            font-size: 14px; 
        }
    </style>
    {{-- CSS container --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="grid">
        @include('Components.header')
        
        <div class="container">
            <div class="grid wide" >
                @include('Components.breadcrumb')
                <script>
                    breadCrumbHeading.innerText = 'Danh sách các voucher'
                </script>
                <div class="row" style="margin-top: 12px">
                    @foreach ($khuyenMais as $item)
                        <div class="col l-3 m-4 c-12 coupon">
                            <div class="row" style="align-items: center">
                                <div class="col l-3 m-3 c-3 coupon-logo">
                                    <img src="https://minhloiiot.id.vn/assets/img/Logo-Truong-Dai-hoc-The-duc-The-thao-Da-Nang.png" alt="logo">
                                    <p>Mall</p>
                                </div>
                                <div class="col l-9 m-9 c-9 coupon-infor">
                                    @if($item->gia > 1)
                                        <h1>Mã giảm {{ number_format($item->gia/1000, 0, ',', '.') }}k</h1>
                                    @else
                                        <h1>Mã giảm {{ $item->gia *100 }}%</h1>
                                    @endif
                                    <ul>
                                        @if (empty($item->dieuKienGia))
                                            ĐH tối thiểu: 0 <sup>₫</sup>
                                        @else
                                            ĐH tối thiểu: {{ number_format($item->dieuKienGia, 0, ',', '.') }}<sup>₫</sup>
                                        @endif
                                        <li>Từ {{\DateTime::createFromFormat('Y-m-d H:i:s',  $item->thoiGianBatDau)->format('d-m-Y H:i:s') }}</li>
                                        <li>Đến {{\DateTime::createFromFormat('Y-m-d H:i:s',  $item->thoiGianKetThuc)->format('d-m-Y H:i:s') }}</li>
                                    </ul>
                                    <p style="display: flex; justify-content: space-between">{{ $item->maKhuyenMai }} <button onclick="copyDiscountCode('{{ $item->maKhuyenMai }}')">Sao chép <i class="fa-solid fa-copy"></i></button></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        @include('Components.footer')
    </div>
</body>
<script>
    function copyDiscountCode(maKhuyenMai){
        navigator.clipboard.writeText(maKhuyenMai)
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>