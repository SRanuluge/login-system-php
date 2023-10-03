<?php

class SignupContr extends Signup
{

    private $user_name;
    private $user_email;
    private $user_pwd;
    private $user_confirm_pwd;


    public function __construct($user_name, $user_email, $user_pwd, $user_confirm_pwd)
    {
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->user_pwd = $user_pwd;
        $this->user_confirm_pwd = $user_confirm_pwd;
    }

    public function signupUser()
    {
        if ($this->emptyInput() == false) {
            // echo "Empty input"
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        if ($this->invalidUid() == false) {
            // echo "Empty user name"
            header("location: ../index.php?error=invalidUid");
            exit();
        }
        if ($this->invalidEmail() == false) {
            // echo "Empty email"
            header("location: ../index.php?error=invalidEmail");
            exit();
        }
        if ($this->passwordMatch() == false) {
            // echo "password don't match"
            header("location: ../index.php?error=passwordmatch");
            exit();
        }
        if ($this->userNameTaken() == false) {
            // echo "user name or email taken"
            header("location: ../index.php?error=username or email taken");
            exit();
        }
        $this->setUser($this->user_name, $this->user_pwd, $this->user_email);
    }

    private function emptyInput()
    {
        $result = true;
        if (empty($this->user_name) || empty($this->user_email) || empty($this->user_pwd) || empty($this->user_confirm_pwd)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidUid()
    {
        $result = true;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->user_name)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        $result = true;
        if (!filter_var($this->user_email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function passwordMatch()
    {
        $result = true;
        if ($this->user_pwd !== $this->user_confirm_pwd) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function userNameTaken()
    {
        $result = true;
        if (!$this->checkUser($this->user_name, $this->user_email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
