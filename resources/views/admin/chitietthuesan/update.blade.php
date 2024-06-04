@include('Library.variable')
@include('Library.validator')
<style>
    .over-lay {
        width: 100%;
        display: flex;
        justify-content: center;
    }
    #form-update-chitietthuesan label {
        margin-bottom: 0px;
    }
    form#form-update-chitietthuesan {
        position: fixed;
        top: 58px;
        width: 50%;
        padding: 0px;
        margin: 0px;
        height: fit-content;
        border: 1px solid black;
        padding: 0 12px 12px;
        border-radius: 4px; 
    }
    #form-update-chitietthuesan .form-group {
        margin-bottom: 0px;
    }
    /* #form-update-chitietthuesan .form-group:nth-child(1) {
        margin-top: 24px;
    } */
    #form-update-chitietthuesan .close-form {
        position: absolute;
        right: 12px;
        top: 4px;
        cursor: pointer;
    }
    #form-update-chitietthuesan .close-form:hover {
        color: red;
    }   
</style>
<form id="form-update-chitietthuesan" style="background: white; ">
</form>
<script>
    var dataSanBongGlobal
    var dataLoaiSan
    fetch("http://127.0.0.1:8000/api/sanbong")
        .then(response => response.json())
        .then(data => {
            dataSanBongGlobal = data.filter((sanbong)=>{
                return sanbong.trangThai === 1
            })
        })
    const maSanPanelView = document.querySelector('#td-maSan')
    const actionPanelView = document.querySelector('#td-action')
    const thoiDiemHienTai = new Date();
    function updateChiTietThueSan(maCTTS, maSan, thoiGianBatDau, thoiGianKetThuc){
        document.querySelector('.over-lay').classList.remove('display-none')
        const form = document.querySelector('#form-update-chitietthuesan')
        form.innerHTML = `  
                                <h3 class="heading">Đổi sân `+maSan+`</h3>
                                <div class="close-form" onclick="document.querySelector('.over-lay').classList.add('display-none')"><i class="fas fa-times"></i></div>
                                <!-- /.card-body -->
                                <div class="form-group">
                                </div>
                            `
        const formGroupView = form.querySelector('.form-group')
        const selectView = document.createElement('select')
        selectView.setAttribute('name','maSan')
        formGroupView.append(selectView)

        switch(maSan){
            case "SB00001":
            case "SB00002":
            case "SB00003":
                dataLoaiSan = dataSanBongGlobal.filter((sanbong)=>{
                    return sanbong.loaiSan === "Bóng đá"
                })
                break;
            case "SB00004":
            case "SB00005":
            case "SB00006":
                dataLoaiSan = dataSanBongGlobal.filter((sanbong)=>{
                    return sanbong.loaiSan === "Chuyền"
                })
                break;
            case "SB00007":
            case "SB00008":
            case "SB00009":
                dataLoaiSan = dataSanBongGlobal.filter((sanbong)=>{
                    return sanbong.loaiSan === "Chuyền cát"
                })
                break;
            case "SB00010":
            case "SB00011":
            case "SB00012":
                dataLoaiSan = dataSanBongGlobal.filter((sanbong)=>{
                    return sanbong.loaiSan === "Bóng rỗ"
                })
                break;
            
        }
        
        for(let i = 0; i<dataLoaiSan.length;i++){
            const option = document.createElement('option')
            option.value = dataLoaiSan[i].maSan
            option.innerText = dataLoaiSan[i].maSan +" "+ dataLoaiSan[i].tenSan
            selectView.append(option)

        }
        form.innerHTML += '<button type="submit" class="btn btn-primary form-submit">Xác nhận</button>'
        Validator({
            form: "#form-update-chitietthuesan",
            rules: [
            ],
            errorSelector: ".form-message",
            buttonSubmitSelector: ".form-submit",
            // Muốn submit không theo API mặc định của trình duyệt
            onSubmit: function (dataValid) {
                if(dataValid.maSan == maSan)
                    document.querySelector('.over-lay').classList.add('display-none')
                else{
                    // Tính xem có trùng lịch
                    fetch("http://127.0.0.1:8000/api/chitietthuesan")
                            .then(promise => promise.json())
                            .then(CTTSs => {
                                CTTSs = CTTSs.filter((CTTS)=>{
                                    let formatThoiGianBatDauCuaVeDaDat = new Date(CTTS.thoiGianBatDau)
                                    return CTTS.maSan == dataValid.maSan && formatThoiGianBatDauCuaVeDaDat.getTime() >= thoiDiemHienTai.getTime()
                                })
                                CTTSs.sort(function(a, b) {
                                    // Chuyển đổi thời gian bắt đầu của mỗi phần tử thành đối tượng Date để so sánh
                                    var dateA = new Date(a.thoiGianBatDau);
                                    var dateB = new Date(b.thoiGianBatDau);
                                    
                                    // So sánh thời gian bắt đầu của hai phần tử và trả về kết quả
                                    return dateA - dateB;
                                });
                                // console.log(CTTSs)
                                let isSameDate = false
                                for (const CTTS of CTTSs) {
                                    // console.log(CTTS.thoiGianBatDau, CTTS.thoiGianKetThuc)

                                    let formatThoiGianBatDauBooking = new Date(thoiGianBatDau)
                                    let formatThoiGianKetThucBooking = new Date(thoiGianKetThuc)

                                    let formatThoiGianBatDauVe = new Date(CTTS.thoiGianBatDau)
                                    let formatThoiGianKetThucVe = new Date(CTTS.thoiGianKetThuc)
                                    if(formatThoiGianBatDauBooking<= formatThoiGianBatDauVe && formatThoiGianBatDauVe < formatThoiGianKetThucBooking || formatThoiGianBatDauBooking < formatThoiGianKetThucVe && formatThoiGianKetThucVe <= formatThoiGianKetThucBooking){
                                        isSameDate = true;
                                        break;
                                    }
                                    // Còn 1 trường hợp vé đặt có khoảng thời gian nhỏ hơn vs vé đã đặt: 18 - 21 vs 16 - 22
                                    if(formatThoiGianBatDauVe<= formatThoiGianBatDauBooking  && formatThoiGianBatDauBooking < formatThoiGianKetThucVe || formatThoiGianBatDauVe< formatThoiGianKetThucBooking  && formatThoiGianKetThucBooking <= formatThoiGianKetThucVe){
                                        isSameDate = true;
                                        break;
                                    }
                                }
                                if(isSameDate){
                                    toastr.options = {
                                        "toastClass": "toast-style", // Đặt lớp CSS cho toast
                                        "titleClass": "toast-title-style", // Đặt lớp CSS cho tiêu đề toast
                                        "messageClass": "toast-message-style" // Đặt lớp CSS cho thông báo toast
                                    };
                                    toastr.options.closeButton = true;
                                    toastr.error("Không thể đổi sân vì trùng lịch.");
                                }
                                else{
                                    fetch("http://127.0.0.1:8000/api/chitietthuesan/"+maCTTS,{
                                        method: "PUT",
                                        headers: {
                                            // "Content-Type": "application/x-www-form-urlencoded", x-www-form-urlencoded: form data
                                            "Content-Type": "application/json",
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        },
                                        // body: JSON.stringify(data),
                                        body: JSON.stringify({ maSan: dataValid.maSan}),
                                    })
                                        .then(response => response.json())
                                        .then(data =>{
                                            // if(data.success){
                                            //     maSanPanelView.innerText = dataValid.maSan
                                            //     actionPanelView.innerHTML = `<button onclick="updateChiTietThueSan('${maCTTS}', '${dataValid.maSan}', '${thoiGianBatDau}', '${thoiGianKetThuc}')">Đổi sân</button>`
                                            //     document.querySelector('.over-lay').classList.add('display-none')
                                                // toastr.success(data.success)
                                            // }
                                            // else
                                            //     toastr.error(data.error)
                                            toastr.success(data.success)
                                            window.location.href = "/booking"
                                        })
                                }
                            })
                }
            },
            formGroupSelector: ".form-group",
        });
    }
</script>
