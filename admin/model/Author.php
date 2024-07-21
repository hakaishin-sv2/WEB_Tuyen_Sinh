<?php
function validate_Create_Author($data, $file)
{
    $errors = [];
    if (empty($data["user_id"])) {
        $errors[] = "Cần nhập chọn tác giả";
    }
    if (!empty($data["Tieusu"]) && strlen($data["Tieusu"]) > 500) {
        $errors[] = "Tiểu sử tác giả ghi ngắn thôi";
    }
    if (isset($file) && $file['error'] == UPLOAD_ERR_OK) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            $errors[] = "File tải lên phải là ảnh (jpg, jpeg, png, gif)!";
        }

        if ($file['size'] <= 0) {
            $errors[] = "File tải lên phải có kích thước lớn hơn 0!";
        }

        $maxFileSize = 2 * 1024 * 1024; // max size là 2MB
        if ($file['size'] > $maxFileSize) {
            $errors[] = "Kích thước file tải lên không được vượt quá 2MB!";
        }
    }

    return $errors;
}

function getListAuThor_Dto($conn)
{
    $sql = "SELECT authors.*, users.full_name, users.email
            FROM authors
            JOIN users ON authors.user_id = users.id";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        $authors = []; // Mảng để chứa kết quả trả về

        // Lặp qua từng dòng kết quả và đưa vào mảng $authors
        while ($row = mysqli_fetch_assoc($result)) {
            $authors[] = [
                'id' => $row['id'],
                'user_id' => $row['user_id'],
                'Tieusu' => $row['Tieusu'],
                'avatar' => $row['avatar'],
                'full_name' => $row['full_name'],
                'email' => $row['email']
            ];
        }
        return $authors;
    } else {
        return null;
    }
}

function getAuThor_Dto_byID($conn, $id)
{
    $sql = "SELECT authors.*, users.full_name, users.email
            FROM authors
            JOIN users ON authors.user_id = users.id
            WHERE authors.id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        return null;
    }

    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $author_item = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);
        return $author_item;
    } else {
        mysqli_stmt_close($stmt);
        return null;
    }
}
