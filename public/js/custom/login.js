{
    $(function ($, undefined) {

        var loginRegister = $('div.login-register-page');


        if (loginRegister.length > 0) {
            var loginForm = $('#login-form');
            var registerForm = $('#register-form');
            var forgotForm = $('#forgot-form');


            $(loginRegister).on('click', '#register-form-link', function (e) {
                e.preventDefault();

                if (loginForm.is(':visible')) {
                    registerForm.delay(100).fadeIn(100);
                    loginForm.fadeOut(100);
                    $(this).addClass('active');
                    $('#login-form-link').removeClass('active');

                }
                else if (forgotForm.is(':visible')) {
                    registerForm.delay(100).fadeIn(100);
                    forgotForm.fadeOut(100);
                    $(this).addClass('active');
                    $('#forgot-form-link').removeClass('active');

                }


            });
            $(loginRegister).on('click', '#login-form-link', function (e) {
                e.preventDefault();

                if (registerForm.is(':visible')) {
                    loginForm.delay(100).fadeIn(100);
                    registerForm.fadeOut(100);
                    $(this).addClass('active');
                    $('#register-form-link').removeClass('active');
                }
                else if (forgotForm.is(':visible')) {
                    loginForm.delay(100).fadeIn(100);
                    forgotForm.fadeOut(100);
                    $(this).addClass('active');
                    $('#forgot-form-link').removeClass('active');
                }

            });

            $(loginRegister).on('click', '#forgot-form-link', function (e) {
                e.preventDefault();

                if (loginForm.is(':visible')) {
                    forgotForm.delay(100).fadeIn(100);
                    loginForm.fadeOut(100);
                    $(this).addClass('active');
                    $('#login-form-link').removeClass('active');

                }
                else if (registerForm.is(':visible')) {
                    forgotForm.delay(100).fadeIn(100);
                    registerForm.fadeOut(100);
                    $(this).addClass('active');
                    $('#register-form-link').removeClass('active');

                }
                
            });
            $(forgotForm).on('submit', function (e) {
                e.preventDefault();

                var user = forgotForm.find('input[name=username]').val();
                var mail = forgotForm.find('input[name=email]').val();

                if (user.length > 0 && mail.length > 0) {
                    var data = {
                        'username': user,
                        'email': mail,
                        'reset': 'ok'
                    };

                    var url = "index.php";
                    $.post(url, data).done(function (dataBack) {

                        if (dataBack.check) {
                            $.MessageBox("The mail has been sent!");
                        }
                        else {
                            $.MessageBox('Wrong username or mail.');
                        }

                    });

                }
                else {
                    $.MessageBox('All of field must be fill!');

                }
            });

            $(loginForm).on('submit', function (e) {
                e.preventDefault();
                var form = $(this);
                var data = {
                    'username': form.find('input[name=username]').val(),
                    'password': form.find('input[name=password]').val(),
                    'login-submit': 'Log in'

                };

                $.post('index.php', data).done(function (dataBack) {

                    switch (dataBack.Activation) {
                        case 1:
                        {
                            location.reload();
                            break;
                        }
                        case 2:
                        {
                            $.MessageBox('You must confirm your account!');
                            break;
                        }
                        case 3:
                        {
                            $.MessageBox('Wrong username or password!');
                            break;
                        }
                    }
                    ;

                });

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
                            'username': data['username'],
                            'password': data['password'],
                            'email': data['email'],
                            'register-submit': 'ok'

                        };

                        var url = "index.php";

                        $.post(url, params).done(function (dataBack) {
                                if (dataBack.exist) {
                                    $.MessageBox('Successful registration! Check your mail to confirm your account.');

                                }
                                else {
                                    $.MessageBox('This username has already been taken!');
                                }
                            }
                        );

                        break;

                    }
                    case 4:
                    {
                        $.MessageBox('Passwords must be at least 6 characters in length! ');
                        break;
                    }
                }


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
                    if (data['password'].length > 5) {
                        return 3;
                    }
                    else {
                        return 4;
                    }

                }


            }


        }


    });
}