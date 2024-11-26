<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Hồ Sơ Đã Nộp</title>
    <!-- Liên kết CSS của Bootstrap 4 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Liên kết Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Bạn có thể thêm CSS tùy chỉnh ở đây */
        .table thead th {
            background-color: #007bff;
            color: white;
        }

        .table td,
        .table th {
            vertical-align: middle;
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

    <!-- Thanh điều hướng (Navbar) -->
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


    <!-- Tiêu đề trang -->
    <header class="jumbotron text-center">
        <h1 class="display-4">Danh sách Hồ Sơ Đã Nộp</h1>
        <p class="lead">Dưới đây là danh sách các hồ sơ mà bạn đã nộp.</p>
    </header>

    <!-- Nội dung chính -->
    <div class="container-fluid my-10">
        <?php if (isset($_SESSION['errors'])): ?>
            <div class="alert alert-danger">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION['errors']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <p><?= htmlspecialchars($_SESSION['success']) ?></p>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <?php //print_r($list[0]);
        ?>
        <table class="table table-striped table-bordered" style="width: 100%;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Năm</th>
                    <th scope="col">Mã ngành</th>
                    <th scope="col">Tên Ngành</th>
                    <th scope="col">Khối xét tuyển</th>
                    <th scope="col">Ngày Nộp</th>
                    <th scope="col">Teacher Review</th>
                    <th scope="col">Trạng Thái</th>
                    <th scope="col">Điểm Chuẩn</th>
                    <th scope="col">Kết Quả</th>
                    <th scope="col">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $index => $application): ?>
                    <?php
                    $scoreData = json_decode($application['score'], true);
                    $block = $scoreData['block'];

                    // Kết hợp block và điểm của từng môn
                    $subjects = $scoreData['subjects'];
                    $scoreText = '';
                    foreach ($subjects as $subject => $score) {
                        $scoreText .= $subject . ': ' . $score . ' ';
                    }
                    $blockWithScore = $block . ' - ' . $scoreText . '';

                    $created_at = date("d/m/Y", strtotime($application['created_at']));

                    // Xử lý trạng thái
                    switch ($application['status']) {
                        case 'pending':
                            $statusText = 'Đang xét duyệt';
                            $statusClass = 'text-warning font-weight-bold';
                            break;
                        case 'approved':
                            $statusText = 'Đã phê duyệt';
                            $statusClass = 'text-success font-weight-bold';
                            break;
                        case 'rejected':
                            $statusText = 'Bị từ chối';
                            $statusClass = 'text-danger font-weight-bold';
                            break;
                        default:
                            $statusText = 'Không xác định';
                            $statusClass = 'text-muted font-weight-bold';
                            break;
                    }

                    // Xử lý điểm trúng tuyển
                    // Lấy danh sách môn học từ mảng subjects và chuyển đổi thành xâu để lấy điểm trúng tuyển theo từng khói
                    $subjects = array_keys($scoreData['subjects']); // lấy các khối xét tuyển của user
                    //print_r($subjects);
                    $subjectsList = implode(', ', $subjects); // Join lại cách nhau dấu ,
                    $result_key = sprintf("%s - %s", $block, $subjectsList);
                    $cutOffScores = json_decode($application['cut_off_score'], true);
                    $diem_trung_tuyen_theo_khoi = $cutOffScores[$result_key] ?? 0;
                    $totalScore = array_sum($scoreData['subjects']);
                    // Kiểm tra nếu không có dữ liệu điểm
                    if ($diem_trung_tuyen_theo_khoi == 0) {
                        $resultClass = 'btn-primary';
                        $resultText = 'Không xác định';
                    } else {
                        // So sánh điểm nếu có dữ liệu
                        if ($totalScore >= $diem_trung_tuyen_theo_khoi) {
                            $resultClass = 'btn-success';
                            $resultText = 'Trúng tuyển';
                        } else {
                            $resultClass = 'btn-danger';
                            $resultText = 'Không trúng tuyển';
                        }
                    }
                    // cách cũ
                    // $totalScore = array_sum($scoreData['subjects']);
                    // //echo $totalScore;
                    // $resultClass = $totalScore >= $diem_trung_tuyen_theo_khoi ? 'btn-success' : 'btn-danger';
                    // $resultText = $totalScore >= $diem_trung_tuyen_theo_khoi ? 'Trúng tuyển' : 'Không trúng tuyển'; 

                    ?>

                    <tr>
                        <th scope="row"><?= $index + 1; ?></th>
                        <td><?= htmlspecialchars($application['year']); ?></td>
                        <td><?= htmlspecialchars($application['industry_code']); ?></td>
                        <td><?= htmlspecialchars($application['ten_nganh']); ?></td>
                        <td><?= htmlspecialchars($blockWithScore); ?></td>
                        <td><?= htmlspecialchars($created_at); ?></td>
                        <td class="text-info font-weight-bold"><?= htmlspecialchars($application['teacher_review']); ?></td>
                        <td class="<?= $statusClass; ?>"><?= htmlspecialchars($statusText); ?></td>
                        <td>
                            <?php
                            if (empty(json_decode($application['cut_off_score'], true))) {
                                echo "chưa cập nhật";
                            } else {
                                $diemTrungTuyen = json_decode($application['cut_off_score'], true);
                                foreach ($diemTrungTuyen as $khoi => $diem) {
                                    echo htmlspecialchars($khoi) . ": " . htmlspecialchars($diem) . " đ" . "<br>";
                                }
                            }
                            ?>
                        </td>
                        <td class="<?= $resultClass; ?>"><?= htmlspecialchars($resultText); ?></td>
                        <td>
                            <a href="index.php?act=chi-tiet-ho-so&id_hoso=<?= $application['id']; ?>" class="btn btn-info btn-sm">Xem Chi Tiết</a>
                            <?php if ($application['status'] === 'pending' || $application['status'] === 'rejected'): ?>
                                <a href="index.php?act=cap-nhat-ho-so&id_hoso=<?= $application['id']; ?>" class="btn btn-warning btn-sm">Cập Nhật</a>
                            <?php endif; ?>


                            <!-- chưa cho xóa -->
                            <!-- <a href="index.php?act=xoa-ho-so-ca-nhan&id_hoso=<?= $application['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa? Và người này sẽ về quyền Member')">Xóa</a> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

            <?php
            //print_r($_SESSION["user"])
            ?>
        </table>
    </div>

    <!-- Chân trang (Footer) -->
    <footer class="bg-primary text-white text-center p-3">
        <p>© 2024 Bản quyền thuộc về Trường Đại Học ABC. Mọi quyền được bảo lưu.</p>
    </footer>

    <!-- Liên kết JavaScript của Bootstrap 4 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>