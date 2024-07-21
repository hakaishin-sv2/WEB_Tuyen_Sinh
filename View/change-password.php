<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            /* Màu nền nhẹ */
        }

        .password-reset-container {
            max-width: 500px;
            margin: 5% auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: .5rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .password-reset-header {
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-control {
            border-radius: .25rem;
        }
    </style>
</head>

<body>
    <div class="password-reset-container">
        <div class="text-center password-reset-header">
            <h2 class="font-weight-bold">Đổi Mật Khẩu</h2>
            <p class="text-muted">Vui lòng nhập mật khẩu hiện tại và mật khẩu mới của bạn.</p>
        </div>
        <!-- Báo lỗi valiadte -->
        <?php if (isset($_SESSION["errors"])) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php
                    foreach ($_SESSION["errors"] as $error) : ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                    <?php unset($_SESSION["errors"]); ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="current_password">Mật Khẩu Hiện Tại</label>
                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Nhập mật khẩu hiện tại" required value="<?= isset($_SESSION["data_err"]) ? $_SESSION["data_err"]["current_password"] : ""   ?>">
            </div>
            <div class="form-group">
                <label for="new_password">Mật Khẩu Mới</label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Nhập mật khẩu mới" required value="<?= isset($_SESSION["data_err"]) ? $_SESSION["data_err"]["new_password"] : ""   ?>">
            </div>
            <div class="form-group">
                <label for="confirm_password">Xác Nhận Mật Khẩu Mới</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu mới" required value="<?= isset($_SESSION["data_err"]) ? $_SESSION["data_err"]["confirm_password"] : ""   ?>">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đổi Mật Khẩu</button>
        </form>
    </div>
    <?php unset($_SESSION["data_err"]); ?>
    <!-- Bootstrap JS and dependencies (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>