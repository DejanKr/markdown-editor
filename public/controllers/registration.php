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
    public function register_member()
    {
        $member=new UserModel();
        $je=$member->newUser($this->request);

        $this->getJson([
            'exist' => $je
        ]);
        
        //if($member->existUser($this->request);
        
    }


}