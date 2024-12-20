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
          <h1 class="h3 mb-2 text-gray-800">Update</h1>
          <!-- <p class="mb-4">
              DataTables is a third party plugin that is used to generate the
              demo table below. For more information about DataTables, please
              visit the
              <a target="_blank" href="https://datatables.net"
                >official DataTables documentation</a
              >.
            </p> -->
          <?php
          // print_r($user);
          // print_r($NganhGiaoVienduocduyethoso);
          // print_r($MajorsList) 
          ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                Update Giáo viên duyệt hồ sơ
              </h6>
            </div>
            <div class="card-body">
              <?php if (isset($_SESSION["errors"])): ?>
                <div class="alert alert-danger">
                  <ul>
                    <?php foreach ($_SESSION["errors"] as $error): ?>
                      <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                    <?php unset($_SESSION["errors"]); ?>
                  </ul>
                </div>
              <?php endif; ?>
              <div class="container mt-5">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="user_id">Chọn Người Dùng</label>
                    <select class="selectpicker form-control" id="user_id" name="user_id" data-live-search="true" required>
                      <option value="<?= htmlspecialchars($user['id']) ?>" selected>
                        <?= htmlspecialchars($user['full_name']) ?> - Email: <?= htmlspecialchars($user['email']) ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="majors">Chọn ngành:</label>
                    <div class="row">
                      <?php  // Chuyển đổi mảng assignedMajors thành mảng đơn giản chỉ chứa các major_id
                      $assignedMajorIds = array_column($NganhGiaoVienduocduyethoso, 'major_id');
                      foreach ($MajorsList as $major) : ?>
                        <div class="col-md-6 mb-3">
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              name="majors[]"
                              id="major_<?= htmlspecialchars($major['industry_code']) ?>"
                              value="<?= htmlspecialchars($major['id']) ?>"
                              <?php if (in_array($major['id'], $assignedMajorIds)) echo 'checked'; ?>>
                            <label class="form-check-label" for="major_<?= htmlspecialchars($major['industry_code']) ?>">
                              <?= htmlspecialchars($major['industry_code']) ?> - <?= htmlspecialchars($major['ten_nganh']) ?>
                            </label>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>

                  <!-- <div class="form-group">
                    <img id="avatar-preview" src="#" alt="Ảnh Avatar" style="max-width: 200px; max-height: 200px; display: none;">
                  </div>
                  <div class="form-group">
                    <label for="avatar">Chọn Ảnh Avatar</label>
                    <input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*">
                    <small class="form-text text-muted">Chọn một file ảnh để làm Avatar.</small>
                  </div> -->
                  <!-- <div class="form-group">
                    <label for="bio">Tiểu Sử</label>
                    <textarea class="form-control" id="bio" name="bio" rows="3" required></textarea>
                  </div> -->

                  <button type="submit" class="btn btn-primary">Update quyền kiểm duyệt hồ sơ</button>
                </form>
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
          <a class="btn btn-primary" href="index.php?act=login">Logout</a>
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