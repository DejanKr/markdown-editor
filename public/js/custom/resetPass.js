$(function ($, undefined) {

    var newPass = $('div.resetPass');

    $('#login-submit').click(function (e) {
        e.preventDefault();
        var pass=newPass.find('input[name=password]').val();
        var confirmPass=newPass.find('input[name=confirm-password]').val();

        switch (checkInput(pass,confirmPass)) {
            case 1:
            {
                var url = 'index.php';
                var data = {
                    'password': pass,
                    'activateCode': $('#activation').val()

                };
                $.post(url, data).done(function (dataBack) {
                    if (dataBack.save) {
                        $.MessageBox('Password has been changed.');
                    }
                    else {

                        $.MessageBox('Error!');
                    }
                });
                break;
            }
            case 2:
            {
                $.MessageBox('Passwords must be at least 6 characters in length! ');


                break;
            }
            case 3:
            {
                $.MessageBox('Password and confirm password not match!');
                break;
            }


        };


    });



    function checkInput(a, b) {
        if (a != b) {
            return 3;
        }
        else if (a.length < 6) {
            return 2;

        }
        else {
            return 1;
        }


    }


});