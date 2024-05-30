@extends('admin.layout.layout')
@include('Library.validator')
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản lý người dùng</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý người dùng</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tạo người dùng</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="form-user">
                <div class="card-body">
                    <div class="form-group">
                        <label for="ho">Họ</label>
                        <input name="ho" type="text" class="form-control" id="ho" placeholder="Võ Minh">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="ten">Tên</label>
                        <input name="ten" type="text" class="form-control" id="ten" placeholder="Lợi">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="taiKhoan">Tài khoản</label>
                        <input name="taiKhoan" type="email" class="form-control" id="taiKhoan" placeholder="Enter email">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
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
                
                <h3 class="card-title">Người dùng</h3>
        
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
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 10%">
                                Mã người dùng
                            </th>
                            <th style="width: 20%">
                                Họ và tên
                            </th>
                            <th style="width: 20%">
                                Email
                            </th>
                            <th style="width: 10%">
                                Số dư tài khoản
                            </th>
                            <th style="width: 10%">
                                Vai trò
                            </th>
                            <th style="width: 8%" class="text-center">
                                Trạng thái
                            </th>
                            <th style="width: 20%" class="text-center">
                                Hành động
                            </th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                        @foreach ($users as $item)
                            <tr class="{{ "row-".$item->maNguoiDung }}">
                                <td>
                                    {{ "ND".$item->maNguoiDung }}
                                    
                                </td>
                                <td>
                                    {{ $item->ho ." ". $item->ten }}
                                </td>
                                <td>
                                    {{ $item->taiKhoan }}
                                </td>
                                <td>
                                    {{ number_format($item->soDuTaiKhoan, 0, ',', '.') }}<sup>₫</sup>
                                </td>
                                <td class="project_progress text-center">
                                    @if($item->maQuyen == 1)
                                        Quản trị viên
                                    @else
                                        Người dùng
                                    @endif
                                </td>
                                
                                <td class="project-state">
                                    @if($item->trangThai == 1)
                                        <span style="color: green">Hoạt động</span>
                                    @else
                                        <span style="color: red">Khóa</span>
                                    @endif
                                </td>
                                
                                <td class="project-actions text-right">
                                    @if($item->maQuyen == 2)
                                        <a class="btn btn-primary btn-sm" onclick="grantPermissions({{ $item->maNguoiDung }})">
                                            Cấp quyền
                                        </a>
                                    @endif
                                    @if ($item->trangThai == 1)
                                        <a class="btn btn-danger btn-sm button-disable" onclick="disableUser({{ $item->maNguoiDung }})">
                                            <i class="fas fa-trash">
                                            </i>
                                            Vô hiệu hóa
                                        </a>
                                    @else
                                        <a class="btn btn-success btn-sm" onclick="enableUser({{ $item->maNguoiDung }})">
                                            <i class="fas fa-folder">
                                            </i>
                                            Mở khóa
                                        </a>
                                    @endif
                                    
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        
    </section>
        <!-- /.content -->
