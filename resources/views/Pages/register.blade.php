<!doctype html>
<html lang="en">
  <head>
    <style>
      * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      }
      html {
      color: #333;
      font-size: 62.5%;
      font-family: "Open Sans", sans-serif;
      }
</style>
    @include('Library.grid_system')
    @include('Library.variable')
    @include('Library.validator')
  </head>
  <body>
    <div class="main">
      <form action="" method="POST" class="form" id="form-1">
        <h3 class="heading">Thành viên đăng ký</h3>
        <p class="desc">Cùng nhau tạo nên sân chơi lành mạnh ❤️</p>

        <div class="spacer"></div>

        <div class="form-group">
          <label for="fullname" class="form-label">Tên đầy đủ</label>
          <input
            id="fullname"
            name="fullname"
            type="text"
            placeholder="VD: Sơn Đặng"
            class="form-control"
          />
          <span class="form-message"></span>
        </div>
        <div class="form-group">
          <label for="password_confirmation" class="form-label"
            >Giới tính</label
          >
          <div class="form-input">
            <div class="form-input__value">
              <input
                id="gender1"
                name="gender"
                style="margin-right: 4px"
                value="male"
                type="checkbox"
              />
              <label for="gender1" style="font-size: 1.4rem">Nam</label>
            </div>
            <div class="form-input__value">
              <input
                id="gender2"
                name="gender"
                style="margin-right: 4px"
                value="female"
                type="checkbox"
              />
              <label for="gender2" style="font-size: 1.4rem">Nữ</label>
            </div>
          </div>
          <span class="form-message"></span>
        </div>

        <div class="form-group">
          <label for="avatar" class="form-label">Ảnh đại diện</label>
          <input id="avatar" name="avatar" type="file" class="form-control" />
          <span class="form-message"></span>
        </div>

        <div class="form-group">
          <label for="email" class="form-label">Email</label>
          <input
            id="email"
            name="email"
            type="text"
            placeholder="VD: email@domain.com"
            class="form-control"
          />
          <span class="form-message"></span>
        </div>

        <div class="form-group">
          <label for="password" class="form-label">Mật khẩu</label>
          <input
            id="password"
            name="password"
            type="password"
            placeholder="Nhập mật khẩu"
            class="form-control"
          />
          <span class="form-message"></span>
        </div>

        <div class="form-group">
          <label for="password_confirmation" class="form-label"
            >Nhập lại mật khẩu</label
          >
          <input
            id="password_confirmation"
            name="password_confirmation"
            placeholder="Nhập lại mật khẩu"
            type="password"
            class="form-control"
          />
          <span class="form-message"></span>
        </div>

        <button class="form-submit">Đăng ký</button>
        <a class="form-submit" href="/dangnhap">Đăng nhập</a>
      </form>
    </div>
  </body>
  <script>
    Validator({
      form: "#form-1",
      rules: [
        Validator.isRequired("#fullname"),
        Validator.isRequired("#email"),
        Validator.isEmail("#email"),
        Validator.isRequired("#password"),
        Validator.isRequired('input[name="gender"]', "Vui lòng chọn giới tính"),
        Validator.isRequired("#avatar", "Vui lòng chọn ảnh đại diện"),
        Validator.minLength("#password", 1),
        Validator.isRequired("#password_confirmation"),
        Validator.isConfirm(
          "#password_confirmation",
          "Mật khẩu không trùng khớp"
        ),
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
</html>