<?php
function getAlllistPost($conn)
{
    $list_post = getList_DTO_post($conn);
    require_once PATH_VIEW_ADMIN . 'post-manager.php';
}

function get_Postd_item($conn, $id)
{
    $post_dto_item = get_Post_detail($conn, $id);
    if ($post_dto_item == null || empty($post_dto_item)) {
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    require_once PATH_VIEW_ADMIN . 'post-detail.php';
}

function PostCreate($conn)
{
    // Bắt đầu transaction

    mysqli_begin_transaction($conn);
    try {
        $categories = getListTable($conn, "categories");
        $tags = getListTable($conn, "tags");
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
            $title = mysqli_real_escape_string($conn, $_POST["title"]);
            $category_id = (int) mysqli_real_escape_string($conn, $_POST["select_category"]);
            $excerpt = mysqli_real_escape_string($conn, $_POST["excerpt"]);
            $status = (int) mysqli_real_escape_string($conn, $_POST["status"]);
            $is_trending = (int) mysqli_real_escape_string($conn, $_POST["is_trending"]);
            $content =  $_POST["content"];
            if ($_POST["news_type"] == 'foreign') {
                $area = 1;
            } elseif ($_POST["news_type"] == 'domestic') {
                $area = 0;
            } else {
                $area = 10;
            }

            $author_id = $_SESSION["user"]["id"];
            $data = [
                'title' => $title ?? null,
                'category_id' => $category_id ?? null,
                'author_id' => $author_id ?? null,
                'excerpt' => $excerpt ?? null,
                'status' => $status ?? null,
                'is_trending' => $is_trending ?? null,
                'content' => $content ?? null,
                'img_thumbnail' => null,
                'img_cover' => null,
                'area' => $area,
            ];

            // Xử lý upload thumbnail
            $thumbnail = $_FILES['imgthumbnail'];
            if ($thumbnail['error'] == 0) {
                $result = uploadFile('imgthumbnail', 'posts/thumbnails');
                $data['img_thumbnail'] = $result;
            }

            // Xử lý upload cover image
            $cover_image = $_FILES['imgcover'];
            if ($cover_image['error'] == 0) {
                $result = uploadFile('imgcover', 'posts/covers');
                $data['img_cover'] = $result;
            }

            //  Validate dữ liệu
            $errors = validate_Create_Post($data);
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['data_err'] = $data;
                header('Location: index.php?act=post-create');
                exit();
            }

            // Insert dữ liệu vào bảng posts lấy ra id 
            $post_id = insert($conn, "posts", $data);
            // Xử lý thẻ tags
            if (!empty($_POST['tags'])) {
                $tags = $_POST['tags'];
                print_r($tags);
                foreach ($tags as $tag_id) {
                    $tag_data = [
                        'post_id' => $post_id,
                        'tag_id' => (int) $tag_id
                    ];
                    insert($conn, "post_tag", $tag_data);
                }
            }

            // Commit transaction nếu không có lỗi
            mysqli_commit($conn);

            $_SESSION['success'] = "Thêm bài viết mới thành công";
            header('Location: index.php?act=posts');
            exit();
        }

        require_once PATH_VIEW_ADMIN . 'post-create.php';
    } catch (Exception $e) {
        // Rollback transaction nếu có lỗi
        mysqli_rollback($conn);
        // Ghi chi tiết lỗi vào session
        $_SESSION['errors'] = ['message' => 'Đã xảy ra lỗi khi tạo bài viết. Vui lòng thử lại sau.', 'error_detail' => $e->getMessage()];
        header('Location: index.php?act=post-create');
        exit();
    }
}



