@extends('admin.layout.layout')
@section('contents')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <a href="https://sandbox.vnpayment.vn/merchantv2/" class="info-box" target="_blank">
            <span class="info-box-icon bg-info elevation-1"><i class="nav-icon fas fa-dollar-sign"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Doanh thu</span>
              <span class="info-box-number">
                {{ number_format($doanhThu, 0, ',', '.') }}<sup>₫</sup>
              </span>
            </div>
            <!-- /.info-box-content -->
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-info elevation-1"><i class="nav-icon fas fa-chart-pie"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tỷ lệ giao dịch</span>
              <span class="info-box-number">100%</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Vé</span>
              <span class="info-box-number">
                {{ $veQuantity}}
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <a href="/customer" class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Người dùng</span>
              <span class="info-box-number">{{ $activeUsersCount }}</span>
            </div>
            <!-- /.info-box-content -->
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Báo cáo tóm tắt</h5>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                {{-- <div class="btn-group">
                  <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-wrench"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <a href="#" class="dropdown-item">Action</a>
                    <a href="#" class="dropdown-item">Another action</a>
                    <a href="#" class="dropdown-item">Something else here</a>
                    <a class="dropdown-divider"></a>
                    <a href="#" class="dropdown-item">Separated link</a>
                  </div>
                </div> --}}
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                  <p class="text-center">
                    <strong>So sánh tổng hệ thống</strong>
                  </p>

                  <div class="progress-group">
                    Dòng tiền
                    @php
                        $totalRevenue = \App\Models\LichSuGiaoDich::where('loaiGD',1)->get()->sum('soTien');
                        $ratioRevenue = $doanhThu/$totalRevenue;
                        $percentRevenue = $ratioRevenue * 100;
                    @endphp
                    <span class="float-right"><b>{{ number_format($doanhThu, 0, ',', '.') }}</b>/{{ number_format($totalRevenue, 0, ',', '.') }}<sup>₫</sup></span>
                    <div class="progress progress-sm" title="{{ $percentRevenue }}%">
                      <div class="progress-bar bg-primary" style="width: {{ $percentRevenue }}%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Tỷ lệ giao dịch</span>
                    <span class="float-right"><b>100</b>/100</span>
                    <div class="progress progress-sm" title="100%">
                      <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <div class="progress-group">
                    Vé
                    @php
                      $ticketTotal = \App\Models\ChiTietThueSan::withTrashed()->count();
                      $ratioTicket = $veQuantity/$ticketTotal;
                        $percentTicket = $ratioTicket * 100;
                    @endphp
                    <span class="float-right"><b>{{ $veQuantity}}</b>/{{ $ticketTotal }}</span>
                    <div class="progress progress-sm" title=" {{ $percentTicket  }}%">
                      <div class="progress-bar bg-success" style="width: {{ $percentTicket }}%"></div>
                    </div>
                  </div>



                  <!-- /.progress-group -->
                  <div class="progress-group">
                    Người dùng
                    @php
                        $userTotal = App\Models\User::all()->count();
                        $ratioUser = $activeUsersCount/$userTotal;
                        $percentUser = $ratioUser * 100;
                    @endphp
                    <span class="float-right"><b>{{ $activeUsersCount }}</b>/{{ $userTotal }}</span>
                    <div class="progress progress-sm" title="{{ $percentUser }}%">
                      <div class="progress-bar bg-warning" style="width: {{ $percentUser }}%"></div>
                    </div>
                  </div>
                  <div class="progress-group">
                    Sân bóng
                    @php
                        $yardTotal = App\Models\SanBong::all()->count();
                        $activeYardCount = App\Models\SanBong::where('trangThai',1)->count();
                        $ratioYard = $activeYardCount/$yardTotal;
                        $percentYard = $ratioYard * 100;
                    @endphp
                    <span class="float-right"><b>{{ $activeYardCount }}</b>/{{ $yardTotal }}</span>
                    <div class="progress progress-sm" title="{{ $percentYard }}%">
                      <div class="progress-bar" style="width: {{ $percentYard }}%; background: purple"></div>
                    </div>
                  </div>
                  <div class="progress-group">
                    Cơ sở
                    @php
                        $branchTotal = App\Models\CoSo::all()->count();
                        $activeBranchCount = App\Models\CoSo::where('trangThai',1)->count();
                        $ratioBranch = $activeBranchCount/$branchTotal;
                        $percentBranch = $ratioBranch * 100;
                    @endphp
                    <span class="float-right"><b>{{ $activeBranchCount }}</b>/{{ $branchTotal }}</span>
                    <div class="progress progress-sm" title="{{ $percentBranch }}%">
                      <div class="progress-bar bg-danger" style="width: {{ $percentBranch }}%; background: purple"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
              <div class="row">
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 100%</span>
                    <h5 class="description-header">{{ number_format($totalRevenue, 0, ',', '.') }}<sup>₫</sup></h5>
                    <span class="description-text">Tổng tiền trên web</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> {{ $percentRevenue }}%</span>
                    <h5 class="description-header">{{ number_format($doanhThu, 0, ',', '.') }}<sup>₫</sup></h5>
                    <span class="description-text">Tổng doanh thu</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block">
                    <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                      @php
                          $percentCancel = 100 - $percentRevenue;
                      @endphp
                      {{ $percentCancel }}%                      
                    </span>
                    <h5 class="description-header">
                      @php
                          $cancelingTicketQuantity = $ticketTotal - $veQuantity;
                      @endphp
                      {{ $cancelingTicketQuantity }}
                    </h5>
                    <span class="description-text">Tổng vé hủy</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-warning"></span>
                    <h5 class="description-header">{{ number_format($averagePrice, 0, ',', '.') }}<sup>₫</sup></h5>
                    <span class="description-text">Trung bình giá vé</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
@endsection