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
            width: 200px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Chi Tiết Hồ Sơ</h2>
        <div class="row">
            <div class="col-md-6">
                <a href="index.php?act=list-nop-ho-so-ca-nhan" class="btn btn-primary">Quay lại</a>
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