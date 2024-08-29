<?php
function getTeacherToMajorList($conn)
{
    $list = getTeacherDetailsList($conn);
    require_once PATH_VIEW_ADMIN . 'assign-teacher-manager-list.php';
}

function getTeacherToMajorDetail($conn, $id)
{
    $author_item = getTeacherDetailsById($conn, $id);
    if ($author_item == null || empty($author_item)) {
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    require_once PATH_VIEW_ADMIN . 'assign-teacher-detail.php';
}
function assignTeacherToMajor($conn)
{
    $users = getTeachersList($conn); // Lấy danh sách giáo viên
    $MajorsList = getMajorsList($conn); // Lấy danh sách ngành học

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form và escape để phòng ngừa SQL injection
        $user_id = isset($_POST['user_id']) ? (int) mysqli_real_escape_string($conn, $_POST['user_id']) : null;
        $majors = isset($_POST['majors']) ? $_POST['majors'] : []; // Mảng ngành học được chọn

        // Kiểm tra dữ liệu đầu vào
        if (!$user_id || empty($majors)) {
            $_SESSION['errors'] = ['Vui lòng chọn người dùng và ít nhất một ngành học.'];
            header('Location: index.php?act=assign-teacher-create');
            exit();
        }

        // Xóa các bản ghi cũ để đảm bảo không có xung đột
        $sql = "DELETE FROM teacher_assignment WHERE teacher_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Chèn dữ liệu mới vào bảng teacher_assignment
        foreach ($majors as $major_id) {
            $sql = "INSERT INTO teacher_assignment (teacher_id, major_id) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ii', $user_id, $major_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        // // Cập nhật vai trò của người dùng nếu cần
        // $user_item = getItemByID($conn, "users", $user_id);
        // if ($user_item) {
        //     $user_item["role"] = 3; // Giả sử role 3 là giáo viên xét hồ sơ
        //     update($conn, "users", $user_item, $user_id);
        // }

        $_SESSION['success'] = "Giao quyền kiểm duyệt hồ sơ thành công";
        header('Location: index.php?act=assign-teachers');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'assign-teacher.php';
}

function assignTeacherToMajorUpdate($conn, $teacher_id)
{
    $user = getItemByID($conn, "users", $teacher_id);
    $MajorsList = getMajorsList($conn);
    $NganhGiaoVienduocduyethoso = getCacNganhGiaoVienDuocDuyetHoSo($conn, $teacher_id);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //escape để phòng ngừa SQL injection
        $majors = isset($_POST['majors']) ? $_POST['majors'] : [];
        if (empty($majors)) {
            $_SESSION['errors'] = ['Vui lòng chọn ít nhất một ngành học.'];
            header('Location: index.php?act=assign-teacher-update&id=' . $teacher_id);
            exit();
        }
        // xóa các bản ghi cũ 
        $sql = "DELETE FROM teacher_assignment WHERE teacher_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $teacher_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            die('Error preparing the SQL statement: ' . mysqli_error($conn));
        }

        // Chèn dữ liệu mới vào bảng teacher_assignment
        foreach ($majors as $major_id) {
            $sql = "INSERT INTO teacher_assignment (teacher_id, major_id) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ii', $teacher_id, $major_id); // Sử dụng $teacher_id
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                die('Error preparing the SQL statement: ' . mysqli_error($conn));
            }
        }

        // Cập nhật vai trò của người dùng nếu cần
        // $user_item = getItemByID($conn, "users", $teacher_id);
        // if ($user_item) {
        //     $user_item["role"] = 3; // Giả sử role 3 là giáo viên xét hồ sơ
        //     update($conn, "users", $user_item, $teacher_id);
        // }

        $_SESSION['success'] = "Cập nhật ngành học cho giáo viên thành công.";
        header('Location: index.php?act=assign-teachers');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'assign-teacher-update.php';
}

function deleteTeacherAssignments($conn, $teacher_id)
{
    // Xóa các bản ghi liên quan đến giáo viên trong bảng teacher_assignment
    $sql = "DELETE FROM teacher_assignment WHERE teacher_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $teacher_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        die('Error preparing the SQL statement: ' . mysqli_error($conn));
    }

    // Cập nhật vai trò của người dùng, nếu cần
    // $user_item = getItemByID($conn, "users", $teacher_id);
    // if ($user_item) {
    //     $user_item["role"] = 0; // Giả sử role 0 là Member
    //     update($conn, "users", $user_item, $teacher_id);
    // }

    $_SESSION['success'] = "Xóa vai trò duyệt hồ sơ thành công ";
    header('Location: index.php?act=assign-teachers');
    exit();
}
