function Validator(options) {
    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

    var selectorRules = {};

    // Hàm thực hiện validate
    function validate(inputElement, rule) {
        var errorElement = getParent(inputElement, options.formParent).querySelector(options.errorSelector);
        var errorMessage;

        // lay ra cai rules cua selector
        var rules = selectorRules[rule.selector];

        // Lap qua tung rules va kiem tra
        // Neu co loi thi dung viec kiem tra
        for (var i = 0; i < rules.length; i++) {
            errorMessage = rules[i](inputElement.value);
            if (errorMessage) break;
        }

        if (errorMessage) {
            errorElement.innerText = errorMessage;
            getParent(inputElement, options.formParent).classList.add('invalid');
        } else {
            errorElement.innerText = '';
            getParent(inputElement, options.formParent).classList.remove('invalid');
        }

        return !errorMessage;
    }

    // Lấy Element của form cần validate
    var formElement = document.querySelector(options.form);

    if (formElement) {
        // Khi submit form
        formElement.addEventListener('submit', function (e) {
            var isFormValid = true;

            // Lap qua tung rule validate
            options.rules.forEach(function (rule) {
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = validate(inputElement, rule);
                if (!isValid) {
                    isFormValid = false;
                }
            });

            if (isFormValid) {
                formElement.submit();
            } else {
                e.preventDefault();
            }
        });

        // Lap qua moi rule va xu ly (lang nghe su kien blur, input,...)
        options.rules.forEach(function (rule) {
            // luu lai cai rules cho moi input
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else {
                selectorRules[rule.selector] = [rule.test];
            }

            var inputElement = formElement.querySelector(rule.selector);

            if (inputElement) {
                // Xử lý trường hợp blur khỏi input
                inputElement.addEventListener('blur', function () {
                    validate(inputElement, rule);
                });

                // Xử lý mỗi khi người dùng nhập vào input
                inputElement.addEventListener('input', function () {
                    var errorElement = getParent(inputElement, options.formParent).querySelector(options.errorSelector);
                    errorElement.innerText = '';
                    getParent(inputElement, options.formParent).classList.remove('invalid');
                });
            }
        });
    }
}

// Định nghĩa rules
Validator.isRequired = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.trim() ? undefined : message || 'Vui lòng nhập trường này';
        },
    };
};

Validator.isUsername = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var usernameRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/;
            return usernameRegex.test(value) ? undefined : message || 'Vui lòng nhập trường này';
        },
    };
};

Validator.isEmail = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : message || 'Trường này phải là email';
        },
    };
};

Validator.minLength = function (selector, min, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.length >= min ? undefined : message || `Vui lòng nhập tối thiểu ${min} kí tự`;
        },
    };
};

Validator.isConfirmed = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            return value === getConfirmValue() ? undefined : message || 'Giá trị nhập vào không chính xác';
        },
    };
};
