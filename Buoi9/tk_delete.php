<?php require 'create.php';
 
// Thực hiện xóa
$id = isset($_POST['userid']) ? (int)$_POST['userid'] : '';
if ($id){
    delete_taikhoan($id);
}
 
// Trở về trang danh sách
header("location: admin.php");
?>
