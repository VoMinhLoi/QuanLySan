
    {{-- CSS header --}}
    <style>
        .header {
            display: flex;
            height: 90px;
            justify-content: space-between;
            background-image: linear-gradient(0deg,var(--primary-color),#4f8edc);
            color: white;
            align-items: center;
            padding: 0 30px;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 2;
        }
        .header-logo__image {
            width: 50px;
        }
        .header-navigation {
            display: flex;
            flex: 1;
            height: 100%;
            line-height: 90px;
            justify-content: space-between;
            align-items: center;
            padding: 0 100px;
        }



        .header-navigation-item__link {
            display: flex;
            align-items: center;
            height: 80%;
            line-height: 72px;
            padding: 0 50px;
        }

        .header-navigation-item__link-img {
            margin-left: 4px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .header-navigation-item:hover .sub-nav{
            transform: perspective(600px) rotateX(0);
            opacity: 1;
        }

        .sub-nav {
            position: absolute;
            top: 100%;
            left: 0;
            color: var(--primary-color);
            background: white;
            box-shadow: 0 0 1px black;
            transform: perspective(600px) rotateX(-90deg);
            transform-origin: top;
            opacity: 0;
            transition: all ease 0.3s;
        }

        .sub-nav__item-link {
            display: block;
            width: 172px;
            padding: 0 10px;
        }

        .sub-nav__item-link:hover {
            color: black;   
        }

        .header-private {
            display: flex;
            position: relative;
            width: 150px;
        }


        .header-private-item + .header-private-item {
            margin-left: 24px;
        }
        .header-navigation-item {
            display: flex;
            position: relative;
            align-items: center;
        }
        .header-navigation-item:hover {
            background-color: white;
            color: var(--primary-color);
        }

        .header-private-item {
            font-size: 24px;
            cursor: pointer;
            position: relative;
        }
        .header-private-item__quantity {
            position: absolute;
            top: 0px;
            right: -8px;
            background: red;
            width: 21px;
            text-align: center;
            border-radius: 50%;
            font-size: 14px;
        }

        #showNotification:checked + .header__notify {
            display: block;
        }
        .header__notify {
            --growth-from: 0;
            --growth-to: 1;
            position: absolute;
            z-index: 2;
            background-color: white;
            top: calc(100% + 8px);
            right: 42px;
            width: 404px;
            border-radius: 2px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            transform-origin: calc(100% - 20px) top;
            animation: Growth ease-in 0.2s;
            will-change: opacity, transform;
            display: none;
        }

        .header__notify::after {
            content: "";
            position: absolute;
            width: 90px;
            height: 20px;
            top: -18px;
            right: 0;
        }

        .header-notify__list {
            padding: 0;
            max-height: 450px;
            overflow-y:auto;
        }

        .header-notify-list__title {
            color: #a3a3a3;
            font-size: 14px;
            margin: 0px 12px;
            font-weight: 300;
            line-height: 40px;
            cursor: default;
            user-select: none;
        }

        .header-notify__item--viewed {
            background-color: rgba(238, 75, 43, 0.08) !important;
        }

        .header-notify__item:hover {
            background-color: #f7f7f7;
        }

        .header-notify-item__link {
            display: flex;
            padding: 12px;
            text-decoration: none;
        }

        .header-notify-item-link__img {
            width: 48px;
            object-fit: contain;
            margin-right: 12px;
        }

        .header-notify-item-link__name {
            display: block;
            font-size: 14px;
            line-height: 18px;
            color: black;
            margin-bottom: 4px;
            font-weight: 400;
        }

        .header-notify-item-link__description {
            font-size: 12px;
            color: #958e8c;
        }

        .footer-notify {
            height: 32px;
            text-align: center;
            padding: 8px;
        }

        .footer-notify__link {
            text-decoration: none;
            color: red;
        }
    </style>

    <header class="header">
        <a href="/" class="header-logo"><img class="header-logo__image" src="https://minhloiiot.id.vn/assets/img/Logo-Truong-Dai-hoc-The-duc-The-thao-Da-Nang.png" alt="logo trường đại học thể dục thể thao"></a>
        <ul class="header-navigation">
            <li class="header-navigation-item"><a href="/" class="header-navigation-item__link">Trang chủ</a></li>
            <li class="header-navigation-item">
                {{-- <a href="/sanbong" class="header-navigation-item__link">Đặt sân</a> --}}
                <p class="header-navigation-item__link">Dịch vụ</p>
                <ul class="sub-nav">
                    <li class="sub-nav__item"><a href="/sanbong" class="sub-nav__item-link">Đặt sân</a></li>
                    <li class="sub-nav__item"><a href="/muadungcu" class="sub-nav__item-link">Dụng cụ</a></li>
                </ul>
            </li>
            <li class="header-navigation-item"><a href="/lienhe" class="header-navigation-item__link">Liên hệ</a></li>
            <li class="header-navigation-item"><a href="/dieukhoanchinhsach" class="header-navigation-item__link">Điều khoản & chính sách</a></li>
            @if(Auth::check())
                <li class="header-navigation-item">
                    <p class="header-navigation-item__link">
                        {{ Auth::user()->ho . ' '. Auth::user()->ten }}  
                        @if(Auth::user()->hinhDaiDien == null)
                            <i class="fa-solid fa-user" style="margin-left: 4px"></i>                            
                        @else
                            <img src="https:/minhloiiot.id.vn/assets/img/{{ Auth::user()->hinhDaiDien }}" alt="avatar" class="header-navigation-item__link-img">
                        @endif
                    </p>
                    <ul class="sub-nav">
                        <li class="sub-nav__item"><a href="/hosocanhan" class="sub-nav__item-link">Hồ sơ cá nhân</a></li>
                        <li class="sub-nav__item"><a href="/donhang" class="sub-nav__item-link">Đơn hàng</a></li>
                        <li class="sub-nav__item"><a href="/naptien" class="sub-nav__item-link">Ví</a></li>
                        @if(Auth::user()->maQuyen == 1)
                            <li class="sub-nav__item"><a href="/dashboard" class="sub-nav__item-link">Quản trị viên</a></li>
                        @endif
                        <li class="sub-nav__item"><a href="/dangxuat" class="sub-nav__item-link">Đăng xuất</a></li>
                    </ul>
                </li>
            @else
                <li class="header-navigation-item"><a href="/dangnhap" class="header-navigation-item__link">Đăng nhập</a></li>
            @endif
        </ul>
        <ul class="header-private">
            <label for="showMenuMobile" class="header-private-item header-private-item--bars">
                <i class="fa-solid fa-bars"></i>
            </label>
            <label for="showNotification" class="header-private-item header-private-item-notification">

                <i class="fa-solid fa-bell"></i>
                @if(Auth::check())
                    <span class="header-private-item__quantity header-private-item__quantity-notification">
                        @php
                            $thongBaoQuantity = App\Models\ThongBao::where('maNguoiDung',Auth::user()->maNguoiDung)->where('daXem',0)->count();
                        @endphp
                        {{ $thongBaoQuantity }}
                    </span>
                @endif
            </label>
            
            <a href="/tui" class="header-private-item" title="Vé sân, dụng cụ thuê">
                <i class="fa-solid fa-volleyball"></i>
                @if(Auth::check())
                    @php
                        $maNguoiDung = Auth::user()->maNguoiDung;
                        $sportFieldQuantity = App\Models\Ve::where('maNguoiDung', $maNguoiDung)
                                                ->whereHas('chiTietThueSans')
                                                ->count();
                    @endphp
                    <span class="header-private-item__quantity header-private-item__quantity--in-bag">{{ $sportFieldQuantity }}</span>
                @endif
            </a>
            <a href="/giohang" class="header-private-item" title="Đơn hàng mua">
                <i class="fa-solid fa-cart-shopping"></i>
                @if(Auth::check())
                    @php
                        $cartQuantity = App\Models\GioHang::where('maNguoiDung', $maNguoiDung)
                                                ->count();
                    @endphp
                    <span class="header-private-item__quantity header-private-item__quantity--in-bag">{{ $cartQuantity }}</span>
                @endif
            </a>
            @if(Auth::check())
                <input hidden type="checkbox" id="showNotification" >
                <div class="header__notify arrow">
                    <h3 class="header-notify-list__title">
                        Thông báo mới nhận
                    </h3>
                    <ul class="header-notify__list">
                        @php
                            $thongBao = App\Models\ThongBao::where('maNguoiDung',Auth::user()->maNguoiDung)->get();
                        @endphp
                        @foreach ($thongBao as $item)
                            @if($item->daXem == 0)
                                <li class="header-notify__item">
                            @else
                                <li class="header-notify__item header-notify__item--viewed">
                            @endif 
                                    <a href="#" class="header-notify-item__link">
                                        <img class="header-notify-item-link__img" src="https://minhloiiot.id.vn/assets/img/Logo-Truong-Dai-hoc-The-duc-The-thao-Da-Nang.png" alt="ASUS">
                                        <div class="header-notify-item__info">
                                            <span class="header-notify-item-link__name">{{ $item->tieuDe }}</span>
                                            <span class="header-notify-item-link__description">{{ \DateTime::createFromFormat('Y-m-d H:i:s', $item->thoiGian)->format('d-m-Y H:i:s') }}</span>
                                            <br>
                                            <span class="header-notify-item-link__description">{{ $item->noiDung }}</span>
                                        </div>
                                    </a>
                                </li>
                        @endforeach
                    </ul>
                    <div class="footer-notify ">
                        {{-- <a href="#" class="footer-notify__link">Xem tất cả</a> --}}
                    </div>
                </div>
            @endif
        </ul>
        <input type="checkbox" id='showMenuMobile' hidden>
        <label for="showMenuMobile" class="over-lay"></label>
        <ul class="menu-mobile">
            <label for="showMenuMobile" class="menu-mobile-item"><i class="fa-solid fa-xmark menu-mobile-item__link--close"></i></label>
            <li class="menu-mobile-item"><a href="/lienhe" class="menu-mobile-item__link--menu"  style="border-bottom: 1px solid rgba(0, 0, 0, 0.3); text-align:center">Menu</a></li>
            <li class="menu-mobile-item"><a href="/" class="menu-mobile-item__link">Trang chủ</a></li>
            <li class="menu-mobile-item">
                <a href="/sanbong" class="menu-mobile-item__link">Đặt sân</a>
            </li>
            <li class="menu-mobile-item"><a href="/muadungcu" class="menu-mobile-item__link">Dụng cụ</a></li>
            <li class="menu-mobile-item"><a href="/lienhe" class="menu-mobile-item__link">Liên hệ</a></li>
            <li class="menu-mobile-item"><a href="/dieukhoanchinhsach" class="menu-mobile-item__link">Điều khoản & chính sách</a></li>
            @if(Auth::check())
                <li class="menu-mobile-item menu-mobile-item--has-sub-nav">
                    <p class="menu-mobile-item__link--has-sub-nav">
                        <span>{{ Auth::user()->ho . ' '. Auth::user()->ten }}</span>  
                        <i class="fa-solid fa-arrow-down"></i>
                    </p>
                    <ul class="menu-mobile-sub-nav">
                        <li class="menu-mobile-sub-nav__item"><a href="/hosocanhan" class="menu-mobile-sub-nav__item-link">Hồ sơ cá nhân</a></li>
                        <li class="menu-mobile-sub-nav__item"><a href="/donhang" class="menu-mobile-sub-nav__item-link">Đơn hàng</a></li>
                        <li class="menu-mobile-sub-nav__item"><a href="/naptien" class="menu-mobile-sub-nav__item-link">Ví</a></li>
                        @if(Auth::user()->maQuyen == 1)
                            <li class="menu-mobile-sub-nav__item"><a href="/dashboard" class="menu-mobile-sub-nav__item-link">Quản trị viên</a></li>
                        @endif
                        <li class="menu-mobile-sub-nav__item"><a href="/dangxuat" class="menu-mobile-sub-nav__item-link">Đăng xuất</a></li>
                    </ul>
                </li>
                <script>
                    var menuUser = $('.menu-mobile-item--has-sub-nav')
                    var subMenu = menuUser.querySelector('.menu-mobile-sub-nav')
                    var arrow = menuUser.querySelector('.fa-arrow-down')
                    menuUser.onclick = () => {
                        subMenu.classList.toggle('animationOverFlow');
                        arrow.classList.toggle('rotate90')
                    }
                </script>
            @else
                <li class="menu-mobile-item"><a href="/dangnhap" class="menu-mobile-item__link">Đăng nhập</a></li>
            @endif

        </ul>
    </header>
    @include('Elements.buttontotop')
<script>
        var labelNotificationView = document.querySelector('.header-private-item-notification')
        var quantityNotificationView
        labelNotificationView.onclick = () => {
            quantityNotificationView = labelNotificationView.querySelector('.header-private-item__quantity-notification')
            quantityNotificationView.innerText = 0;
    
            fetch("http://127.0.0.1:8000/api/thongbao")
                .then(response => response.json())
                .then(thongBaos => {
                    // thongBaos = thongBaos.filter((thongBao)=>{
                    //     return thongBao.maNguoiDung == maNguoiDung
                    // })
                    maThongBaoCanDuocCapNhat = thongBaos[thongBaos.length - 1].id
                    let dataDaXem ={}
                    dataDaXem['daXem'] = 1
                    fetch("http://127.0.0.1:8000/api/thongbao/"+maThongBaoCanDuocCapNhat,{
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify(dataDaXem)
                    })
                })
        }
</script>