<?php
require 'employee.php';
$employee = get_all_employees();
disconnect_db();
?>

        <h1>Danh sách nhân viên</h1>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td><b>First name</b></td>
                <td>Last name</td>
                <td>Role</td>
                <td>Departments</td>
            </tr>
            <?php foreach ($employee as $item){ ?>
            <tr>
                <td><?php echo $item['first_name']; ?></td>
                <td><?php echo $item['last_name']; ?></td>
                <td><?php echo $item['role_name']; ?></td>
                <td><?php echo $item['department_name']; ?></td>
            </tr>
            <?php } ?>
        </table>
