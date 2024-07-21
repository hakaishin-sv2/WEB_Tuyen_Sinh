<?php
function HomeIndex($conn)
{
    // banner
    $banner_post = get_top_6_posts_recent_and_most_viewed($conn);

    $post_view_caonhat  = get_post_view_biggest($conn);
    $top6_post_new      = get_top6_new_post($conn);
    $top5_trending      = get_top5_trending_posts($conn);
    // danh mục bóng đá thế giới
    $top1_viewcount_football_world  = bai_viet_view_count_nhat_theWorld($conn);
    $top6_trending_football_world   = get_top6_posts_by_category_and_area_theWorld($conn);
    $top3_newposst_football_world   = get_top3_latest_posts_by_category_theWord($conn);

    // danh mục bóng đá việt nam
    $top1_viewcount_football_VietNam  = bai_viet_view_count_nhat_inVietNam($conn);
    $top6_trending_football_VietNam   = get_top6_posts_by_category_and_area_inVietNam($conn);
    $top3_newposst_football_VietNam   = get_top3_latest_posts_by_category_inVietNam($conn);

    // danh mục các bộ môn khác
    $post_view_caonhat_orther_sporrt    = get_top3_posts_by_view_count_orther_sport($conn);
    $top6_post_new_orther_sport         = get_top6_latest_posts_sport_orther($conn);
    $top3_trending_orther_sport         = get_top3_trending_posts_sport_orther($conn);
    require_once PATH_VIEW_CLIENT . 'home.php';
}
