<style>
    .container {
        margin: 40px 0; 
    }
    .new {
        display: flex;
        /* align-items: center; */
        transition: all ease 0.3s;
        padding: 20px 24px;
        flex-wrap: wrap;
    }

    .new-extension {
        position: relative;
        display: flex;
        justify-content: center;
        transition: all ease 0.3s;
        align-items: center;
    }

    .new:hover .new-extension__img {
        opacity: 0.7;
    }
    
    .new-extension__img {
        width: 100%;
        object-fit: cover;
        
    }

    .new:hover .extra-extension__button {
        display: block;
    }

    .extra-extension__button {
        position: absolute;
        /* top: 50%;
        transform: translateY(-50%); */
        width: 80%;
        height: 80%;
        color: red;
        text-shadow: 1px 1px black;
        border: 4px solid white;
        display: none;
        animation: Growth 0.3s linear 0.1s forwards;
    }


    @keyframes Growth{
        from {
            transform: scale(0.7);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .extra-extension__detail {
        position: absolute;
        color: white;
        text-shadow: 1px 1px black;
        transition: all linear 0.3s;
    }

    .new:hover .extra-extension__detail {
        transform: translateY(-20px);
    }
    
    .row + .row {
        margin-top: 40px;
    }

    .new-infor {
        margin: 20px 0px 0px;
        padding: 0px 20px;
        transform: translateX(12px);
    }
    .new-infor__heading {
        font-weight: bold;
        font-size: 24px;
    }
    .new-infor__date {
        margin-top: 24px;
        text-align: right; 
        font-size: 12px;
        color: rgb(157, 145, 145);
    }
    .new-infor__description {
        margin-top: 20px;
        font-size: 16px; 
        text-align: justify;
        height: 144px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 6;
    }
</style>
<div class="container">
    <div class="grid wide">
        @php
            $news = App\Models\TinTuc::orderBy('id', 'desc')->take(10)->get();
        @endphp
        @foreach ($news as $item)
            @php
                $author = App\Models\User::where('maNguoiDung', $item->maNguoiDang)->first();
            @endphp
            <a class="row no-gutters" href="{{ route('formTinTuc', $item->id) }}">
                {{--C2: <a class="row no-gutters" href="{{ url('/tintuc', $item->id) }}"> --}}
                <div class="new">
                    <div class="new-extension col l-5 m-5 c-12">
                        <img src="assets/img/{{ $item->hinhAnh }}" alt="news" class="new-extension__img">
                        <button class="extra-extension__button">
                            Xem thêm
                        </button>
                        <div class="extra-extension__detail">Chi tiết</div>
                    </div>
                    <div class="new-infor col l-7 m-7 c-12">
                        <h2 class="new-infor__heading">{{ $item->tieuDe }}</h2>
                        <p class="new-infor__description">
                            @if (empty($item->moTa))
                                Xem báo cáo chi tiết
                            @else
                                {{ $item->moTa }}
                            @endif
                        </p>
                        <p class="new-infor__date">{{\DateTime::createFromFormat('Y-m-d H:i:s',  $item->thoiGian)->format('d-m-Y H:i:s') }} - <span class="new-infor__auth">Tác giả: {{ $author->ho ." ". $author->ten }}</span></p>
                    </div>
                </div>
            </a>
        @endforeach

    </div>
</div>