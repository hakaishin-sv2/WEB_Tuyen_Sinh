<?php
function Post_detail($conn, $post_id)
{
    $post_detail  =  get_post_by_id($conn, $post_id);
    $popular =  get_top3_posts_view_lonnhat($conn);
    $top5_trending      = get_top5_trending_posts($conn);
    $latest      = get_top6_new_post($conn);

    $categories = get_all_categories($conn);
    $tags = get_tags_by_post_id($conn, $post_id);
    require_once PATH_VIEW_CLIENT . 'post-detail.php';
}
