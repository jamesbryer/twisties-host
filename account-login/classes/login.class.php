<?php

class Login extends Dbh
{
    protected function getUser($uid, $pwd)
    {
        $stmt = $this->connect()->prepare("SELECT users_pwd from users WHERE users_uid = ? or users_email = ?;");


        if (!$stmt->execute(array($uid, $uid))) {
            $stmt = null;
            header("location: ../account-login?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../?error=usernotfound");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]['users_pwd']);
        if ($checkPwd == false) {
            $stmt = null;
            header("location: ../?error=wrongpwd");
            exit();
        } elseif ($checkPwd == true) {
            $stmt = $this->connect()->prepare("SELECT * from users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?;");
            if (!$stmt->execute(array($uid, $uid, $pwdHashed[0]['users_pwd']))) {
                $stmt = null;
                header("location: ../?error=stmtfailed");
                exit();
            }
            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['user_id'] = $user[0]['users_id'];
            $_SESSION['user_uid'] = $user[0]['users_uid'];

            $stmt = null;
        }

        $stmt = null;
    }
}
