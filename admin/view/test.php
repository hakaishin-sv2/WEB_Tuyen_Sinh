<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="view/vendor/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="view/css/sb-admin-2.min.css">
    <title>Thêm Mới Tác Giả</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Thêm Mới Tác Giả</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="user_id">Chọn Người Dùng</label>
                <select class="selectpicker form-control" id="user_id" name="user_id" data-live-search="true" required>
                    <option value="">Chọn người dùng...</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>">
                            <?= htmlspecialchars($user['full_name']) ?> -Email: <?= htmlspecialchars($user['email']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <img id="avatar-preview" src="#" alt="Ảnh Avatar" style="max-width: 200px; max-height: 200px; display: none;">
            </div>
            <div class="form-group">
                <label for="avatar">Chọn Ảnh Avatar</label>
                <input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*">
                <small class="form-text text-muted">Chọn một file ảnh để làm Avatar.</small>
            </div>
            <div class="form-group">
                <label for="bio">Tiểu Sử</label>
                <textarea class="form-control" id="bio" name="bio" rows="3" required></textarea>
            </div>
           
            <button type="submit" class="btn btn-primary">Thêm Tác Giả</button>
        </form>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="view/vendor/jquery/jquery.min.js"></script>
    <script src="view/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="view/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Bootstrap Select JavaScript -->
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
</body>
</html>
