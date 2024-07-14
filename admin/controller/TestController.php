<?php
function TestIndex($conn){
    $users = getListTable($conn,"users");
    require_once PATH_VIEW_ADMIN. 'test.php';
}
