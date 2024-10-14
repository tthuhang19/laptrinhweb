<p>Bạn đăng nhập chưa đúng Click vào đây để đăng nhập 
    <a href="loginform.php">Login</a>
</p>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script>
        $(document).ready(function () {
            // Bắt sự kiện click vào các liên kết có class "ajax-link"
            $('a').click(function (e) {
                e.preventDefault(); // Ngăn hành động mặc định của liên kết (không tải lại trang)

                var url = $(this).attr('href'); // Lấy URL từ thuộc tính href của liên kết

                // Sử dụng AJAX để tải nội dung của trang được chỉ định
                $.ajax({
                    url: url, // URL của trang muốn tải
                    method: 'GET', // Phương thức GET để lấy nội dung
                    success: function (response) {
                        // Khi nhận được phản hồi thành công, chèn nội dung vào div #content
                        $('p').html(response);
                    },
                    error: function () {
                        // Nếu có lỗi xảy ra, hiển thị thông báo lỗi
                        $('p').html('<p>Có lỗi xảy ra khi tải trang.</p>');
                    }
                });
            });
        });
    </script>