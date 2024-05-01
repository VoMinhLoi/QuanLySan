@extends('admin.layout.layout')
@include('Library.validator')
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cơ sở</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý sân</li>
                <li class="breadcrumb-item">Cơ sở</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tạo cơ sở</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="form-user">
                <div class="card-body">
                    <div class="form-group">
                        <label for="tenCoSo">Tên cơ sở</label>
                        <input name="tenCoSo" type="text" class="form-control" id="tenCoSo">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="moTa">Mô tả</label>
                        <input name="moTa" type="text" class="form-control" id="moTa" >
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="diaChi">Địa chỉ</label>
                        <input name="diaChi" type="text" class="form-control" id="diaChi" >
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="maTT" class="form-label">Tỉnh thành</label>
                        <select class="form-control" id="maTT">
                        </select>
                    <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="maQH" class="form-label">Quận huyện</label>
                        <select class="form-control" id="maQH">
                        </select>
                    <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="maPX" class="form-label">Phường xã</label>
                        <select name="maPX" class="form-control" id="maPX">
                        </select>
                    <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="thoiGianMoCua">Thời gian mở cửa</label>
                        <input name="thoiGianMoCua" type="number" class="form-control" id="thoiGianMoCua" placeholder="1-23">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="thoiGianDongCua">Thời gian đóng cửa</label>
                        <input name="thoiGianDongCua" type="number" class="form-control" id="thoiGianDongCua" placeholder="2-25">
                        <span class="form-message"></span>
                    </div>
                </div>
                <!-- /.card-body -->

                <button type="submit" class="btn btn-primary form-submit">Tạo</button>
            </form>
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Cơ sở</h3>
    
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
                            Mã cơ sở
                        </th>
                        <th style="width: 10%">
                            Tên cơ cở
                        </th>
                        <th style="width: 10%">
                            Mô tả
                        </th>
                        <th style="width: 10%">
                            Địa chỉ 
                        </th>
                        <th style="width: 10%">
                            Mã PX
                        </th>
                        <th style="width: 10%" class="text-center">
                            Thời gian mở cửa
                        </th>
                        <th style="width: 10%" class="text-center">
                            Thời gian đóng cửa
                        </th>
                        <th style="width: 10%" class="text-center">
                            Hành động
                        </th>
                    </tr>
                </thead>
                    <tbody id="branch-table-body" >
                        @foreach ($coso as $item)
                            <tr class="{{ "row-".$item->maCoSo }} ">
                                <td>
                                    {{$item->maCoSo }}
                                    
                                </td>
                                <td class="column-name-branch">
                                    {{ $item->tenCoSo }}
                                </td>
                                <td class="column-description">
                                    {{ $item->moTa }}
                                </td>
                                <td class="project_progress text-center">
                                    @php
                                        $phuongXa = App\Models\PhuongXa::where('maPhuongXa', $item->maPX)->first();
                                        $tenPX = $phuongXa->tenPhuongXa;
                                        $quanHuyen = App\Models\QuanHuyen::where('maQuanHuyen', $phuongXa->maQH)->first();
                                        $tenQH = $quanHuyen->tenQuanHuyen;
                                        $tenTT = App\Models\TinhThanh::where('maTinhThanh', $quanHuyen->maTT)->first()->tenTinhThanh;

                                    @endphp
                                    {{ $item->diaChi.", ".$tenPX.", ".$tenQH.", ".$tenTT }}
                                </td>
                                <td class="project_progress text-center">
                                    {{ $item->maPX }}
                                </td>
                                <td class="project-state column-time-open">
                                    {{ $item->thoiGianMoCua }}
                                </td>
                                <td class="project-actions column-time-close">
                                    {{ $item->thoiGianDongCua }}
                                    
                                </td>
                                <td class="project-actions text-right column-action">
                                    <a class="btn btn-info btn-sm" onclick="handleUpdatedCoSo({{ $item }})">
                                        Sửa
                                    </a>
                                    <a class="btn btn-danger btn-sm button-disable" onclick="handleDeleteCoSo('{{ $item->maCoSo }}')">
                                        <i class="fas fa-trash">
                                        </i>
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="over-lay display-none">
            @include('admin.coso.update')
        </div>
    </section>
    
    <script>
        var apiProvince = 'http://127.0.0.1:8000/api/tinhthanh'
        var apiDistrict = 'http://127.0.0.1:8000/api/quanhuyen'
        var apiWard = 'http://127.0.0.1:8000/api/phuongxa'
        var provinceList = document.querySelector('#maTT') 
        var districtList = document.querySelector('#maQH') 
        var wardList = document.querySelector('#maPX') 
        // console.log(provinceList, districtList, wardList)
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
            // if(provinceList.innerHTML.length === 77){
                provinces.forEach((province)=>{
                    var option = document.createElement("option")
                    option.value = province.maTinhThanh
                    option.innerText = province.tenTinhThanh
                    provinceList.appendChild(option)
                })
                getDistrict(districts => renderDistrict(districts))
                getWards(wards => renderWard(wards))
            // }
    
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
        function handleDeleteCoSo(maCoSo){
            deleteRowView(maCoSo);
            deleteCoSoInDatabase(maCoSo);
        }
        function deleteRowView(maCoSo){
            let rowIsDeletedView = document.querySelector('.row-'+maCoSo)
            rowIsDeletedView.remove();
        }
        function deleteCoSoInDatabase(maCoSo){
            fetch("http://127.0.0.1:8000/api/coso/"+maCoSo,{
                method: "delete",
                headers: {
                    // "Content-Type": "application/x-www-form-urlencoded", x-www-form-urlencoded: form data
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
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
    </script>
@endsection

<script>
    setTimeout(()=> {
        Validator({
            form: "#form-user",
            rules: [
                Validator.isRequired("#tenCoSo"),
                Validator.isRequired("#moTa"),
                Validator.isRequired("#diaChi"),
                Validator.isRequired("#maPX"),
                Validator.isRequired("#thoiGianMoCua"),
                // Validator.isNumber("#thoiGianMoCua"),
                Validator.isAllowHour("#thoiGianMoCua",1,23),
                Validator.isRequired("#thoiGianDongCua"),
                // Validator.isNumber("#thoiGianDongCua"),
                Validator.isAllowHour("#thoiGianDongCua",2,25),
                Validator.mustHigherOpen("#thoiGianDongCua","#thoiGianMoCua"),
            ],
            errorSelector: ".form-message",
            buttonSubmitSelector: ".form-submit",
            // Muốn submit không theo API mặc định của trình duyệt
            onSubmit: function (dataValid) {
                // console.log(dataValid)
                fetch("http://127.0.0.1:8000/api/coso", {
                    method: "POST",
                    headers: {
                        // "Content-Type": "application/x-www-form-urlencoded", x-www-form-urlencoded: form data
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    // body: JSON.stringify(data),
                    body: JSON.stringify(dataValid),
                })
                .then(response => {
                    return response.json(); // Chuyển đổi phản hồi sang JSON
                })
                .then(data => {
                    if(data.error)
                        toastr.error(data.error)
                    else{
                        toastr.success(data.success)
                        let formTableBodyUserView = document.querySelector('#branch-table-body')
                        renderRow(data.newCoSo, formTableBodyUserView)
                    }// Dữ liệu JSON trả về từ function store
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            },
            formGroupSelector: ".form-group",
        });
    }, 1000)
    function renderRow(coSo, formTableBodyUserView){
        // Render lại ô cập nhật
        let rowIsUpdatedView
        let columnTenCoSo
        let columnDescription
        let columnOpen
        let columnClose
        let columnAction
        if(!formTableBodyUserView){
            rowIsUpdatedView = document.querySelector('.row-'+coSo.maCoSo)
            columnTenCoSo = rowIsUpdatedView.querySelector('.column-name-branch')
            columnDescription = rowIsUpdatedView.querySelector('.column-description')
            columnOpen = rowIsUpdatedView.querySelector('.column-time-open')
            columnClose = rowIsUpdatedView.querySelector('.column-time-close')
            columnTenCoSo.innerText = coSo.tenCoSo
            columnDescription.innerText = coSo.moTa
            columnOpen.innerText = coSo.thoiGianMoCua
            columnClose.innerText = coSo.thoiGianDongCua
            columnAction = rowIsUpdatedView.querySelector('.column-action')
            console.log(columnAction)

            columnAction.innerHTML = `
                                    <td class="project-actions text-right column-action">
                                        <a class="btn btn-info btn-sm" onclick='handleUpdatedCoSo(${JSON.stringify(coSo)})'>
                                            Sửa
                                        </a>
                                        <a class="btn btn-danger btn-sm button-disable" onclick=handleDeleteCoSo('${coSo.maCoSo}')>
                                            <i class="fas fa-trash">
                                            </i>
                                            Xóa
                                        </a>
                                    </td>
                                    `
        }
        // Render dòng vừa tạo
        else{
            console.log(formTableBodyUserView)
            formTableBodyUserView.innerHTML +=  `
                                                <tr class="${ "row-"+coSo.maCoSo}">
                                                    <td>
                                                        ${coSo.maCoSo }
                                                    </td>
                                                    <td class="column-name-branch">
                                                        ${coSo.tenCoSo }
                                                    </td>
                                                    <td class="column-description">
                                                        ${coSo.moTa }
                                                    </td>
                                                    <td class="project_progress text-center">
                                                        
                                                        ${coSo.diaChi}
                                                    </td>
                                                    <td class="project_progress text-center">
                                                        ${coSo.maPX}
                                                    </td>
                                                    <td class="project-state column-time-open">
                                                        ${coSo.thoiGianMoCua}
                                                    </td>
                                                    <td class="project-actions column-time-close">
                                                        ${coSo.thoiGianDongCua}
                                                        
                                                    </td>
                                                    <td class="project-actions text-right column-action">
                                                        <a class="btn btn-info btn-sm" onclick=handleUpdatedCoSo('${JSON.stringify(coSo)}')>
                                                            Sửa
                                                        </a>
                                                        <a class="btn btn-danger btn-sm button-disable" onclick=handleDeleteCoSo('${coSo.maCoSo}')>
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            Xóa
                                                        </a>
                                                    </td>
                                                </tr>
                                                `}
    }

</script>

