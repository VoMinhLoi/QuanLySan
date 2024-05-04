@extends('admin.layout.layout')
@include('Library.validator')
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sân bóng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Quản lý sân</li>
                    <li class="breadcrumb-item">Sân bóng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
        <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tạo sân bóng</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="form-pitch">
                <div class="card-body">
                    <div class="form-group">
                        <label for="tenSan">Tên sân</label>
                        <input name="tenSan" type="text" class="form-control" id="tenSan">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="viTri">Vị trí</label>
                        <input name="viTri" type="text" class="form-control" id="viTri" >
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="moTa">Mô tả</label>
                        <input name="moTa" type="text" class="form-control" id="moTa" >
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="giaDichVu">Giá dịch vụ</label>
                        <input name="giaDichVu" type="number" class="form-control" id="giaDichVu" placeholder="200000">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="loaiSan">Loại sân</label>
                        <select name="loaiSan" id="loaiSan" class="form-control">
                            <option value="Bóng đá">Bóng đá</option>
                            <option value="Chuyền">Chuyền</option>
                            <option value="Chuyền cát">Chuyền cát</option>
                            <option value="Bóng rỗ">Bóng rỗ</option>
                        </select>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="hinhAnh">Hình ảnh</label>
                        <input name="hinhAnh" type="file" id="hinhAnh">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="maPitch">Cơ sở</label>
                        <select name="maPitch" id="maPitch">
                            @php
                                $branchs = App\Models\CoSo::all();
                            @endphp
                            @foreach ($branchs as $item)
                                <option value="{{ $item->maCoSo }}">{{ $item->tenCoSo }}</option>
                            @endforeach
                        </select>
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
            <h3 class="card-title">Sân bóng</h3>
    
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
                            Mã sân
                        </th>
                        <th style="width: 10%">
                            Tên sân
                        </th>
                        <th style="width: 10%">
                            Vị trí 
                        </th>
                        <th style="width: 10%">
                            Mô tả
                        </th>
                        <th style="width: 10%">
                            Giá dịch vụ
                        </th>
                        <th style="width: 10%" class="text-center">
                            Loại sân
                        </th>
                        <th style="width: 10%" class="text-center">
                            Hình ảnh
                        </th>
                        {{-- <th style="width: 10%" class="text-center">
                            Tên cơ sở
                        </th> --}}
                        <th style="width: 10%">
                            Trạng thái
                        </th>
                        <th style="width: 10%" class="text-center">
                            Hành động
                        </th>
                    </tr>
                </thead>
                    <tbody id="pitch-table-body" >
                        @foreach ($sanBongs as $item)
                            <tr class="{{ "row-".$item->maSan }} ">
                                <td>
                                    {{$item->maSan }}
                                </td>
                                <td class="column-pitch-name">
                                    {{ $item->tenSan }}
                                </td>
                                <td class="column-pitch-location">
                                    {{ $item->viTri }}
                                </td>
                                <td class="column-pitch-description">
                                    {{ $item->moTa }}
                                </td>
                                <td class="project_progress text-center column-pitch-price">
                                    {{ number_format($item->giaDichVu, 0, ',', '.') }}<sup>₫</sup>
                                </td>
                                <td class="project_progress text-center">
                                    {{ $item->loaiSan }}
                                </td>
                                <td>
                                    <img alt="img" style="width: 100%; object-fit: cover;" src="assets/img/{{ $item->hinhAnh }}">
                                </td>
                                {{-- <td class="project-state column-time-open">
                                    @php
                                        $branch = App\Models\Pitch::where('maPitch',$item->maPitch)->first();
                                    @endphp
                                    {{ $branch->tenPitch }}
                                </td> --}}
                                <td class="project-state column-pitch-status">
                                    @if($item->trangThai == 1)
                                        <span style="color: green">Hoạt động</span>
                                    @else
                                        <span style="color: red">Khóa</span>
                                    @endif
                                </td>
                                <td class="project-actions text-right column-pitch-action">
                                    <a class="btn btn-info btn-sm" onclick="handleUpdatedPitch({{ $item }})">
                                        Sửa
                                    </a>
                                    <a class="btn btn-danger btn-sm button-disable" onclick="handleDeletePitch('{{ $item->maSan }}')">
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
            @include('admin.sanbong.update')
        </div>
    </section>
    
    <script>

        function handleDeletePitch(maSan){
            deleteRowView(maSan);
            deletePitchInDatabase(maSan);
        }
        function deleteRowView(maSan){
            let rowIsDeletedView = document.querySelector('.row-'+maSan)
            rowIsDeletedView.remove();
        }
        function deletePitchInDatabase(maSan){
            fetch("http://127.0.0.1:8000/api/sanbong/"+maSan,{
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
            form: "#form-pitch",
            rules: [
                Validator.isRequired("#tenSan"),
                Validator.isRequired("#viTri"),
                Validator.isRequired("#moTa"),
                Validator.isRequired("#hinhAnh"),
                Validator.isRequired("#giaDichVu"),
            ],
            errorSelector: ".form-message",
            buttonSubmitSelector: ".form-submit",
            // Muốn submit không theo API mặc định của trình duyệt
            onSubmit: function (dataValid) {
                // console.log(dataValid.hinhAnh[0])
                var formData = new FormData()
                formData.append('tenSan', dataValid.tenSan)
                formData.append('viTri', dataValid.viTri)
                formData.append('moTa', dataValid.moTa)
                formData.append('giaDichVu', dataValid.giaDichVu)
                formData.append('loaiSan', dataValid.loaiSan)
                formData.append('hinhAnh', dataValid.hinhAnh[0])
                formData.append('maPitch', dataValid.maPitch)

                fetch("http://127.0.0.1:8000/api/sanbong", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: formData
                })
                .then(response => {
                    return response.json(); // Chuyển đổi phản hồi sang JSON
                })
                .then(data => {
                    console.log(data)
                    if(data.error)
                        toastr.error(data.error)
                    else{
                        toastr.success(data.success)
                        let formTableBodyPitchView = document.querySelector('#pitch-table-body')
                        renderRow(data.newPitch, formTableBodyPitchView)
                    }// Dữ liệu JSON trả về từ function store
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            },
            formGroupSelector: ".form-group",
        });
    }, 1000)
    function renderRow(pitch, formTableBodyPitchView){
        // Render lại ô cập nhật
        let rowIsUpdatedView
        let columnTenPitch
        let columnDescription
        let columnOpen
        let columnClose
        let columnAction
        if(!formTableBodyPitchView){
            rowIsUpdatedView = document.querySelector('.row-'+pitch.maSan)
            columnTenPitch = rowIsUpdatedView.querySelector('.column-pitch-name')
            columnLocation = rowIsUpdatedView.querySelector('.column-pitch-location')
            columnDescription = rowIsUpdatedView.querySelector('.column-pitch-description')
            columnPrice = rowIsUpdatedView.querySelector('.column-pitch-price')
            columnStatus = rowIsUpdatedView.querySelector('.column-pitch-status')
            columnAction = rowIsUpdatedView.querySelector('.column-pitch-action')

            columnTenPitch.innerText = pitch.tenSan
            columnLocation.innerText = pitch.viTri
            columnDescription.innerText = pitch.moTa
            columnPrice.innerText = formatCurrency(pitch.giaDichVu)
            columnStatus.innerHTML =    `
                                            <td class="project-state column-pitch-status">
                                                ${parseInt(pitch.trangThai)?`<span style="color: green">Hoạt động</span>`:`<span style="color: red">Khóa</span>`}
                                            </td>
                                        `
            columnAction.innerHTML = `
                                    <td class="project-actions text-right column-pitch-action">
                                        <a class="btn btn-info btn-sm" onclick='handleUpdatedPitch(${JSON.stringify(pitch)})'>
                                            Sửa
                                        </a>
                                        <a class="btn btn-danger btn-sm button-disable" onclick=handleDeletePitch('${pitch.maSan}')>
                                            <i class="fas fa-trash">
                                            </i>
                                            Xóa
                                        </a>
                                    </td>
                                    `
        }
        // Render dòng vừa tạo
        else{
            // console.log(formTableBodyPitchView)
            formTableBodyPitchView.innerHTML +=  `
                                                <tr class="${ "row-"+pitch.maSan}">
                                                    <td>
                                                        ${pitch.maSan }
                                                    </td>
                                                    <td class="column-name-branch column-pitch-name">
                                                        ${pitch.tenSan }
                                                    </td>
                                                    <td class="project_progress text-center column-pitch-location">
                                                        
                                                        ${pitch.viTri}
                                                    </td>
                                                    <td class="column-description column-pitch-description">
                                                        ${pitch.moTa }
                                                    </td>
                                                    <td class="project_progress text-center column-pitch-price">
                                                        ${formatCurrency(pitch.giaDichVu)}
                                                    </td>
                                                    <td class="project-state column-time-open">
                                                        ${pitch.loaiSan}
                                                    </td>
                                                    <td class="project-actions column-time-close">
                                                        <img alt="img" style="width: 100%; object-fit: cover;" src="assets/img/${pitch.hinhAnh}">
                                                    </td>
                                                    <td class="column-pitch-status">
                                                        ${pitch.trangThai?`<span style="color: green">Hoạt động</span>`:`<span style="color: red">Khóa</span>`}
                                                    </td>
                                                    <td class="project-actions text-right column-pitch-action">
                                                        <a class="btn btn-info btn-sm" onclick='handleUpdatedPitch(${JSON.stringify(pitch)})'>
                                                            Sửa
                                                        </a>
                                                        <a class="btn btn-danger btn-sm button-disable" onclick=handleDeletePitch('${pitch.maSan}')>
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            Xóa
                                                        </a>
                                                    </td>
                                                </tr>
                                                `
        }
    }
    function formatCurrency(input) {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(input);
    }
</script>

