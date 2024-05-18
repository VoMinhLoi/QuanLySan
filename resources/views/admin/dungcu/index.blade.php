@extends('admin.layout.layout')
@include('Library.validator')
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dụng cụ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item">Dụng vụ</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
        <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tạo dụng cụ mới</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="form-news">
                <div class="card-body">
                    <div class="form-group">
                        <label for="tenDungCu">Tên dụng cụ</label>
                        <input name="tenDungCu" type="text" class="form-control" id="tenDungCu">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="moTa">Mô tả</label>
                        <input name="moTa" type="text" class="form-control" id="moTa" >
                        <span class="form-message"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="soLuongCon">Số lượng</label>
                        <input name="soLuongCon" type="number" class="form-control" id="soLuongCon" >
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="donGiaGoc">Đơn giá gốc</label>
                        <input name="donGiaGoc" type="number" class="form-control" id="donGiaGoc" >
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="donGiaThue">Đơn giá cho thuê</label>
                        <input name="donGiaThue" type="number" class="form-control" id="donGiaThue" >
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="hinhAnh1">Hình ảnh</label>
                        <input name="hinhAnh1" type="file" id="hinhAnh1">
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
            <h3 class="card-title">Dụng cụ</h3>
    
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
                        <th>
                            Mã dụng cụ
                        </th>
                        <th>
                            Tên dụng cụ
                        </th>
                        <th>
                            Loại
                        </th>
                        <th>
                            Số lượng còn
                        </th>
                        {{-- <th>
                            Liên kết ngoài
                        </th> --}}
                        <th>
                            Số lượng cho thuê
                        </th>
                        {{-- <th class="text-center">
                            Mô tả
                        </th> --}}
                        <th class="text-center">
                            Hình ảnh
                        </th>
                        <th class="text-center">
                            Đơn giá gốc
                        </th>
                        <th class="text-center">
                            Đơn giá cho thuê
                        </th>
                        <th class="text-center">
                            Trạng thái
                        </th>
                        <th class="text-center">
                            Hành động
                        </th>
                    </tr>
                </thead>
                    <tbody id="news-table-body" >
                        @foreach ($dungCus as $item)
                            <tr class="{{ "row-".$item->maDungCu }} ">
                                <td>
                                    {{$item->maDungCu }}
                                </td>
                                <td class="column-tool-name">
                                    {{ $item->tenDungCu }}
                                </td>
                                <td>
                                    {{$item->maLoaiDC }}
                                </td>
                                <td  class="column-tool-quantity">
                                    {{ $item->soLuongCon }}
                                </td>
                                <td  class="column-tool-renting-quantity">
                                    {{ $item->soLuongChoThue }}
                                </td>
                                {{-- <td style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;over-flow:hidden">
                                    {{ $item->moTa }}
                                </td> --}}
                                <td>
                                    <img alt="img" style="width: 92px; object-fit: cover;" src="assets/img/{{ $item->hinhAnh1 }}">
                                </td>
                                <td  class="column-tool-price">
                                    {{ number_format($item->donGiaGoc, 0, ',', '.') }}<sup>₫</sup>
                                </td>
                                <td  class="column-tool-renting-price">
                                    {{ number_format($item->donGiaThue, 0, ',', '.') }} <sup>₫</sup>/h
                                </td>
                                <td class="column-tool-status">
                                    @if($item->trangThai == 1)
                                        <span style="color: green">Bình thường</span>
                                    @else
                                        <span style="color: red">Ngưng</span>
                                    @endif
                                </td>
                                <td class="project-actions text-right column-tool-action">
                                    <a class="btn btn-info btn-sm" onclick="handleUpdatedPitch({{ $item }})">
                                        Sửa
                                    </a>
                                    <a class="btn btn-danger btn-sm button-disable" onclick="handleDeletePitch('{{ $item->maDungCu }}')">
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
            @include('admin.dungcu.update')
        </div>
    </section>
    
    <script>

        function handleDeletePitch(maSan){
            if(confirm('Bạn chắc chắn muốn xóa ' +maSan+ ' không?')){
                deleteRowView(maSan);
                deletePitchInDatabase(maSan);
            }
        }
        function deleteRowView(maSan){
            let rowIsDeletedView = document.querySelector('.row-'+maSan)
            rowIsDeletedView.remove();
        }
        function deletePitchInDatabase(maSan){
            fetch("http://127.0.0.1:8000/api/dungcu/"+maSan,{
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
            form: "#form-news",
            rules: [
                Validator.isRequired("#tenDungCu"),
                Validator.isRequired("#moTa"),
                Validator.isRequired("#soLuongCon"),
                Validator.isRequired("#donGiaGoc"),
                Validator.isRequired("#donGiaThue"),
                Validator.isRequired("#hinhAnh1"),
            ],
            errorSelector: ".form-message",
            buttonSubmitSelector: ".form-submit",
            // Muốn submit không theo API mặc định của trình duyệt
            onSubmit: function (dataValid) {
                // console.log(dataValid)
                var formData = new FormData()
                formData.append('tenDungCu', dataValid.tenDungCu)
                formData.append('moTa', dataValid.moTa)
                formData.append('soLuongCon', dataValid.soLuongCon)
                formData.append('donGiaGoc', dataValid.donGiaGoc)
                formData.append('donGiaThue', dataValid.donGiaThue)
                formData.append('hinhAnh1', dataValid.hinhAnh1[0])

                fetch("http://127.0.0.1:8000/api/dungcu", {
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
                        let formTableBodyPitchView = document.querySelector('#news-table-body')
                        renderRow(data.currentNews, formTableBodyPitchView)
                    }// Dữ liệu JSON trả về từ function store
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            },
            formGroupSelector: ".form-group",
        });
    }, 1000)
    function renderRow(news, formTableBodyPitchView){
        //Update: Render lại ô cập nhật
        let rowIsUpdatedView
        let columnToolName
        let columnToolQuantity
        let columnToolRentingQuantity
        let columnPrice
        let columnRentingPrice
        let columnStatus
        let columnAction
        if(!formTableBodyPitchView){
            rowIsUpdatedView = document.querySelector('.row-'+news.maDungCu)
            columnToolName = rowIsUpdatedView.querySelector('.column-tool-name')
            columnToolName.innerText = news.tenDungCu
            columnToolQuantity = rowIsUpdatedView.querySelector('.column-tool-quantity')
            columnToolQuantity.innerText = news.soLuongCon
            columnToolRentingQuantity = rowIsUpdatedView.querySelector('.column-tool-renting-quantity')
            columnToolRentingQuantity.innerText = news.soLuongChoThue
            columnPrice = rowIsUpdatedView.querySelector('.column-tool-price')
            columnPrice.innerText = formatCurrency(news.donGiaGoc)
            columnRentingPrice = rowIsUpdatedView.querySelector('.column-tool-renting-price')
            columnRentingPrice.innerText = formatCurrency(news.donGiaThue)
            columnStatus = rowIsUpdatedView.querySelector('.column-tool-status')
            columnStatus.innerHTML =    `
                                            <td class="project-state column-pitch-status">
                                                ${parseInt(news.trangThai)?`<span style="color: green">Bình thường</span>`:`<span style="color: red">Ngưng</span>`}
                                            </td>
                                        `
            columnAction = rowIsUpdatedView.querySelector('.column-tool-action')

            columnAction.innerHTML = `
                                    <td class="project-actions text-right column-news-action">
                                        <a class="btn btn-info btn-sm" onclick='handleUpdatedPitch(${JSON.stringify(news)})'>
                                            Sửa
                                        </a>
                                        <a class="btn btn-danger btn-sm button-disable" onclick=handleDeletePitch('${news.maDungCu}')>
                                            <i class="fas fa-trash">
                                            </i>
                                            Xóa
                                        </a>
                                    </td>
                                    `
        }
        //Create: Render dòng vừa tạo
        else{
            // console.log(formTableBodyPitchView)
            formTableBodyPitchView.innerHTML +=  `
                                                <tr class="${ "row-"+news.maDungCu}">
                                                    <td>
                                                        ${news.maDungCu }
                                                    </td>
                                                    <td class="column-tool-name">
                                                        ${news.tenDungCu }
                                                    </td>
                                                    <td class="project_progress text-center column-news-name">
                                                        ${news.maLoaiDC}
                                                    </td>
                                                    <td  class="column-tool-quantity">
                                                        ${news.soLuongCon }
                                                    </td>
                                                    <td  class="column-tool-renting-quantity">
                                                        ${news.soLuongChoThue }
                                                    </td>
                                                    <td class="project-actions column-time-close">
                                                        <img alt="img" style="width: 92px; object-fit: cover;" src="assets/img/${news.hinhAnh1}">
                                                    </td>
                                                    <td class="column-tool-price">
                                                        ${formatCurrency(news.donGiaGoc)}
                                                    </td>
                                                    <td  class="column-tool-renting-price">
                                                        ${formatCurrency(news.donGiaThue)}/h
                                                    </td>
                                                    <td class="column-tool-status">
                                                        ${news.trangThai?`<span style="color: green">Bình thường</span>`:`<span style="color: red">Ngưng</span>`}
                                                    </td>
                                                    <td class="project-actions text-right column-tool-action">
                                                        <a class="btn btn-info btn-sm" onclick='handleUpdatedPitch(${JSON.stringify(news)})'>
                                                            Sửa
                                                        </a>
                                                        <a class="btn btn-danger btn-sm button-disable" onclick=handleDeletePitch('${news.maDungCu}')>
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