@endsection
<script>
    var apiUser = "http://127.0.0.1:8000/api/user"
    function disableUser(maNguoiDung){
        let dataUser = {}
        dataUser['trangThai'] = 0
        updateUser(maNguoiDung, dataUser)
        setTimeout(handleRender(maNguoiDung), 1000)
    }
    function enableUser(maNguoiDung){
        let dataUser = {}
        dataUser['trangThai'] = 1
        updateUser(maNguoiDung, dataUser)
        setTimeout(handleRender(maNguoiDung), 1000)
    }
    function grantPermissions(maNguoiDung){
        if(confirm("Bạn có chắc chắn muốn cấp quyền quản trị viên cho người dùng mã ND" + maNguoiDung)){
            let dataUser = {}
            dataUser['maQuyen'] = 1
            updateUser(maNguoiDung, dataUser)
            setTimeout(handleRender(maNguoiDung), 1000)
        }
    }
    function updateUser(maNguoiDung, data){
        data['_token'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        fetch(apiUser+"/"+maNguoiDung,{
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
                    if(data.warning)
                        toastr.warning(data.warning)
                    else
                        toastr.success(data.success)
                        
            })
            .catch(response => console.log(response))
    }
    function handleRender(maNguoiDung){
        getUser(maNguoiDung,userRecentlyIsUpdated => renderRow(userRecentlyIsUpdated))
    }
    function getUser(maNguoiDung, callback){
        fetch(apiUser+"/"+maNguoiDung)
            .then(response => response.json())
            .then(callback)
    }
    function renderRow(user, formTableBodyUserView){
        let rowIsUpdatedView = document.querySelector('.row-'+user.maNguoiDung)
        if(!formTableBodyUserView)
            rowIsUpdatedView.innerHTML =    `
                                            <tr>
                                                <td>
                                                    ${"ND"+user.maNguoiDung }
                                                </td>
                                                <td>
                                                    ${user.ho+" "+user.ten}
                                                </td>
                                                <td>
                                                    ${user.taiKhoan}
                                                </td>
                                                <td>
                                                    ${formatCurrency(user.soDuTaiKhoan)}
                                                </td>
                                                <td class="project_progress text-center">
                                                    ${user.maQuyen == 1?"Quản trị viên":"Người dùng"}
                                                </td>
                                                <td class="project-state">
                                                    ${user.trangThai?`<span style="color: green">Hoạt động</span>`:`<span style="color: red">Khóa</span>`}
                                                </td>
                                                <td class="project-actions text-right">
                                                    ${user.maQuyen == 2?`<a class="btn btn-primary btn-sm" onclick="grantPermissions('${ user.maNguoiDung }')">Cấp quyền</a>`:""}
                                                    ${user.trangThai?`<a class="btn btn-danger btn-sm button-disable" onclick="disableUser('${ user.maNguoiDung }')"><i class="fas fa-trash"></i>Vô hiệu hóa</a>`:`<a class="btn btn-success btn-sm" onclick="enableUser('${ user.maNguoiDung }')"><i class="fas fa-folder"></i>Mở khóa</a>`}
                                                </td>
                                            </tr>
                                        `
        else
            formTableBodyUserView.innerHTML +=   `
                                            <tr class="row-${user.maNguoiDung}">
                                                <td>
                                                    ${"ND"+user.maNguoiDung }
                                                </td>
                                                <td>
                                                    ${user.ho+" "+user.ten}
                                                </td>
                                                <td>
                                                    ${user.taiKhoan}
                                                </td>
                                                <td>
                                                    0 <sup>₫</sup>
                                                </td>
                                                <td class="project_progress text-center">
                                                    Người dùng
                                                </td>
                                                <td class="project-state">
                                                    <span style="color: green">Hoạt động</span>
                                                </td>
                                                <td class="project-actions text-right">
                                                    <a class="btn btn-primary btn-sm" onclick="grantPermissions('${ user.maNguoiDung }')">Cấp quyền</a>
                                                    <a class="btn btn-danger btn-sm button-disable" onclick="disableUser('${ user.maNguoiDung }')"><i class="fas fa-trash"></i>Vô hiệu hóa</a>
                                                </td>
                                            </tr>
                                            `
    }
    function formatCurrency(input) {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(input);
    }
</script>

{{-- Create người dùng --}}
<script>
    setTimeout(()=> {
        Validator({
            form: "#form-user",
            rules: [
                Validator.isRequired("#ho"),
                Validator.isRequired("#ten"),
                Validator.isRequired("#taiKhoan"),
                Validator.isEmail("#taiKhoan"),
                Validator.isRequired("#password"),
                Validator.minLength("#password", 7),
            ],
            errorSelector: ".form-message",
            buttonSubmitSelector: ".form-submit",
            // Muốn submit không theo API mặc định của trình duyệt
            onSubmit: function (dataValid) {
                fetch(apiUser, {
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
                        dataValid['maNguoiDung'] = data.maNguoiDung
                        let formTableBodyUserView = document.querySelector('#user-table-body')
                        renderRow(dataValid, formTableBodyUserView)
                    }// Dữ liệu JSON trả về từ function store
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            },
            formGroupSelector: ".form-group",
        });
    }, 1000)
</script>