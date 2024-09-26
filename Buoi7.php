<?php
// Biến kết nối toàn cục
global $conn;
 
// Hàm kết nối database
function connect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Nếu chưa kết nối thì thực hiện kết nối
    if (!$conn){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=qlsinhvien", "root", "");
            // Thiết lập chế độ báo lỗi PDO
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Thiết lập charset
            $conn->exec("set names utf8");
        } catch (PDOException $e) {
            die("Can't connect to database: " . $e->getMessage());
        }
    }
}
 
// Hàm ngắt kết nối
function disconnect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Nếu đã kêt nối thì thực hiện ngắt kết nối
    if ($conn){
        $conn = null;
    }
}
 
// Hàm lấy tất cả sinh viên
function get_all_students()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "SELECT * FROM sinhvien";
     
    // Thực hiện câu truy vấn
    $query = $conn->query($sql);
     
    // Lấy kết quả dưới dạng mảng
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
     
    // Trả kết quả về
    return $result;
}
 
// Hàm lấy sinh viên theo ID
function get_student($student_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Câu truy vấn lấy sinh viên theo ID
    $sql = "SELECT * FROM sinhvien WHERE id = :id";
     
    // Thực hiện câu truy vấn
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $student_id, PDO::PARAM_INT);
    $stmt->execute();
     
    // Lấy kết quả
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // Trả kết quả về
    return $result;
}
 
// Hàm thêm sinh viên
function add_student($student_name, $student_sex, $student_birthday)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Câu truy vấn thêm
    $sql = "INSERT INTO sinhvien (hoten, gioitinh, ngaysinh) VALUES (:hoten, :gioitinh, :ngaysinh)";
     
    // Thực hiện câu truy vấn
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':hoten', $student_name);
    $stmt->bindParam(':gioitinh', $student_sex);
    $stmt->bindParam(':ngaysinh', $student_birthday);
     
    return $stmt->execute();
}
 
// Hàm sửa sinh viên
function edit_student($student_id, $student_name, $student_sex, $student_birthday)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Câu truy sửa
    $sql = "UPDATE sinhvien SET hoten = :hoten, gioitinh = :gioitinh, ngaysinh = :ngaysinh WHERE id = :id";
     
    // Thực hiện câu truy vấn
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':hoten', $student_name);
    $stmt->bindParam(':gioitinh', $student_sex);
    $stmt->bindParam(':ngaysinh', $student_birthday);
    $stmt->bindParam(':id', $student_id, PDO::PARAM_INT);
     
    return $stmt->execute();
}
 
// Hàm xóa sinh viên
function delete_student($student_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Câu truy xóa
    $sql = "DELETE FROM sinhvien WHERE id = :id";
     
    // Thực hiện câu truy vấn
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $student_id, PDO::PARAM_INT);
     
    return $stmt->execute();
}
?>
