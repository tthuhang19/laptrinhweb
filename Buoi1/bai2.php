    <?php
        // Dữ liệu mẫu
        $books = [];
        for ($i = 1; $i <= 100; $i++) {
            $books[] = [
                'stt' => $i,
                'ten_sach' => 'Tensach' . $i,
                'noi_dung' => 'Noidung' . $i
            ];
        }
    ?>

    <?php
        // Số sách hiển thị trên mỗi trang
        $booksPerPage = 10;

        // Tính tổng số trang
        $totalBooks = count($books);
        $totalPages = ceil($totalBooks / $booksPerPage);

        // Lấy trang hiện tại từ tham số URL, mặc định là 1
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        if ($page > $totalPages) $page = $totalPages;

        // Tính chỉ số bắt đầu
        $startIndex = ($page - 1) * $booksPerPage;

        // Lấy các sách hiển thị trên trang hiện tại
        $booksToShow = array_slice($books, $startIndex, $booksPerPage);
    ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sách Có Phân Trang</title>
</head>
<body>
    <h1>Danh Sách Sách</h1>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>STT</th>
            <th>Tên sách</th>
            <th>Nội dung sách</th>
        </tr>
        <?php foreach ($booksToShow as $book): ?>
        <tr>
            <td><?php echo $book['stt']; ?></td>
            <td><?php echo $book['ten_sach']; ?></td>
            <td><?php echo $book['noi_dung']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div>
        <?php if ($page > 1): ?>
            <a style="text-decoration: none;" href="?page=<?php echo $page - 1; ?>">Trước</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a style="text-decoration: none;" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a style="text-decoration: none;" href="?page=<?php echo $page + 1; ?>">Tiếp</a>
        <?php endif; ?>
    </div>

    
</body>
</html>
