<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Chương Trình A</title>
    <!-- Liên kết CSS của Bootstrap 4 -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
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
                <?php if (isset($_SESSION["user"])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cá nhân
                        </a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <?php if ($_SESSION["user"]["role"] == "teacher") : ?>
                                <a class="dropdown-item" href="index.php?act=list-nop-ho-so-chua-duyet">Phê duyệt hồ sơ</a>
                            <?php endif; ?>
                            <?php if ($_SESSION["user"]["role"] == "student") : ?>
                                <a class="dropdown-item" href="index.php?act=list-nop-ho-so-ca-nhan">Hồ sơ đã nộp</a>
                            <?php endif; ?>
                            <a class="dropdown-item" href="index.php?act=profile">Profile</a>
                            <a class="dropdown-item" href="index.php?act=change-password">Đổi mật khẩu</a>
                            <a class="dropdown-item" href="index.php?act=logout">Logout</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Khác</a>
                        </div>
                    </li>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <?php
                    if (!isset($_SESSION["user"])): // Đóng dấu ngoặc tròn và bỏ dấu ':' thừa
                    ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="index.php?act=login">Đăng ký</a>
                </li>
            <?php
                    endif;
            ?>
            </li>

            <?php
            if (isset($_SESSION["user"])) {
                $notificatios = get_all_thong_bao($conn, $_SESSION["user"]["id"]);
                $sl_thong_bao = $notificatios["unread_count"];
                $top5_thong_bao_moi_nhat = getUserNotifications_top5_new($conn, $_SESSION["user"]["id"], $limit = 5);
            ?>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="notification-badge"><?php echo $sl_thong_bao; ?></span>
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
                            <a class="dropdown-item d-flex align-items-center <?= $is_read_class; ?>"
                                href="index.php?act=chi-tiet-ho-so&id_hoso=<?= $notification['application_id']; ?>&notification_id=<?= $notification['id']; ?>">
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
            <?php
            }
            ?>

            </ul>
        </div>
    </nav>


    <?php

    //print_r($cutOffScores);
    ?>
    <!-- Tiêu đề Chương Trình -->
    <header class="jumbotron text-center">
        <h1 class="display-4"><?= "Tuyển sinh " . $item[0]["ten_nganh"]  ?></h1>
        <p class="lead">Thông tin chi tiết</p>
    </header>

    <!-- Nội dung chi tiết -->
    <!-- Nút "Nộp Hồ Sơ" -->
    <div class="text-center my-4">
        <a href="index.php?act=nop-ho-so&id=<?= $item[0]['major_id'] ?>" class="btn btn-success btn-lg">Nộp Hồ Sơ</a>
    </div>

    <div class="container my-5">
        <h2>Mô Tả Chương Trình</h2>
        <p><?= htmlspecialchars($item[0]["description"]) ?></p>
        <ul>
            <li class="text-success" style="font-weight: bold;">Ngày bắt đầu: <?= htmlspecialchars($item[0]["start_date"]) ?></li>
            <li class="text-danger" style="font-weight: bold;">Ngày kết thúc: <?= htmlspecialchars($item[0]["end_date"]) ?></li>
        </ul>
        <h3>Yêu Cầu Đầu Vào</h3>
        <ul>
            <li>Tốt nghiệp THPT hoặc tương đương.</li>
            <li>Điểm xét tuyển từ 18 trở lên.</li>
            <li>Đạt yêu cầu trong kỳ thi đánh giá năng lực.</li>
        </ul>

        <!-- <h3>Các Môn Học Chính</h3>
        <ol>
            <li>Môn Cơ Sở Ngành 1</li>
            <li>Môn Cơ Sở Ngành 2</li>
            <li>Môn Chuyên Ngành 1</li>
            <li>Môn Chuyên Ngành 2</li>
        </ol> -->

        <h3>Cơ Hội Nghề Nghiệp</h3>
        <p>Sau khi tốt nghiệp, sinh viên có thể làm việc tại các vị trí như:</p>
        <ul>
            <li>Kỹ sư phần mềm</li>
            <li>Chuyên viên phân tích dữ liệu</li>
            <li>Quản lý dự án CNTT</li>
            <li>Giảng viên tại các trường đại học</li>
        </ul>
        <h3>Điểm trúng tuyển các năm gần đây:</h3>
        <p></p>
        <ul>
            <?php
            print_r($cutOffScores);

            foreach ($cutOffScores as $score) {
                // Giải mã chuỗi JSON thành mảng
                $decodedScores = json_decode($score["cut_off_score"], true);

                if (is_array($decodedScores)) {
                    echo "<li><strong>Năm " . $score["year"] . ":</strong><ul>";
                    foreach ($decodedScores as $subject => $scoreValue) {
                        echo "<li>" . htmlspecialchars($subject) . ": " . htmlspecialchars($scoreValue) . "</li>";
                    }
                    echo "</ul></li>";
                } else {
                    echo "<li>System: chưa có dữ liệu.</li>";
                }
            }
            ?>
        </ul>

        <!-- Nút "Nộp Hồ Sơ" -->
        <div class="text-center my-4">
            <a href="index.php?act=nop-ho-so&id=<?= $item[0]['major_id'] ?>" class="btn btn-success btn-lg">Nộp Hồ Sơ</a>
        </div>



        <!-- Biểu mẫu đăng ký -->
        <!-- <section id="register" class="my-5">
            <h2 class="text-center mb-4">Đăng Ký Tham Gia Chương Trình</h2>
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputName">Họ và Tên</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Nhập họ và tên">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Nhập email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPhone">Số Điện Thoại</label>
                    <input type="tel" class="form-control" id="inputPhone" placeholder="Nhập số điện thoại">
                </div>
                <button type="submit" class="btn btn-primary">Đăng Ký</button>
            </form>
        </section> -->
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