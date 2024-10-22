<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 3 - Kết quả</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .container {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 450px;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .label {
            font-weight: bold;
            color: #666;
        }
        
        .result {
            font-size: 18px;
            font-weight: bold;
            color: #0099;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            text-decoration: none;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>KẾT QUẢ PHÉP TÍNH</h2>
        <div class="row">
            <div class="label">Phép tính:</div>
            <div class="result"><?php echo $_POST['operation']; ?></div>
        </div>
        <div class="row">
            <div class="label">Số thứ nhất:</div>
            <div class="result"><?php echo $_POST['num1']; ?></div>
        </div>
        <div class="row">
            <div class="label">Số thứ hai:</div>
            <div class="result"><?php echo $_POST['num2']; ?></div>
        </div>
        <div class="row">
            <div class="label">Kết quả:</div>
            <div class="result">
                <?php
                    $num1 = $_POST['num1'];
                    $num2 = $_POST['num2'];
                    $operation = $_POST['operation'];
                    
                    switch ($operation) {
                        case 'Tong':
                            echo $num1 + $num2;
                            break;
                        case 'Hieu':
                            echo $num1 - $num2;
                            break;
                        case 'Tich':
                            echo $num1 * $num2;
                            break;
                        case 'Thuong':
                            if ($num2 == 0) {
                                echo "Không thể chia cho 0";
                            } else {
                                echo $num1 / $num2;
                            }
                            break;
                        default:
                            echo "Vui lòng chọn phép tính";
                    }
                ?>
            </div>
        </div>
        <a href="Bai3nhap.php" class="back-link">Quay lại trang trước</a>
    </div>
</body>
</html>