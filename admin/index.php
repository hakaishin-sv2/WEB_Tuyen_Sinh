<?php
// -------------------ADMIN
session_start();
require_once '../Commons/env.php';
require_once '../Commons/helper.php';
require_once '../Commons/connectDB.php';
require_once '../Commons/crud-db.php';

require_file(PATH_CONTROLLER_ADMIN);
require_file(PATH_MODEL_ADMIN);

// Kiểm tra xem người dùng đã đăng nhập chưa
$act = isset($_GET["act"]) ? $_GET["act"] : '';

if (!isset($_SESSION["user"]) || empty($_SESSION["user"]) || (isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] !== "admin")) {
    if ($act !== 'login') {
        header('Location: index.php?act=login');
        exit();
    }
}
function check_role_admin_session()
{
    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
        if ($_SESSION["user"]["role"] !== "admin") {
            header('Location: index.php?act=login');
            exit();
        }
    }
}
// tự động update nếu hết hạn xét tuyển đưa status ở bảng program về inactive
updateExpiredPrograms($conn);
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
            updateUser($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết người dùng vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;
    case 'user-delete':
        if (isset($_GET['id'])) {
            deleteUser($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết người dùng vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;

        // Quản lý ngành
    case 'nganh-xet-tuyen-list':
        getAlllistNganh($conn);
        break;
    case 'nganh-xet-tuyen-detail':
        if (isset($_GET['id'])) {
            get_Nganh_item($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết người dùng vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
        break;

    case 'nganh-xet-tuyen-create':
        Create_nganh_xettuyen($conn);
        break;
    case 'nganh-xet-tuyen-update':
        if (isset($_GET['id'])) {
            UpdateMajor($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết người dùng vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;
    case 'nganh-xet-tuyen-delete':
        if (isset($_GET['id'])) {
            deleteNganhXetTuyen($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;

        // Khối xét tuyển

    case 'exam-block-list':
        getExamBlockListAll($conn);
        break;
    case 'exam-block-detail':
        if (isset($_GET['id'])) {
            get_exam_block_Detail($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
        break;

    case 'exam-block-create':
        exam_blockCreate($conn);
        break;
    case 'exam-block-update':
        if (isset($_GET['id'])) {
            update_exam_block($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;
    case 'exam-block-delete':
        if (isset($_GET['id'])) {
            // deleteTag($conn, $_GET['id']);
            echo "Không thể xóa.";
            require_once PATH_VIEW_ADMIN . '404.php';
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;

        // Phân công giáo viên duyệt hồ sơ

    case 'assign-teachers':
        getTeacherToMajorList($conn);
        break;

    case 'assign-teacher-detail':
        if (isset($_GET['id'])) {
            getTeacherToMajorDetail($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
        break;

    case 'assign-teacher-create':
        assignTeacherToMajor($conn);
        break;
    case 'assign-teacher-update':
        if (isset($_GET['id'])) {
            assignTeacherToMajorUpdate($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;
    case 'assign-teacher-delete':
        if (isset($_GET['id'])) {
            deleteTeacherAssignments($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;

        // Tuyển sinh
    case 'open-application': // mỏ cổng tuyển sinh
        mo_cong_tuyen_sinh_one_create($conn);
        break;
    case 'list-open-majors': // danh cách năm tuyển sinh 
        getListCacNamXetTuyen($conn);
        break;
    case 'close-tuyen-sinh': // các cổng tuyển sinh chưa mở / đã đóng
        if (isset($_GET['year'])) {
            close_tuyen_sinh($conn, $_GET['year']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'year' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
        break;

    case 'open-tuyen-sinh': // các ngành đang được mở tuyển sinh
        if (isset($_GET['year'])) {
            open_tuyen_sinh($conn, $_GET['year']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'year' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
        break;
    case 'update-tuyen-sinh': // update lại các ngành tuyển sinh

        update_cong_tuyen_sinh($conn, $_GET["year"]);
        break;
    case 'delete-tuyen-sinh':
        if (isset($_GET['year'])) {
            deleteProgramByYear($conn, $_GET['year']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;
    case 'show-tuyen-sinh':
        if (isset($_GET['year'])) {
            chi_tiet_tuyen_sinh_by_year($conn, $_GET['year']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'year' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;
        // Ẩn hiện nhận hay ngưng nhận hồ sơ của từng ngành
    case 'an-nop-ho-so':
        if (isset($_GET['id_program_major'])) {
            AnHoSoTheoNganh($conn, $_GET['id_program_major'], $_GET['year']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;
    case 'hien-nop-ho-so':
        if (isset($_GET['id_program_major'])) {
            hienHoSoTheoNganh($conn, $_GET['id_program_major'], $_GET['year']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;
        // Nhập điểm trúng tuyển
    case 'nhap-diem-trung-tuyen':
        if (isset($_GET['id_program_major'])) {
            NhapDiemTrungTuyen($conn, $_GET['id_program_major']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;
        // Thống kê hồ sơ các năm
    case 'thong-ke-ho-so': // danh cách năm tuyển sinh 
        thong_ke_ho_so_cac_nam($conn);
        break;
    case 'thong-ke-tong-quan': // danh cách năm tuyển sinh 
        if (isset($_GET['year'])) {
            thong_ke_ho_so_tong_quan($conn,  $_GET['year']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;
    case 'thong-ke-cu-the-theo-nganh': // danh cách năm tuyển sinh 
        if (isset($_GET['year'])) {
            thong_ke_ho_so_theo_nam_va_nganh($conn, $_GET['year'], $_GET["id_nganh"]);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;
    case 'author-update': // danh cách năm tuyển sinh 
        if (isset($_GET['id'])) {
            danh_sach_da_duyet_by_teacher($conn, $_GET['id']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
        break;
    case 'chi-tiet-ho-so-role-admin':
        if (isset($_GET['id_hoso'])) {
            check_role_admin_session();
            chitiet_hoso_by_admin($conn, $_GET['id_hoso']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'phe-duyet-ho-so-by-admin':
        if (isset($_GET['id_hoso']) && isset($_GET['user_id'])) {
            check_role_admin_session();
            phe_duyet_ho_so_by_admin($conn, $_GET['id_hoso'], $_GET["user_id"]);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_CLIENT . '404.php';
        }
        break;
    case 'ket-qua-tuyen-sinh':
        if (isset($_GET['year'])) {
            thong_ke_ho_so_theo_nam($conn, $_GET['year'], $_GET["type"]);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }

        break;
        // case 'khong-trung-tuyen':
        //     if (isset($_GET['year'])) {
        //         thong_ke_ho_so_theo_nam_va_nganh($conn, $_GET['year']);
        //     } else {
        //         echo "Không có thông tin chi tiết vì thiếu tham số 'id' trong URL.";
        //         require_once PATH_VIEW_ADMIN . '404.php';
        //     }

        //     break;
    case 'thong-he-trang-thai-ho-so':
        if (isset($_GET['year'])) {
            thong_ke_ho_so_da_duyet_theo_nam($conn, $_GET["status"], $_GET['year']);
        } else {
            echo "Không có thông tin chi tiết vì thiếu tham số 'year' trong URL.";
            require_once PATH_VIEW_ADMIN . '404.php';
        }
        break;
    case 'xem-lai-ho-so-da-luu':
        if (isset($_GET['year'])) {
            xem_lai_ho_so_da_luu($conn, $_GET['year'], $_GET["major_id"], $_GET["status"]);
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
