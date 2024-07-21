<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Post post-detail</title>

  <!-- Custom fonts for this template -->
  <link href="View/dashboard_client/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="View/dashboard_client/css/sb-admin-2.min.css" rel="stylesheet" />

  <!-- Custom styles for this page -->
  <link href="View/dashboard_client/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <?php require_once PATH_VIEW_CLIENT . "dashboard_client/sidebar.php" ?>
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
                <?php $post_dto_item = get_Post_detail($conn, $id); ?>
                <?php if (!empty($post_dto_item)) : ?>
                  <tr>
                    <td>ID</td>
                    <td><?php echo htmlspecialchars($post_dto_item['id']); ?></td>
                  </tr>
                  <tr>
                    <td>Title</td>
                    <td><?php echo htmlspecialchars($post_dto_item['title']); ?></td>
                  </tr>
                  <tr>
                    <td>Excerpt</td>
                    <td><?php echo htmlspecialchars($post_dto_item['excerpt']); ?></td>
                  </tr>
                  <tr>
                    <td>Content</td>
                    <td><?php $contentFromDB = $post_dto_item['content'];
                        $content = htmlspecialchars_decode($contentFromDB);
                        echo $content; ?></td>
                  </tr>
                  <tr>
                    <td>Category</td>
                    <td><?php echo htmlspecialchars($post_dto_item['category_name']); ?></td>
                  </tr>
                  <tr>
                    <td>Author Name</td>
                    <td><?php echo htmlspecialchars($post_dto_item['author_name']); ?></td>
                  </tr>
                  <tr>
                    <td>Author Email</td>
                    <td><?php echo htmlspecialchars($post_dto_item['author_email']); ?></td>
                  </tr>
                  <tr>
                    <td>Thumbnail</td>
                    <td>
                      <?php if (!empty($post_dto_item['img_thumbnail'])) : ?>
                        <img src="<?php echo htmlspecialchars($post_dto_item['img_thumbnail']); ?>" alt="Thumbnail" style="width: 100px; height: 100px;">
                      <?php else : ?>
                        No Thumbnail
                      <?php endif; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Cover Image</td>
                    <td>
                      <?php if (!empty($post_dto_item['img_cover'])) : ?>
                        <img src="<?php echo htmlspecialchars($post_dto_item['img_cover']); ?>" alt="Cover Image" style="width: 100px; height: 100px;">
                      <?php else : ?>
                        No Cover Image
                      <?php endif; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>
                      <?php if ($post_dto_item['status'] == 1) : ?>
                        <span class="badge badge-success">Đã public</span>
                      <?php else : ?>
                        <span class="badge badge-warning">Chờ phê duyệt</span>
                      <?php endif; ?>
                    </td>

                  </tr>
                  <tr>
                    <td>Is Trending</td>
                    <td>
                      <?php echo $post_dto_item['is_trending'] == 1 ? 'Yes' : 'No'; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Created At</td>
                    <td><?php echo htmlspecialchars($post_dto_item['created_at']); ?></td>
                  </tr>
                  <tr>
                    <td>Updated At</td>
                    <td><?php echo htmlspecialchars($post_dto_item['updated_at']); ?></td>
                  </tr>
                  <tr>
                    <td>Người phê duyệt</td>
                    <td>
                      <?php if (!empty($post_dto_item['pheduyet_name'])) : ?>
                        <span class="badge badge-success"><?= htmlspecialchars($post_dto_item['pheduyet_name']) ?></span>
                      <?php else : ?>
                        <span class="badge badge-danger"></span>
                      <?php endif; ?>
                    </td>

                  </tr>
                <?php else : ?>
                  <tr>
                    <td colspan="2">Không có dữ liệu bài viết để hiển thị.</td>
                  </tr>
                <?php endif; ?>


              </table>
              <a href="index.php?act=posts" class="btn btn-info">Quay lại</a>
              <a href="index.php?act=post-update&id=<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" class="btn btn-warning">Update</a>
              <?php if ($post_dto_item["status"] == 0 && $_SESSION["user"]["role"] == 3) : ?>
                <a href="index.php?act=post-delete&id=<?= htmlspecialchars($post_dto_item["id"]) ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
              <?php endif; ?>
              <?php if ($post_dto_item["status"] == 0 && $_SESSION["user"]["role"] == 2) : ?>
                <a href="index.php?act=post-approve&id=<?= htmlspecialchars($post_dto_item["id"]) ?>" class="btn btn-success" onclick="return confirm('Bạn có phê duyệt bài này không?')"> Phê Duyệt</a>
              <?php endif; ?>
              <a href="index.php?act=prewview-post&id=<?= htmlspecialchars($post_dto_item['id']) ?>" class="btn btn-light" target="_blank">Preview</a>
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