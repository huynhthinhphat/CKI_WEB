document.addEventListener('DOMContentLoaded', function () {
    var btn_login = document.getElementById('btn_login');
    var btn_reg = document.getElementById('btn_reg');

    var form_login = document.getElementById('form_login');
    var form_reg = document.getElementById('form_reg');

    var inputs = document.querySelectorAll('#form_login input, #form_reg input');
    var labels = document.querySelectorAll('#form_login label, #form_reg label');
    var buttons = document.querySelectorAll('button');

    //Click vào đăng ký
    btn_reg.addEventListener('click', function () {
        form_login.classList.add('change_pos');
        form_reg.classList.add('change_pos');
    })

    //Click vào đăng nhập
    btn_login.addEventListener('click', function () {
        form_login.classList.remove('change_pos');
        form_reg.classList.remove('change_pos');
    })


    //add class cho input && label
    function addClassIL() {
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener('click', function () {
                if (this.id) {
                    var buttonID = this.id;

                    if (buttonID) {
                        this.style.display = 'none';

                        for (var j = 0; j < buttons.length; j++) {
                            if (buttons[j].classList.contains(buttonID)) {
                                buttons[j].style.display = 'block';
                            }
                        }
                        var buttonIndex = -1;
                        for (var j = 0; j < buttons.length; j++) {
                            if (buttons[j].id === buttonID) {
                                buttonIndex = j;
                                for (var k = 0; k < inputs.length; k++) {
                                    if (j == 0) {
                                        inputs[1].type = 'text';
                                    } else if (j == 4) {
                                        inputs[3].type = 'text';
                                    } else if (j == 6) {
                                        inputs[4].type = 'text';
                                    }
                                }
                            }
                        }
                    }
                } else {
                    var buttonClass = this.className;

                    if (buttonClass) {
                        this.style.display = 'none';

                        for (var j = 0; j < buttons.length; j++) {
                            if (buttons[j].id == this.className) {
                                buttons[j].style.display = 'block';
                            }
                        }
                    }

                    var buttonIndex = -1;
                    for (var j = 0; j < buttons.length; j++) {
                        if (buttons[j].className === buttonClass) {
                            buttonIndex = j;
                            for (var k = 0; k < inputs.length; k++) {
                                if (j == 1) {
                                    inputs[1].type = 'password';
                                } else if (j == 5) {
                                    inputs[3].type = 'password';
                                } else if (j == 7) {
                                    inputs[4].type = 'password';
                                }
                            }
                        }
                    }
                }
            });
        }
    }

    addClassIL();


    // Xử lý sự kiện focus và blur cho từng input
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('focus', function () {
            var currentInput = this;

            currentInput.classList.add('focus');

            for (var j = 0; j < labels.length; j++) {
                if (labels[j].getAttribute('for') === currentInput.id) {
                    labels[j].classList.add('change');
                }
            }
        });

        inputs[i].addEventListener('blur', function () {
            var currentInput = this;

            if (!currentInput.value.trim()) {
                currentInput.classList.remove('focus');

                for (var j = 0; j < labels.length; j++) {
                    if (labels[j].getAttribute('for') === currentInput.id) {
                        labels[j].classList.remove('change');
                    }
                }
            }
        });
    }

    //form
    var form_login = document.getElementById('login');
    var form_reg = document.getElementById('reg');

    form_login.addEventListener('submit', function (e) {
        e.preventDefault();

        if (!inputs[0].value || !inputs[1].value) {
            $("#tbao_login").html("Thiếu tài khoản hoặc mật khẩu");
        }

        $.ajax({
            url: 'api.php?action=login',
            method: 'post',
            data: { inputAcc: inputs[0].value, inputPas: inputs[1].value },
            success: function (res) {
                if (res == "Không") {
                    $("#tbao_login").html("Tài khoản hoặc mật khẩu sai");
                }else{
                    window.location.href = '../html/trangchu.php'
                }
            }
        })
    })

})
