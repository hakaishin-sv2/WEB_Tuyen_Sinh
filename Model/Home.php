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

    $currentYear = date("Y") - 1;


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
    $stmt = $conn->prepare($sql);
    $threeYearsAgo = $currentYear - 2;
    $stmt->bind_param('iii', $id, $threeYearsAgo, $currentYear);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $scores = [];
        while ($row = $result->fetch_assoc()) {
            $scores[] = $row;
        }

        return $scores;
    } else {
        echo "Lỗi truy vấn: " . $stmt->error;
    }

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

// lấy ra các hồ sơ đã nộp
function getlist_nop_ho_so_ca_nhan($user_id, $conn)
{
    // Chuẩn bị câu truy vấn SQL với sắp xếp theo năm giảm dần
    $sql = "
        SELECT 
            p.year,
            p.name AS te_kytuyensinh,
            a.id,
            a.major_id,
            a.user_id,
            MAX(a.created_at) AS created_at,
            MAX(a.score) AS score,
            MAX(a.teacher_review) AS teacher_review,
            MAX(a.status) AS status,
            m.industry_code,
            m.ten_nganh,
            MAX(pm.cut_off_score) AS cut_off_score
        FROM 
            applications a
        JOIN 
            programs p ON a.program_id = p.id
        JOIN 
            majors m ON a.major_id = m.id
        JOIN 
            program_majors pm ON a.major_id = pm.major_id
        WHERE 
            a.user_id = ?
        GROUP BY 
            p.year,
            p.name,
            a.id,
            a.major_id,
            a.user_id,              -- Đảm bảo user_id được nhóm
            m.industry_code,
            m.ten_nganh
        ORDER BY 
            p.year DESC;  -- Sắp xếp theo năm giảm dần
    ";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $applications = [];
        while ($row = $result->fetch_assoc()) {
            $applications[] = [
                'id' => $row['id'],
                'major_id' => $row['major_id'],
                'user_id' => $row['user_id'],  // Đảm bảo user_id được bao gồm
                'year' => $row['year'],
                'te_kytuyensinh' => $row['te_kytuyensinh'],
                'created_at' => $row['created_at'],
                'score' => $row['score'],
                'status' => $row['status'],
                'industry_code' => $row['industry_code'],
                'ten_nganh' => $row['ten_nganh'],
                'teacher_review' => $row['teacher_review'],
                'cut_off_score' => $row['cut_off_score']
            ];
        }

        $stmt->close();
        return $applications;
    } else {
        return null;
    }
}


function getDetailApplicationById($id_hoso, $conn)
{
    $sql = "
        SELECT 
            p.status AS status_progmram,
            p.year,
            p.name as te_kytuyensinh,
            a.id,
            a.user_id,
            a.major_id,
            a.created_at,
            a.score,
            a.status,
            a.img_cccd,
            a.img_hoc_ba,
            a.phone,
            a.address,
            m.industry_code,
            m.ten_nganh
        FROM 
            applications a
        JOIN 
            programs p ON a.program_id = p.id
        JOIN 
            majors m ON a.major_id = m.id
        WHERE 
            a.id = ?
    ";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $id_hoso);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $applicationDetail = $result->fetch_assoc();
        } else {
            $applicationDetail = null;
        }

        $stmt->close();
        return $applicationDetail;
    } else {
        return null;
    }
}


// xóa hồ sơ
function deleteApplicationById($application_id, $conn)
{
    $sql = "DELETE FROM applications WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $application_id);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    } else {
        return false;
    }
}
// Thông báo
function getUserNotifications_top5_new($conn, $user_id, $limit = 5)
{

    $sql = "SELECT id, application_id, message, is_read, created_at 
            FROM notifications 
            WHERE user_id = ? 
            ORDER BY created_at DESC 
            LIMIT ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $user_id, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $notifications = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $notifications;
}
function get_all_thong_bao($conn, $user_id)
{
    // Truy vấn lấy thông báo chưa đọc
    $sql_unread = "SELECT n.id, n.application_id, n.message, n.is_read, n.created_at, 
                          m.industry_code, m.ten_nganh
                   FROM notifications n
                   JOIN applications a ON n.application_id = a.id
                   JOIN majors m ON a.major_id = m.id
                   WHERE n.user_id = ? AND n.is_read = 0 
                   ORDER BY n.created_at DESC";

    $stmt_unread = $conn->prepare($sql_unread);
    $stmt_unread->bind_param('i', $user_id);
    $stmt_unread->execute();
    $result_unread = $stmt_unread->get_result();
    $unread_notifications = $result_unread->fetch_all(MYSQLI_ASSOC);

    // Số lượng thông báo chưa đọc
    $unread_count = count($unread_notifications);

    $stmt_unread->close();

    // Truy vấn lấy thông báo đã đọc
    $sql_read = "SELECT n.id, n.application_id, n.message, n.is_read, n.created_at, 
                        m.industry_code, m.ten_nganh
                 FROM notifications n
                 JOIN applications a ON n.application_id = a.id
                 JOIN majors m ON a.major_id = m.id
                 WHERE n.user_id = ? AND n.is_read = 1 
                 ORDER BY n.created_at DESC";

    $stmt_read = $conn->prepare($sql_read);
    $stmt_read->bind_param('i', $user_id);
    $stmt_read->execute();
    $result_read = $stmt_read->get_result();
    $read_notifications = $result_read->fetch_all(MYSQLI_ASSOC);

    $stmt_read->close();

    // Số lượng thông báo đã đọc
    $read_count = count($read_notifications);

    // Trả về cả danh sách thông báo chưa đọc, đã đọc và số lượng
    return [
        'unread_notifications' => $unread_notifications,
        'unread_count' => $unread_count,
        'read_notifications' => $read_notifications,
        'read_count' => $read_count
    ];
}



// cập nhật đã đọc thông báo
function markNotificationAsRead($conn, $id_thongbao)
{

    $sql = "UPDATE notifications SET is_read = 1 WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_thongbao);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}
