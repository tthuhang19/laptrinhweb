<?php
require 'employee.php';

// Gọi hàm để lấy thông tin phòng ban, chức vụ
$roles = get_all_department();

// Nếu người dùng submit form
if (!empty($_POST['add_department'])) {
    // Lấy data
    $data['department_id'] = isset($_POST['department_id']) ? $_POST['department_id'] : '';
    $data['department_name'] = isset($_POST['department_name']) ? $_POST['department_name'] : '';
    
    // Validate thông tin
    $errors = array();
    if (empty($data['department_id'])) {
        $errors['department_id'] = 'Chưa nhập department_id';
    }
    
    if (empty($data['department_name'])) {
        $errors['department_name'] = 'Chưa nhập tên chức vụ';
    }
    
    // Nếu không có lỗi thì insert
    if (!$errors) {
        add_department($data['department_id'], $data['department_name']);
        
        // Trở về trang danh sách
        header("Location: department.php");
        exit(); // Thêm exit để dừng script sau khi chuyển hướng
    }
}

disconnect_db();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm phòng ban</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Thêm phòng ban</h1>
    <a href="department.php">Trở về</a> <br/><br/>
    <form method="post" action="department_add.php">
        <table width="50%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Department ID</td>
                <td>
                    <input type="number" name="department_id" value="<?php echo !empty($data['department_id']) ? htmlspecialchars($data['department_id']) : ''; ?>"/>
                    <?php if (!empty($errors['department_id'])) echo $errors['department_id']; ?>
                </td>
            </tr>
            <tr>
                <td>Department Name</td>
                <td>
                    <input type="text" name="department_name" value="<?php echo !empty($data['department_name']) ? htmlspecialchars($data['department_name']) : ''; ?>"/>
                    <?php if (!empty($errors['department_name'])) echo $errors['department_name']; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="add_department" value="Lưu"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>