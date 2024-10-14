<?php
global $conn;
function connect_db() {
  global $conn;
  try {
     $conn = new PDO("mysql:host=sql110.infinityfree.com;dbname=if0_37144768_employee", 'if0_37144768', '19112004Ab');
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "Kết nối thành công";
  } catch(PDOException $e) {
     echo "Lỗi kết nối: " . $e->getMessage();
  }
}

 
// Hàm ngắt kết nối
function disconnect_db()
{
    $conn = null;
 }
// Hàm lấy tất cả nhân viên
function get_all_tk()
{
	 global $conn;
   // Hàm kết nối
    connect_db();
  
    try{
    	//khai báo exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // Sử dụng Prepare 
    $stmt = $conn->prepare("SELECT taikhoan.userid, taikhoan.username, taikhoan.password, roles.role_name, employees.employee_id 
                            FROM taikhoan
                            LEFT JOIN employees ON taikhoan.employee_id = employees.employee_id
                            JOIN roles ON roles.role_name = taikhoan.role_name;
                            "); 
     
    // Thực thi câu truy vấn
    $stmt->execute();
    // Khai báo fetch kiểu mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
   return $result;
 }
 catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
}

 
// Hàm lấy nhân viên theo ID
function get_tk($user_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
    // Câu truy vấn lấy tất cả nhân viên
    $stmt = $conn->prepare("select * from taikhoan where userid = {$user_id}");
    // Thực thi câu truy vấn
    $stmt->execute();
    // Khai báo fetch kiểu mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     return $result;
    // var_dump($result);
    
}
 
// Hàm thêm nhân viên
function add_tk($username, $password, $rolename, $employeeid)
{
    // Gọi tới biến toàn cục $conn
   global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Chống SQL Injection
   // $employee_firstname= addslashes($employee_firstname);
    //$employee_lastname=nameaddslashes($employee_lastname);
    //$employee_role=addslashes($employee_role);
    //$employee_dep=addslashes($employee_dep);
     try{
     	//khai báo exception
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    // Câu truy vấn thêm
    $sql = " INSERT INTO taikhoan (username, password, role_name, employee_id) VALUES
            ('$username', '$password','$rolename', '$employeeid')";
     
    // Thực hiện câu truy vấn
     $conn->exec($sql);
     echo "Thêm dữ liệu thành công";
}
catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
}
 
// Hàm sửa nhân viên
function edit_taikhoan($userid, $username, $password,$rolename, $employeeid)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Chống SQL Injection
    // $employee_firstname= addslashes($employee_firstname);
    //$employee_lastname=nameaddslashes($employee_lastname);
    //$employee_role=addslashes($employee_role);
    //$employee_dep=addslashes($employee_dep);
     try{
     	 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Câu truy vấn sửa
    $sql = "
            UPDATE taikhoan SET
            username = '$username',
            password = '$password',
            role_name = '$rolename',
            employee_id = '$employeeid'
            WHERE userid = '$userid'";
     
    // Prepare statement
  $stmt = $conn->prepare($sql);

  // execute the query
  $stmt->execute();
  // echo a message to say the UPDATE succeeded
  echo $stmt->rowCount() . " records UPDATED successfully";

}
  catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
}
 
// Hàm xóa nhân viên
function delete_taikhoan($user_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
    try{
     	 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Câu SQL xóa
    $sql = " DELETE FROM taikhoan WHERE userid = $user_id ";
     
    // Prepare statement
  $stmt = $conn->prepare($sql);

  // execute the query
  $stmt->execute();
}
  catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
}
//hàm xử lý với department và role
function get_role($role_name) {
    global $conn;
    connect_db();
    try {
        $stmt = $conn->prepare("SELECT * FROM roles WHERE role_name = :role_name");
        $stmt->bindParam(':role_name', $role_name, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}


//hàm lấy roleid khi biết role name
function get_employeeid($employee_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();
    
    // Kiểm tra xem employee_id có hợp lệ không
    if (!$employee_id) {
        return []; // Trả về mảng rỗng nếu employee_id không hợp lệ
    }

    try {
        // Sử dụng Prepared Statement để tránh SQL Injection
        $stmt = $conn->prepare("SELECT * FROM employees WHERE employee_id = :employee_id");
        $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Khai báo fetch kiểu mảng kết hợp
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        // Lấy danh sách kết quả
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return [];
    }
}



 function get_all_tkrole()
{
	 global $conn;
   // Hàm kết nối
    connect_db();
  
    try{
    	//khai báo exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // Sử dụng Prepare 
    $stmt = $conn->prepare("SELECT * FROM roles"); 
     
    // Thực thi câu truy vấn
    $stmt->execute();
    // Khai báo fetch kiểu mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
   return $result;
 }
 catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
}
//hàm lấy danh sách department
function get_all_tknv()
{
	 global $conn;
   // Hàm kết nối
    connect_db();
  
    try{
    	//khai báo exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // Sử dụng Prepare 
    $stmt = $conn->prepare("SELECT * FROM employees"); 
     
    // Thực thi câu truy vấn
    $stmt->execute();
    // Khai báo fetch kiểu mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
   return $result;
 }
 catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
}

// Hàm kiểm tra xem username đã tồn tại hay chưa
function check_username_exists($username) {
  global $conn;
  connect_db();
  
  try {
      // Sử dụng prepared statement để kiểm tra username
      $stmt = $conn->prepare("SELECT * FROM taikhoan WHERE username = :username");
      $stmt->bindParam(':username', $username, PDO::PARAM_STR);
      $stmt->execute();

      // Nếu có kết quả, trả về true, ngược lại false
      if ($stmt->rowCount() > 0) {
          return true;
      } else {
          return false;
      }
  } catch (PDOException $e) {
      echo "Lỗi: " . $e->getMessage();
  }
}

 
?>