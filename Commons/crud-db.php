<?php
// Cần hiểu về array_keys và array_values

// ví dụ cso câu truy vấn sau 
/*
$sql = "INSERT INTO users (first_name, last_name, hashpassword, email, sdt, password_user) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $firstname, $lastname, $hashedPassword, $email, $sdt, $password);
*/

// print_r($conn);
// global $conn;
//--------------------------------------------------------------------------
if (!function_exists('get_cloumn_database')) {
    function get_cloumn_database($data) {
        $array_field_database = array_keys($data); // lấy toàn bộ key trong mảng là các trường trong database của bảng
        $column = implode(',', $array_field_database); // join các trường lại cách nhau bởi dấu ,   
          
        return $column;
    }
}

// truyền tham số param tránh sql injection chõ dấu ????
if (!function_exists('get_giatri_thamso_ao')) {
    function get_giatri_thamso_ao($data) {
        $numParams = count($data);
        $array_placeholders = array_fill(0, $numParams, '?');
        $string_param = implode(',', $array_placeholders);
       
        return $string_param;
    }
}

//insert dữ liệu

if(!function_exists("insert")){
    function insert($conn,$tableName, $data =[]){
        try{
            $column =  get_cloumn_database($data);
            $string_param = get_giatri_thamso_ao($data);
            $sql = "INSERT INTO $tableName ($column) VALUES($string_param)";
           
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Chuẩn bị câu truy vấn thất bại: " . $conn->error);
            }

            $bindTypes = '';
            $bindValues = [];
            $params = [];

            foreach ($data as $key => $value) {
            if (is_int($value)) {
                $bindTypes .= 'i'; // Integer
            } elseif (is_float($value)) {
                $bindTypes .= 'd'; // Double
            } elseif (is_bool($value)) {
                $bindTypes .= 'i'; // Boolean sẽ được chuyển thành integer (0 hoặc 1)
                $value = $value ? 1 : 0; // Chuyển đổi giá trị boolean thành integer
            } else {
                $bindTypes .= 's'; // String or default
            }
            $bindValues[] = $value; // Thêm giá trị vào mảng bindValues
        } 
        $x =array_unshift($bindValues, $bindTypes);
       
        
        foreach ($bindValues as $key => $value) {
            $params[$key] = &$bindValues[$key];
        }
        
       
         call_user_func_array([$stmt, 'bind_param'], $params);
       

        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            echo "Error inserting record: " . $stmt->error;
        }
    
        }catch(Exception $e){
            throw $e;
        }
    }
}

// ví dụ cụ thể code insert
/*
câu sql cần thực thi $sql = "INSERT INTO users (first_name, last_name, age, is_active) VALUES (?, ?, ?, ?)";
$data = [
    'first_name' => 'John',
    'last_name' => 'Doe',
    'age' => 30,
    'is_active' => true
];
 chạy sau đoạn này

  $bindTypes = '';
  $bindValues = [];     
  foreach ($data as $key => $value) {
            if (is_int($value)) {
                $bindTypes .= 'i'; // Integer
            } elseif (is_float($value)) {
                $bindTypes .= 'd'; // Double
            } elseif (is_bool($value)) {
                $bindTypes .= 'i'; // Boolean sẽ được chuyển thành integer (0 hoặc 1)
                $value = $value ? 1 : 0; // Chuyển đổi giá trị boolean thành integer
            } else {
                $bindTypes .= 's'; // String or default
            }
            $bindValues[] = $value; // Thêm giá trị vào mảng bindValues
        }
sé có  $bindTypes  = ssib và $bindValues = [John', 'Doe', 30, 1]

array_unshift($bindValues, $bindTypes);  $bindValues= ['ssid', 'John', 'Doe', 30, 1]
call_user_func_array([$stmt, 'bind_param'], $bindValues); tương tự câu $stmt->bind_param('ssid', 'John', 'Doe', 30, 1);


*/ 
//UPDATE BY ID

