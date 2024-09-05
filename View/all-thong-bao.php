<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show All Alerts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        a:hover {
            text-decoration: none;
            color: inherit;
        }

        .list-group .alert-item:hover {
            background-color: #f8f9fc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
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
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
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

        .notification-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            font-size: 0.75rem;
        }

        .unread {
            background-color: #f8f9fc;
        }

        .read {
            background-color: #ffffff;
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">ĐH ABC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" style="margin-right: 3%;">
                <ul class="navbar-nav mr-auto">
                    <!-- Các mục khác (nếu có) sẽ được đặt ở đây -->
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Giới Thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Chương Trình</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cá nhân
                        </a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] == "teacher") : ?>
                                <a class="dropdown-item" href="index.php?act=list-nop-ho-so-chua-duyet">Phê duyệt hồ sơ</a>
                            <?php endif; ?>
                            <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] == "student") : ?>
                                <a class="dropdown-item" href="index.php?act=list-nop-ho-so-ca-nhan">Hồ sơ đã nộp</a>
                            <?php endif; ?>
                            <a class="dropdown-item" href="index.php?act=profile">Profile</a>
                            <a class="dropdown-item" href="index.php?act=change-password">Đổi mật khẩu</a>
                            <a class="dropdown-item" href="index.php?act=logout">Logout</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Khác</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <?php if (!isset($_SESSION["user"])): ?>
                            <a class="nav-link" href="#programs">Đăng ký</a>
                        <?php endif; ?>
                    </li>

                    <?php
                    // Thông báo
                    $notificatios = get_all_thong_bao($conn, $_SESSION["user"]["id"]);
                    $sl_thong_bao = $notificatios["unread_count"];
                    $top5_thong_bao_moi_nhat = getUserNotifications_top5_new($conn, $_SESSION["user"]["id"], $limit = 5);
                    ?>

                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <span class="notification-badge"><?php echo $sl_thong_bao ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Trung Tâm Thông Báo
                            </h6>
                            <?php foreach ($top5_thong_bao_moi_nhat as $notification) {
                                $is_read_class = $notification['is_read'] == 0 ? 'unread' : 'read';
                                $badge_class = $notification['is_read'] == 0 ? 'badge-warning' : 'badge-success';
                                $badge_text = $notification['is_read'] == 0 ? 'Chưa xem' : 'Đã xem';
                                $created_at_formatted = date('d M, Y', strtotime($notification['created_at']));
                            ?>
                                <a class="dropdown-item d-flex align-items-center <?= $is_read_class; ?>" href="index.php?act=chi-tiet-ho-so&id_hoso=<?= $notification['application_id']; ?>&notification_id=<?= $notification['id'] ?>">
                                    <div class="mr-3">
                                        <div class="icon-circle <?= $is_read_class == 'unread' ? 'bg-primary' : 'bg-success'; ?>">
                                            <i class="fas <?= $is_read_class == 'unread' ? 'fa-file-alt' : 'fa-check'; ?> text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-muted small"><?= $created_at_formatted; ?></div>
                                        <span class="font-weight-bold"><?= htmlspecialchars($notification['message']); ?></span>
                                        <span class="badge <?= $badge_class; ?> badge-pill ml-2"><?= $badge_text; ?></span>
                                    </div>
                                </a>
                            <?php } ?>
                            <a class="dropdown-item text-center small text-muted" href="index.php?act=all-thong-bao">Xem Tất Cả Thông Báo</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <h1 class="mb-4">Tất cả Thông Báo</h1>

        <?php
        // Dữ liệu thông báo
        $Thong_bao_chua_xem = $notifications["unread_notifications"];
        $Thong_bao_da_xem = $notifications["read_notifications"];
        ?>

        <!-- Thông báo chưa xem -->
        <?php if ($_SESSION["user"]["role"] === "student") : ?>
            <h2 class="mb-3">Chưa xem</h2>
            <?php foreach ($Thong_bao_chua_xem as $notification) : ?>
                <?php
                $date = date('d/m/Y', strtotime($notification['created_at']));
                $message = htmlspecialchars($notification['message']);
                $is_read_class = $notification['is_read'] == 0 ? 'unread' : '';
                ?>
                <div class="list-group">
                    <a class="dropdown-item d-flex align-items-center <?= $is_read_class; ?>" href="index.php?act=chi-tiet-ho-so&id_hoso=<?= $notification['application_id']; ?>&notification_id=<?= $notification['id']; ?>">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-exclamation-circle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-muted small"><?= $date; ?></div>
                            <span class="font-weight-bold"><?= $message; ?></span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Thông báo đã xem -->
        <?php if ($_SESSION["user"]["role"] === "student") : ?>
            <h2 class="mb-3 mt-5">Đã xem</h2>
            <?php foreach ($Thong_bao_da_xem as $notification) : ?>
                <?php
                $date = date('d/m/Y', strtotime($notification['created_at']));
                $message = htmlspecialchars($notification['message']);
                $is_read_class = $notification['is_read'] == 0 ? 'unread' : 'read';
                ?>
                <div class="list-group">
                    <a class="dropdown-item d-flex align-items-center <?= $is_read_class; ?>" href="index.php?act=chi-tiet-ho-so&id_hoso=<?= $notification['application_id']; ?>&notification_id=<?= $notification['id']; ?>">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-check-circle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-muted small"><?= $date; ?></div>
                            <span class="font-weight-bold"><?= $message; ?></span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>