<?php
$sever= SEVER;
$username = USERNAME;
$passwword = PASSWORD;
$data_name= DATA_NAME;   

$conn=mysqli_connect($sever, $username, $passwword, $data_name) or die("Không thể kết nối tới cơ sở dữ liệu");
if (!$conn) {
    die("Kết nối tới cơ sở dữ liệu thất bại: " . mysqli_connect_error() . " Mã lỗi: " . mysqli_connect_errno());
}else{
    //die("thành công");
    //$conn -->setAttribute();
}


?>