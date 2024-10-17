<?php require 'employee.php';
 
// Thực hiện xóa
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
if ($id){
    delete_role($id);
}
 
// Trở về trang danh sách
header("location: roles_list.php");
?>