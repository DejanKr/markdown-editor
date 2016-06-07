<?php
include_once('base.php');
include_once ('/../../library/model/user.php');

class registration extends BaseController
{
    public $request;
    public function __construct($controller,$request)
    {
        $this->request=$request;
    }
    
    /*
     * Controller function to register new user.
     */
    public function registerMember()
    {
        $member=new UserModel();
        $isOk=$member->newUser($this->request);

        $this->getJson([
            'exist' => $isOk
        ]);
        
    }

    /*
     * Controller function to activate user in database.
     */

    public function activation()
    {
        $activate=new UserModel();
        $activate->activateUser($this->request);
        header("location:confirmRegistration.php");


    }


}