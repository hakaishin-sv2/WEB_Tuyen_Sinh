<?php
function HomeTeacher_Hoso_ChuaDuyet($conn)
{
    $list = getPendingApplicationsByTeacher($conn, $_SESSION["user"]["id"]);
    require_once PATH_VIEW_CLIENT . 'dashboard_client/ho-so-tuyen-sinh-chua-duyet.php';
}
function HomeTeacher_Hoso_DaDuyet($conn)
{
    $list = getApprovedApplicationsByTeacher($conn, $_SESSION["user"]["id"]);
    require_once PATH_VIEW_CLIENT . 'dashboard_client/ho-so-da-duyet.php';
}

function HomeTeacher_Hoso_Rejected($conn)
{
    $list = getRejectedApplicationsByTeacher($conn, $_SESSION["user"]["id"]);
    require_once PATH_VIEW_CLIENT . 'dashboard_client/ho-so-rejected.php';
}

function chitiet_hoso_by_teacher($conn, $id_hoso)
{
    $application = getDetailApplicationById($id_hoso, $conn);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Kiểm tra nếu form được gửi với tên submitKhongDuyet
        if (isset($_POST['submitKhongDuyet'])) {
            $reason = isset($_POST['reason']) ? trim($_POST['reason']) : '';

            // Kiểm tra dữ liệu hợp lệ
            if (!empty($reason)) {
                // Thực hiện các thao tác cần thiết (như lưu vào cơ sở dữ liệu, v.v.)

                // Ví dụ: Cập nhật trạng thái hồ sơ và thêm thông báo vào cơ sở dữ liệu
                $user_teacher = $_SESSION['user']['id']; // Lấy ID người dùng từ session

                // Thực hiện cập nhật hồ sơ
                $data = [
                    'status' => 'rejected',
                    'reviewer_by_id' => $user_teacher,
                    'teacher_review' => $reason
                ];
                update($conn, "applications", $data, $id_hoso);

                // Thêm thông báo vào cơ sở dữ liệu
                $data_notifications = [
                    'user_id' => $application["user_id"],
                    'application_id' => $id_hoso,
                    'message' => "Hồ sơ của bạn đã bị từ chối. Lý do: $reason",
                ];
                insert($conn, "notifications", $data_notifications);

                // Thiết lập thông báo thành công
                $_SESSION['success'] = "Từ chối hồ sơ thành công với lý do: $reason";

                // Chuyển hướng người dùng đến trang danh sách hồ sơ đã từ chối
                header("Location: index.php?act=list-ho-so-rejected");
                exit();
            } else {
                $_SESSION['error'] = "Lý do không được để trống.";
                header("Location: index.php?act=chi-tiet-ho-so-role-teacher&id_hoso=$id_hoso");
                exit();
            }
        }
    }
    require_once PATH_VIEW_CLIENT . 'dashboard_client/chi-tiet-ho-so.php';
}


function phe_duyet_ho_so($conn, $id_hoso, $user_id)
{
    // Bắt đầu transaction
    $conn->begin_transaction();

    try {
        // Cập nhật trạng thái của hồ sơ
        $data = [
            'status' => "approved",
            'reviewer_by_id' => $_SESSION["user"]["id"],  // Gán ID của người phê duyệt
            'teacher_review' => "Đã tiếp nhận hồ sơ",
        ];

        // Cập nhật hồ sơ
        update($conn, "applications", $data, $id_hoso);

        // Dữ liệu thông báo
        $data_notifications = [
            'user_id' => $user_id,
            'application_id' => $id_hoso,
            'message' => "Hồ sơ của bạn đã được duyệt",
        ];

        // Thêm thông báo
        insert($conn, "notifications", $data_notifications);

        // Commit transaction
        $conn->commit();

        // Thiết lập thông báo thành công
        $_SESSION['success'] = "Phê duyệt hồ sơ thành công";
    } catch (Exception $e) {
        // Rollback transaction nếu có lỗi
        $conn->rollback();

        // Ghi lại lỗi để kiểm tra
        $_SESSION['error'] = "Có lỗi xảy ra: " . $e->getMessage();
    }

    // Điều hướng đến trang danh sách hồ sơ đã duyệt
    header("Location: index.php?act=list-ho-so-daduyet");
    exit(); // Đảm bảo không còn mã nào khác được thực thi sau điều hướng
}
function khong_phe_duyet_ho_so($conn, $id_hoso, $user_id)
{
    // Bắt đầu transaction
    $conn->begin_transaction();

    try {
        // Cập nhật trạng thái của hồ sơ
        $data = [
            'status' => "rejected",
            'reviewer_by_id' => $_SESSION["user"]["id"],  // Gán ID của người phê duyệt
        ];

        // Cập nhật hồ sơ
        update($conn, "applications", $data, $id_hoso);

        // Dữ liệu thông báo
        $data_notifications = [
            'user_id' => $user_id,
            'application_id' => $id_hoso,
            'message' => "Hồ sơ của bạn đã bị từ chối",
        ];

        // Thêm thông báo
        insert($conn, "notifications", $data_notifications);

        // Commit transaction
        $conn->commit();

        // Thiết lập thông báo thành công
        $_SESSION['success'] = "Từ chối hồ sơ thành công";
    } catch (Exception $e) {
        // Rollback transaction nếu có lỗi
        $conn->rollback();

        // Ghi lại lỗi để kiểm tra
        $_SESSION['error'] = "Có lỗi xảy ra: " . $e->getMessage();
    }

    // Điều hướng đến trang danh sách hồ sơ đã từ chối
    header("Location: index.php?act=list-ho-so-tuchoi");
    exit(); // Đảm bảo không còn mã nào khác được thực thi sau điều hướng
}
