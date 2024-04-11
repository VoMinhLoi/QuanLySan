<!doctype html>
<html lang="en">
  <head>
    @include('Components.grid_system')
    @include('Components.variable')
    @include('Components.validator')
  </head>
  <body>
    <div class="main">
      <form action="" method="POST" class="form" id="form-1">
        <h3 class="heading">Thành viên đăng ký</h3>
        <p class="desc">Cùng nhau tạo nên sân chơi lành mạnh ❤️</p>

        <div class="spacer"></div>
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
        <button class="form-submit">Đăng nhập</button>
        <a class="form-submit" href="/dangky">Đăng ký</a>
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