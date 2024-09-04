<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Chương Trình A</title>
    <!-- Liên kết CSS của Bootstrap 4 -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Thanh điều hướng (Navbar) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Tuyển Sinh 2024</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Trang Chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#register">Đăng Ký</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php

    // print_r($item)
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
                    echo "<li>Lỗi: Không thể giải mã dữ liệu điểm trúng tuyển.</li>";
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