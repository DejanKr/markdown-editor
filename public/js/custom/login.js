$(function ($, undefined) {

    var loginRegister = $('div.login-register-page');
    if (loginRegister.length > 0) {
        var loginForm = $('#login-form');
        var registerForm = $('#register-form');

        $(loginRegister).on('click', '#register-form-link', function (e) {
            e.preventDefault();
            registerForm.delay(100).fadeIn(100);
            loginForm.fadeOut(100);
            $(this).addClass('active');
            $('#login-form-link').removeClass('active');

        });
        $(loginRegister).on('click', '#login-form-link', function (e) {
            e.preventDefault();
            loginForm.delay(100).fadeIn(100);
            registerForm.fadeOut(100);
            $(this).addClass('active');
            $('#register-form-link').removeClass('active');

        });


        $(registerForm).on('submit', function (e) {
            e.preventDefault();
            var form = $(this);
            var data = getFormData(form);


            switch (InputCheck(data)) {
                case 1:
                {
                    $.MessageBox('All of fields must be fill!');
                    break;
                }
                case 2:
                {
                    $.MessageBox('Password and confirm-password not match!');
                    break;
                }
                case 3:
                {
                    var params = {
                        'username' : data['username'],
                        'password' : data['password'],
                        'email' : data['email'],
                        'register-submit':'ok'

                    };

                    var url = "index.php/?c=registration&a=register_member";
                    $.post(url, params).done(function(dataBack) {
                        if(dataBack.exist)
                        {
                            $.MessageBox('Successful registration!');
                            window.location.reload();
                        }
                        else
                        {
                            $.MessageBox('Member exist!');
                        }
                        }

                    )
                    
                    //$.MessageBox('Successful registration!');
                    break;

                }
            }

            //console.log(data['username']);


        });
        function getFormData(form) {
            var serializedArray = form.serializeArray();

            var returnData = {};
            $.each(serializedArray, function () {
                var item = $(this)[0];
                returnData[item.name] = item.value;

            });
            return returnData;
        }

        function InputCheck(data) {
            if (data['username'].length == 0 || data['password'].length == 0 || data['email'].length == 0 || data['confirm-password'].length == 0) {
                return 1;
            }
            else if (data['password'] != data['confirm-password']) {

                return 2;
            }
            else {
                return 3;

            }


        }


    }


});