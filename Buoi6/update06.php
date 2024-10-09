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

$sql = "UPDATE myguests SET firstname='Jane' WHERE firstname='James'";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>