<style>
    .main {
    background: #f1f1f1;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    }
    .form {
    width: 360px;
    min-height: 100px;
    padding: 32px 24px;
    text-align: center;
    background: #fff;
    border-radius: 2px;
    margin: 24px;
    align-self: center;
    box-shadow: 0 2px 5px 0 rgba(51, 62, 73, 0.1);
    position: relative;
    }
    .form .heading {
    font-size: 20px;
    }
    .form .desc {
    text-align: center;
    color: #636d77;
    font-size: 16px;
    font-weight: lighter;
    line-height: 24px;
    margin-top: 16px;
    font-weight: 300;
    }

    .form-group {
    display: flex;
    margin-bottom: 16px;
    flex-direction: column;
    }

    .form-label,
    .form-message {
    text-align: left;
    }

    .form-label {
    font-weight: 700;
    padding-bottom: 6px;
    line-height: 18px;
    font-size: 14px;
    }

    .form-control {
    height: 40px;
    padding: 8px 12px;
    border: 1px solid #b3b3b3;
    border-radius: 3px;
    outline: none;
    font-size: 14px;
    }

    .form-control:hover {
    border-color: var(--primary-color);
    }

    .form-input {
    display: flex;
    flex-direction: column;
    }

    .form-input__value {
    display: flex;
    }

    .form-input__value + .form-input__value {
    margin-top: 10px;
    }

    .form-group.invalid .form-control {
    border-color: #f33a58;
    }

    .form-group.invalid .form-message {
    color: #f33a58;
    }

    .form-message {
    font-size: 12px;
    line-height: 16px;
    padding: 4px 0 0;
    }

    a.form-submit {
        display: block;
    }

    .form-submit {
    outline: none;
    background-color: var(--primary-color);
    margin-top: 12px;
    padding: 12px 16px;
    font-weight: 600;
    color: #fff;
    border: none;
    width: 100%;
    font-size: 14px;
    border-radius: 8px;
    cursor: pointer;
    }

    .form-submit:hover {
    background-color: #1ac7b6;
    }

    .spacer {
    margin-top: 36px;
    }

    .form-submit-google {
        display: flex;
        border: 1px solid #737070;
        border-radius: 4px;
        align-items: center;
        justify-content: center;
        padding: 12px 16px;
        font-size: 14px; 
    }
    .form-submit-google:hover {
        border-color: black;
    }
</style>
<script>
    var selectorRules = {};
    // Xử lý báo lỗi
    function validate(rule, inputElement, formGroup, errorElement) {
    var errorMessage;
    var rules = selectorRules[rule.selector];
    for (let i = 0; i < rules.length; i++) {
        switch (inputElement.type) {
        case "checkbox":
        case "radio":
            errorMessage = rules[i](
            formGroup.querySelector(rule.selector + ":checked")
            );
            break;
        default:
            errorMessage = rules[i](inputElement.value);
        }
        if (errorMessage) break;
    }
    if (errorMessage) {
        errorElement.innerText = errorMessage;
        inputElement.focus();
        formGroup.classList.add("invalid");
    } else {
        errorElement.innerText = "";
        formGroup.classList.remove("invalid");
    }
    // Trả về true khi input có lỗi
    return errorMessage;
    }
    function Validator(option) {
    const form = document.querySelector(option.form);
    if (form) {
        // Validate all input để điều kiện thì mới cho submit
        function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
            return element.parentElement;
            }
            element = element.parentElement;
        }
        }
        // console.log(form)

        var butttonSubmit = form.querySelector(option.buttonSubmitSelector);
        butttonSubmit.onclick = (e) => {
        // Chặn lại submit mặc định trình duyệt để có thể fetch API bằng JS
        e.preventDefault();
        var isInValid = true;
        var i = 0;
        var isValid = true;
        option.rules.forEach((rule) => {
            var inputElement = form.querySelector(rule.selector);
            // console.log(rule.selector);
            var formGroup = getParent(inputElement, option.formGroupSelector);
            var errorElement = formGroup.querySelector(option.errorSelector);
            isInValid = validate(rule, inputElement, formGroup, errorElement);
            // chỉ cần có 1 lỗi là sẽ gán cho form lỗi ngay
            if (isInValid && i == 0) {
            isValid = false;
            i++;
            }
        });
        // Khi form nhập vào không có lỗi nào.
        if (isValid) {
            // Trả về dữ liêu người dùng
            if (typeof option.onSubmit === "function") {
            // var enableInputs = form.querySelectorAll("[name]");
            var enableInputs = form.querySelectorAll("[name]:not([disabled])");
            var formValues = Array.from(enableInputs).reduce((values, input) => {
                switch (input.type) {
                case "radio":
                    values[input.name] = form.querySelector(
                    'input[name="' + input.name + '"]:checked'
                    ).value;
                    break;
                case "checkbox":
                    if (!input.checked) {
                    // values[input.name] = "";
                    return values;
                    }
                    if (!Array.isArray(values[input.name])) values[input.name] = [];
                    values[input.name].push(input.value);
                    break;
                case "file":
                    values[input.name] = input.files;
                    break;
                default:
                    values[input.name] = input.value || null;
                }
                return values;
            }, {});
            option.onSubmit(formValues);
            } else {
            // Chỉ để validate bằng js và cho submit để dùng API bằng PHP
            console.log("Use PHP Auth");
            form.submit();
            }
        }
        };
        // Validate từng input (lắng nghe sự kiện blur, input, ...)
        option.rules.forEach((rule) => {
        // Lưu lại rule không để rule ghi đè nhau
        if (Array.isArray(selectorRules[rule.selector]))
            selectorRules[rule.selector].push(rule.test);
        else selectorRules[rule.selector] = [rule.test];

        var inputElements = form.querySelectorAll(rule.selector);
        Array.from(inputElements).forEach((inputElement) => {
            var formGroup = getParent(inputElement, option.formGroupSelector);
            var errorElement = formGroup.querySelector(option.errorSelector);
            //   Khi blur ra input
            inputElement.onblur = () => {
            validate(rule, inputElement, formGroup, errorElement);
            };
            //   Khi người dùng nhập vào input
            inputElement.oninput = () => {
            errorElement.innerText = "";
            formGroup.classList.remove("invalid");
            };
        });
        });
    }
    }

    // Kiểm tra giá trị
    Validator.isRequired = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
        return value ? undefined : message || "Vui lòng nhập trường này";
        },
    };
    };
    Validator.isEmail = (selector, message) => ({
    selector,
    test(value) {
        var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return regex.test(value)
        ? undefined
        : message || "Trường này phải là email";
    },
    });
    Validator.minLength = (selector, min, message) => ({
    selector,
    test(value) {
        return value.length >= min
        ? undefined
        : message || `Mật khẩu ít nhất ${min} kí tự`;
    },
    });

    Validator.isConfirm = (selector, message) => ({
    selector,
    test(value) {
        return value === document.querySelector("#password").value
        ? undefined
        : message || "Giá trị không chính xác";
    },
    });
    Validator.minMoney = (selector,min, message) => ({
    selector,
    test(value) {
        return value >= min
        ? undefined
        : message || `Quý khách vui lòng nạp tối thiểu ${formatCurrency(min)} VND`;
    },
    });
    Validator.isAllowHour = (selector,min, max, message) => ({
    selector,
    test(value) {
        return value >= min && value<=max
        ? undefined
        : message || `Quý khách nhập trong khoảng từ ${min} - ${max} giờ`;
    },
    });
    Validator.isNumber = (selector,min, max, message) => ({
    selector,
    test(value) {
        return typeof(value) === "number" 
        ? undefined
        : message || `Quý khách nhập chữ số không nhập chữ.`;
    },
    });

    Validator.mustHigherOpen = (selector, selectorMoCua, message) => ({
    selector,
    test(value) {
        return parseInt(value) > parseInt(document.querySelector(selectorMoCua).value)
        ? undefined
        : message || "Giờ đóng cửa phải lớn hơn " + document.querySelector(selectorMoCua).value +" giờ.";
    },
    });
    function formatCurrency(input) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(input);
    }

</script>
