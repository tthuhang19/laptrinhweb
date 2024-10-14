<?php
require 'create.php';
$employee = get_all_tk();
$role = get_all_tkrole();
$employee_id = get_all_tknv();
 
// Lấy thông tin hiển thị lên để người dùng sửa
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if ($id){
    $data = get_tk($id);
    if ($data) {
        foreach ($data as $row) {
            $emid = $row['userid'];
            $emusername = $row['username'];
            $empassword = $row['password'];
            $emrolename = $row['role_name'];
            $ememployeeid = $row['employee_id'];
        }
        // Lấy tên role
        $role1 = get_role($emrolename);
        foreach ($role1 as $row) {
            $rolename = $row['role_name'];
        }

        // Lấy tên department
        $department1 = get_employeeid($ememployeeid);
        foreach ($department1 as $row) {
            $employeeid = $row['employee_id'];
        }
    } else {
        // Nếu không có dữ liệu tức không tìm thấy nhân viên cần sửa
        header("location: admin.php");
        exit;
    }
}

// Nếu người dùng submit form
if (!empty($_POST['edit_tk'])) {
    // Lấy data từ form
    $data['userid'] = $emid; // Ensure you have the user ID here
    $data['username'] = isset($_POST['username']) ? $_POST['username'] : '';
    $data['password'] = isset($_POST['password']) ? $_POST['password'] : '';
    $data['role_name'] = isset($_POST['role_name']) ? $_POST['role_name'] : '';
    $data['employee_id'] = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';

    $errors = array();

    // Kiểm tra username
    if (empty($data['username'])) {
        $errors['username'] = 'Chưa nhập tên user';
    } elseif (check_username_exists($data['username']) && $data['username'] != $emusername) {
        $errors['username'] = 'Tên user đã tồn tại';
    }

    // Nếu không nhập password mới, giữ nguyên password cũ
    if (empty($data['password'])) {
        $data['password'] = $empassword;
    } else {
        // Hash password nếu có thay đổi
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    }
    
    // Trả về role id
    $emroleid1 = get_role($data['role_name']);
    foreach ($emroleid1 as $row) {
        $emrolename = $row['role_name'];
    }

    // Trả về department id
    $emdepartmentid1 = get_employeeid($data['employee_id']);
    foreach ($emdepartmentid1 as $row) {
        $ememployeeid = $row['employee_id'];
    }

    edit_taikhoan($data['userid'], $data['username'], $data['password'], $emrolename, $ememployeeid);

    // Trở về trang danh sách
    header("location: admin.php");
    exit;
}

disconnect_db();
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin người dùng</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Sửa thông tin người dùng</h1>
    <a href="admin.php">Trở về</a> <br/><br/>
    <form method="post" action="tk_edit.php?id=<?php echo htmlspecialchars($emid); ?>">
        <table width="50%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>User name</td>
                <td>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($emusername); ?>" />
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="password" placeholder="Leave blank to keep current password" />
                </td>
            </tr>
            <tr>
                <td>Vai trò</td>
                <td>
                    <select name="role_name">
                        <?php foreach ($role as $item) { ?>
                            <option value="<?php echo htmlspecialchars($item['role_name']); ?>" <?php echo ($emrolename == $item['role_name']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($item['role_name']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nhân viên</td>
                <td>
                    <select name="employee_id">
                        <?php foreach ($employee_id as $item) { ?>
                            <option value="<?php echo htmlspecialchars($item['employee_id']); ?>" <?php echo ($ememployeeid == $item['employee_id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($item['employee_id']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="edit_tk" value="Lưu" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>