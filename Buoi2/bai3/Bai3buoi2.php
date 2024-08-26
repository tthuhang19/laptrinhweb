<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phép tính và Kiểm tra số</title>
    <link rel="stylesheet" href="Css.css">
</head>
<body>
<div class="main">
    <h1>Bài 3 buổi 2: Phép tính trên 2 số</h1>
    <form method="post" action="">
        <label for="pheptinh">Chọn phép tính:</label><br>
        <input type="radio" name="pheptinh" value="cong">Cộng<br>
        <input type="radio" name="pheptinh" value="tru">Trừ<br>
        <input type="radio" name="pheptinh" value="nhan">Nhân<br>
        <input type="radio" name="pheptinh" value="chia">Chia<br><br>

        <label >Số thứ nhất:</label><br>
        <input type="text" name="so1" required><br><br>

        <label >Số thứ hai (nếu cần):</label><br>
        <input type="text" name="so2"><br><br>

        <input type="submit" name="tinh" value="Tính">
    </form>

    
    <h1>KIỂM TRA SỐ</h1>
    <form method="post" action="">
        <label for="kiemtra">Chọn phép kiểm tra:</label><br>
        <input type="radio" name="kiemtra" value="chanle">Kiểm tra số chẵn/lẻ<br>
        <input type="radio" name="kiemtra" value="nguyento">Kiểm tra số nguyên tố<br><br>

        <label for="so">Số cần kiểm tra:</label><br>
        <input type="text" name="so" required><br><br>

        <input type="submit" name="kiemtra_btn" value="Kiểm tra">
    </form>
    
    <?php 
    require_once 'Mainphp.php';

    if (isset($_POST['tinh'])) {
        $pheptinh = $_POST['pheptinh'];
        $so1 = (int)$_POST['so1'];
        $so2 = (isset($_POST['so2']) && is_numeric($_POST['so2'])) ? (int)$_POST['so2'] : 0;
        $ketqua_tinh = tinh_phep_tinh($pheptinh, $so1, $so2);
        echo "<p>Kết quả: $ketqua_tinh</p>";
    }

    if (isset($_POST['kiemtra_btn'])) {
        $kiemtra = $_POST['kiemtra'];
        $so = $_POST['so'];
        $ketqua_kiemtra = "";

        if (is_numeric($so)) {
            $so = (int)$so;
            switch ($kiemtra) {
                case 'chanle':
                    $ketqua_kiemtra = kiem_tra_chan_le($so);
                    break;
                case 'nguyento':
                    $ketqua_kiemtra = kiem_tra_nguyen_to($so);
                    break;
            }
            echo "<p>Kết quả: $ketqua_kiemtra</p>";
        } else {
            echo "<p>Vui lòng nhập lại.</p>";
        }
    }
    ?>
</div>
</body>
</html>
