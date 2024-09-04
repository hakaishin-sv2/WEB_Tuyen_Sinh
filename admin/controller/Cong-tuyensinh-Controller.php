<?php

function getListCacNamXetTuyen($conn)
{
    $list =  getListTable($conn, "programs");
    require_once PATH_VIEW_ADMIN . 'list-tuyen-sinh-cac-nam.php';
}

function chi_tiet_tuyen_sinh_by_year($conn, $year)
{
    $list =  getProgramDetails_byYear($conn, $year);
    require_once PATH_VIEW_ADMIN . 'list-cac-nganh-tuyen-sinh-by-year.php';
}
function mo_cong_tuyen_sinh_one_create($conn)
{
    $MajorsList = getMajorsList($conn); // Lấy danh sách ngành học

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = isset($_POST['program_name']) ? mysqli_real_escape_string($conn, $_POST['program_name']) : '';
        $start_date = isset($_POST['start_date']) ? mysqli_real_escape_string($conn, $_POST['start_date']) : '';
        $end_date = isset($_POST['end_date']) ? mysqli_real_escape_string($conn, $_POST['end_date']) : '';
        //$duration = isset($_POST['duration']) ? (int)$_POST['duration'] : 0;
        $majors = isset($_POST['majors']) ? $_POST['majors'] : [];
        $errors = [];
        if (empty($name)) {
            $errors[] = "Vui lòng nhập tên chương trình.";
        }
        if (empty($start_date)) {
            $errors[] = "Vui lòng chọn ngày bắt đầu.";
        }
        if (empty($majors)) {
            $errors[] = "Vui lòng chọn ít nhất một ngành học.";
        }
        // Nếu có lỗi, lưu vào session 
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data_err'] = $_POST;
            header('Location: index.php?act=open-application');
            exit();
        }
        // Dữ liệu để chèn vào bảng programs
        // $currentYear = date('Y');
        $currentYear = 2022;
        $data = [
            'name' => $name,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'year'  =>  $currentYear,
        ];

        // Kiểm tra và xóa chương trình hiện có nếu tồn tại cho năm hiện tại
        // các ngành bổ sung sau sẽ được thêm vào lại

        if (checkProgramExists($conn, $currentYear)) {
            // Kiểm tra nếu có chương trình nào trong năm hiện tại và trạng thái là 'inactive'
            $statusCheckSQL = "SELECT * FROM programs WHERE year = ? AND status = 'inactive'";
            $stmtStatusCheck = mysqli_prepare($conn, $statusCheckSQL);
            if ($stmtStatusCheck) {
                mysqli_stmt_bind_param($stmtStatusCheck, 'i', $currentYear);
                mysqli_stmt_execute($stmtStatusCheck);
                $statusResult = mysqli_stmt_get_result($stmtStatusCheck);
                //  'inactive', thêm lỗi vào sesion này $errors
                if (mysqli_num_rows($statusResult) > 0) {
                    $errors[] = "Chương trình tuyển sinh của năm này đã bị khóa và không thể mở lại.";
                    $_SESSION['errors'] = $errors;
                    $_SESSION['data_err'] = $_POST;
                    header('Location: index.php?act=open-application');
                    exit();
                }

                // Nếu không có chương trình 'inactive', tiếp tục kiểm tra và xóa chương trình 'active'
                mysqli_stmt_close($stmtStatusCheck);
            }

            // Xóa các ngành đang tuyển sinh của năm này có status là 'active'
            $deleteSQL = "DELETE FROM programs WHERE year = ? AND status = 'active'";
            $stmt = mysqli_prepare($conn, $deleteSQL);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'i', $currentYear);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }


        $program_id = insert($conn, "programs", $data);
        foreach ($majors as $major_id) {
            $data_major = [
                'program_id' => $program_id,
                'major_id' => (int)$major_id
            ];
            insert($conn, "program_majors", $data_major);
        }

        $_SESSION['success'] = "Mở cổng tuyển sinh thành công";
        header('Location: index.php?act=list-open-majors');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'mo-cong-tuyen-sinh.php';
}

