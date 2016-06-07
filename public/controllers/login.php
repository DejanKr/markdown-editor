<?php
chdir(__DIR__);
include_once('base.php');
include_once('/../../library/model/user.php');



class login extends BaseController
{

    public function __construct($controller, $request)
    {

        $controller = 'login';

        parent::__construct($controller, $request);


    }

    /*
     * Controller function to check user login.
     */
    public function checkLogin()
    {
        $user = new UserModel();
        $status=$user->checkUser($this->request);

        $this->getJson([
            'Activation' => $status
        ]);

        header("location:index.php");
  }

    /*
     * Controller function to show login view.
     */
    public function login()
    {
        $data = $this->request;
        $this->action = 'login';
        return $this->getView($data);
    }

    /*
     * Controller function to send mail about reset user password.
     */
    public function resetPass()
    {
        $resetUser=new UserModel();
        $isSend=$resetUser->resetPass($this->request);
        if($isSend!=False)
        {
            $this->getJson([
                'check' => True
            ]);
        }
        else
        {
            $this->getJson([
                'check' => False
            ]);
        }

        
    }
    
    /*
     * Controller function to get view of reset password.
     */
    public function newPass()
    {
        $this->action='newPass';
        return $this->getView();
    }
    
    /*
     * Controller function to set new password.
     */
    public function setPass()
    {
        $pass=new UserModel();
        $pass->setPass($this->request);
        $this->getJson([
             'save'=>True

            ]
        );
        
    }


}