<?php
// $year = 2024;
// $statistics = getApplicationsStatisticsByMajor($conn, $year);
// $applicationStats = getApplicationStatistics($conn, $year);

use function PHPSTORM_META\type;

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
        <h3 class="mb-3">Thống kê theo ngành</h3>
        <div class="table-responsive">

            <button id="exportExcel" class="btn btn-success">Xuất Excel</button>
            <button id="exportPDF" class="btn btn-danger">Xuất PDF</button>
            <br>
            <label for="hoSoOptions" style="font-size: 16px; font-weight: 500">Chọn loại lọc:</label>
            <select class="form-control" id="hoSoOptions" onchange="if(this.value) window.location.href=this.value">
                <option value="" disabled selected>Chọn loại</option>
                <option value="index.php?act=ket-qua-tuyen-sinh&year=<?= $_GET["year"] ?>&type=all">Tất cả</option>
                <option value="index.php?act=ket-qua-tuyen-sinh&year=<?= $_GET["year"] ?>&type=trung-tuyen">Hồ sơ trúng tuyển</option>
                <option value="index.php?act=ket-qua-tuyen-sinh&year=<?= $_GET["year"] ?>&type=khong-trung-tuyen">Hồ sơ bị trượt</option>
            </select>
            <?php
            //print_r($statistics)
            ?>
            <table id="table" class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã Ngành</th>
                        <th>Tên Ngành</th>
                        <th>Họ Tên</th>
                        <th>Điểm trúng tuyển</th>
                        <th>Điểm xét tuyển</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($statistics) > 0): ?>
                        <?php foreach ($statistics as $stat): ?>
                            <?php
                            $scoreData = json_decode($stat['score'], true);
                            $block = $scoreData['block'];
                            $subjects = array_keys($scoreData['subjects']);
                            $subjectsList = implode(', ', $subjects);
                            $result_key = sprintf("%s - %s", $block, $subjectsList);

                            $cutOffScores = json_decode($stat['cut_off_score'], true);
                            $diem_trung_tuyen_theo_khoi = $cutOffScores[$result_key] ?? 0;
                            $totalScore = array_sum($scoreData['subjects']);

                            if ($diem_trung_tuyen_theo_khoi == 0) {
                                $resultClass = 'btn-primary';
                                $resultText = 'Không xác định';
                            } else {
                                if ($totalScore >= $diem_trung_tuyen_theo_khoi) {
                                    $resultClass = 'btn-success';
                                    $resultText = 'Trúng tuyển';
                                } else {
                                    $resultClass = 'btn-danger';
                                    $resultText = 'Không trúng tuyển';
                                }
                            }

                            // Kiểm tra theo $check_type
                            $isDisplay = false;
                            if ($check_type === "all") {
                                $isDisplay = true;
                            } elseif ($check_type === "trung-tuyen" && $totalScore >= $diem_trung_tuyen_theo_khoi) {
                                $isDisplay = true;
                            } elseif ($check_type === "khong-trung-tuyen" && $totalScore < $diem_trung_tuyen_theo_khoi) {
                                $isDisplay = true;
                            }

                            if (!$isDisplay) continue; // Bỏ qua nếu không phù hợp với $check_type
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($stat['industry_code']); ?></td>
                                <td><?= htmlspecialchars($stat['ten_nganh']); ?></td>
                                <td><?= htmlspecialchars($stat['full_name']) . "<br>" . $stat['email']; ?></td>
                                <td>
                                    <?php
                                    if (empty($cutOffScores)) {
                                        echo "chưa cập nhật";
                                    } else {
                                        foreach ($cutOffScores as $khoi => $diem) {
                                            echo htmlspecialchars($khoi) . ": " . htmlspecialchars($diem) . " đ" . "<br>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?= $result_key . " -> " . $totalScore ?></td>
                                <td class="<?= $resultClass; ?>"><?= htmlspecialchars($resultText); ?></td>
                                <td>
                                    <a href="index.php?act=chi-tiet-ho-so-role-admin&id_hoso=<?= $stat['id']; ?>" class="btn btn-info btn-sm">Xem chi tiết</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Không có dữ liệu</td>
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