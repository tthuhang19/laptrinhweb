<head>
    <link rel="stylesheet" type="text/css" href="bai4.css">
</head>
<?php
require_once 'bai4.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mang = explode(",", $_POST['mang']);
    $mang = array_map('trim', $mang); 
    $phanTu = trim($_POST['phan_tu']);

    $giaTriLonNhat = timGiaTriLonNhat($mang);
    $giaTriNhoNhat = timGiaTriNhoNhat($mang);
    $tong = tinhTong($mang);
    $coTonTai = kiemTraPhanTu($mang, $phanTu) ? "có" : "không";
    sapXepMang($mang);
    $mangSauKhiSapXep = implode(", ", $mang);

    echo "<h1>Kết quả xử lý mảng</h1>";
    echo "<p>Mảng ban đầu: " . implode(", ", $mang) . "</p>";
    echo "<p>Giá trị lớn nhất trong mảng: $giaTriLonNhat</p>";
    echo "<p>Giá trị nhỏ nhất trong mảng: $giaTriNhoNhat</p>";
    echo "<p>Tổng các phần tử trong mảng: $tong</p>";
    echo "<p>Mảng sau khi sắp xếp: $mangSauKhiSapXep</p>";
    echo "<p>Phần tử '$phanTu' $coTonTai trong mảng</p>";
} else {
    echo "<p>Vui lòng gửi dữ liệu qua form.</p>";
}
?>
