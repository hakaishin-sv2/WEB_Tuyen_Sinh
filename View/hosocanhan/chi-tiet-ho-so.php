<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Hồ Sơ</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .status-pending {
            color: #ffc107;
        }

        .status-approved {
            color: #28a745;
        }

        .status-rejected {
            color: #dc3545;
        }

        .thumbnail {
            width: 120px;
            cursor: pointer;
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

        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .preview-image {
            width: 100px;
            /* Kích thước ảnh nhỏ hơn */
            height: 50px;
            /* Kích thước ảnh nhỏ hơn */
            object-fit: cover;
            border-radius: 5px;
        }

        /* CSS cho thông báo chưa xem */
        .unread {
            background-color: #f8f9fc;
            /* Màu nền nhạt để nổi bật */
        }

        /* CSS cho thông báo đã xem */
        .read {
            background-color: #ffffff;
            /* Màu nền trắng để nhạt hơn */
        }

        /* Định dạng icon */
        .icon-circle {
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
    </style>
</head>

<body>
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
                        <?php endif;   ?>
                        <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] == "student") : ?>
                            <a class="dropdown-item" href="index.php?act=list-nop-ho-so-ca-nhan">Hồ sơ đã nộp</a>
                        <?php endif;   ?>
                        <a class="dropdown-item" href="index.php?act=profile">Profile</a>
                        <a class="dropdown-item" href="index.php?act=change-password">Đổi mật khẩu</a>
                        <a class="dropdown-item" href="index.php?act=logout">Logout</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Khác</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <?php
                    if (!isset($_SESSION["user"])): // Đóng dấu ngoặc tròn và bỏ dấu ':' thừa
                    ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#programs">Đăng ký</a>
                </li>
            <?php
                    endif;
            ?>
            </li>
            <?php
            // thong báo
            $notificatios =  get_all_thong_bao($conn, $_SESSION["user"]["id"]);
            $sl_thong_bao = $notificatios["unread_count"];
            $top5_thong_bao_moi_nhat = getUserNotifications_top5_new($conn, $_SESSION["user"]["id"], $limit = 5);
            //print_r($top5_thong_bao_moi_nhat);
            // print_r($x["unread_notifications"]);
            ?>
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link " href="#" id="alertsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="notification-badge"><?php echo $sl_thong_bao ?></span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Trung Tâm Thông Báo
                    </h6>
                    <?php
                    foreach ($top5_thong_bao_moi_nhat as $notification) {
                        $is_read_class = $notification['is_read'] == 0 ? 'unread' : 'read';
                        $badge_class = $notification['is_read'] == 0 ? 'badge-warning' : 'badge-success';
                        $badge_text = $notification['is_read'] == 0 ? 'Chưa xem' : 'Đã xem';
                        $created_at_formatted = date('d M, Y', strtotime($notification['created_at']));
                    ?>
                        <a class="dropdown-item d-flex align-items-center
                         <?= $is_read_class; ?>" href="index.php?act=chi-tiet-ho-so&id_hoso=<?= $notification['application_id']; ?>&notification_id=<?= $notification['id']  ?>">
                            <div class="mr-3">
                                <div class="icon-circle <?= $is_read_class == 'unread' ? 'bg-primary' : 'bg-success'; ?>">
                                    <i class="fas <?= $is_read_class == 'unread' ? 'fa-file-alt' : 'fa-donate'; ?> text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="text-muted small"><?= $created_at_formatted; ?></div>
                                <span class="font-weight-bold"><?= $notification['message']; ?></span>
                                <span class="badge <?= $badge_class; ?> badge-pill ml-2"><?= $badge_text; ?></span>
                            </div>
                        </a>
                    <?php
                    }
                    ?>
                    <a class="dropdown-item text-center small text-muted" href="index.php?act=all-thong-bao">Xem Tất Cả Thông Báo</a>
                </div>



            </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h2 class="mb-4">Chi Tiết Hồ Sơ</h2>
        <?php //print_r($application)   
        ?>
        <div class="row">
            <div class="col-md-6">
                <a href="index.php?act=list-nop-ho-so-ca-nhan" class="btn btn-primary">Quay lại</a>
                <a href="index.php?act=list-nop-ho-so-ca-nhan" class="btn btn-info"> Kiểm Tra trúng tuyển</a>
                <div class="card mb-3">
                    <div class="card-body">

                        <h5 class="card-title">Thông Tin Hồ Sơ</h5>
                        <p><strong>Năm:</strong> <?php echo htmlspecialchars($application['year']); ?></p>
                        <p><strong>Kỳ Tuyển Sinh:</strong> <?php echo htmlspecialchars($application['te_kytuyensinh']); ?></p>
                        <p><strong>Mã Ngành:</strong> <?php echo htmlspecialchars($application['industry_code']); ?></p>
                        <p><strong>Tên Ngành:</strong> <?php echo htmlspecialchars($application['ten_nganh']); ?></p>
                        <p><strong>Khối Xét Tuyển:</strong> <?php
                                                            $scoreData = json_decode($application['score'], true);
                                                            echo htmlspecialchars($scoreData['block'] . ' - ' . implode(', ', array_keys($scoreData['subjects'])));
                                                            ?></p>
                        <p><strong>Điểm:</strong> <?php
                                                    $subjects = $scoreData['subjects'];
                                                    foreach ($subjects as $subject => $score) {
                                                        echo htmlspecialchars($subject . ': ' . $score . ' ');
                                                    }
                                                    ?></p>
                        <p><strong>Ngày Nộp Hồ Sơ:</strong> <?php echo htmlspecialchars(date("d/m/Y", strtotime($application['created_at']))); ?></p>
                        <p><strong>Trạng Thái:</strong> <span class="<?php
                                                                        switch ($application['status']) {
                                                                            case 'pending':
                                                                                echo 'status-pending';
                                                                                break;
                                                                            case 'approved':
                                                                                echo 'status-approved';
                                                                                break;
                                                                            case 'rejected':
                                                                                echo 'status-rejected';
                                                                                break;
                                                                            default:
                                                                                echo 'text-muted';
                                                                                break;
                                                                        }
                                                                        ?>"><?php
                                                                            switch ($application['status']) {
                                                                                case 'pending':
                                                                                    echo 'Đang xét duyệt';
                                                                                    break;
                                                                                case 'approved':
                                                                                    echo 'Đã phê duyệt';
                                                                                    break;
                                                                                case 'rejected':
                                                                                    echo 'Bị từ chối';
                                                                                    break;
                                                                                default:
                                                                                    echo 'Không xác định';
                                                                                    break;
                                                                            }
                                                                            ?></span></p>
                        <p><strong>Số Điện Thoại:</strong> <?php echo htmlspecialchars($application['phone']); ?></p>
                        <p><strong>Địa Chỉ:</strong> <?php echo htmlspecialchars($application['address']); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Ảnh Hồ Sơ</h5>
                        <?php
                        // Giải mã JSON để lấy danh sách ảnh
                        $img_cccd = json_decode($application['img_cccd'], true);
                        $img_hoc_ba = json_decode($application['img_hoc_ba'], true);

                        if (!empty($img_cccd)) {
                            echo '<div class="mb-3">';
                            echo '<strong>Ảnh CCCD:</strong><br>';
                            foreach ($img_cccd as $img) {
                                echo '<a href="' . htmlspecialchars($img) . '" target="_blank">';
                                echo '<img src="' . htmlspecialchars($img) . '" class="thumbnail mb-2" alt="Ảnh CCCD">';
                                echo '</a>';
                            }
                            echo '</div>';
                        }

                        if (!empty($img_hoc_ba)) {
                            echo '<div>';
                            echo '<strong>Ảnh Học Bạ:</strong><br>';
                            foreach ($img_hoc_ba as $img) {
                                echo '<a href="' . htmlspecialchars($img) . '" target="_blank">';
                                echo '<img src="' . htmlspecialchars($img) . '" class="thumbnail mb-2" alt="Ảnh Học Bạ">';
                                echo '</a>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <a href="index.php?act=list-nop-ho-so-ca-nhan" class="btn btn-primary">Quay lại</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>