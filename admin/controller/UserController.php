<?php
function getListAll($conn)
{
    $listUser = getListTable($conn, "users");
    require_once PATH_VIEW_ADMIN . 'user-manager.php';
}

function getUserDetail($conn, $id)
{
    $user_item = getItemByID($conn, "users", $id);
    if ($user_item == null || empty($user_item)) {
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    require_once PATH_VIEW_ADMIN . 'user-detail.php';
}
function UserCreate($conn)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
        $hashpassword = password_hash(mysqli_real_escape_string($conn, $_POST["password"]), PASSWORD_DEFAULT); // Mã hóa mật khẩu
        $role =  $_POST["role"];
        $password =  $_POST["password"];
        $data = [
            'email' => $email ?? null,
            'full_name' => $full_name ?? null,
            'password' => $password ?? null,
            'hashpassword' => $hashpassword ?? null,
            'role' => $role ?? null,
        ];
        $errors = validate_Create_User($data, $conn);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data_err'] = $data;
            header('Location: index.php?act=user-create');
            exit();
        }
        insert($conn, "users", $data);
        $_SESSION['success'] = "Thêm User mới thành công";
        header('Location: index.php?act=users');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'user-create.php';
}
function updateUser($conn, $id)
{
    $user_item = getItemByID($conn, "users", $id);

    // Kiểm tra phương thức request là POST và không rỗng
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
        $hashpassword = password_hash(mysqli_real_escape_string($conn, $_POST["password"]), PASSWORD_DEFAULT);
        $role =  $_POST["role"];
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
function deleteUser($conn, $id)
{
    deleteByID($conn, "users", $id);
    $_SESSION['success'] = "Xóa thành công";
    header('Location: index.php?act=users');
    exit();
}
