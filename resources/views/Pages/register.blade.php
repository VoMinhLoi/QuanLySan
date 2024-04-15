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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>
  <body>
    <div class="main">
      <form action="" method="POST" class="form" id="form-1">
        <h3 class="heading">Thành viên đăng ký</h3>
        <p class="desc">Cùng nhau tạo nên sân chơi lành mạnh ❤️</p>

        <div class="spacer"></div>

        <div class="form-group">
          <label for="surname" class="form-label">Họ</label>
          <input
            id="surname"
            name="surname"
            type="text"
            placeholder="VD: Sơn Đặng"
            class="form-control"
          />
          <span class="form-message"></span>
        </div>
        <div class="form-group">
          <label for="name" class="form-label">Tên</label>
          <input
            id="name"
            name="name"
            type="text"
            placeholder="VD: Sơn Đặng"
            class="form-control"
          />
          <span class="form-message"></span>
        </div>
        {{-- <div class="form-group">
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
        </div> --}}

        {{-- <div class="form-group">
          <label for="avatar" class="form-label">Ảnh đại diện</label>
          <input id="avatar" name="avatar" type="file" class="form-control" />
          <span class="form-message"></span>
        </div> --}}

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
        {{-- <div class="form-group">
          <label for="password_confirmation" class="form-label">Nhập lại khẩu</label>
          <input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            placeholder="Nhập lại mật khẩu"
            class="form-control"
          />
          <span class="form-message"></span>
        </div> --}}
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
    <script>
      Validator({
        form: "#form-1",
        rules: [
          Validator.isRequired("#surname"),
          Validator.isRequired("#name"),
          Validator.isRequired("#email"),
          Validator.isEmail("#email"),
          Validator.isRequired("#password"),
          Validator.minLength("#password", 7),
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
          var urlApiUser = 'http://127.0.0.1:8000/api/user'
          var formData = new URLSearchParams();
          formData.append('surname', data.surname);
          formData.append('name', data.name);
          formData.append('email', data.email);
          formData.append('password', data.password);
          fetch(urlApiUser, {
              method: "POST",
              headers: {
                  "Content-Type": "application/x-www-form-urlencoded",
              },
              // body: JSON.stringify(data),
              body: formData,
          })
          .then(response => {
              return response.json(); // Chuyển đổi phản hồi sang JSON
          })
          .then(data => {
              if(data.error)
                toastr.error(data.error)
              else{
                window.location.href = "/dangnhap"; 
              }// Dữ liệu JSON trả về từ function store
          })
          .catch(error => {
              console.error('Error:', error);
          });
  
        },
        formGroupSelector: ".form-group",
      });
    </script>
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>