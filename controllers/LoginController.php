<?php

require_once './models/UserModel.php';

class LoginController
{
    public function showLogin()
    {
        include './views/login/login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = UserModel::checkLogin($username, $password);

            if ($user) {

                // Lưu session đúng chuẩn
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['username'] = $user['username'];

                // Chuyển hướng theo quyền
                if ($user['role'] == 'admin') {
                    header("Location: index.php?act=admin-home");
                } else {
                    header("Location: index.php?act=guide-home");
                }
                exit;
            } else {
                $error = "Sai tài khoản hoặc mật khẩu!";
                include './views/login/login.php';
            }
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header("Location: index.php?act=login");
        exit;
    }
}
