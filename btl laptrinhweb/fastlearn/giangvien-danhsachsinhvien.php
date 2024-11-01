<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <?php include './components/link.php'; ?>
</head>
<body>
    <div class="d-flex">
        <?php include './layouts/aside.php'; ?>
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center mb-4" style="margin: -20px">Sinh viên trong khóa học</h2>
            <!-- Danh sách sinh viên -->
            <h2 class="text-primary mt-5 mb-2">Danh Sách Sinh Viên</h2>
            <?php 
            $id_khoa_hoc = $_GET["id_khoa_hoc"];
            $stmt = $db->connect()->prepare(
                "SELECT *
                        FROM sinhvien 
                        INNER JOIN dangkykhoahoc
                        ON sinhvien.id = dangkykhoahoc.id_sinh_vien
                        INNER JOIN khoahoc
                        ON khoahoc.id = dangkykhoahoc.id_khoa_hoc
                        WHERE khoahoc.id = ?");
            $stmt->bind_param('i', $id_khoa_hoc);
            $stmt->execute();
            $sinhviens = $stmt->get_result();
            ?>
            <?php $stt = 1 ?>
            <?php if ($sinhviens->num_rows > 0) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Đăng Nhập</th>
                            <th>Họ và Tên</th>
                            <th>Ngày Sinh</th>
                            <th>Email</th>
                            <th>Số Điện Thoại</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sinhviens as $sinhvien) : ?>
                            <tr>
                                <td><?= $stt ?></td>
                                <td><?= $sinhvien['ten_dang_nhap'] ?></td>
                                <td><?= $sinhvien['ho_va_ten'] ?></td>
                                <td><?= date("d/m/Y", strtotime($sinhvien['ngay_sinh'])) ?></td>
                                <td><?= $sinhvien['email'] ?></td>
                                <td><?= $sinhvien['sdt'] ?></td>
                            </tr>
                            <?php $stt++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else : ?>
                <span class="text-danger">Chưa có sinh viên nào tham gia khóa học này</span>
            <?php endif ?>
        </main>
    </div>
</body>
</html>


