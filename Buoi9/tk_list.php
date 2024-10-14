<?php
require 'create.php';
$employee = get_all_tk();
disconnect_db();
?>
    <h2>Danh sách người dùng</h2>
    <a href="themtk.php">Thêm người dùng</a>
    <table width="100%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td><b>User ID</b></td>
            <td>Tên đăng nhập</td>
            <td>Mật khẩu</td>
            <td>Vai trò</td>
            <td>Chọn thao tác</td>
        </tr>
        <?php foreach ($employee as $item){ ?>
            <tr>
                <td><?php echo $item['userid']; ?></td>
                <td><?php echo $item['username']; ?></td>
                <td><?php echo $item['password']; ?></td>
                <td><?php echo $item['role_name']; ?></td>
                <td>
                    <form method="post" action="tk_delete.php">
                        <input onclick="window.location = 'tk_edit.php?id=<?php echo $item['userid']; ?>'" type="button" value="Sửa"/>
                        <input type="hidden" name="userid" value="<?php echo $item['userid']; ?>"/>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>