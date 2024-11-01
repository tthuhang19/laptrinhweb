<?php
session_start();
include './models/database.php';

$db = new Database();
$id_sinh_vien = $_SESSION['user_id'] ?? null; // Lấy ID sinh viên từ session

// Kiểm tra nếu sinh viên đã đăng nhập
if ($id_sinh_vien) {
    // Lấy id khóa học từ GET
    $id_khoa_hoc = $_GET['id_khoa_hoc'] ?? null;

    if ($id_khoa_hoc) {
        // Thực hiện truy vấn để hủy đăng ký
        $stmt = $db->connect()->prepare("
            DELETE FROM dangkykhoahoc 
            WHERE id_khoa_hoc = ? AND id_sinh_vien = ?
        ");
        $stmt->bind_param('ii', $id_khoa_hoc, $id_sinh_vien);

        if ($stmt->execute()) {
            // Nếu hủy thành công, lưu thông báo vào session
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Hủy đăng ký thành công!'
            ];
            header("Location: sinhvien-khoahocdadangky.php");
            exit();
        } else {
            // Xử lý lỗi nếu cần
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Lỗi trong quá trình hủy đăng ký!'
            ];
            header("Location: sinhvien-khoahocdadangky.php");
            exit();
        }
    } else {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => 'Không tìm thấy khóa học!'
        ];
        header("Location: sinhvien-khoahocdadangky.php");
        exit();
    }
} else {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}
?>
