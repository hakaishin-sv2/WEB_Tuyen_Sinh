<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Hồ Sơ</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            width: 130px;
            cursor: pointer;
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
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Chi Tiết Hồ Sơ</h2>
        <div class="row">
            <div class="col-md-6">
                <a href="index.php?act=list-nop-ho-so-chua-duyet" class="btn btn-primary">Quay lại</a>
                <?php if ($application["status_program"] !== "inactive"): ?>
                    <a href="index.php?act=phe-duyet-ho-so-by-admin&id_hoso=<?= $application["id"] ?>&user_id=<?= $application["user_id"] ?>" class="btn btn-success" onclick="return confirm('Bạn sẽ duyệt hồ sơ này?')">Phê duyệt</a>
                    <a href="index.php?act=khong-phe-duyet-ho-so-by-admin&id_hoso=<?= $application["id"] ?>&user_id=<?= $application["user_id"] ?>" class="btn btn-danger" id="khongduyet">Không duyệt</a>
                <?php endif; ?>
                <div id="khongDuyetForm" style="display: none; margin-top: 10px;">
                    <form action="" method="POST">
                        <textarea id="reason" name="reason" class="form-control" rows="4" placeholder="Nhập lý do không duyệt"></textarea>
                        <button class="btn btn-primary mt-2" id="submitKhongDuyet" name="submitKhongDuyet">Xác nhận Không duyệt</button>
                    </form>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <?php //($application)
                        ?>
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
                                $imgSrc = "../" . htmlspecialchars($img); // Thêm "../" cho src
                                echo '<a href="' . $imgSrc . '" target="_blank">'; // Giữ nguyên href
                                echo '<img src="' . $imgSrc . '" class="thumbnail mb-2" alt="Ảnh CCCD">'; // Sử dụng $imgSrc cho src
                                echo '</a>';
                            }
                            echo '</div>';
                        }

                        if (!empty($img_hoc_ba)) {
                            echo '<div>';
                            echo '<strong>Ảnh Học Bạ:</strong><br>';
                            foreach ($img_hoc_ba as $img) {
                                $imgSrc = "../" . htmlspecialchars($img); // Thêm "../" cho src
                                echo '<a href="' . $imgSrc . '" target="_blank">'; // Giữ nguyên href
                                echo '<img src="' . $imgSrc . '" class="thumbnail mb-2" alt="Ảnh Học Bạ">'; // Sử dụng $imgSrc cho src
                                echo '</a>';
                            }
                            echo '</div>';
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- <a href="index.php?act=list-nop-ho-so-chua-duyet" class="btn btn-primary">Quay lại</a>
        <a href="index.php?act=phe-duyet-ho-so-by-admin" class="btn btn-success" onclick="return confirm('Bạn sẽ duyệt hồ sơ này?')">Phê duyệt</a>
        <a href="index.php?act=list-nop-ho-so-chua-duyet" class="btn btn-danger" id="khongduyet">Không duyệt</a> -->
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Hiển thị hoặc ẩn form nhập lý do không duyệt
        document.getElementById('khongduyet').addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            var form = document.getElementById('khongDuyetForm');

            // Kiểm tra trạng thái hiển thị của form và thay đổi nó
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block'; // Hiển thị form nếu đang ẩn
            } else {
                form.style.display = 'none'; // Ẩn form nếu đang hiển thị
            }
        });

        document.getElementById('submitKhongDuyet').addEventListener('click', function() {
            var reason = document.getElementById('reason').value;

            if (reason.trim() === '') {
                alert('Vui lòng nhập lý do không duyệt.');
                return;
            }

            // Thực hiện hành động không duyệt (ví dụ: gửi form qua AJAX hoặc chuyển hướng đến URL không duyệt)
        });
    </script>

</body>

</html>