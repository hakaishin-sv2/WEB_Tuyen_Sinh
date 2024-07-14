<?php
function validate_Create_Tag($data, $conn) {
    $errors = [];
    if (empty($data["name_tag"])) {
        $errors[] = "Cần nhập Tên Tag!";
    } elseif (strlen($data["name_tag"]) > 50) {
        $errors[] = "Tên của tag không quá 50 ký tự!";
    }

    return $errors;
  }
  