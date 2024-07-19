<?php
// CLIENT
session_start();

require_once './Commons/env.php';
require_once './Commons/helper.php';
require_once './Commons/connectDB.php';
require_once './Commons/crud-db.php';

require_file(PATH_CONTROLLER_CLIENT);
require_file(PATH_MODEL_CLIENT);

$act = isset($_GET["act"]) ? $_GET["act"] : '';

// $act = isset($_GET["act"]) ? $_GET["act"] : '';

// if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
//     if ($act !== 'login') {
//         header('Location: index.php?act=login');
//         exit();
//     }
// }

// Điều hướng URL
switch ($act) {
    case 'register':
        create_user($conn);
        break;
    case 'login':
        LoginForm_user($conn);
        break;
    case 'logout':
        LogOut();
        break;
    case 'single-post':
        if (isset($_GET['post-id'])) {
            manage_post_view($conn, $_GET['post-id']);
            Post_detail($conn, $_GET['post-id']);
        } else {
            echo "Không có thông tin chi tiết người dùng vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
        // case 'login':
        //     LoginForm_user($conn);
        //     break;
        // case 'logout':
        //     LogOut();
        //     break;

    case 'test':
        TestIndex($conn);
        break;
    default:
        HomeIndex($conn);
        break;
}
require_once './Commons/disconnect_db.php';
