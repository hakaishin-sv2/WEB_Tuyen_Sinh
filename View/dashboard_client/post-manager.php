<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Clinet Manager Posts</title>

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
          <h1 class="h3 mb-2 text-gray-800">Quản lý bài Post</h1>
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Khu vực</th>
                      <th>Title</th>
                      <th>Excerpt</th>
                      <th>Category</th>
                      <th>Tên Tác Giả</th>
                      <th>Email author</th>
                      <th>img_thumbnail</th>
                      <th>img_cover</th>
                      <th>Satus</th>
                      <th>Is_trending</th>
                      <th>Create_at</th>
                      <th>Update_at</th>
                      <th>Người duyệt bài</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Khu vực</th>
                      <th>Title</th>
                      <th>Excerpt</th>
                      <th>Category</th>
                      <th>Tên Tác Giả</th>
                      <th>Email author</th>
                      <th>img_thumbnail</th>
                      <th>img_cover</th>
                      <th>Satus</th>
                      <th>Is_trending</th>
                      <th>Create_at</th>
                      <th>Update_at</th>
                      <th>Người duyệt bài</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php //print_r($_SESSION["user"]);
                    foreach ($list_post as $item) : ?>
                      <tr>
                        <td><?= htmlspecialchars($item["id"]) ?></td>
                        <td>
                          <?= htmlspecialchars($item["area"]) == 1 ? "Ngoài nước" : "Trong nước" ?>
                        </td>
                        <td><?= htmlspecialchars($item["title"]) ?></td>
                        <td><?= htmlspecialchars($item["excerpt"]) ?></td>
                        <td><?= htmlspecialchars($item["category_name"]) ?></td>
                        <td><?= htmlspecialchars($item["author_name"]) ?></td>
                        <td><?= htmlspecialchars($item["author_email"]) ?></td>
                        <td>
                          <?php if (!empty($item["img_thumbnail"])) : ?>
                            <img src="<?= htmlspecialchars(str_replace('../', '', $item["img_thumbnail"])) ?>" alt="Thumbnail" class="rounded" style="width: 100px; height: 100px;">
                          <?php else : ?>
                            <span>No Thumbnail</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if (!empty($item["img_cover"])) : ?>
                            <img src="<?= htmlspecialchars(str_replace('../', '', $item["img_cover"])) ?>" alt="img_cover" class="rounded" style="width: 100px; height: 100px;">
                          <?php else : ?>
                            <span>No Cover Image</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if ($item["status"] == 1) : ?>
                            <span class="badge badge-success">Đã public</span>
                          <?php elseif ($item["status"] == 0) : ?>
                            <span class="badge badge-secondary">Chưa duyệt</span>
                          <?php else : ?>
                            <span><?= htmlspecialchars($item["status"]) ?></span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if ($item["is_trending"] == 1) : ?>
                            <span class="badge badge-success">Yes</span>
                          <?php elseif ($item["is_trending"] == 0) : ?>
                            <span class="badge badge-secondary">No</span>
                          <?php else : ?>
                            <span><?= htmlspecialchars($item["is_trending"]) ?></span>
                          <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($item["created_at"]) ?></td>
                        <td><?= htmlspecialchars($item["updated_at"]) ?></td>
                        <td><?= htmlspecialchars($item["pheduyet_name"]) ?></td>
                        <td>
                          <a href="index.php?act=post-detail&id=<?= htmlspecialchars($item["id"]) ?>" class="btn btn-info">Show</a>
                          <?php if ($item["status"] == 0) : ?>
                            <a href="index.php?act=post-update&id=<?= htmlspecialchars($item["id"]) ?>" class="btn btn-warning">Update</a>
                          <?php endif; ?>
                          <?php if ($item["status"] == 0 && $_SESSION["user"]["role"] == 3) : ?>
                            <a href="index.php?act=post-delete&id=<?= htmlspecialchars($item["id"]) ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                          <?php endif; ?>
                          <?php if ($item["status"] == 0 && $_SESSION["user"]["role"] == 2) : ?>
                            <a href="index.php?act=post-approve&id=<?= htmlspecialchars($item["id"]) ?>" class="btn btn-success" onclick="return confirm('Bạn có phê duyệt bài này không?')">Duyệt</a>
                          <?php endif; ?>
                          <a href="index.php?act=prewview-post&id=<?= htmlspecialchars($item['id']) ?>" class="btn btn-light" target="_blank">Preview</a>
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