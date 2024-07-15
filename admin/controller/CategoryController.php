<?php
function getCategoryListAll($conn)
{
    $listCategorys = getListTable($conn, "categories");
    require_once PATH_VIEW_ADMIN . 'category-manager.php';
}

function getcategoryDetail($conn, $id)
{
    $category_item = getItemByID($conn, "categories", $id);
    if ($category_item == null || empty($category_item)) {
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    require_once PATH_VIEW_ADMIN . 'category-detail.php';
}
function categoryCreate($conn)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        echo "dcmm";
        $name_category = mysqli_real_escape_string($conn, $_POST["name_category"]);
        $data = [
            'name_category' => $name_category ?? null,
        ];
        $errors = validate_Create_Category($data, $conn);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data_err'] = $data;
            header('Location: index.php?act=category-create');
            exit();
        }
        insert($conn, "categories", $data);
        $_SESSION['success'] = "Thêm Danh Mục mới thành công";
        header('Location: index.php?act=categories');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'category-create.php';
}
function categoryUpdate($conn, $id)
{
    $category_item = getItemByID($conn, "categories", $id);

    // Kiểm tra phương thức request là POST và không rỗng
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        $name_category_new = mysqli_real_escape_string($conn, $_POST["name_category_new"]);

        $data = [
            'name_category' => $name_category_new ?? $category_item["name_category"],
        ];

        // Cập nhật thông tin người dùng
        update($conn, "categories", $data, $id);
        $_SESSION['success'] = "Cập nhật thành công";
        header('Location: index.php?act=categories');
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'category-update.php';
}
function deleteCategory($conn, $id)
{
    deleteByID($conn, "categories", $id);
    $_SESSION['success'] = "Xóa thành công";
    header('Location: index.php?act=categories');
    exit();
}
