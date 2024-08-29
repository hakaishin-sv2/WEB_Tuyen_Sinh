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

              <?php


              if (isset($_SESSION["errors"])) : ?>
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
                <h2>Update bài viết mới</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <!-- Cột trái -->
                    <div class="col-md-6">
                      <!-- Mã ngành -->
                      <div class="form-group">
                        <label for="industry_code">Mã ngành:</label>
                        <input type="text" class="form-control" id="industry_code" name="industry_code" placeholder="Nhập mã ngành" value="<?= htmlspecialchars($form_data['industry_code']); ?>" required>
                      </div>

                      <!-- Tên ngành -->
                      <div class="form-group">
                        <label for="name">Tên ngành:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên ngành" value="<?= htmlspecialchars($form_data['major_name']); ?>" required>
                      </div>

                      <!-- Mô tả ngành -->
                      <div class="form-group">
                        <label for="description">Mô tả ngành:</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Mô tả ngắn về ngành"><?= htmlspecialchars($form_data['description']); ?></textarea>
                      </div>

                      <!-- Chọn mã tổ hợp -->
                      <div class="form-group">
                        <label for="exam_blocks">Chọn tổ hợp môn:</label>
                        <div class="row">
                          <?php foreach ($exam_blocks as $block) : ?>
                            <div class="col-md-6 mb-3">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="exam_blocks[]" id="block_<?= $block['id'] ?>" value="<?= $block['id'] ?>" <?= in_array($block['id'], explode(',', $form_data['selected_blocks'])) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="block_<?= $block['id'] ?>">
                                  <?= htmlspecialchars($block['code']) ?> - <?= htmlspecialchars($block['name']) ?>
                                </label>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        </div>
                      </div>

                      <!-- Nút submit -->
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Cập nhật ngành</button>
                      </div>
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