<?php
function getPendingApplicationsByTeacher($conn, $user_id)
{
    $sql = "
        SELECT 
            p.status AS status_program,
            a.id AS application_id,
            a.major_id,
            a.created_at,
            a.score,
            a.status,
            a.img_cccd,
            a.img_hoc_ba,
            m.industry_code,
            m.ten_nganh,
            u.id AS user_id,
            u.full_name
        FROM 
            teacher_assignment ta
        JOIN 
            applications a ON ta.major_id = a.major_id
        JOIN
            programs p ON a.program_id = p.id
        JOIN 
            majors m ON a.major_id = m.id
        JOIN 
            users u ON a.user_id = u.id
        WHERE 
            ta.teacher_id = ?  -- Điều kiện để lấy ra các ngành học mà giáo viên được giao
            AND a.status = 'pending'  -- Chỉ lấy các bản ghi có status là 'pending'
            AND a.major_id IN (
                SELECT major_id 
                FROM teacher_assignment 
                WHERE teacher_id = ?
            )
        ORDER BY 
            a.created_at DESC
    ";

    if ($stmt = $conn->prepare($sql)) {
        // Bind biến user_id vào câu truy vấn
        $stmt->bind_param('ii', $user_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $applications = [];
        while ($row = $result->fetch_assoc()) {
            $applications[] = $row;
        }

        $stmt->close();
        return $applications;
    } else {
        return null; // Trả về null nếu có lỗi khi chuẩn bị câu truy vấn
    }
}

// đã duyệt
function getApprovedApplicationsByTeacher($conn, $user_id)
{
    $sql = "
        SELECT 
            p.status AS status_program,
            a.id AS application_id,
            a.major_id,
            a.created_at,
            a.score,
            a.status,
            a.img_cccd,
            a.img_hoc_ba,
            m.industry_code,
            m.ten_nganh,
            u.id AS user_id,
            u.full_name
        FROM 
            teacher_assignment ta
        JOIN 
            applications a ON ta.major_id = a.major_id
        JOIN
            programs p ON a.program_id = p.id
        JOIN 
            majors m ON a.major_id = m.id
        JOIN 
            users u ON a.user_id = u.id
        WHERE 
            ta.teacher_id = ?  
            AND a.status = 'approved' 
            AND a.major_id IN (
                SELECT major_id 
                FROM teacher_assignment 
                WHERE teacher_id = ?
            )
         ORDER BY 
            a.created_at DESC
    ";

    if ($stmt = $conn->prepare($sql)) {
        // Bind biến user_id vào câu truy vấn
        $stmt->bind_param('ii', $user_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $applications = [];
        while ($row = $result->fetch_assoc()) {
            $applications[] = $row;
        }

        $stmt->close();
        return $applications;
    } else {
        return null; // Trả về null nếu có lỗi khi chuẩn bị câu truy vấn
    }
}

function getRejectedApplicationsByTeacher($conn, $user_id)
{
    $sql = "
        SELECT 
            p.status AS status_program,
            a.id AS application_id,
            a.major_id,
            a.created_at,
            a.score,
            a.status,
            a.img_cccd,
            a.img_hoc_ba,
            m.industry_code,
            m.ten_nganh,
            u.id AS user_id,
            u.full_name
        FROM 
            teacher_assignment ta
        JOIN 
            applications a ON ta.major_id = a.major_id
        JOIN
            programs p ON a.program_id = p.id  
        JOIN 
            majors m ON a.major_id = m.id
        JOIN 
            users u ON a.user_id = u.id
        WHERE 
            ta.teacher_id = ?  
            AND a.status = 'rejected' 
            AND a.major_id IN (
                SELECT major_id 
                FROM teacher_assignment 
                WHERE teacher_id = ?
            )
         ORDER BY 
            a.created_at DESC
    ";

    if ($stmt = $conn->prepare($sql)) {
        // Bind biến user_id vào câu truy vấn
        $stmt->bind_param('ii', $user_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $applications = [];
        while ($row = $result->fetch_assoc()) {
            $applications[] = $row;
        }

        $stmt->close();
        return $applications;
    } else {
        return null; // Trả về null nếu có lỗi khi chuẩn bị câu truy vấn
    }
}
