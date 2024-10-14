<?php
session_start();
require_once('loginconnect.php');

// if(isset($_SESSION['name']) && isset($_SESSION['username'] )){

// }
$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="content"><p>Xin chào <span><?= htmlspecialchars($_SESSION['username']); ?></span></p></div>
</body>
</html>