    <!-- Brand Logo -->
  <a href="/dashboard" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>
  
      <!-- Sidebar -->
    <div class="sidebar ">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            {{-- @if(Auth::user()->hinhDaiDien)
              <img src="assets/img/{{ Auth::user()->hinhDaiDien }}" alt="avater">
            @else --}}
              <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">

            {{-- @endif --}}
          </div>
          <div class="info">
            <a href="/hosocanhan" class="d-block">{{ Auth::user()->ho ." ". Auth::user()->ten }}</a>
          </div>
        </div>
  
        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>
  
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <div class="nav-item">
              <a href="/dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </div>
            <div class="nav-item">
              <a href="https://sandbox.vnpayment.vn/merchantv2/" class="nav-link" target="_blank">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                  Thống kê doanh thu
                </p>
              </a>
            </div>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>
                  Quản lý sân
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/branch" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cơ sở</p>
                    <span class="badge badge-info right">{{ App\Models\CoSo::all()->count() }}</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/pitch" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sân bóng</p>
                    <span class="badge badge-info right">{{ App\Models\SanBong::all()->count() }}</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/tools" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dụng cụ</p>
                    <span class="badge badge-info right">{{ App\Models\DungCu::all()->count() }}</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/booking" class="nav-link">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>Lịch đặt sân</p>
                    <span class="badge badge-info right">{{ App\Models\ChiTietThueSan::all()->count() }}</span>
                  </a>
                </li>
              </ul>
            </li>

            <div class="nav-item">
              <a href="/news" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Quản lý tin tức
                </p>
                <span class="badge badge-info right">{{ App\Models\TinTuc::all()->count() }}</span>
              </a>
            </div>
            <div class="nav-item">
              <a href="/customer" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Quản lý người dùng
                </p>
                <span class="badge badge-info right">{{ App\Models\User::all()->count() }}</span>
              </a>
            </div>
            <div class="nav-item">
              <a href="/history" class="nav-link">
                <i class="nav-icon fas fa-money-bill-wave"></i>
                <p>
                  Lịch sử giao dịch
                </p>
                <span class="badge badge-info right">{{ App\Models\LichSuGiaoDich::all()->count() }}</span>
              </a>
            </div>
            <div class="nav-item">
              <a href="/dangxuat" class="nav-link">
                <i class="fas fa-angle-left nav-icon"></i>
                <p>
                  Đăng xuất
                </p>
              </a>
            </div>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->