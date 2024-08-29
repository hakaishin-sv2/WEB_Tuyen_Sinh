<?php

function validate_Create_Nganhxettuyen($data)
{
    $errors = [];

    // Kiểm tra tiêu đề
    if (empty($data['industry_code'])) {
        $errors[] = "Mã ngành không được để trống.";
    }
    if (empty($data['ten_nganh'])) {
        $errors[] = "Tên ngành không được để trống.";
    }

    return $errors;
}
function getKhoiNganhDto($conn)
{
    // Tạo câu lệnh SQL để lấy thông tin ngành và khối xét tuyển
    $sql = "
        SELECT 
            m.id AS major_id,
            m.industry_code,
            m.ten_nganh AS major_name,  -- Đổi tên cột thành ten_nganh
            GROUP_CONCAT(CONCAT(eb.code, ' - ', eb.name) SEPARATOR '+') AS exam_blocks,
            m.description
        FROM majors m
        INNER JOIN exam_block_major ebm ON m.id = ebm.major_id
        INNER JOIN exam_blocks eb ON ebm.exam_block_id = eb.id
        GROUP BY m.id, m.industry_code, m.ten_nganh, m.description
        ORDER BY m.id ASC
    ";

    // Thực thi câu lệnh SQL
    $result = mysqli_query($conn, $sql);

    // Khởi tạo mảng để lưu trữ kết quả
    $data = [];

    // Duyệt qua các kết quả và thêm vào mảng
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    // Trả về dữ liệu
    return $data;
}

function get_item_nganh_xettuyen($conn, $id)
{

    $sql = "
        SELECT 
            m.id AS major_id,
            m.industry_code,
            m.ten_nganh AS major_name,
            GROUP_CONCAT(CONCAT(eb.code, ' - ', eb.name) SEPARATOR '+') AS exam_blocks,
            m.description
        FROM majors m
        INNER JOIN exam_block_major ebm ON m.id = ebm.major_id
        INNER JOIN exam_blocks eb ON ebm.exam_block_id = eb.id
        WHERE m.id = ?
        GROUP BY m.id, m.industry_code, m.ten_nganh, m.description
    ";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        die('Error preparing the SQL statement: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result && mysqli_num_rows($result) > 0) {
        $nganh_item = mysqli_fetch_assoc($result);
    } else {
        $nganh_item = null; // Trả về null nếu không tìm thấy ngành
    }
    mysqli_stmt_close($stmt);
    return $nganh_item;
}

// Hàm để lấy dữ liệu cho form chỉnh sửa ngành
function get_form_data($conn, $id)
{
    $sql = "
        SELECT 
            m.id AS major_id,
            m.industry_code,
            m.ten_nganh AS major_name,
            GROUP_CONCAT(eb.id) AS selected_blocks, 
            m.description
        FROM majors m
        INNER JOIN exam_block_major ebm ON m.id = ebm.major_id
        INNER JOIN exam_blocks eb ON ebm.exam_block_id = eb.id
        WHERE m.id = ?
        GROUP BY m.id, m.industry_code, m.ten_nganh, m.description
    ";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        die('Error preparing the SQL statement: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result && mysqli_num_rows($result) > 0) {
        $form_data = mysqli_fetch_assoc($result);
    } else {
        $form_data = null; // Trả về null nếu không tìm thấy dữ liệu
    }
    mysqli_stmt_close($stmt);
    return $form_data;
}

// Hàm để lấy danh sách tổ hợp môn từ cơ sở dữ liệu
function get_exam_blocks($conn)
{
    $sql = "SELECT id, code, name FROM exam_blocks";
    $result = mysqli_query($conn, $sql);
    $exam_blocks = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $exam_blocks[] = $row;
        }
    }
    return $exam_blocks;
}
