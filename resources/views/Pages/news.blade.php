<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('Library.grid_system')
    @include('Library.responsive')
    @include('Library.variable')
    <style>
        .new {
            margin-top: 12px;
        }
        .new-infor__heading {
            font-size: 30px;
            font-weight: bold;
        }
        .new-infor__date {
            margin-left: 12px; 
            color: rgb(151, 150, 150);
        }
        .new-infor__description {
            margin-top: 12px;
            text-align: justify;
        }
    </style>
</head>
<body>
    <div class="grid">
        @include('Components.header')
        
        <div class="container">
            <div class="grid wide" >
                @include('Components.breadcrumb')
                <script>
                    breadCrumbHeading.innerText = 'Tin tức > Xem chi tiết'
                </script>
                <div class="row content no-gutters">
                    <div class="col l-12 m-12 c-12">
                        @php
                            $author = App\Models\User::where('maNguoiDung', $tinTuc->maNguoiDang)->first();
                        @endphp
                        <div class="new">
                            
                            <div class="new-infor col l-12 m-12 c-12">
                                <h2 class="new-infor__heading">{{ $tinTuc->tieuDe }}</h2>
                                <p class="new-infor__date">{{\DateTime::createFromFormat('Y-m-d H:i:s',  $tinTuc->thoiGian)->format('d-m-Y H:i:s') }} - <span class="new-infor__auth">Tác giả: {{ $author->ho ." ". $author->ten }}</span> - Lượt xem: {{ $tinTuc->luotXem }}</p>

                                
                            </div>
                            <div class="new-extension col l-12 m-12 c-12">
                                <img src="assets/img/{{ $tinTuc->hinhAnh }}" alt="news" class="new-extension__img" style="width: 100%; object-fit: cover">
                            </div>
                            <div class="new-infor col l-12 m-12 c-12">
                                <p class="new-infor__description">
                                    @if (empty($tinTuc->moTa))
                                        Xem chi tiết hơn: <a style="color: red; font-weight: bold" href="{{ $tinTuc->lienKetNgoai }}">Tệp</a>
                                    @else
                                        {{ $tinTuc->moTa }}
                                        <br/>
                                        Xem chi tiết hơn: <a style="color: red; font-weight: bold" href="{{ $tinTuc->lienKetNgoai }}">Tệp</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('Components.footer')
    </div>
</body>
</html>