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
        <?php include './layouts/aside.php'; ?> <!-- Include phần aside -->
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center mb-4" style="margin: -20px">Danh Sách Khóa Học</h2>
            <div class="container mb-4">
                <!-- Search Input -->
                <input type="text" id="search" placeholder="Tìm kiếm khóa học..." class="form-control" onkeyup="filterCourses()" />
            </div>
            <div class="course-container" id="courseContainer">
                <?php
                $id_sinh_vien = $_SESSION['user_id'] ?? null; // Lấy ID sinh viên từ session

                // Kiểm tra nếu sinh viên đã đăng nhập
                if ($id_sinh_vien) {
                    // Lấy danh sách tất cả các khóa học và khóa học mà sinh viên đã đăng ký
                    $stmt = $db->connect()->prepare("
                        SELECT k.*, d.id_sinh_vien 
                        FROM khoahoc k
                        LEFT JOIN dangkykhoahoc d 
                        ON k.id = d.id_khoa_hoc 
                        AND d.id_sinh_vien = ?
                    ");
                    $stmt->bind_param('i', $id_sinh_vien);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $khoahocs = $result->fetch_all(MYSQLI_ASSOC);
                }
                ?>
                <?php 
                foreach ($khoahocs as $khoahoc) : 
                    $da_dang_ky = !is_null($khoahoc['id_sinh_vien']); // Kiểm tra xem sinh viên đã đăng ký khóa học này chưa
                ?>
                    <div class="course-card" data-title="<?= strtolower($khoahoc['ten_khoa_hoc']) ?>">
                        <img src="./uploads/<?= $khoahoc['hinh_anh'] ?>" alt="<?= $khoahoc['ten_khoa_hoc'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $khoahoc['ten_khoa_hoc'] ?></h5>
                            <p class="card-text">
                                <span><?= substr($khoahoc['mo_ta_khoa_hoc'], 0, 100) ?>...</span>
                            </p>
                            <p>Chi phí: <span class="font-weight-bold text-danger"><?= number_format($khoahoc['chi_phi']) . ' VNĐ' ?></span></p>
                            <p class="mt-1">Thời lượng: <?= $khoahoc['thoi_luong'] ?> giờ</p>
                            <p class="mt-1 mb-3">Giảng viên: <?= (new Database())->oneWhere('giangvien', 'id', $khoahoc['id_giang_vien'])['ho_va_ten'] ?></p>
                            <a href="<?= !$da_dang_ky ? "./sinhvien-dangkykhoahoc.php?id_khoa_hoc={$khoahoc['id']}" : '#' ?>" 
                            class="btn <?= $da_dang_ky ? 'btn-light' : 'btn-success' ?>" 
                            <?= $da_dang_ky ? 'aria-disabled="true"' : '' ?>>
                                <i class="icon-class"><?= $da_dang_ky ? '✅' : '📝' ?></i> <!-- Thay icon theo nhu cầu -->
                                <?= $da_dang_ky ? 'Đã Đăng Ký' : 'Đăng Ký Ngay' ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

    <script>
        function filterCourses() {
            const input = document.getElementById('search').value.toLowerCase();
            const courses = document.querySelectorAll('.course-card');

            courses.forEach(course => {
                const title = course.getAttribute('data-title');
                if (title.includes(input)) {
                    course.style.display = ''; // Show course
                } else {
                    course.style.display = 'none'; // Hide course
                }
            });
        }
    </script>
    
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
