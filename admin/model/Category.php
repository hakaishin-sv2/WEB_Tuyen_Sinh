<?php
function validate_Create_Category($data, $conn) {
    $errors = [];
    if (empty($data["name_category"])) {
        $errors[] = "Cần nhập Tên Tag!";
    } elseif (strlen($data["name_category"]) > 100) {
        $errors[] = "Tên của tag không quá 100 ký tự!";
    }

    return $errors;
  }
  