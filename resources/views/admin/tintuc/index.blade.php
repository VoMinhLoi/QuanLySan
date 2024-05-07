@extends('admin.layout.layout')
@include('Library.validator')
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tin tức</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item">Tin tức</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
        <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tạo tin tức mới</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="form-news">
                <div class="card-body">
                    <div class="form-group">
                        <label for="tieuDe">Tiêu đề</label>
                        <input name="tieuDe" type="text" class="form-control" id="tieuDe">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="moTa">Mô tả</label>
                        <input name="moTa" type="text" class="form-control" id="moTa" >
                        <span class="form-message"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="lienKetNgoai">Liên kết ngoài</label>
                        <input name="lienKetNgoai" type="text" class="form-control" id="lienKetNgoai" >
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="hinhAnh">Hình ảnh</label>
                        <input name="hinhAnh" type="file" id="hinhAnh">
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
            <h3 class="card-title">Tin tức</h3>
    
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
                            Id bài đăng
                        </th>
                        <th>
                            Mã người đăng
                        </th>
                        <th>
                            Tiêu đề
                        </th>
                        <th>
                            Mô tả 
                        </th>
                        {{-- <th>
                            Liên kết ngoài
                        </th> --}}
                        <th>
                            Hình ảnh
                        </th>
                        <th class="text-center">
                            Thời gian
                        </th>
                        <th class="text-center">
                            Lượt xem
                        </th>
                        <th class="text-center">
                            Hành động
                        </th>
                    </tr>
                </thead>
                    <tbody id="news-table-body" >
                        @foreach ($news as $item)
                            <tr class="{{ "row-".$item->id }} ">
                                <td>
                                    {{'TT'.$item->id }}
                                </td>
                                <td>
                                    {{'ND'.$item->maNguoiDang }}
                                </td>
                                <td class="column-news-name">
                                    {{ $item->tieuDe }}
                                </td>
                                <td class="column-news-description">
                                    {{ $item->moTa }}
                                </td>
                                {{-- <td class="column-news-link" style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;over-flow:hidden">
                                    {{ $item->lienKetNgoai }}
                                </td> --}}
                                <td>
                                    <img alt="img" style="width: 100%; object-fit: cover;" src="assets/img/{{ $item->hinhAnh }}">
                                </td>
                                <td>
                                    {{\DateTime::createFromFormat('Y-m-d H:i:s',  $item->thoiGian)->format('d-m-Y H:i:s') }}
                                </td>
                                <td class="project_progress text-center">
                                    {{ $item->luotXem }}
                                </td>
                                <td class="project-actions text-right column-news-action">
                                    <a class="btn btn-info btn-sm" onclick="handleUpdatedPitch({{ $item }})">
                                        Sửa
                                    </a>
                                    <a class="btn btn-danger btn-sm button-disable" onclick="handleDeletePitch('{{ $item->id }}')">
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
            @include('admin.tintuc.update')
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
            fetch("http://127.0.0.1:8000/api/tintuc/"+maSan,{
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
                Validator.isRequired("#tieuDe"),
                Validator.isRequired("#moTa"),
                // Validator.isRequired("#lienKetNgoai"),
                Validator.isRequired("#hinhAnh"),
            ],
            errorSelector: ".form-message",
            buttonSubmitSelector: ".form-submit",
            // Muốn submit không theo API mặc định của trình duyệt
            onSubmit: function (dataValid) {
                console.log(dataValid)
                dataValid.maNguoiDang = "{{ Auth::user()->maNguoiDung }}"
                dataValid.thoiGian = getCurrentDateTime()
                var formData = new FormData()
                formData.append('maNguoiDang', dataValid.maNguoiDang)
                formData.append('tieuDe', dataValid.tieuDe)
                formData.append('moTa', dataValid.moTa)
                formData.append('lienKetNgoai', dataValid.lienKetNgoai)
                formData.append('hinhAnh', dataValid.hinhAnh[0])
                formData.append('thoiGian', dataValid.thoiGian)

                fetch("http://127.0.0.1:8000/api/tintuc", {
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
        let columnTenPitch
        let columnDescription
        if(!formTableBodyPitchView){
            rowIsUpdatedView = document.querySelector('.row-'+news.id)
            columnTenPitch = rowIsUpdatedView.querySelector('.column-news-name')
            columnDescription = rowIsUpdatedView.querySelector('.column-news-description')
            columnTenPitch.innerText = news.tieuDe
            columnDescription.innerText = news.moTa
            columnAction = rowIsUpdatedView.querySelector('.column-news-action')
            columnAction.innerHTML = `
                                    <td class="project-actions text-right column-news-action">
                                        <a class="btn btn-info btn-sm" onclick='handleUpdatedPitch(${JSON.stringify(news)})'>
                                            Sửa
                                        </a>
                                        <a class="btn btn-danger btn-sm button-disable" onclick=handleDeletePitch('${news.id}')>
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
                                                <tr class="${ "row-"+news.id}">
                                                    <td>
                                                        TT${news.id }
                                                    </td>
                                                    <td class="column-name-branch ">
                                                        ND${news.maNguoiDang }
                                                    </td>
                                                    <td class="project_progress text-center column-news-name">
                                                        ${news.tieuDe}
                                                    </td>
                                                    <td class="column-description column-news-description">
                                                        ${news.moTa }
                                                    </td>
                                                    <td class="project-actions column-time-close">
                                                        <img alt="img" style="width: 100%; object-fit: cover;" src="assets/img/${news.hinhAnh}">
                                                    </td>
                                                    <td class="project-state column-time-open">
                                                        ${formatDate(news.thoiGian)}
                                                    </td>
                                                    <td class="project-state column-time-open">
                                                        ${news.luotXem}
                                                    </td>
                                                    <td class="project-actions text-right column-news-action">
                                                        <a class="btn btn-info btn-sm" onclick='handleUpdatedPitch(${JSON.stringify(news)})'>
                                                            Sửa
                                                        </a>
                                                        <a class="btn btn-danger btn-sm button-disable" onclick=handleDeletePitch('${news.id}')>
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            Xóa
                                                        </a>
                                                    </td>
                                                </tr>
                                                `
        }
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
    function formatDate(dateTimeString) {
        // Chia chuỗi thành các phần
            const parts = dateTimeString.split(' ');

            // Lấy phần ngày, tháng, năm
            const datePart = parts[0];
            const [year, month, day] = datePart.split('-');

            // Lấy phần giờ, phút, giây
            const timePart = parts[1];
            const [hours, minutes, seconds] = timePart.split(':');

            // Định dạng lại thành "dd-mm-yyyy hh:mm:ss"
            const formattedDate = `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
            
            return formattedDate;
        }
</script>

