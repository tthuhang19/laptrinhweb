<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi Phản Hồi</title>
    <?php include './components/link.php'; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <style>
        .feedback-form {
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            border: 2px solid #e093d3;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include './layouts/aside.php'; ?> <!-- Include phần aside -->
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center" style="margin: -20px">Gửi Phản Hồi</h2>
            <div class="feedback-form">
                <?php
                // Xử lý gửi phản hồi
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['noi_dung_phan_hoi'])) {
                    $noi_dung_phan_hoi = $_POST['noi_dung_phan_hoi'];
                    $id_sinh_vien = $_SESSION['user_id']; // Lấy ID sinh viên từ session
                   
                    // Thêm phản hồi vào bảng phanhoi
                    $stmt = $db->connect()->prepare("INSERT INTO phanhoi (id_sinh_vien, noi_dung_phan_hoi) VALUES (?, ?)");
                    $stmt->bind_param('is', $id_sinh_vien, $noi_dung_phan_hoi);
                    $stmt->execute();
                   
                    // Hiển thị thông báo thành công
                    echo "<script>
                            Swal.fire({
                                title: 'Thành Công!',
                                text: 'Phản hồi đã được gửi thành công.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location = 'sinhvien-khoahocdadangky.php'; // Chuyển hướng
                            });
                          </script>";
                }
                ?>
                <form method="POST">
                    <p class="mb-3">Đừng ngần ngại để lại những trải nghiệm hoặc câu hỏi của bạn với chúng tôi. Chúng tôi luôn đón nhận những phản hồi từ bạn <i style="color: #df0808;" class="fa-solid fa-heart"></i></p>
                    <div class="form-group">
                        <textarea name="noi_dung_phan_hoi" class="form-control" rows="5" required placeholder="Nhập nội dung phản hồi..."></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gra">Gửi Phản Hồi</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>



