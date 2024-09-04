<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Hồ Sơ Đã Nộp</title>
    <!-- Liên kết CSS của Bootstrap 4 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="dropdown-item" href="index.php?act=list-nop-ho-so-ca-nhan">Hồ sơ đã nộp</a>
                        <a class="dropdown-item" href="index.php?act=profile">Profile</a>
                        <a class="dropdown-item" href="index.php?act=change-password">Đổi mật khẩu</a>
                        <a class="dropdown-item" href="index.php?act=logout">Logout</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Khác</a>
                    </div>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link" href="#programs">Đăng ký</a>
                </li> -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link " href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="notification-badge">3</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Trung Tâm Thông Báo
                        </h6>
                        <!-- Thông báo chưa xem -->
                        <a class="dropdown-item d-flex align-items-center unread" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="text-muted small">12 Tháng 12, 2019</div>
                                <span class="font-weight-bold">Báo cáo hàng tháng mới đã sẵn sàng để tải xuống!</span>
                                <span class="badge badge-success badge-pill ml-2">Đã xem</span>
                            </div>
                        </a>
                        <!-- Thông báo đã xem -->
                        <a class="dropdown-item d-flex align-items-center read" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="text-muted small">7 Tháng 12, 2019</div>
                                $290.29 đã được chuyển vào tài khoản của bạn!
                            </div>
                        </a>
                        <!-- Thông báo chưa xem -->
                        <a class="dropdown-item d-flex align-items-center unread" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="text-muted small">2 Tháng 12, 2019</div>
                                Cảnh báo Chi Tiêu: Chúng tôi đã nhận thấy chi tiêu bất thường cho tài khoản của bạn.
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-muted" href="#">Xem Tất Cả Thông Báo</a>
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
        <?php //print_r($list)
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
                    $blockWithScore = $block . ' - ' . $scoreText . 'đ';

                    $created_at = date("d/m/Y", strtotime($application['created_at']));

                    // Xử lý trạng thái
                    switch ($application['status']) {
                        case 'pending':
                            $statusText = 'Đang xét duyệt';
                            $statusClass = 'text-warning';
                            break;
                        case 'approved':
                            $statusText = 'Đã phê duyệt';
                            $statusClass = 'text-success';
                            break;
                        case 'rejected':
                            $statusText = 'Bị từ chối';
                            $statusClass = 'text-danger';
                            break;
                        default:
                            $statusText = 'Không xác định';
                            $statusClass = 'text-muted';
                            break;
                    }
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
                            <a href="index.php?act=chi-tiet-ho-so&id_hoso=<?= $application['id']; ?>" class="btn btn-info btn-sm">Xem Chi Tiết</a>
                            <a href="index.php?act=cap-nhat-ho-so&id_hoso=<?= $application['id']; ?>" class="btn btn-warning btn-sm">Cập Nhật</a>
                            <!-- chưa cho xóa -->
                            <!-- <a href="index.php?act=xoa-ho-so-ca-nhan&id_hoso=<?= $application['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa? Và người này sẽ về quyền Member')">Xóa</a> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>


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