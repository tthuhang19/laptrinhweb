<?php
require 'employee.php';
$role = get_all_role();

$available_roles = [
    'Manager' => 'Manager',
    'Employee' => 'Employee',
    'Intern' => 'Intern',
];

$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
$data = null;

if ($id) {
    $data = get_role($id);
    if ($data) {
        foreach ($data as $row) {
            $roleid = $row['role_id'];
            $rolename = $row['role_name'];
        }
    }
}

if (!$data) {
    header("location: roles_list.php");
    exit();
}

if (!empty($_POST['edit_role'])) {
    $data['role_id'] = isset($_POST['role_id']) ? $_POST['role_id'] : '';
    $data['role_name'] = isset($_POST['role_name']) ? $_POST['role_name'] : '';

    $errors = array();
    if (empty($data['role_id'])) {
        $errors['role_id'] = 'Role ID không bỏ trống';
    }

    if (empty($data['role_name'])) {
        $errors['role_name'] = 'Role name không bỏ trống';
    }

    if (empty($errors)) {
        edit_role($data['role_id'], $data['role_name']);
        header("location: roles_list.php");
        exit();
    }
}

disconnect_db();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin nhân viên</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Sửa thông tin nhân viên</h1>
    <a href="roles_list.php">Trở về</a><br/><br/>
    <form method="post" action="roles_edit.php?id=<?php echo $id; ?>">
        <table width="50%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Role ID</td>
                <td>
                    <input type="number" name="role_id" value="<?php echo $roleid; ?>" readonly/>
                    <?php if (!empty($errors['role_id'])) echo $errors['role_id']; ?>
                </td>
            </tr>
            <tr>
                <td>Role Name</td>
                <td>
                    <select name="role_name">
                        <option value="">Chọn chức vụ</option>
                        <?php foreach ($available_roles as $value => $label): ?>
                            <option value="<?php echo $value; ?>" <?php echo ($rolename === $value) ? 'selected' : ''; ?>>
                                <?php echo $label; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['role_name'])) echo $errors['role_name']; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="edit_role" value="Lưu"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>