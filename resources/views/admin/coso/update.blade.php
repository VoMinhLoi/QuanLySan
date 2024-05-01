@include('Library.variable')
@include('Library.validator')
<style>
    .over-lay {
        width: 100%;
        display: flex;
        justify-content: center;
    }
    #form-update-coso label {
        margin-bottom: 0px;
    }
    form#form-update-coso {
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
    #form-update-coso .form-group {
        margin-bottom: 0px;
    }
    /* #form-update-coso .form-group:nth-child(1) {
        margin-top: 24px;
    } */
    #form-update-coso .close-form {
        position: absolute;
        right: 12px;
        top: 4px;
        cursor: pointer;
    }
    #form-update-coso .close-form:hover {
        color: red;
    }   
</style>
<form id="form-update-coso" style="background: white; ">
    <div class="close-form" onclick="document.querySelector('.over-lay').classList.add('display-none')"><i class="fas fa-times"></i></div>
    <div class="form-group">
        <label for="tenCoSo2">Tên cơ sở</label>
        <input name="tenCoSo2" type="text" class="form-control" id="tenCoSo2">
        <span class="form-message"></span>
    </div>
    <div class="form-group">
        <label for="moTa2">Mô tả</label>
        <input name="moTa2" type="text" class="form-control" id="moTa2" >
        <span class="form-message"></span>
    </div>
    <div class="form-group">
        <label for="diaChi2">Địa chỉ</label>
        <input name="diaChi2" type="text" class="form-control" id="diaChi2" >
        <span class="form-message"></span>
    </div>
    <div class="form-group">
        <label for="thoiGianMoCua2">Thời gian mở cửa</label>
        <input name="thoiGianMoCua2" type="number" class="form-control" id="thoiGianMoCua2" placeholder="1-23">
        <span class="form-message"></span>
    </div>
    <div class="form-group">
        <label for="thoiGianDongCua2">Thời gian đóng cửa</label>
        <input name="thoiGianDongCua2" type="number" class="form-control" id="thoiGianDongCua2" placeholder="2-25">
        <span class="form-message"></span>
    </div>
    <!-- /.card-body -->

    <button type="submit" class="btn btn-primary form-submit" style="color: ">Cập nhật</button>
</form>
<script>

    function handleUpdatedCoSo(coSo){
        if(isJSON(coSo))
            coSo = JSON.parse(coSo)
            document.querySelector('.over-lay').classList.remove('display-none')
            var form = document.querySelector('#form-update-coso')
            let tenCoSoInputView = document.querySelector('#form-update-coso #tenCoSo2')
            tenCoSoInputView.value = coSo.tenCoSo
            let moTaInputView = document.querySelector('#form-update-coso #moTa2')
            moTaInputView.value = coSo['moTa']
            let diaChiInputView = document.querySelector('#form-update-coso #diaChi2')
            diaChiInputView.value = coSo['diaChi']
            // let maPXInputView = document.querySelector('#form-update-coso #maPX2')
            // console.log(maPXInputView)
            let thoiGianMoCuaInputView = document.querySelector('#form-update-coso #thoiGianMoCua2')
            thoiGianMoCuaInputView.value = coSo['thoiGianMoCua']
            let thoiGianDongCuaInputView = document.querySelector('#form-update-coso #thoiGianDongCua2')
            thoiGianDongCuaInputView.value = coSo['thoiGianDongCua']
            Validator({
                form: "#form-update-coso",
                rules: [
                    Validator.isRequired("#tenCoSo2"),
                    Validator.isRequired("#moTa2"),
                    Validator.isRequired("#diaChi2"),
                    Validator.isRequired("#thoiGianMoCua2"),
                    Validator.isAllowHour("#thoiGianMoCua2",1,23),
                    Validator.isRequired("#thoiGianDongCua2"),
                    Validator.isAllowHour("#thoiGianDongCua2",2,25),
                    Validator.mustHigherOpen("#thoiGianDongCua2","#thoiGianMoCua2"),
                ],
                errorSelector: ".form-message",
                buttonSubmitSelector: ".form-submit",
                // Muốn submit không theo API mặc định của trình duyệt
                onSubmit: function (dataValid) {
                    let credentials ={}
                    credentials['tenCoSo'] = dataValid.tenCoSo2;
                    credentials['diaChi'] = dataValid.diaChi2;
                    credentials['moTa'] = dataValid.moTa2;
                    // credentials['maPX'] = dataValid.maPX2;
                    credentials['thoiGianMoCua'] = dataValid.thoiGianMoCua2;
                    credentials['thoiGianDongCua'] = dataValid.thoiGianDongCua2;
                    fetch("http://127.0.0.1:8000/api/coso/"+coSo.maCoSo, {
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
                            credentials['maCoSo'] = coSo.maCoSo
                            credentials['maPX'] = coSo.maPX
                            document.querySelector('.over-lay').classList.add('display-none')
                            renderRow(credentials)
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
