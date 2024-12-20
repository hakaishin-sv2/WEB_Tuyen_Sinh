<footer id="footer" class="footer">

  <div class="footer-content">
    <div class="container">

      <div class="row g-5">
        <div class="col-lg-4">
          <h3 class="footer-heading">About Sport</h3>
          <p>Tầng 6, Tòa nhà Ladeco,Phường Liễu Giai, Quận Ba Đình Thành Phố Hà Nội

            19006750

            support@sapo.vn</p>
          <p><a href="about.html" class="footer-link-more">Learn More</a></p>
        </div>
        <div class="col-6 col-lg-2">
          <h3 class="footer-heading">Navigation</h3>
          <ul class="footer-links list-unstyled">
            <li><a href="index.php"><i class="bi bi-chevron-right"></i> Tin Tức</a></li>
            <!-- <li><a href="index.html"><i class="bi bi-chevron-right"></i> Blog</a></li> -->
            <li><a href="#"><i class="bi bi-chevron-right"></i> Categories</a></li>
            <!-- <li><a href="single-post.html"><i class="bi bi-chevron-right"></i> Single Post</a></li> -->
            <li><a href="index.php?actabout.php"><i class="bi bi-chevron-right"></i> About</a></li>
            <li><a href="index.php?act=contact.php"><i class="bi bi-chevron-right"></i> Contact</a></li>
          </ul>
        </div>
        <div class="col-6 col-lg-2">
          <h3 class="footer-heading">Categories</h3>
          <ul class="footer-links list-unstyled">
            <?php $categories = get_all_categories($conn);  ?>
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
        </div>

        <div class="col-lg-4">
          <h3 class="footer-heading">Recent Posts</h3>

          <ul class="footer-links footer-blog-entry list-unstyled">
            <?php
            $top6_post_new      = get_top6_new_post($conn);
            for ($i = 0; $i < 5; $i++) {
              $post = $top6_post_new[$i]; // Lấy dữ liệu từ mảng $top6_post_new
            ?>
              <li>
                <a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>" class="d-flex align-items-center">
                  <img src="<?php echo str_replace('../', '', $post['img_thumbnail']); ?>" alt="<?php echo $post['title']; ?>" class="img-fluid me-3">
                  <div>
                    <div class="post-meta d-block"><span class="date"><?php echo $post['category_name']; ?></span> <span class="mx-1">&bullet;</span> <span><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></span></div>
                    <span><?php echo $post['title']; ?></span>
                  </div>
                </a>
              </li>
            <?php
            }
            ?>

          </ul>

        </div>
      </div>
    </div>
  </div>

  <div class="footer-legal">
    <div class="container">

      <div class="row justify-content-between">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
          <div class="copyright">
            © Copyright <strong><span>ZenBlog</span></strong>. All Rights Reserved
          </div>

          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>

        </div>

        <div class="col-md-6">
          <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>

        </div>

      </div>

    </div>
  </div>

</footer>