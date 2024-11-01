<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Thông Báo</title>
    <?php include './components/link.php'; ?>
</head>
<body>
    <div class="d-flex">
        <?php include './layouts/aside.php'; ?>
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center mb-4" style="margin: -20px">Quản Lý Thông Báo</h2>

            <!-- Form tìm kiếm -->
            <form method="POST" action="admin-thongbao.php" class="form-group mt-2">
                <h2 class="text-primary mb-2">Tìm Kiếm Thông Báo</h2>
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm thông báo..." />
                <button class="btn btn-primary mt-2" name="search">Tìm kiếm</button>
            </form>

            <!-- Form thêm/sửa thông báo -->
            <?php 
            // Kiểm tra nếu đang sửa thông báo
            if (isset($_GET['action']) && $_GET['action'] == 'sua') {
                $data = $db->one('thongbao', $_GET["id"] ?? 1);
            }
            ?>
            <form class="mt-4" method="POST">
                <h2 class="text-primary mb-2">Thêm/Sửa Thông Báo</h2>
                <div class="form-group">
                    <label for="title">Tiêu Đề</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Nhập tiêu đề" required value="<?= (isset($data)) ? $data['title'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="noiDungThongBao">Nội Dung Thông Báo</label>
                    <textarea id="noiDungThongBao" name="noi_dung_thong_bao" class="form-control" placeholder="Nhập nội dung thông báo" required><?= (isset($data)) ? $data['noi_dung_thong_bao'] : '' ?></textarea>
                </div>
                <button type="submit" name="<?= (isset($_GET['action']) && $_GET['action'] == 'sua') ? 'edit' : 'add' ?>" class="btn btn-success"><?= (isset($_GET['action']) && $_GET['action'] == 'sua') ? 'Cập nhật' : 'Thêm mới' ?></button>
            </form>

            <!-- Danh sách thông báo -->
            <h2 class="text-primary mt-5 mb-2">Danh Sách Thông Báo</h2>
            <?php 
            // Tìm kiếm thông báo
            if (isset($_POST["search"])) {
                $keyword = $_POST["keyword"] ?? "";
                $stmt = $db->connect()->prepare("SELECT * FROM thongbao WHERE title LIKE ? OR noi_dung_thong_bao LIKE ?");
                $keyword = "%" . $keyword . "%"; // Tìm kiếm theo phần
                $stmt->bind_param('ss', $keyword, $keyword);
                $stmt->execute();
                $thongbaos = $stmt->get_result();
            } else {
                $thongbaos = $db->all('thongbao'); // Lấy tất cả thông báo
            }
            ?>
            <?php $stt = 1 ?>
            <?php if (!empty($thongbaos)) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu Đề</th>
                            <th>Nội Dung Thông Báo</th>
                            <th>Ngày Tạo</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($thongbaos as $thongbao) : ?>
                            <tr>
                                <td><?= $stt ?></td>
                                <td><?= $thongbao['title'] ?></td>
                                <td><?= $thongbao['noi_dung_thong_bao'] ?></td>
                                <td><?= $thongbao['ngay_tao'] ?></td> <!-- Hiển thị ngày tạo -->
                                <td>
                                    <a href="./admin-thongbao.php?action=sua&id=<?= $thongbao['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                    <a href="./admin-thongbao.php?action=xoa&id=<?= $thongbao['id'] ?>" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                                </td>
                            </tr>
                            <?php $stt++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else : ?>
                <span class="text-danger">Chưa có thông báo nào</span>
            <?php endif ?>
        </main>
    </div>
</body>
</html>

<!-- /* ---------------------------------- XỬ LÍ --------------------------------- */ -->
<?php
// Xử lý thêm thông báo
if (isset($_POST["add"])) {
    $title = $_POST['title'];
    $noi_dung_thong_bao = $_POST['noi_dung_thong_bao'];
    $ngay_tao = date('Y-m-d'); // Lấy ngày giờ hiện tại

    // Thêm thông báo vào cơ sở dữ liệu
    $stmt = $db->connect()->prepare("INSERT INTO thongbao (title, noi_dung_thong_bao, ngay_tao) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $title, $noi_dung_thong_bao, $ngay_tao);
    $stmt->execute();
    echo "<script>location.href='./admin-thongbao.php';</script>";
    exit();
}

// Xử lý cập nhật thông báo
if (isset($_POST["edit"])) {
    $id = $_GET['id'];
    $title = $_POST['title'];
    $noi_dung_thong_bao = $_POST['noi_dung_thong_bao'];

    // Cập nhật thông báo trong cơ sở dữ liệu
    $stmt = $db->connect()->prepare("UPDATE thongbao SET title = ?, noi_dung_thong_bao = ? WHERE id = ?");
    $stmt->bind_param('ssi', $title, $noi_dung_thong_bao, $id);
    $stmt->execute();
    echo "<script>location.href='./admin-thongbao.php';</script>";
    exit();
}

// Xử lý xóa thông báo
if (isset($_GET['action']) && $_GET['action'] === 'xoa') {
    $id = $_GET["id"];
    $db->delete('thongbao', $id);
    echo "<script>location.href='./admin-thongbao.php';</script>";
}
?>
<!-- /* ---------------------------------- XỬ LÝ --------------------------------- */ -->
