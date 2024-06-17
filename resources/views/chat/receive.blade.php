<div class="left message">
  @if($authCode == 1)
  <img src="assets/img/Logo-Truong-Dai-hoc-The-duc-The-thao-Da-Nang.png" alt="Profile picture">
  <p title="{{ $timestamp }}">{{"Quản trị viên: ".$message}}</p>
  @else
  <img src="assets/img/avatarmacdinh.jpg" alt="Profile picture">
  <p title="{{ $timestamp }}">{{$account.": ".$message}}</p>
  @endif
</div>