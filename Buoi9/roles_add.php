<?php
require 'employee.php';

// Gọi hàm để lấy thông tin phòng ban, chức vụ
$roles = get_all_role();

// Nếu người dùng submit form
if (!empty($_POST['add_role'])) {
    // Lấy data
    $data['role_id'] = isset($_POST['role_id']) ? $_POST['role_id'] : '';
    $data['role_name'] = isset($_POST['role_name']) ? $_POST['role_name'] : '';
    
    // Validate thông tin
    $errors = array();
    if (empty($data['role_id'])) {
        $errors['role_id'] = 'Chưa nhập role_id';
    }
    
    if (empty($data['role_name'])) {
        $errors['role_name'] = 'Chưa nhập tên chức vụ';
    }
    
    // Nếu không có lỗi thì insert
    if (!$errors) {
        add_role($data['role_id'], $data['role_name']);
        
        // Trở về trang danh sách
        header("Location: roles_list.php");
        exit(); // Thêm exit để dừng script sau khi chuyển hướng
    }
}

disconnect_db();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm chức vụ</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Thêm chức vụ</h1>
    <a href="roles_list.php">Trở về</a> <br/><br/>
    <form method="post" action="roles_add.php">
        <table width="50%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Role ID</td>
                <td>
                    <input type="number" name="role_id" value="<?php echo !empty($data['role_id']) ? htmlspecialchars($data['role_id']) : ''; ?>"/>
                    <?php if (!empty($errors['role_id'])) echo $errors['role_id']; ?>
                </td>
            </tr>
            <tr>
                <td>Role Name</td>
                <td>
                    <input type="text" name="role_name" value="<?php echo !empty($data['role_name']) ? htmlspecialchars($data['role_name']) : ''; ?>"/>
                    <?php if (!empty($errors['role_name'])) echo $errors['role_name']; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="add_role" value="Lưu"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>