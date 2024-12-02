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
            <select class="form-control" id="hoSoOptions" onchange="if(this.value) window.location.href=this.value">
                <option value="" disabled selected>Chọn loại</option>
                <option value="index.php?act=thong-ke-cu-the-theo-nganh&id_nganh=<?= $_GET["id_nganh"] ?>&year=<?= $_GET["year"] ?>&type=all">Tất cả</option>
                <option value="index.php?act=thong-ke-cu-the-theo-nganh&id_nganh=<?= $_GET["id_nganh"] ?>&year=<?= $_GET["year"] ?>&type=pending">Chờ duyệt</option>
                <option value="index.php?act=thong-ke-cu-the-theo-nganh&id_nganh=<?= $_GET["id_nganh"] ?>&year=<?= $_GET["year"] ?>&type=approved">Đã duyệt</option>
                <option value="index.php?act=thong-ke-cu-the-theo-nganh&id_nganh=<?= $_GET["id_nganh"] ?>&year=<?= $_GET["year"] ?>&type=rejected">Bị hủy</option>
            </select>
            <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                <thead>
                    <tr>

                        <th>STT</th>
                        <th>Người duyệt</th>
                        <th>Người nộp hồ sơ</th>
                        <th>Mã ngành</th>
                        <th>Tên ngành</th>
                        <th>create at</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Người duyệt</th>
                        <th>Người nộp hồ sơ</th>
                        <th>Mã ngành</th>
                        <th>Tên ngành</th>
                        <th>create at</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    // Lấy giá trị 'type' từ URL nếu có
                    $type = $_GET['type'] ?? 'all'; // Mặc định là 'all' nếu không có trong URL

                    // Lọc mảng dựa trên 'status'
                    $filtered_list = array_filter($list, function ($item) use ($type) {
                        // Lọc theo từng type
                        if ($type === 'all') {
                            return true; // Hiển thị tất cả
                        } else {
                            return $item['status'] === $type; // Lọc theo status (pending, approved, rejected)
                        }
                    });

                    // Kiểm tra nếu mảng lọc có phần tử hay không
                    if (count($filtered_list) > 0):
                        foreach ($filtered_list as $index => $item): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($item["reviewer_name"]) ?></strong><br>
                                    <span><?= htmlspecialchars($item["reviewer_email"]) ?></span>
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($item["applicant_name"]) ?></strong><br>
                                    <span><?= htmlspecialchars($item["applicant_email"]) ?></span>
                                </td>
                                <td><?= htmlspecialchars($item["industry_code"]) ?></td>
                                <td><?= htmlspecialchars($item["ten_nganh"]) ?></td>
                                <td><?= date("d/m/Y", strtotime($item["created_at"])) ?></td>
                                <td>
                                    <?php
                                    // Hiển thị trạng thái với màu sắc
                                    if ($item["status"] == "pending") {
                                        echo '<span class="badge bg-primary text-white">Pending</span>';
                                    } elseif ($item["status"] == "approved") {
                                        echo '<span class="badge bg-success text-white">Approved</span>';
                                    } elseif ($item["status"] == "rejected") {
                                        echo '<span class="badge bg-danger text-white">Rejected</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if (trim($item["status_program"]) !== "inactive"): ?>
                                        <a href="index.php?act=chi-tiet-ho-so-role-admin&id_hoso=<?= $item['application_id']; ?>" class="btn btn-info btn-sm">Xem chi tiết</a>
                                    <?php else: ?>
                                        <span style="color: red; font-style: italic;">Đã khóa</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="8" class="text-center" style="font-size: 18px;font-weight: bold; color:brown">Không có danh sách</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>

    <!-- Thư viện JavaScript của Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
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