function close_tuyen_sinh($conn, $year)
{
    // Cập nhật trạng thái của các chương trình tuyển sinh thành 'inactive' trong bảng programs
    $updateProgramsSQL = "UPDATE programs SET status = 'inactive' WHERE year = ?";
    $stmt = mysqli_prepare($conn, $updateProgramsSQL);
    mysqli_stmt_bind_param($stmt, 'i', $year);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Nếu việc cập nhật trạng thái thành công, tiếp tục cập nhật trạng thái trong bảng program_majors
    if ($success) {
        $updateProgramMajorsSQL = "UPDATE program_majors SET status = 'inactive' WHERE program_id IN (SELECT id FROM programs WHERE year = ?)";
        $stmt = mysqli_prepare($conn, $updateProgramMajorsSQL);
        mysqli_stmt_bind_param($stmt, 'i', $year);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if ($success) {
        $_SESSION['success'] = "Chương trình đã được đóng thành công.";
    } else {
        $_SESSION['error'] = "Đã xảy ra lỗi khi đóng chương trình.";
    }

    // Chuyển hướng đến trang danh sách tuyển sinh sau khi thực hiện
    header('Location: index.php?act=list-open-majors');
    exit();
}

function open_tuyen_sinh($conn, $year)
{
    // Lấy tất cả các chương trình của năm hiện tại
    $programs = getListTable($conn, 'programs');

    // Lọc các chương trình theo năm
    $programsToUpdate = array_filter($programs, function ($program) use ($year) {
        return $program['year'] == $year;
    });

    if (empty($programsToUpdate)) {
        $_SESSION['error'] = "Không tìm thấy chương trình nào cho năm $year.";
        return false;
    }

    foreach ($programsToUpdate as $program) {
        // Cập nhật trạng thái chương trình thành 'active'
        $updateProgram = [
            'status' => 'active'
        ];
        $updateResult = update($conn, 'programs', $updateProgram, $program['id']);

        // Cập nhật trạng thái các ngành liên quan trong bảng program_majors thành 'active'
        $updateProgramMajors = [
            'status' => 'active'
        ];
        $majors = getListTable($conn, 'program_majors');
        $majorsToUpdate = array_filter($majors, function ($major) use ($program) {
            return $major['program_id'] == $program['id'];
        });

        foreach ($majorsToUpdate as $major) {
            update($conn, 'program_majors', $updateProgramMajors, $major['id']);
        }
    }

    $_SESSION['success'] = "Chương trình và các ngành liên quan đã được mở thành công.";
    header('Location: index.php?act=list-open-majors');
    exit();
}

function deleteProgramByYear($conn, $year)
{
    $sql = "DELETE FROM programs WHERE year = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        $_SESSION['error'] = "Không thể chuẩn bị câu lệnh xóa: " . mysqli_error($conn);
        return false;
    }
    mysqli_stmt_bind_param($stmt, 'i', $year);
    $success = mysqli_stmt_execute($stmt);
    if ($success) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['success'] = "Xóa thành công kỳ xét tuyển năm  $year";
            mysqli_stmt_close($stmt);
            header('Location: index.php?act=list-open-majors');
            exit();
        } else {
            $_SESSION['error'] = "Không tìm thấy với năm: $year.";
            mysqli_stmt_close($stmt);
            return false;
        }
    } else {
        $_SESSION['error'] = "Lỗi khi thực hiện câu lệnh xóa: " . mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        return false;
    }
}


