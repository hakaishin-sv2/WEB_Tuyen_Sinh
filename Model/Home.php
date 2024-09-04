<?php
// // Hàm cập nhật view_count và đánh dấu post_id đã được xem
function manage_post_view($conn, $post_id)
{
    if (isset($_SESSION['viewed_posts']) && !in_array($post_id, $_SESSION['viewed_posts'])) {
        $query = "UPDATE posts SET views_count = views_count + 1 WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['viewed_posts'][] = $post_id;

        return false;
    } else {
        return true;
    }
}


function checkProgramExists($conn, $currentYear)
{
    $currentYear = date("Y");
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


// phân trang
function getlistNganhTuyensinh($conn, $search = '', $limit, $offset)
{
    // Khởi tạo mảng chứa kết quả
    $result = [];
    $currentyear = date("Y");

    // Kiểm tra xem năm hiện tại có chương trình tuyển sinh hay không
    $checkTonTai = checkProgramExists($conn, $conn);

    if (!$checkTonTai) {
        $currentyear = $currentyear - 1;
    }

    // Chuẩn bị câu truy vấn SQL để lấy thông tin ngành, khối xét tuyển và chương trình với điều kiện năm hiện tại
    $sql = "
        SELECT 
            m.id, 
            m.ten_nganh, 
            m.description, 
            m.img_major,
            pm.cut_off_score,
            p.year,
            GROUP_CONCAT(CONCAT(e.code, ' - ', e.name) SEPARATOR ' + ') AS exam_blocks,
            GROUP_CONCAT(DISTINCT p.name SEPARATOR ', ') AS programs
        FROM majors m
        JOIN exam_block_major meb ON m.id = meb.major_id
        JOIN exam_blocks e ON meb.exam_block_id = e.id
        JOIN program_majors pm ON m.id = pm.major_id
        JOIN programs p ON pm.program_id = p.id
        WHERE m.ten_nganh LIKE ? AND p.year = ?
        GROUP BY m.id, m.ten_nganh, m.description
        ORDER BY m.id ASC
        LIMIT ? OFFSET ?
    ";

    // Sử dụng câu lệnh chuẩn bị để tránh SQL Injection
    $stmt = $conn->prepare($sql);

    // Thay thế dấu hỏi (?) bằng giá trị của biến $search, năm hiện tại, limit và offset
    $searchParam = '%' . $search . '%';
    $stmt->bind_param('ssii', $searchParam, $currentyear, $limit, $offset);

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        // Lấy kết quả từ câu truy vấn
        $resultSet = $stmt->get_result();

        // Duyệt qua từng hàng trong kết quả
        while ($row = $resultSet->fetch_assoc()) {
            $result[] = $row;
        }
    } else {
        // In ra lỗi nếu câu truy vấn thất bại
        echo "Lỗi truy vấn: " . $stmt->error;
    }

    // Đóng câu lệnh
    $stmt->close();

    // Trả về mảng kết quả
    return $result;
}

// count page
function CountTotal_nganhtuyensinh_by_year($conn)
{
    $currentyear = date("Y");

    // Kiểm tra xem năm hiện tại có chương trình tuyển sinh hay không
    $checkTonTai = checkProgramExists($conn, $conn);

    if (!$checkTonTai) {
        $currentyear = $currentyear - 1;
    }

    // Chuẩn bị câu truy vấn SQL để đếm tổng số ngành thỏa mãn điều kiện năm hiện tại
    $sql = "
      SELECT COUNT(*) AS total from programs p JOIN program_majors pm on p.id =pm.program_id WHERE p.year=? 
       
    ";

    // Sử dụng câu lệnh chuẩn bị để tránh SQL Injection
    $stmt = $conn->prepare($sql);

    // Thay thế dấu hỏi (?) bằng giá trị của biến $search và năm hiện tại

    $stmt->bind_param('i', $currentyear);

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        // Lấy kết quả từ câu truy vấn
        $resultSet = $stmt->get_result();
        $row = $resultSet->fetch_assoc();
        $total = $row['total'];
    } else {
        // In ra lỗi nếu câu truy vấn thất bại
        echo "Lỗi truy vấn: " . $stmt->error;
        $total = 0;
    }

    // Đóng câu lệnh
    $stmt->close();

    // Trả về số lượng tổng cộng các ngành
    return $total;
}

