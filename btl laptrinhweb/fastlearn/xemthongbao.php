<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo</title>
    <?php include './components/link.php'; ?>
    <style>
        .notification-container {
            max-width: 800px;
            margin: auto;
            padding: 25px;
            background-color: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .notification {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: white;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .notification-title {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 19px;
            text-transform: uppercase;
        }
        .notification-content {
            color: #555;
        }
        .notification-time {
            font-size: 12px;
            position: absolute;
            top: 5px;
            right: 10px;
            padding: 5px;
            background-color: #00712D;
            color: white;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include './layouts/aside.php'; ?> <!-- Include phần aside -->
        <main class="content">
            <h2 class="text-white bg-gra p-3 text-center mb-4" style="margin: -20px">Thông Báo</h2>
            <div class="notification-container">
                <?php
                // Lấy danh sách thông báo từ cơ sở dữ liệu
                $stmt = $db->connect()->prepare("SELECT * FROM thongbao ORDER BY id DESC");
                $stmt->execute();
                $thongbaos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                // Kiểm tra xem có thông báo nào không
                if (!empty($thongbaos)):
                    foreach ($thongbaos as $thongbao):
                ?>
                    <div class="notification">
                        <div class="notification-title"><i style="color: red" class="fa-solid fa-bullhorn"></i> <?= htmlspecialchars($thongbao['title']) ?></div>
                        <div class="notification-content"><?= htmlspecialchars($thongbao['noi_dung_thong_bao']) ?></div>
                        <div class="notification-time"><i class="fa-regular fa-clock"></i> <?= date('d/m/Y', strtotime($thongbao['ngay_tao'])) ?></div> <!-- Giả sử có trường created_at -->
                    </div>
                <?php endforeach; else: ?>
                    <p class="text-center">Hiện tại không có thông báo nào.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
