<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <?php if (isset($_SESSION["success"])) : ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_SESSION["success"]); ?>
            </div>
        <?php endif; ?>

        <h1 class="mb-4">Thông tin hồ sơ</h1>

        <div class="row">
            <div class="col-md-6">
                <h3>Thông tin cá nhân</h3>
                <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
                <p><strong>Họ và tên:</strong> <?= htmlspecialchars($_SESSION['user']['full_name']) ?></p>
                <p><strong>Vai trò:</strong>
                    <?php
                    $role = (int)$_SESSION['user']['role'];
                    switch ($role) {
                        case 0:
                            echo '<span class="badge bg-secondary text-white">Member</span>';
                            break;
                        case 1:
                            echo '<span class="badge bg-primary text-white">Admin</span>';
                            break;
                        case 2:
                            echo '<span class="badge bg-warning text-dark">Người kiểm duyệt</span>';
                            break;
                        case 3:
                            echo '<span class="badge bg-info text-white">Editor</span>';
                            break;
                        default:
                            echo '<span class="badge bg-light text-dark">Unknown</span>';
                            break;
                    }
                    ?>
                </p>
                <!-- Thêm các thông tin khác nếu cần -->
            </div>
            <div class="col-md-6">
                <p><strong>Ảnh đại diện:</strong></p>
                <?php if (!empty($user_item['img_user'])) : ?>
                    <img src="<?= htmlspecialchars($user_item['img_user']) ?>" alt="Profile Picture" class="rounded-circle" style="width: 200px; height: 200px;">
                <?php else : ?>
                    <span>No Profile Picture</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-4">
            <a href="index.php?act=edit-profile" class="btn btn-warning">Sửa hồ sơ</a>
            <a href="index.php" class="btn btn-primary">Trang chủ</a>
            <a href="index.php?act=change-password" class="btn btn-primary">Đổi mật khẩu</a>
        </div>

    </div>

    <?php unset($_SESSION["success"]);  ?>
</body>

</html>