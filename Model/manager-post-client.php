<?php
function validate_Create_Post($data)
{
    $errors = [];

    // Kiểm tra tiêu đề
    if (empty($data['title'])) {
        $errors[] = "Tiêu đề không được để trống.";
    } elseif (strlen($data['title']) < 5) {
        $errors[] = "Tiêu đề phải có ít nhất 5 ký tự.";
    }

    // Kiểm tra danh mục
    if (empty($data['category_id']) || !is_numeric($data['category_id'])) {
        $errors[] = "Danh mục không hợp lệ.";
    }

    // Kiểm tra mô tả ngắn
    if (empty($data['excerpt'])) {
        $errors[] = "Mô tả ngắn không được để trống.";
    } elseif (strlen($data['excerpt']) < 20) {
        $errors[] = "Mô tả ngắn phải có ít nhất 20 ký tự.";
    }

    // Kiểm tra trạng thái
    if (!isset($data['status']) || ($data['status'] != 0 && $data['status'] != 1)) {
        $errors[] = "Trạng thái không hợp lệ.";
    }

    // Kiểm tra is_trending
    if (!isset($data['is_trending']) || ($data['is_trending'] != 0 && $data['is_trending'] != 1)) {
        $errors[] = "Trạng thái trending không hợp lệ.";
    }

    if (empty($data['content'])) {
        $errors[] = "Nội dung không được để trống.";
    }

    // Kiểm tra thumbnail
    if (isset($_FILES['imgthumbnail']) && $_FILES['imgthumbnail']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['imgthumbnail']['type'], $allowed_types)) {
            $errors[] = "Ảnh nhỏ phải có định dạng jpeg, png .";
        }
    } else {
        $errors[] = "Bắt buộc tải 1 ảnh cho bài viết ở mục ảnh nhỏ";
    }

    // Kiểm tra area
    // if (!in_array($data['area'], [0, 1]) ) {
    //     $errors[] = "Bạn cần chọn khu vực tin là 'Tin trong nước' hoặc 'Tin ngoài nước'.";
    // }


    // // Kiểm tra cover image
    // if (isset($_FILES['imgcover']) && $_FILES['imgcover']['error'] == 0) {
    //     $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    //     if (!in_array($_FILES['imgcover']['type'], $allowed_types)) {
    //         $errors[] = "Ảnh cover phải có định dạng jpeg, png .";
    //     }
    // } else {
    //     $errors[] = "Ảnh cover không hợp lệ.";
    // }

    return $errors;
}

// vái trò người tạo bài viết
function getList_DTO_post_by_user_id($conn, $user_id)
{
    $query = "
    SELECT 
        p.id,
        p.title,
        p.area,
        p.excerpt,
        c.name_category AS category_name,
        u.full_name AS author_name,
        u.email AS author_email,
        u.role AS author_role, -- Thêm trường role để xác định vai trò
        p.img_thumbnail,
        p.img_cover,
        p.status,
        p.is_trending,
        p.created_at,
        p.updated_at,
        pd.full_name AS pheduyet_name
    FROM 
        posts p
    JOIN 
        authors a ON p.author_id = a.user_id
    JOIN 
        users u ON a.user_id = u.id
    JOIN 
        categories c ON p.category_id = c.id
    LEFT JOIN 
        users pd ON p.pheduyet_by = pd.id
    WHERE
        u.id = ? -- Điều kiện để lấy các bài viết của người dùng cụ thể
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id); // Liên kết tham số $user_id với câu truy vấn

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        return $posts;
    } else {
        return [];
    }
}


// Vai trò người kiểm duyệt
function getList_DTO_post($conn)
{
    $query = "
    SELECT 
        p.id,
        p.title,
        p.area,
        p.excerpt,
        c.name_category AS category_name,
        u.full_name AS author_name,
        u.email AS author_email,
        p.img_thumbnail,
        p.img_cover,
        p.status,
        p.is_trending,
        p.created_at,
        p.updated_at,
        pd.full_name AS pheduyet_name
    FROM 
        posts p
    JOIN 
        authors a ON p.author_id = a.user_id
    JOIN 
        users u ON a.user_id = u.id
    JOIN 
        categories c ON p.category_id = c.id
    LEFT JOIN 
        users pd ON p.pheduyet_by = pd.id
    WHERE p.status =0;
";


    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        return $posts;
    } else {
        return [];
    }
}

function get_Post_detail($conn, $id)
{
    $query = "
    SELECT 
        p.id,
        p.title,
        p.area,
        p.excerpt,
        p.content,
        c.name_category AS category_name,
        u.full_name AS author_name,
        u.email AS author_email,
        p.img_thumbnail,
        p.img_cover,
        p.status,
        p.is_trending,
        p.created_at,
        p.updated_at,
        pd.full_name AS pheduyet_name
    FROM 
        posts p
    JOIN 
         authors a ON p.author_id = a.user_id
    JOIN 
        users u ON a.user_id = u.id
    JOIN 
        categories c ON p.category_id = c.id
    LEFT JOIN 
        users pd ON p.pheduyet_by = pd.id
    WHERE
        p.id = ?
    ";

    // Chuẩn bị câu truy vấn
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo "Lỗi SQL: " . $conn->error;
        return null;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra kết quả truy vấn
    if ($result->num_rows > 0) {
        $post_dto_item = $result->fetch_assoc(); // Fetch duy nhất một bản ghi
        return $post_dto_item;
    } else {
        return null; // Trả về null nếu không tìm thấy bài viết
    }
}

function getTagsByPostID($conn, $post_id)
{
    $tags = [];

    // Query để lấy các tag của post_id từ bảng post_tag
    $query = "SELECT tag_id FROM post_tag WHERE post_id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Chuẩn bị câu truy vấn thất bại: ' . $conn->error);
    }
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $tags[] = $row['tag_id'];
    }
    $stmt->close();

    return $tags;
}
