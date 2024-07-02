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
    const form = document.querySelector('#form-update-chitietthuesan')
    
    const maSanPanelView = document.querySelector('#td-maSan')
    const actionPanelView = document.querySelector('#td-action')
    const thoiDiemHienTai = new Date();
    function updateChiTietThueSan(maCTTS, maSan, thoiGianBatDau, thoiGianKetThuc, giaDichVu){
        document.querySelector('.over-lay').classList.remove('display-none')
        form.innerHTML = `  
                                <h3 class="heading">Thay đổi thông tin sân chi tiết thuê sân `+maCTTS+`</h3>
                                <div class="close-form" onclick="document.querySelector('.over-lay').classList.add('display-none')"><i class="fas fa-times"></i></div>
                                <!-- /.card-body -->
                                <div class="form-group">
                                    <label for="maSan">Sân</label>
                                </div>
                            `
        const formGroupView = form.querySelector('.form-group')
        const selectView = document.createElement('select')
        selectView.setAttribute('id','maSan')
        selectView.setAttribute('name','maSan')
        formGroupView.append(selectView)
        dataLoaiSan = dataSanBongGlobal.filter((sanbong)=>{
            return sanbong.giaDichVu == giaDichVu
        })
        
        for(let i = 0; i<dataLoaiSan.length;i++){
            const option = document.createElement('option')
            option.value = dataLoaiSan[i].maSan
            option.innerText = dataLoaiSan[i].maSan +" "+ dataLoaiSan[i].tenSan
            if(dataLoaiSan[i].maSan === maSan)
                option.setAttribute('selected', 'selected');
            selectView.append(option)

        }
        let thoiGianBatDauYYYYMMDD = new Date(thoiGianBatDau) // "2024-06-04 23:00:00" => "2024-06-04T23:00"
        const year = thoiGianBatDauYYYYMMDD.getFullYear().toString().padStart(4, '0');
        const month = (thoiGianBatDauYYYYMMDD.getMonth() + 1).toString().padStart(2, '0'); // Add 1 for correct month
        const day = thoiGianBatDauYYYYMMDD.getDate().toString().padStart(2, '0');
        const hours = thoiGianBatDauYYYYMMDD.getHours().toString().padStart(2, '0');
        const minutes = thoiGianBatDauYYYYMMDD.getMinutes().toString().padStart(2, '0');

        let thoiGianBatDauFormated = `${year}-${month}-${day}T${hours}:${minutes}`;
        form.innerHTML +=   `
                            <div class="form-group">
                                <label for="thoiGianBatDau">Thời gian bắt đầu</label>
                                <input type="datetime-local" id="thoiGianBatDau" name="thoiGianBatDau" value='${thoiGianBatDauFormated}'>
                            </div>
                            `
        const thoiGianBatDauInput = document.getElementById('thoiGianBatDau');
        thoiGianBatDauInput.min = getFormattedDateTime();
        form.innerHTML += '<button type="submit" class="btn btn-primary form-submit">Xác nhận</button>'
        const borrowHourQuantity = tinhKhoangCach(thoiGianBatDau, thoiGianKetThuc)
        Validator({
            form: "#form-update-chitietthuesan",
            rules: [
            ],
            errorSelector: ".form-message",
            buttonSubmitSelector: ".form-submit",
            // Muốn submit không theo API mặc định của trình duyệt
            onSubmit: function (dataValid) {
                const thoiGianBatDauChoose = new Date(dataValid.thoiGianBatDau)
                // Kiểm tra mã sân, ngày bắt đầu có thay đổi hay không?
                if(dataValid.maSan == maSan && thoiGianBatDauYYYYMMDD.getTime() ==  thoiGianBatDauChoose.getTime())
                    document.querySelector('.over-lay').classList.add('display-none')
                else{
                    let dataSubmitGlobal = { maSan: dataValid.maSan}
                    if(thoiGianBatDauYYYYMMDD.getTime() !=  thoiGianBatDauChoose.getTime()){
                        thoiGianKetThuc = getTimeEnd(dataValid.thoiGianBatDau, borrowHourQuantity, thoiGianBatDauChoose.getHours())
                        dataSubmitGlobal["thoiGianBatDau"] = dataValid.thoiGianBatDau
                        dataSubmitGlobal["thoiGianKetThuc"] = thoiGianKetThuc
                        // console.log("BD: "+dataValid.thoiGianBatDau, "Thue: "+ borrowHourQuantity, "gioBatDau:" +thoiGianBatDauChoose.getHours(), " = KT: "+thoiGianKetThuc)
                    }
                    // console.log(dataValid.thoiGianBatDau, thoiGianKetThuc) 
                    // Tính xem có trùng lịch
                    if(thoiDiemHienTai.getTime() <= thoiGianBatDauChoose.getTime())
                        fetch("http://127.0.0.1:8000/api/chitietthuesan")
                            .then(promise => promise.json())
                            .then(CTTSs => {
                                CTTSs = CTTSs.filter((CTTS)=>{
                                    let formatThoiGianBatDauCuaVeDaDat = new Date(CTTS.thoiGianBatDau)
                                    return CTTS.maSan == dataValid.maSan && formatThoiGianBatDauCuaVeDaDat.getTime() >= thoiDiemHienTai.getTime() && CTTS.maCTTS != maCTTS // CTTS.maCTTS: int, maCTTS: string
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

                                    let formatThoiGianBatDauBooking = new Date(dataValid.thoiGianBatDau)
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
                                        body: JSON.stringify(dataSubmitGlobal),
                                    })
                                        .then(response => response.json())
                                        .then(data =>{
                                            toastr.success(data.success)
                                            window.location.href = "/booking/"+maCTTS
                                        })
                                }
                            })
                    else
                        toastr.error("Thời gian bắt đầu không hợp lệ.");    
                }
            },
            formGroupSelector: ".form-group",
        });
    }
    function tinhKhoangCach(gioBatDau, gioKetThuc) {
        // Chuyển đổi thời gian thành đối tượng Date
        var batDau = new Date(gioBatDau);
        var ketThuc = new Date(gioKetThuc);
        
        // Tính toán khoảng cách thời gian (tính bằng mili giây)
        var khoangCachMiliseconds = ketThuc - batDau;
        
        // Chuyển đổi khoảng cách từ mili giây thành giờ
        var khoangCachGio = khoangCachMiliseconds / (1000 * 60 * 60);
        
        return khoangCachGio;
    }
    function getTimeEnd(startTime, borrowHour, hourStart) {
        const startDateTime = new Date(startTime);
        
        // Đặt giờ bắt đầu
            // Nếu giờ bắt đầu là 00:00:00, thêm số giờ vào ngày hiện tại
        if (startDateTime.getHours() === 0 && startDateTime.getMinutes() === 0 && startDateTime.getSeconds() === 0) {
            startDateTime.setHours(startDateTime.getHours() + parseInt(borrowHour));
        } else {
            // Đặt giờ bắt đầu
            startDateTime.setHours(parseInt(hourStart));
            
            // Cộng thêm số giờ thuê
            startDateTime.setHours(startDateTime.getHours() + parseInt(borrowHour));
        }
        // Lấy thông tin ngày, tháng, năm, giờ, phút và giây từ đối tượng Date
        const year = startDateTime.getFullYear();
        const month = String(startDateTime.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0, nên cộng thêm 1
        const day = String(startDateTime.getDate()).padStart(2, '0');
        const hours = String(startDateTime.getHours()).padStart(2, '0');
        const minutes = String(startDateTime.getMinutes()).padStart(2, '0');
        const seconds = String(startDateTime.getSeconds()).padStart(2, '0');

        // Tạo chuỗi định dạng Y-m-d h-m-s
        const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        return formattedDate;
    }
    function getFormattedDateTime() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        
        return `${year}-${month}-${day}T${hours}:${minutes}`;
    }
</script>
