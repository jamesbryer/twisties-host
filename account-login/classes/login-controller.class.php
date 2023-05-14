<?php

class LoginController extends Login
{

    private $uid;
    private $pwd;


    public function __construct($uid, $pwd)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    public function loginUser()
    {
        $this->getUser($this->uid, $this->pwd);
    }
}
