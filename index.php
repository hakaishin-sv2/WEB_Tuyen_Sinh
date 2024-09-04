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


    case 'xem-chi-tiet-nganh-tuyen-sinh':
        if (isset($_GET['id'])) {
            post_tuyen_sinh_detail($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'nop-ho-so':
        if (isset($_GET['id'])) {
            check_user_session($act);
            nop_ho_so($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
        // hồ sơ cá nhân
    case 'chi-tiet-ho-so':
        if (isset($_GET['id_hoso'])) {
            check_user_session($act);
            chitiet_hoso_byid($conn, $_GET['id_hoso']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'cap-nhat-ho-so':
        if (isset($_GET['id_hoso'])) {
            check_user_session($act);
            update_hoso_byid($conn, $_GET['id_hoso']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'xoa-ho-so-ca-nhan':
        if (isset($_GET['id_hoso'])) {
            check_user_session($act);
            //detete_ho_so_ca_nhan($conn, $_GET['id_hoso']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'list-nop-ho-so-ca-nhan':
        check_user_session($act);
        danhsachhosodanop($conn);

        break;
    case 'all-thong-bao':
        Thong_bao_page($conn);
        break;

    case 'test':
        test($conn, $_GET['post-id']);
        break;
    default:
        $text_search = isset($_GET["search"]) ? $_GET["search"] : '';
        $limit = 6;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        HomeIndex($conn, $text_search, $limit, $offset);
        break;
}
require_once './Commons/disconnect_db.php';
