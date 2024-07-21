<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Thông tin</title>
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
    <?php require_once PATH_VIEW_CLIENT . "/layout/header.php";  ?>

    <!-- End Header -->

    <main id="main">
        <section>
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h3 class="page-title">Về Chúng Tôi</h3>
                    </div>
                </div>

                <div class="row mb-5">

                    <div class="d-md-flex post-entry-2 half">

                        <div class="ps-md-5 mt-4 mt-md-0">

                            <h2 class="mb-4 display-4">Bài làm</h2>

                            <p>Chủ đề: XÂY DỤNG WEB TIN TỨC THỂ THAO</p>
                            <p>Thành viên viên: Nguyễn Trọng</p>
                        </div>
                    </div>

                    <!-- <div class="d-md-flex post-entry-2 half mt-5">

                    </div> -->

                </div>

            </div>
        </section>

        <!-- <section class="mb-5 bg-light py-5">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-between align-items-lg-center">
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <h2 class="display-4 mb-4">Latest News</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, rem eaque vel est asperiores iste pariatur placeat molestias, rerum provident ea maiores debitis eum earum esse quas architecto! Minima, voluptatum! Minus tempora distinctio quo sint est blanditiis voluptate eos. Commodi dolore nesciunt culpa adipisci nemo expedita suscipit autem dolorum rerum?</p>
                        <p>At magni dolore ullam odio sapiente ipsam, numquam eius minus animi inventore alias quam fugit corrupti error iste laboriosam dolorum culpa doloremque eligendi repellat iusto vel impedit odit cum. Sequi atque molestias nesciunt rem eum pariatur quibusdam deleniti saepe eius maiores porro quam, praesentium ipsa deserunt laboriosam adipisci. Optio, animi!</p>
                        <p><a href="#" class="more">View All Blog Posts</a></p>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6">
                                <img src="assets/img/post-portrait-3.jpg" alt="" class="img-fluid mb-4">
                            </div>
                            <div class="col-6 mt-4">
                                <img src="assets/img/post-portrait-4.jpg" alt="" class="img-fluid mb-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <section>
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <h2 class="display-4">Thành viên</h2>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    foreach ($authors as $author) : ?>
                        <div class="col-lg-4 text-center mb-5">
                            <img src="<?php echo htmlspecialchars(str_replace('../', '', $author['avatar'])); ?>" alt="" class="img-fluid rounded-circle w-50 mb-4" style="width: 200px;height: 200px;">
                            <h4><?php echo htmlspecialchars($author['full_name']); ?></h4>
                            <span class="d-block mb-3 text-uppercase">
                                <?php
                                switch ($author['role']) {
                                    case 1:
                                        echo 'ADMIN';
                                        break;
                                    case 2:
                                        echo 'Người kiểm duyệt';
                                        break;
                                    case 3:
                                        echo 'Người viết bài';
                                        break;
                                    default:
                                        echo 'Không xác định';
                                }
                                ?>
                            </span>
                            <p><?php echo htmlspecialchars($author['Tieusu']); ?></p>
                            <p>Email: <a style="font-style: italic; color: #007BFF; text-decoration: none;" href="mailto:<?php echo htmlspecialchars($author['email']); ?>"><?php echo htmlspecialchars($author['email']); ?></a></p>

                        </div>
                    <?php endforeach; ?>

                    <!-- <div class="col-lg-4 text-center mb-5">
                        <img src="uploads/author/66920548b3ace_anh2f.jpg" alt="" class="img-fluid rounded-circle w-50 mb-4" style="width: 200px;height: 200px;">
                        <h4>Cameron Williamson</h4>
                        <span class="d-block mb-3 text-uppercase">Editor Staff</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime, adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident inventore? Voluptatum in tempora earum deleniti, culpa odit veniam, ea reiciendis sunt ullam temporibus aut!</p>
                    </div> -->
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php require_once PATH_VIEW_CLIENT . "/layout/footer.php";  ?>


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