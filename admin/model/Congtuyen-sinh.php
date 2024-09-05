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
                p.id as program_id,
                pm.id AS id_program_major,  
                pm.status as status_cua_nganh,
                pm.major_id,
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

// Hàm này để lấy những bản ghi trong bảng applications mà khi được nhập điểm các user nào nộp 
// nộp hồ sơ cho ngành này và năm này sẽ được thông báo có điểm chuẩn
function get_applications_by_program_and_major($conn, $program_id, $major_id)
{
    $sql = "SELECT a.id as application_id,a.user_id, a.program_id 
            FROM applications a 
            WHERE a.program_id = ? AND a.major_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $program_id, $major_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $applications = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    return $applications;
}

function getProgramsOrderedByStartDate($conn)
{
    $sql = "SELECT * FROM programs p ORDER BY p.start_date DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $programs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $programs[] = $row;
        }
        return $programs;
    } else {
        return [];
    }
}

// thông kê tuyển sinh

// 1- thống kê theo năm có bao nhiêu hồ sơ duyệt, không duyệt , và bị loại rejected
function getApplicationStatistics($conn, $year)
{
    // Câu SQL truy vấn dữ liệu
    $sql = "
        SELECT 
            SUM(CASE WHEN a.status = 'pending' THEN 1 ELSE 0 END) AS total_pending,
            SUM(CASE WHEN a.status = 'approved' THEN 1 ELSE 0 END) AS total_approved,
            SUM(CASE WHEN a.status = 'rejected' THEN 1 ELSE 0 END) AS total_rejected
        FROM applications a
        JOIN programs p ON a.program_id = p.id
        WHERE p.year = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $year);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return [
            'total_pending' => 0,
            'total_approved' => 0,
            'total_rejected' => 0
        ];
    }
}
//2 - thống kê chi tiết từng ngành trong năm ddoscos bao nhiêu hồ sơ duyetj không duyệt và bị hủy bỏ
function getApplicationsStatisticsByMajor($conn, $year)
{
    // Câu truy vấn SQL với ORDER BY số lượng hồ sơ đã duyệt giảm dần
    $sql = "
        SELECT 
            m.industry_code,
            m.ten_nganh,
            SUM(CASE WHEN a.status = 'pending' THEN 1 ELSE 0 END) AS total_pending,
            SUM(CASE WHEN a.status = 'approved' THEN 1 ELSE 0 END) AS total_approved,
            SUM(CASE WHEN a.status = 'rejected' THEN 1 ELSE 0 END) AS total_rejected
        FROM majors m
        LEFT JOIN program_majors pm ON m.id = pm.major_id
        LEFT JOIN programs p ON pm.program_id = p.id
        LEFT JOIN applications a ON a.program_id = p.id AND a.major_id = m.id
        WHERE p.year = ?
        GROUP BY m.industry_code, m.ten_nganh
        ORDER BY total_approved DESC;
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $year);
    $stmt->execute();
    $result = $stmt->get_result();

    $statistics = [];
    while ($row = $result->fetch_assoc()) {
        $statistics[] = $row;
    }

    // Đóng câu lệnh
    $stmt->close();

    return $statistics;
}
