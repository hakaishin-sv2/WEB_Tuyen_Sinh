<?php
function get_all_authors($conn)
{
    // Chuẩn bị câu truy vấn để lấy thông tin của tất cả các author
    $query = "
        SELECT 
            a.id,
            a.avatar,
            a.Tieusu,
            u.full_name,
            u.email,
            u.role
        FROM 
            authors a
        JOIN 
            users u ON a.user_id = u.id
        ORDER BY 
            u.role
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

    $authors = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $authors;
}
