<?php

include_once ('/../../library/model/user.php');

class registration
{
    public $request;
    public function __construct($controller,$request)
    {
        $this->request=$request;
    }
    public function register_member()
    {
        $member=new UserModel();
        //if($member->existUser($this->request);
        
    }


}