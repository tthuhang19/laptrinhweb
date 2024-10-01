<?php 
require './libs/students.php';

// Thực hiện xóa
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id) {
    // Xóa sinh viên theo ID sử dụng PDO
    delete_student($id);
}

// Trở về trang danh sách
header("Location: students_list.php");
exit(); // Dừng thực thi mã sau khi chuyển hướng
?>
