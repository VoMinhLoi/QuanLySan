<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('Library.grid_system')
    @include('Library.responsive')
    @include('Library.variable')
    @include('Library.validator')
    <style>
        @keyframes pullUp {
            0% {
                opacity: 0;
                transform: translateY(100%)
            }
            100% {
                opacity: 1;
                transform: translateY(0)
            }
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
                        <div class="content" style="animation: pullUp 0.3s linear 0s forwards;">
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
                        <div class="content" style="animation: pullUp 0.3s linear 0.1s forwards;">
                            <h1 class="content-title">đơn hàng</h1>
                            <div class="row">
                                <div class="col l-12 m-12 c-12">
                                    <table>
                                        <thead>
                                            <th>Dụng cụ</th>
                                            <th>Tổng giá</th>
                                        </thead>
                                        <tbody id="order-item-table-body">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row bill-infor-wrapper">
                                <div class="col l-12 m-12 c-12 bill-infor">
                                    <h1>Tổng cộng</h1>
                                    <p><span id="totalPrice">0</span></p>
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
                                    <p><span id="payTotalPrice">0</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-12 m-12 c-12">
                                    <label for="maKhuyenMai">Nhập mã khuyến mãi <a href="/discountlist" style="color: red" target="_blank">Lấy mã</a></label>
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
                                    <input onclick="handlePay()" type="submit" class="btn" style="background: black; width: fit-content" value="Xác nhận">
                                </div>
                                <div class="bound-pay display-none" style="margin-left: 8px">
                                    <span style="color: red; font-size: 14px">Vui lòng nạp tiền</span>
                                    <form id="form-recharge" class="sub-nav__item" method="POST" action="{{ url('/vnpay_payment') }}" target="_blank">
                                        @csrf
                                        <button type="submit" name="redirect" style="background: var(--primary-color); color: white; width: fit-content; padding: 0 8px; height: 40px;">Nạp tiền</button>
                                    </form>
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
    const urlParams = new URLSearchParams(window.location.search);
    const dataCTDonHangGlobal = JSON.parse(decodeURIComponent(urlParams.get('data')));
    var tongTienGlobal = parseFloat(urlParams.get('price'));
    const discountButtonView = document.querySelector('#discount_btn')
    const discountCodeInputView = document.querySelector('#maKhuyenMai')
    const discountPriceView = document.querySelector('#discountPrice')
    const totalPriceView = document.querySelector('#totalPrice')
    const payMustToTalPricePriceView = document.querySelector('#payTotalPrice')
    const orderItemsTableBodyView = document.querySelector('#order-item-table-body')
    const addressInputView = document.querySelector('#diaChi')
    const phoneInputView = document.querySelector('#sdt')
    const maNguoiDung = '{{ Auth::user()->maNguoiDung }}'
    const hoInputView = document.querySelector('#ho')
    const tenInputView = document.querySelector('#ten')
    const ghiChuTextAreaView = document.querySelector('#ghiChu')
    const thanhToanCheckboxView = document.querySelector('#thanhToan')
    const payView = document.querySelector('.bound-pay');
    let dataDonHangGlobal = {}

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
        totalPriceView.innerText = formatCurrency(tongTienGlobal)
        tongTienPhaiTraGlobal = tongTienGlobal
        payMustToTalPricePriceView.innerText = formatCurrency(tongTienPhaiTraGlobal)
        dataCTDonHangGlobal.forEach((donHang)=>{
            orderItemsTableBodyView.innerHTML +=    `
                                                    <tr>
                                                            <td style="padding-left: 8px; display: flex;" >
                                                                <img src="https://minhloiiot.id.vn/assets/img/${donHang.hinhAnh1}" height="50px" width="50px">
                                                                <div style="margin-left: 8px">
                                                                    ${donHang.tenDungCu}
                                                                    <br>
                                                                    ${formatCurrency(donHang.donGiaGoc)} X ${donHang.soLuong}
                                                                </div>
                                                            </td>
                                                            <td style="text-align: center">${formatCurrency(donHang.tongTien)}</td>
                                                    </tr>
                                                    `
        })
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

                        // console.log("Parsed dates:", intTypeNgayBatDau, intTypeNgayKetThuc); // Debugging line

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
                                    payView.classList.add('display-none')
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
        function handlePay(){
            dataDonHangGlobal['maNguoiDung'] = parseInt(maNguoiDung)
            dataDonHangGlobal['diaChi'] = addressInputView.value
            dataDonHangGlobal['sdt'] = phoneInputView.value
            if(dataDonHangGlobal['diaChi']){
                if(dataDonHangGlobal['sdt']){
                    dataDonHangGlobal['tongTien'] = tongTienPhaiTraGlobal
                    dataDonHangGlobal['maPX'] = wardList.value
                    dataDonHangGlobal['hoTen'] = hoInputView.value + " " + tenInputView.value
                    dataDonHangGlobal['giamGia'] = tienKhuyenMaiGlobal
                    dataDonHangGlobal['ghiChu'] = ghiChuTextAreaView.value
                    if(thanhToanCheckboxView.checked){
                        dataDonHangGlobal['phuongThucThanhToan'] = 1
                        fetch('http://127.0.0.1:8000/api/user/'+maNguoiDung)
                            .then(response => response.json())
                            .then(data => {
                                if(data.soDuTaiKhoan < tongTienPhaiTraGlobal){
                                    toastr.error("Số tiền của quý khách không đủ để thanh toán")
                                    payView.classList.remove('display-none')
                                    setTimeout(transferToTalPriceToVNpay(), 1000)
                                    function transferToTalPriceToVNpay(){
                                        var formRecharge = document.querySelector('#form-recharge'); // Assuming .sub-nav__item contains a form element
                                        var input = document.createElement('input');
                                        Object.assign(input, {
                                            type: "hidden",
                                            name: "totalPrice", // Assuming totalPrice is a variable containing the name
                                            value: Math.ceil(tongTienPhaiTraGlobal - data.soDuTaiKhoan) // Assuming totalPrice is a variable containing the value
                                        });
                                        formRecharge.appendChild(input);
                                    }
                                }
                                else{
                                    payView.classList.add('display-none')
                                    toastr.success("Thanh toán thành công")
                                    dataDonHangGlobal['daThanhToan'] = 1
                                    if(tongTienPhaiTraGlobal && dataCTDonHangGlobal && tongTienGlobal)
                                        createDonHang()
                                    else
                                        toastr.error('Bạn đã tự nhập thông tin trái phép.')
                                }
                            })
                    }
                    else{
                        dataDonHangGlobal['phuongThucThanhToan'] = 2
                        dataDonHangGlobal['daThanhToan'] = 0
                        if(tongTienPhaiTraGlobal && dataCTDonHangGlobal && tongTienGlobal){
                            createDonHang()
                            setTimeout(forwardsPage(), 15000)
                        }
                        else
                            toastr.error('Bạn đã tự nhập thông tin trái phép.')
                    }
                }
                else{
                    phoneInputView.focus()
                    toastr.error('Vui lòng nhập số điện thoại')
                }
            }
            else{
                addressInputView.focus()
                toastr.error('Vui lòng nhập địa chỉ')
            }
        }
        const token = document.querySelector("meta[name='csrf-token']").getAttribute('content')
        async function createDonHang(){
            // console.log(dataDonHangGlobal)

            fetch('http://127.0.0.1:8000/api/donhang',{
                method: 'post',
                headers:{
                    'content-type': 'application/json',
                    'x-csrf-token': token
                },
                body: JSON.stringify(dataDonHangGlobal)
            })
                .then(promise => promise.json())
                .then(data => {
                    if(data.success){
                        toastr.success(data.success)
                        createCTDH(data.maDonHang)
                        if(dataCTDonHangGlobal[0]['maGioHang']) deleteGioHang()
                        if(dataDonHangGlobal['daThanhToan']) createLichSuGiaoDich(data.maDonHang)
                    }
                    else{
                        toastr.error(data.error)
                    }
                })
        }
        function generateRandomString() {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            const charactersLength = characters.length;
            for (let i = 0; i < 7; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
        function createCTDH(maDonHang){
            dataCTDonHangGlobal.forEach((CTDH)=>{
                CTDH['maDonHang'] = maDonHang
                fetch('http://127.0.0.1:8000/api/chitietdonhang',{
                    method: 'post',
                    headers:{
                        'content-type': 'application/json',
                        'x-csrf-token': token
                    },
                    body: JSON.stringify(CTDH)
                })
                    .then(promise => promise.json())
                    .then(data => {
                        if(data.success)
                            toastr.success(data.success)
                        else{
                            toastr.error(data.error)
                        }
                    })
            })
        }
        function deleteGioHang(){
            dataCTDonHangGlobal.forEach((CTDH)=>{
                fetch("http://127.0.0.1:8000/api/giohang/" + CTDH.maGioHang,{
                    method: 'delete',
                    headers: {
                        'X-csrf-token': token,
                        'content-type': 'application/json'
                    }
                })
                    .then(promise => promise.json())
                    .then(data => {
                        if(data.success){
                            toastr.success(data.success)
                        }
                        else
                            toastr.error(data.error)
                    })
            })
        }
        function createLichSuGiaoDich(maDonHang){
            let dataLichSuGiaoDich = {}
            dataLichSuGiaoDich['maNguoiDung'] = maNguoiDung
            dataLichSuGiaoDich['ndck'] = "Thanh toán đơn hàng " + maDonHang
            dataLichSuGiaoDich['soTien'] = -tongTienPhaiTraGlobal
            // dataLichSuGiaoDich['trangThai'] = 1
            dataLichSuGiaoDich['loaiGD'] = 2
            dataLichSuGiaoDich['thoiGian'] = getCurrentDateTime()
            dataLichSuGiaoDich['_token'] = token
            fetch("http://127.0.0.1:8000/api/lichsugiaodich", {
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
                    // updateMoneyUserByTriggerDatabase()
                    updateMoneyUser()
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
        function updateMoneyUser(){
            
            fetch("http://127.0.0.1:8000/api/user/"+maNguoiDung, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token,
                },
                body: JSON.stringify({soDuTaiKhoan: -tongTienPhaiTraGlobal}),
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
                    forwardsPage()
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        async function forwardsPage(){
            window.location.href="/donhang"
        }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>