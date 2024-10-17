<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tạo cơ sở dữ liệu</title>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<input type="submit" name="cr_db" value="create_db">
</form>
<?php
$servername = "sql110.infinityfree.com"; // Địa chỉ máy chủ MySQL
$username = "if0_37144768"; // Tên người dùng MySQL
$password = "19112004Ab"; // Mật khẩu MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	try {
	  $conn = new PDO("mysql:host=$servername", $username, $password);
	  // Thiết lập chế độ báo lỗi
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $sql = "CREATE DATABASE employee1_db";
	  // Sử dụng exec() vì không có kết quả trả về
	  $conn->exec($sql);
	  echo "Cơ sở dữ liệu đã được tạo thành công<br>";
	} catch(PDOException $e) {
	  echo "Lỗi: " . $e->getMessage();
	}

	$conn = null; // Đóng kết nối
}
?>
</body>
</html>
