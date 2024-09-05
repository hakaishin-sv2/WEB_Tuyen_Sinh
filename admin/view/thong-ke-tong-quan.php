<?php
// $year = 2024;
// $statistics = getApplicationsStatisticsByMajor($conn, $year);
// $applicationStats = getApplicationStatistics($conn, $year);
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
        <h2 class="text-center mb-4">Thống kê hồ sơ năm <?= $year ?></h2>

        <!-- Tổng quan các hồ sơ -->
        <div class="row text-center mb-4">
            <div class="col-md-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Hồ sơ chờ duyệt</h5>
                        <p class="card-text"><?= htmlspecialchars($applicationStats['total_pending']) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Hồ sơ đã duyệt</h5>
                        <p class="card-text"><?= htmlspecialchars($applicationStats['total_approved']) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Hồ sơ bị từ chối</h5>
                        <p class="card-text"><?= htmlspecialchars($applicationStats['total_rejected']) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê theo ngành -->
        <h3 class="mb-3">Thống kê theo ngành</h3>
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