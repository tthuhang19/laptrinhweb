<?php
// Include file kết nối cơ sở dữ liệu và các thành phần cần thiết
include './models/database.php';
session_start();

// Kiểm tra xem sinh viên đã đăng nhập hay chưa
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'sinhvien') {
    $_SESSION['message'] = [
        'type' => 'error',
        'text' => 'Vui lòng đăng nhập với tư cách sinh viên để đăng ký khóa học.'
    ];
    header('Location: ./dangnhap.php?role=sinhvien');
    exit();
}

$db = new Database();

// Lấy id_khoa_hoc từ URL
$id_khoa_hoc = $_GET['id_khoa_hoc'] ?? null;
$id_sinh_vien = $_SESSION['user_id'];

// Kiểm tra nếu id_khoa_hoc hợp lệ
if ($id_khoa_hoc && $id_sinh_vien) {
    // Kiểm tra xem sinh viên đã đăng ký khóa học này hay chưa
    $stmt = $db->connect()->prepare("SELECT * FROM dangkykhoahoc WHERE id_khoa_hoc = ? AND id_sinh_vien = ?");
    $stmt->bind_param('ii', $id_khoa_hoc, $id_sinh_vien);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = [
            'type' => 'info',
            'text' => 'Bạn đã đăng ký khóa học này rồi.'
        ];
        header('Location: ./sinhvien-tatcakhoahoc.php');
    } else {
        // Thêm bản ghi vào bảng dangkykhoahoc
        $stmt = $db->connect()->prepare("INSERT INTO dangkykhoahoc (id_khoa_hoc, id_sinh_vien) VALUES (?, ?)");
        $stmt->bind_param('ii', $id_khoa_hoc, $id_sinh_vien);
        if ($stmt->execute()) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Đăng ký khóa học thành công!'
            ];
            header('Location: ./sinhvien-tatcakhoahoc.php');
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Có lỗi xảy ra. Vui lòng thử lại.'
            ];
            header('Location: ./sinhvien-tatcakhoahoc.php');
        }
    }
} else {
    $_SESSION['message'] = [
        'type' => 'error',
        'text' => 'Khóa học không hợp lệ.'
    ];
    header('Location: ./sinhvien-tatcakhoahoc.php');
}
?>
