<?php
// $statistics = getApplicationsStatisticsByMajor($conn, 2024);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê hồ sơ</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <a href="index.php?act=thong-ke-ho-so" class="btn btn-primary">Quay lại</a>
        <h2 class="text-center mb-4">Thống kê hồ sơ năm <?= $_GET["year"]  ?> theo ngành</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã Ngành</th>
                        <th>Tên Ngành</th>
                        <th>Hồ sơ chờ duyệt</th>
                        <th>Hồ sơ đã duyệt</th>
                        <th>Hồ sơ bị từ chối</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($statistics) > 0): ?>
                        <?php foreach ($statistics as $stat): ?>
                            <tr>
                                <td><?= htmlspecialchars($stat['industry_code']); ?></td>
                                <td><?= htmlspecialchars($stat['ten_nganh']); ?></td>
                                <td><?= htmlspecialchars($stat['total_pending']); ?></td>
                                <td><?= htmlspecialchars($stat['total_approved']); ?></td>
                                <td><?= htmlspecialchars($stat['total_rejected']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Không có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Thư viện JavaScript của Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>