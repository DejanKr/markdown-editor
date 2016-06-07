<?php

chdir(__DIR__);

include_once("baseModel.php");

class UserModel extends BaseModel
{


    protected $tableName = 'users';
    protected $primary = 'UserID';
    protected $fillable = [
        'Username', 'Password', 'Registration', 'IsDeleted', 'Email', 'Activation'
    ];

    protected $fieldMap = [
        'username' => 'Username',
        'password' => 'Password',
        'email' => 'Email'


    ];

    /*
     * Function to check user (when logging).
     */

    public function checkUser($request)
    {
        $params = [
            'Username' => $request['username']

        ];
        $elt = $this->getAll($params);


        if (!empty($elt)) {
            if (password_verify($request['password'], $elt[0]['Password'])) {
                if ($elt[0]['IsActivated'] == '1') {
                    $_SESSION['logged'] = 'yes';
                    $_SESSION['username'] = $request['username'];
                    return 1;
                } else {
                    return 2;
                }


            } else {
                $_SESSION['logged'] = 'no';
            }

        } else {

            $_SESSION['logged'] = 'no';
        }

        return 3;


    }

    /*
     * Function to check if user exist in database.
     */
    public function existUser($params)
    {
        if (!empty($this->getAll($params))) {
            return True;
        } else {
            return False;
        }
    }

    /*
     * Function to create new user.
     */
    public function newUser($request)
    {
        $params1 = [
            'Username' => $request['username']
        ];
        if ($this->existUser($params1) == True) {
            return False;
        } else {

            while (True) {
                $params2 = [
                    'Activation' => password_hash(rand(), PASSWORD_DEFAULT)
                ];

                if ($this->existUser($params2) != True) {
                    break;
                }
            }


            $params3 = [
                'Username' => $request['username'],
                'Email' => $request['email'],
                'Password' => password_hash($request['password'], PASSWORD_DEFAULT),
                'IsDeleted' => '0',
                'Registration' => (new DateTime('now'))->format('Y-m-d h:s'),
                'Activation' => $params2['Activation']
            ];

            $userID = $this->create();
            $link = "http://www.mdtohtml.com/index.php?activation=" . $params3['Activation'];
            $this->update($userID, $params3);

            $data = [
                'email' => $request['email'],
                'title' => 'Registration support',
                'body' => "Hello!\n\nClick on below link to confirm your registration.\n\n$link",
                'subject' => 'Confirm password',
                'user' => $request['username'],
                'link' => $link,
                'username' => 'markdownmarkdown@gmail.com',
                'password' => 'preskok123'

            ];

            $this->send_mail($data);
            return True;
        }

    }

    /*
     * Function to send mail to user.
     */
    public function send_mail($data)
    {
        require_once('../phpmailer/class.phpmailer.php');
        $mail = new PHPMailer(true);
        $mail->IsSMTP(); 
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = "ssl"; 
        $mail->Host = "smtp.gmail.com"; 
        $mail->Port = 465; 
        $mail->Username = $data['username']; 
        $mail->Password = $data['password'];
        $mail->AddAddress($data['email'], $data['user']);
        $mail->SetFrom($data['email'], $data['title']);
        $mail->Subject = $data['subject'];
        $mail->Body = $data['body'];
        $isSend = $mail->Send();
        return $isSend;
    }
    
    /*
     * Function to activate user in database.
     */

    public function activateUser($request)
    {
        $params = [
            'IsActivated' => '1'
        ];
        $this->primary = 'Activation';
        $this->update($request['activation'], $params);

    }

    /*
     * Function to set new users password.
     */
    public function setPass($request)
    {
        $params = [
            'Password' => password_hash($request['password'], PASSWORD_DEFAULT),
        ];
        $this->primary = 'Activation';
        $this->update($request['activateCode'], $params);

    }

    /*
     * Function to set data (for sending mail to reset password). 
     */
    public function resetPass($request)
    {
        $params = [
            'Username' => $request['username'],
            'Email' => $request['email']
        ];
        $user = $this->getAll($params);
        if (!empty($user)) {

            $link = "http://www.mdtohtml.com/index.php?rp=" . $user[0]['Activation'];
            $data = [
                'email' => $request['email'],
                'title' => 'Registration support',
                'body' => "Hello!\n\nClick on below link to create new password.\n\n$link",
                'subject' => 'Reset password',
                'user' => $request['username'],
                'link' => $link,
                'username' => 'markdownmarkdown@gmail.com',
                'password' => 'preskok123'

            ];

            return $this->send_mail($data);

        }
    }

}