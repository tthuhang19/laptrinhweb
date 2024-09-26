<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiển thị dữ liệu từ bảng</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Dữ liệu từ bảng my_guests</h2>

<?php
    $host = "sql110.infinityfree.com";
    $db_name = "_b5_mydb";
    $username = "";
    $password = "";
    $table_name = "";

$conn = new mysqli($host, $username, $password,$db_name);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Câu lệnh SQL để lấy dữ liệu
$sql = "SELECT id, firstname, lastname, email, reg_date FROM my_guests";

// Thực hiện truy vấn
$result = $conn->query($sql);

// Kiểm tra nếu có dữ liệu trả về
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Registration Date</th></tr>";

    // Lặp qua từng dòng dữ liệu và hiển thị
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['firstname'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['reg_date'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Không có dữ liệu nào trong bảng.</p>";
}

// Đóng kết nối
$conn->close();
?>
<br><a href="update.php">Sửa người dùng James</a>
<br><a href="delete.php">Xóa người dùng có id là 3</a>
</body>
</html>
