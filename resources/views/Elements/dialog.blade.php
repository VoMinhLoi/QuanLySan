@include('Library.validator')
<style>

    .form-control, .form-label, .form-message {
        font-size: 14px;
    }
    .form-close {
      position: absolute;
      top: 0;
      right: 0;
      color: var(--primary-color);
      width: 50px;
      height: 50px;
      line-height: 50px;
      cursor: pointer;
    }
    .form-close:hover {
      color: red;
    }
    .form-input {
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        font-size: 12px;
    }

    .form-input__value-label--disable {
      opacity: 0.3;
      cursor: not-allowed;
    }
    .form-input__value:first-child {
      margin-top: 10px;
    }
    .form-input__value {
      margin-left: 8px; 
    }
    .form-input__value-input:checked + .form-input__value-label {
      background: var(--primary-color);
      color:white;
    }
    .form-input__value-label {
      border: 1px solid #ccc;
      border-radius: 4px;
      height: 32px;
      line-height: 32px;
      width: 32px;
    }
    .form-input__value-label--busy {
      background: red;
      cursor: not-allowed;
    }
    #borrowHour {
      border: 1px solid;
      width: 40px;
      text-align: center;
    }
    .calendar {
        display: flex;
        justify-content: space-around;
        height: 40px;
        align-items: center;
        margin: 12px 0;

    }
    .calendar-action {
      border: 1px solid black;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        line-height: 40px;
        cursor: pointer;
    }
    .calendar-action--disable {
      opacity: 0.2;
      cursor: no-drop;

    }
    .form-group-row {
      display: flex;
      align-items: center;
    }
</style>
    <form action="" method="POST" class="form" id="form-calendar" >
        {{-- <h3 class="heading">Thành viên đăng ký</h3> --}}
        {{-- <p class="desc" style="font-size: 14px;">Đặt sân phù hợp❤️</p> --}}
        <label class="form-label" style="font-size: 14px;">Lịch</label>
        <div class="calendar form-group" style="flex-direction: row">
          <p class="calendar-action before-calendar calendar-action--disable">
            <i class="fa-solid fa-arrow-left"></i>
          </p>
          <input type="text" name="calendar-date" id="calendar-date" style="text-align: center" readonly placeholder="dd-mm-yyyy"> 
          <p class="calendar-action after-calendar">
            <i class="fa-solid fa-arrow-right"></i>
          </p>
        </div>
        <div class="form-group" id="wrapper-start-hour"  data-set="{{ $gioDongCua }}">
            <label class="form-label" 
              >Chọn giờ bắt đầu</label
            >
            <div class="form-input">
                @for ($i = $gioMoCua; $i < $gioDongCua; $i++)
                  <div class="form-input__value">
                    <input
                      id="hour{{ $i }}"
                      class="form-input__value-input hourStart"
                      name="hourStart"
                      style="margin-right: 4px"
                      value="{{ $i }}"
                      type="radio"
                      hidden
                    />
                    <label for="hour{{ $i }}" style="font-size: 12px" class="form-input__value-label">{{ $i }}</label>
                  </div>
                @endfor
            </div>
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <label for="borrowHour" class="form-label" style="font-size: 14px;">Thời gian thuê</label>
            <div class="">
              @if($gioDongCua < 25)
                {{ $gioMoCua }} giờ bắt đầu - tối đa thuê: {{ $soGioThue }} tiếng.
                <br/>
              @endif
              <input type="number" name="borrowHour" id="borrowHour" value="1" max="{{ $soGioThue }}"> 
              Giờ
            </div>
            
            <span class="form-message"></span>
        </div>
        <button class="form-submit" style="margin-bottom: 8px;">Đặt</button>
        <div class="form-close" onclick="document.querySelector('.overlay').classList.add('display-none'); enableHourOutCurrentDate(); if (calendarView.value === currentDateGlobal) {
          buttonBeforeCalendar.classList.add('calendar-action--disable');
        }">
          <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="form-group form-note" style="margin: 0px">
          <label class="form-label" style="font-size: 14px; border-top: 1px solid black; padding-top: 4px">Chú thích</label>
          <div class="form-group-row">
            <div class="form-input" style="flex: 1">
              <div class="form-input__value">
                <p class="form-input__value-label" >Giờ</p>
                <p style="line-height: 32px; margin-left: 4px; ">Sẵn sàng</p>
              </div>
            </div>
            <div class="form-input" style="flex: 1">
              <div class="form-input__value">
                <p style=" background: var(--primary-color); color: white" class="form-input__value-label">Giờ</p>
                <p style="line-height: 32px; margin-left: 4px; ">Đã chọn</p>
              </div>
            </div>
          </div>
          <div class="form-group-row">
            <div class="form-input" style="flex: 1">
              <div class="form-input__value">
                <p class="form-input__value-label  form-input__value-label--busy">Giờ</p>
                <p style="line-height: 32px; margin-left: 4px; ">Bận</p>
              </div>
            </div>
            <div class="form-input" style="flex: 1">
              <div class="form-input__value">
                <p class="form-input__value-label" style="opacity: 0.3; cursor:not-allowed">Giờ</p>                
                <p style="line-height: 32px; margin-left: 4px;">Đã qua</p>
              </div>
            </div>
          </div>
        </div>
        
      </form>
