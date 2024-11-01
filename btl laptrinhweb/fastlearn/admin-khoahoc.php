<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khóa học</title>
    <?php include './components/link.php'; ?>
</head>
<body>
    <div class="d-flex">
        <?php include './layouts/aside.php'; ?>
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center mb-4" style="margin: -20px">Quản Lý Khóa Học</h2>
            
            <!-- Form tìm kiếm -->
            <form method="POST" action="admin-khoahoc.php" class="form-group mt-2">
                <h2 class="text-primary mb-2">Tìm Kiếm Khóa Học</h2>
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm khóa học..." />
                <button class="btn btn-primary mt-2" name="search">Tìm kiếm</button>
            </form>

            <?php 
            // Lấy dữ liệu khóa học nếu cần chỉnh sửa
            if($action == 'sua'){
                $data = $db->one('khoahoc', $_GET["id"] ?? 1);
            }
            ?>

            <?php if(!isset($_POST["search"])) : ?>
                <!-- Form thêm/sửa khóa học -->
                <form class="mt-4" method="POST" enctype="multipart/form-data">
    <h2 class="text-primary mb-2">Thêm/Sửa Khóa Học</h2>
    <div class="form-group">
        <label for="courseName">Tên Khóa Học</label>
        <input type="text" id="courseName" name="ten_khoa_hoc" class="form-control" placeholder="Nhập tên khóa học" required value="<?= (isset($data)) ? $data['ten_khoa_hoc'] : '' ?>">
    </div>
    <div class="form-group">
        <label for="teacherId">Giảng Viên</label>
        <select id="teacherId" name="id_giang_vien" class="form-control" required>
            <option value="">Chọn giảng viên</option>
            <?php 
            // Lấy danh sách giảng viên để hiển thị trong dropdown
            $giangviens = $db->all('giangvien');
            foreach ($giangviens as $giangvien) : ?>
                <option value="<?= $giangvien['id'] ?>" <?= (isset($data) && $data['id_giang_vien'] == $giangvien['id']) ? 'selected' : '' ?>>
                    <?= $giangvien['ho_va_ten'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Mô Tả Khóa Học</label>
        <textarea id="description" name="mo_ta_khoa_hoc" class="form-control" placeholder="Nhập mô tả khóa học" required><?= (isset($data)) ? $data['mo_ta_khoa_hoc'] : '' ?></textarea>
    </div>
    <div class="form-group">
        <label for="duration">Thời Gian (giờ)</label>
        <input type="number" id="duration" name="thoi_luong" class="form-control" placeholder="Nhập thời gian" required value="<?= (isset($data)) ? $data['thoi_luong'] : '' ?>">
    </div>
    <div class="form-group">
        <label for="cost">Chi Phí</label>
        <input type="number" id="cost" name="chi_phi" class="form-control" placeholder="Nhập chi phí" required value="<?= (isset($data)) ? $data['chi_phi'] : '' ?>">
    </div>
    <div class="form-group">
        <label for="image">Hình Ảnh Khóa Học</label>
        <input type="file" id="image" name="hinh_anh" class="form-control">
        <?php if (isset($data['hinh_anh'])) : ?>
            <img src="./uploads/<?= $data['hinh_anh'] ?>" alt="Hình ảnh khóa học" width="100" class="mt-2">
        <?php endif; ?>
    </div>
    <button type="submit" name="<?= ($action == 'sua') ? 'edit' : 'add' ?>" class="btn btn-success"><?= ($action == 'sua') ? 'Cập nhật' : 'Thêm mới' ?></button>
</form>

            <?php endif ?>

            <!-- Danh sách khóa học -->
            <h2 class="text-primary mt-5 mb-2">Danh Sách Khóa Học</h2>
            <?php 
            if (isset($_POST["search"])) {
                $keyword = $_POST["keyword"] ?? "";
                $stmt = $db->connect()->prepare("SELECT * FROM khoahoc WHERE ten_khoa_hoc LIKE ?");
                $keyword = "%" . "$keyword" . "%"; // Thay đổi để tìm kiếm theo phần
                $stmt->bind_param('s', $keyword);
                $stmt->execute();
                $khoahocs = $stmt->get_result();
            } else {
                $khoahocs = $db->all('khoahoc');
            }
            ?>
            <?php $stt = 1 ?>
            <?php if (!empty($khoahocs)) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Khóa Học</th>
                            <th>Hình ảnh</th>
                            <th>Giảng Viên</th>
                            <th>Thời Lượng</th>
                            <th>Chi Phí</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($khoahocs as $khoahoc) : ?>
                            <tr>
                                <td><?= $stt ?></td>
                                <td><?= $khoahoc['ten_khoa_hoc'] ?></td>
                                <td><img src="./uploads/<?= $khoahoc['hinh_anh'] ?>" width="50px" alt=""></td>
                                <td><?= $db->one('giangvien', $khoahoc['id_giang_vien'])['ho_va_ten'] ?></td>
                                <td><?= $khoahoc['thoi_luong'] ?> giờ</td>
                                <td><?= number_format($khoahoc['chi_phi']) ?> VNĐ</td>
                                <td>
                                    <a href="./admin-khoahoc.php?action=sua&id=<?= $khoahoc['id'] ?>" class="btn btn-warning btn-sm mt-1">Sửa</a>
                                    <a href="./admin-khoahoc.php?action=xoa&id=<?= $khoahoc['id'] ?>" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                                    <a href="./admin-tailieu.php?id_khoa_hoc=<?= $khoahoc['id'] ?>" class="btn btn-success btn-sm mt-1">Tài liệu</a> <!-- Thêm liên kết -->
                                </td>
                            </tr>
                            <?php $stt++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else : ?>
                <span class="text-danger">Chưa có khóa học nào</span>
            <?php endif ?>
        </main>
    </div>
</body>
</html>

<?php
if (isset($_POST["add"])) {
    $ten_khoa_hoc = $_POST['ten_khoa_hoc'];
    $id_giang_vien = $_POST['id_giang_vien'];
    $mo_ta_khoa_hoc = $_POST['mo_ta_khoa_hoc'];
    $thoi_luong = $_POST['thoi_luong'];
    $chi_phi = $_POST['chi_phi'];
    
    // Xử lý upload hình ảnh
    $hinh_anh = '';
    if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] == 0) {
        $hinh_anh = time() . '_' . $_FILES['hinh_anh']['name'];
        move_uploaded_file($_FILES['hinh_anh']['tmp_name'], './uploads/' . $hinh_anh);
    }

    // Thêm khóa học vào cơ sở dữ liệu
    $stmt = $db->connect()->prepare("INSERT INTO khoahoc (ten_khoa_hoc, hinh_anh, id_giang_vien, mo_ta_khoa_hoc, thoi_luong, chi_phi) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssisii', $ten_khoa_hoc, $hinh_anh, $id_giang_vien, $mo_ta_khoa_hoc, $thoi_luong, $chi_phi);
    $stmt->execute();
    $id_khoa_hoc = $db->connect()->insert_id;
    $noidung = "";
    $addTaiLieu = $db->connect()->prepare("INSERT INTO tailieukhoahoc (id_khoa_hoc, noi_dung) VALUES (?, ?)");
    $addTaiLieu->bind_param('is', $id_khoa_hoc, $noidung);
    $addTaiLieu->execute();
    echo "<script>location.href='./admin-khoahoc.php';</script>";
    exit();
}

