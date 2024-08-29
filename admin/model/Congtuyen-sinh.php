<?php

function checkProgramExists($conn, $currentYear)
{
    $sql = "SELECT * FROM programs WHERE year = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $currentYear);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Nếu tìm thấy bản ghi với năm hiện tại, trả về true
            return true;
        }
    }

    // Trả về false nếu không tìm thấy hoặc có lỗi
    return false;
}
function isExpired($end_date)
{
    $today = date('Y-m-d');
    return $today > $end_date;
}
function updateExpiredPrograms($conn)
{
    // Lấy năm hiện tại
    $currentYear = date('Y');

    // Kiểm tra các chương trình trong năm hiện tại
    $sql = "SELECT id, end_date FROM programs WHERE year = ? AND status = 'active'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $currentYear);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($program = mysqli_fetch_assoc($result)) {
        // Kiểm tra xem chương trình đã hết hạn chưa
        if (isExpired($program['end_date'])) {
            // Cập nhật trạng thái của chương trình thành 'inactive'
            $updateProgramSQL = "UPDATE programs SET status = 'inactive' WHERE id = ?";
            $updateProgramStmt = mysqli_prepare($conn, $updateProgramSQL);
            mysqli_stmt_bind_param($updateProgramStmt, 'i', $program['id']);
            mysqli_stmt_execute($updateProgramStmt);
            mysqli_stmt_close($updateProgramStmt);

            // Cập nhật trạng thái của các bản ghi liên quan trong bảng program_majors
            $updateMajorSQL = "UPDATE program_majors SET status = 'inactive' WHERE program_id = ?";
            $updateMajorStmt = mysqli_prepare($conn, $updateMajorSQL);
            mysqli_stmt_bind_param($updateMajorStmt, 'i', $program['id']);
            mysqli_stmt_execute($updateMajorStmt);
            mysqli_stmt_close($updateMajorStmt);
        }
    }
    mysqli_stmt_close($stmt);
}

function validate_Create_MoTuyenSinh($data, $conn)
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


// xem chi tiết các ngành tuyển sinh của từng năm
function getProgramDetails_byYear($conn, $year)
{
    $sql = "SELECT
                p.status,
                p.year,
                pm.id AS id_program_major,  
                pm.status as status_cua_nganh,
                m.industry_code, 
                m.ten_nganh AS ten_nganh,  
                GROUP_CONCAT(CONCAT(eb.code, ' - ', eb.name) SEPARATOR ' + ') AS khoivatohopxet,  -- Khối xét tuyển
                pm.cut_off_score AS diem_trung_tuyen  
            FROM
                programs p
            JOIN
                program_majors pm ON p.id = pm.program_id
            JOIN
                majors m ON pm.major_id = m.id
            JOIN
                exam_block_major ebm ON m.id = ebm.major_id
            JOIN
                exam_blocks eb ON ebm.exam_block_id = eb.id
            WHERE
                p.year = ?
            GROUP BY
                pm.id, m.industry_code, m.ten_nganh, pm.cut_off_score";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Câu truy vấn không thể chuẩn bị: " . $conn->error);
    }

    $stmt->bind_param("i", $year);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;  // Trả về mảng dữ liệu
    } else {
        $stmt->close();
        return [];  // Trả về mảng rỗng nếu không có dữ liệu
    }
}


// hàm lấy thông tin từ id trong bảng program_majors
function getProgramDetails_byID($conn, $id)
{
    $sql = "SELECT
                p.status,
                p.year,
                pm.id AS id_program_major,  
                pm.status as status_cua_nganh,
                m.industry_code, 
                m.ten_nganh AS ten_nganh,  
                GROUP_CONCAT(CONCAT(eb.code, ' - ', eb.name) SEPARATOR ' + ') AS khoivatohopxet,  -- Khối xét tuyển
                pm.cut_off_score AS diem_trung_tuyen  
            FROM
                programs p
            JOIN
                program_majors pm ON p.id = pm.program_id
            JOIN
                majors m ON pm.major_id = m.id
            JOIN
                exam_block_major ebm ON m.id = ebm.major_id
            JOIN
                exam_blocks eb ON ebm.exam_block_id = eb.id
            WHERE
                pm.id = ?
            GROUP BY
                pm.id, m.industry_code, m.ten_nganh, pm.cut_off_score";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Câu truy vấn không thể chuẩn bị: " . $conn->error);
    }

    $stmt->bind_param("i", $id); // Ràng buộc chỉ tham số $id
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;  // Trả về mảng dữ liệu
    } else {
        $stmt->close();
        return [];  // Trả về mảng rỗng nếu không có dữ liệu
    }
}
