<?php

function forgot_password($conn)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        $email = mysqli_real_escape_string($conn, $_POST["exampleInputEmail"]);
        if (checkEmailTonTai($conn, "users", $email) == false) {
            $_SESSION["errors"][] = "Email không tồn tại";
            $data = [
                "email" => $email,
            ];
            $_SESSION['data_err'] = $data;
            header('Location: index.php?act=forgot-password');
            exit();
        }
        $verificationCode = rand(100000, 999999);
        if (sendVerificationEmail($email, $verificationCode)) {
            // Lưu mã xác nhận vào session với thời gian sống là 3 phút (180 giây)
            $_SESSION['verification_code'] = $verificationCode;
            $_SESSION['verification_code_expiry'] = time() + 180;

            header('Location: index.php?act=ma-xac-nhan');
            exit();
        } else {
            $_SESSION["errors"][] = "Có lỗi xảy ra khi gửi email. Vui lòng thử lại.";
            header('Location: index.php?act=forgot-password');
            exit();
        }
    } else {
        require_once PATH_VIEW_CLIENT . 'forgot-password.php';
    }
}

function sendVerificationEmail($email, $verificationCode)
{

    $subject = "Mã xác nhận của bạn";
    $message = "Mã xác nhận của bạn là: $verificationCode";
    $headers = "From: no-reply@example.com";

    return mail($email, $subject, $message, $headers);
}
function Xac_nhan_code_email($conn)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    } else {
        require_once PATH_VIEW_CLIENT . 'ma-xac-nhan.html';
    }
}
function Change_password($conn)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        $current_password = mysqli_real_escape_string($conn, $_POST["current_password"]);
        $new_password = mysqli_real_escape_string($conn, $_POST["new_password"]);
        $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);
        $data = [
            "current_password" => $current_password,
            "new_password" => $new_password,
            "confirm_password" => $confirm_password
        ];
        $email = $_SESSION["user"]["email"];
        $user_item = get_dataTable_users_by_email($conn, $email);

        if (!$user_item || !password_verify($current_password, $user_item["hashpassword"])) {
            $_SESSION["errors"][] = "Mật khẩu cũ không đúng!";
            $_SESSION['data_err'] = $data;
            header('Location: index.php?act=change-password');
            exit();
        }
        if ($new_password !== $confirm_password) {
            $_SESSION["errors"][] = "Mật khẩu mới và xác nhận mật khẩu không khớp!";
            $_SESSION['data_err'] = $data;
            header('Location: index.php?act=change-password');
            exit();
        }
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET hashpassword = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $hashed_password, $email);

        if ($stmt->execute()) {
            $_SESSION["success"] = "Mật khẩu đã được thay đổi thành công!";
            header('Location: index.php?act=profile');
            exit();
        } else {
            $_SESSION["errors"][] = "Có lỗi xảy ra khi thay đổi mật khẩu. Vui lòng thử lại!";
            $_SESSION['data_err'] = $data;
            header('Location: index.php?act=change-password');
            exit();
        }
    } else {
        require_once PATH_VIEW_CLIENT . 'change-password.php';
    }
}


function showProfile($conn)
{
    if (!isset($_SESSION["user"])) {
        header('Location: index.php?act=login');
        exit();
    }

    $email = $_SESSION["user"]["email"];
    $user_item = get_dataTable_users_by_email($conn, $email);

    if (!$user_item) {
        $_SESSION["errors"][] = "Không tìm thấy thông tin người dùng.";
        header('Location: index.php?act=error');
        exit();
    }

    $data = [
        "user" => $user_item
    ];

    require_once PATH_VIEW_CLIENT . 'profile.php';
}

function showEditProfile($conn)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $img_user = null;
        if (isset($_FILES['img_user']) && $_FILES['img_user']['error'] == 0) {
            $target_dir = "uploads/img_users/";
            $target_file = $target_dir . basename($_FILES["img_user"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
                $_SESSION["errors"][] = "Chỉ hỗ trợ các định dạng ảnh JPG, JPEG, PNG ";
                $uploadOk = 0;
            }
            if ($_FILES["img_user"]["size"] > 3145728) { // 3MB = 3145728 bytes
                $_SESSION["errors"][] = "Ảnh quá lớn. Kích thước tối đa là 3MB.";
                $uploadOk = 0;
            }
            if ($uploadOk && move_uploaded_file($_FILES["img_user"]["tmp_name"], $target_file)) {
                $img_user = $target_file;
            } else {
                $_SESSION["errors"][] = "Có lỗi xảy ra khi tải ảnh lên.";
            }
        }

        // Cập nhật thông tin người dùng
        if (empty($_SESSION["errors"])) {
            $query = "UPDATE users SET full_name = ?, email = ?" . ($img_user ? ", img_user = ?" : "") . " WHERE email = ?";
            $stmt = $conn->prepare($query);

            if ($img_user) {
                $stmt->bind_param("ssss", $full_name, $email, $img_user, $_SESSION["user"]["email"]);
            } else {
                $stmt->bind_param("sss", $full_name, $email, $_SESSION["user"]["email"]);
            }

            if ($stmt->execute()) {
                $_SESSION["success"] = "Cập nhật hồ sơ thành công!";
                $_SESSION["user"]["full_name"] = $full_name;
                $_SESSION["user"]["email"] = $email;
                if ($img_user) {
                    $_SESSION["user"]["img_user"] = $img_user;
                }
                header('Location: index.php?act=profile');
                exit();
            } else {
                $_SESSION["errors"][] = "Có lỗi xảy ra khi cập nhật hồ sơ.";
            }
        }
    }

    require_once PATH_VIEW_CLIENT . 'edit-profile.php';
}
