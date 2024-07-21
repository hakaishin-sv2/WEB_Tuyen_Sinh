<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show All Alerts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        a:hover {
            text-decoration: none;
            color: inherit;
            /* Đảm bảo màu chữ không thay đổi khi hover */
        }

        .list-group .alert-item:hover {
            background-color: #f8f9fc;
            /* Màu nền khi hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Hiệu ứng bóng đổ */
            transform: translateY(-2px);
            /* Di chuyển nhẹ lên trên */
        }


        .alert-item {
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem;
            text-decoration: none;
            color: inherit;
        }

        .alert-item:last-child {
            border-bottom: none;
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-primary {
            background-color: #007bff;
        }

        .bg-success {
            background-color: #28a745;
        }

        .bg-warning {
            background-color: #ffc107;
        }

        .text-gray-500 {
            color: #6c757d;
        }

        .alert-status {
            font-size: 0.75rem;
            margin-left: 0.5rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }

        .alert-status.unread {
            background-color: #ffc107;
            color: #fff;
        }

        .alert-status.read {
            background-color: #28a745;
            color: #fff;
        }

        .alert-item:hover {
            background-color: #f8f9fc;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1 class="mb-4">All Alerts</h1>

        <!-- Chưa xem role người kiểm duyệt 3 người tạo bài mới làm người kiểm duyệt -->
        <?php if ($_SESSION["user"]["role"] == 2) :  ?>
            <h2 class="mb-3">Chưa xem</h2>
            <?php foreach ($Thong_bao_chua_xem as $notification) : ?>
                <?php
                $date = date('d/m/Y', strtotime($notification['created_at']));
                $message = htmlspecialchars($notification['message']);
                $is_read = $notification['is_read'];
                $notification_id = htmlspecialchars($notification['id']);
                $post_id = htmlspecialchars($notification['post_id']);
                $full_name = htmlspecialchars($notification['full_name']);
                ?>
                <div class="list-group">
                    <a class="alert-item d-flex align-items-center <?= $is_read == 0 ? 'unread' : '' ?>" href="index.php?act=post-detail&id=<?= $post_id ?>&notification_id=<?= $notification_id ?>">
                        <div class="mr-3">
                            <div class="icon-circle <?= $is_read == 0 ? '' : 'bg-success' ?>">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500"><?= $date ?></div>
                            <span class="font-weight-bold"><?= $message ?></span>
                            <br>
                            <span class="font-weight-bold text-primary"><?= $full_name ?></span>
                            <span class="alert-status <?= $is_read == 0 ? 'unread' : 'read' ?>">
                                <?= $is_read == 0 ? 'Chưa xem' : 'Đã xem' ?>
                            </span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>


        <?php elseif ($_SESSION["user"]["role"] == 3) :  ?>
            <!-- Thêm các thông báo "Chưa xem" của người viết bài -->
        <?php endif; ?>

        <!-- Đã xem -->

        <?php if ($_SESSION["user"]["role"] == 2) :  ?>
            <h2 class="mt-4 mb-3">Đã xem</h2>
            <?php foreach ($Thong_bao_da_xem as $notification) : ?>
                <?php
                $date = date('d/m/Y', strtotime($notification['created_at']));
                $message = htmlspecialchars($notification['message']);
                $notification_id = htmlspecialchars($notification['id']);
                $post_id = htmlspecialchars($notification['post_id']);
                ?>
                <div class="list-group">
                    <a class="alert-item d-flex align-items-center" href="index.php?act=post-detail&id=<?= $post_id ?>&notification_id=<?= $notification_id ?>">
                        <div class="mr-3">
                            <div class="icon-circle ">
                                <i class="fas fa-donate text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500"><?= $date ?></div>
                            <?= $message ?>
                            <span class="alert-status read">Đã xem</span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php elseif ($_SESSION["user"]["role"] == 3) :  ?>
            <!-- Thêm các thông báo "Đã xem" của người viết bài -->
        <?php endif; ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>