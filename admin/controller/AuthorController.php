<?php
function getAuthorsListAll($conn)
{
    $listAuthor = getListAuThor_Dto($conn);
    require_once PATH_VIEW_ADMIN . 'author-manager.php';
}

function getAuthorDetail($conn, $id)
{
    $author_item = getAuThor_Dto_byID($conn, $id);
    if ($author_item == null || empty($author_item)) {
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    require_once PATH_VIEW_ADMIN . 'author-detail.php';
}

function authorCreate($conn)
{
    $users = getListTable($conn, "users");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        // Lấy dữ liệu từ form và escape trang sql injection
        $user_id = (int) mysqli_real_escape_string($conn, $_POST["user_id"]);
        $tieusu = mysqli_real_escape_string($conn, $_POST["bio"]);

        $data = [
            'user_id' => $user_id ?? null,
            'Tieusu' => $tieusu ?? null,
            'avatar' => null,
        ];
        $file = $_FILES['avatar'];
        $result = uploadFile('avatar', 'author');
        $data['avatar'] = $result;

        // Validate dữ liệu
        $errors = validate_Create_Author($data, $file);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data_err'] = $data;
            header('Location: index.php?act=author-create');
            exit();
        }
        insert($conn, "authors", $data);

        //Cập nhật lại role trong bảng users (role 3 là người sẽ có quyền viết bài)
        $user_item = getItemByID($conn, "users", $user_id);
        if ($user_item) {
            $user_item["role"] = 3;
            update($conn, "users", $user_item, $user_id);
        }

        $_SESSION['success'] = "Thêm tác giả mới thành công";
        header('Location: index.php?act=authors');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'author-create.php';
}

function authorUpdate($conn, $id)
{
    $users = getListTable($conn, "users");
    $author_item = getAuThor_Dto_byID($conn, $id);
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        $user_id = (int) mysqli_real_escape_string($conn, $_POST["user_id"]);
        $tieusu = mysqli_real_escape_string($conn, $_POST["bio"]);
        $data = [
            'user_id' => $user_id ?? $author_item["user_id"],
            'Tieusu' => $tieusu ?? $author_item["Tieusu"],
            'avatar' => $author_item["avatar"],
        ];
        $file = $_FILES['avatar'];

        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $result = uploadFile('avatar', 'author');
            if ($result) {
                $data['avatar'] = $result;
                deleteFile($author_item["avatar"]);
            }
        }
        // Cập nhật thông tin tác giả
        update($conn, "authors", $data, $id);
        $_SESSION['success'] = "Cập nhật thành công";
        header('Location: index.php?act=authors');
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'author-update.php';
}
function deleteAuthor($conn, $id)
{
    $author_item = getAuThor_Dto_byID($conn, $id);
    deleteFile($author_item["avatar"]); // xóa ảnh cũ

    deleteByID($conn, "authors", $id);
    // và cập nhận lại quyền fole = 0 là memmber
    $user_item = getItemByID($conn, "users", $author_item['user_id']);
    if ($user_item) {
        $user_item["role"] = 0;
        update($conn, "users", $user_item, $author_item['user_id']);
    }
    $_SESSION['success'] = "Xóa thành công";
    header('Location: index.php?act=authors');
    exit();
}
