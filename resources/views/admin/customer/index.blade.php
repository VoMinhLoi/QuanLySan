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
            <h3 class="card-title">Projects</h3>
    
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
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>
                                    {{ "ND".$item->maNguoiDung }}
                                    
                                </td>
                                <td>
                                    {{ $item->ho ." ". $item->ten }}
                                    {{-- <a>
                                        AdminLTE v3
                                    </a>
                                    <br/>
                                    <small>
                                        Created 01.01.2019
                                    </small> --}}
                                </td>
                                <td>
                                    {{ $item->taiKhoan }}
                                    {{-- <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                                        </li>
                                        <li class="list-inline-item">
                                            <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar2.png">
                                        </li>
                                        <li class="list-inline-item">
                                            <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar3.png">
                                        </li>
                                        <li class="list-inline-item">
                                            <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar4.png">
                                        </li>
                                    </ul> --}}
                                </td>
                                <td class="project_progress">
                                    {{ $item->maQuyen }}
        
                                    {{-- <div class="progress progress-sm">
                                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                        </div>
                                    </div>
                                    <small>
                                        57% Complete
                                    </small> --}}
                                </td>
                                <td class="project-state">
                                    {{ $item->trangThai }}
        
                                    {{-- <span class="badge badge-success">Success</span> --}}
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="#">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
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
        
    </section>
        <!-- /.content -->
@endsection