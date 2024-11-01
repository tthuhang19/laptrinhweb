<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa Học Đang Dạy</title>
    <?php include './components/link.php'; ?>
</head>
<body>
    <div class="d-flex">
        <?php include './layouts/aside.php'; ?> <!-- Include phần aside -->
        <?php
        // Kiểm tra xem giảng viên đã đăng nhập hay chưa
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'giangvien') {
            header("Location: dangnhap.php?role=giangvien");
            exit();
        }

        $id_giang_vien = $_SESSION['user_id']; // Lấy ID giảng viên từ session

        // Lấy danh sách khóa học mà giảng viên đang dạy
        $stmt = $db->connect()->prepare("SELECT * FROM khoahoc WHERE id_giang_vien = ?");
        $stmt->bind_param('i', $id_giang_vien);
        $stmt->execute();
        $result = $stmt->get_result();
        $khoahocs = $result->fetch_all(MYSQLI_ASSOC);
        ?>
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center mb-4" style="margin: -20px">Khóa Học Đang Dạy</h2>
            <div class="course-container">
                <?php if (!empty($khoahocs)): ?>
                    <?php foreach ($khoahocs as $khoahoc): ?>
                        <div class="col">
                            <div class="course-card">
                                <img src="./uploads/<?= htmlspecialchars($khoahoc['hinh_anh']) ?>" alt="<?= htmlspecialchars($khoahoc['ten_khoa_hoc']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($khoahoc['ten_khoa_hoc']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars(substr($khoahoc['mo_ta_khoa_hoc'], 0, 90)) ?>...</p>
                                    <p>Chi phí: <span class="font-weight-bold text-danger"><?= number_format($khoahoc['chi_phi']) . ' VNĐ' ?></span></p>
                            <p class="mt-1">Thời lượng: <?= $khoahoc['thoi_luong'] ?> giờ</p>
                            <p class="mt-1 mb-3">Giảng viên: <?= (new Database())->oneWhere('giangvien', 'id', $khoahoc['id_giang_vien'])['ho_va_ten'] ?></p>
                                    <a style="font-size: 13px" href="./admin-tailieu.php?id_khoa_hoc=<?= $khoahoc['id'] ?>" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i> Tài liệu</a>
                                    <a style="font-size: 13px" href="giangvien-traloicauhoi.php?id_khoa_hoc=<?= $khoahoc['id'] ?>" class="btn btn-danger"><i class="fa-solid fa-clipboard-question"></i> Câu hỏi</a>
                                    <a style="font-size: 13px" href="./giangvien-danhsachsinhvien.php?id_khoa_hoc=<?= $khoahoc['id'] ?>" class="btn btn-warning"><i class="fa-solid fa-users"></i> Sinh viên</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Giảng viên chưa dạy khóa học nào.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <?php
    // Kiểm tra nếu có thông báo trong session
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $icon = $message['type'] === 'success' ? 'success' : ($message['type'] === 'error' ? 'error' : 'info');
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
</body>
</html>
