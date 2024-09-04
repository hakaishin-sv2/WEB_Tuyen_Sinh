<?php
function validate_Create_Author($data, $file)
{
    //     $errors = [];
    //     if (empty($data["user_id"])) {
    //         $errors[] = "Cần nhập chọn tác giả";
    //     }
    //     if (!empty($data["Tieusu"]) && strlen($data["Tieusu"]) > 500) {
    //         $errors[] = "Tiểu sử tác giả ghi ngắn thôi";
    //     }
    //     if (isset($file) && $file['error'] == UPLOAD_ERR_OK) {
    //         $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    //         $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    //         if (!in_array($fileExtension, $allowedExtensions)) {
    //             $errors[] = "File tải lên phải là ảnh (jpg, jpeg, png, gif)!";
    //         }

    //         if ($file['size'] <= 0) {
    //             $errors[] = "File tải lên phải có kích thước lớn hơn 0!";
    //         }

    //         $maxFileSize = 2 * 1024 * 1024; // max size là 2MB
    //         if ($file['size'] > $maxFileSize) {
    //             $errors[] = "Kích thước file tải lên không được vượt quá 2MB!";
    //         }
    //     }

    //     return $errors;
}


function getTeachersList($conn)
{
    $sql = "SELECT id, full_name, email
            FROM users
            WHERE role = 'teacher'";

    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        return null;
    }

    $teachers = [];
    if (mysqli_num_rows($result) > 0) {
        while ($teacher = mysqli_fetch_assoc($result)) {
            $teachers[] = $teacher;
        }
    }

    mysqli_free_result($result);
    return $teachers;
}

function getMajorsList($conn)
{
    $sql = "SELECT id,industry_code, ten_nganh
            FROM majors";

    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        return null;
    }

    $majors = [];
    if (mysqli_num_rows($result) > 0) {
        while ($major = mysqli_fetch_assoc($result)) {
            $majors[] = $major;
        }
    }

    mysqli_free_result($result);
    return $majors;
}
function getTeacherDetailsList($conn)
{
    $sql = "
        SELECT 
            ta.id,
            u.id AS teacher_id,
            u.img_user,
            u.full_name,
            u.email,
            GROUP_CONCAT(m.ten_nganh SEPARATOR '+ ') AS majors_responsible
        FROM users u
        INNER JOIN teacher_assignment ta ON u.id = ta.teacher_id
        INNER JOIN majors m ON ta.major_id = m.id
        WHERE u.role = 'teacher'
        GROUP BY u.id, u.img_user, u.full_name, u.email
    ";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        die('Error preparing the SQL statement: ' . mysqli_error($conn));
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $teachers = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($teacher = mysqli_fetch_assoc($result)) {
            $teachers[] = $teacher;
        }
    }

    mysqli_stmt_close($stmt);
    return $teachers;
}
function getTeacherDetailsById($conn, $id)
{
    $sql = "
        SELECT 
            ta.id,
            u.id AS teacher_id,
            u.img_user,
            u.full_name,
            u.email,
            GROUP_CONCAT(m.ten_nganh SEPARATOR '+ ') AS majors_responsible
        FROM users u
        INNER JOIN teacher_assignment ta ON u.id = ta.teacher_id
        INNER JOIN majors m ON ta.major_id = m.id
        WHERE u.role = 'teacher' AND u.id = ?
        GROUP BY u.id, u.img_user, u.full_name, u.email
    ";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        die('Error preparing the SQL statement: ' . mysqli_error($conn));
    }

    // Bind the $id parameter to the statement
    mysqli_stmt_bind_param($stmt, 'i', $id);

    // Execute the statement
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $teachers = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($teacher = mysqli_fetch_assoc($result)) {
            $teachers[] = $teacher;
        }
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    return $teachers;
}


function getCacNganhGiaoVienDuocDuyetHoSo($conn, $teacher_id)
{
    $sql = "
        SELECT 
            ta.major_id
        FROM 
            teacher_assignment ta
        WHERE 
            ta.teacher_id = ?
    ";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        die('Error preparing the SQL statement: ' . mysqli_error($conn));
    }

    // Bind the $teacher_id parameter to the statement
    mysqli_stmt_bind_param($stmt, 'i', $teacher_id);

    // Execute the statement
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $majors = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($major = mysqli_fetch_assoc($result)) {
            $majors[] = $major;
        }
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    return $majors;
}

// lấy danh sách các role teacher mà chưa được giao duyệt hồ sơ ngành nào
/*
SQL test
SELECT *
FROM users u
WHERE u.role = 'teacher'
  AND NOT EXISTS (
    SELECT 1
    FROM teacher_assignment at
    WHERE at.teacher_id = u.id
  )
LIMIT 0, 25;

*/
// các role teacher mà chưa được giao
function getTeachersNotInAssignment($conn)
{
    $sql = "
        SELECT *
        FROM users u
        WHERE u.role = 'teacher'
          AND NOT EXISTS (
            SELECT 1
            FROM teacher_assignment at
            WHERE at.teacher_id = u.id
          )
        LIMIT 0, 25;
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Lấy tất cả kết quả
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}
