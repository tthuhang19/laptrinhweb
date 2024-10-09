<?php
$servername = "sql110.infinityfree.com";
$username = "if0_37144768";
$password = "19112004Ab";
$dbname = "if0_37144768_b6_mydb";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, firstname, lastname, reg_date FROM myguests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>firstname</th><th>lastname</th><th>reg_date</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]."</td><td> ".$row["lastname"]."</td><td>". $row["reg_date"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
