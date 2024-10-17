<?php
require 'employee.php';
$role=get_all_department();
 
// Lấy thông tin hiển thị lên để người dùng sửa
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if ($id){
    $data = get_department($id);
   // var_dump($data);
    //echo $data['employee_id'];
    foreach ($data as $row) {
    $departmentid= $row['department_id'] ;
    $departmentname=$row['department_name'] ;
    }
    //echo $emdepartmentid;
    //echo $emdepartmentid;
    //lấy tên role
}
// Nếu không có dữ liệu tức không tìm thấy nhân viên cần sửa
if (!$data){
   header("location: department_list.php");
}
 
// Nếu người dùng submit form
if (!empty($_POST['edit_department']))
{
    // Lay data
    $data['department_id']        = isset($_POST['department_id']) ? $_POST['department_id'] : '';
    $data['department_name']         = isset($_POST['department_name']) ? $_POST['department_name'] : '';
     
    // Validate thong tin
    $errors = array();
    if (empty($data['department_id'])){
        $errors['department_id'] = 'department_id không bỏ trống';
    }
     
    if (empty($data['department_name'])){
        $errors['department_name'] = 'department_name không bỏ trống';
    }
     
    // Nếu không có lỗi thì cập nhật
   // if (!$errors){

    edit_department($data['department_id'], $data['department_name']);
      // Trở về trang danh sách
     header("location: department.php");
    }
//}
 
disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Sửa thông tin bộ phận</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Sửa thông tin bộ phận </h1>
        <a href="department.php">Trở về</a> <br/> <br/>
        <form method="post" action="department_edit.php?department_id=<?php $departmentid ?>">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Department ID</td>
                    <td>
                        <input type="number" name="department_id" value="<?php echo $departmentid; ?>"/>
                        <?php if (!empty($errors['department_id'])) echo $errors['department_id']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Department name</td>
                    <td>
                        <input type="text" name="department_name" value="<?php echo $departmentname; ?>"/>
                        <?php if (!empty($errors['department_name'])) echo $errors['department_name']; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" name="edit_department" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>