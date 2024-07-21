<?php
function get_posts_by_search($conn, $search, $limit, $offset)
{
    // Chuẩn bị câu truy vấn với điều kiện LIKE để tìm kiếm và bao gồm LIMIT và OFFSET
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
            p.views_count
        FROM 
            posts p
        JOIN 
            authors a ON p.author_id = a.user_id
        JOIN 
            users u ON a.user_id = u.id
        JOIN 
            categories c ON p.category_id = c.id
        WHERE 
           c.name_category LIKE ? OR p.title LIKE ? OR p.content LIKE ? OR p.excerpt LIKE ?
        ORDER BY 
            p.created_at DESC
        LIMIT ? OFFSET ?
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $searchTerm = '%' . $search . '%';
    $stmt->bind_param('ssssii', $searchTerm, $searchTerm, $searchTerm, $searchTerm, $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error executing statement: " . $stmt->error);
    }

    $posts = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $posts;
}

function get_total_posts_count_by_search($conn, $search)
{
    $query = "
        SELECT 
            COUNT(*) AS total_posts
        FROM 
            posts p
        JOIN 
            authors a ON p.author_id = a.user_id
        JOIN 
            users u ON a.user_id = u.id
        JOIN 
            categories c ON p.category_id = c.id
        WHERE 
             c.name_category LIKE ? OR  p.title LIKE ? OR p.content LIKE ? OR p.excerpt LIKE ?
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $searchTerm = '%' . $search . '%';
    $stmt->bind_param('ssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error executing statement: " . $stmt->error);
    }
    $row = $result->fetch_assoc();

    $stmt->close();

    return $row['total_posts'];
}
