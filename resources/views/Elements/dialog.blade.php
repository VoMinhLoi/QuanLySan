@include('Library.validator')
<style>
    .main {
        position: absolute;
        top:0;
        right: 0;
        bottom: 0;
        left: 0;
        height: 100vh;
        background: transparent;
    }
    .form-control {
        font-size: 1.0rem;
    }
</style>
<div class="main" >
    <form action="" method="POST" class="form" id="form-calendar" >
        {{-- <h3 class="heading">Thành viên đăng ký</h3> --}}
        <p class="desc">Chọn lịch trình phù hợp❤️</p>
    
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
                <label for="thu2" style="font-size: 1.2rem">Thứ 2</label>
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
                <label for="thu3" style="font-size: 1.2rem">Thứ 3</label>
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
                <label for="thu4" style="font-size: 1.2rem">Thứ 4</label>
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
                <label for="thu5" style="font-size: 1.2rem">Thứ 5</label>
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
                <label for="thu6" style="font-size: 1.2rem">Thứ 6</label>
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
                <label for="thu7" style="font-size: 1.2rem">Thứ 7</label>
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
                <label for="thu8" style="font-size: 1.2rem">Chủ nhật</label>
              </div>
            </div>
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Chọn chu kỳ</label>
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
        <button class="form-submit">Đóng</button>
      </form>
</div>
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
        // fetch API
        console.log(data);
        },
        formGroupSelector: ".form-group",
    });
</script>