// bài chi tiết tuyển sinh từng ngành
function get_item_nganh($conn, $id)
{
    // Khởi tạo mảng chứa kết quả
    $result = [];
    $currentyear = date("Y");

    // Kiểm tra xem năm hiện tại có chương trình tuyển sinh hay không
    $checkTonTai = checkProgramExists($conn, $conn);

    if (!$checkTonTai) {
        $currentyear = $currentyear - 1;
    }

    // Chuẩn bị câu truy vấn SQL để lấy thông tin ngành, khối xét tuyển và chương trình với điều kiện năm hiện tại
    $sql = "
        SELECT 
            pm.major_id,
            m.ten_nganh, 
            m.description, 
            m.img_major,
            pm.cut_off_score,
            p.*,
            GROUP_CONCAT(CONCAT(e.code, ' - ', e.name) SEPARATOR ' + ') AS exam_blocks,
            GROUP_CONCAT(DISTINCT p.name SEPARATOR ', ') AS programs
        FROM majors m
        JOIN exam_block_major meb ON m.id = meb.major_id
        JOIN exam_blocks e ON meb.exam_block_id = e.id
        JOIN program_majors pm ON m.id = pm.major_id
        JOIN programs p ON pm.program_id = p.id
        WHERE m.id=? and p.year = ?
        GROUP BY m.id, m.ten_nganh, m.description
    ";

    // Sử dụng câu lệnh chuẩn bị để tránh SQL Injection
    $stmt = $conn->prepare($sql);

    // Thay thế dấu hỏi (?) bằng giá trị của biến $search, năm hiện tại, limit và offset
    $stmt->bind_param('ii', $id, $currentyear);

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        // Lấy kết quả từ câu truy vấn
        $resultSet = $stmt->get_result();

        // Duyệt qua từng hàng trong kết quả
        while ($row = $resultSet->fetch_assoc()) {
            $result[] = $row;
        }
    } else {
        // In ra lỗi nếu câu truy vấn thất bại
        echo "Lỗi truy vấn: " . $stmt->error;
    }

    // Đóng câu lệnh
    $stmt->close();

    // Trả về mảng kết quả
    return $result;
}
function get_diem_trung_tuyen_3_nam_gan_nhat($conn, $id)
{
    // Lấy năm hiện tại và trừ đi 1
    $currentYear = date("Y") - 1;

    // Chuẩn bị câu truy vấn SQL
    $sql = "
        SELECT 
            pm.cut_off_score, 
            p.year
        FROM 
            program_majors pm
        JOIN 
            programs p ON pm.program_id = p.id
        WHERE 
            pm.major_id = ? 
            AND p.year BETWEEN ? AND ?
        ORDER BY 
            p.year DESC
        LIMIT 3
    ";

    // Sử dụng câu lệnh chuẩn bị để tránh SQL Injection
    $stmt = $conn->prepare($sql);

    // Gán giá trị cho các biến dấu hỏi trong câu truy vấn
    $threeYearsAgo = $currentYear - 2;
    $stmt->bind_param('iii', $id, $threeYearsAgo, $currentYear);

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        // Lấy kết quả từ câu truy vấn
        $result = $stmt->get_result();

        // Khởi tạo mảng chứa kết quả
        $scores = [];
        while ($row = $result->fetch_assoc()) {
            $scores[] = $row;
        }

        return $scores;
    } else {
        // In ra lỗi nếu câu truy vấn thất bại
        echo "Lỗi truy vấn: " . $stmt->error;
    }

    // Đóng câu lệnh
    $stmt->close();

    return [];
}
function check_nop_han_nop_ho_so($conn, $major_id)
{
    $currentYear = date("Y");
    $sql = "
        SELECT pm.id
        FROM program_majors pm
        JOIN programs p ON pm.program_id = p.id
        WHERE pm.major_id = ?
          AND pm.status = 'active'
          AND p.year = ?
    ";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ii", $major_id, $currentYear);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Có bản ghi thỏa mãn điều kiện, trả về true
        return true;
    } else {
        // Không có bản ghi thỏa mãn điều kiện, trả về false
        return false;
    }
}
// check đã nộp hồ sơ cho ngành này trong anmw tuyển sinh này chưa
function hasSubmittedApplication($user_id, $program_id, $major_id, $conn)
{
    $query = "SELECT COUNT(*) as count FROM applications WHERE user_id = ? AND program_id = ? AND major_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $user_id, $program_id, $major_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['count'] > 0;
}
