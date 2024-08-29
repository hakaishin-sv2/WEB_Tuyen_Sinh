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

  <title>SB Admin 2 - Tables</title>

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
          <h1 class="h3 mb-2 text-gray-800">Tables</h1>
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
                Chi tiết bài Post
              </h6>
            </div>
            <div class="card-body">
              <table class="table">
                <tr>
                  <td>Trường dữ liệu</td>
                  <td>Dữ liệu</td>
                </tr>
                <?php ?>
                <?php if (!empty($post_dto_item)): ?>
                  <tr>
                    <td>ID</td>
                    <td><?php echo htmlspecialchars($post_dto_item['major_id']); ?></td>
                  </tr>
                  <tr>
                    <td>Industry Code</td>
                    <td><?php echo htmlspecialchars($post_dto_item['industry_code']); ?></td>
                  </tr>
                  <tr>
                    <td>Major Name</td>
                    <td><?php echo htmlspecialchars($post_dto_item['major_name']); ?></td>
                  </tr>
                  <tr>
                    <td>Exam Blocks</td>
                    <td>
                      <?php
                      // Tách chuỗi exam_blocks thành mảng và hiển thị từng tổ hợp trên một dòng
                      $exam_blocks = explode('+', htmlspecialchars($post_dto_item['exam_blocks']));
                      foreach ($exam_blocks as $block) {
                        echo htmlspecialchars($block) . "<br>"; // Hiển thị mỗi tổ hợp trên một dòng
                      }
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Description</td>
                    <td><?php echo htmlspecialchars($post_dto_item['description']); ?></td>
                  </tr>
                <?php else: ?>
                  <tr>
                    <td colspan="2">Không có dữ liệu để hiển thị.</td>
                  </tr>
                <?php endif; ?>


              </table>
              <a href="index.php?act=nganh-xet-tuyen-list" class="btn btn-danger">Quay lại</a>
              <a href="index.php?act=nganh-xet-tuyen-update&id=<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" class="btn btn-warning">Update</a>
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