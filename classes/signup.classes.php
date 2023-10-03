<?php
class Signup extends Dbh
{

    protected function setUser($user_nama, $user_pwd, $user_email)
    {
        //preventing sql injection
        $stmt = $this->connect()->prepare("INSERT INTO users (user_name, user_pwd, user_email) VALUES (?, ?, ?);");

        $hashedPwd = password_hash($user_pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($user_nama, $hashedPwd, $user_email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

    protected function checkUser($user_nama, $user_email)
    {
        //preventing sql injection
        $stmt = $this->connect()->prepare("SELECT user_name FROM users WHERE user_name = ? OR user_email = ?;");

        if (!$stmt->execute(array($user_nama, $user_email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $resultCheck = true;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}
