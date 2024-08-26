<!DOCTYPE html>
<html>
    <head>
        <title>Bai 3</title>
    </head>
    <body>
        <?php
            function tinhTong($a, $b){
                return $a + $b;
            }
            function tinhHieu($a, $b){
                return $a - $b;
            }
            function tinhTich($a, $b){
                return $a * $b;
            }
            function tinhThuong($a, $b){
                if ($b != 0){
                    return $a / $b;
                }else{
                    return "Không thể chia hết cho 0";
                }
            }
            function kiemTraNguyenTo($n){
                if ($n < 2) {
                    return false;
                }
                for ($i = 2; $i <= sqrt($n); $i++) {
                    if ($n % $i == 0) {
                        return false;
                    }
                }
                return true;
            }
            function kiemTraChan($n){
                return $n % 2 == 0;
            }
            $a=10;
            $b=5;
            echo "Tổng của $a và $b là: " . tinhTong($a, $b) . "<br>";
            echo "Hiệu của $a và $b là: " . tinhHieu($a, $b) . "<br>";
            echo "Tích của $a và $b là: " . tinhTich($a, $b) . "<br>";
            echo "Thương của $a và $b là: " . tinhThuong($a, $b) . "<br>";
            $n = 7;
            echo "$n " . (kiemTraNguyenTo($n) ? "là" : "không phải là") . " số nguyên tố<br>";
            $n = 4;
            echo "$n " . (kiemTraChan($n) ? "là" : "không phải là") . " số chẵn<br>";
        ?>
    </body>
</html>
