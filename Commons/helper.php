<?php
// các hàm dùng chung Global


// lấy các file trong 1 thư mục
if (!function_exists("require_file")) {
    function require_file($pathFolder)
    {
        $files = array_diff(scandir($pathFolder), ['.', '..']);

        foreach ($files as $item) {
            require_once $pathFolder . $item;
        }
    }
}


if (!function_exists("debug")) {
    function debug($data)
    {
        echo "<pre>";
        print_r($data);
        die;
    }
}

function isValidPhoneNumber($phoneNumber)
{
    if (strlen($phoneNumber) === 10) {
        if (substr($phoneNumber, 0, 1) === '0' && is_numeric($phoneNumber)) {
            return true;
        }
    }
    return false;
}
// hàm trong user
function checkEmailTonTai($conn, $tableName, $email)
{
    try {
        $sql = "SELECT COUNT(*) as count FROM $tableName WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Truy vấn checkEmailTonTai thất bại: " . $conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];

        return $count > 0; // Trả về true nếu tồn tại email, ngược lại trả về false

    } catch (Exception $e) {
        throw $e;
    }
}

function validate_form_Login($data)
{
    $errors = [];

    // Kiểm tra email
    if (empty($data['email'])) {
        $errors[] = "Vui lòng nhập địa chỉ email!";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Địa chỉ email không hợp lệ!";
    }

    // Kiểm tra mật khẩu
    if (empty($data['password'])) {
        $errors[] = "Vui lòng nhập mật khẩu!";
    }

    return $errors;
}


function validate_Create_User($data, $conn)
{
    $errors = [];

    // Kiểm tra Họ Tên
    if (empty($data["full_name"])) {
        $errors[] = "Cần nhập Họ Tên!";
    } elseif (strlen($data["full_name"]) > 50) {
        $errors[] = "Họ Tên không quá 50 ký tự!";
    }

    // Kiểm tra Email
    if (empty($data["email"])) {
        $errors[] = "Cần nhập Email!";
    } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không đúng định dạng!";
    } elseif (checkEmailTonTai($conn, 'users', $data["email"])) {
        $errors[] = "Email đã tồn tại!";
    }

    // Kiểm tra Mật khẩu
    if (empty($data["password"])) {
        $errors[] = "Cần nhập Mật khẩu!";
    } elseif (strlen($data["password"]) < 6 || strlen($data["password"]) > 20) {
        $errors[] = "Mật khẩu phải từ 6 đến 20 ký tự!";
    }

    // Kiểm tra Vai trò
    if (!isset($data["role"])) {
        $errors[] = "Cần chọn Vai trò!";
    } elseif (!in_array($data["role"], [0, 1, 2, 3])) {
        $errors[] = "Vai trò không hợp lệ! Vai trò hợp lệ là 0, 1 hoặc 2.";
    }

    return $errors;
}

function get_dataTable_users_by_email($conn, $email)
{
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $row;
    } else {
        mysqli_stmt_close($stmt);
        return null;
    }
}


// các hàm xử lý file
function uploadFile($name_input_file, $directory)
{
    if (!empty($_FILES[$name_input_file]) && $_FILES[$name_input_file]['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES[$name_input_file];
        $uploadDir = "../uploads/$directory/";

        if (!file_exists($uploadDir) && !is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        // Tạo tên file mới để tránh trùng lặp
        $fileName = uniqid() . '_' . basename($file['name']);
        // Đường dẫn mới của file
        $uploadPath = $uploadDir . $fileName;
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $uploadPath;
        }
    }

    return null;
}
function uploadFile_client($name_input_file, $directory)
{
    if (!empty($_FILES[$name_input_file]) && $_FILES[$name_input_file]['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES[$name_input_file];
        $uploadDir = "uploads/$directory/";

        if (!file_exists($uploadDir) && !is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        // Tạo tên file mới để tránh trùng lặp
        $fileName = uniqid() . '_' . basename($file['name']);
        // Đường dẫn mới của file
        $uploadPath = $uploadDir . $fileName;
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $uploadPath;
        }
    }

    return null;
}

function deleteFile($filePath)
{
    if (file_exists($filePath)) {
        return unlink($filePath);
    }

    return false;
}
function LogOut()
{
    unset($_SESSION['user']);
    header('Location: index.php?act=login');
    exit();
}
