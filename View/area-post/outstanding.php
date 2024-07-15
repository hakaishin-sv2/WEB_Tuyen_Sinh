<?php
if (!isset($_SESSION['viewed_posts'])) {
    $_SESSION['viewed_posts'] = [];
} 
?>

<section id="posts" class="posts">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">
<div class="col-lg-4">
<?php
$post_id = $post_view_caonhat['id'];
$avatar =preg_replace('/^\.\.\//', '', $post_view_caonhat['avatar']);
$title = $post_view_caonhat['title'];
$area = $post_view_caonhat['area'];
$excerpt = $post_view_caonhat['excerpt'];
$content = $post_view_caonhat['content'];
$category_name = $post_view_caonhat['category_name'];
$author_name = $post_view_caonhat['author_name'];
$author_email = $post_view_caonhat['author_email'];
$img_thumbnail = preg_replace('/^\.\.\//', '', $post_view_caonhat['img_thumbnail']); // Loại bỏ ký tự / ở đầu
$img_cover = $post_view_caonhat['img_cover'];
$status = $post_view_caonhat['status'];
$is_trending = $post_view_caonhat['is_trending'];
$created_at = date('d/m/Y', strtotime($post_view_caonhat['created_at']));
$updated_at = $post_view_caonhat['updated_at'];
$pheduyet_name = $post_view_caonhat['pheduyet_name'];
$view_count = $post_view_caonhat['views_count'];
?>
<div class="post-entry-1 lg">
    <a href="index.php?act=single-post&post-id=<?php echo $post_id; ?>"><img src="<?php echo $img_thumbnail; ?>" alt="" class="img-fluid"></a>
    <div class="post-meta"><span class="date"><?php echo $category_name; ?></span> <span class="mx-1">&bullet;</span> <span><?php echo $created_at; ?></span></div>
    <h2><a href="index.php?act=single-post&post-id=<?php echo $post_id; ?>"><?php echo $title; ?></a></h2>
    <p class="mb-4 d-block"><?php echo $excerpt; ?></p>

    <div class="d-flex align-items-center author">
        <div class="photo"><img src="<?php  echo $avatar; ?>" alt="" class="img-fluid" style="width: 30px;height: 30px;"></div>
        <div class="name">
            <h3 class="m-0 p-0"><?php echo $author_name; ?></h3>
        </div>
    </div>
</div>
<!-- end bài có view cao nhất -->
</div>

          <div class="col-lg-8">
            <div class="row g-5">
              <div class="col-lg-4 border-start custom-border">
              <?php for ($i = 0; $i < min(3, count($top6_post_new)); $i++) : ?>
                <?php $post = $top6_post_new[$i]; ?>
                <div class="post-entry-1">
                    <a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>"><img src="<?php echo str_replace('../', '', $post['img_thumbnail']); ?>" alt="<?php echo $post['title']; ?>" class="img-fluid"></a>
                    <div class="post-meta">
                        <span class="date"><?php echo $post['category_name']; ?></span>
                        <span class="mx-1">&bullet;</span>
                        <span><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></span>
                    </div>
                    <h2 class="mt-3"><a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
                </div>
              <?php endfor; ?>  
              </div>
              <div class="col-lg-4 border-start custom-border">
              <?php for ($i = 3; $i < min(6, count($top6_post_new)); $i++) : ?>
                <?php $post = $top6_post_new[$i]; ?>
                <div class="post-entry-1">
                    <a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>"><img src="<?php echo str_replace('../', '', $post['img_thumbnail']); ?>" alt="<?php echo $post['title']; ?>" class="img-fluid"></a>
                    <div class="post-meta">
                        <span class="date"><?php echo $post['category_name']; ?></span>
                        <span class="mx-1">&bullet;</span>
                        <span><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></span>
                    </div>
                    <h2 class="mt-3"><a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
                </div>
               
              <?php endfor; ?>  
              </div>

              <!-- Trending Section -->
              <div class="col-lg-4">
                <div class="trending">
                  <h3>Trending</h3>
                  <ul class="trending-post">
                  <?php  foreach ($top5_trending as $post): ?>
                    <li>
                      <a href="index.php?act=single-post&post-id=<?php echo $post['id']; ?>">
                      <img src="<?php echo str_replace('../', '', $post['img_thumbnail']); ?>" alt="<?php echo $post['title']; ?>" width="200" height="80">
                      <span class="number">1</span>
                      <h3><?php echo $post['title']; ?></h3>
                      <span class="author"><?php echo "Author: ". $post['author_name']; ?></span>
                      <br>
                     
                      <span class="author <?php echo (isset($_SESSION['viewed_posts']) && in_array($post['id'], $_SESSION['viewed_posts'])) ? 'badge badge-success' : 'badge badge-secondary'; ?>">
                        <?php echo (isset($_SESSION['viewed_posts']) && in_array($post['id'], $_SESSION['viewed_posts'])) ? 'Đã xem' : 'Chưa xem'; ?>
                      </span>
                    </a>
                  </li>
                  <?php endforeach; ?>

                  </ul>

                </div>
              </div> <!-- End Trending Section -->
            </div>
          </div>

        </div> <!-- End .row -->
      </div>
    </section>