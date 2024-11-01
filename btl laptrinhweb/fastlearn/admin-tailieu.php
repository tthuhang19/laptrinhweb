<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài Liệu Khóa Học</title>
    <?php include './components/link.php'; ?>
    <!-- Thêm CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
</head>
<body>
    <div class="d-flex">
        <?php include './layouts/aside.php'; ?>
        <main class="content">
            <!-- Form sửa tài liệu khóa học -->
            <?php 
            $id_khoa_hoc = $_GET['id_khoa_hoc'] ?? null; // Lấy ID khóa học từ URL
            $data = null;
            $khoahoc = $db->one('khoahoc', $id_khoa_hoc);
            $stmt = $db->connect()->prepare("SELECT * FROM tailieukhoahoc WHERE id_khoa_hoc = ?");
            $stmt->bind_param('i', $id_khoa_hoc);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            ?>
            <h1 class="text-white bg-gra p-3 text-center" style="border-radius: 4px">Tài Liệu Khóa Học: <?= $khoahoc['ten_khoa_hoc'] ?></h1>

            <form class="mt-4" method="POST" action="">
                <h2 class="text-primary mb-2">Tài Liệu</h2>
                <input type="hidden" name="id_khoa_hoc" value="<?= $id_khoa_hoc ?>">
                <div class="form-group">
                    <label for="noiDung">Nội Dung</label>
                    <textarea id="noiDung" name="noi_dung" class="form-control" placeholder="Nhập nội dung tài liệu" required><?= (isset($data)) ? $data['noi_dung'] : '' ?></textarea>
                </div>
                <button type="submit" name="edit" class="btn btn-success">Cập nhật</button>
            </form>

            <script>
                CKEDITOR.replace('noi_dung'); // Khởi tạo CKEditor cho textarea
            </script>
        </main>
    </div>
</body>
</html>

<!-- /* ---------------------------------- XỬ LÝ --------------------------------- */ -->
<?php
// Xử lý cập nhật tài liệu khóa học
if (isset($_POST["edit"])) {
    $id_khoa_hoc = $_POST['id_khoa_hoc'];
    $noi_dung = $_POST['noi_dung'];

    // Cập nhật tài liệu trong cơ sở dữ liệu
    $stmt = $db->connect()->prepare("UPDATE tailieukhoahoc SET noi_dung = ? WHERE id_khoa_hoc = ?");
    $stmt->bind_param('si', $noi_dung, $id_khoa_hoc);
    $stmt->execute();
    echo "<script>location.href='./admin-tailieu.php?id_khoa_hoc=$id_khoa_hoc';</script>";
    exit();
}
?>
<!-- /* ---------------------------------- XỬ LÝ --------------------------------- */ -->