if (isset($_POST["edit"])) {
    $id = $_GET['id'];
    $ten_khoa_hoc = $_POST['ten_khoa_hoc'];
    $id_giang_vien = $_POST['id_giang_vien'];
    $mo_ta_khoa_hoc = $_POST['mo_ta_khoa_hoc'];
    $thoi_luong = $_POST['thoi_luong'];
    $chi_phi = $_POST['chi_phi'];

    // Xử lý upload hình ảnh
    if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] == 0) {
        $hinh_anh = time() . '_' . $_FILES['hinh_anh']['name'];
        move_uploaded_file($_FILES['hinh_anh']['tmp_name'], './uploads/' . $hinh_anh);
    } else {
        // Nếu không upload ảnh mới, giữ nguyên ảnh cũ
        $hinh_anh = $db->one('khoahoc', $id)['hinh_anh'];
    }

    // Cập nhật khóa học trong cơ sở dữ liệu
    $stmt = $db->connect()->prepare("UPDATE khoahoc SET ten_khoa_hoc = ?, hinh_anh = ?, id_giang_vien = ?, mo_ta_khoa_hoc = ?, thoi_luong = ?, chi_phi = ? WHERE id = ?");
    $stmt->bind_param('ssisiii', $ten_khoa_hoc, $hinh_anh, $id_giang_vien, $mo_ta_khoa_hoc, $thoi_luong, $chi_phi, $id);
    $stmt->execute();
    
    echo "<script>location.href='./admin-khoahoc.php';</script>";
    exit();
}
// Xóa khóa học
if (isset($_GET['action']) && $_GET['action'] == 'xoa') {
    $id_khoa_hoc = $_GET['id'];
    $deleteStmt = $db->connect()->prepare("DELETE FROM khoahoc WHERE id = ?");
    $deleteStmt->bind_param('i', $id_khoa_hoc);
    if ($deleteStmt->execute()) {
        echo "<script>location.href='./admin-khoahoc.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra khi xóa khóa học.');</script>";
    }
    exit();
}

?>
