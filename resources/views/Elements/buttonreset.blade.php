<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
        .main {
        background: #f1f1f1;
        /* min-height: 100vh; */
        display: flex;
        justify-content: center;
        width: fit-content;
        }
        .form {
        width: 360px;
        /* min-height: 100px; */
        padding: 32px 24px;
        text-align: center;
        background: #fff;
        border-radius: 2px;
        margin: 24px;
        align-self: center;
        box-shadow: 0 2px 5px 0 rgba(51, 62, 73, 0.1);
        }
        .form .heading {
        font-size: 2rem;
        }
        .form .desc {
        text-align: center;
        color: #636d77;
        font-size: 1.6rem;
        font-weight: lighter;
        line-height: 2.4rem;
        margin-top: 16px;
        font-weight: 300;
        }
    
        .form-group {
        display: flex;
        margin-bottom: 16px;
        flex-direction: column;
        }
    
        .form-submit {
        outline: none;
        background-color: #1dbfaf;
        margin-top: 12px;
        padding: 12px 16px;
        font-weight: 600;
        color: #fff !important;
        border: none;
        width: 100%;
        font-size: 14px;
        border-radius: 8px;
        cursor: pointer;
        display: block;
        text-decoration: none;
        }
    
        .form-submit:hover {
        background-color: #1ac7b6;
        }
    
        .spacer {
        margin-top: 36px;
        }
    
    </style>
</head>
<body>
    <div class="main">
        <form action="" method="POST" class="form" id="form-1">
          @csrf
          <h3 class="heading">Reset passwords</h3>
          {{-- <a class="form-submit" href="{{ route('formResetPassword',['token' => $token]) }}" style="">Verification</a> --}}
          <a class="form-submit" href="{{ URL::to("/cailaimatkhau/{$token}") }}" style="">Verification</a>
          <p class="desc">This will expire in 10 minutes.</p>
        </form>
      </div>
</body>
</html>