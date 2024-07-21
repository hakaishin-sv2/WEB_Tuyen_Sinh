<?php
function user_detail($conn, $id)
{
    $user_item = getItemByID($conn, "users", $id);
    if ($user_item == null || empty($user_item)) {
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    //require_once PATH_VIEW_ADMIN. 'user-detail.php';
}
function create_user($conn)
{
    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
            echo "huhuhu";
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
            $hashpassword = password_hash(mysqli_real_escape_string($conn, $_POST["password"]), PASSWORD_DEFAULT); // Mã hóa mật khẩu
            $role = 0;
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $repeat_password = $_POST["repeat_password"];
            $data = [
                'email' => $email,
                'full_name' => $full_name,
                'password' => $password,
                'hashpassword' => $hashpassword,
                'role' => $role,
                'img_user' => "/uploads/img_users/user-no-avatar.jpg"
            ];
            $errors = validate_Create_User($data, $conn);
            if ($password !== $repeat_password) {
                $errors[] = "Mật khẩu không khớp với nhau vui lòng kiểm tra lại";
            }
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['data_err'] = $data;
                header('Location: index.php?act=register');
                exit();
            }
            insert($conn, "users", $data);
            $_SESSION['success'] = "Thêm User mới thành công";
            header('Location: index.php?act=login');
            exit();
        }

        require_once PATH_VIEW_CLIENT . 'register.php';
    } catch (Exception $e) {
        echo "Đã có lỗi xảy ra: " . $e->getMessage();
    }
}

function update_user($conn, $id)
{
    $user_item = getItemByID($conn, "users", $id);

    // Kiểm tra phương thức request là POST và không rỗng
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
        $hashpassword = password_hash(mysqli_real_escape_string($conn, $_POST["password"]), PASSWORD_DEFAULT);
        $role = (int) $_POST["role"];
        $password = $_POST["password"];

        // Đặt dữ liệu vào mảng
        $data = [
            'email' => $email ?? $user_item["email"],
            'full_name' => $full_name ?? $user_item["full_name"],
            'password' => $password,
            'hashpassword' => $hashpassword,
            'role' => $role,
        ];

        // Cập nhật thông tin người dùng
        update($conn, "users", $data, $id);
        $_SESSION['success'] = "Cập nhật thành công";
        header('Location: index.php?act=users');
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'user-update.php';
}
