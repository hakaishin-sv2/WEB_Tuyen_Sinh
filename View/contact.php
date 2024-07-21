<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ZenBlog Bootstrap Template - Contact</title>
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
        <section id="contact" class="contact mb-5">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h1 class="page-title">Contact us</h1>
                    </div>
                </div>

                <div class="row gy-4">

                    <div class="col-md-4">
                        <div class="info-item">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <address>Nghĩa Đồng, Tân Kỳ Nghệ An</address>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-4">
                        <div class="info-item info-item-borders">
                            <i class="bi bi-phone"></i>
                            <h3>Phone Number</h3>
                            <p><a href="tel:0123456789">0123456789</a></p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-4">
                        <div class="info-item">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p><a href="mailto:nguyentrongthi9779@gmail.com">nguyentrongthi9779@gmail.com</a></p>
                        </div>
                    </div><!-- End Info Item -->

                </div>

                <div class="form mt-5">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div><!-- End Contact Form -->

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