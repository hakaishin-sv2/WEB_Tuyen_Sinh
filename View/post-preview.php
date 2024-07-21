<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Web Sport - Chi Tiết bài viết</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="View/assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


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
    <style>
        .icon-liked {
            color: #007bff;
        }
    </style>
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
        <h2 class="text-center custom-title" style="margin-top: 3%; color: brown">Chế độ xem trước chưa public</h2>
        <section class="single-post-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 post-content" data-aos="fade-up">

                        <!-- ======= Nội dung bài viết ======= -->

                        <div class="single-post">
                            <?php

                            if ($post_detail) {
                            ?>
                                <div class="post-meta">
                                    <span class="date"><?php echo htmlspecialchars($post_detail['category_name'], ENT_QUOTES, 'UTF-8'); ?></span>
                                    <span class="mx-1">&bullet;</span>
                                    <span><?php echo date('d/m/Y', strtotime($post_detail['created_at'])); ?></span>
                                </div>
                                <h1 class="mb-5"><?php echo htmlspecialchars($post_detail['title'], ENT_QUOTES, 'UTF-8'); ?></h1>

                                <p><span class="firstcharacter"><?php nl2br(html_entity_decode(htmlspecialchars($post_detail['content'][0], ENT_QUOTES, 'UTF-8')));;
                                                                ?></span>
                                    <?php echo nl2br(html_entity_decode($post_detail['content'], ENT_QUOTES, 'UTF-8')); ?></p>

                                <?php if (!empty($post_detail['img_cover'])) : ?>
                                    <figure class="my-4">
                                        <img src="<?php echo str_replace('../', '', htmlspecialchars($post_detail['img_cover'], ENT_QUOTES, 'UTF-8')); ?>" alt="<?php echo htmlspecialchars($post_detail['title'], ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid">
                                        <figcaption><?php echo htmlspecialchars($post_detail['title'], ENT_QUOTES, 'UTF-8'); ?></figcaption>
                                    </figure>
                                <?php endif; ?>

                                <?php if (!empty($post_detail['img_thumbnail'])) : ?>
                                    <figure class="my-4">
                                        <img src="<?php echo str_replace('../', '', htmlspecialchars($post_detail['img_thumbnail'], ENT_QUOTES, 'UTF-8')); ?>" alt="<?php echo htmlspecialchars($post_detail['title'], ENT_QUOTES, 'UTF-8'); ?>" class="img-thumbnail">
                                    </figure>
                                <?php endif; ?>

                                <?php
                                // Hiển thị phần nội dung còn lại của bài viết
                                $content_parts = explode("\n", $post_detail['content']);
                                foreach ($content_parts as $part) {
                                    echo '<p>' . nl2br(html_entity_decode(htmlspecialchars($part, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')) . '</p>';
                                }
                                ?>
                            <?php
                            } else {
                                echo "<p>Bài viết không tồn tại.</p>";
                            }
                            ?>

                        </div><!-- End Nội dung bài viết -->

                        <!-- ======= Comments ======= -->
                        <!-- ======= Comments ======= -->
                        <div class="comments">
                            <h5 class="comment-title py-4">2 Comments</h5>
                            <div class="comment d-flex mb-4" data-comment-id="1">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm rounded-circle">
                                        <img class="avatar-img" src="View/assets/img/person-5.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2 ms-sm-3">
                                    <div class="comment-meta d-flex align-items-baseline">
                                        <h6 class="me-2">Jordan Singer</h6>
                                        <span class="text-muted">2d</span>
                                    </div>
                                    <div class="comment-body">
                                        <p>Khả năng sẽ thắng</p>
                                        <i class="fas fa-thumbs-up icon icon-like" style="background-color:white;"></i>
                                        <a class="btn_traloi" style="cursor: pointer;">Trả lời</a>
                                    </div>

                                    <div class="comment-replies bg-light p-3 mt-3 rounded">
                                        <h6 class="comment-replies-title mb-4 text-muted text-uppercase">2 replies</h6>

                                        <div class="reply d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <div class="avatar avatar-sm rounded-circle">
                                                    <img class="avatar-img" src="View/assets/img/person-4.jpg" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                                <div class="reply-meta d-flex align-items-baseline">
                                                    <h6 class="mb-0 me-2">Brandon Smith</h6>
                                                    <span class="text-muted">2d</span>
                                                </div>
                                                <div class="reply-body">
                                                    Đồng ý với bạn
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar avatar-sm rounded-circle">
                                                    <img class="avatar-img" src="View/assets/img/person-3.jpg" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                                <div class="reply-meta d-flex align-items-baseline">
                                                    <h6 class="mb-0 me-2">James Parsons</h6>
                                                    <span class="text-muted">1d</span>
                                                </div>
                                                <div class="reply-body">
                                                    hahhaha
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form trả lời -->
                                        <form action="" method="post" class="reply-form" style="display: none">
                                            <input type="hidden" name="parent_comment_id" class="parent-comment-id" value="1">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <label for="comment-message-1">Message</label>
                                                    <textarea class="form-control" id="comment-message-1" name="comment_message_reply" placeholder="Enter your message" cols="30" rows="3" required></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <input type="submit" class="btn btn-primary" value="Gửi">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="comment d-flex" data-comment-id="2">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm rounded-circle">
                                        <img class="avatar-img" src="View/assets/img/person-2.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="flex-shrink-1 ms-2 ms-sm-3">
                                    <div class="comment-meta d-flex">
                                        <h6 class="me-2">Santiago Roberts</h6>
                                        <span class="text-muted">4d</span>
                                    </div>
                                    <div class="comment-body">
                                        <p>Thứ 2</p>
                                        <i class="fas fa-thumbs-up icon icon-like" style="background-color:white;"></i>
                                        <a class="btn_traloi" style="cursor: pointer;">Trả lời</a>
                                    </div>
                                    <form action="" method="post" class="reply-form" style="display: none">
                                        <input type="hidden" name="parent_comment_id" class="parent-comment-id" value="2">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label for="comment-message-1">Message</label>
                                                <textarea class="form-control" id="comment-message-1" name="comment_message_reply" placeholder="Enter your message" cols="30" rows="3" required></textarea>
                                            </div>
                                            <div class="col-12">
                                                <input type="submit" class="btn btn-primary" value="Gửi">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- End Comments -->

                        <!-- ======= Comments Form ======= -->
                        <div class="row justify-content-center mt-5">
                            <div class="col-lg-12">
                                <h5 class="comment-title">Comment</h5>
                                <form action="" method="post">
                                    <div class="row">
                                        <!-- <div class="col-lg-6 mb-3">
                                            <label for="comment-name">Name</label>
                                            <input type="text" class="form-control" id="comment-name" name="comment_name" placeholder="Enter your name" required>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="comment-email">Email</label>
                                            <input type="email" class="form-control" id="comment-email" name="comment_email" placeholder="Enter your email" required>
                                        </div> -->
                                        <div class="col-12 mb-3">
                                            <label for="comment-message">Message</label>
                                            <textarea class="form-control" id="comment-message" name="comment_message" placeholder="Enter your message" cols="30" rows="10" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <input type="submit" class="btn btn-primary" value="Post comment">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Comments Form -->

                    </div>
                    <div class="col-md-3">
                        <!-- ======= Sidebar ======= -->
                        <div class="aside-block">

                            <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true">Popular</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill" data-bs-target="#pills-trending" type="button" role="tab" aria-controls="pills-trending" aria-selected="false">Trending</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="false">Latest</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">

                                <!-- Popular -->
                                <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                                    <?php
                                    if ($popular) {
                                        foreach ($popular as $post) {
                                            // Xử lý dữ liệu bài viết
                                            $post_meta_date = date('M jS \'y', strtotime($post['created_at']));
                                            $post_title = htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8');
                                            $post_link = 'index.php?act=single-post&post-id=' . htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8');
                                            $post_author = htmlspecialchars($post['author_name'], ENT_QUOTES, 'UTF-8');
                                            $post_thumbnail = htmlspecialchars(str_replace('../', '', $post['img_thumbnail']), ENT_QUOTES, 'UTF-8'); // Xóa ../ khỏi đường dẫn hình ảnh

                                            echo '<div class="post-entry-1 border-bottom">';
                                            echo '<div class="post-meta">';
                                            echo '<span class="date">' . htmlspecialchars($post['category_name'], ENT_QUOTES, 'UTF-8') . '</span>';
                                            echo '<span class="mx-1">&bullet;</span>';
                                            echo '<span>' . $post_meta_date . '</span>';
                                            echo '</div>';
                                            echo '<h2 class="mb-2"><a href="' . $post_link . '">' . $post_title . '</a></h2>';
                                            echo '<span class="author mb-3 d-block">' . $post_author . '</span>';
                                            if (!empty($post_thumbnail)) {
                                                echo '<img src="' . $post_thumbnail . '" alt="' . $post_title . '" class="img-fluid">';
                                            }
                                            echo '</div>';
                                        }
                                    } else {
                                        echo '<p>Không có bài viết phổ biến nào để hiển thị.</p>';
                                    }
                                    ?>

                                </div> <!-- End Popular -->

                                <!-- Trending -->
                                <div class="tab-pane fade" id="pills-trending" role="tabpanel" aria-labelledby="pills-trending-tab">
                                    <?php

                                    if ($top5_trending) {
                                        foreach ($top5_trending as $post) {
                                            // Xử lý dữ liệu bài viết
                                            $post_meta_date = date('d/m/Y', strtotime($post['created_at'])); // Định dạng ngày tháng năm
                                            $post_title = htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8');
                                            $post_link = 'index.php?act=single-post&post-id=' . htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8');
                                            $post_author = htmlspecialchars($post['author_name'], ENT_QUOTES, 'UTF-8');
                                            $post_thumbnail = htmlspecialchars(str_replace('../', '', $post['img_thumbnail']), ENT_QUOTES, 'UTF-8'); // Xóa ../ khỏi đường dẫn hình ảnh

                                            echo '<div class="post-entry-1 border-bottom">';
                                            echo '<div class="post-meta">';
                                            echo '<span class="date">' . htmlspecialchars($post['category_name'], ENT_QUOTES, 'UTF-8') . '</span>';
                                            echo '<span class="mx-1">&bullet;</span>';
                                            echo '<span>' . $post_meta_date . '</span>';
                                            echo '</div>';
                                            echo '<h2 class="mb-2"><a href="' . $post_link . '">' . $post_title . '</a></h2>';
                                            echo '<span class="author mb-3 d-block">' . $post_author . '</span>';
                                            if (!empty($post_thumbnail)) {
                                                echo '<img src="' . $post_thumbnail . '" alt="' . $post_title . '" class="img-fluid">';
                                            }
                                            echo '</div>';
                                        }
                                    } else {
                                        echo '<p>Không có bài viết thịnh hành nào để hiển thị.</p>';
                                    }
                                    ?>


                                </div> <!-- End Trending -->

                                <!-- Latest -->
                                <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                                    <?php
                                    if ($latest) {
                                        foreach ($latest as $post) {
                                            // Xử lý dữ liệu bài viết
                                            $post_meta_date = date('d/m/Y', strtotime($post['created_at'])); // Định dạng ngày tháng năm
                                            $post_title = htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8');
                                            $post_link = 'index.php?act=single-post&post-id=' . htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8');
                                            $post_author = htmlspecialchars($post['author_name'], ENT_QUOTES, 'UTF-8');
                                            $post_thumbnail = htmlspecialchars(str_replace('../', '', $post['img_thumbnail']), ENT_QUOTES, 'UTF-8'); // Xóa ../ khỏi đường dẫn hình ảnh

                                            echo '<div class="post-entry-1 border-bottom">';
                                            echo '<div class="post-meta">';
                                            echo '<span class="date">' . htmlspecialchars($post['category_name'], ENT_QUOTES, 'UTF-8') . '</span>';
                                            echo '<span class="mx-1">&bullet;</span>';
                                            echo '<span>' . $post_meta_date . '</span>';
                                            echo '</div>';
                                            echo '<h2 class="mb-2"><a href="' . $post_link . '">' . $post_title . '</a></h2>';
                                            echo '<span class="author mb-3 d-block">' . $post_author . '</span>';
                                            if (!empty($post_thumbnail)) {
                                                echo '<img src="' . $post_thumbnail . '" alt="' . $post_title . '" class="img-fluid">';
                                            }
                                            echo '</div>';
                                        }
                                    } else {
                                        echo '<p>Không có bài viết mới nào để hiển thị.</p>';
                                    }
                                    ?>

                                </div> <!-- End Latest -->

                            </div>
                        </div>

                        <div class="aside-block">
                            <h3 class="aside-title">Video</h3>
                            <div class="video-post">
                                <a href="https://www.youtube.com/watch?v=XwxOxw3gveo" class="glightbox link-video">
                                    <span class="bi-play-fill"></span>
                                    <img src="uploads/video/video1.jpg" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div><!-- End Video -->

                        <div class="aside-block">
                            <h3 class="aside-title">Categories</h3>
                            <ul class="aside-links list-unstyled">
                                <?php
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        // Lấy thông tin từ biến $category
                                        $category_id = htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
                                        $category_name = htmlspecialchars($category['name_category'], ENT_QUOTES, 'UTF-8');

                                        echo '<li><a href="index.php?act=category&id=' . $category_id . '"><i class="bi bi-chevron-right"></i> ' . $category_name . '</a></li>';
                                    }
                                } else {
                                    echo '<li><a href="#"><i class="bi bi-chevron-right"></i> Không có danh mục nào</a></li>';
                                }
                                ?>

                            </ul>
                        </div><!-- End Categories -->

                        <div class="aside-block">
                            <h3 class="aside-title">Tags</h3>
                            <ul class="aside-tags list-unstyled">
                                <?php
                                if ($tags != null) {
                                    foreach ($tags as $tag) {
                                        $tag_link = 'index.php?act=category&id=' . urlencode($tag['tag_id']);
                                        //echo '<li><a href="' . htmlspecialchars($tag_link, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($tag['tag_name'], ENT_QUOTES, 'UTF-8') . '</a></li>';
                                        echo '<li><a href="' . htmlspecialchars("#", ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($tag['tag_name'], ENT_QUOTES, 'UTF-8') . '</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div><!-- End Tags -->

                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php require_once PATH_VIEW_CLIENT . "/layout/footer.php";  ?>
    <!-- ======== END Footer=== -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="View/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="View/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="View/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="View/assets/vendor/aos/aos.js"></script>
    <script src="View/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="View/assets/js/main.js"></script>
    <script>
        document.querySelectorAll('.btn_traloi').forEach(function(button) {
            button.addEventListener('click', function() {
                var commentElement = this.closest('.comment');
                var replyForm = commentElement.querySelector('.reply-form');

                if (replyForm.style.display === 'none' || replyForm.style.display === '') {
                    replyForm.style.display = 'block';
                } else {
                    replyForm.style.display = 'none';
                }
            });
        });



        document.querySelector('.icon-like').addEventListener('click', function() {
            this.classList.toggle('icon-liked');
        });
    </script>

</body>

</html>