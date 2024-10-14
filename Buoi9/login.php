<?php
session_start();
require_once('loginconnect.php');

if (isset($_POST['dangnhap'])) {

    // Check for empty fields first
    if (empty($_POST['username']) && empty($_POST['password'])) {
        echo "<script>alert('Please fill both Username and Password');</script>";
        exit;
    } elseif (empty($_POST['password'])) {
        echo "<script>alert('Please fill Password');</script>";
        exit;
    } elseif (empty($_POST['username'])) {
        echo "<script>alert('Please fill Username');</script>";
        exit;
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Prepare the query using PDO
        $sql = "SELECT * FROM taikhoan WHERE `username` = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Check if user exists
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['password'];

            // Verify the hashed password
            if (password_verify($password, $hashed_password)) {
                $_SESSION['forename'] = $row['forename'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role_name'] = $row['role_name']; // Store the role in session

                // Redirect based on user role
                if ($row['role_name'] === 'admin') {
                    header('location: admin.php'); // Admin page
                } elseif ($row['role_name'] === 'employees') {
                    header('location: nhanvien.php'); // Employee page
                }
                exit;
            } else {
                echo "<script>alert('Invalid password');</script>";
                header('location: loginsai.php');
                exit;
            }
        } else {
            echo "<script>alert('User not found');</script>";
            header('location: loginsai.php');
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
