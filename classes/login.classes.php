<?php
class Login extends Dbh
{

    protected function getUser($user_name, $user_pwd)
    {
        //preventing sql injection
        $stmt = $this->connect()->prepare("SELECT user_pwd FROM users WHERE user_name = ? OR user_email = ?;");

        if (!$stmt->execute(array($user_name, $user_pwd))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt  = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkedPwd = password_verify($user_pwd, $pwdHashed[0]["user_pwd"]);

        if ($checkedPwd == false) {
            $stmt  = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        } elseif ($checkedPwd == true) {
            $stmt = $this->connect()->prepare("SELECT * FROM users WHERE user_name = ? OR user_email = ? AND user_pwd = ?;");

            //only check whther statement is executed or not
            if (!$stmt->execute(array($user_name, $user_name, $user_pwd))) {
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt  = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $newSessionId = session_create_id('myprefix-');
            $sessionId = $newSessionId . "-" . $user[0]["user_id"];
            // Finish session
            session_commit();
            session_id($sessionId);
            //start the session again
            session_start();
            $_SESSION['last_regeneration'] = time();
            $_SESSION["user_id"] = $user[0]["user_id"];
            $_SESSION["user_username"] = htmlspecialchars($user[0]["user_name"]);
        }
        $stmt = null;
    }
}
