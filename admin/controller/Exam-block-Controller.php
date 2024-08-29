<?php
function getExamBlockListAll($conn)
{
    $list = getListTable($conn, "exam_blocks");
    require_once PATH_VIEW_ADMIN . 'exam-block-manager.php';
}

function get_exam_block_Detail($conn, $id)
{
    $tag_item = getItemByID($conn, "exam_blocks", $id);
    if ($tag_item == null || empty($tag_item)) {
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    require_once PATH_VIEW_ADMIN . 'exam-block-detail.php';
}
function exam_blockCreate($conn)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        $name_block = mysqli_real_escape_string($conn, $_POST["name_block"]);
        $tohopxettuyen = mysqli_real_escape_string($conn, $_POST["tohopxettuyen"]);
        $data = [
            'code' => $name_block ?? null,
            'name' => $tohopxettuyen ?? null,
        ];
        $errors = validate_Create_Exam_block($data, $conn);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data_err'] = $data;
            header('Location: index.php?act=exam-block-create');
            exit();
        }
        insert($conn, "exam_blocks", $data);
        $_SESSION['success'] = "Thêm Tổ hợp xét tuyển mới thành công";
        header('Location: index.php?act=exam-block-list');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'exam-block-create.php';
}
function update_exam_block($conn, $id)
{
    $tag_item = getItemByID($conn, "exam_blocks", $id);
    // Kiểm tra phương thức request là POST và không rỗng
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        $name_block = mysqli_real_escape_string($conn, $_POST["name_block"]);
        $tohopxettuyen = mysqli_real_escape_string($conn, $_POST["tohopxettuyen"]);
        if (empty($name_block)) {
            $name_block = $tag_item["name_tag"];
        }
        // Đặt dữ liệu vào mảng
        $data = [
            'code' => $name_block,
            'name' => $tohopxettuyen,
        ];

        // Cập nhật thông tin người dùng
        update($conn, "exam_blocks", $data, $id);
        $_SESSION['success'] = "Cập nhật thành công";
        header('Location: index.php?act=exam-block-list');
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'exam-block-update.php';
}
function deleteTag($conn, $id)
{
    deleteByID($conn, "exam_blocks", $id);
    $_SESSION['success'] = "Xóa thành công";
    header('Location: index.php?act=exam-block-list');
    exit();
}
