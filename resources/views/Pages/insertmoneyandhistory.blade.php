<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="./assets/img/vnpay.png" type="image/icon type">
<title>Thông báo nạp tiền thành công</title>
<link rel="stylesheet" href="styles.css">
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        }

        .notification {
            background: white;
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .notification-content {
        text-align: center;
        }

        .notification-content h2 {
        margin-top: 0;
        color: #333;
        }

        .notification-content p {
        margin-bottom: 10px;
        color: #555;
        }
</style>
</head>
<body>
<div class="notification">
  <div class="notification-content">
    @php
        $exist = App\Models\LichSuGiaoDich::where('transID', $_GET['vnp_TransactionNo'])->first();
        if(empty($exist)){
          if(isset($_GET['vnp_Amount'])){
            $soTienCanNap = $_GET['vnp_Amount']/100;
            $maNguoiDung = Auth::user()->maNguoiDung;
            $user = App\Models\User::where('maNguoiDung', $maNguoiDung)->first();
            // Cập nhật trường 'soDuTaiKhoan' của user
            $user->soDuTaiKhoan += $soTienCanNap;
            // Lưu thay đổi vào cơ sở dữ liệu
            $user->save();

            $lsgd['maNguoiDung'] = $maNguoiDung;
            $lsgd['ndck'] = "Nạp tiền qua ví điện tử VNPay bằng tài khoản ngân hàng NCB";
            $lsgd['transID'] = $_GET['vnp_TransactionNo'];
            $lsgd['soTien'] = $soTienCanNap;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $lsgd['thoiGian'] = date('Y-m-d H:i:s');
            $lsgd['trangThai'] = 1;
            $lsgd['loaiGD'] = 1;
            App\Models\LichSuGiaoDich::create($lsgd);
            session()->flash('json_message', 'Tiền đã được tính vào số dư tài khoản');
          }
          echo  '   <h2>Thông báo</h2>
                    <p>Nạp tiền thành công!</p>
                    <img src="assets/img/iconCheck.jpg" alt="success" width="50px" height="50px">
                    <p>Kính mời quý khách quay lại trang ban đầu.</p>
                ';
        }
        else {
          echo  '   <h2>Thông báo</h2>
                    <p>Tiền của quý khách đã vào tài khoản, vui lòng kiểm tra lại ví. Nếu có sai sót xin liên hệ kỹ thuật: 0899378634!</p>
                ';
        }
    @endphp

  </div>
</div>
</body>
<script>
    setTimeout(() => {
      window.location.href = '/naptien'
    }, 5000);
</script>
</html>
