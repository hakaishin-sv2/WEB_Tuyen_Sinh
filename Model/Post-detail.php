<?php
function get_tags_by_post_id($conn, $post_id)
{
    $post_id = intval($post_id); // Chuyển đổi $post_id thành số nguyên để bảo mật
    $sql = "
        SELECT t.id AS tag_id, t.name_tag AS tag_name
        FROM post_tag pt
        JOIN tags t ON pt.tag_id = t.id
        WHERE pt.post_id = ?
    ";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $tags = [];
        while ($row = $result->fetch_assoc()) {
            $tags[] = [
                'tag_id' => $row['tag_id'],
                'tag_name' => $row['tag_name']
            ];
        }
        $stmt->close();

        return $tags;
    } else {
        return false;
    }
}
function get_post_by_id($conn, $post_id)
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
            a.avatar,
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
            p.id = ?
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error executing statement: " . $stmt->error);
    }

    $post = $result->fetch_assoc();

    $stmt->close();

    return $post;
}
function get_top3_posts_view_lonnhat($conn)
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
            a.avatar,
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
            p.status = 1
        ORDER BY
            p.views_count DESC
        LIMIT 3
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error executing statement: " . $stmt->error);
    }

    $posts = [];
    while ($post = $result->fetch_assoc()) {
        $posts[] = $post;
    }

    $stmt->close();

    return $posts;
}
function get_top6_latest_posts($conn)
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
            a.avatar,
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
            p.status = 1
        ORDER BY
            p.created_at DESC
        LIMIT 6
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error executing statement: " . $stmt->error);
    }

    $posts = [];
    while ($post = $result->fetch_assoc()) {
        $posts[] = $post;
    }

    $stmt->close();

    return $posts;
}

function get_top6_posts_by_view_count($conn)
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
            a.avatar,
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
            p.status = 1
        ORDER BY
            p.views_count DESC
        LIMIT 6
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error executing statement: " . $stmt->error);
    }

    $posts = [];
    while ($post = $result->fetch_assoc()) {
        $posts[] = $post;
    }

    $stmt->close();

    return $posts;
}
