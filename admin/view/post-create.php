<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>SB Admin 2 - Author</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.2.1/tinymce.min.js"></script>
  <!-- Link bottrap selectoption để search trong combobox -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
  <!-- Custom fonts for this template -->
  <link href="view/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="view/css/sb-admin-2.min.css" rel="stylesheet" />

  <!-- Custom styles for this page -->
  <link href="view/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
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
          <h1 class="h3 mb-2 text-gray-800">Tạo bài viết</h1>
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
                <!-- Thêm thẻ Tag mới -->
              </h6>
            </div>
            <div class="card-body">

              <?php if (isset($_SESSION["errors"])) : ?>
                <div class="alert alert-danger">
                  <ul>
                    <?php foreach ($_SESSION["errors"] as $error) : ?>
                      <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                    <?php unset($_SESSION["errors"]); ?>
                  </ul>
                </div>
              <?php endif; ?>

              <div class="container mt-5">
                <h2>Thêm bài viết mới</h2>
                <br>
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="<?= isset($_SESSION['data_err']['title']) ? htmlspecialchars($_SESSION['data_err']['title'], ENT_QUOTES, 'UTF-8') : '' ?>">
                      </div>
                      <div class="form-group">
                        <label for="select_category">Category:</label>
                        <select name="select_category" id="select_category" class="form-control">
                          <option value="">Chọn danh mục...</option>
                          <?php foreach ($categories as $categr) : ?>
                            <option value="<?= $categr['id'] ?>" <?= isset($_SESSION['data_err']['select_category']) && $_SESSION['data_err']['select_category'] == $categr['id'] ? 'selected' : '' ?>>
                              <?= $categr['name_category'] ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <p style="color:red; font-size: 15px ">Nếu thuộc tin về bóng đá hãy chọn là Trong nước hay ngoài nước</p>
                        <label>Tin tức</label><br>
                        <input type="radio" id="is_domestic" name="news_type" value="domestic" <?= isset($_SESSION['data_err']['news_type']) && $_SESSION['data_err']['news_type'] == 'domestic' ? 'checked' : '' ?> style="margin-right: 10px;">
                        <label for="is_domestic" style="margin-right: 20px;">Tin trong nước</label>

                        <input type="radio" id="is_foreign" name="news_type" value="foreign" <?= isset($_SESSION['data_err']['news_type']) && $_SESSION['data_err']['news_type'] == 'foreign' ? 'checked' : '' ?> style="margin-right: 10px;">
                        <label for="is_foreign" style="margin-right: 20px;">Tin ngoài nước</label>
                      </div>
                      <div class="form-group">
                        <label for="excerpt">excerpt:</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="3" placeholder="Mô tả ngắn bài viết"><?= isset($_SESSION['data_err']['excerpt']) ? htmlspecialchars($_SESSION['data_err']['excerpt'], ENT_QUOTES, 'UTF-8') : '' ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="tags"> Thẻ Tag:</label>
                        <select name="tags[]" id="tags" class="form-control" multiple>
                          <?php foreach ($tags as $tag) : ?>
                            <option value="<?= $tag['id'] ?>" <?= isset($_SESSION['data_err']['tags']) && in_array($tag['id'], $_SESSION['data_err']['tags']) ? 'selected' : '' ?>>
                              <?= $tag['name_tag'] ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <!-- Hiển thị ảnh nhỏ preview nếu có -->
                        <img id="imgthumbnail-preview" src="#" alt="Ảnh Avatar" style="max-width: 200px; max-height: 200px; display: none;">
                      </div>
                      <div class="form-group">
                        <label for="imgthumbnail">Ảnh nhỏ</label>
                        <input type="file" class="form-control-file" id="imgthumbnail" name="imgthumbnail" accept="image/*">
                        <small class="form-text text-muted">Chọn một file ảnh cho bài viết.</small>
                      </div>
                      <div class="form-group">
                        <label for="select_category">Status:</label>
                        <select name="status" id="status" class="form-control" required>
                          <option value="1" <?= isset($_SESSION['data_err']['status']) && $_SESSION['data_err']['status'] == 1 ? 'selected' : '' ?>>Public Post</option>
                          <option value="0" <?= isset($_SESSION['data_err']['status']) && $_SESSION['data_err']['status'] == 0 ? 'selected' : '' ?>>Chưa duyệt</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <!-- Hiển thị ảnh cover preview nếu có -->
                        <img id="imgcover-preview" src="#" alt="Ảnh Avatar" style="max-width: 200px; max-height: 200px; display: none;">
                      </div>
                      <div class="form-group">
                        <label for="imgcover">Ảnh cover trending</label>
                        <input type="file" class="form-control-file" id="imgcover" name="imgcover" accept="image/*">
                        <small class="form-text text-muted">Chọn một file ảnh cho bài viết.</small>
                      </div>
                      <div class="form-group">
                        <label for="is_trending">Is Trending:</label>
                        <select name="is_trending" id="is_trending" class="form-control" required>
                          <option value="0" <?= isset($_SESSION['data_err']['is_trending']) && $_SESSION['data_err']['is_trending'] == 0 ? 'selected' : '' ?>>No</option>
                          <option value="1" <?= isset($_SESSION['data_err']['is_trending']) && $_SESSION['data_err']['is_trending'] == 1 ? 'selected' : '' ?>>Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="3"><?= isset($_SESSION['data_err']['content']) ? htmlspecialchars($_SESSION['data_err']['content'], ENT_QUOTES, 'UTF-8') : '' ?></textarea>
                      </div>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary">Thêm bài viết</button>
                    </div>
                  </div>
                </form>
                <?php unset($_SESSION['data_err']) ?>

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

  <script>
    $(document).ready(function() {
      // Xử lý khi input file thay đổi
      $('#imgthumbnail').change(function() {
        var input = this;
        var url = URL.createObjectURL(input.files[0]);
        $('#imgthumbnail-preview').attr('src', url).show();
      });
    });

    $(document).ready(function() {
      // Xử lý khi input file thay đổi
      $('#imgcover').change(function() {
        var input = this;
        var url = URL.createObjectURL(input.files[0]);
        $('#imgcover-preview').attr('src', url).show();
      });
    });

    function initTinyMCE() {
      // THư việt của thẻ texaria
      tinymce.init({
        selector: 'textarea#content',
        height: 300,
        plugins: [
          'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
          'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
          'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
          'bold italic backcolor | alignleft aligncenter ' +
          'alignright alignjustify | bullist numlist outdent indent | ' +
          'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
      });
    }

    // Gọi hàm khởi tạo TinyMCE sau khi tải lại trang
    window.onload = function() {
      initTinyMCE();
    };
  </script>
  <!-- Core plugin JavaScript-->
  <script src="view/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Bootstrap Select JavaScript trong combobox select option -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="view/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="view/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="view/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="view/js/demo/datatables-demo.js"></script>


</body>

</html>