<div class="right message">
  {{-- @if($authCode == 1)
    <p title="{{ $timestamp }}">{{"Quản trị viên: ".$message}}</p>
    <img src="assets/img/Logo-Truong-Dai-hoc-The-duc-The-thao-Da-Nang.png" alt="Profile picture">
  @else
    <p title="{{ $timestamp }}">{{$account.": ".$message}}</p>
    <img src="assets/img/avatarmacdinh.jpg" alt="Profile picture">
  @endif --}}
  <p title="{{ $timestamp }}">{{$message}}</p>
</div>