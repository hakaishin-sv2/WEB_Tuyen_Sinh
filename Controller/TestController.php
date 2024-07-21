<?php
function test($conn, $post_id)
{
    $comments = get_comments_with_replies($conn, $post_id);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $post_id = $_POST['post_id'];
        $parent_id = $_POST['parent_id'] ?? NULL; // Nếu không có parent_id, đặt là NULL
        $comment = $_POST['comment_message'];
        $user_id = 1;

        // Thêm bình luận hoặc câu trả lời
        if (add_comment($conn, $post_id, $parent_id, $user_id, $comment)) {
            echo 'Bình luận của bạn đã được gửi.';
        } else {
            echo 'Có lỗi xảy ra. Vui lòng thử lại.';
        }
    }
    require_once PATH_VIEW_CLIENT . 'test.php';
}
function add_comment($conn, $post_id, $parent_id, $user_id, $comment)
{
    $sql = "INSERT INTO comments (post_id, parent_id, user_id, comment) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiis', $post_id, $parent_id, $user_id, $comment);
    return $stmt->execute();
}
function get_comments_with_replies($conn, $post_id)
{
    $sql = "SELECT * FROM comments WHERE post_id = ? AND parent_id IS NULL ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $comments = [];

    while ($row = $result->fetch_assoc()) {
        $row['replies'] = get_replies($conn, $row['id']);
        $comments[] = $row;
    }

    return $comments;
}

function get_replies($conn, $parent_id)
{
    $sql = "SELECT * FROM comments WHERE parent_id = ? ORDER BY created_at ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $parent_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $replies = [];

    while ($row = $result->fetch_assoc()) {
        $replies[] = $row;
    }

    return $replies;
}
