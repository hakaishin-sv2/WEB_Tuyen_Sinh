<?php
function Post_by_category($conn, $category_id, $limit, $offset)
{
    $posts = get_posts_by_category_paginated($conn, $category_id, $limit, $offset);
    $total_posts = get_total_posts_count_by_category($conn, $category_id);
    $total_pages = ceil($total_posts / $limit);

    $popular =  get_top3_posts_view_lonnhat($conn);
    $top5_trending      = get_top5_trending_posts($conn);
    $latest      = get_top6_new_post($conn);
    $categories = get_all_categories($conn);
    require_once PATH_VIEW_CLIENT . 'post-category.php';
}
