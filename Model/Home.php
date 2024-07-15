<?php
// // Hàm cập nhật view_count và đánh dấu post_id đã được xem
function manage_post_view($conn, $post_id)
{
    if (isset($_SESSION['viewed_posts']) && !in_array($post_id, $_SESSION['viewed_posts'])) {
        $query = "UPDATE posts SET views_count = views_count + 1 WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['viewed_posts'][] = $post_id;

        return false;
    } else {
        return true;
    }
}


// Banner

// Các bài viết tiêu điểm
function get_post_view_biggest($conn)
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
            a.avatar,
            p.status,
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
        WHERE p.status =1

        ORDER BY
            p.views_count DESC
        LIMIT 1
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

    $post = $result->fetch_assoc();

    $stmt->close();

    return $post;
}

function get_top6_new_post($conn)
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
            p.updated_at
        FROM 
            posts p
        JOIN 
            authors a ON p.author_id = a.user_id
        JOIN 
            users u ON a.user_id = u.id
        JOIN 
            categories c ON p.category_id = c.id
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

function get_top5_trending_posts($conn)
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
            p.is_trending = 1 AND p.status =1
        ORDER BY
            p.created_at DESC
        LIMIT 5
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

// Lấy theo Danh Mục bóng đá thế giới 

// Bài có view cao nhất của bóng đá thế  giới
function bai_viet_view_count_nhat_theWorld($conn)
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
           p.area = 1 AND  p.status =1
        ORDER BY
            p.views_count DESC
        LIMIT 1
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

    $post = $result->fetch_assoc();

    $stmt->close();

    return $post;
}

// 6 bài trending và mới nhất
function get_top6_posts_by_category_and_area_theWorld($conn)
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
           p.area = 1 AND p.is_trending = 1 AND p.status =1
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

// 3 bài viết mới nhất của bóng đá ngoài nước
function get_top3_latest_posts_by_category_theWord($conn)
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
           p.area = 1 AND p.status =1
        ORDER BY
            p.created_at DESC
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

// Danh mục Bóng Đá Việt Nam

// Bài viết có view_count cao nhất trong nước
function bai_viet_view_count_nhat_inVietNam($conn)
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
           p.area = 0 AND p.status =1
        ORDER BY
            p.views_count DESC
        LIMIT 1
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

    $post = $result->fetch_assoc();

    $stmt->close();

    return $post;
}

// 6 bài trending và mới nhất trong nước
function get_top6_posts_by_category_and_area_inVietNam($conn)
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
           p.area = 0 AND p.is_trending = 1 AND p.status =1
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

// 3 bài viết mới nhất trong nước
function get_top3_latest_posts_by_category_inVietNam($conn)
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
           p.area = 0 AND p.status =1
        ORDER BY
            p.created_at DESC
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

// Danh mục TQuaanf vợt Tennis

function get_top6_trending_posts_by_category($conn, $category_id)
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
            p.status = 1 AND p.is_trending = 1 AND p.category_id = ?
        ORDER BY
            p.created_at DESC
        LIMIT 6
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $category_id);
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
function get_top6_latest_posts_by_category($conn, $category_id)
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
            p.status = 1 AND p.category_id = ?
        ORDER BY
            p.created_at DESC
        LIMIT 6
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $category_id);
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

function get_top6_posts_by_view_count_and_category($conn, $category_id)
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
            p.status = 1 AND p.category_id = ?
        ORDER BY
            p.views_count DESC
        LIMIT 3
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $category_id);
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


// Các bọ môn thể thao khác
function get_top3_trending_posts_sport_orther($conn)
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
            p.status = 1 AND p.is_trending = 1 AND p.area <> 0 AND p.area <> 1
        ORDER BY
            p.created_at DESC
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

// 6 bài viets mới tạo nhất
function get_top6_latest_posts_sport_orther($conn)
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
            p.status = 1 AND p.area <> 0 AND p.area <> 1 AND p.is_trending=0
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
function get_top3_posts_by_view_count_orther_sport($conn)
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
            p.status = 1 AND p.area <> 0 AND p.area <> 1
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
