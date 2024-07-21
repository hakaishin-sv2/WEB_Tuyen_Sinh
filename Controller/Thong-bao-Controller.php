<?php
function Thong_bao_page($conn)
{
    $Thong_bao_chua_xem = Thong_bao_chua_xem($conn);
    $Thong_bao_da_xem = Thong_bao_da_xem($conn);
    // print_r($Thong_bao_da_xem);
    require_once PATH_VIEW_CLIENT . 'all-thong-bao.php';
}
