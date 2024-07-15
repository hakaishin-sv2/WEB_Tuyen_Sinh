<section class="category-section">
  <div class="container" data-aos="fade-up">

    <div class="section-header d-flex justify-content-between align-items-center mb-5">
      <h2>Bóng đá thế giới</h2>
      <div><a href="category.html" class="more">Xem tất cả</a></div>
    </div>

    <div class="row">
      <div class="col-md-9">

        <!-- Bài viết danh mục bóng đá có view cao nhất -->
        <div class="d-lg-flex post-entry-2">
          <a href="index.php?act=single-post&post-id=<?php echo $top1_viewcount_football_world['id']; ?>" class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
            <img src="<?php echo str_replace('../', '', $top1_viewcount_football_world['img_thumbnail']); ?>" alt="<?php echo $top1_viewcount_football_world['title']; ?>" class="img-fluid">
          </a>
          <div>
            <div class="post-meta"><span class="date"><?php echo $top1_viewcount_football_world['category_name']; ?></span> <span class="mx-1">&bullet;</span> <span><?php echo date('d/m/Y', strtotime($top1_viewcount_football_world['created_at'])); ?></span></div>
            <h3><a href="index.php?act=single-post&post-id=<?php echo $top1_viewcount_football_world['id']; ?>"><?php echo $top1_viewcount_football_world['title']; ?></a></h3>
            <p><?php echo $top1_viewcount_football_world['excerpt']; ?></p>
            <div class="d-flex align-items-center author">
              <div class="photo"><img src="<?php echo str_replace('../', '', $top1_viewcount_football_world['avatar']) ?>" class="img-fluid" style="width: 30px; height: 30px;"></div>
              <div class="name">
                <h3 class="m-0 p-0"><?php echo $top1_viewcount_football_world['author_name']; ?></h3>
              </div>
            </div>
          </div>
        </div>
        <!-- END Bài viết danh mục bóng đá có view cao nhất -->

        <!-- Top 3 bài bóng đá thế giới mới được tạo mới nhất -->
        <div class="row">
          <div class="col-lg-4">
            <div class="post-entry-1 border-bottom">
              <a href="index.php?act=single-post&post-id=<?php echo $top3_newposst_football_world[0]['id']; ?>"><img src="<?php echo str_replace('../', '', $top3_newposst_football_world[0]['img_thumbnail']); ?>" alt="" class="img-fluid"></a>
              <div class="post-meta">
                <span class="date"><?php echo $top3_newposst_football_world[0]['category_name']; ?></span>
                <span class="mx-1">&bullet;</span>
                <span><?php echo date('d/m/Y', strtotime($top3_newposst_football_world[0]['created_at'])); ?></span>
              </div>
              <h2 class="mb-2"><a href="index.php?act=single-post&post-id=<?php echo $top3_newposst_football_world[0]['id']; ?>"><?php echo $top3_newposst_football_world[0]['title']; ?></a></h2>
              <span class="author mb-3 d-block"><?php echo "Author: " . $top3_newposst_football_world[0]['author_name']; ?></span>
              <p class="mb-4 d-block"><?php echo $top3_newposst_football_world[0]['excerpt']; ?></p>
            </div>
            <div class="post-entry-1">
              <a href="index.php?act=single-post&post-id=<?php echo $top3_newposst_football_world[1]['id']; ?>">
                <img src="<?php echo str_replace('../', '', $top3_newposst_football_world[1]['img_thumbnail']); ?>" alt="" class="img-fluid">
              </a>
              <div class="post-meta">
                <span class="date"><?php echo $top3_newposst_football_world[1]['category_name']; ?></span>
                <span class="mx-1">&bullet;</span>
                <span><?php echo date('d/m/Y', strtotime($top3_newposst_football_world[1]['created_at'])); ?></span>
              </div>
              <h2 class="mb-2"><a href="index.php?act=single-post&post-id=<?php echo $top3_newposst_football_world[1]['id']; ?>"><?php echo $top3_newposst_football_world[1]['title']; ?></a></h2>
              <span class="author mb-3 d-block"><?php echo $top3_newposst_football_world[1]['author_name']; ?></span>
            </div>


          </div>
          <div class="col-lg-8">
            <div class="post-entry-1">
              <a href="index.php?act=single-post&post-id=<?php echo $top3_newposst_football_world[2]['id']; ?>">
                <img src="<?php echo str_replace('../', '', $top3_newposst_football_world[2]['img_thumbnail']); ?>" alt="" class="img-fluid">
              </a>
              <div class="post-meta">
                <span class="date"><?php echo $top3_newposst_football_world[2]['category_name']; ?></span>
                <span class="mx-1">&bullet;</span>
                <span><?php echo date('d/m/Y', strtotime($top3_newposst_football_world[2]['created_at'])); ?></span>
              </div>
              <h2 class="mb-2"><a href="index.php?act=single-post&post-id=<?php echo $top3_newposst_football_world[2]['id']; ?>"><?php echo $top3_newposst_football_world[2]['title']; ?></a></h2>
              <span class="author mb-3 d-block"><?php echo $top3_newposst_football_world[2]['author_name']; ?></span>
              <p class="mb-4 d-block"><?php echo $top3_newposst_football_world[2]['excerpt']; ?></p>
            </div>
          </div>

        </div>
      </div>
      <!--END Top 3 bài bóng đá thế giới mới được tạo mới nhất -->

      <!-- Tôp 6 bài mới được tạo của bóng đá ngoài nước và là trending  -->
      <div class="col-md-3">
        <?php foreach ($top6_trending_football_world as $post) : ?>
          <div class="post-entry-1 border-bottom">
            <a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>">
              <img src="<?php echo str_replace('../', '', $post['img_thumbnail']); ?>" alt="" class="img-fluid" style="width: 200px; height: 100px;">
            </a>
            <div class="post-meta">
              <span class="date"><?php echo $post['category_name']; ?></span>
              <span class="mx-1">&bullet;</span>
              <span><?php echo date('d M Y', strtotime($post['created_at'])); ?></span>
            </div>
            <h2 class="mb-2">
              <a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>">
                <?php echo $post['title']; ?>
              </a>
            </h2>
            <span class="author mb-3 d-block"><?php echo $post['author_name']; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <!-- End top 6 post bống đá ngoài nước là trending -->

    </div>
  </div>
</section>