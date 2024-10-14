<?php
session_start();
require_once('loginconnect.php');

// if(isset($_SESSION['name']) && isset($_SESSION['username'] )){

// }
$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản trị viên</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</head>
<body>
    <h1>Đây là trang dành cho quản trị viên</h1>
    <a href="home.php" class="ajax-link">Home</a>
    <a href="tk_list.php" class="ajax-link">Danh sách người dùng</a>
    <a href="employee_list.php" class="ajax-link">Danh sách nhân viên</a>
    <a href="logout.php">Thoát</a>
    <div id="content"><p>Xin chào <span><?= htmlspecialchars($_SESSION['username']); ?></span></p></div>
</body>
<script>
        $(document).ready(function () {
            // Bắt sự kiện click vào các liên kết có class "ajax-link"
            $('.ajax-link').click(function (e) {
                e.preventDefault(); // Ngăn hành động mặc định của liên kết (không tải lại trang)

                var url = $(this).attr('href'); // Lấy URL từ thuộc tính href của liên kết

                // Sử dụng AJAX để tải nội dung của trang được chỉ định
                $.ajax({
                    url: url, // URL của trang muốn tải
                    method: 'GET', // Phương thức GET để lấy nội dung
                    success: function (response) {
                        // Khi nhận được phản hồi thành công, chèn nội dung vào div #content
                        $('#content').html(response);
                    },
                    error: function () {
                        // Nếu có lỗi xảy ra, hiển thị thông báo lỗi
                        $('#content').html('<p>Có lỗi xảy ra khi tải trang.</p>');
                    }
                });
            });
    });
    </script>

</html>