<?php
function LoginForm_user($conn)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $errors = validate_form_Login($data);

        // Kiểm tra đăng nhập
        $user_login = get_dataTable_users_by_email($conn, $email);
        if (!$user_login || !password_verify($password, $user_login["hashpassword"])) {
            $errors[] = "Tài khoản hoặc mật khẩu sai";
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data_err'] = $data;
            header('Location: index.php?act=login');
            exit();
        }
        $_SESSION['user'] = $user_login;
        if ($user_login["role"] == 1) {
            header('Location: ' . BASE_URL_ADMIN);
            exit();
        } else {
            header('Location: ' . BASE_URL_CLIENT);
            exit();
        }
    }

    require_once PATH_VIEW_CLIENT . 'login-user.php';
}
