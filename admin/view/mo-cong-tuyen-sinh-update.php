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

  <title>SB Admin 2 - Author</title>
  <!-- Link bottrap selectoption để search trong combobox -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
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
          <h1 class="h3 mb-2 text-gray-800">Giao quyền kiểm duyệt</h1>
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
                <h2> </h2>
                <?php
                //print_r($getProgramsWithMajors)
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="program_name">Tên chương trình</label>
                    <input readonly type="text" class="form-control" id="program_name" name="program_name" required
                      value="<?= htmlspecialchars($data[0]['name']) ?>">
                  </div>
                  <div class="form-group">
                    <label for="start_date">Ngày bắt đầu</label>
                    <input type="date" class="form-control" id="start_date" name="start_date"
                      value="<?= htmlspecialchars($data[0]['start_date']) ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="duration">Ngày kết thúc</label>
                    <input type="date" class="form-control" id="end_date" name="end_date"
                      value="<?= htmlspecialchars($data[0]['end_date']) ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="majors">Chọn ngành:</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="checkAll" style="transform: scale(1.5);">
                      <label class="form-check-label" for="checkAll" style="color: #28a745; font-size: 18px; margin-left: 8px; font-weight: bold;">
                        Chọn tất cả
                      </label>
                    </div>
                    <br>
                    <div class="row">
                      <?php foreach ($data as $item): ?>
                        <div class="col-md-6 mb-3">
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              name="majors[]"
                              id="major_<?= htmlspecialchars($item['major_id']) ?>"
                              value="<?= htmlspecialchars($item['major_id']) ?>"
                              <?= $item['istrue'] == 1 ? 'checked' : '' ?>>
                            <label class="form-check-label" for="major_<?= htmlspecialchars($item['major_id']) ?>">
                              <?= htmlspecialchars($item['major_name']) ?>
                            </label>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Mở cổng xét tuyển</button>
                </form>

              </div>
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

  <!-- Bootstrap Select JavaScript trong combobox select option -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="view/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="view/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="view/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="view/js/demo/datatables-demo.js"></script>

  <script>
    $(document).ready(function() {
      // Xử lý khi input file thay đổi
      $('#avatar').change(function() {
        var input = this;
        var url = URL.createObjectURL(input.files[0]);
        $('#avatar-preview').attr('src', url).show();
      });
    });
  </script>
  <script>
    function calculateEndDate() {
      const duration = document.getElementById('duration').value;
      const startDateInput = document.getElementById('start_date');
      const endDateInput = document.getElementById('end_date');

      if (startDateInput.value && duration) {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(startDate);
        endDate.setMonth(startDate.getMonth() + parseInt(duration));

        const year = endDate.getFullYear();
        const month = String(endDate.getMonth() + 1).padStart(2, '0');
        const day = String(endDate.getDate()).padStart(2, '0');

        endDateInput.value = `${year}-${month}-${day}`;
      } else {
        endDateInput.value = '';
      }
    }
  </script>
  <script>
    // tích chọn all checkox
    document.getElementById('checkAll').addEventListener('change', function() {
      var isChecked = this.checked;
      var checkboxes = document.querySelectorAll('input[name="majors[]"]');
      checkboxes.forEach(function(checkbox) {
        checkbox.checked = isChecked;
      });
    });
  </script>

</body>

</html>