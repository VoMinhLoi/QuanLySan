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
        <a class="form-submit-google" href="/auth/google">
          <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 326667 333333" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"><path d="M326667 170370c0-13704-1112-23704-3518-34074H166667v61851h91851c-1851 15371-11851 38519-34074 54074l-311 2071 49476 38329 3428 342c31481-29074 49630-71852 49630-122593m0 0z" fill="#4285f4"/><path d="M166667 333333c44999 0 82776-14815 110370-40370l-52593-40742c-14074 9815-32963 16667-57777 16667-44074 0-81481-29073-94816-69258l-1954 166-51447 39815-673 1870c27407 54444 83704 91852 148890 91852z" fill="#34a853"/><path d="M71851 199630c-3518-10370-5555-21482-5555-32963 0-11482 2036-22593 5370-32963l-93-2209-52091-40455-1704 811C6482 114444 1 139814 1 166666s6482 52221 17777 74814l54074-41851m0 0z" fill="#fbbc04"/><path d="M166667 64444c31296 0 52406 13519 64444 24816l47037-45926C249260 16482 211666 1 166667 1 101481 1 45185 37408 17777 91852l53889 41853c13520-40185 50927-69260 95001-69260m0 0z" fill="#ea4335"/></svg>
          <span style="margin-left: 8px">Đăng nhập với Google</span>
        </a>
        <p style="margin-top: 8px" >Hoặc</p>
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