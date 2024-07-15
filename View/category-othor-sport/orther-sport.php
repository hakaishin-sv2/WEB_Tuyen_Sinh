<section class="category-section">
  <div class="container" data-aos="fade-up">

    <div class="section-header d-flex justify-content-between align-items-center mb-5">
      <h2>Bộ môn khác</h2>
      <div><a href="category.html" class="more">Xem tất cả</a></div>
    </div>

    <div class="row g-5">
      <!--  bài có view cao nhất  -->
      <div class="col-lg-4">

        <div class="post-entry-1 lg">
          <a href="index.php?act=single-post&post-id=<?php echo $post_view_caonhat_orther_sporrt[0]['id']; ?>">
            <img src="<?php echo str_replace('../', '', $post_view_caonhat_orther_sporrt[0]['img_thumbnail']); ?>" alt="" class="img-fluid">
          </a>
          <div class="post-meta">
            <span class="date"><?php echo  date('d/m/Y', strtotime($post_view_caonhat_orther_sporrt[0]['created_at'])); ?></span>
            <span class="mx-1">&bullet;</span>
            <span><?php echo $post_view_caonhat_orther_sporrt[0]['category_name']; ?></span>
          </div>
          <h2><a href="index.php?act=single-post&post-id=<?php echo $post_view_caonhat_orther_sporrt[0]['id']; ?>"><?php echo $post_view_caonhat_orther_sporrt[0]['title']; ?></a></h2>
          <p class="mb-4 d-block"><?php echo $post_view_caonhat_orther_sporrt[0]['excerpt']; ?></p>
          <div class="d-flex align-items-center author">
            <div class="photo"><img src="<?php echo str_replace('../', '', $post_view_caonhat_orther_sporrt[0]['avatar']); ?>" alt="" class="img-fluid" style="width: 30px; height: 30px;"></div>
            <div class="name">
              <h3 class="m-0 p-0"><?php echo $post_view_caonhat_orther_sporrt[0]['author_name']; ?></h3>
            </div>
          </div>

        </div>
        <!-- END  bài có view cao nhất  -->

        <?php if (!empty($post_view_caonhat_orther_sporrt[1])) : ?>
          <div class="post-entry-1 border-bottom">
            <div class="post-meta">
              <span class="date"><?php echo $post_view_caonhat_orther_sporrt[0]['category_name']; ?></span>
              <span class="mx-1">&bullet;</span>
              <span><?php echo  date('d F Y', strtotime($post_view_caonhat_orther_sporrt[1]['created_at'])); ?></span>
            </div>
            <h2 class="mb-2"><a href="index.php?act=single-post&post-id=<?php echo $post_view_caonhat_orther_sporrt[0]['id']; ?>"><?php echo $post_view_caonhat_orther_sporrt[1]['title']; ?></a></h2>
            <span class="author mb-3 d-block"><?php echo $post_view_caonhat_orther_sporrt[1]['author_name']; ?></span>
          </div>

          <?php if (!empty($post_view_caonhat_orther_sporrt[2])) : ?>
            <div class="post-entry-1">
              <div class="post-meta">
                <span class="date"><?php echo $post_view_caonhat_orther_sporrt[2]['category_name']; ?></span>
                <span class="mx-1">&bullet;</span>
                <span><?php echo  date('d F Y', strtotime($post_view_caonhat_orther_sporrt[1]['created_at'])); ?></span>
              </div>
              <h2 class="mb-2"><a href="index.php?act=single-post&post-id=<?php echo $post_view_caonhat_orther_sporrt[2]['id']; ?>"><?php echo $post_view_caonhat_orther_sporrt[2]['title']; ?></a></h2>
              <span class="author mb-3 d-block"><?php echo $post_view_caonhat_orther_sporrt[2]['author_name']; ?></span>
            </div>
          <?php endif; ?>

        <?php endif; ?>

      </div>

      <div class="col-lg-8">
        <div class="row g-5">
          <!-- Top 6 bài viets mới nhất -->
          <div class="col-lg-4 border-start custom-border">
            <?php
            for ($i = 0; $i < 3; $i++) :
              $post = $top6_post_new_orther_sport[$i];
            ?>

              <div class="post-entry-1">
                <a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>">
                  <img src="<?php echo str_replace('../', '', $post['img_thumbnail']); ?>" alt="<?php echo $post['title']; ?>" class="img-fluid">
                </a>
                <div class="post-meta">
                  <span class="date"><?php echo $post['category_name']; ?></span>
                  <span class="mx-1">&bullet;</span>
                  <span><?php echo  date('d/m/Y', strtotime($post['created_at'])); ?></span>
                </div>
                <h2><a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
              </div>

            <?php
            endfor;
            ?>
          </div>
          <div class="col-lg-4 border-start custom-border">
            <?php
            for ($i = 3; $i < 6; $i++) :
              $post = $top6_post_new_orther_sport[$i];
            ?>

              <div class="post-entry-1">
                <a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>">
                  <img src="<?php echo str_replace('../', '', $post['img_thumbnail']); ?>" alt="<?php echo $post['title']; ?>" class="img-fluid">
                </a>
                <div class="post-meta">
                  <span class="date"><?php echo $post['category_name']; ?></span>
                  <span class="mx-1">&bullet;</span>
                  <span><?php echo  date('d/m/Y', strtotime($post['created_at'])); ?></span>
                </div>
                <h2><a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
              </div>

            <?php
            endfor;
            ?>

          </div>
          <!-- Top 6 bài viets mới nhất -->

          <!-- Top 6 bài viets là trending -->
          <div class="col-lg-4">
            <?php foreach ($top3_trending_orther_sport as $post) : ?>
              <div class="post-entry-1 border-bottom">
                <a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>">
                  <img src="<?php echo str_replace('../', '', $post['img_thumbnail']); ?>" alt="<?php echo $post['title']; ?>" width="200" height="80" class="img-fluid">
                </a>
                <div class="post-meta">
                  <span class="date"><?php echo $post['category_name']; ?></span>
                  <span class="mx-1">&bullet;</span>
                  <span><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></span>
                </div>
                <h2 class="mb-2"><a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
                <span class="author mb-3 d-block"><?php echo $post['author_name']; ?></span>
              </div>
            <?php endforeach; ?>
          </div>
          <!-- END Top 6 bài viets là trending -->
        </div>
      </div>

    </div> <!-- End .row -->
  </div>
</section>