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
      <form action="{{ route('user.forgot') }}" method="POST" class="form" id="form-1">
        @csrf
        <h3 class="heading">Quên mật khẩu</h3>
        <p class="desc">Cùng nhau tạo nên sân chơi lành mạnh ❤️</p>

        <div class="spacer"></div>
        <div class="form-group">
          <label for="email" class="form-label">Email</label>
          <input
            id="email"
            name="taiKhoan"
            type="text"
            placeholder="Email đã đăng ký"
            class="form-control"
          />
          <span class="form-message"></span>
        </div>
        <button class="form-submit">Gửi</button>
      </form>
    </div>
    <script>
      Validator({
        form: "#form-1",
        rules: [
          Validator.isRequired("#email"),
          Validator.isEmail("#email"),
        ],
        errorSelector: ".form-message",
        buttonSubmitSelector: ".form-submit",
        // Muốn submit không theo API mặc định của trình duyệt
        // onSubmit: function (data) {
        //   // fetch API
        //   console.log(data);
        // },
        formGroupSelector: ".form-group",
      });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if ($errors->any())
      @foreach ($errors->all() as $error)
          <script>toastr.error("{{ $error }}")</script>
      @endforeach      
    @else
        @if (session('json_message'))
            <script>toastr.success("{{ session('json_message') }}")</script>
        @endif
    @endif
  </body>
</html>