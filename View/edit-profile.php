<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Hồ Sơ</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <div class="container mt-5">
        <?php if (isset($_SESSION["success"])) : ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_SESSION["success"]); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION["errors"]) && !empty($_SESSION["errors"])) : ?>
            <div class="alert alert-danger">
                <?php foreach ($_SESSION["errors"] as $error) : ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <h1 class="mb-4">Chỉnh sửa Hồ Sơ</h1>
        <form action="index.php?act=edit-profile" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="full_name">Họ và tên:</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?= htmlspecialchars($_SESSION['user']['full_name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" required>
            </div>
            <div class="form-group">
                <label for="img_user">Ảnh đại diện:</label>
                <input type="file" class="form-control-file" id="img_user" name="img_user" accept="image/*">
                <img id="imgPreview" src="<?= isset($_SESSION['user']['img_user']) ? htmlspecialchars($_SESSION['user']['img_user']) : '' ?>" alt="Ảnh đại diện hiện tại" alt="Profile Picture" class="rounded-circle" style="width: 200px; height: 200px;">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật hồ sơ</button>
            <a href="index.php?act=profile" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
    <?php unset($_SESSION["errors"]);
    unset($_SESSION["data_er"]);
    unset($_SESSION["success"]);  ?>
    <script>
        document.getElementById('img_user').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imgPreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>