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
  <link href="View/dashboard_client/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="View/dashboard_client/css/sb-admin-2.min.css" rel="stylesheet" />

  <!-- Custom styles for this page -->
  <link href="View/dashboard_client/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <style>

  </style>
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <?php require_once PATH_VIEW_CLIENT . "dashboard_client/sidebar.php"
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <?php require_once PATH_VIEW_CLIENT . "dashboard_client/header.php" ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Hồ sơ bị từ chối</h1>
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
                    <option value="index.php?act=list-nop-ho-so-chua-duyet">Hồ sơ chưa duyệt</option>
                    <option value="index.php?act=list-ho-so-rejected">Hồ sơ bị hủy</option>
                    <option value="index.php?act=list-ho-so-daduyet">Hồ sơ đã duyệt</option>
                  </select>
                </div>
                <?php //print_r($list)  

                ?>
                <h3 class="text-danger">Hồ sơ bị hủy</h3>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Gmail</th>
                      <th>Mã Ngành</th>
                      <th>Tên Ngành</th>
                      <th>Điểm xét tuyển</th>
                      <th>Ngày Nộp</th>
                      <th>Trạng Thái</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>STT</th>
                      <th>Gmail</th>
                      <th>Mã Ngành</th>
                      <th>Tên Ngành</th>
                      <th>Điểm xét tuyển</th>
                      <th>Ngày Nộp</th>
                      <th>Trạng Thái</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if (!empty($list)) : ?>
                      <?php foreach ($list as $index => $application) : ?>
                        <tr>
                          <td><?= $index + 1 ?></td>
                          <td><?= htmlspecialchars($application['full_name']); ?></td>
                          <td><?= htmlspecialchars($application['industry_code']); ?></td>
                          <td><?= htmlspecialchars($application['ten_nganh']); ?></td>
                          <td>
                            <?php
                            $score = json_decode($application['score'], true);
                            if ($score) {
                              $block = htmlspecialchars($score['block']);
                              $subject_scores = [];

                              foreach ($score['subjects'] as $subject => $mark) {
                                $subject_scores[] = htmlspecialchars($subject) . ": " . htmlspecialchars($mark);
                              }

                              echo $block . " - " . implode(", ", $subject_scores);
                            } else {
                              echo "Không có dữ liệu điểm";
                            }
                            ?>
                          </td>
                          <td><?= htmlspecialchars($application['created_at']); ?></td>
                          <td>
                            <?php
                            $status = htmlspecialchars($application['status']);
                            $status_class = '';

                            switch ($status) {
                              case 'pending':
                                $status_class = 'badge bg-warning text-dark'; // Màu vàng cho trạng thái pending
                                break;
                              case 'approved':
                                $status_class = 'badge bg-success'; // Màu xanh lá cây cho trạng thái approved
                                break;
                              case 'rejected':
                                $status_class = 'badge bg-danger'; // Màu đỏ cho trạng thái rejected
                                break;
                              default:
                                $status_class = 'badge bg-secondary'; // Màu xám cho trạng thái khác
                                break;
                            }
                            ?>
                            <span class="<?= $status_class; ?>" style="color:white">
                              <?= $status; ?>
                            </span>
                          </td>

                          <td>
                            <?php if (trim($application["status_program"]) !== "inactive"): ?>
                              <a href="index.php?act=chi-tiet-ho-so-role-teacher&id_hoso=<?= $application['application_id']; ?>" class="btn btn-info btn-sm">Xem chi tiết</a>
                            <?php else: ?>
                              <span style="color: red; font-style: italic;">Đã khóa</span>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="8" class="text-center">Không có hồ sơ nào</td>
                      </tr>
                    <?php endif; ?>
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
  <script src="View/dashboard_client/vendor/jquery/jquery.min.js"></script>
  <script src="View/dashboard_client/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="View/dashboard_client/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="View/dashboard_client/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="View/dashboard_client/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="View/dashboard_client/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="View/dashboard_client/js/demo/datatables-demo.js"></script>
</body>

</html>