<?php
// Định nghĩa các hằng số hoặc biến cấu hình kết nối
define('SERVER', 'localhost'); // Thay 'localhost' bằng địa chỉ máy chủ cơ sở dữ liệu của bạn
define('USERNAME', 'root');    // Thay 'root' bằng tên người dùng cơ sở dữ liệu của bạn
define('PASSWORD', '');        // Thay '' bằng mật khẩu cơ sở dữ liệu của bạn
define('DATABASE', 'k72_nhom33'); // Thay 'university_admissions' bằng tên cơ sở dữ liệu của bạn

// Tạo kết nối cơ sở dữ liệu
$conn = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối tới cơ sở dữ liệu thất bại: " . mysqli_connect_error() . " Mã lỗi: " . mysqli_connect_errno());
} else {
    // Kết nối thành công
    // echo "Kết nối thành công!";
}
