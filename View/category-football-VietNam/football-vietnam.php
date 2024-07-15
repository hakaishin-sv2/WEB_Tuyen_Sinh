<section class="category-section">
  <div class="container" data-aos="fade-up">

    <div class="section-header d-flex justify-content-between align-items-center mb-5">
      <h2>Bóng đá Việt Nam</h2>
      <div><a href="category.html" class="more">Xem tất cả </a></div>
    </div>

    <div class="row">
      <div class="col-md-9 order-md-2">

        <!--  Bài viết có vie cao nhất thuốc danh mục bóng đá việt nam -->
        <div class="d-lg-flex post-entry-2">
          <a href="index.php?act=single-post&post-id=<?php echo $top1_viewcount_football_VietNam['id']; ?>" class="me-4 thumbnail d-inline-block mb-4 mb-lg-0">
            <img src="<?php echo str_replace('../', '', $top1_viewcount_football_VietNam['img_thumbnail']); ?>" alt="" class="img-fluid">
          </a>
          <div>
            <div class="post-meta">
              <span class="date"><?php echo $top1_viewcount_football_VietNam['category_name']; ?></span>
              <span class="mx-1">&bullet;</span>
              <span><?php echo date('d M Y', strtotime($top1_viewcount_football_VietNam['created_at'])); ?></span>
            </div>
            <h3><a href="index.php?act=single-post&post-id=<?php echo $top1_viewcount_football_VietNam['id']; ?>"><?php echo $top1_viewcount_football_VietNam['title']; ?></a></h3>
            <p><?php echo $top1_viewcount_football_VietNam['excerpt']; ?></p>
            <div class="d-flex align-items-center author">
              <div class="photo"><img src="<?php echo str_replace('../', '', $top1_viewcount_football_VietNam['avatar']); ?>" alt="" class="img-fluid" style="width: 50px; height: 50px;"></div>
              <div class="name">
                <h3 class="m-0 p-0"><?php echo $top1_viewcount_football_VietNam['author_name']; ?></h3>
              </div>
            </div>
          </div>
        </div>

        <!--  Eng bài viết có view cao nhất foot ball in category  bóng đá việt nam -->

        <!-- 3 bài viết mới nhât của bóng đá danh mục bống đá việt nam -->
        <div class="row">
          <div class="col-lg-4">
            <div class="post-entry-1 border-bottom">
              <a href="index.php?act=single-post&post-id=<?php echo $top3_newposst_football_VietNam[0]['id']; ?>"><img src="<?php echo str_replace('../', '', $top3_newposst_football_VietNam[0]['img_thumbnail']); ?>" alt="" class="img-fluid"></a>
              <div class="post-meta">
                <span class="date"><?php echo $top3_newposst_football_VietNam[0]['category_name']; ?></span>
                <span class="mx-1">&bullet;</span>
                <span><?php echo date('d M Y', strtotime($top3_newposst_football_VietNam[0]['created_at'])); ?></span>
              </div>
              <h2 class="mb-2"><a href="index.php?act=single-post&post-id=<?php echo $top3_newposst_football_VietNam[0]['id']; ?>"><?php echo $top3_newposst_football_VietNam[0]['title']; ?></a></h2>
              <span class="author mb-3 d-block"><?php echo "Author: " . $top3_newposst_football_VietNam[0]['author_name']; ?></span>
              <p class="mb-4 d-block"><?php echo $top3_newposst_football_VietNam[0]['excerpt']; ?></p>
            </div>
            <?php if (isset($top6_trending_football_VietNam[1])) : ?>
              <div class="post-entry-1">
                <a href="index.php?act=single-post&post-id=<?php echo $top6_trending_football_VietNam[1]['id']; ?>">
                  <img src="<?php echo str_replace('../', '', $top6_trending_football_VietNam[1]['img_thumbnail']); ?>" alt="" class="img-fluid">
                </a>
                <div class="post-meta">
                  <span class="date"><?php echo $top6_trending_football_VietNam[1]['category_name']; ?></span>
                  <span class="mx-1">&bullet;</span>
                  <span><?php echo date('d M Y', strtotime($top6_trending_football_VietNam[1]['created_at'])); ?></span>
                </div>
                <h2 class="mb-2"><a href="index.php?act=single-post&post-id=<?php echo $top6_trending_football_VietNam[1]['id']; ?>"><?php echo $top6_trending_football_VietNam[1]['title']; ?></a></h2>
                <span class="author mb-3 d-block"><?php echo $top6_trending_football_VietNam[1]['author_name']; ?></span>
              </div>
            <?php endif; ?>
          </div>
          <div class="col-lg-8">
            <div class="post-entry-1">
              <a href="index.php?act=single-post&post-id=<?php echo $top3_newposst_football_VietNam[2]['id']; ?>">
                <img src="<?php echo str_replace('../', '', $top3_newposst_football_VietNam[2]['img_thumbnail']); ?>" alt="" class="img-fluid">
              </a>
              <div class="post-meta">
                <span class="date"><?php echo $top3_newposst_football_VietNam[2]['category_name']; ?></span>
                <span class="mx-1">&bullet;</span>
                <span><?php echo date('d M Y', strtotime($top3_newposst_football_VietNam[2]['created_at'])); ?></span>
              </div>
              <h2 class="mb-2"><a href="index.php?act=single-post&post-id=<?php echo $top3_newposst_football_VietNam[2]['id']; ?>"><?php echo $top3_newposst_football_VietNam[2]['title']; ?></a></h2>
              <span class="author mb-3 d-block"><?php echo $top3_newposst_football_VietNam[2]['author_name']; ?></span>
              <p class="mb-4 d-block"><?php echo $top3_newposst_football_VietNam[2]['excerpt']; ?></p>
            </div>
          </div>
        </div>
      </div>
      <!-- AND top 3 post category in viet nam -->

      <!-- top 6 trending và mới nhất danh mục bống đá Trong Nước -->
      <div class="col-md-3">
        <?php foreach ($top6_trending_football_VietNam as $index => $post) : ?>
          <div class="post-entry-1 border-bottom">
            <a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>">
              <img src="<?php echo str_replace('../', '', $post['img_thumbnail']); ?>" alt="<?php echo $post['title']; ?>" class="img-fluid" style="width: 200px; height: 100px;">
            </a>
            <div class="post-meta">
              <span class="date"><?php echo date('d M Y', strtotime($post['created_at'])); ?></span>
              <span class="mx-1">&bullet;</span>
              <span><?php echo $post['category_name']; ?></span>
            </div>
            <h2 class="mb-2"><a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
            <span class="author mb-3 d-block"><?php echo "Author: " . $post['author_name']; ?></span>

            <span class="author <?php echo (isset($_SESSION['viewed_posts']) && in_array($post['id'], $_SESSION['viewed_posts'])) ? 'badge badge-success' : 'badge badge-secondary'; ?>">
              <?php echo (isset($_SESSION['viewed_posts']) && in_array($post['id'], $_SESSION['viewed_posts'])) ? 'Đã xem' : 'Chưa xem'; ?>
            </span>
          </div>

        <?php endforeach; ?>


      </div>
      <!-- END top 6 trending và mới nhất danh mục bống đá Trong Nước -->
    </div>
  </div>
</section>