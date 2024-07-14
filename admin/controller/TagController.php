<?php
function getTagListAll($conn){
    $listTags = getListTable($conn,"tags");
    require_once PATH_VIEW_ADMIN. 'tag-manager.php';
}

function getTagDetail($conn,$id){
    $tag_item = getItemByID($conn,"tags",$id);
    if($tag_item==null || empty($tag_item)){
        require_once PATH_VIEW_ADMIN. '404.php';
    }
    require_once PATH_VIEW_ADMIN. 'tag-detail.php';
}
function TagCreate($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
      
            $name_tag = mysqli_real_escape_string($conn, $_POST["name_tag"]);
            $data = [
                'name_tag' => $name_tag ?? null,
            ];
            $errors = validate_Create_Tag($data,$conn);
            if(!empty($errors)){
                $_SESSION['errors'] = $errors;
                $_SESSION['data_err'] = $data;
                header('Location: index.php?act=tag-create');
                exit();
            }
            insert($conn, "tags", $data);
            $_SESSION['success'] = "Thêm User mới thành công";
            header('Location: index.php?act=tags');
            exit();
    }

    require_once PATH_VIEW_ADMIN . 'tag-create.php';
}
function updateTag($conn, $id) {
    $tag_item = getItemByID($conn, "tags", $id);
    // Kiểm tra phương thức request là POST và không rỗng
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        $name_tag_new = mysqli_real_escape_string($conn, $_POST["name_tag_new"]);
        if(empty($name_tag_new)){
            $name_tag_new = $category_item["name_tag"];
        }
        // Đặt dữ liệu vào mảng
        $data = [
            'name_tag' => $name_tag_new,
        ];

        // Cập nhật thông tin người dùng
        update($conn, "tags", $data, $id);
        $_SESSION['success'] = "Cập nhật thành công";
        header('Location: index.php?act=tags');
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'tag-update.php';
}
function deleteTag($conn, $id) {
    deleteByID($conn,"tags",$id);
    $_SESSION['success'] = "Xóa thành công";
    header('Location: index.php?act=tags');
    exit();
}