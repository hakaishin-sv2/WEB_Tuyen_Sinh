<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuyển Sinh 2024 - Trường Đại Học ABC</title>
    <!-- Liên kết CSS của Bootstrap 4 -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Liên kết Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- CSS tùy chỉnh -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #2C3E50;
        }

        /* Thanh điều hướng */
        .navbar {
            background-color: #2C3E50;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #FFFFFF !important;
        }

        /* Tiêu đề chính */
        .hero-section {
            background-image: url('hero-background.jpg');
            /* Thay thế bằng đường dẫn đến ảnh của bạn */
            background-size: cover;
            background-position: center;
            color: #FFFFFF;
            padding: 120px 0;
            text-align: center;
            position: relative;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Mờ nền với màu đen nửa trong suốt */
            z-index: -1;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
            /* Đặt bóng cho văn bản */
        }

        .hero-section p {
            font-size: 1.2rem;
            margin-top: 20px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            /* Đặt bóng cho văn bản */
        }

        .btn-apply {
            background-color: #F1C40F;
            color: #2C3E50;
            font-weight: 700;
            padding: 10px 20px;
            border-radius: 5px;
        }

        /* Các phần khác */
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
        }

        .info-card {
            background-color: #FFFFFF;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .footer {
            background-color: #2C3E50;
            color: #FFFFFF;
            padding: 20px 0;
            text-align: center;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .pagination {
            justify-content: center;
        }

        .nav-menu {
            background-color: #2C3E50;
            color: #FFFFFF;
            padding: 15px;
        }

        .nav-menu a {
            color: #FFFFFF;
        }

        .info-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
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
                    <a class="nav-link" href="#home">Trang Chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Giới Thiệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#programs">Chương Trình</a>
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
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#programs">Đăng ký</a>
                </li>
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

    <!-- Phần tiêu đề chính (Hero Section) -->
    <header class="hero-section" id="home">
        <div class="container">
            <h1>Chào Mừng Đến Với ĐH ABC</h1>
            <p>Đăng ký ngay để khám phá cơ hội học tập và phát triển tại một trong những trường đại học hàng đầu.</p>
            <form class="form-inline mt-4" method="GET">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Tìm kiếm" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Tìm</button>
            </form>

        </div>
    </header>

    <!-- Phần giới thiệu -->
    <section class="container my-5" id="about">
        <h2 class="section-title">Về Chúng Tôi</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="info-card">
                    <h4>Chất Lượng Giảng Dạy</h4>
                    <p>Đội ngũ giảng viên có trình độ cao, tận tâm và nhiệt huyết, đảm bảo mang lại kiến thức vững chắc cho sinh viên.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card">
                    <h4>Môi Trường Học Tập</h4>
                    <p>Hệ thống cơ sở vật chất hiện đại, thư viện phong phú, tạo môi trường học tập tốt nhất cho sinh viên.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card">
                    <h4>Cơ Hội Nghề Nghiệp</h4>
                    <p>Hỗ trợ sinh viên kết nối với các nhà tuyển dụng hàng đầu, mở ra nhiều cơ hội việc làm sau khi tốt nghiệp.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Phần chương trình học -->
    <section class="bg-light py-5" id="programs">
        <div class="container">
            <h2 class="section-title">Chương Trình Đào Tạo Và Tuyển Sinh</h2>
            <a href="index.php" class="btn btn-apply">Hiển thị tất cả</a>
            <form class="form-inline mt-4" method="GET">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Tìm kiếm" aria-label="Search"
                    value=" <?php echo isset($_SESSION["text_search"]) ? htmlspecialchars($_SESSION["text_search"]) : ""; ?>">
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="btn_search_nganh_tuyen_sinh">Tìm</button>
            </form>

            <?php if (isset($_SESSION["text_search"])): ?>
                <div class="search-results">
                    <h5>Kết quả tìm kiếm với từ khóa: <span class="highlighted-keyword">
                            <?php echo htmlspecialchars($_SESSION["text_search"]); ?>
                        </span></h5>
                    <!-- Thêm các kết quả tìm kiếm ở đây -->
                </div>
                <?php unset($_SESSION["text_search"]); ?>
            <?php endif; ?>
            <?php //print_r($result[5]);
            ?>
            <div class="row">
                <?php foreach ($result as $item): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card" style="cursor: pointer;" onclick="window.location.href='index.php?act=xem-chi-tiet-nganh-tuyen-sinh&id=<?= $item['id'] ?>'">
                            <img src="<?= $item['img_major'] ?>" class="card-img-top" alt="Chương Trình A" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Tuyển sinh <?= htmlspecialchars($item['ten_nganh']) . "-" . htmlspecialchars($item['year']) ?> </h5>
                                <p class="card-text"><?= htmlspecialchars($item['description']) ?></p>
                                <a href="index.php?act=xem-chi-tiet-nganh-tuyen-sinh&id=<?= $item['id'] ?>" class="btn btn-primary">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Phân trang -->
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <!-- Trang trước -->
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= ($page > 1) ? '?page=' . ($page - 1) : '#' ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <!-- Các số trang -->
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Trang sau -->
                            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= ($page < $totalPages) ? '?page=' . ($page + 1) : '#' ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </section>

    <!-- Phần nộp hồ sơ -->
    <section class="container my-5" id="apply">
        <h2 class="section-title">Đăng Ký Nhập Học</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="info-card">
                    <form action="submit_application.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fullName">Họ và tên</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="program">Chương trình học</label>
                            <select class="form-control" id="program" name="program" required>
                                <option value="">Chọn chương trình</option>
                                <option value="program-a">Chương Trình A</option>
                                <option value="program-b">Chương Trình B</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="resume">Tải hồ sơ (CV)</label>
                            <input type="file" class="form-control-file" id="resume" name="resume">
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi Hồ Sơ</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Phần chân trang -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Trường Đại Học ABC. Bảo lưu tất cả các quyền.</p>
        </div>
    </footer>

    <!-- Liên kết JavaScript của Bootstrap 4 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>