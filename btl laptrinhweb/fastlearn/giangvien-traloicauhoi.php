<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Câu Hỏi Khóa Học</title>
    <?php include './components/link.php'; ?>
</head>
<body>
    <div class="d-flex">
        <?php include './layouts/aside.php'; ?> <!-- Include phần aside -->
        <?php
        // Kiểm tra xem giảng viên đã đăng nhập hay chưa
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'giangvien') {
            header("Location: dangnhap.php?role=giangvien");
            exit();
        }
        // Lấy ID khóa học từ GET
        $id_khoa_hoc = $_GET['id_khoa_hoc'] ?? null;
        $khoahoc = $db->one('khoahoc', $id_khoa_hoc);

        // Kiểm tra nếu có ID khóa học
        if ($id_khoa_hoc) {
            // Lấy các câu hỏi liên quan đến khóa học
            $stmt = $db->connect()->prepare("SELECT c.*, s.ho_va_ten FROM cauhoi c JOIN sinhvien s ON c.id_sinh_vien = s.id WHERE c.id_khoa_hoc = ?");
            $stmt->bind_param('i', $id_khoa_hoc);
            $stmt->execute();
            $cauhois = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "<p class='text-center'>Không tìm thấy khóa học.</p>";
            exit();
        }

        // Xử lý thêm câu trả lời
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['noi_dung_tra_loi']) && isset($_POST['id_cau_hoi'])) {
            $noi_dung_tra_loi = $_POST['noi_dung_tra_loi'];
            $id_cau_hoi = $_POST['id_cau_hoi'];

            // Thêm câu trả lời vào bảng
            $stmt = $db->connect()->prepare("INSERT INTO cautraloi (id_cau_hoi, noi_dung_tra_loi) VALUES (?, ?)");
            $stmt->bind_param('is', $id_cau_hoi, $noi_dung_tra_loi);
            $stmt->execute();
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Câu trả lời đã được thêm thành công!'];
            header("Location: " . $_SERVER['PHP_SELF'] . "?id_khoa_hoc={$id_khoa_hoc}");
            exit();
        }

        // Xử lý xóa câu trả lời
        if (isset($_GET['delete_answer'])) {
            $id_answer = $_GET['delete_answer'];
            $stmt = $db->connect()->prepare("DELETE FROM cautraloi WHERE id = ?");
            $stmt->bind_param('i', $id_answer);
            $stmt->execute();
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Câu trả lời đã được xóa thành công!'];
            header("Location: " . $_SERVER['PHP_SELF'] . "?id_khoa_hoc={$id_khoa_hoc}");
            exit();
        }
        ?>
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center mb-4" style="margin: -20px">Câu Hỏi Khóa Học</h2>
            <h3 class="text-center p-2 bg-white">Khóa học: <span class="text-primary"><?= htmlspecialchars($khoahoc['ten_khoa_hoc']) ?></span></h3>
            <div class="question-container">
    <?php if (empty($cauhois)): ?>
        <p class="text-center text-danger mt-4">Không có câu hỏi nào trong khóa học này.</p>
    <?php else: ?>
        <?php foreach ($cauhois as $cauhoi): ?>
            <div class="question-card mb-4 p-3 bg-light rounded">
                <h3>Câu Hỏi: <?= htmlspecialchars($cauhoi['noi_dung_cau_hoi']) ?></h3>
                <p class="user-ques">Từ <i><?= htmlspecialchars($cauhoi['ho_va_ten']) ?></i></p>
                <div class="answers">
                    <?php
                    // Lấy các câu trả lời cho câu hỏi này
                    $stmt = $db->connect()->prepare("SELECT * FROM cautraloi WHERE id_cau_hoi = ?");
                    $stmt->bind_param('i', $cauhoi['id']);
                    $stmt->execute();
                    $answers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                    foreach ($answers as $answer): ?>
                        <div class="answer-item">
                            <p><?= htmlspecialchars($answer['noi_dung_tra_loi']) ?></p>
                            <a href="?id_khoa_hoc=<?= $id_khoa_hoc ?>&delete_answer=<?= $answer['id'] ?>" class="text-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa câu trả lời này?');">Xóa</a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <form method="POST" class="mt-3">
                    <input type="hidden" name="id_cau_hoi" value="<?= $cauhoi['id'] ?>">
                    <div class="form-group">
                        <textarea name="noi_dung_tra_loi" placeholder="Nhập câu trả lời..." class="form-control" rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Thêm Câu Trả Lời</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

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