<script>

  var maSanGlobal
  function showImproveDialog(maSan){
    maSanGlobal = maSan
    deleteHourBusy()
    disableHourInCurrentDate()
    handleHourBusy(maSan)
    form.classList.remove('display-none');
  }
  function handleHourBusy(maSan){
    form.dataset.key = maSan;
    fetch("http://127.0.0.1:8000/api/chitietthuesan")
      .then(response => response.json())
      .then(dataCTTS => {
        let dataSanTrongChiTietThueSan = dataCTTS.filter((chiTietThueSan)=>{
          // console.log(thoiGianBatDau, ngayDangChon)
          return chiTietThueSan.maSan === maSan
        })
        const ngayDangChon = formatDateToYYYYMMDD(calendarChoosing);
        // console.log(ngayDangChon)
        let ngayBatDauTrungNgayHienTaiDangChonList = dataSanTrongChiTietThueSan.filter((chiTietThueSan)=>{
          const thoiGianBatDau = chiTietThueSan.thoiGianBatDau.split(' ')[0]; // Lấy phần ngày từ thời gian bắt đầu
          return thoiGianBatDau === ngayDangChon
        })
        ngayBatDauTrungNgayHienTaiDangChonList.forEach((chiTietThueSan)=>{
          const thoiGianKetThuc = chiTietThueSan.thoiGianKetThuc.split(' ')[0]; // Lấy phần ngày từ thời gian bắt đầu
          // Nếu kết thúc trong ngày thì render giờ bận từ giờ bắt đầu tới giờ kết thúc còn nếu ngày kết thúc khác ngày đang chọn trên lịch thì cho render hết tới 24
          const gioBatDau = parseInt(chiTietThueSan.thoiGianBatDau.split(" ")[1].split(":")[0])
          if(thoiGianKetThuc === ngayDangChon){
            const gioKetThuc = parseInt(chiTietThueSan.thoiGianKetThuc.split(" ")[1].split(":")[0]) - 1
            renderBusyHour(gioBatDau, gioKetThuc)
          } 
          else {
            const gioKetThuc = parseInt(chiTietThueSan.thoiGianKetThuc.split(" ")[1].split(":")[0])
            if(gioKetThuc === 0)
              renderBusyHour(gioBatDau, 23)
            else{
             renderBusyHour(gioBatDau, 24)
            }
          }
        })
        let ngayKetThucTrungNgayHienTaiDangChonList = dataSanTrongChiTietThueSan.filter((chiTietThueSan)=>{
          const thoiGianKetThuc = chiTietThueSan.thoiGianKetThuc.split(' ')[0]; // Lấy phần ngày từ thời gian ket thuc
          const thoiGianBatDau = chiTietThueSan.thoiGianBatDau.split(' ')[0]; // Lấy phần ngày từ thời gian bắt đầu

          // console.log()
          return thoiGianKetThuc === ngayDangChon && thoiGianKetThuc !== thoiGianBatDau
        })
        // console.log(ngayBatDauTrungNgayHienTaiDangChonList, ngayKetThucTrungNgayHienTaiDangChonList)
        ngayKetThucTrungNgayHienTaiDangChonList.forEach((chiTietThueSan)=>{
          // hour = tinhKhoangCach(chiTietThueSan.thoiGianBatDau, chiTietThueSan.thoiGianKetThuc)
          const gioBatDau = parseInt(chiTietThueSan.thoiGianBatDau.split(" ")[1].split(":")[0])
          let gioKetThuc = parseInt(chiTietThueSan.thoiGianKetThuc.split(" ")[1].split(":")[0])-1 //Kết thúc: 2024-04-20 09:00:00 thì lấy 09:00:00 lấy 09 - 1 = 8 Thì người khác 9h bắt đầu vẫn được
          // console.log(gioKetThuc)
          // if(gioBatDau === 0 && gioKetThuc === 0) 
          //   renderBusyHour(24, 24)
          // else  
            if(gioKetThuc - gioBatDau < 0){
              renderBusyHour(1, gioKetThuc)
            }
            else{
              renderBusyHour(gioBatDau, gioKetThuc)
            // }
        })
      })
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
  function renderBusyHour(gioBatDau, gioKetThuc){
    var allHours = document.querySelectorAll('.hourStart');
    // if(gioBatDau === 0)
    //   gioBatDau = 24
    // if(gioKetThuc === 0)
    //   gioKetThuc = 24
    allHours.forEach(function(input) {
        var hourValue = parseInt(input.value);
        if (hourValue >= gioBatDau && hourValue <= gioKetThuc) {
            input.disabled = true;
            input.checked = false
            var labelForInput = input.nextElementSibling;
            if (labelForInput) {
                labelForInput.classList.add('form-input__value-label--busy');
            }
        }
    });
  }
  // Làm lịch thay đổi giá trị 
  var calendarChoosing = getDate(); //Định dạng dd-mm-yyyy
  var currentDateGlobal; //Định dạng dd-mm-yyyy
  var calendarView = document.querySelector('#calendar-date');
  calendarView.value = calendarChoosing;

  function getDate(changeNgay) {
      if (calendarChoosing) {
          var parts = calendarChoosing.split('-'); // Tách ngày, tháng và năm từ chuỗi
          var newDate = new Date(parseInt(parts[2], 10), parseInt(parts[1], 10) - 1, parseInt(parts[0], 10)); // Tạo đối tượng Date từ các phần tử đã tách
          newDate.setDate(newDate.getDate() + changeNgay);
          var day = newDate.getDate();
          var month = newDate.getMonth() + 1; // Tháng bắt đầu từ 0 nên cần cộng thêm 1
          var year = newDate.getFullYear();

          // Định dạng lại ngày tháng
          if (day < 10) {
              day = '0' + day; // Thêm số 0 đằng trước nếu ngày chỉ có một chữ số
          }
          if (month < 10) {
              month = '0' + month; // Thêm số 0 đằng trước nếu tháng chỉ có một chữ số
          }
          return day + '-' + month + '-' + year;
      } else {
          var currentDateInFunction = new Date();
          var day = currentDateInFunction.getDate();
          var month = currentDateInFunction.getMonth() + 1; // Tháng bắt đầu từ 0 nên cần cộng thêm 1
          var year = currentDateInFunction.getFullYear();

          // Định dạng lại ngày tháng
          if (day < 10) {
              day = '0' + day; // Thêm số 0 đằng trước nếu ngày chỉ có một chữ số
          }
          if (month < 10) {
              month = '0' + month; // Thêm số 0 đằng trước nếu tháng chỉ có một chữ số
          }

          var formattedDate = day + '-' + month + '-' + year;
          currentDateGlobal = formattedDate;
          return formattedDate;
      }
  }

  var buttonBeforeCalendar = document.querySelector('.before-calendar');
  var buttonAfterCalendar = document.querySelector('.after-calendar');

  buttonBeforeCalendar.onclick = function() {
    if (calendarChoosing !== currentDateGlobal) {
        calendarChoosing = getDate(-1);
        handleChangeCalendar();
        deleteHourBusy();
        disableHourInCurrentDate()
        handleHourBusy(maSanGlobal)
    }
  };

  buttonAfterCalendar.onclick = function() {
      calendarChoosing = getDate(1);
      handleChangeCalendar()
      deleteHourBusy()
      // disableHourInCurrentDate()
      handleHourBusy(maSanGlobal)
  };
  function handleChangeCalendar(){
    calendarView.value = calendarChoosing;
    // console.log("Ngày hiện tại:" + currentDateGlobal)
    // console.log("Ngày di chuyển:" + calendar)
    // console.log("Ngày của view:" + calendarView.value)
    // console.log(currentDateGlobal, calendarView.value)
    if (calendarView.value === currentDateGlobal) {
          buttonBeforeCalendar.classList.add('calendar-action--disable');
          disableHourInCurrentDate()
      } else {
          buttonBeforeCalendar.classList.remove('calendar-action--disable');
          enableHourOutCurrentDate()
    }
  }

// Lặp qua tất cả các input giờ
  var currentHour = new Date().getHours() + 1;
  disableHourInCurrentDate()
  function disableHourInCurrentDate(){
    document.querySelectorAll('.hourStart').forEach(function(input) {
      // Lấy giá trị giờ từ thuộc tính value của input
      var hourValue = parseInt(input.value);
      // console.log(currentDateGlobal,calendarChoosing)
      // Kiểm tra nếu giờ hiện tại lớn hơn giá trị của input
      if(currentDateGlobal === calendarChoosing){
        if (currentHour > hourValue) {
          // Nếu có, disable input
          input.disabled = true;
          input.checked = false
          // Thêm lớp form-input__value-label--disable cho label kề liền với input
          var labelForInput = input.nextElementSibling;
          if (labelForInput) {
              labelForInput.classList.add('form-input__value-label--disable');
          }
        }
      }
    });
  }
  function enableHourOutCurrentDate(){
    document.querySelectorAll('.hourStart').forEach(function(input) {
      // Lấy giá trị giờ từ thuộc tính value của input
      var hourValue = parseInt(input.value);
      
      // Kiểm tra nếu giờ hiện tại lớn hơn giá trị của input
      if (currentHour > hourValue) {
          // Nếu có, disable input
          input.disabled = false;

          // Thêm lớp form-input__value-label--disable cho label kề liền với input
          var labelForInput = input.nextElementSibling;
          if (labelForInput) {
            labelForInput.classList.remove('form-input__value-label--disable');
          }
      }
    });
  }
  function deleteHourBusy(){
    document.querySelectorAll('.hourStart').forEach(function(input) {
      // Lấy giá trị giờ từ thuộc tính value của input
      var hourValue = parseInt(input.value);
      
      // Kiểm tra nếu giờ hiện tại lớn hơn giá trị của input
          // Nếu có, disable input
          input.disabled = false;

          // Thêm lớp form-input__value-label--disable cho label kề liền với input
          var labelForInput = input.nextElementSibling;
          if (labelForInput) {
            labelForInput.classList.remove('form-input__value-label--busy');
          }
    });

  }
  var borrowTimeView = document.querySelector('#borrowHour')
  borrowTimeView.onchange = () => {
    if(borrowTimeView.value <= 0)
      borrowTimeView.value = 1
    else
      if(borrowTimeView.value > 24){
        borrowTimeView.value = 24
      }
  }

  Validator({
    form: "#form-calendar",
    rules: [
        Validator.isRequired(".hourStart", "Vui lòng chọn giờ bắt đầu"),
    ],
    errorSelector: ".form-message",
    buttonSubmitSelector: ".form-submit",
    onSubmit: function (data) {
      // Kiểm tra thuê giờ cho hợp lệ nếu không được thuê liên tục
      if(parseInt(borrowTimeView.max)<24){
        // let gioDongCua = document.querySelector('#wrapper-start-hour').getAttribute('data-set');
        let gioDongCua = document.querySelector('#wrapper-start-hour').dataset.set;
        if(parseInt(data.hourStart) + parseInt(data.borrowHour) > gioDongCua){
          let allowHours = gioDongCua - parseInt(data.hourStart)
          toastr.warning('Quý khách chỉ có thể thuê liên tục '+ allowHours + " tiếng nếu bắt đầu từ "+ data.hourStart + " giờ vì chúng tôi sẽ đóng cửa vào "+ gioDongCua+" giờ. Mong quý khách thông cảm và thực hiện theo chỉ dẫn.")
        }
        else
          hanldeRentingYard(data)
      }
      else
        hanldeRentingYard(data)
    },
    formGroupSelector: ".form-group",
}); //Thêm dấu ngoặc nhọn này để đóng hàm Validator
function hanldeRentingYard(data){
  data["maSan"] = $('.overlay')[0].dataset.key,
  // data["soLuong"] = 1,
  data["thoiGianBatDau"] = getTimeStart(formatDateToYYYYMMDD(calendarChoosing),data.hourStart).toString(),
  data["thoiGianKetThuc"] = getTimeEnd(data["thoiGianBatDau"], data.borrowHour, data.hourStart).toString(),
  // data["trangThai"] = 0,
  // Kiểm tra giờ bắt đầu tới giờ kết thúc trong sân này thì có thể thuê bao nhiêu tiếng
  fetch("http://127.0.0.1:8000/api/chitietthuesan")
    .then(promise => promise.json())
    .then(CTTSs => {
      CTTSs = CTTSs.filter((CTTS)=>{
        return CTTS.maSan == data['maSan']
      })
      CTTSs.sort(function(a, b) {
          // Chuyển đổi thời gian bắt đầu của mỗi phần tử thành đối tượng Date để so sánh
          var dateA = new Date(a.thoiGianBatDau);
          var dateB = new Date(b.thoiGianBatDau);
          
          // So sánh thời gian bắt đầu của hai phần tử và trả về kết quả
          return dateA - dateB;
      });
      let distanceAllow
      for (const CTTS of CTTSs) {
        // console.log(CTTS)
        let distance = tinhKhoangCach(data["thoiGianBatDau"], CTTS.thoiGianBatDau);
        if (distance >= 0) {
          distanceAllow = distance;
          break;
        }
      }
      if(parseInt(data.borrowHour) > distanceAllow){
        toastr.options = {
            "toastClass": "toast-style", // Đặt lớp CSS cho toast
            "titleClass": "toast-title-style", // Đặt lớp CSS cho tiêu đề toast
            "messageClass": "toast-message-style" // Đặt lớp CSS cho thông báo toast
        };
        toastr.options.closeButton = true;
        toastr.warning("Quý khách chỉ có thể thuê liên tục <strong>" + distanceAllow + " tiếng</strong> vì lý do cấn lịch.");
      }
      else{
        transferDataToOtherPage(data)
      }
    })
    .catch(error => {
      toastr.error('Lỗi ràng buộc thời gian kết thúc vượt qua thời gian bắt đầu vé.')
    })
    // Truyền trên thanh url
  // function transferDataToOtherPage(data){
  //   var queryString = Object.keys(data).map(function(key) {
  //     return encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
  //   }).join('&');
  //   // console.log(queryString)
  //   window.location.href = "/thuesan?" + queryString;
  // }
  function transferDataToOtherPage(data) {
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '/sanbong';
    form.style.display = 'none';
    var csrfInput = document.createElement('input');
  csrfInput.type = 'hidden';
  csrfInput.name = '_token';  // Tên trường CSRF có thể khác nhau tùy thuộc vào framework backend bạn sử dụng
  csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  form.appendChild(csrfInput);
    for (var key in data) {
      if (data.hasOwnProperty(key)) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = data[key];
        form.appendChild(input);
      }
    }

    document.body.appendChild(form);
    form.submit();
  }
}
function formatDateToYYYYMMDD(calendar) {
    // Tách ngày, tháng và năm từ chuỗi
    const parts = calendar.split('-');

    // Lấy ra các phần tử ngày, tháng, năm
    const day = parts[0];
    const month = parts[1];
    const year = parts[2];

    // Tạo chuỗi định dạng yyyy-mm-dd
    const formattedDate = `${year}-${month}-${day}`;
    return formattedDate;
}
</script>