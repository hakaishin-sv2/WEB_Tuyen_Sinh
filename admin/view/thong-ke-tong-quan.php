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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <a href="index.php?act=thong-ke-ho-so" class="btn btn-primary">Quay lại</a>
        <h2 class="text-center mb-4">Thống kê hồ sơ năm <?= $year ?></h2>

        <!-- Tổng quan các hồ sơ -->
        <div class="row text-center mb-4">
            <a href="index.php?act=thong-he-trang-thai-ho-so&status=pending&year=<?= $year ?>" class="col-md-4 text-decoration-none">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Hồ sơ chờ duyệt</h5>
                        <p class="card-text"><?= htmlspecialchars($applicationStats['total_pending']) ?></p>
                    </div>
                </div>
            </a>
            <a href="index.php?act=thong-he-trang-thai-ho-so&status=approved&year=<?= $year ?>" class="col-md-4 text-decoration-none">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Hồ sơ đã duyệt</h5>
                        <p class="card-text"><?= htmlspecialchars($applicationStats['total_approved']) ?></p>
                    </div>
                </div>
            </a>
            <a href="index.php?act=thong-he-trang-thai-ho-so&status=rejected&year=<?= $year ?>" class="col-md-4 text-decoration-none">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Hồ sơ bị từ chối</h5>
                        <p class="card-text"><?= htmlspecialchars($applicationStats['total_rejected']) ?></p>
                    </div>
                </div>
            </a>
        </div>


        <!-- Thống kê theo ngành -->
        <h3 class="mb-3">Thống kê theo ngành</h3>
        <div class="table-responsive">
            <?php
            //print_r($statistics)

            ?>
            <table id="table" class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã Ngành</th>
                        <th>Tên Ngành</th>
                        <th>Hồ sơ chờ duyệt</th>
                        <th>Hồ sơ đã duyệt</th>
                        <th>Hồ sơ bị từ chối</th>
                        <th>Action</th>
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
                                <td>
                                    <a href="index.php?act=thong-ke-cu-the-theo-nganh&id_nganh=<?= $stat['major_id']; ?>&year=<?= $_GET['year']; ?>" class="btn btn-info">Chi tiết</a>
                                </td>
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

    <!-- Thư viện JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "ordering": true, // Bật tính năng sắp xếp
                "order": [
                    [4, 'desc']
                ],
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ dòng mỗi trang",
                    "zeroRecords": "Không tìm thấy kết quả",
                    "info": "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ dòng",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(lọc từ _MAX_ dòng)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Sau",
                        "previous": "Trước"
                    }
                }
            });
        });
    </script>
</body>

</html>