// VD:   UPDATE users SET full_name = ?, email = ?, sdt = ?, password_user = ? WHERE id = ?
// cấu truy vấn sẽ có dạng $stmt->bind_param('ssssi', 'Nguyễn Minh Ngọc', 'abc@gmail.com', '0981726417', '123456', 1);
if (!function_exists("update")) {
    function update($conn, $tableName, $data, $id) {
        try {
            $existingItem = getItemByID($conn, $tableName, $id);
            if (empty($existingItem)) {
                return false;
            }else{
                $setParts = []; // sẽ chứa dạng mảng mỗi phần tử trong ssod sẽ là  full_name = ?, email = ?, sdt = ?, password_user = ?
                $bindTypes = '';// chuỗi sidi
                $bindValues = []; // dữ liệu binding vào lấy ra các values của mảng
    
                foreach ($data as $column => $value) {
                    $setParts[] = "$column = ?"; // Tạo các cặp column = ?
                    if (is_int($value)) {
                        $bindTypes .= 'i'; 
                    } elseif (is_float($value)) {
                        $bindTypes .= 'd';
                    } elseif (is_bool($value)) {
                        $bindTypes .= 'i'; // Boolean chuyển thành integer (0 hoặc 1)
                        $value = $value ? 1 : 0;
                    } else {
                        $bindTypes .= 's'; // String or default
                    }
                    $bindValues[] = $value; 
                }
                $setClause = implode(', ', $setParts); // sẽ có đc string này full_name = ?, email = ?, sdt = ?, password_user = ?
                $sql = "UPDATE $tableName SET $setClause WHERE id = ?";
                $bindTypes .= 'i';
                $bindValues[] = $id;         
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    die("Chuẩn bị câu truy vấn thất bại: " . $conn->error);
                }
    
                array_unshift($bindValues, $bindTypes);// thêm chuỗi
                // mảng này sẽ chưa các giá trị cần binding truyền tham biến vào dấu hỏi đó gồm ssssi', 'Nguyễn Minh Ngọc', 'abc@gmail.com', '0981726417', '123456', 1
                $params = [];
                foreach ($bindValues as $key => $value) {
                    $params[$key] = &$bindValues[$key];
                }
                
                 // mục tiêu là đưa về $stmt->bind_param('ssssi', 'Nguyễn Minh Ngọc', 'abc@gmail.com', '0981726417', '123456', 1);
                call_user_func_array([$stmt, 'bind_param'], $params);
                //debug($params); 
                if ($stmt->execute()) {
                    return true; // Cập nhật thành công
                } else {
                    return false; // Cập nhật thất bại
                }
            }
           
        } catch (Exception $e) {
            throw $e;
        }
    }
}

// DELETE BY ID
if (!function_exists("deleteByID")) {
    function deleteByID($conn, $tableName, $id) {
        try {
            $sql = "DELETE FROM $tableName WHERE id = ?";
            $stmt = $conn->prepare($sql);

            $existingItem = getItemByID($conn, $tableName, $id);
            if (empty($existingItem)) {
                return false;
            }
            if (!$stmt) {
                die("Truy vấn deleteByID thất bại: " . $conn->error);
            }
            $stmt->bind_param("i", $id); // 'i' biểu thị kiểu dữ liệu integer
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                return true; // Trả về true nếu xóa thành công
            } else {
                return false; // Trả về false nếu không có hàng nào bị xóa
            }

        } catch (Exception $e) {
            throw $e;
        }
    }
}


// GET DATA TABLE
if (!function_exists("getListTable")) {
    function getListTable( $conn,$tableName) {
        try {
            $sql = "SELECT * FROM $tableName";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Truy vấn get datatable thất bại: " . $conn->error);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = [];
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data; // Trả về mảng dữ liệu
            } else {
                return []; // Trả về mảng rỗng nếu không có dữ liệu
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}

// GET ITEM BY ID
if (!function_exists("getItemByID")) {
    function getItemByID($conn, $tableName, $id) {
        try {
            // Chuẩn bị câu truy vấn
            $sql = "SELECT * FROM $tableName WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Truy vấn getItemByID thất bại: " . $conn->error);
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc(); // Trả về một mảng kết hợp chứa dữ liệu của hàng
            } else {
                return null; // Trả về null nếu không có dữ liệu
            }

        } catch (Exception $e) {
            throw $e;
        }
    }
}
