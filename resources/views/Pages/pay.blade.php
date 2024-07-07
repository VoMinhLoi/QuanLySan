<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('Library.grid_system')
    @include('Library.responsive')
    @include('Library.variable')
    @include('Library.validator')
    <style>
        .content {
        }
        .content-title {
            background: black;
            color: white;
            text-transform: uppercase;
            padding: 4px 8px;
        }
        label, input, select, textarea {
            color: #777777;
            font-size: 14px;
        }
        input, select, textarea {
            border: 1px solid #ccc;
            width: 100%;
            padding: 4px 8px; 
        }
        table {
            width: 100%;
        }
        td {
            border: 1px solid #ccc;
        }
        .bill-infor {
            display: flex;
            justify-content: space-between;
            padding: 8px 0px;
            border-bottom: 1px solid #ccc;
            margin: 0 8px ;
        }
        .bill-infor-wrapper {
            width: 100%;
        }
        .btn {
            color: white;
            padding: 3px 8px;
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
                    breadCrumbHeading.innerText = 'Thanh toán'
                </script>
                <div class="row" style="margin-top: 12px">
                    <div class="col l-6 m-6 c-12">
                        <div class="content">
                            <h1 class="content-title">Thông tin giao hàng</h1>
                            <div class="row">
                                <div class="col l-6 m-6 c-6">
                                    <label for="ho">Họ*</label>
                                    <br>
                                    <input type="text" name="ho" id="ho" value="{{ Auth::user()->ho }}" required>
                                </div>
                                <div class="col l-6 m-6 c-6">
                                    <label for="ten">Tên*</label>
                                    <br>
                                    <input type="text" name="ten" id="ten" value="{{ Auth::user()->ten }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-12 m-12 c-12">
                                    <label for="maTT">Tỉnh/Thành phố*</label>
                                    <br>
                                    <select id="maTT">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-12 m-12 c-12">
                                    <label for="maQH" >Quận huyện*</label>
                                    <br>
                                    <select id="maQH">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-12 m-12 c-12">
                                    <label for="maPX">Phường xã*</label>
                                    <br>
                                    <select name="maPX" id="maPX" required>
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-12 m-12 c-12">
                                    <label for="diaChi">Địa chỉ*</label>
                                    <br>
                                    <input type="text" name="diaChi" id="diaChi" value="{{ Auth::user()->diaChi }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-6 m-6 c-6">
                                    <label for="sdt">Số điện thoại*</label>
                                    <br>
                                    <input type="text" name="ho" id="sdt" value="{{ Auth::user()->SDT }}" required>
                                </div>
                                <div class="col l-6 m-6 c-6">
                                    <label for="taiKhoan">Email*</label>
                                    <br>
                                    <input type="text" name="taiKhoan" id="taiKhoan" value="{{ Auth::user()->taiKhoan }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-12 m-12 c-12">
                                    <label for="ghiChu">Ghi chú</label>
                                    <br>
                                    <textarea name="ghiChu" id="ghiChu" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l-6 m-6 c-12">
                        <div class="content">
                            <h1 class="content-title">đơn hàng</h1>
                            <div class="row">
                                <div class="col l-12 m-12 c-12">
                                    <table>
                                        <thead>
                                            <th>Dụng cụ</th>
                                            <th>Tổng giá</th>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < 2; $i++)
                                                <tr>
                                                    <td style="padding-left: 8px">
                                                        Dụng cụ hỗ trợ
                                                        <br>
                                                        X2
                                                    </td>
                                                    <td style="text-align: center">800.000VND</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row bill-infor-wrapper">
                                <div class="col l-12 m-12 c-12 bill-infor">
                                    <h1>Tổng cộng</h1>
                                    <p id="totalPrice">1.250.000 <sup>₫</sup></p>
                                </div>
                            </div>
                            <div class="row bill-infor-wrapper">
                                <div class="col l-12 m-12 c-12 bill-infor">
                                    <h1>Phí ship</h1>
                                    <p>0 <sup>₫</sup></p>
                                </div>
                            </div>
                            <div class="row bill-infor-wrapper">
                                <div class="col l-12 m-12 c-12 bill-infor">
                                    <h1>Mã giảm giá</h1>
                                    <p id="discountPrice">0 <sup>₫</sup></p>
                                </div>
                            </div>
                            <div class="row bill-infor-wrapper">
                                <div class="col l-12 m-12 c-12 bill-infor">
                                    <h1>Cần thanh toán</h1>
                                    <p id="payTotalPrice">1.250.000 <sup>₫</sup></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-12 m-12 c-12">
                                    <label for="maKhuyenMai">Nhập mã khuyến mãi</label>
                                    <br>
                                    <input type="text" name="maKhuyenMai" id="maKhuyenMai" placeholder="A2CFCCM" style="width: fit-content" minlength="7" maxlength="7"> 
                                    <button class="btn" style="background: var(--primary-color)" id="discount_btn">Sử dụng</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-12 m-12 c-12" style="display: flex;">
                                    <input type="checkbox" name="thanhToan" id="thanhToan" placeholder="A2CFCCM" style="width: fit-content"> 
                                    <label for="thanhToan" style="margin-left: 4px">Thanh toán online</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-12 m-12 c-12">
                                    <input type="submit" class="btn" style="background: black; width: fit-content" value="Xác nhận">
                                </div>
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
    var tongTienGlobal = 1000000
    var tongTienPhaiTraGlobal
    var tienKhuyenMaiGlobal 
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
        const discountButtonView = document.querySelector('#discount_btn')
        const discountCodeInputView = document.querySelector('#maKhuyenMai')
        const discountPriceView = document.querySelector('#discountPrice')
        const payMustToTalPricePriceView = document.querySelector('#payTotalPrice')
        const apiKhuyenMai = "http://127.0.0.1:8000/api/khuyenmai"
        discountButtonView.onclick = () => {
            const maKhuyenMai = discountCodeInputView.value;
            if(maKhuyenMai.length === 7){
                const intTypeNgayHienTai = new Date()
                fetch(apiKhuyenMai + "/" + maKhuyenMai)
                    .then(promise => promise.json())
                    .then(khuyenMai => {
                        if (!khuyenMai.thoiGianBatDau || !khuyenMai.thoiGianKetThuc) {
                            throw new Error('Missing required date fields');
                        }
                        const intTypeNgayBatDau = new Date(khuyenMai.thoiGianBatDau);
                        const intTypeNgayKetThuc = new Date(khuyenMai.thoiGianKetThuc);

                        console.log("Parsed dates:", intTypeNgayBatDau, intTypeNgayKetThuc); // Debugging line

                        if (intTypeNgayBatDau.getTime() <= intTypeNgayHienTai.getTime() && intTypeNgayHienTai.getTime() <= intTypeNgayKetThuc.getTime()) {
                            if(khuyenMai.dieuKienGia)
                                if(tongTienGlobal >= khuyenMai.dieuKienGia){
                                    if(khuyenMai.gia > 1)
                                        tongTienPhaiTraGlobal = tongTienGlobal - khuyenMai.gia
                                    else
                                        tongTienPhaiTraGlobal = tongTienGlobal * (1 - parseFloat(khuyenMai.gia))
                                    tienKhuyenMaiGlobal = tongTienGlobal - tongTienPhaiTraGlobal
                                    discountPriceView.innerText = formatCurrency(tienKhuyenMaiGlobal)
                                    payMustToTalPricePriceView.innerText = formatCurrency(tongTienPhaiTraGlobal)
                                }
                                else 
                                    toastr.error('Không đủ điều kiện.');
                            else{
                                if(khuyenMai.gia > 1)
                                        tongTienPhaiTraGlobal = tongTienGlobal - khuyenMai.gia
                                else
                                    tongTienPhaiTraGlobal = tongTienGlobal * (1 - parseFloat(khuyenMai.gia))
                                tienKhuyenMaiGlobal = tongTienGlobal - tongTienPhaiTraGlobal
                                discountPriceView.innerText = formatCurrency(tienKhuyenMaiGlobal)
                                payMustToTalPricePriceView.innerText = formatCurrency(tongTienPhaiTraGlobal)
                            }
                        } else {
                            toastr.error('Thời gian sử dụng không hợp lệ.');
                        }
                    })
                    .catch(error => {
                        toastr.error('Mã không tồn tại.');
                    })
            }
            else
                toastr.error('Mã không hợp lệ.');
        }
        function formatCurrency(input) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(input);
        }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>