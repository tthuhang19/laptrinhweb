<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm dữ liệu vào bảng</title>
</head>
<body>

<h2>Bấm vào nút để thêm 5 người vào bảng</h2>

<!-- Form có nút bấm -->
<form method="post">
    <button type="submit" name="insert_data">Thêm dữ liệu</button>
</form>
<?php
// Kiểm tra nếu nút bấm được bấm
if (isset($_POST['insert_data'])) {
    $host = "sql110.infinityfree.com";
    $db_name = "_b5_mydb";
    $username = "";
    $password = "";
    $table_name = "";

    $conn = new mysqli($host, $username, $password,$db_name);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Mảng chứa dữ liệu của 5 người
    $data_array = [
        ['firstname' => 'John', 'lastname' => 'Doe', 'email' => 'john@example.com'],
        ['firstname' => 'Jane', 'lastname' => 'Smith', 'email' => 'jane@example.com'],
        ['firstname' => 'James', 'lastname' => 'Johnson', 'email' => 'james@example.com'],
        ['firstname' => 'Emily', 'lastname' => 'Brown', 'email' => 'emily@example.com'],
        ['firstname' => 'Michael', 'lastname' => 'Davis', 'email' => 'tom@example.com'],
    ];

    $sql="INSERT INTO $table_name (firstname, lastname, email) VALUES (?,?,?)";
    $stmt=$conn->prepare($sql);
    if ($stmt === FALSE) {
      die("Error preparing statement: " . $conn->error);
    }

    foreach ($data_array as $data) {
      $stmt->bind_param("sss", $data['firstname'], $data['lastname'], $data['email']);

      if ($stmt->execute() === TRUE) {
          echo "Record for {$data['firstname']} {$data['lastname']} inserted successfully.<br>";
      } else {
          echo "Error inserting record for {$data['firstname']} {$data['lastname']}: " . $stmt->error . "<br>";
      }
  }

  $stmt->close();
  $conn->close();
    echo "<p>Hoàn tất việc thêm dữ liệu!</p>";
}
?>
<br>
<a href="view.php">Xem dữ liệu trong bảng</a>

</body>
</html>
