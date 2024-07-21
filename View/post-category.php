<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ZenBlog Bootstrap Template - Search Results</title>
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

        <!-- ======= Search Results ======= -->
        <section id="search-result" class="search-result">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="category-title">Danh mục bài viết</h3>
                        <h5 class="comment-title py-4"><?php echo $total_posts; ?> bài viết thuộc danh mục <?= $posts[0]["category_name"] ?? null  ?></h5>
                        <?php foreach ($posts as $post) : ?>
                            <div class="d-md-flex post-entry-2 small-img">
                                <a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>" class="me-4 thumbnail">
                                    <img src="<?php echo  htmlspecialchars(str_replace('../', '', $post['img_thumbnail'])); ?>" alt="" class="img-fluid">
                                </a>
                                <div>
                                    <div class="post-meta">
                                        <span class="date"><?php echo htmlspecialchars($post['category_name']); ?></span>
                                        <span class="mx-1">&bullet;</span>
                                        <span><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></span>
                                    </div>
                                    <h3>
                                        <a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>">
                                            <?php echo htmlspecialchars($post['title']); ?>
                                        </a>
                                    </h3>
                                    <p><?php echo htmlspecialchars($post['excerpt']); ?></p>
                                    <div class="d-flex align-items-center author">
                                        <div class="photo">
                                            <img src="<?php echo htmlspecialchars(str_replace('../', '', $post['author_avatar'])); ?>" alt="" class="img-fluid" style="width: 30px;height: 30px;">
                                        </div>
                                        <div class="name">
                                            <h3 class="m-0 p-0"><?php echo htmlspecialchars($post['author_name']); ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Paging -->
                        <div class="text-start py-4">
                            <div class="custom-pagination">
                                <?php
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $category_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
                                if ($page > 1) : ?>
                                    <a href="index.php?act=category&id=<?php echo $category_id; ?>&page=<?php echo $page - 1; ?>" class="prev">Previous</a>
                                <?php endif; ?>
                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                    <a href="index.php?act=category&id=<?php echo $category_id; ?>&page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                                <?php endfor; ?>
                                <?php if ($page < $total_pages) : ?>
                                    <a href="index.php?act=category&id=<?php echo $category_id; ?>&page=<?php echo $page + 1; ?>" class="next">Next</a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- End Paging -->

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
                            <h3 class="aside-title">Categories</h3>
                            <ul class="aside-links list-unstyled">
                                <?php
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        // Lấy thông tin từ biến $category
                                        $category_id = htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
                                        $category_name = htmlspecialchars($category['name_category'], ENT_QUOTES, 'UTF-8');

                                        echo '<li><a href="index.php?act=category&id=' . $category_id . '&page=1">' . htmlspecialchars($category_name) . '</a></li>';
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
                                <li><a href="category.html">Business</a></li>
                                <li><a href="category.html">Culture</a></li>
                                <li><a href="category.html">Sport</a></li>
                                <li><a href="category.html">Food</a></li>
                                <li><a href="category.html">Politics</a></li>
                                <li><a href="category.html">Celebrity</a></li>
                                <li><a href="category.html">Startups</a></li>
                                <li><a href="category.html">Travel</a></li>
                            </ul>
                        </div><!-- End Tags -->

                    </div>

                </div>
            </div>
        </section> <!-- End Search Result -->

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