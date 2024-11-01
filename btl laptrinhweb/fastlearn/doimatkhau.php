<?php 
session_start();
include './components/link.php';
include './models/database.php'; // Kết nối đến cơ sở dữ liệu
$db = new Database();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Lấy thông tin người dùng từ session
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Xử lý đổi mật khẩu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mat_khau_moi = md5($_POST['mat_khau_moi']); // Mã hóa mật khẩu mới bằng MD5
    $mat_khau_cu = md5($_POST['mat_khau_cu']); // Mã hóa mật khẩu cũ bằng MD5

    // Xác định bảng dựa trên role
    $table = '';
    switch ($role) {
        case 'sinhvien':
            $table = 'sinhvien';
            break;
        case 'giangvien':
            $table = 'giangvien';
            break;
        case 'quantrivien':
            $table = 'quantrivien';
            break;
        default:
            echo "Quyền không hợp lệ.";
            exit();
    }

    // Kiểm tra mật khẩu cũ
    $stmt = $db->connect()->prepare("SELECT * FROM $table WHERE id = ? AND mat_khau = ?");
    $stmt->bind_param('is', $user_id, $mat_khau_cu);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Cập nhật mật khẩu mới
        $stmt = $db->connect()->prepare("UPDATE $table SET mat_khau = ? WHERE id = ?");
        $stmt->bind_param('si', $mat_khau_moi, $user_id);
        $stmt->execute();

        $_SESSION['success_message'] = "Mật khẩu đã được đổi thành công."; // Lưu thông báo vào session
    } else {
        $error = "Mật khẩu cũ không chính xác.";
    }
}
?>


    <div class="container h-100 bg-gra">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12 border rounded p-4 bg-white" style="width: 500px">
                <h2 class="text-center mb-4">Đổi Mật Khẩu</h2>
                <form class="form" method="POST">
                    <div class="form-group">
                        <label for="mat_khau_cu">Mật Khẩu Cũ</label>
                        <input type="password" class="form-control" id="mat_khau_cu" name="mat_khau_cu" placeholder="Nhập mật khẩu cũ" required>
                    </div>
                    <div class="form-group">
                        <label for="mat_khau_moi">Mật Khẩu Mới</label>
                        <input type="password" class="form-control" id="mat_khau_moi" name="mat_khau_moi" placeholder="Nhập mật khẩu mới" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 text-uppercase">Đổi Mật Khẩu</button>
                    <?php if (isset($error)) : ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi',
                                text: '<?= $error ?>'
                            });
                        </script>
                    <?php endif; ?>
                    <div class="d-flex justify-content-center"><a href="./dashboard.php" class="mt-3">Quay lại</a></div>
                </form>
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['success_message'])) : ?>

    <script>
            Swal.fire('Thành công!', 'Mật khẩu đã được đổi thành công.', 'success').then(() => {
                window.location.href = './dashboard.php';
            });
        </script>
                    <?php endif; ?>
