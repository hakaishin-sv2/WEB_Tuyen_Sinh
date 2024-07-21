<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="View/dashboard_client/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="View/dashboard_client/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
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
                                    <form class="user" method="post" action="">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required value="<?= isset($_SESSION["data_err"]) ? $_SESSION["data_err"]["email"] : ""  ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php?act=register">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="index.php?act=login">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <?php unset($_SESSION["data_err"]); ?>
</body>

</html>