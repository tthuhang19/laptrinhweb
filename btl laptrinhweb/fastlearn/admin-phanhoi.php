<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phản hồi</title>
    <?php include './components/link.php'; ?>
</head>
<body>
    <div class="d-flex">
        <?php include './layouts/aside.php'; ?>
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center mb-4" style="margin: -20px">Quản Lý Phản Hồi</h2>
            <!-- Danh sách phản hồi -->
            <h2 class="text-primary mt-5 mb-2">Danh Sách Phản Hồi</h2>
            <?php 
            // Lấy tất cả phản hồi từ cơ sở dữ liệu
            $phanhois = $db->all('phanhoi'); // Giả định rằng bạn đã có phương thức all() trong lớp $db
            
            // Kiểm tra và xử lý xóa phản hồi
            if (isset($_GET['delete_id'])) {
                $delete_id = $_GET['delete_id'];
                $db->delete('phanhoi', $delete_id); // Giả định rằng bạn đã có phương thức delete() trong lớp $db
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => 'Xóa phản hồi thành công.'
                ];
                header("Location: " . $_SERVER['PHP_SELF']); // Tải lại trang để hiển thị thông báo
                exit();
            }
            ?>
            <?php $stt = 1 ?>
            <?php if (!empty($phanhois)) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Sinh Viên</th>
                            <th>Nội Dung Phản Hồi</th>
                            <th>Nội Dung Trả Lời</th>
                            <th>Hành Động</th> <!-- Column for action buttons -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($phanhois as $phanhoi) : ?>
                            <tr>
                                <td><?= $stt ?></td>
                                <td><?= $db->one('sinhvien', $phanhoi['id_sinh_vien'])['ho_va_ten'] ?></td>
                                <td><?= $phanhoi['noi_dung_phan_hoi'] ?></td>
                                <td><span><?= $db->getWhereTL($phanhoi['id'])->fetch_assoc()['noi_dung'] ?? "<span class='text-danger'>Chưa trả lời</span>" ?></span></td>
                                <td>
                                    <!-- Delete button -->
                                    <a href="./admin-traloiphanhoi.php?id=<?= $phanhoi['id'] ?>" class="btn btn-success mb-1">Trả lời</a>
                                    <a href="?delete_id=<?= $phanhoi['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa phản hồi này không?');">Xóa</a>
                                </td>
                            </tr>
                            <?php $stt++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else : ?>
                <span class="text-danger">Chưa có phản hồi nào</span>
            <?php endif ?>
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
