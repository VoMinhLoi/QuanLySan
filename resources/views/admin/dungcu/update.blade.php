@include('Library.variable')
@include('Library.validator')
<style>
    .over-lay {
        width: 100%;
        display: flex;
        justify-content: center;
    }
    #form-update-pitch label {
        margin-bottom: 0px;
    }
    form#form-update-pitch {
        position: fixed;
        top: 58px;
        width: 50%;
        padding: 0px;
        margin: 0px;
        height: fit-content;
        border: 1px solid black;
        padding: 0 12px 12px;
        border-radius: 4px; 
    }
    #form-update-pitch .form-group {
        margin-bottom: 0px;
    }
    /* #form-update-pitch .form-group:nth-child(1) {
        margin-top: 24px;
    } */
    #form-update-pitch .close-form {
        position: absolute;
        right: 12px;
        top: 4px;
        cursor: pointer;
    }
    #form-update-pitch .close-form:hover {
        color: red;
    }   
</style>
<form id="form-update-pitch" style="background: white; ">
    <div class="close-form" onclick="document.querySelector('.over-lay').classList.add('display-none')"><i class="fas fa-times"></i></div>
    <div class="form-group">
        <label for="tenDungCu2">Tên dụng cụ</label>
        <input name="tenDungCu2" type="text" class="form-control" id="tenDungCu2">
        <span class="form-message"></span>
    </div>
    <div class="form-group">
        <label for="soLuongCon2">Số lượng còn</label>
        <input name="soLuongCon2" type="number" class="form-control" id="soLuongCon2">
        <span class="form-message"></span>
    </div>
    <div class="form-group">
        <label for="moTa2">Mô tả</label>
        <input name="moTa2" type="text" class="form-control" id="moTa2" >
        <span class="form-message"></span>
    </div>
    <div class="form-group">
        <label for="donGiaGoc2">Giá gốc</label>
        <input name="donGiaGoc2" type="number" class="form-control" id="donGiaGoc2" >
        <span class="form-message"></span>
    </div>
    <div class="form-group">
        <label for="donGiaThue2">Giá cho thuê</label>
        <input name="donGiaThue2" type="number" class="form-control" id="donGiaThue2" >
        <span class="form-message"></span>
    </div>
    {{-- <div class="form-group">
        <label for="loaiSan2">Loại sân</label>
        <select name="loaiSan2" id="loaiSan2" class="form-control">
            @php
                $loaiSans = App\Models\SanBong::all()->pluck('loaiSan')->unique();
                foreach($loaiSans as $item)
                    echo ' <option value="'.$item.'">'.$item.'</option>';
            @endphp
        </select>
        <span class="form-message"></span>
    </div> --}}
    <div class="form-group">
        <label for="trangThai2">Trạng thái</label>
        <select name="trangThai2" id="trangThai2" class="form-control">
            <option value="1">Bình thường</option>
            <option value="0">Ngưng</option>
        </select>
        <span class="form-message"></span>
    </div>
    <!-- /.card-body -->

    <button type="submit" class="btn btn-primary form-submit" style="color: ">Cập nhật</button>
</form>
<script>

    function handleUpdatedPitch(sanBong){
        if(isJSON(sanBong))
            sanBong = JSON.parse(sanBong)
            document.querySelector('.over-lay').classList.remove('display-none')
            var form = document.querySelector('#form-update-pitch')
            let tenCoSoInputView = document.querySelector('#form-update-pitch #tenDungCu2')
            tenCoSoInputView.value = sanBong['tenDungCu']
            let viTriInputView = document.querySelector('#form-update-pitch #soLuongCon2')
            viTriInputView.value = sanBong['soLuongCon']
            let moTaInputView = document.querySelector('#form-update-pitch #moTa2')
            moTaInputView.value = sanBong['moTa']
            let loaiSanInputView = document.querySelector('#form-update-pitch #donGiaGoc2')
            loaiSanInputView.value = sanBong['donGiaGoc']
            let giaDichVuInputView = document.querySelector('#form-update-pitch #donGiaThue2')
            giaDichVuInputView.value = sanBong['donGiaThue']
            let trangThaiInputView = document.querySelector('#form-update-pitch #trangThai2')
            trangThaiInputView.value = sanBong['trangThai']
            Validator({
                form: "#form-update-pitch",
                rules: [
                    Validator.isRequired("#tenDungCu2"),
                    Validator.isRequired("#soLuongCon2"),
                    Validator.isRequired("#moTa2"),
                    Validator.isRequired("#donGiaGoc2"),
                    Validator.isRequired("#donGiaThue2")
                ],
                errorSelector: ".form-message",
                buttonSubmitSelector: ".form-submit",
                // Muốn submit không theo API mặc định của trình duyệt
                onSubmit: function (dataValid) {
                    // Tạo ra credentials để update do trong cơ sở đâu có thêm số 2 sau cột
                    let credentials ={}
                    credentials['tenDungCu'] = dataValid.tenDungCu2;
                    credentials['soLuongCon'] = dataValid.soLuongCon2;
                    credentials['moTa'] = dataValid.moTa2;
                    credentials['donGiaGoc'] = dataValid.donGiaGoc2;
                    credentials['donGiaThue'] = dataValid.donGiaThue2;
                    credentials['trangThai'] = dataValid.trangThai2;
                    // console.log(credentials)
                    fetch("http://127.0.0.1:8000/api/dungcu/"+sanBong.maDungCu, {
                        method: "PUT",
                        headers: {
                            // "Content-Type": "application/x-www-form-urlencoded", x-www-form-urlencoded: form data
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        // body: JSON.stringify(data),
                        body: JSON.stringify(credentials),
                    })
                    .then(response => {
                        return response.json(); // Chuyển đổi phản hồi sang JSON
                    })
                    .then(data => {
                        if(data.error)
                            toastr.error(data.error)
                        else{
                            toastr.success(data.success)
                            document.querySelector('.over-lay').classList.add('display-none')
                            renderRow(data.newsIsUpdated)
                        }// Dữ liệu JSON trả về từ function store
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                },
                formGroupSelector: ".form-group",
            });
    }
    function isJSON(str) {
        try {
            JSON.parse(str);
            return true;
        } catch (e) {
            return false;
        }
    }
</script>
