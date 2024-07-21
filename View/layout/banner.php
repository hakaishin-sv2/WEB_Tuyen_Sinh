<section id="hero-slider" class="hero-slider">
  <div class="container-md" data-aos="fade-in">
    <div class="row">
      <div class="col-12">
        <div class="swiper sliderFeaturedPosts">
          <div class="swiper-wrapper">
            <!-- 6 bài viết mới nhất và có nhiều view nhất trong 7 ngày -->
            <?php foreach ($banner_post as $post) : ?>
              <div class="swiper-slide">
                <a href="index.php?act=single-post&post-id=<?php echo htmlspecialchars($post['id']); ?>" class="img-bg d-flex align-items-end" style="background-image: url('<?php echo htmlspecialchars(str_replace('../', '', $post['img_thumbnail'])); ?>');">
                  <div class="img-bg-inner">
                    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                    <p><?php echo htmlspecialchars(substr($post['excerpt'], 0, 150)); ?>...</p>
                  </div>
                </a>
              </div>
            <?php endforeach; ?>

          </div>
          <div class="custom-swiper-button-next">
            <span class="bi-chevron-right"></span>
          </div>
          <div class="custom-swiper-button-prev">
            <span class="bi-chevron-left"></span>
          </div>

          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </div>
</section>