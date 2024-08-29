<?php
function checkCode($conn, $code)
{
    $sql = "SELECT COUNT(*) as count FROM exam_blocks WHERE code = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['count'] > 0;
        }

        // Đóng statement
        $stmt->close();
    }

    // Trả về false nếu không tìm thấy hoặc có lỗi xảy ra
    return false;
}

function validate_Create_Exam_block($data, $conn)
{
    $errors = [];
    if (empty($data["code"])) {
        $errors[] = "Cần nhập mã Khối xét tuyển!";
    } elseif (strlen($data["name"]) > 100) {
        $errors[] = "Tên tổ hợp xét không quá 100 ký tự!";
    } elseif (checkCode($conn, $data["code"])) {
        $errors[] = "Mã tổ hợp xét đã tồn tại!";
    } elseif (empty($data["name"])) {
        $errors[] = "Cần nhập tổ hợp của khối xét tuyển!";
    }

    return $errors;
}
