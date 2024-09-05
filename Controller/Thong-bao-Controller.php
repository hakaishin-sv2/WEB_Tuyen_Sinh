<?php
function Thong_bao_page($conn)
{
    $notifications =  get_all_thong_bao($conn, $_SESSION["user"]["id"]);
    // print_r($Thong_bao_da_xem);
    require_once PATH_VIEW_CLIENT . 'all-thong-bao.php';
}
