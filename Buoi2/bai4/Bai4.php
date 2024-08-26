<?php
require 'phpbai4.php';

$array = [4, 5, 9, 3, 7, 6];
$max = SLN($array);
$min = SNN($array);
$sum = Tong($array);
$sortedArray = sapxep($array);
$elementToCheck = 7;
$elementExists = check($array, $elementToCheck);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Functions</title>
    <link rel="stylesheet" href="Main.css">
</head>
<body>
    <div class="container">
        <h1>Mảng bài 4</h1>
        <div class="result">
            <p>Mảng ban đầu: <?php echo implode(', ', [5, 2, 9, 1, 7, 3]); ?></p>
            <p>Giá trị lớn nhất trong mảng là: <?php echo $max; ?></p>
            <p>Giá trị nhỏ nhất trong mảng là: <?php echo $min; ?></p>
            <p>Tổng các phần tử trong mảng là: <?php echo $sum; ?></p>
            <p>Mảng sau khi sắp xếp: <?php echo implode(', ', $sortedArray); ?></p>
            <p><?php echo $elementToCheck . ($elementExists ? ' có ' : ' không có ') . 'trong mảng'; ?></p>
        </div>
    </div>
</body>
</html>