<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý giảng viên</title>
    <?php include './components/link.php'; ?>
</head>
<body>
    <div class="d-flex">
        <?php include './layouts/aside.php'; ?>
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center mb-4" style="margin: -20px">Quản Lý Giảng Viên</h2>
            
            <!-- Form tìm kiếm -->
            <form method="POST" action="admin-giangvien.php" class="form-group mt-2">
                <h2 class="text-primary mb-2">Tìm Kiếm Giảng Viên</h2>
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm giảng viên..." />
                <button class="btn btn-primary mt-2" name="search">Tìm kiếm</button>
            </form>

            <?php 
            // Lấy dữ liệu giảng viên nếu cần chỉnh sửa
            if($action == 'sua'){
                $data = $db->one('giangvien', $_GET["id"] ?? 1);
            }
            ?>

            <?php if(!isset($_POST["search"])) : ?>
                <!-- Form thêm/sửa giảng viên -->
                <form class="mt-4" method="POST">
                    <h2 class="text-primary mb-2">Thêm/Sửa Giảng Viên</h2>
                    <div class="form-group">
                        <label for="teacherName">Họ và Tên</label>
                        <input type="text" id="teacherName" name="ho_va_ten" class="form-control" placeholder="Nhập họ và tên" required value="<?= (isset($data)) ? $data['ho_va_ten'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Tên Đăng Nhập</label>
                        <input type="text" id="username" name="ten_dang_nhap" class="form-control" placeholder="Nhập tên đăng nhập" required value="<?= (isset($data)) ? $data['ten_dang_nhap'] : 'tendangnhap' ?>">
                    </div>
                    <?php if($action !== 'sua') : ?>
                        <div class="form-group">
                            <label for="password">Mật Khẩu</label>
                            <input type="password" id="password" name="mat_khau" class="form-control" placeholder="Nhập mật khẩu" required value="<?= (isset($data)) ? $data['mat_khau'] : '' ?>">
                        </div>
                    <?php endif ?>
                    <div class="form-group">
                        <label for="dob">Ngày Sinh</label>
                        <input type="date" id="dob" name="ngay_sinh" class="form-control" required value="<?= (isset($data)) ? $data['ngay_sinh'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email" required value="<?= (isset($data)) ? $data['email'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số Điện Thoại</label>
                        <input type="text" id="phone" name="sdt" class="form-control" placeholder="Nhập số điện thoại" required value="<?= (isset($data)) ? $data['sdt'] : '' ?>">
                    </div>
                    <button type="submit" name="<?= ($action == 'sua') ? 'edit' : 'add' ?>" class="btn btn-success"><?= ($action == 'sua') ? 'Cập nhật' : 'Thêm mới' ?></button>
                </form>
            <?php endif ?>

            <!-- Danh sách giảng viên -->
            <h2 class="text-primary mt-5 mb-2">Danh Sách Giảng Viên</h2>
            <?php 
            if (isset($_POST["search"])) {
                $keyword = $_POST["keyword"] ?? "";
                $stmt = $db->connect()->prepare("SELECT * FROM giangvien WHERE ho_va_ten LIKE ?");
                $keyword = "%" . "$keyword" . "%"; // Thay đổi để tìm kiếm theo phần
                $stmt->bind_param('s', $keyword);
                $stmt->execute();
                $giangviens = $stmt->get_result();
            } else {
                $giangviens = $db->all('giangvien');
            }
            ?>
            <?php $stt = 1 ?>
            <?php if (!empty($giangviens)) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Đăng Nhập</th>
                            <th>Họ và Tên</th>
                            <th>Ngày Sinh</th>
                            <th>Email</th>
                            <th>Số Điện Thoại</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($giangviens as $giangvien) : ?>
                            <tr>
                                <td><?= $stt ?></td>
                                <td><?= $giangvien['ten_dang_nhap'] ?></td>
                                <td><?= $giangvien['ho_va_ten'] ?></td>
                                <td><?= date("d/m/Y", strtotime($giangvien['ngay_sinh'])) ?></td>
                                <td><?= $giangvien['email'] ?></td>
                                <td><?= $giangvien['sdt'] ?></td>
                                <td>
                                    <a href="./admin-giangvien.php?action=sua&id=<?= $giangvien['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                    <a href="./admin-giangvien.php?action=xoa&id=<?= $giangvien['id'] ?>" class="btn btn-danger btn-sm " onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                                </td>
                            </tr>
                            <?php $stt++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else : ?>
                <span class="text-danger">Chưa có giảng viên nào</span>
            <?php endif ?>
        </main>
    </div>
</body>
</html>

<!-- /* ---------------------------------- XỬ LÍ --------------------------------- */ -->
<?php

if (isset($_POST["add"])) {
    $ten_dang_nhap = $_POST['ten_dang_nhap'];
    $mat_khau = md5($_POST['mat_khau']); // Mã hóa mật khẩu
    $ho_va_ten = $_POST['ho_va_ten'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];

    // Thêm giảng viên vào cơ sở dữ liệu
    $stmt = $db->connect()->prepare("INSERT INTO giangvien (ten_dang_nhap, mat_khau, ho_va_ten, ngay_sinh, email, sdt, ngay_tao) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param('ssssss', $ten_dang_nhap, $mat_khau, $ho_va_ten, $ngay_sinh, $email, $sdt);
    $stmt->execute();
    echo "<script>location.href='./admin-giangvien.php';</script>";
    exit();
}

if (isset($_POST["edit"])) {
    $id = $_GET['id'];
    $ten_dang_nhap = $_POST['ten_dang_nhap'];
    $ho_va_ten = $_POST['ho_va_ten'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];

    // Cập nhật giảng viên trong cơ sở dữ liệu
    $stmt = $db->connect()->prepare("UPDATE giangvien SET ten_dang_nhap = ?, ho_va_ten = ?, ngay_sinh = ?, email = ?, sdt = ? WHERE id = ?");
    $stmt->bind_param('sssssi', $ten_dang_nhap, $ho_va_ten, $ngay_sinh, $email, $sdt, $id);
    $stmt->execute();
    echo "<script>location.href='./admin-giangvien.php';</script>";
    exit();
}

if($action === 'xoa'){
    $id = $_GET["id"];
    $db->delete('giangvien', $id);
    echo "<script>location.href='./admin-giangvien.php';</script>";
}
?>
<!-- /* ---------------------------------- XỬ LÍ --------------------------------- */ -->
