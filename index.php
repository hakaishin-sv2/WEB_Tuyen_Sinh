<?php
require_once './Commons/env.php';
require_once './Commons/helper.php';
require_once './Commons/connectDB.php';
require_once './Commons/crud-db.php';

require_file(PATH_CONTROLLER);
require_file(PATH_MODEL);


$data = [
    'full_name' => 'Nguyễn Minh Ngọc',
    'email' => 'abc@gmail.com',
    'sdt' => '0981726417',
    'password_user' => '123456',
];

$data_update = [
    'full_name' => 'Nguyễn Minh Ngọc',
    'email' => 'hakai@gmail.com',
    'sdt' => '0981726417',
    'password_user' => '123456',
];

//insert($conn,'users',$data);
//update($conn,'users',$data_update,15);
// $x = getItemByID($conn,"users",9);
// if($x== null){
//     echo"null";
// }else{
//     debug($x);
// }

// Điều hướng URL
$act = isset($_GET["act"]) ? $_GET["act"] : '';

switch ($act) {
    case 'rigister':
      
        registerIndex();
        break;
    case 'login':
        loginIndex();
        break;
    // Thêm các case khác tùy theo nhu cầu của bạn
    default:
    HomeIndex();
        break;
}

require_once './Commons/disconnect_db.php';

