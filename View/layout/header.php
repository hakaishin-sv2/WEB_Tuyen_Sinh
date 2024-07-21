<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <a href="index.php" class="logo d-flex align-items-center">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="assets/img/logo.png" alt=""> -->
      <h1>Sport 24/7</h1>
    </a>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a href="index.php">Tin Tức</a></li>
        <!-- <li><a href="single-post.html">Single Post</a></li> -->
        <li class="dropdown"><a href="#"><span>Categories</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
          <ul>

            <!-- <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                <li><a href="#">Deep Drop Down 1</a></li>
                <li><a href="#">Deep Drop Down 2</a></li>
                <li><a href="#">Deep Drop Down 3</a></li>
                <li><a href="#">Deep Drop Down 4</a></li>
                <li><a href="#">Deep Drop Down 5</a></li>
              </ul>
            </li> -->
            <li><a href="search-result.php">Search Result</a></li>
            <?php $categories = get_all_categories($conn);  ?>
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
        </li>

        <li><a href="index.php?act=about">About</a></li>
        <li><a href="index.php?act=contact">Contact</a></li>
      </ul>
    </nav><!-- .navbar -->

    <div class="position-relative">
      <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
      <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
      <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

      <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
      <i class="bi bi-list mobile-nav-toggle"></i>

      <!-- ======= Search Form ======= -->
      <div class="search-form-wrap js-search-form-wrap">
        <form class="search-form" action="/www-web-blog/index.php" method="get">
          <span class="icon bi-search"></span>
          <input type="hidden" name="act" value="searchresult">
          <input type="text" placeholder="Search" class="form-control" name="search">
          <input type="submit" hidden id="timkiem" name="post_result">
          <button class="btn js-search-close"><span class="bi-x"></span></button>
        </form>
      </div><!-- End Search Form -->
      <!-- Dropdown Menu -->
      <div class="dropdown d-inline-block">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="bi-person"></span> <!-- Icon đại diện cho người dùng -->
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="index.php?act=change-password">Đổi mật khẩu</a></li>
          <li><a class="dropdown-item" href="index.php?act=logout">Logout</a></li>
          <?php if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) : ?>
            <?php
            $user_role = $_SESSION["user"]['role']; // Lấy vai trò từ session

            if ($user_role == 2) :
            ?>
              <li><a class="dropdown-item" href="index.php?act=list-posts">Phê duyệt bài viết</a></li>
            <?php elseif ($user_role == 3) : ?>
              <li><a class="dropdown-item" href="index.php?act=list-posts">Tạo bài viết</a></li>
            <?php endif; ?>
          <?php endif; ?>

        </ul>
      </div>
      <!-- Vào trang dashboard cline -->
    </div>

  </div>

</header>

<script>

</script>