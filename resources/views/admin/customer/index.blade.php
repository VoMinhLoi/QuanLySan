@extends('admin.layout.layout')
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản lý tài khoản</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý tài khoản</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
    <section class="content">
    
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
    function renderRow(user){
        let rowIsUpdatedView = document.querySelector('.row-'+user.maNguoiDung)
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
    }

</script>