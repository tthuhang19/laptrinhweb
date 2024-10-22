<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bai3.css">
    <title>Bài 3</title>
</head>
<body>
    <form action="bai3kqua.php" method="post">
        <h2>PHÉP TÍNH TRÊN HAI SỐ</h2>
        <table>
            <tr>
                <td class="label">Chọn phép tính:</td>
                <td>
                    <input type="radio" name="operation" value="Tong"> Tổng
                    <input type="radio" name="operation" value="Hieu"> Hiệu
                    <input type="radio" name="operation" value="Tich"> Tích
                    <input type="radio" name="operation" value="Thuong"> Thương
                </td>
            </tr>
            <tr>
                <td class="label">Số thứ nhất:</td>
                <td><input type="number" name="num1"></td>
            </tr>
            <tr>
                <td class="label">Số thứ hai:</td>
                <td><input type="number" name="num2"></td>
            </tr>
            <tr>
                <td></td>
                <td><button>Tính</button></td>
            </tr>
        </table>
    </form>
</body>
</html>