function PostUpdate($conn, $id)
{

    $post_item = getItemByID($conn, "posts", $id);;
    $categories = getListTable($conn, "categories");
    $tags = getListTable($conn, "tags");
    $post_tags = getTagsByPostID($conn, $id);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        try {
            mysqli_begin_transaction($conn);
            $title = mysqli_real_escape_string($conn, $_POST["title"]);
            $category_id = (int) mysqli_real_escape_string($conn, $_POST["select_category"]);
            $excerpt = mysqli_real_escape_string($conn, $_POST["excerpt"]);
            $status = (int) mysqli_real_escape_string($conn, $_POST["status"]);
            $is_trending = (int) mysqli_real_escape_string($conn, $_POST["is_trending"]);
            $content = $_POST["content"];
            if ($_POST["news_type"] == 'foreign') {
                $area = 1;
            } elseif ($_POST["news_type"] == 'domestic') {
                $area = 0;
            } else {
                $area = 10;
            }
            // Dữ liệu cũ của bài viết
            $data = [
                'title' => $title ?? $post_item["title"],
                'category_id' => $category_id ?? $post_item["category_id"],
                'excerpt' => $excerpt ?? $post_item["excerpt"],
                'status' => $status ?? $post_item["status"],
                'is_trending' => $is_trending ?? $post_item["is_trending"],
                'content' => $content ?? $post_item["content"],
                'updated_at' => date('Y-m-d H:i:s'),
                'area' => $area ?? $post_item["area"],
            ];

            // Xử lý upload ảnh thumbnail nếu có
            if ($_FILES['imgthumbnail']['error'] == 0) {
                $result = uploadFile('imgthumbnail', 'posts/thumbnails');
                if ($result) {
                    $data['img_thumbnail'] = $result;
                    deleteFile($post_item["img_thumbnail"]); // Xóa ảnh cũ
                }
            }

            // Xử lý upload ảnh cover nếu có
            if ($_FILES['imgcover']['error'] == 0) {
                $result = uploadFile('imgcover', 'posts/covers');
                if ($result) {
                    $data['img_cover'] = $result;
                    deleteFile($post_item["img_cover"]); // Xóa ảnh cũ
                }
            }

            // Validate dữ liệu nếu cần

            // Cập nhật thông tin bài viết
            update($conn, "posts", $data, $id);

            // Xử lý các tag
            if (!empty($_POST['tags'])) {
                $tags = $_POST['tags'];
                // Xóa các tag cũ của bài viết
                $delete_tags_query = "DELETE FROM post_tag WHERE post_id = ?";
                $stmt = $conn->prepare($delete_tags_query);
                $stmt->bind_param("i", $id);
                $stmt->execute();

                // Thêm các tag mới
                foreach ($tags as $tag_id) {
                    $tag_data = [
                        'post_id' => $id,
                        'tag_id' => (int) $tag_id
                    ];
                    insert($conn, "post_tag", $tag_data);
                }
            }

            // Commit transaction
            mysqli_commit($conn);

            $_SESSION['success'] = "Cập nhật bài viết thành công";
            header('Location: index.php?act=posts');
            exit();
        } catch (Exception $e) {
            // Rollback transaction nếu có lỗi
            mysqli_rollback($conn);
            $_SESSION['errors'] = ['message' => 'Đã xảy ra lỗi khi cập nhật bài viết. Vui lòng thử lại sau.'];
            header('Location: index.php?act=post-update&id=' . $id);
            exit();
        }
    }

    // Hiển thị form cập nhật bài viết
    require_once PATH_VIEW_ADMIN . 'post-update.php';
}


function deletePost($conn, $post_id)
{
    mysqli_begin_transaction($conn);

    $post_item = getItemByID($conn, "posts", $post_id);

    try {
        // Xóa các bản ghi liên quan từ bảng post_tag
        $stmt = $conn->prepare("DELETE FROM post_tag WHERE post_id = ?");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();

        // Xóa bản ghi từ bảng posts
        $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();

        mysqli_commit($conn);
        $post_item = getItemByID($conn, "posts", $post_id);

        // Kiểm tra và xóa file ảnh thumbnail
        if (!empty($post_item)) {
            deleteFile($post_item['img_thumbnail']);

            // Kiểm tra và xóa file ảnh cover nếu nó không rỗng
            if (!empty($post_item["img_cover"])) {
                deleteFile($post_item["img_cover"]);
            }
        }

        $_SESSION['success'] = "Xóa bài viết thành công.";
        header('Location: index.php?act=posts');
        exit();
    } catch (mysqli_sql_exception $exception) {
        // Rollback transaction nếu có lỗi
        mysqli_rollback($conn);

        echo "Lỗi: Không thể xóa bài viết. Chi tiết: " . $exception->getMessage();
    } finally {
        // Đóng statement
        if (isset($stmt)) {
            $stmt->close();
        }
    }
}


function Phe_duyet_Post($conn, $id)
{
    $post_item = getItemByID($conn, "posts", $id);
    $post_item["status"] = 1;
    update($conn, "posts", $post_item, $id);
    $_SESSION['success'] = "Phê duyệt bài viết thành công";
    header('Location: index.php?act=posts');
    exit();
}
