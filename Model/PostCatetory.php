<?php
function get_posts_by_category_paginated($conn, $category_id, $limit, $offset)
{
    // Truy vấn SQL để lấy bài viết phân trang theo danh mục
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
            a.avatar AS author_avatar, 
            p.is_trending,
            p.created_at,
            p.updated_at,
            pd.full_name AS pheduyet_name,
            p.views_count
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
            p.category_id = ?
        ORDER BY
            p.created_at DESC
        LIMIT ? OFFSET ?
    ";

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Liên kết các tham số với câu lệnh SQL
    $stmt->bind_param('iii', $category_id, $limit, $offset);

    // Thực thi câu lệnh SQL
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error executing statement: " . $stmt->error);
    }

    // Lấy tất cả các kết quả và đóng câu lệnh
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $posts;
}

function get_total_posts_count_by_category($conn, $category_id)
{
    $query = "
        SELECT COUNT(*) AS count
        FROM posts
        WHERE category_id = ?
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param('i', $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error executing statement: " . $stmt->error);
    }

    $count = $result->fetch_assoc()['count'];

    $stmt->close();

    return $count;
}
