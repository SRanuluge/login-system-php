<?php

class LoginContr extends Login
{

    private $user_name;
    private $user_pwd;

    public function __construct($user_name, $user_pwd)
    {
        $this->user_name = $user_name;
        $this->user_pwd = $user_pwd;
    }

    public function loginUser()
    {
        if ($this->emptyInput() == false) {
            // echo "Empty input"
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        $this->getUser($this->user_name, $this->user_pwd);
    }

    private function emptyInput()
    {
        $result = true;
        if (empty($this->user_name) || empty($this->user_pwd)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
