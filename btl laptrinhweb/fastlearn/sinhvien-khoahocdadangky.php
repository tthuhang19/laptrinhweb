<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Khóa Học</title>
    <?php include './components/link.php'; ?>
</head>
<body>
<div class="d-flex">
        <?php include './layouts/aside.php'; ?>
        
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center mb-4" style="margin: -20px">Khóa Học Đã Đăng Ký</h2>
            <div class="course-container">
                <?php
                $id_sinh_vien = $_SESSION['user_id'] ?? null; // Lấy ID sinh viên từ session

                // Kiểm tra nếu sinh viên đã đăng nhập
                if ($id_sinh_vien) {
                    // Lấy danh sách khóa học mà sinh viên đã đăng ký
                    $stmt = $db->connect()->prepare("
                        SELECT k.* 
                        FROM khoahoc k 
                        JOIN dangkykhoahoc d ON k.id = d.id_khoa_hoc 
                        WHERE d.id_sinh_vien = ?
                    ");
                    $stmt->bind_param('i', $id_sinh_vien);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $khoahocs = $result->fetch_all(MYSQLI_ASSOC);
                }
                ?>
                <?php 
                foreach ($khoahocs as $khoahoc) : ?>
                    <div class="col">
                        <div class="course-card">
                            <img src="./uploads/<?= $khoahoc['hinh_anh'] ?>" alt="<?= $khoahoc['ten_khoa_hoc'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $khoahoc['ten_khoa_hoc'] ?></h5>
                                <p class="card-text"><?= substr($khoahoc['mo_ta_khoa_hoc'], 0, 100) ?>...</p>
                                <p>Chi phí: <span class="font-weight-bold text-danger"><?= number_format($khoahoc['chi_phi']) . ' VNĐ' ?></span></p>
                            <p class="mt-1">Thời lượng: <?= $khoahoc['thoi_luong'] ?> giờ</p>
                            <p class="mt-1 mb-3">Giảng viên: <?= (new Database())->oneWhere('giangvien', 'id', $khoahoc['id_giang_vien'])['ho_va_ten'] ?></p>
                                <a href="./sinhvien-tailieu.php?id_khoa_hoc=<?= $khoahoc['id'] ?>" class="btn btn-success">Xem Tài Liệu</a>
                                <a href="./sinhvien-huydangkykhoahoc.php?id_khoa_hoc=<?= $khoahoc['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn hủy đăng ký?')">Hủy Đăng Ký</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</body>
</html>
<?php

// Kiểm tra nếu có thông báo trong session
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $icon = $message['type'] === 'success' ? 'success' : 'error';
    echo "<script>
            Swal.fire({
                icon: '{$icon}',
                title: 'Thông báo',
                text: '{$message['text']}',
                confirmButtonText: 'OK'
            });
          </script>";

    // Xóa thông báo khỏi session
    unset($_SESSION['message']);
}
?>
