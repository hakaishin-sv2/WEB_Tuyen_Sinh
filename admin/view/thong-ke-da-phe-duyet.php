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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

</head>

<body>
    <div class="container mt-5">
        <a href="index.php?act=thong-ke-ho-so" class="btn btn-primary">Quay lại</a>
        <h2 class="text-center mb-4">Thống kê hồ sơ năm <?= $year ?></h2>

        <!-- Tổng quan các hồ sơ -->
        <!-- <div class="row text-center mb-4">
            <a href="index.php?act=pending&year=<?= $year ?>" class="col-md-4 text-decoration-none">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Hồ sơ chờ duyệt</h5>
                        <p class="card-text"><?= htmlspecialchars($applicationStats['total_pending']) ?></p>
                    </div>
                </div>
            </a>
            <a href="index.php?act=approved&year=<?= $year ?>" class="col-md-4 text-decoration-none">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Hồ sơ đã duyệt</h5>
                        <p class="card-text"><?= htmlspecialchars($applicationStats['total_approved']) ?></p>
                    </div>
                </div>
            </a>
            <a href="index.php?act=rejected&year=<?= $year ?>" class="col-md-4 text-decoration-none">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Hồ sơ bị từ chối</h5>
                        <p class="card-text"><?= htmlspecialchars($applicationStats['total_rejected']) ?></p>
                    </div>
                </div>
            </a>
        </div> -->

        <?php
        //print_r($statistics);
        ?>
        <!-- Thống kê theo ngành -->
        <h3 class="mb-3">Thống kê hồ toàn bộ hồ sơ đã duyệt</h3>
        <div class="table-responsive">
            <button id="exportExcel" class="btn btn-success">Xuất Excel</button>
            <button id="exportPDF" class="btn btn-danger">Xuất PDF</button>
            <?php //print_r($list)  
            ?>
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
                    <?php //print_r($list);
                    foreach ($list as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <strong><?= htmlspecialchars($item["reviewer_name"]) ?></strong><br>
                                <span><?= htmlspecialchars($item["reviewer_email"]) ?></span>
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($item["full_name"]) ?></strong><br>
                                <span><?= htmlspecialchars($item["email"]) ?></span>
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
                                <a href="index.php?act=chi-tiet-ho-so-role-admin&id_hoso=<?= htmlspecialchars($item["id"]) ?>" class="btn btn-info">Chi tiết hồ sơ</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Thư viện JavaScript -->
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
    <script>
        // Xuất dữ liệu sang Excel
        document.getElementById("exportExcel").addEventListener("click", function() {
            var table = document.getElementById("table"); // Lấy bảng HTML
            var wb = XLSX.utils.table_to_book(table, {
                sheet: "Sheet1"
            }); // Chuyển đổi bảng sang workbook
            XLSX.writeFile(wb, "Kết quả thi.xlsx"); // Lưu file Excel
        });

        // Xuất dữ liệu sang PDF
        document.getElementById("exportPDF").addEventListener("click", function() {
            var {
                jsPDF
            } = window.jspdf; // Tạo instance của jsPDF
            var doc = new jsPDF();

            doc.autoTable({
                html: "#table", // Lấy dữ liệu từ bảng HTML
                startY: 10,
                styles: {
                    fontSize: 10,
                    cellPadding: 3,
                },
                headStyles: {
                    fillColor: [0, 123, 255], // Màu header
                    textColor: 255,
                },
            });

            doc.save("DanhSachHocVien.pdf"); // Lưu file PDF
        });
    </script>
</body>

</html>