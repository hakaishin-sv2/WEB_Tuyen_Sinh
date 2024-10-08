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
          <h1 class="h3 mb-2 text-gray-800">Thêm mới user</h1>
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
                Thêm user
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

              <form action="" method="POST">
                <div class="mb-3 mt-3">
                  <label for="full_name" class="form-lable">Full Name: </label>
                  <input type="text" class="form-control" id="full_name" name="full_name"
                    value="<?= isset($_SESSION['data_err']['full_name']) ? htmlspecialchars($_SESSION['data_err']['full_name'], ENT_QUOTES, 'UTF-8') : '' ?>">
                </div>
                <div class="mb-3 mt-3">
                  <label for="email" class="form-lable">Email: </label>
                  <input type="email" class="form-control" id="email" name="email"
                    value="<?= isset($_SESSION['data_err']['email']) ? htmlspecialchars($_SESSION['data_err']['email'], ENT_QUOTES, 'UTF-8') : '' ?>">
                </div>
                <!-- <div class="mb-3 mt-3">
                        <label for="username" class="form-lable">username: </label>
                        <input type="text"  class="form-control" id="username" name="username">
                    </div> -->
                <div class="mb-3 mt-3">
                  <label for="password" class="form-lable">password: </label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3 mt-3">
                  <label for="role" class="form-lable">Vai trò: </label>
                  <select name="role" id="role" class="form-control">
                    <option value="admin">Admin</option>
                    <option value="teacher">Người kiểm duyệt</option>
                    <option value="student">User</option>

                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              <?php unset($_SESSION['data_err']); ?>
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