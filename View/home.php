<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Web thể thao- Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="View/assets/img/favicon.png" rel="icon">
  <link href="View/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="View/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="View/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="View/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="View/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="View/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="View/assets/css/variables.css" rel="stylesheet">
  <link href="View/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: ZenBlog
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <?php require_once PATH_VIEW_CLIENT . "/layout/header.php"; ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Hero Slider Section ======= -->
    <?php require_once PATH_VIEW_CLIENT . "/layout/banner.php"; ?>
    <!-- End Hero Slider Section -->

    <!-- ======= Post Grid Section =======  -->
    <?php require_once PATH_VIEW_CLIENT . "/area-post/outstanding.php"; ?>
    <!-- End Post Grid Section -->

    <!-- ======= Danh Mục Bóng đá thế giới ======= -->
    <?php require_once PATH_VIEW_CLIENT . "/category-football-TheWorld/football-world.php"; ?>
    <!-- End Danh mục Bóng đá thế giới -->

    <!-- ======= Danh mục bóng đá Việt Nam ======= -->
    <?php require_once PATH_VIEW_CLIENT . "/category-football-VietNam/football-vietnam.php"; ?>
    <!-- End Danh mục bóng đá Việt Nam -->

    <!-- ======= Danh Mục Quần vợt tennis ======= -->
    <?php require_once PATH_VIEW_CLIENT . "/category-othor-sport/orther-sport.php"; ?>
    <!-- ======= END Danh Mục Quần vợt tennis ======= -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php require_once PATH_VIEW_CLIENT . "/layout/footer.php";  ?>
  <!-- ======== END Footer=== -->
  <form action="" method="post">
    <input type="submit" name="hehe">
  </form>
  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="View/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="View/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="View/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="View/assets/vendor/aos/aos.js"></script>
  <script src="View/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="View/assets/js/main.js"></script>

</body>

</html>