// Ở phần ẩn hiện nộp hồ sơ từng ngành
function AnHoSoTheoNganh($conn, $id, $year)
{
    $sql = "UPDATE program_majors SET status = 'inactive' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        $_SESSION['error'] = "Không thể chuẩn bị câu lệnh cập nhật: " . mysqli_error($conn);
        return false;
    }
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $success = mysqli_stmt_execute($stmt);
    if ($success) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['success'] = "Cập nhật thành công trạng thái ngành với ID: $id thành inactive.";
            mysqli_stmt_close($stmt);
            // Lấy URL hiện tại
            header("Location: index.php?act=show-tuyen-sinh&year=" . (isset($_GET['year']) ? htmlspecialchars($_GET['year']) : ''));
            exit();
        } else {
            $_SESSION['error'] = "Không tìm thấy ngành với ID: $id.";
            mysqli_stmt_close($stmt);
            // Lấy URL hiện tại
            header("Location: index.php?act=show-tuyen-sinh&year=" . (isset($_GET['year']) ? htmlspecialchars($_GET['year']) : ''));
            exit();
        }
    } else {
        $_SESSION['error'] = "Lỗi khi thực hiện câu lệnh cập nhật: " . mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        return false;
    }
}
function hienHoSoTheoNganh($conn, $id, $year)
{
    $sql = "UPDATE program_majors SET status = 'active' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        $_SESSION['error'] = "Không thể chuẩn bị câu lệnh cập nhật: " . mysqli_error($conn);
        return false;
    }
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $success = mysqli_stmt_execute($stmt);
    if ($success) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['success'] = "Cập nhật thành công hồ sơ ngành với ID $id.";
            mysqli_stmt_close($stmt);
            header("Location: index.php?act=show-tuyen-sinh&year=" . (isset($_GET['year']) ? htmlspecialchars($_GET['year']) : ''));
            exit();
        } else {
            $_SESSION['error'] = "Không tìm thấy ngành với ID: $id.";
            mysqli_stmt_close($stmt);
            header("Location: index.php?act=show-tuyen-sinh&year=" . (isset($_GET['year']) ? htmlspecialchars($_GET['year']) : ''));
            exit();
        }
    } else {
        $_SESSION['error'] = "Lỗi khi thực hiện câu lệnh cập nhật: " . mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        return false;
    }
}
function NhapDiemTrungTuyen($conn, $id_pm)
{
    $list = getProgramDetails_byID($conn, $id_pm); // Lấy chi tiết ngành theo ID

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Kiểm tra xem có dữ liệu từ mảng 'diem' được gửi lên hay không
        if (!empty($_POST['diem']) && is_array($_POST['diem'])) {
            // Bước 1: Lấy điểm trúng tuyển hiện tại từ cơ sở dữ liệu
            $sql = "SELECT cut_off_score FROM program_majors WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Câu truy vấn không thể chuẩn bị: " . $conn->error);
            }
            $stmt->bind_param("i", $id_pm);

            // Khai báo biến để nhận dữ liệu từ câu truy vấn
            $currentScoresJson = null;
            $stmt->execute();
            $stmt->bind_result($currentScoresJson);
            $stmt->fetch();
            $stmt->close();

            // Bước 2: Kiểm tra và khởi tạo giá trị nếu không có dữ liệu
            $currentScores = [];
            if (!empty($currentScoresJson)) {
                // Giải mã JSON thành mảng PHP
                $currentScores = json_decode($currentScoresJson, true);
                if (!is_array($currentScores)) {
                    $currentScores = [];
                }
            }

            // Xem điểm khi chuyển JSON về mảng
            print_r($currentScores);

            // Bước 3: Kiểm tra dữ liệu gửi lên
            $postedScores = $_POST['diem'] ?? [];
            $requiredFields = array_keys($currentScores);  // Các khối xét tuyển cần có điểm
            $isValid = true;

            // Kiểm tra xem tất cả các khối xét tuyển đã được nhập điểm
            foreach ($requiredFields as $field) {
                if (empty($postedScores[$field])) {
                    $_SESSION['errors'][] = "Bạn cần nhập điểm trúng tuyển cho tất cả các khối xét tuyển.";
                    $isValid = false;
                    break;
                }
            }

            // Kiểm tra giá trị điểm nhập vào
            foreach ($postedScores as $field => $diem) {
                if (!is_numeric($diem) || $diem < 15 || $diem > 30) {
                    $_SESSION['errors'][] = "Điểm nhập vào phải nằm trong khoảng từ 15 đến 30. Và cần nhập hét điểm trúng tuyển";
                    $isValid = false;
                    break;
                }
            }

            // Nếu dữ liệu không hợp lệ, quay lại trang nhập điểm
            if (!$isValid) {
                $year = isset($_GET['year']) ? htmlspecialchars($_GET['year']) : '';
                header("Location: index.php?act=nhap-diem-trung-tuyen&id_program_major=" . (isset($_GET['id_program_major']) ? htmlspecialchars($_GET['id_program_major']) : $id_pm) . "&year=" . $year);
                exit();
            }


            // Bước 4: Cập nhật mảng điểm với điểm mới từ POST
            foreach ($postedScores as $khoi => $diem) {
                $currentScores[$khoi] = $diem;
            }

            // Bước 5: Mã hóa lại mảng thành JSON
            $newScoresJson = json_encode($currentScores);

            // Bước 6: Lưu JSON đã cập nhật vào cơ sở dữ liệu
            $sql = "UPDATE program_majors SET cut_off_score = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Câu truy vấn không thể chuẩn bị: " . $conn->error);
            }
            $stmt->bind_param("si", $newScoresJson, $id_pm);
            $stmt->execute();
            $stmt->close();

            $_SESSION['success'] = "Cập nhật điểm trúng tuyển thành công.";
            // Chuyển hướng đến trang kết quả hoặc thông báo thành công
            header("Location: index.php?act=show-tuyen-sinh&year=" . (isset($_GET['year']) ? htmlspecialchars($_GET['year']) : ''));
            exit();
        } else {
            $_SESSION['errors'][] = "Không có dữ liệu điểm nào được nhập.";
            header("Location: index.php?act=nhap-diem-trung-tuyen&id_program_major=" . (isset($_GET['id_program_major']) ? htmlspecialchars($_GET['id_program_major']) : $id_pm));
            exit();
        }
    }

    require_once PATH_VIEW_ADMIN . 'nhap-diem-truyen-tuyen.php';
}
