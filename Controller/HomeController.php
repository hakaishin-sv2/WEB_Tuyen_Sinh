<?php
function HomeIndex($conn, $search, $limit, $offset)
{
    if (isset($_GET["btn_search_nganh_tuyen_sinh"])) {
        $search = $_GET["search"];
        if (!isset($_SESSION["text_search"])) {
            $_SESSION["text_search"] = $search;
        } else {
            $_SESSION["text_search"] = $search;
        }
    }
    // banner
    $result = getlistNganhTuyensinh($conn, $search, $limit, $offset);
    $totalItems  = CountTotal_nganhtuyensinh_by_year($conn);
    // Tính toán tổng số trang
    $totalPages = ceil($totalItems / $limit);
    require_once PATH_VIEW_CLIENT . 'home.php';
}


// xem chi tiết bài tuyển sinh
function post_tuyen_sinh_detail($conn, $id)
{
    $item = get_item_nganh($conn, $id);
    $cutOffScores = get_diem_trung_tuyen_3_nam_gan_nhat($conn, $id);
    require_once PATH_VIEW_CLIENT . 'post-review-nganh.php';
}
function nop_ho_so($conn, $id_nganh_nop)
{
    // Kiểm tra hạn nộp hồ sơ
    $is_in_deadline = check_nop_han_nop_ho_so($conn, $id_nganh_nop);

    if ($is_in_deadline === true) {
        $item = get_item_nganh($conn, $id_nganh_nop);
        if ($item) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Khởi tạo mảng lưu lỗi
                $errors = [];
                // Lấy dữ liệu từ form
                $fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
                $email = isset($_POST['email']) ? trim($_POST['email']) : '';
                $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
                $address = isset($_POST['address']) ? trim($_POST['address']) : '';
                $comments = isset($_POST['comments']) ? trim($_POST['comments']) : '';
                $block = isset($_POST['blockSelect']) ? trim($_POST['blockSelect']) : '';
                $subjectsData = isset($_POST['subjects']) ? $_POST['subjects'] : [];
                // check đã nộp hồ sơ chưa
                $check = hasSubmittedApplication($_SESSION["user"]["id"], $item[0]["id"], $item[0]["major_id"], $conn);
                if ($check === true) {
                    $errors[] = "Bạn đã nộp hồ sơ cho ngành ngành rồi!Hãy vào hồ sơ cá nhân để chỉnh sửa";;
                    $_SESSION['errors'] = $errors;
                    $data_err = [
                        'phone' => $phone,
                        'address' => $address,
                        'review_comments' => $comments,
                        //'subjects' => json_encode($subjectsData) 
                    ];
                    $_SESSION["data_errors"] = $data_err;
                    $major_id = $item[0]["major_id"];
                    header('Location: index.php?act=nop-ho-so&id=' . $major_id);
                    exit();
                }
                // Validate dữ liệu
                if (empty($fullName)) $errors[] = 'Họ và tên không được để trống.';
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ.';
                if (empty($phone)) $errors[] = 'Số điện thoại không được để trống.';
                if (empty($address)) $errors[] = 'Địa chỉ không được để trống.';
                if (empty($block)) $errors[] = 'Chưa chọn khối thi.';
                if (empty($subjectsData)) $errors[] = 'Cần nhập điểm cho các môn.';
                // Kiểm tra dữ liệu điểm

                // check ảnh lớn hơn 100mb
                // $totalSize = 0; // Tổng kích thước các file
                // $maxSize = 100 * 1024 * 1024; // 100MB

                // // Duyệt qua từng file được upload
                // foreach ($_FILES['images']['size'] as $size) {
                //     $totalSize += $size; // Cộng dồn kích thước của từng file
                // }
                // if ($totalSize > $maxSize) {
                //     $errors[] = "Tổng kích thước các ảnh không được vượt quá 100MB.";
                // }
                if (empty($subjectsData)) {
                    // $errors[] = 'Cần nhập điểm cho ít nhất một môn.';
                } else {
                    foreach ($subjectsData as $subject => $score) {
                        if ($score === '') {
                            $errors[] = "Điểm cho môn $subject không được để trống.";
                        } elseif (!is_numeric($score) || $score < 0 || $score > 10) {
                            $errors[] = "Điểm cho môn $subject phải là một số từ 0 đến 10.";
                        }
                    }
                }
                $score = [
                    'block' => $block,
                    'subjects' => $subjectsData
                ];

                // Chuyển đổi mảng dữ liệu thành chuỗi JSON
                $jsonscore = json_encode($score);

                // Xử lý tệp tin CCCD
                $cccdPaths = [];
                if (isset($_FILES['cccd']) && !empty($_FILES['cccd']['name'][0])) {
                    foreach ($_FILES['cccd']['tmp_name'] as $key => $tmpName) {
                        if ($_FILES['cccd']['error'][$key] === UPLOAD_ERR_OK) {
                            $fileName = uniqid() . '_' . basename($_FILES['cccd']['name'][$key]);
                            $filePath = 'uploads/img_cccd/' . $fileName;
                            if (move_uploaded_file($tmpName, $filePath)) {
                                $cccdPaths[] = $filePath;
                            } else {
                                $errors[] = "Lỗi di chuyển tệp tin CCCD: " . $_FILES['cccd']['name'][$key];
                            }
                        } else {
                            $errors[] = "Lỗi tải lên tệp CCCD: " . $_FILES['cccd']['error'][$key];
                        }
                    }
                } else {
                    $errors[] = 'Bạn chưa tải lên tệp CCCD.';
                }

                // Xử lý tệp tin học bạ
                $transcriptsPaths = [];
                if (isset($_FILES['transcripts']) && !empty($_FILES['transcripts']['name'][0])) {
                    foreach ($_FILES['transcripts']['tmp_name'] as $key => $tmpName) {
                        if ($_FILES['transcripts']['error'][$key] === UPLOAD_ERR_OK) {
                            $fileName = uniqid() . '_' . basename($_FILES['transcripts']['name'][$key]);
                            $filePath = 'uploads/img_hoc_ba/' . $fileName;
                            if (move_uploaded_file($tmpName, $filePath)) {
                                $transcriptsPaths[] = $filePath;
                            } else {
                                $errors[] = "Lỗi di chuyển tệp tin học bạ: " . $_FILES['transcripts']['name'][$key];
                            }
                        } else {
                            $errors[] = "Lỗi tải lên tệp học bạ: " . $_FILES['transcripts']['error'][$key];
                        }
                    }
                } else {
                    $errors[] = 'Bạn chưa tải lên tệp học bạ.';
                }

                // Nếu có lỗi, lưu vào session và quay lại trang trước đó
                if (!empty($errors)) {
                    $_SESSION['errors'] = $errors;
                    $major_id = $item[0]["major_id"];
                    header('Location: index.php?act=nop-ho-so&id=' . $major_id);
                    exit();
                }

                // Xây dựng mảng dữ liệu
                $data = [
                    'phone' => $phone,
                    'user_id' => $_SESSION["user"]["id"],
                    'program_id' => $item[0]["id"],
                    'major_id' => $item[0]["major_id"],
                    'address' => $address,
                    'review_comments' => $comments,
                    'score' => $jsonscore,
                    'img_cccd' => json_encode($cccdPaths),
                    'img_hoc_ba' => json_encode($transcriptsPaths),
                    //'subjects' => json_encode($subjectsData) 
                ];

                insert($conn, "applications", $data);
                $_SESSION['success'] = "Nộp hồ sơ xét tuyển thành công";
                $major_id = $item[0]["major_id"];
                header('Location: index.php?act=list-nop-ho-so-ca-nhan');
                exit();
            }

            require_once PATH_VIEW_CLIENT . 'nop-ho-so-xettuyen.php';
        } else {
            // Lỗi: Không thể lấy thông tin ngành
            echo "Lỗi: Không thể lấy thông tin ngành.";
        }
    } else if ($is_in_deadline === false) {
        require_once PATH_VIEW_CLIENT . 'het-han-nop-so-so.php';
    } else {
        // Lỗi không xác định
        echo "Lỗi: Không thể xác định trạng thái nộp hồ sơ.";
    }
}
