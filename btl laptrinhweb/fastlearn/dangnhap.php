<?php 
session_start();
include './components/link.php';
include './models/database.php'; // Kết nối đến cơ sở dữ liệu
$db = new Database();

// Lấy quyền từ URL
$role = $_GET['role'] ?? null;
if(isset($_SESSION["ten_dang_nhap"])){
    header("Location: ./dashboard.php");
}
$error = ''; // Initialize error variable
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_dang_nhap = $_POST['ten_dang_nhap'];
    $mat_khau = md5($_POST['mat_khau']); // Mã hóa mật khẩu bằng MD5

    // Xác thực người dùng dựa trên quyền
    if ($role) {
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

        // Truy vấn cơ sở dữ liệu
        $stmt = $db->connect()->prepare("SELECT * FROM $table WHERE ten_dang_nhap = ? AND mat_khau = ?");
        $stmt->bind_param('ss', $ten_dang_nhap, $mat_khau);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Lưu thông tin người dùng vào session
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id']; // Giả sử có trường id trong bảng
            $_SESSION['ten_dang_nhap'] = $user['ten_dang_nhap']; // Giả sử có trường ten_dang_nhap
            $_SESSION['role'] = $role; // Lưu quyền người dùng

            // Chuyển hướng đến trang chính hoặc trang khác
            header("Location: ./dashboard.php");
            exit();
        } else {
            $error = "Tên đăng nhập hoặc mật khẩu không chính xác.";
        }
    }
}
?>

<div class="container h-100 bg-gra">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-12 border rounded p-4 bg-white" style="width: 500px">
            <h2 class="text-center mb-4">Đăng Nhập</h2>
            <form class="form" method="POST">
                <div class="form-group">
                    <label for="ten_dang_nhap">Tên Đăng Nhập</label>
                    <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap" placeholder="Nhập tên đăng nhập" required>
                </div>
                <div class="form-group">
                    <label for="mat_khau">Mật Khẩu</label>
                    <input type="password" class="form-control" id="mat_khau" name="mat_khau" placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 text-uppercase">Đăng Nhập</button>
                <?php if (!empty($error)) : ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: '<?= $error ?>'
                        });
                    </script>
                <?php endif; ?>
                <div class="d-flex justify-content-center"><a href="./" class="mt-3">Quay lại</a></div>
            </form>
        </div>
    </div>
</div>

<!-- Ensure to include SweetAlert2 library if you haven't already -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
