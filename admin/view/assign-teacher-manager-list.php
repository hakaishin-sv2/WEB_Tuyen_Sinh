<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>SB Admin 2 - Manager Authorc</title>

  <!-- Custom fonts for this template -->
  <link
    href="view/vendor/fontawesome-free/css/all.min.css"
    rel="stylesheet"
    type="text/css" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="view/css/sb-admin-2.min.css" rel="stylesheet" />

  <!-- Custom styles for this page -->
  <link
    href="view/vendor/datatables/dataTables.bootstrap4.min.css"
    rel="stylesheet" />
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <?php require_once PATH_VIEW_ADMIN . "sidebar.php" ?>
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
          <h1 class="h3 mb-2 text-gray-800">Quản lý danh mục</h1>
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
              <?php if (isset($_SESSION["success"])): ?>
                <div class="alert alert-success">
                  <?= $_SESSION["success"]   ?>
                </div>
                <?php unset($_SESSION["success"]);  ?>
              <?php endif; ?>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>

                      <th>Avatar</th>
                      <th>Họ Tên</th>
                      <th>Email</th>
                      <th>Phụ trách</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>

                      <th>Avatar</th>
                      <th>Họ Tên</th>
                      <th>Email</th>
                      <th>Phụ trách</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php //print_r($list);
                    foreach ($list as $item): ?>
                      <tr>

                        <td>
                          <?php if (!empty($item["img_user"])): ?>
                            <img src="<?= "../" . htmlspecialchars($item["img_user"]) ?>" alt="img_user" class="rounded-circle" style="width: 100px; height: 100px;">
                          <?php else: ?>
                            <span>No Avatar</span>
                          <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($item["full_name"]) ?></td>
                        <td><?= htmlspecialchars($item["email"]) ?></td>
                        <td>
                          <?php
                          if (!empty($item["majors_responsible"])) {
                            // Sử dụng explode để tách chuỗi 'exam_blocks' thành mảng, sử dụng dấu '+' làm ký tự phân tách
                            $majors_responsible = explode('+', htmlspecialchars($item["majors_responsible"]));
                            $i = 1;
                            // Duyệt qua mỗi phần tử trong mảng và hiển thị trên một dòng riêng biệt
                            foreach ($majors_responsible as $block) {
                              echo $i . "_" . htmlspecialchars($block) . "<br>"; // Hiển thị mỗi tổ hợp trên một dòng
                              $i++;
                            }
                          } else {
                            echo "Không có khối xét tuyển"; // Trường hợp không có dữ liệu
                          }

                          ?>
                        </td>
                        <td>
                          <a href="index.php?act=assign-teacher-detail&id=<?= htmlspecialchars($item["teacher_id"]) ?>" class="btn btn-info">Show</a>
                          <a href="index.php?act=assign-teacher-update&id=<?= htmlspecialchars($item["teacher_id"]) ?>" class="btn btn-warning">Update</a>
                          <a href="index.php?act=assign-teacher-delete&id=<?= htmlspecialchars($item["teacher_id"]) ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa? Và người này sẽ về quyền Member')">Xóa</a>
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
      <?php require_once PATH_VIEW_ADMIN . "footer.php" ?>
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
  <div
    class="modal fade"
    id="logoutModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button
            class="close"
            type="button"
            data-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Select "Logout" below if you are ready to end your current session.
        </div>
        <div class="modal-footer">
          <button
            class="btn btn-secondary"
            type="button"
            data-dismiss="modal">
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
</body>

</html>