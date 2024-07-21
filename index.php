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

function check_user_session($act)
{
    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
        if ($act !== 'login') {
            header('Location: index.php?act=login');
            exit();
        }
    }
}

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
    case 'profile':
        showProfile($conn);
        break;
    case 'edit-profile':
        showEditProfile($conn);
        break;
    case 'forgot-password':
        forgot_password($conn);
        break;
    case 'change-password':
        Change_password($conn);
        break;
    case 'ma-xac-nhan':
        //forgot_password($conn);
        break;
    case 'single-post':
        if (isset($_GET['post-id'])) {
            manage_post_view($conn, $_GET['post-id']); // cập nhạt view _count trong database
            Post_detail($conn, $_GET['post-id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'post-id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'category':
        if (isset($_GET['id'])) {
            $category_id = $_GET["id"];
            $limit = 5; // sẽ có 5 bài trên 1 trang
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;
            Post_by_category($conn, $category_id, $limit, $offset);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'searchresult':
        if (isset($_GET["search"])) {
            $limit = 5; // sẽ có 5 bài trên 1 trang
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;
            Search_Result($conn, $_GET["search"], $limit, $offset);
        } else {
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'contact':
        Contact_Page($conn);
        break;
    case 'about':
        About_Page($conn);
        break;
    case 'dashboard-client':
        check_user_session($act);
        MainDashBoardClient();
        //getAlllistPost($conn);
        break;
    case 'post-create':
        check_user_session($act);
        PostCreate($conn);
        break;
    case 'list-posts':
        check_user_session($act);
        getAlllistPost($conn);
        break;
    case 'post-detail':
        if (isset($_GET['id'])) {
            check_user_session($act);
            get_Postd_item($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'post-update':
        if (isset($_GET['id'])) {
            check_user_session($act);
            PostUpdate($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'post-delete':
        if (isset($_GET['id'])) {
            check_user_session($act);
            deletePost($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'post-approve':
        if (isset($_GET['id'])) {
            check_user_session($act);
            Phe_duyet_Post($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'prewview-post':
        if (isset($_GET['id'])) {
            check_user_session($act);
            get_Postd_Peview($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;

    case 'test':
        test($conn, $_GET['post-id']);
        break;
    default:
        HomeIndex($conn);
        break;
}
require_once './Commons/disconnect_db.php';
