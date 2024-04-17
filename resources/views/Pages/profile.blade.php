<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
            }
            .form {
                box-shadow: unset;
                flex: 1;
            }
        </style>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div class="grid">
            @include('Components.header')
            <div class="container">
                <div class="grid wide">
                    @include('Components.breadcrumb')
                    <script>
                        breadCrumbHeading.innerText = 'Hồ sơ cá nhân'
                    </script>
                    <div class="image">
                        <img src="./assets/img/coverimage.jpg" alt="coverimage" class="coverimage">
                        <div class="avatar">
                            @if (Auth::user()->hinhDaiDien)
                                <img class="over-image" src="assets/img/{{ Auth::user()->hinhDaiDien }}" alt="avatar">
                            @else
                                <img class="over-image" src="assets/img/avatarmacdinh.jpg" alt="avatar">
                            @endif
                            <input type="file" class="choose-avatar" hidden id="choose-avatar">
                            <label for="hinhDaiDien" title="Cập nhật ảnh" class="choose-avatar"><i class="fa-solid fa-camera"></i></label>
                            <p class="fullname">{{ Auth::user()->ho . Auth::user()->ten }}</p>
                        </div>
                    </div>

                    <div class="row no-gutters content">
                        <div class="col l-3 m-3 c-12">
                            <ul class="side-bar">
                                <li class="side-bar__item"><a href="#" class="side-bar__item-link side-bar__item-link--active">Thông tin cá nhân</a></li>
                                <li class="side-bar__item"><a href="#" class="side-bar__item-link">Đổi mật khẩu</a></li>
                                <li class="side-bar__item"><a href="/dangxuat" class="side-bar__item-link">Đăng xuất</a></li>
                            </ul>
                        </div>
                        <div class="col l-9 m-9 c-12">
                            <div class="main">
                                <form action="" method="POST" class="form" id="form-1">
                                    <h3 class="heading"> Thông tin cá nhân</h3>
                            
                                    <div class="spacer"></div>
                                    <div class="form-group">
                                        <p class="form-label">Số dư tài khoản: <i style="color: var(--primary-color)">{{number_format(Auth::user()->soDuTaiKhoan, 0, ',', '.')}} <sup>đ</sup></i></p>
                                    </div>
                                    <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input
                                        type="text"
                                        placeholder="{{ Auth::user()->taiKhoan }}"
                                        class="form-control"
                                        disabled
                                    />
                                    <span class="form-message"></span>
                                    </div>
    
                                    <div class="form-group">
                                        <label for="ho" class="form-label">Họ</label>
                                        <input
                                        id="ho"
                                        name="ho"
                                        type="text"
                                        value="{{ Auth::user()->ho }}"
                                        class="form-control"
                                        />
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="ten" class="form-label">Tên</label>
                                        <input
                                        id="ten"
                                        name="ten"
                                        type="text"
                                        value="{{ Auth::user()->ten }}"
                                        class="form-control"
                                        />
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group">
                                    <label for="ngaySinh" class="form-label">Ngày sinh</label>
                                    <input
                                            id="ngaySinh"
                                            name="ngaySinh"
                                            type="text"
                                            placeholder="dd/mm/yyyy"
                                            value="{{ \Carbon\Carbon::parse(Auth::user()->ngaySinh)->format('d-m-Y') }}"
                                            class="form-control"
                                        />
                                    <span class="form-message"></span>
                                    </div>
                                    <div class="form-group">
                                    <label for="cccd" class="form-label">CCCD</label>
                                    <input
                                        id="cccd"
                                        name="cccd"
                                        type="text"
                                        value="{{ Auth::user()->cccd }}"
                                        class="form-control"
                                    />
                                    <span class="form-message"></span>
                                    </div>
                                    <div class="form-group">
                                    <label for="SDT" class="form-label">Số điện thoại</label>
                                    <input
                                        id="SDT"
                                        name="SDT"
                                        type="text"
                                        value="{{ Auth::user()->SDT }}"
                                        class="form-control"
                                    />
                                    <span class="form-message"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="maTT" class="form-label">Tỉnh thành</label>
                                        <select class="form-control" id="maTT">
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
                                    <span class="form-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="maQH" class="form-label">Quận huyện</label>
                                        <select class="form-control" id="maQH">
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
                                    <span class="form-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="maPX" class="form-label">Phường xã</label>
                                        <select name="maPX" class="form-control" id="maPX">
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
                                    <span class="form-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="diaChi" class="form-label">Địa chỉ</label>
                                        <input
                                        id="diaChi"
                                        name="diaChi"
                                        type="text"
                                        placeholder="Số đường, tổ, xóm, thôn, làng"
                                        value="{{ Auth::user()->diaChi }}"
                                        class="form-control"
                                        />
                                        <span class="form-message"></span>
                                    </div>

                                    <input name="hinhDaiDien" type="file" class="choose-avatar" hidden id="hinhDaiDien"/>
                                    <button class="form-submit">Lưu</button>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('Components.footer')
        </div>
        {{-- Validator --}}
        <script>
            var apiUser = "http://127.0.0.1:8000/api/user"
            Validator({
              form: "#form-1",
              rules: [
                Validator.minLength("#cccd", 12, 'Yêu cầu căn cước công dân nhập 12 kí tự'),
                Validator.minLength("#SDT",10, 'Yêu cầu số điện thoại từ 10 - 11 số'),
              ],
              errorSelector: ".form-message",
              buttonSubmitSelector: ".form-submit",
              // Muốn submit không theo API mặc định của trình duyệt
              onSubmit: function (data) {
                if(data.hinhDaiDien[0]){
                    var formData = new FormData()
                    formData.append('ho', data.ho)
                    formData.append('ten', data.ten)
                    formData.append('ngaySinh', data.ngaySinh)
                    formData.append('gioiTinh', data.gioiTinh)
                    formData.append('cccd', data.cccd)
                    formData.append('diaChi', data.diaChi)
                    formData.append('SDT', data.SDT)
                    formData.append('maPX', data.maPX)
                    formData.append('hinhDaiDien', data.hinhDaiDien)
                    fetch(apiUser+'/{{ Auth::user()->maNguoiDung }}',{
                        method: 'PUT',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.error)
                            toastr.error(data.error)
                        else
                            toastr.success(data.success)
                    })
                }
                else{
                    UpdateNoImage(data)
                }

              },
              formGroupSelector: ".form-group",
            });
            function UpdateNoImage(data){
                fetch(apiUser+'/{{ Auth::user()->maNguoiDung }}',{
                    method: 'PUT', // hoặc 'POST' tùy thuộc vào yêu cầu của bạn
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if(data.error)
                        toastr.error(data.error)
                    else
                        toastr.success(data.success)
                })
            }
        </script>
        <script>
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
        </script>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>