<?php
 require 'create.php';
//gọi hàm để lấy thông tin phòng ban, chức vụ
$employee = get_all_tk();
$role=get_all_tkrole();
$employee_id =get_all_tknv();
// Nếu người dùng submit form
if (!empty($_POST['add_tk']))
{
    // Lay data
    $data['username']        = isset($_POST['username']) ? $_POST['username'] : '';
    $data['password']         = isset($_POST['password']) ? $_POST['password'] : '';
    $data['role_name']    = isset($_POST['role_name']) ? $_POST['role_name'] : '';
    $data['employee_id']    = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
     
    // Validate thong tin
    $errors = array();
    if (empty($data['username'])){
        $errors['username'] = 'Chưa nhập tên user';
    }
     
    if (empty($data['password'])){
        $errors['password'] = 'Chưa nhập mật khẩu';
    }

    // Kiểm tra xem username có bị trùng hay không
    if (check_username_exists($data['username'])) {
        $errors['username'] = 'Tên user đã tồn tại';
    }

    $role_id1 = get_role($data['role_name']);
    foreach ($role_id1 as $row) {
        $x = $row['role_name'];
    }

    $department_id1 = get_employeeid($data['employee_id']);
    foreach ($department_id1 as $row) {
        $y = $row['employee_id'];
    }

    // Neu ko co loi thi insert
    if (!$errors) {
        // Mã hóa mật khẩu trước khi lưu
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        add_tk($data['username'], $hashed_password, $x, $y);

        // Trở về trang danh sách
        header("Location: admin.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Thêm người dùng</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Thêm người dùng</h1>
        <a href="admin.php">Trở về</a> <br/> <br/>
        <form method="post" action="themtk.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>User name</td>
                    <td>
                        <input type="text" name="username" value="<?php echo !empty($data['username']) ? $data['username'] : ''; ?>"/>
                        <?php if (!empty($errors['username'])) echo $errors['username']; ?>
                    </td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>
                        <input type="text" name="password" value="<?php echo !empty($data['password']) ? $data['password'] : ''; ?>"/>
                        <?php if (!empty($errors['password'])) echo $errors['password']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Vai trò</td>
                    <td>
                        <select name="role_name">
                            <?php foreach ($role as $item){ ?>
                            <option><?php echo $item['role_name']; ?> </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Nhân viên</td>
                    <td>
                        <select name="employee_id">
                            <?php foreach ($employee_id as $item){ ?>
                            <option><?php echo $item['employee_id']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                    <td></td>
                    <td>
                        <input type="submit" name="add_tk" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
