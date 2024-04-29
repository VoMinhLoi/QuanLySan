@extends('admin.layout.layout')
@section('contents')

    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Lịch sử giao dịch</h3>

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
                    <th style="width: 10%">
                        Mã giao dịch
                    </th>
                    <th style="width: 10%">
                        Mã người dùng
                    </th>
                    <th style="width: 10%">
                        Nội dung chuyển khoản
                    </th>
                    <th style="width: 10%">
                        TransID 
                    </th>
                    <th style="width: 10%">
                        Số tiền
                    </th>
                    <th style="width: 10%" class="text-center">
                        Thời gian
                    </th>
                    <th style="width: 10%" class="text-center">
                        <select class="filter">
                            <option value="Tất cả giao dịch">Tất cả giao dịch</option>
                            <option value="Thanh toán">Thanh toán</option>
                            <option value="Nạp tiền">Nạp tiền</option>
                            <option value="Hoàn tiền">Hoàn tiền</option>
                        </select>
                    </th>
                    <th style="width: 10%" class="text-center">
                        Trạng thái
                    </th>
                </tr>
            </thead>
                <tbody id="lichSuGiaoDich" >
                    @foreach ($lichSuGiaoDich as $item)
                        <tr class="{{ "row-".$item->id }} ">
                            <td>
                                {{'MGD'.$item->id }}
                                
                            </td>
                            <td class="column-name-branch">
                                {{ 'ND'.$item->maNguoiDung }}
                            </td>
                            <td class="column-description">
                                @if ($item->loaiGD == 3)
                                    {{ $item->ndck . " cho người dùng ND".$item->maNguoiDung}}
                                @else
                                    {{ $item->ndck }}
                                @endif
                            </td>
                            <td class="project_progress text-center">
                                {{ $item->transID }}
                            </td>
                            <td class="project_progress text-center">
                                @if ($item->loaiGD == 1)
                                    <span style="color: blue; font-weight: bolder">{{ number_format($item->soTien, 0, ',', '.') }} <sup>₫</sup></span>

                                @else
                                    @if ($item->loaiGD == 2)
                                        <span style="color: green; font-weight: bolder">{{ number_format($item->soTien, 0, ',', '.') }} <sup>₫</sup></span>
                                    @else
                                        <span style="color: red; font-weight: bolder">{{ number_format($item->soTien, 0, ',', '.') }} <sup>₫</sup></span>
                                    @endif
                                @endif
                            </td>
                            <td class="project-state column-time-open">
                                
                                {{\DateTime::createFromFormat('Y-m-d H:i:s',  $item->thoiGian)->format('d-m-Y H:i:s') }}
                            </td>
                            <td class="project-actions column-time-close">
                                @if ($item->loaiGD == 1)
                                    Nạp tiền
                                @else
                                    @if ($item->loaiGD == 2)
                                        Thanh toán
                                    @else
                                        Hoàn tiền
                                    @endif
                                @endif
                                
                            </td>
                            <td class="project-actions text-right column-action">
                                @if($item->trangThai == 1)
                                    <span style="color: green">Thành công</span>
                                @else
                                    <span style="color: red">Thất bại</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
<script>
    setTimeout(()=>{
        var filterView = document.querySelector('.filter')
        var tableLichSuGiaoDichView = document.getElementById('lichSuGiaoDich')
        handleFilter(filterView, tableLichSuGiaoDichView)
    }, 1000);
    function handleFilter(filterView, tableLichSuGiaoDichView){
        var dataLSDG
        var dataThanhToanLSGD
        var dataNapTienLSGD
        var dataHoanTienLSGD
        // console.log(filterView, tableLichSuGiaoDichView)
        filterView.onchange = ()=>{
            hanldeLichSuGiaoDich(filterView.value)
        }
        function hanldeLichSuGiaoDich(value){
            tableLichSuGiaoDichView.innerHTML = ""
            switch(value){
                case "Tất cả giao dịch":
                    if(!dataLSDG){
                        getLichSuGiaoDich(data => {
                            dataLSDG = data
                            renderLichSuGiaoDich(dataLSDG)
                        });
                    }
                    else
                        renderLichSuGiaoDich(dataLSDG)
                    break;
                case "Nạp tiền":
                    if(!dataNapTienLSGD){
                            getLichSuGiaoDich(data => {
                                dataNapTienLSGD = data.filter((LSGD)=>{
                                    return LSGD.loaiGD === 1
                                })
                                renderLichSuGiaoDich(dataNapTienLSGD)
                            });
                    }
                    else
                        renderLichSuGiaoDich(dataNapTienLSGD)
                    break;
                case "Thanh toán":
                    if(!dataThanhToanLSGD){
                                getLichSuGiaoDich(data => {
                                    dataThanhToanLSGD = data.filter((LSGD)=>{
                                        return LSGD.loaiGD === 2
                                    })
                                    renderLichSuGiaoDich(dataThanhToanLSGD)
                                });
                    }
                    else
                        renderLichSuGiaoDich(dataThanhToanLSGD)
                    break;
                case "Hoàn tiền":
                    if(!dataHoanTienLSGD){
                                getLichSuGiaoDich(data => {
                                    dataHoanTienLSGD = data.filter((LSGD)=>{
                                        return LSGD.loaiGD === 3
                                    })
                                    renderLichSuGiaoDich(dataHoanTienLSGD)
                                });
                    }
                    else
                        renderLichSuGiaoDich(dataHoanTienLSGD)
                    break;
            }
        }
        function getLichSuGiaoDich(callback){
            fetch("http://127.0.0.1:8000/api/lichsugiaodich")
                .then(response => response.json())
                .then(callback)
        }
        function renderLichSuGiaoDich(data){
            data.forEach((LSGD)=>{
                tableLichSuGiaoDichView.innerHTML +=     `
                                                            <tr>
                                                                <td>
                                                                    ${'MGD'+LSGD.id}
                                                                </td>
                                                                <td class="column-name-branch">
                                                                    ${'ND'+LSGD.maNguoiDung}
                                                                </td>
                                                                <td class="column-description">
                                                                    ${LSGD.loaiGD == 3?LSGD.ndck + " cho người dùng ND"+LSGD.maNguoiDung:LSGD.ndck}
                                                                </td>
                                                                <td class="project_progress text-center">
                                                                    ${LSGD.transID?LSGD.transID:""}
                                                                </td>
                                                                <td class="project_progress text-center">
                                                                    ${LSGD.loaiGD == 1 ? `<span style="color: blue; font-weight: bolder">${formatCurrency(LSGD.soTien)}</span>` :
                                                                    LSGD.loaiGD == 2 ? `<span style="color: green; font-weight: bolder">${formatCurrency(LSGD.soTien)}</span>` :
                                                                    `<span style="color: red; font-weight: bolder">${formatCurrency(LSGD.soTien)}</span>`}

                                                                </td>
                                                                <td class="project-state column-time-open">
                                                                    ${formatDate(LSGD.thoiGian)}
                                                                </td>
                                                                <td class="project-actions column-time-close">
                                                                    ${LSGD.loaiGD == 1?'Nạp tiền':LSGD.loaiGD == 2?"Thanh toán":"Hoàn tiền"}                                                                
                                                                </td>
                                                                <td class="project-actions text-right column-action">
                                                                    ${LSGD.trangThai == 1?`<span style="color: green">Thành công</span>`:`<span style="color: red">Thất bại</span>`}
                                                                </td>
                                                            </tr>
                                                        `
            })
        }
        function formatCurrency(input) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(input);
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
            
    }
</script>