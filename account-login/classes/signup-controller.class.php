<?php

class SignupController extends Signup
{

    private $uid;
    private $pwd;
    private $pwdrepeat;
    private $email;

    public function __construct($uid, $pwd, $pwdrepeat, $email)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;
    }

    public function signupUser()
    {

        if ($this->invalidUid() == false) {
            header("location: ../index.php?error=invaliduid");
            exit();
        }

        if ($this->invalidEmail() == false) {
            header("location: ../index.php?error=invalidemail");
            exit();
        }

        if ($this->passwordMatch() == false) {
            header("location: ../index.php?error=passwordsdontmatch");
            exit();
        }

        if ($this->userExists() == false) {
            header("location: ../index.php?error=useralreadyexists");
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    private function invalidUid()
    {
        //if invalid characters are used in the username or length is greater than 26 characters
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid) || strlen($this->uid) < 26) {
            return true;
        } else {
            return false;
        }
    }

    private function invalidEmail()
    {
        //if email not valid
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    private function passwordMatch()
    {
        //if passwords don't match
        if ($this->pwd == $this->pwdrepeat) {
            return true;
        } else {
            return false;
        }
    }

    private function userExists()
    {
        if (!$this->checkUser($this->uid, $this->email)) {
            return true;
        } else {
            return false;
        }
    }
}
