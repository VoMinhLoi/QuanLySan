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
              <h5 class="card-title">Monthly Recap Report</h5>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <div class="btn-group">
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
                </div>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                    <div class="card">
                      <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                          <h3 class="card-title">Doanh thu nhận về</h3>
                          <a href="javascript:void(0);">View Report</a>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="d-flex">
                          <p class="d-flex flex-column">
                            <span class="text-bold text-lg">
                              {{ number_format($doanhThu, 0, ',', '.') }}<sup>₫</sup>
                            </span>
                            <span>Sales Over Time</span>
                          </p>
                          <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                              <i class="fas fa-arrow-up"></i> 33.1%
                            </span>
                            <span class="text-muted">Since last month</span>
                          </p>
                        </div>
                        <!-- /.d-flex -->
        
                        <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                          <canvas id="sales-chart" height="250" width="715" style="display: block; height: 200px; width: 572px;" class="chartjs-render-monitor"></canvas>
                        </div>
        
                        <div class="d-flex flex-row justify-content-end">
                          <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> This year
                          </span>
        
                          <span>
                            <i class="fas fa-square text-gray"></i> Last year
                          </span>
                        </div>
                      </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
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
                    Vé / Tổng vé (tính cả vé hủy)
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
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block">
                    <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
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