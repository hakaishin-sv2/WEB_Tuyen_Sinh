<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Phê duyệt hồ sơ</title>

  <!-- Custom fonts for this template -->
  <link href="view/dashboard_client/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="view/css/sb-admin-2.min.css" rel="stylesheet" />

  <!-- Custom styles for this page -->
  <link href="view/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <style>

  </style>
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <?php require_once PATH_VIEW_ADMIN . "sidebar.php"
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <?php require_once PATH_VIEW_ADMIN . "header.php" ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Hồ sơ tuyển sinh</h1>
          <!-- <p class="mb-4">
              DataTables is a third party plugin that is used to generate the
              demo table below. For more information about DataTables, please
              visit the
              <a target="_blank" href="https://datatables.net"
                >official DataTables documentation</a
              >.
            </p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                DataTables Example
              </h6>
            </div>
            <div class="card-body">
              <?php if (isset($_SESSION["success"])) : ?>
                <div class="alert alert-success">
                  <?= $_SESSION["success"]   ?>
                </div>
                <?php unset($_SESSION["success"]);  ?>
              <?php endif; ?>
              <div class="table-responsive">
                <div class="form-group">
                  <label for="hoSoOptions">Chọn loại hồ sơ:</label>
                  <select class="form-control" id="hoSoOptions" onchange="if(this.value) window.location.href=this.value">
                    <option value="" disabled selected>Lọc hồ sơ</option>
                    <option value="index.php?act=xem-lai-ho-so-da-luu&major_id=<?= $_GET["major_id"] ?>&year=<?= $_GET["year"] ?>&status=">Toàn bộ</option>
                    <option value="index.php?act=xem-lai-ho-so-da-luu&major_id=<?= $_GET["major_id"] ?>&year=<?= $_GET["year"] ?>&status=pending">Hồ sơ chưa duyệt</option>
                    <option value="index.php?act=xem-lai-ho-so-da-luu&major_id=<?= $_GET["major_id"] ?>&year=<?= $_GET["year"] ?>&status=rejected">Hồ sơ bị hủy</option>
                    <option value="index.php?act=xem-lai-ho-so-da-luu&major_id=<?= $_GET["major_id"] ?>&year=<?= $_GET["year"] ?>&status=approved">Hồ sơ đã duyệt</option>
                  </select>
                </div>
                <?php //print_r($list)  
                ?><h3 class="text-success">Hồ sơ đã lưu</h3>
                <?php
                //print_r($list);
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
                          <a href="index.php?act=chi-tiet-ho-so-role-admin&id_hoso=<?= htmlspecialchars($item["id"]) ?>&isclosed=true" class="btn btn-info">Chi tiết hồ sơ</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php require_once PATH_VIEW_CLIENT . "dashboard_client/footer.php" ?>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Select "Logout" below if you are ready to end your current session.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">
            Cancel
          </button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="view/vendor/jquery/jquery.min.js"></script>
  <script src="view/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="view/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="view/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="view/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="view/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="view/js/demo/datatables-demo.js"></script>
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