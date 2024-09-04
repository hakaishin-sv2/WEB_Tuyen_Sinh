<?php
function getAlllistNganh($conn)
{
    $list = getKhoiNganhDto($conn);
    require_once PATH_VIEW_ADMIN . 'nganh-xet-tuyen-manager.php';
}

function get_Nganh_item($conn, $id)
{
    $post_dto_item = get_item_nganh_xettuyen($conn, $id);
    if ($post_dto_item == null || empty($post_dto_item)) {
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    require_once PATH_VIEW_ADMIN . 'nganh-xet-tuyen-detail.php';
}
function Create_nganh_xettuyen($conn)
{
    // Bắt đầu transaction
    mysqli_begin_transaction($conn);
    $exam_blocks = getListTable($conn, "exam_blocks");
    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
            $industry_code = mysqli_real_escape_string($conn, $_POST["industry_code"]);
            $name = mysqli_real_escape_string($conn, $_POST["name"]);
            $description = mysqli_real_escape_string($conn, $_POST["description"]);

            $exam_blocks = isset($_POST['exam_blocks']) ? $_POST['exam_blocks'] : [];
            $data = [
                'industry_code' => $industry_code,
                'ten_nganh' => $name,
                'description' => $description,
            ];

            // Xử lý upload ảnh
            $uploadResult = uploadFile('image', 'majors');
            if (isset($uploadResult['error'])) {
                $errors[] = $uploadResult['error'];
            } elseif (isset($uploadResult)) {
                $data['img_major'] = "uploads/majors/" . $uploadResult;
            }

            // Validate dữ liệu
            $errors = validate_Create_Nganhxettuyen($data);
            if (empty($exam_blocks)) {
                $errors[] = "Vui lòng chọn các tổ hợp sẽ xét tuyển cho ngành này";
            }

            // Nếu có lỗi, lưu vào session và redirect lại form
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['data_err'] = $data;
                header('Location: index.php?act=nganh-xet-tuyen-create');
                exit();
            }

            // Insert dữ liệu vào bảng majors và lấy id vừa insert
            $major_id = insert($conn, "majors", $data);

            // Insert dữ liệu vào bảng exam_block_major
            if (!empty($exam_blocks)) {
                foreach ($exam_blocks as $block_id) {
                    $exam_block_major_data = [
                        'major_id' => $major_id,
                        'exam_block_id' => (int) $block_id
                    ];
                    insert($conn, "exam_block_major", $exam_block_major_data);
                }
            }

            // Commit transaction nếu không có lỗi
            mysqli_commit($conn);

            $_SESSION['success'] = "Thêm ngành xét tuyển thành công";
            header('Location: index.php?act=nganh-xet-tuyen-list');
            exit();
        }

        require_once PATH_VIEW_ADMIN . 'nganh-xet-tuyen-create.php';
    } catch (Exception $e) {
        // Rollback transaction nếu có lỗi
        mysqli_rollback($conn);
        // Ghi chi tiết lỗi vào session
        $_SESSION['errors'] = ['message' => 'Đã xảy ra lỗi khi tạo ngành xét tuyển. Vui lòng thử lại sau.', 'error_detail' => $e->getMessage()];
        header('Location: index.php?act=nganh-xet-tuyen-create');
        exit();
    }
}


function UpdateMajor($conn, $id)
{
    // Lấy dữ liệu hiện tại của ngành
    $form_data = get_form_data($conn, $id);
    $exam_blocks = get_exam_blocks($conn);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        try {
            // Bắt đầu transaction
            mysqli_begin_transaction($conn);

            // Xử lý dữ liệu từ form
            $industry_code = mysqli_real_escape_string($conn, $_POST["industry_code"]);
            $name = mysqli_real_escape_string($conn, $_POST["name"]);
            $description = mysqli_real_escape_string($conn, $_POST["description"]);

            // Dữ liệu cập nhật
            $data = [
                'industry_code' => $industry_code,
                'ten_nganh' => $name,
                'description' => $description,
            ];

            // Xử lý ảnh mới nếu có
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $imgPath   = uploadFile('image', 'majors');
                // Kiểm tra và xử lý upload file
                if ($imgPath != null || !empty($imgPath)) {
                    // Xóa ảnh cũ nếu có
                    if (!empty($form_data['img_major'])) {
                        deleteFile("../" . $form_data['img_major']);
                    }
                    // Cập nhật đường dẫn ảnh vào dữ liệu
                    $data['img_major'] = "uploads/majors/" . $imgPath;
                } else {
                    // Nếu upload không thành công
                    $_SESSION['errors'][] = 'Không thể tải lên ảnh. Vui lòng thử lại.';
                }
            } elseif (!empty($form_data['img_major'])) {
                // Giữ ảnh cũ nếu không có ảnh mới
                $data['img_major'] = $form_data['img_major'];
            }

            // Cập nhật thông tin ngành
            update($conn, "majors", $data, $id);

            // Xử lý các tổ hợp môn
            if (!empty($_POST['exam_blocks'])) {
                $exam_blocks = $_POST['exam_blocks'];
                // Xóa các tổ hợp môn cũ của ngành
                $delete_blocks_query = "DELETE FROM exam_block_major WHERE major_id = ?";
                $stmt = $conn->prepare($delete_blocks_query);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();

                foreach ($exam_blocks as $block_id) {
                    $block_data = [
                        'major_id' => $id,
                        'exam_block_id' => (int) $block_id
                    ];
                    insert($conn, "exam_block_major", $block_data);
                }
            }

            // Commit transaction
            mysqli_commit($conn);

            $_SESSION['success'] = "Cập nhật ngành thành công";
            header('Location: index.php?act=nganh-xet-tuyen-list');
            exit();
        } catch (Exception $e) {
            // Rollback transaction nếu có lỗi
            mysqli_rollback($conn);
            $_SESSION['errors'] = [
                'message' => 'Đã xảy ra lỗi khi cập nhật ngành. Vui lòng thử lại sau.',
                'details' => $e->getMessage()  // Thêm thông tin chi tiết về lỗi
            ];
            header('Location: index.php?act=nganh-xet-tuyen-update&id=' . $id);
            exit();
        }
    }

    // Hiển thị form cập nhật ngành
    require_once PATH_VIEW_ADMIN . 'nganh-xet-tuyen-update.php';
}
function deleteNganhXetTuyen($conn, $id)
{
    try {
        // Chuẩn bị câu lệnh xóa
        $stmt = $conn->prepare("DELETE FROM majors WHERE id = ?");
        if ($stmt === false) {
            throw new mysqli_sql_exception("Không thể chuẩn bị câu lệnh xóa: " . $conn->error);
        }

        // Liên kết tham số và thực hiện câu lệnh
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Kiểm tra số lượng bản ghi bị ảnh hưởng
        if ($stmt->affected_rows === 0) {
            throw new mysqli_sql_exception("Không tìm thấy bản ghi với ID: " . $id);
        }

        // Lưu thông báo thành công vào session
        $_SESSION['success'] = "Đã xóa ngành học thành công.";
        header('Location: index.php?act=nganh-xet-tuyen-list');
        exit();
    } catch (mysqli_sql_exception $exception) {
        // Lưu thông báo lỗi vào session
        $_SESSION['error'] = "Lỗi: Không thể xóa ngành học. Chi tiết: " . $exception->getMessage();

        // Redirect đến trang lỗi
        header('Location: index.php?act=nganh-xet-tuyen-list');
        exit();
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
