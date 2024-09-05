<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nộp hồ sơ</title>
    <!-- Liên kết CSS của Bootstrap 4 -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .preview-image {
            width: 100px;
            /* Kích thước ảnh nhỏ hơn */
            height: 75px;
            /* Kích thước ảnh nhỏ hơn */
            object-fit: cover;
            border-radius: 5px;
        }

        /* Tiêu đề chính */
        .hero-section {

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

        /* Tiêu đề phần */
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
        }

        /* Thẻ thông tin */
        .info-card {
            background-color: #FFFFFF;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }

        /* Chân trang */
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

        .subject-input {
            margin-top: 10px;
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

    <!-- Tiêu đề Chương Trình -->
    <header class="hero-section">
        <h1>Chi Tiết Chương Trình Tuyển Sinh</h1>
        <!-- <p>Thông tin chi tiết về Chương Trình A.</p> -->
    </header>

    <!-- Nội dung chi tiết -->
    <?php

    //print_r($item);
    // PHP script để định nghĩa dữ liệu môn học
    $subjects = [];

    // Tách dữ liệu dựa trên dấu '+'
    $blocks = explode(' + ', $item[0]["exam_blocks"]);

    foreach ($blocks as $block) {
        // Tách khối thi và môn học
        list($code, $subjectList) = explode(' - ', $block);

        // Tách các môn học và loại bỏ khoảng trắng
        $subjects[$code] = array_map('trim', explode(', ', $subjectList));
    }

    // $subjects = [
    //     'A00' => ['Toán', 'Lý', 'Hóa'],
    //     'A01' => ['Toán', 'Lý', 'Anh'],
    //     'B00' => ['Toán', 'Hóa', 'Sinh'],
    //     'C00' => ['Văn', 'Sử', 'Địa']
    // ];

    ?>
    <div class="container my-5">

        <!-- Form Nộp Hồ Sơ -->
        <section id="apply" class="my-5">
            <h2 class="text-center mb-4">Nộp Hồ Sơ</h2>
            <div class="container">
                <div class="form-section">
                    <div class="form-header">
                        <h3>Ngành: <?= $item[0]["ten_nganh"]  ?></h3>
                    </div>
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
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fullName">Họ và Tên</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Nhập họ và tên" value="<?= $_SESSION["user"]["full_name"] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="<?= $_SESSION["user"]["email"] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số Điện Thoại</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại"
                                value="<?= isset($_SESSION['data_errors']['phone']) ? htmlspecialchars($_SESSION['data_errors']['phone']) : '' ?>" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="dob">Ngày Sinh</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div> -->
                        <div class="form-group">
                            <label for="address">Địa Chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ"
                                value="<?= isset($_SESSION['data_errors']['address']) ? htmlspecialchars($_SESSION['data_errors']['address']) : '' ?>" required>
                        </div>
                        <!-- Tải ảnh CCCD -->
                        <div class="form-group">
                            <label for="cccd">Tải Lên Ảnh CCCD</label>
                            <input type="file" class="form-control-file" id="cccd" name="cccd[]" accept=".jpg, .jpeg, .png" multiple required>
                        </div>
                        <div class="preview-container" id="cccd-preview"></div>

                        <!-- Tải học bạ -->
                        <div class="form-group">
                            <label for="transcripts">Tải Lên Ảnh Học Bạ</label>
                            <input type="file" class="form-control-file" id="transcripts" name="transcripts[]" accept=".jpg, .jpeg, .png" multiple required>
                        </div>
                        <div class="preview-container" id="transcripts-preview"></div>

                        <div class="container my-5">
                            <h2>Chọn Khối Thi và Nhập Điểm</h2>

                            <div id="examForm">
                                <div class="form-group">
                                    <label for="blockSelect">Chọn Khối Thi</label>
                                    <select class="form-control" id="blockSelect" name="blockSelect">
                                        <option value="">-- Chọn Khối Thi --</option>
                                        <?php foreach ($subjects as $code => $subjectList): ?>
                                            <option value="<?= htmlspecialchars($code) ?>">
                                                <?= htmlspecialchars($code) ?> - <?= implode(', ', $subjectList) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div id="subjectsContainer" class="subject-input">
                                    <!-- Các môn sẽ được thêm vào đây -->
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comments">Ghi Chú (Nếu Có)</label>
                            <textarea class="form-control" id="comments" name="comments" rows="4" placeholder="Nhập ghi chú nếu có"><?= isset($_SESSION['data_errors']['review_comments']) ? htmlspecialchars($_SESSION['data_errors']['review_comments']) : '' ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Nộp Hồ Sơ</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Phần phân trang -->
        <!-- <section id="pagination" class="my-5">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </nav>
        </section> -->
    </div>

    <!-- Chân trang (Footer) -->
    <footer class="footer">
        <p>&copy; 2024 Đại học ABC. Bản quyền thuộc về Đại học ABC.</p>
    </footer>

    <!-- Liên kết JS của jQuery và Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript để xem trước ảnh -->
    <script>
        function handleFileSelect(event, previewContainerId) {
            const files = event.target.files;
            const previewContainer = document.getElementById(previewContainerId);
            previewContainer.innerHTML = ''; // Xóa ảnh đã có trong preview

            for (const file of files) {
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('preview-image');
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            }
        }

        document.getElementById('cccd').addEventListener('change', function(event) {
            handleFileSelect(event, 'cccd-preview');
        });

        document.getElementById('transcripts').addEventListener('change', function(event) {
            handleFileSelect(event, 'transcripts-preview');
        });
    </script>


    <script>
        // Chuyển dữ liệu từ PHP sang JavaScript
        const subjects = <?php echo json_encode($subjects); ?>;

        document.getElementById('blockSelect').addEventListener('change', function() {
            const selectedBlock = this.value;
            const subjectsContainer = document.getElementById('subjectsContainer');

            // Clear previous subjects
            subjectsContainer.innerHTML = '';

            if (selectedBlock && subjects[selectedBlock]) {
                subjects[selectedBlock].forEach(subject => {
                    const div = document.createElement('div');
                    div.classList.add('form-group');

                    div.innerHTML = `
                    <label for="${subject}">${subject}</label>
                    <input type="text" class="form-control" id="${subject}" name="subjects[${subject}]" placeholder="Nhập điểm ${subject}">
                `;

                    subjectsContainer.appendChild(div);
                });
            }
        });
    </script>
</body>

</html>