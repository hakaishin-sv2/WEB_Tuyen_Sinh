<?php
// -------------------ADMIN
session_start();
require_once '../Commons/env.php';
require_once '../Commons/helper.php';
require_once '../Commons/connectDB.php';
require_once '../Commons/crud-db.php';

require_file(PATH_CONTROLLER_ADMIN);
require_file(PATH_MODEL_ADMIN);

// Điều hướng URL
$act = isset($_GET["act"]) ? $_GET["act"] : '';

switch ($act) {
    case 'rigister':
        break;
    case 'login':
        LoginForm($conn);
        break;
    case 'logout':
        LogOut();
        break;
    case 'users':
        getListAll($conn);
        break;
   case 'user-detail':
    if (isset($_GET['id'])) {
        getUserDetail($conn, $_GET['id']);
    } else {
        echo "Không có thông tin chi tiết người dùng vì thiếu tham số 'id' trong URL.";
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    break;

    case 'user-create':
        UserCreate($conn);
        break;
    case 'user-update':
        if (isset($_GET['id'])) {
            updateUser($conn,$_GET['id']);
        } else {
            echo "Không có thông tin chi tiết người dùng vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
      
        break;
    case 'user-delete':
        if (isset($_GET['id'])) {
            deleteUser($conn,$_GET['id']);
        } else {
            echo "Không có thông tin chi tiết người dùng vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
      
        break;
 
    // CATEGORY
    case 'categories':
        getCategoryListAll($conn);
        break;
   case 'category-detail':
    if (isset($_GET['id'])) {
        getcategoryDetail($conn, $_GET['id']);
    } else {
        echo "Không có thông tin chi tiết người dùng vì thiếu tham số 'id' trong URL.";
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    break;

    case 'category-create':
        categoryCreate($conn);
        break;
    case 'category-update':
        if (isset($_GET['id'])) {
            categoryUpdate($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết người dùng vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
      
        break;
    case 'category-delete':
        if (isset($_GET['id'])) {
            deleteCategory($conn,$_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
      
        break;
        
    // THẺ TAG

    case 'tags':
        getTagListAll($conn);
        break;
   case 'tag-detail':
    if (isset($_GET['id'])) {
        getTagDetail($conn, $_GET['id']);
    } else {
        echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    break;

    case 'tag-create':
        TagCreate($conn);
        break;
    case 'tag-update':
        if (isset($_GET['id'])) {
            updateTag($conn,$_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
      
        break;
    case 'tag-delete':
        if (isset($_GET['id'])) {
            deleteTag($conn,$_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
      
        break;

    // Author

    case 'authors':
        getAuthorsListAll($conn);
        break;
   case 'author-detail':
    if (isset($_GET['id'])) {
        getAuthorDetail($conn, $_GET['id']);
    } else {
        echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    break;

    case 'author-create':
         authorCreate($conn);
         break;
    case 'author-update':
        if (isset($_GET['id'])) {
            authorUpdate($conn,$_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
      
        break;
    case 'author-delete':
        if (isset($_GET['id'])) {
            deleteAuthor($conn,$_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
      
        break;

     // POST mânger

    case 'posts':
        getAlllistPost($conn);
        break;
        
    case 'post-detail':
    if (isset($_GET['id'])) {
        get_Postd_item($conn, $_GET['id']);
    } else {
        echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
        require_once PATH_VIEW_ADMIN . '404.php';
    }
    break;
    case 'post-approve':
        if (isset($_GET['id'])) {
            Phe_duyet_Post($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
        break;
    case 'post-create':
        PostCreate($conn);
         break;
    case 'post-update':
        if (isset($_GET['id'])) {
            PostUpdate($conn,$_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
      
        break;
    case 'post-delete':
        if (isset($_GET['id'])) {
            deletePost($conn,$_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
      
        break;
    case 'test':
        TestIndex($conn);
        break;
    default:
    MainIndex();
        break;
}

require_once '../Commons/disconnect_db.php';

