<?php

// đếm tát cả thông báo chưa xem
function countUnreadNotifications($conn)
{
    // Câu lệnh SQL để đếm tất cả các thông báo chưa xem
    $query = "
        SELECT COUNT(*) AS unread_count
        FROM notifications
        WHERE is_read = 0
    ";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['unread_count'];
    } else {
        return 0;
    }
}
// Người tạo bài viết
function dem_sl_da_doc_by_userID($conn, $user_id)
{
    // Câu lệnh SQL để đếm tất cả các thông báo với is_read=1 của user
    $query = "
        SELECT COUNT(*) AS read_count
        FROM notifications
        WHERE is_read = 1 AND user_id = ?
       
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['read_count'];
    } else {
        return 0;
    }
}
// chưa fix hàm Thong_bao_da_pheduyet đang error
function Thong_bao_da_pheduyet($conn, $user_id)
{
    $query = "
        SELECT 
            n.id,
            n.post_id,
            n.message,
            n.is_read,
            n.created_at,
            n.update_at,
            u.full_name AS reviewer_name
        FROM 
            notifications n
        JOIN 
            posts p ON n.post_id = p.id
        JOIN 
            users u ON p.pheduyet_by = u.id
        WHERE
            n.is_read = 1 AND n.user_id = ?
        ORDER BY 
            n.update_at DESC
    ";

    // Chuẩn bị câu truy vấn
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra kết quả
    if ($result->num_rows > 0) {
        $notifications = [];
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row;
        }
        return $notifications;
    } else {
        return [];
    }
}

// END function thông báo cho người tạo bài viết

// update trạng thái dã xem thông báo
function updateNotificationStatus($conn, $notification_id)
{
    // Câu lệnh SQL để cập nhật trạng thái is_read thành 1 (đã đọc)
    $query = "
        UPDATE notifications
        SET is_read = 1
        WHERE id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $notification_id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


// top 5 thông báo mới nhất
function top5_Notifications($conn)
{
    // Câu lệnh SQL để lấy tóp 5 thông tin từ bảng notifications và join với bảng users
    $query = "
        SELECT 
            notifications.id,
            notifications.post_id,
            notifications.message,
            notifications.is_read,
            notifications.created_at,
            users.full_name
        FROM 
            notifications
        JOIN 
            users ON notifications.user_id = users.id
        ORDER BY 
            notifications.created_at DESC
        LIMIT 5
    ";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $notifications = [];
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row;
        }
        return $notifications;
    } else {
        // Trả về mảng rỗng nếu không có thông báo nào
        return [];
    }
}
function Thong_bao_chua_xem($conn)
{
    $query = "
        SELECT 
            notifications.id,
            notifications.post_id,
            notifications.message,
            notifications.is_read,
            notifications.created_at,
            users.full_name
        FROM 
            notifications
        JOIN 
            users ON notifications.user_id = users.id
        WHERE
            notifications.is_read = 0
        ORDER BY 
            notifications.created_at DESC
    ";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $notifications = [];
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row;
        }
        return $notifications;
    } else {
        return [];
    }
}

function Thong_bao_da_xem($conn)
{
    $query = "
        SELECT 
            notifications.id,
            notifications.post_id,
            notifications.message,
            notifications.is_read,
            notifications.created_at,
            users.full_name
        FROM 
            notifications
        JOIN 
            users ON notifications.user_id = users.id
        WHERE
            notifications.is_read = 1
        ORDER BY 
            notifications.created_at DESC
    ";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $notifications = [];
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row;
        }
        return $notifications;
    } else {
        return [];
    }
}
