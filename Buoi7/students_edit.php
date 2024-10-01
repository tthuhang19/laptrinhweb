<?php

require './libs/students.php';

// Lấy thông tin sinh viên để người dùng sửa
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$data = array();

if ($id) {
    $data = get_student($id);
}

// Nếu không tìm thấy sinh viên cần sửa, chuyển hướng về danh sách
if (!$data) {
    header("Location: students_list.php");
    exit(); // Dừng thực thi mã sau khi chuyển hướng
}

// Nếu người dùng submit form
if (!empty($_POST['edit_student'])) {
    // Lấy dữ liệu từ form
    $data['sv_name'] = isset($_POST['name']) ? $_POST['name'] : '';
    $data['sv_sex'] = isset($_POST['sex']) ? $_POST['sex'] : '';
    $data['sv_birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $data['sv_id'] = isset($_POST['id']) ? $_POST['id'] : '';

    // Kiểm tra và validate dữ liệu
    $errors = array();
    if (empty($data['sv_name'])) {
        $errors['sv_name'] = 'Chưa nhập tên sinh viên';
    }

    if (empty($data['sv_sex'])) {
        $errors['sv_sex'] = 'Chưa nhập giới tính sinh viên';
    }

    // Nếu không có lỗi thì tiến hành cập nhật dữ liệu
    if (!$errors) {
        edit_student($data['sv_id'], $data['sv_name'], $data['sv_sex'], $data['sv_birthday']);
        // Trở về trang danh sách
        header("Location: students_list.php");
        exit();
    }
}

disconnect_db();
?>

 
<!DOCTYPE html>
<html>
    <head>
        <title>Sửa sinh viên</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Sửa sinh viên</h1>
        <a href="students_list.php">Trở về</a> <br/> <br/>
        <form method="post" action="students_edit.php?id=<?php echo $data['id']; ?>">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($data['hoten']); ?>"/>
                        <?php if (!empty($errors['sv_name'])) echo $errors['sv_name']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <select name="sex">
                            <option value="Nam" <?php if ($data['gioitinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                            <option value="Nữ" <?php if ($data['gioitinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                        </select>
                        <?php if (!empty($errors['sv_sex'])) echo $errors['sv_sex']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Birthday</td>
                    <td>
                        <input type="date" name="birthday" value="<?php echo $data['ngaysinh']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                        <input type="submit" name="edit_student" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
