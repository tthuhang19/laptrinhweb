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
        <?php 
            if(isset($_POST["rep"])){
                $id = $_GET["id"] ?? "";
                $noi_dung = $_POST["noi_dung"] ?? "";
                if(!empty($id) && !empty($noi_dung)){
                    $stmt = $db->connect()->prepare("INSERT INTO traloiphanhoi (`id_phan_hoi`,`noi_dung`) VALUES (?,?)");
                    $stmt->bind_param('is', $id, $noi_dung);
                    if($stmt->execute()){
                        $_SESSION['message'] = ['type' => 'success', 'text' => 'Câu trả lời đã được gửi thành công!'];
                        header("Location: ./admin-phanhoi.php");
                        exit();
                    }
                }
            }
        ?>
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center mb-4" style="margin: -20px">Quản Lý Phản Hồi</h2>
            <form method="POST" class="mt-3">
                <h2 class="mb-3">Trả lời phản hồi</h2>
                <input type="hidden" name="id_cau_hoi" value="<?= $cauhoi['id'] ?>">
                <div class="form-group">
                    <textarea name="noi_dung" placeholder="Nhập câu trả lời..." class="form-control" rows="2" required></textarea>
                </div>
                <button type="submit" name="rep" class="btn btn-success">Trả Lời</button>
            </form>
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
