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

        /*
         * First, set params username which you need to check if user with this username exist in database.
         * PS: Each of registered user in database has diffrent username.
         */
        $params = [
            'Username' => $request['username']

        ];
        $elt = $this->getAll($params);


        if (!empty($elt)) {
            /*
             * Beacuse each of user in database has unique username you know that $elt will be array with one element.
             * In next if sentence you can see comparing input password and user password from database.
             */

            if (password_verify($request['password'], $elt[0]['Password'])) {

                /*
                 * If passwords are equal then you must to check if user is activated in database.
                 * If account is activated than logging is successful and otherwise not successful.
                 */

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
        /*
         * As before we set $params1 'Username'. We need this to check if user exist in database beacuse we don't allow
         * two user in database with the same username.
         */
        $params1 = [
            'Username' => $request['username']
        ];
        if ($this->existUser($params1) == True) {
            /*
             * If in the database exits user with the same username then you return false (user must change username)
             */

            return False;
        } else {

            /*
               * Next step is creating a valid activation hash code. We need this for security (in URL you dont want to show UserID
               * beacuse in this case attacker has more information about your database)
               * Each of users in database has unique activation hash code. Activation hash code we need for activation account and
               * reseting password.
               *
               * Now,follow algorithm for creating unique activation hash code.
               */
            while (True) {
                $params2 = [
                    'Activation' => password_hash(rand(), PASSWORD_DEFAULT)
                ];

                if ($this->existUser($params2) != True) {
                    break;
                }
            }

            /*
             * Next step is set params which need to create new user into database.
             */

            $params3 = [
                'Username' => $request['username'],
                'Email' => $request['email'],
                'Password' => password_hash($request['password'], PASSWORD_DEFAULT),
                'IsDeleted' => '0',
                'Registration' => (new DateTime('now'))->format('Y-m-d h:s'),
                'Activation' => $params2['Activation']
            ];

            $userID = $this->create();

            /*
             * Creating link which is send to user mail at registration for activating his account.
             */
            $link = "http://www.mdtohtml.com/index.php?activation=" . $params3['Activation'];

            /*
             * Inserting new user in database
             */
            $this->update($userID, $params3);

            /*
             * Now we have to prepare data to send activation mail to user (mail).
             */

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

            /*
             * At the end sending activating mail to user.
             */

            $this->send_mail($data);
            return True;
        }

    }

    /*
     * Function to send mail to user.
     */
    public function send_mail($data)
    {
        /*
         *
         * There we set some atributes to send mail.(Title, Subject, Adress,...)
         */
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
        /*
         * When registration has done you must activate your account to log in.
         * (Application will show you message "You must confirm account")
         */


        /*
         * In database we want to set field IsActivated to '1'
         */
        $params = [
            'IsActivated' => '1'
        ];

        /*
         * Update row in user table where Activativon ==$request['activation']<---
         */
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
        /*
         * Update row in user table where Activativon ==$request['activateCode'] with new password (hash code)
         */
        $this->update($request['activateCode'], $params);

    }

    /*
     * Function to set data (for sending mail to reset password). 
     */
    public function resetPass($request)
    {
        /*
         * First, set params you need to search user in database.
         */
        $params = [
            'Username' => $request['username'],
            'Email' => $request['email']
        ];

        /*
         * Check if user exist in database.
         */
        $user = $this->getAll($params);
        if (!empty($user)) {

            /*
             * If exitst you have to set link and data parameters to send mail.
             */
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
            /*
             * Then you call function to send mail.
             */
            return $this->send_mail($data);

        }
    }

}