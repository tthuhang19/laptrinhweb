<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài Liệu Khóa Học</title>
    <?php include './components/link.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="d-flex">
        <?php include './layouts/aside.php'; ?>
        <?php
        $id_khoa_hoc = $_GET['id_khoa_hoc'] ?? null;

        // Kiểm tra nếu có id khóa học
        if ($id_khoa_hoc) {
            // Lấy thông tin khóa học
            $stmt = $db->connect()->prepare("SELECT * FROM khoahoc WHERE id = ?");
            $stmt->bind_param('i', $id_khoa_hoc);
            $stmt->execute();
            $khoahoc = $stmt->get_result()->fetch_assoc();

            // Lấy tài liệu của khóa học
            $stmt = $db->connect()->prepare("SELECT * FROM tailieukhoahoc WHERE id_khoa_hoc = ?");
            $stmt->bind_param('i', $id_khoa_hoc);
            $stmt->execute();
            $tailieus = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } else {
            header("Location: sinhvien-khoahocdadangky.php");
            exit();
        }
        
        // Xử lý gửi câu hỏi
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['noi_dung_cau_hoi'])) {
            $noi_dung_cau_hoi = $_POST['noi_dung_cau_hoi'];
            $id_sinh_vien = $_SESSION['user_id'];
            
            // Thêm câu hỏi vào bảng cauhoi
            $stmt = $db->connect()->prepare("INSERT INTO cauhoi (id_khoa_hoc, id_sinh_vien, noi_dung_cau_hoi) VALUES (?, ?, ?)");
            $stmt->bind_param('iis', $id_khoa_hoc, $id_sinh_vien, $noi_dung_cau_hoi);
            $stmt->execute();
            $_SESSION['success_message'] = "Câu hỏi đã được gửi thành công.";
            header("Location: " . $_SERVER['PHP_SELF'] . "?id_khoa_hoc=$id_khoa_hoc");
            exit();
        }

        // Xử lý xóa câu hỏi
        if (isset($_GET['delete_question'])) {
            $id_cau_hoi = $_GET['delete_question'];
            // Kiểm tra nếu câu hỏi thuộc về sinh viên này
            $stmt = $db->connect()->prepare("SELECT * FROM cauhoi WHERE id = ? AND id_sinh_vien = ?");
            $stmt->bind_param('ii', $id_cau_hoi, $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $stmt = $db->connect()->prepare("DELETE FROM cauhoi WHERE id = ?");
                $stmt->bind_param('i', $id_cau_hoi);
                $stmt->execute();
                $_SESSION['success_message'] = "Câu hỏi đã được xóa thành công.";
            } else {
                $_SESSION['error_message'] = "Bạn không có quyền xóa câu hỏi này.";
            }
            header("Location: " . $_SERVER['PHP_SELF'] . "?id_khoa_hoc=$id_khoa_hoc");
            exit();
        }
        ?>
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center mb-4" style="margin: -20px"><?= htmlspecialchars($khoahoc['ten_khoa_hoc']) ?> - Tài Liệu</h2>
            <div class="row">
                <?php if (!empty($tailieus)): ?>
                    <?php foreach ($tailieus as $tailieu): ?>
                        <div class="col-md-4 p-3 w-100">
                            <div class="doc-card">
                                <div class="card-body">
                                    <h5 class="card-title">Nội Dung Tài Liệu</h5>
                                    <div><?= $tailieu['noi_dung'] ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Chưa có tài liệu cho khóa học này.</p>
                <?php endif; ?>
            </div>
            <div class="question-form">
                <form method="POST" style="border-radius: 5px">
                    <h3 class="mb-2">Gửi Câu Hỏi:</h3>
                    <div class="form-group">
                        <textarea name="noi_dung_cau_hoi" placeholder="Bạn có thắc mắc gì?" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn bg-gra">Gửi Câu Hỏi</button>
                </form>
            </div>
            <div class="question-container bg-white">
                <?php
                // Lấy danh sách câu hỏi
                $stmt = $db->connect()->prepare("SELECT cauhoi.*, sinhvien.ho_va_ten FROM cauhoi JOIN sinhvien ON cauhoi.id_sinh_vien = sinhvien.id WHERE id_khoa_hoc = ?");
                $stmt->bind_param('i', $id_khoa_hoc);
                $stmt->execute();
                $cauhois = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                if (empty($cauhois)): ?>
                    <p class="text-center">Không có câu hỏi nào.</p>
                <?php else: ?>
                    <?php foreach ($cauhois as $cauhoi): ?>
                        <div class="question-card mb-4 p-3 rounded bg-white">
                            <h3>Câu Hỏi: <?= htmlspecialchars($cauhoi['noi_dung_cau_hoi']) ?></h3>
                            <p class="user-ques">Từ <i><?= htmlspecialchars($cauhoi['ho_va_ten']) ?></i></p>
                            <div class="answers">
                                <?php
                                // Lấy các câu trả lời cho câu hỏi này
                                $stmt = $db->connect()->prepare("SELECT * FROM cautraloi WHERE id_cau_hoi = ?");
                                $stmt->bind_param('i', $cauhoi['id']);
                                $stmt->execute();
                                $answers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                                if (empty($answers)): ?>
                                    <p class="text-center">Chưa có câu trả lời nào.</p>
                                <?php else: ?>
                                    <?php foreach ($answers as $answer): ?>
                                        <div class="answer-item p-3 border rounded my-2 mt-2">
                                            <p><?= htmlspecialchars($answer['noi_dung_tra_loi']) ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <form method="POST" class="mt-3">
                                <?php if ($cauhoi['id_sinh_vien'] == $_SESSION['user_id']): ?>
                                    <a href="?id_khoa_hoc=<?= $id_khoa_hoc ?>&delete_question=<?= $cauhoi['id'] ?>" class="text-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa câu hỏi này?');">Xóa Câu Hỏi</a>
                                <?php endif; ?>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <a href="sinhvien-khoahocdadangky.php" class="btn btn-dark mt-3">Quay lại</a>
        </main>
    </div>

    <?php if (isset($_SESSION['success_message'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: '<?= $_SESSION['success_message'] ?>',
                confirmButtonText: 'OK'
            });
        </script>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error_message'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: '<?= $_SESSION['error_message'] ?>',
                confirmButtonText: 'OK'
            });
        </script>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

</body>
</html>

