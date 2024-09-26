<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa tên James thành Jane</title>
</head>
<body>

<h2>Sửa tên James thành Jane</h2>

<!-- Form có nút bấm -->
<form method="post">
    <button type="submit" name="delete_id">Xóa id</button>
</form>

<?php
// Kiểm tra nếu nút bấm được bấm
if (isset($_POST['delete_id'])) {
    $host = "sql110.infinityfree.com";
    $db_name = "_b5_mydb";
    $username = "";
    $password = "";
    $table_name = "";

    $conn = new mysqli($host, $username, $password,$db_name);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Câu lệnh SQL để sửa tên
    $sql = "DELETE FROM my_guests  WHERE id='3'";

    if ($conn->query($sql) === TRUE) {
        echo "Số ID là 3 đã được xóa.<br>";
    } else {
        echo "Lỗi khi xóa: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
?>
<br><a href="view.php">Hiển thị dữ liệu sau khi sửa</a>;


</body>
</html>
