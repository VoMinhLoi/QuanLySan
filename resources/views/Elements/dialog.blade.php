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
</style>
    <form action="" method="POST" class="form" id="form-calendar" >
        {{-- <h3 class="heading">Thành viên đăng ký</h3> --}}
        <p class="desc" style="font-size: 14px;">Chọn lịch trình phù hợp❤️</p>
    
        <div class="spacer"></div>
        <div class="form-group">
            <label for="password_confirmation" class="form-label" 
              >Chọn ngày</label
            >
            <div class="form-input">
              <div class="form-input__value">
                <input
                  id="thu2"
                  class="thu"
                  name="thu"
                  style="margin-right: 4px"
                  value="2"
                  type="checkbox"
                />
                <label for="thu2" style="font-size: 12px">Thứ 2</label>
              </div>
              <div class="form-input__value">
                <input
                  id="thu3"
                  class="thu"
                  name="thu"
                  style="margin-right: 4px"
                  value="3"
                  type="checkbox"
                />
                <label for="thu3" style="font-size: 12px">Thứ 3</label>
              </div>
              <div class="form-input__value">
                <input
                  id="thu4"
                  class="thu"
                  name="thu"
                  style="margin-right: 4px"
                  value="4"
                  type="checkbox"
                />
                <label for="thu4" style="font-size: 12px">Thứ 4</label>
              </div>
              <div class="form-input__value">
                <input
                  id="thu5"
                  class="thu"
                  name="thu"
                  style="margin-right: 4px"
                  value="5"
                  type="checkbox"
                />
                <label for="thu5" style="font-size: 12px">Thứ 5</label>
              </div>
              <div class="form-input__value">
                <input
                  id="thu6"
                  class="thu"
                  name="thu"
                  style="margin-right: 4px"
                  value="6"
                  type="checkbox"
                />
                <label for="thu6" style="font-size: 12px">Thứ 6</label>
              </div>
              <div class="form-input__value">
                <input
                  id="thu7"
                  class="thu"
                  name="thu"
                  style="margin-right: 4px"
                  value="7"
                  type="checkbox"
                />
                <label for="thu7" style="font-size: 12px">Thứ 7</label>
              </div>
              <div class="form-input__value">
                <input
                  id="thu8"
                  class="thu"
                  name="thu"
                  style="margin-right: 4px"
                  value="8"
                  type="checkbox"
                />
                <label for="thu8" style="font-size: 12px">Chủ nhật</label>
              </div>
            </div>
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <label for="email" class="form-label" style="font-size: 14px;">Chọn chu kỳ</label>
            <select name="ngay" id="ngay" class="form-control">
                <option value="" >-- Chu kỳ --</option>
                <option value="7" > 7 ngày </option>
                <option value="14" > 14 ngày </option>
                <option value="21" > 21 ngày </option>
                <option value="28" > 28 ngày </option>
            </select>
            <span class="form-message"></span>
          </div>
        <button class="form-submit">Lưu</button>
        <div class="form-close" onclick="showImproveDialog(this)">
          <i class="fa-solid fa-xmark"></i>
        </div>
      </form>
<script>
    Validator({
        form: "#form-calendar",
        rules: [
        Validator.isRequired(".thu", "Vui lòng chọn ngày"),
        Validator.isRequired("#ngay", "Vui lòng chọn chu kỳ"),
        ],
        errorSelector: ".form-message",
        buttonSubmitSelector: ".form-submit",
        // Muốn submit không theo API mặc định của trình duyệt
        onSubmit: function (data) {
          if (parseInt("{{ Auth::check() }}")) {
            data["maNguoiDung"] = "{{ Auth::user()->maNguoiDung }}",
            data["maSan"] = $('.overlay')[0].dataset.key,
            data["soLuong"] = 1,
            data["thoiGianBatDau"] = getTimeStart().toString(),
            data["thoiGianKetThuc"] = getTimeEnd().toString(),
            data["trangThai"] = 0,
            data["thu"] = data.thu.toString()
            console.log(data);
            var apiThueSan = "http://127.0.0.1:8000/api/thuesan"
            fetch(apiThueSan,{
                method: 'POST', // hoặc 'POST' tùy thuộc vào yêu cầu của bạn
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if(data.error)
                    toastr.error(data.error)
                else
                    toastr.success(data.success)
            })
          }
        },
        formGroupSelector: ".form-group",
    });
</script>