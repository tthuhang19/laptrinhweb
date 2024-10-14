<?php


try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=sql110.infinityfree.com;dbname=if0_37144768_employee", 'if0_37144768', '19112004Ab');

    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optionally: echo 'Server Connected Successfully'; // Uncomment for testing
} catch (PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}
?>


