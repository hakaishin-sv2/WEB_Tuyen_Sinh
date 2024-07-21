<?php
function Search_Result($conn, $search, $limit, $offset)
{
    $posts = get_posts_by_search($conn, $search, $limit, $offset);

    $total_posts = get_total_posts_count_by_search($conn, $search);
    $total_pages = ceil($total_posts / $limit);


    $popular =  get_top3_posts_view_lonnhat($conn);
    $top5_trending      = get_top5_trending_posts($conn);
    $latest      = get_top6_new_post($conn);
    $categories = get_all_categories($conn);
    require_once PATH_VIEW_CLIENT . 'search-result.php';
}
